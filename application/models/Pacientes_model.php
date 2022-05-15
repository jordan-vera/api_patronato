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
        $query = $this->db->select('*')->from('paciente')->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return null;
    }

    public function getone($IDPACIENTE)
    {
        $query = $this->db->select('*')->from('paciente')->where('IDPACIENTE', $IDPACIENTE)->get();
        if ($query->num_rows() === 1) {
            return $query->row_array();
        }
        return null;
    }

    public function contador()
    {
        return $this->db->count_all_results('paciente');;
    }

    public function save($IDGENERO, $IDPERSONA, $CONSULTAS_WEB, $FECHA_NACIMIENTO, $OBSERVACIONES)
    {
        $this->db->set($this->_setPacientes($IDGENERO, $IDPERSONA, $CONSULTAS_WEB, $FECHA_NACIMIENTO, $OBSERVACIONES))->insert('paciente');
        if ($this->db->affected_rows() === 1) {
            return $this->db->insert_id();
        }
        return null;
    }

    public function update($IDPACIENTE, $IDGENERO, $IDPERSONA, $CONSULTAS_WEB, $FECHA_NACIMIENTO, $OBSERVACIONES)
    {
        $this->db->set($this->_setPacientes($IDGENERO, $IDPERSONA, $CONSULTAS_WEB, $FECHA_NACIMIENTO, $OBSERVACIONES))->where('IDPACIENTE', $IDPACIENTE)->update('paciente');
        if ($this->db->affected_rows() === 1) {
            return true;
        }
        return null;
    }

    public function delete($IDPACIENTE)
    {
        $this->db->where('IDPACIENTE', $IDPACIENTE)->delete('paciente');
        if ($this->db->affected_rows() === 1) {
            return true;
        }
        return null;
    }

    private function _setPacientes($IDGENERO, $IDPERSONA, $CONSULTAS_WEB, $FECHA_NACIMIENTO, $OBSERVACIONES)
    {
        return array(
            'IDGENERO' => $IDGENERO,
            'IDPERSONA' => $IDPERSONA,
            'CONSULTAS_WEB' => $CONSULTAS_WEB,
            'FECHA_NACIMIENTO' => $FECHA_NACIMIENTO,
            'OBSERVACIONES' => $OBSERVACIONES
        );
    }
}
