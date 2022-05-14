<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Generos_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get()
    {
        $query = $this->db->select('*')->from('generos')->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }

        return null;
    }

}
