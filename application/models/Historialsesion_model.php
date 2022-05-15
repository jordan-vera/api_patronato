<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Historialsesion_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get()
    {
        $query = $this->db->select('*')->from('historial_sesion')->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return null;
    }

    public function contador()
    {
        return $this->db->count_all_results('historial_sesion');;
    }

    public function save($IDUSUARIO, $FECHAHORASESION)
    {
        $this->db->set($this->_setHistorialsesion($IDUSUARIO, $FECHAHORASESION))->insert('historial_sesion');
        if ($this->db->affected_rows() === 1) {
            return $this->db->insert_id();
        }
        return null;
    }

    public function update($IDHISTORIALSESION, $IDUSUARIO, $FECHAHORASESION)
    {
        $this->db->set($this->_setHistorialsesion($IDUSUARIO, $FECHAHORASESION))->where('IDHISTORIALSESION', $IDHISTORIALSESION)->update('historial_sesion');
        if ($this->db->affected_rows() === 1) {
            return true;
        }
        return null;
    }

    public function delete($IDHISTORIALSESION)
    {
        $this->db->where('IDHISTORIALSESION', $IDHISTORIALSESION)->delete('historial_sesion');
        if ($this->db->affected_rows() === 1) {
            return true;
        }
        return null;
    }

    private function _setHistorialsesion($IDUSUARIO, $FECHAHORASESION)
    {
        return array(
            'IDUSUARIO' => $IDUSUARIO,
            'FECHAHORASESION' => $FECHAHORASESION
        );
    }
}
