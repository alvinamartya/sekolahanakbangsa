<?php
defined('BASEPATH') or exit('No direct script access allowed');

class aksi_model extends CI_Model
{
    private $_table = "aksi";

    public function __construct()
    {
        parent::__construct();
    }

    public function getAksi($id_relawan)
    {
        $query = $this->db
            ->from($this->_table)
            ->where(['id_relawan' => $id_relawan, 'row_status' => 'A'])
            ->order_by('creadate', 'desc')
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
            ->where('id_aksi', $id)
            ->update($this->_table, $data);
    }

    public function getByID($id)
    {
        return $this->db->get_where($this->_table, ["id_aksi" => $id])->row();
    }

    public function delete($id, $modiby)
    {
        $data = array('row_status' => 'D', 'modiby' => $modiby);
        return $this->db
            ->where('id_aksi', $id)
            ->update($this->_table, $data);
    }
}
