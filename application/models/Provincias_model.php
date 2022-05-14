<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Provincias_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get()
    {
        $query = $this->db->select('*')->from('provincia')->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }

        return null;
    }

    public function getcantones($IDPROVINCIA)
    {
        $query = $this->db->select('*')->from('cantones')->where('IDPROVINCIA', $IDPROVINCIA)->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }

        return null;
    }
}
