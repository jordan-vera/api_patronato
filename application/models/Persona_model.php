<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Persona_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get()
    {
        $query = $this->db->select('*')->from('persona')->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return null;
    }

    public function getone($IDPERSONA)
    {
        $query = $this->db->select('*')->from('persona')->where('IDPERSONA', $IDPERSONA)->get();
        if ($query->num_rows() === 1) {
            return $query->row_array();
        }
        return null;
    }

    public function save($IDCANTON, $NOMBRES, $IDENTIFICACION, $CELULAR, $EMAIL, $DIRECCION)
    {
        $this->db->set($this->_setPersona($IDCANTON, $NOMBRES, $IDENTIFICACION, $CELULAR, $EMAIL, $DIRECCION))->insert('persona');

        if ($this->db->affected_rows() === 1) {
            return $this->db->insert_id();
        }

        return null;
    }

    public function update($IDPERSONA, $IDCANTON, $NOMBRES, $IDENTIFICACION, $CELULAR, $EMAIL, $DIRECCION)
    {
        $this->db->set($this->_setPersona($IDCANTON, $NOMBRES, $IDENTIFICACION, $CELULAR, $EMAIL, $DIRECCION))->where('IDPERSONA', $IDPERSONA)->update('persona');
        if ($this->db->affected_rows() === 1) {
            return true;
        }
        return null;
    }

    public function delete($IDPERSONA)
    {
        $this->db->where('IDPERSONA', $IDPERSONA)->delete('persona');
        if ($this->db->affected_rows() === 1) {
            return true;
        }
        return null;
    }

    private function _setPersona($IDCANTON, $NOMBRES, $IDENTIFICACION, $CELULAR, $EMAIL, $DIRECCION)
    {
        return array(
            'IDCANTON' => $IDCANTON,
            'NOMBRES' => $NOMBRES,
            'IDENTIFICACION' => $IDENTIFICACION,
            'CELULAR' => $CELULAR,
            'EMAIL' => $EMAIL,
            'DIRECCION' => $DIRECCION
        );
    }
}
