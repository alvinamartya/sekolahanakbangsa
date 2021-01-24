<?php
defined('BASEPATH') or exit('No direct script access allowed');

class sekolah_model extends CI_Model
{
    private $_table = "sekolah";

    public function __construct()
    {
        parent::__construct();
    }

    public function getSekolah()
    {
        $query = $this->db
            ->from($this->_table)
            ->where(['row_status' => 'A'])
            ->order_by('jenis_sekolah', 'asc')
            ->get();

        return $query->result();
    }

    public function save($data)
    {
        return $this->db->insert($this->_table, $data);
    }

    public function delete($id, $modiby)
    {
        $delete = $this->input->post();
        $data = array('row_status' => 'D');
        return $this->db
            ->where('id_sekolah', $delete["id"])
            ->update($this->_table, $data);
    }
}
