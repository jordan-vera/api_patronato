<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Usuario_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get()
    {
        $query = $this->db->select('*')->from('usuarios')->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return null;
    }

    public function login($USERNICK, $PASSWORD)
    {
        $query = $this->db->select('*')->from('usuarios')
            ->where('USERNICK', $USERNICK)
            ->where('PASSWORD', $PASSWORD)
            ->get();
        if ($query->num_rows() === 1) {
            return $query->row_array();
        }
        return null;
    }

    public function save($IDPERSONA, $USERNICK, $PASSWORD, $TIPOUSER)
    {
        $this->db->set($this->_setUsuario($IDPERSONA, $USERNICK, $PASSWORD, $TIPOUSER))->insert('usuarios');
        if ($this->db->affected_rows() === 1) {
            return $this->db->insert_id();
        }
        return null;
    }

    public function update($IDUSUARIO, $IDPERSONA, $USERNICK, $PASSWORD, $TIPOUSER)
    {
        $this->db->set($this->_setUsuario($IDPERSONA, $USERNICK, $PASSWORD, $TIPOUSER))->where('IDUSUARIO', $IDUSUARIO)->update('usuarios');
        if ($this->db->affected_rows() === 1) {
            return true;
        }
        return null;
    }

    public function delete($IDUSUARIO)
    {
        $this->db->where('IDUSUARIO', $IDUSUARIO)->delete('usuarios');
        if ($this->db->affected_rows() === 1) {
            return true;
        }
        return null;
    }

    private function _setUsuario($IDPERSONA, $USERNICK, $PASSWORD, $TIPOUSER)
    {
        return array(
            'IDPERSONA' => $IDPERSONA,
            'USERNICK' => $USERNICK,
            'PASSWORD' => $PASSWORD,
            'TIPOUSER' => $TIPOUSER
        );
    }
}
