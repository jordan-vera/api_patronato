<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . '/libraries/REST_Controller.php';

class Medicos extends REST_Controller
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

        $this->load->model('medicos_model');
    }

    public function index_get()
    {
        $datos = $this->medicos_model->get();
        if (!is_null($datos)) {
            $this->response(array('response' => $datos), 200);
        } else {
            $this->response(array('error' => 'No hay productores en la base de datos...'), 200);
        }
    }

    public function contador_get()
    {
        $datos = $this->medicos_model->contador();
        if (!is_null($datos)) {
            $this->response(array('response' => $datos), 200);
        } else {
            $this->response(array('error' => 'productor no encontrado...'), 200);
        }
    }

    public function one_get($IDPACIENTE)
    {
        $datos = $this->medicos_model->getone($IDPACIENTE);
        if (!is_null($datos)) {
            $this->response(array('response' => $datos), 200);
        } else {
            $this->response(array('error' => 'No hay productores en la base de datos...'), 200);
        }
    }

    public function index_post()
    {
        $params = json_decode(file_get_contents('php://input'));

        $IDGENERO = $params->IDGENERO;
        $IDPERSONA = $params->IDPERSONA;
        $CONSULTAS_WEB = $params->CONSULTAS_WEB;
        $FECHA_NACIMIENTO = $params->FECHA_NACIMIENTO;
        $OBSERVACIONES = $params->OBSERVACIONES;

        $id = $this->medicos_model->save($IDGENERO, $IDPERSONA, $CONSULTAS_WEB, $FECHA_NACIMIENTO, $OBSERVACIONES);

        if (!is_null($id)) {
            $this->response(array('response' => $id), 200);
        } else {
            $this->response(array('error', 'Algo se ha roto en el servidor...'), 400);
        }
    }

    public function delete_get($IDPACIENTE)
    {
        if (!$IDPACIENTE) {
            $this->response(null, 400);
        }
        $delete = $this->medicos_model->delete($IDPACIENTE);
        if (!is_null($delete)) {
            $this->response(array('response' => 'done'), 200);
        } else {
            $this->response(array('error', 'Algo se ha roto en el servidor...'), 400);
        }
    }

    public function update_post()
    {
        $params = json_decode(file_get_contents('php://input'));

        $IDPACIENTE = $params->IDPACIENTE;
        $IDGENERO = $params->IDGENERO;
        $IDPERSONA = $params->IDPERSONA;
        $CONSULTAS_WEB = $params->CONSULTAS_WEB;
        $FECHA_NACIMIENTO = $params->FECHA_NACIMIENTO;
        $OBSERVACIONES = $params->OBSERVACIONES;

        $update = $this->medicos_model->update($IDPACIENTE, $IDGENERO, $IDPERSONA, $CONSULTAS_WEB, $FECHA_NACIMIENTO, $OBSERVACIONES);

        if (!is_null($update)) {
            $this->response(array('response' => 'data actualizado!'), 200);
        } else {
            $this->response(array('error', 'Algo se ha roto en el servidor...'), 400);
        }
    }
}
