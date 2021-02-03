<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Status_aksi_model extends CI_Model
{
    private $_table = "status_aksi";

    public function __construct()
    {
        parent::__construct();
    }
    
    public function getByID($id)
    {
        return $this->db->get_where($this->_table, ["id_status_aksi" => $id])->row();
    }

    public function getByStatus()
    {
        $query = $this->db
            ->from($this->_table)
            ->get();

        return $query->result();
    }
}
