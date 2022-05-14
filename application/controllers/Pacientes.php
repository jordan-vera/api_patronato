<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . '/libraries/REST_Controller.php';

class Pacientes extends REST_Controller
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

        $this->load->model('pacientes_model');
    }

    public function index_get()
    {
        $datos = $this->pacientes_model->get();

        if (!is_null($datos)) {
            $this->response(array('response' => $datos), 200);
        } else {
            $this->response(array('error' => 'No hay productores en la base de datos...'), 200);
        }
    }

    public function contador_get()
    {
        $datos = $this->pacientes_model->contador();

        if (!is_null($datos)) {
            $this->response(array('response' => $datos), 200);
        } else {
            $this->response(array('error' => 'productor no encontrado...'), 200);
        }
    }

    public function index_post()
    {
        $params = json_decode(file_get_contents('php://input'));

        $cedula = $params->cedula;
        $nombres = $params->nombres;
        $direccion = $params->direccion;
        $celular = $params->celular;
        $telefono = $params->telefono;
        $email = $params->email;

        $id = $this->pacientes_model->save($cedula, $nombres, $direccion, $celular, $telefono, $email);

        if (!is_null($id)) {
            $this->response(array('response' => $id), 200);
        } else {
            $this->response(array('error', 'Algo se ha roto en el servidor...'), 400);
        }
    }

    public function delete_get($id)
    {
        if (!$id) {
            $this->response(null, 400);
        }

        $delete = $this->pacientes_model->delete($id);

        if (!is_null($delete)) {
            $this->response(array('response' => 'done'), 200);
        } else {
            $this->response(array('error', 'Algo se ha roto en el servidor...'), 400);
        }
    }

    public function update_post()
    {
        $params = json_decode(file_get_contents('php://input'));

        $idpaciente = $params->idpaciente;
        $cedula = $params->cedula;
        $nombres = $params->nombres;
        $direccion = $params->direccion;
        $celular = $params->celular;
        $telefono = $params->telefono;
        $email = $params->email;


        $update = $this->pacientes_model->update($idpaciente, $cedula, $nombres, $direccion, $celular, $telefono, $email);

        if (!is_null($update)) {
            $this->response(array('response' => 'data actualizado!'), 200);
        } else {
            $this->response(array('error', 'Algo se ha roto en el servidor...'), 400);
        }
    }
}
