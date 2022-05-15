<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . '/libraries/REST_Controller.php';

class Visitas extends REST_Controller
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

        $this->load->model('visitas_model');
    }

    public function index_get()
    {
        $datos = $this->visitas_model->get();
        if (!is_null($datos)) {
            $this->response(array('response' => $datos), 200);
        } else {
            $this->response(array('error' => 'No hay datos...'), 200);
        }
    }

    public function index_post()
    {
        $params = json_decode(file_get_contents('php://input'));

        $IDCANTON = $params->IDCANTON;
        $NOMBRES = $params->NOMBRES;
        $IDENTIFICACION = $params->IDENTIFICACION;
        $CELULAR = $params->CELULAR;
        $EMAIL = $params->EMAIL;
        $DIRECCION = $params->DIRECCION;

        $id = $this->visitas_model->save($IDCANTON, $NOMBRES, $IDENTIFICACION, $CELULAR, $EMAIL, $DIRECCION);

        if (!is_null($id)) {
            $this->response(array('response' => $id), 200);
        } else {
            $this->response(array('error', 'Algo se ha roto en el servidor...'), 400);
        }
    }

    public function delete_get($IDPERSONA)
    {
        if (!$IDPERSONA) {
            $this->response(null, 400);
        }
        $delete = $this->visitas_model->delete($IDPERSONA);
        if (!is_null($delete)) {
            $this->response(array('response' => 'done'), 200);
        } else {
            $this->response(array('error', 'Algo se ha roto en el servidor...'), 400);
        }
    }
}
