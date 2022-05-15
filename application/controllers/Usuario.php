<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . '/libraries/REST_Controller.php';

class Usuario extends REST_Controller
{
    public function __construct($config = 'rest')
    {
        parent::__construct($config);
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == "OPTIONS") {
            die();
        }

        $this->load->model('usuario_model');
    }

    public function index_get()
    {
        $datos = $this->usuario_model->get();
        if (!is_null($datos)) {
            $this->response(array('response' => $datos), 200);
        } else {
            $this->response(array('error' => 'No hay datos...'), 200);
        }
    }

    public function login_get($USERNICK, $PASSWORD)
    {
        $datos = $this->usuario_model->login($USERNICK, hash("sha256", $PASSWORD));

        if (!is_null($datos)) {
            $this->response(array('response' => $datos), 200);
        } else {
            $this->response(array('error' => 'No hay datos...'), 200);
        }
    }

    public function index_post()
    {
        $params = json_decode(file_get_contents('php://input'));

        $IDPERSONA = $params->IDPERSONA;
        $USERNICK = $params->USERNICK;
        $PASSWORD = $params->PASSWORD;
        $TIPOUSER = $params->TIPOUSER;

        $id = $this->usuario_model->save($IDPERSONA, $USERNICK, hash("sha256", $PASSWORD), $TIPOUSER);

        if (!is_null($id)) {
            $this->response(array('response' => $id), 200);
        } else {
            $this->response(array('error', 'Algo se ha roto en el servidor...'), 400);
        }
    }

    public function delete_get($IDUSUARIO)
    {
        if (!$IDUSUARIO) {
            $this->response(null, 400);
        }
        $delete = $this->usuario_model->delete($IDUSUARIO);
        if (!is_null($delete)) {
            $this->response(array('response' => 'done'), 200);
        } else {
            $this->response(array('error', 'Algo se ha roto en el servidor...'), 400);
        }
    }

    public function update_post()
    {
        $params = json_decode(file_get_contents('php://input'));

        $IDUSUARIO = $params->IDUSUARIO;
        $IDPERSONA = $params->IDPERSONA;
        $USERNICK = $params->USERNICK;
        $PASSWORD = $params->PASSWORD;
        $TIPOUSER = $params->TIPOUSER;

        $update = $this->usuario_model->update($IDUSUARIO, $IDPERSONA, $USERNICK, hash("sha256", $PASSWORD), $TIPOUSER);

        if (!is_null($update)) {
            $this->response(array('response' => 'data actualizado!'), 200);
        } else {
            $this->response(array('error', 'Algo se ha roto en el servidor...'), 400);
        }
    }
}
