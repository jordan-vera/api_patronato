<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Enfermeras_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get()
    {
        $query = $this->db->select('*')->from('enfermeras')->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return null;
    }

    public function getone($IDENFERMERA)
    {
        $query = $this->db->select('*')->from('enfermeras')->where('IDENFERMERA', $IDENFERMERA)->get();
        if ($query->num_rows() === 1) {
            return $query->row_array();
        }
        return null;
    }

    public function contador()
    {
        return $this->db->count_all_results('enfermeras');;
    }

    public function save($IDPERSONA, $CARGO, $OBSERVACION, $ATENCIONES)
    {
        $this->db->set($this->_setEnfermeras($IDPERSONA, $CARGO, $OBSERVACION, $ATENCIONES))->insert('enfermeras');
        if ($this->db->affected_rows() === 1) {
            return $this->db->insert_id();
        }
        return null;
    }

    public function update($IDENFERMERA, $IDPERSONA, $CARGO, $OBSERVACION, $ATENCIONES)
    {
        $this->db->set($this->_setEnfermeras($IDPERSONA, $CARGO, $OBSERVACION, $ATENCIONES))->where('IDENFERMERA', $IDENFERMERA)->update('enfermeras');
        if ($this->db->affected_rows() === 1) {
            return true;
        }
        return null;
    }

    public function delete($IDENFERMERA)
    {
        $this->db->where('IDENFERMERA', $IDENFERMERA)->delete('enfermeras');
        if ($this->db->affected_rows() === 1) {
            return true;
        }
        return null;
    }

    private function _setEnfermeras($IDPERSONA, $CARGO, $OBSERVACION, $ATENCIONES)
    {
        return array(
            'IDPERSONA' => $IDPERSONA,
            'CARGO' => $CARGO,
            'OBSERVACION' => $OBSERVACION,
            'ATENCIONES' => $ATENCIONES
        );
    }
}
