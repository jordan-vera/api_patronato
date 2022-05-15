<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . '/libraries/REST_Controller.php';

class Historialsesion extends REST_Controller
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

        $this->load->model('historialsesion_model');
    }

    public function index_get()
    {
        $datos = $this->historialsesion_model->get();
        if (!is_null($datos)) {
            $this->response(array('response' => $datos), 200);
        } else {
            $this->response(array('error' => 'No hay productores en la base de datos...'), 200);
        }
    }

    public function contador_get()
    {
        $datos = $this->historialsesion_model->contador();
        if (!is_null($datos)) {
            $this->response(array('response' => $datos), 200);
        } else {
            $this->response(array('error' => 'productor no encontrado...'), 200);
        }
    }

    public function index_post()
    {
        $params = json_decode(file_get_contents('php://input'));

        $IDUSUARIO = $params->IDUSUARIO;
        $FECHAHORASESION = $params->FECHAHORASESION;

        $id = $this->historialsesion_model->save($IDUSUARIO, $FECHAHORASESION);

        if (!is_null($id)) {
            $this->response(array('response' => $id), 200);
        } else {
            $this->response(array('error', 'Algo se ha roto en el servidor...'), 400);
        }
    }

    public function delete_get($IDHISTORIALSESION)
    {
        if (!$IDHISTORIALSESION) {
            $this->response(null, 400);
        }
        $delete = $this->historialsesion_model->delete($IDHISTORIALSESION);
        if (!is_null($delete)) {
            $this->response(array('response' => 'done'), 200);
        } else {
            $this->response(array('error', 'Algo se ha roto en el servidor...'), 400);
        }
    }

    public function update_post()
    {
        $params = json_decode(file_get_contents('php://input'));

        $IDHISTORIALSESION = $params->IDHISTORIALSESION;
        $IDUSUARIO = $params->IDUSUARIO;
        $FECHAHORASESION = $params->FECHAHORASESION;

        $update = $this->historialsesion_model->update($IDHISTORIALSESION, $IDUSUARIO, $FECHAHORASESION);

        if (!is_null($update)) {
            $this->response(array('response' => 'data actualizado!'), 200);
        } else {
            $this->response(array('error', 'Algo se ha roto en el servidor...'), 400);
        }
    }
}
