<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . '/libraries/REST_Controller.php';

class Enfermeras extends REST_Controller
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

        $this->load->model('enfermeras_model');
    }

    public function index_get()
    {
        $datos = $this->enfermeras_model->get();
        if (!is_null($datos)) {
            $this->response(array('response' => $datos), 200);
        } else {
            $this->response(array('error' => 'No hay productores en la base de datos...'), 200);
        }
    }

    public function contador_get()
    {
        $datos = $this->enfermeras_model->contador();
        if (!is_null($datos)) {
            $this->response(array('response' => $datos), 200);
        } else {
            $this->response(array('error' => 'productor no encontrado...'), 200);
        }
    }

    public function one_get($IDENFERMERA)
    {
        $datos = $this->enfermeras_model->getone($IDENFERMERA);
        if (!is_null($datos)) {
            $this->response(array('response' => $datos), 200);
        } else {
            $this->response(array('error' => 'No hay productores en la base de datos...'), 200);
        }
    }

    public function index_post()
    {
        $params = json_decode(file_get_contents('php://input'));

        $IDPERSONA = $params->IDPERSONA;
        $CARGO = $params->CARGO;
        $OBSERVACION = $params->OBSERVACION;
        $ATENCIONES = $params->ATENCIONES;

        $id = $this->enfermeras_model->save($IDPERSONA, $CARGO, $OBSERVACION, $ATENCIONES);

        if (!is_null($id)) {
            $this->response(array('response' => $id), 200);
        } else {
            $this->response(array('error', 'Algo se ha roto en el servidor...'), 400);
        }
    }

    public function delete_get($IDENFERMERA)
    {
        if (!$IDENFERMERA) {
            $this->response(null, 400);
        }
        $delete = $this->enfermeras_model->delete($IDENFERMERA);
        if (!is_null($delete)) {
            $this->response(array('response' => 'done'), 200);
        } else {
            $this->response(array('error', 'Algo se ha roto en el servidor...'), 400);
        }
    }

    public function update_post()
    {
        $params = json_decode(file_get_contents('php://input'));

        $IDENFERMERA = $params->IDENFERMERA;
        $IDPERSONA = $params->IDPERSONA;
        $CARGO = $params->CARGO;
        $OBSERVACION = $params->OBSERVACION;
        $ATENCIONES = $params->ATENCIONES;

        $update = $this->enfermeras_model->update($IDENFERMERA, $IDPERSONA, $CARGO, $OBSERVACION, $ATENCIONES);

        if (!is_null($update)) {
            $this->response(array('response' => 'data actualizado!'), 200);
        } else {
            $this->response(array('error', 'Algo se ha roto en el servidor...'), 400);
        }
    }
}
