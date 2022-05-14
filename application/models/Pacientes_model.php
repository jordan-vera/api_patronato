<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pacientes_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get()
    {
        $query = $this->db->select('*')->from('pacientes')->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }

        return null;
    }

    public function contador()
    {
        return $this->db->count_all_results('pacientes');;
    }

    public function save($cedula, $nombres, $direccion, $celular, $telefono, $email)
    {
        $this->db->set($this->_setPacientes($cedula, $nombres, $direccion, $celular, $telefono, $email))->insert('pacientes');

        if ($this->db->affected_rows() === 1) {
            return $this->db->insert_id();
        }

        return null;
    }

    public function update($idpaciente, $cedula, $nombres, $direccion, $celular, $telefono, $email)
    {
        $this->db->set($this->_setPacientes($cedula, $nombres, $direccion, $celular, $telefono, $email))->where('idpaciente', $idpaciente)->update('pacientes');

        if ($this->db->affected_rows() === 1) {
            return true;
        }

        return null;
    }

    public function delete($idpaciente)
    {
        $this->db->where('idpaciente', $idpaciente)->delete('pacientes');

        if ($this->db->affected_rows() === 1) {
            return true;
        }

        return null;
    }

    private function _setPacientes($cedula, $nombres, $direccion, $celular, $telefono, $email)
    {
        return array(
            'cedula' => $cedula,
            'nombres' => $nombres,
            'direccion' => $direccion,
            'celular' => $celular,
            'telefono' => $telefono,
            'email' => $email
        );
    }
}
