<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Donatur_model extends CI_Model
{
    private $_table = "donatur";

    public function __construct()
    {
        parent::__construct();
    }

    public function getAll()
    {
        return $this->db->get_where($this->_table, ["row_status" => 'A'])->result();
    }

    public function getByID($id)
    {
        return $this->db->get_where($this->_table, ["id_donatur" => $id])->row();
    }

    public function save($data)
    {
        return $this->db->insert($this->_table, $data);
    }

    public function delete($id)
    {
        $this->row_status = 'D';
        $this->modidate = date("Y-m-d H:i:s");

        return $this->db->update($this->_table, $this, array('id_donatur' => $id));
    }

}