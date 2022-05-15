<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Visitas_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get()
    {
        $query = $this->db->select('*')->from('visitas')->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return null;
    }

    public function save($FECHAHISTORIA, $HORA, $NOMBREDIA, $TIPO)
    {
        $this->db->set($this->_setVisita($FECHAHISTORIA, $HORA, $NOMBREDIA, $TIPO))->insert('visitas');
        if ($this->db->affected_rows() === 1) {
            return $this->db->insert_id();
        }
        return null;
    }

    public function delete($IDVISITAS)
    {
        $this->db->where('IDVISITAS', $IDVISITAS)->delete('visitas');
        if ($this->db->affected_rows() === 1) {
            return true;
        }
        return null;
    }

    private function _setVisita($FECHAHISTORIA, $HORA, $NOMBREDIA, $TIPO)
    {
        return array(
            'FECHAHISTORIA' => $FECHAHISTORIA,
            'HORA' => $HORA,
            'NOMBREDIA' => $NOMBREDIA,
            'TIPO' => $TIPO
        );
    }
}
