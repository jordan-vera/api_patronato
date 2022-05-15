<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Medicos_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get()
    {
        $query = $this->db->select('*')->from('medicos')->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return null;
    }

    public function getone($IDMEDICO)
    {
        $query = $this->db->select('*')->from('medicos')->where('IDMEDICO', $IDMEDICO)->get();
        if ($query->num_rows() === 1) {
            return $query->row_array();
        }
        return null;
    }

    public function contador()
    {
        return $this->db->count_all_results('medicos');;
    }

    public function save($IDPERSONA, $IDESPECIALIDAD, $CARGO, $OBSERVACIONES, $CANTIDAD_ATENCIONES)
    {
        $this->db->set($this->_setMedicos($IDPERSONA, $IDESPECIALIDAD, $CARGO, $OBSERVACIONES, $CANTIDAD_ATENCIONES))->insert('medicos');

        if ($this->db->affected_rows() === 1) {
            return $this->db->insert_id();
        }

        return null;
    }

    public function update($IDMEDICO, $IDPERSONA, $IDESPECIALIDAD, $CARGO, $OBSERVACIONES, $CANTIDAD_ATENCIONES)
    {
        $this->db->set($this->_setMedicos($IDPERSONA, $IDESPECIALIDAD, $CARGO, $OBSERVACIONES, $CANTIDAD_ATENCIONES))->where('IDMEDICO', $IDMEDICO)->update('medicos');
        if ($this->db->affected_rows() === 1) {
            return true;
        }
        return null;
    }

    public function delete($IDMEDICO)
    {
        $this->db->where('IDMEDICO', $IDMEDICO)->delete('medicos');
        if ($this->db->affected_rows() === 1) {
            return true;
        }
        return null;
    }

    private function _setMedicos($IDPERSONA, $IDESPECIALIDAD, $CARGO, $OBSERVACIONES, $CANTIDAD_ATENCIONES)
    {
        return array(
            'IDPERSONA' => $IDPERSONA,
            'IDESPECIALIDAD' => $IDESPECIALIDAD,
            'CARGO' => $CARGO,
            'OBSERVACIONES' => $OBSERVACIONES,
            'CANTIDAD_ATENCIONES' => $CANTIDAD_ATENCIONES
        );
    }
}
