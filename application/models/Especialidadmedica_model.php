<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Especialidadmedica_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get()
    {
        $query = $this->db->select('*')->from('especialidad_medica')->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return null;
    }

    public function getone($IDESPECIALIDAD)
    {
        $query = $this->db->select('*')->from('especialidad_medica')->where('IDESPECIALIDAD', $IDESPECIALIDAD)->get();
        if ($query->num_rows() === 1) {
            return $query->row_array();
        }
        return null;
    }

    public function save($ESPECIALIDAD)
    {
        $this->db->set($this->_setEspecialidad($ESPECIALIDAD))->insert('especialidad_medica');
        if ($this->db->affected_rows() === 1) {
            return $this->db->insert_id();
        }
        return null;
    }

    public function update($IDESPECIALIDAD, $ESPECIALIDAD)
    {
        $this->db->set($this->_setEspecialidad($ESPECIALIDAD))->where('IDESPECIALIDAD', $IDESPECIALIDAD)->update('especialidad_medica');
        if ($this->db->affected_rows() === 1) {
            return true;
        }
        return null;
    }

    public function delete($IDESPECIALIDAD)
    {
        $this->db->where('IDESPECIALIDAD', $IDESPECIALIDAD)->delete('especialidad_medica');
        if ($this->db->affected_rows() === 1) {
            return true;
        }
        return null;
    }

    private function _setEspecialidad($ESPECIALIDAD)
    {
        return array(
            'ESPECIALIDAD' => $ESPECIALIDAD,
        );
    }
}
