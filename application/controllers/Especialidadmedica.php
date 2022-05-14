<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . '/libraries/REST_Controller.php';

class Especialidadmedica extends REST_Controller
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

        $this->load->model('especialidadmedica_model');
    }

    public function index_get()
    {
        $datos = $this->especialidadmedica_model->get();

        if (!is_null($datos)) {
            $this->response(array('response' => $datos), 200);
        } else {
            $this->response(array('error' => 'No hay datos...'), 200);
        }
    }

    public function one_get($IDESPECIALIDAD)
    {
        $datos = $this->especialidadmedica_model->getone($IDESPECIALIDAD);

        if (!is_null($datos)) {
            $this->response(array('response' => $datos), 200);
        } else {
            $this->response(array('error' => 'No hay datos...'), 200);
        }
    }

    public function index_post()
    {
        $params = json_decode(file_get_contents('php://input'));

        $ESPECIALIDAD = $params->ESPECIALIDAD;

        $id = $this->especialidadmedica_model->save($ESPECIALIDAD);

        if (!is_null($id)) {
            $this->response(array('response' => $id), 200);
        } else {
            $this->response(array('error', 'Algo se ha roto en el servidor...'), 400);
        }
    }

    public function delete_get($IDESPECIALIDAD)
    {
        if (!$IDESPECIALIDAD) {
            $this->response(null, 400);
        }
        $delete = $this->especialidadmedica_model->delete($IDESPECIALIDAD);
        if (!is_null($delete)) {
            $this->response(array('response' => 'done'), 200);
        } else {
            $this->response(array('error', 'Algo se ha roto en el servidor...'), 400);
        }
    }

    public function update_post()
    {
        $params = json_decode(file_get_contents('php://input'));

        $IDESPECIALIDAD = $params->IDESPECIALIDAD;
        $ESPECIALIDAD = $params->ESPECIALIDAD;

        $update = $this->especialidadmedica_model->update($IDESPECIALIDAD, $ESPECIALIDAD);

        if (!is_null($update)) {
            $this->response(array('response' => 'data actualizado!'), 200);
        } else {
            $this->response(array('error', 'Algo se ha roto en el servidor...'), 400);
        }
    }
}
