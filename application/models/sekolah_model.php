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

    public function update($id, $data)
    {
        return $this->db
            ->where('id_sekolah', $id)
            ->update($this->_table, $data);
    }

    public function getByID($id)
    {
        return $this->db->get_where($this->_table, ["id_sekolah" => $id])->row();
    }

    public function delete($id, $modiby)
    {
        $data = array('row_status' => 'D');
        $data = array('modiby' => $modiby);
        return $this->db
            ->where('id_sekolah', $id)
            ->update($this->_table, $data);
    }
}
