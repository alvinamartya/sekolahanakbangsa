<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Relawan_model extends CI_Model
{
    private $_table = "relawan";

    public function __construct()
    {
        parent::__construct();
    }

    public function getAll()
    {
        return $this->db
            ->where('row_status', 'A')
            ->order_by('nama_relawan', 'asc')
            ->get($this->_table)
            ->result();
    }

    public function getByID($id)
    {
        return $this->db->get_where($this->_table, ["id_relawan" => $id])->row();
    }

    public function save($data)
    {
        return $this->db->insert($this->_table, $data);
    }

    public function update($id, $data)
    {
        return $this->db
            ->where('id_relawan', $id)
            ->update($this->_table, $data);
    }


    public function delete($id, $modiby)
    {
        $this->row_status = 'D';
        $this->modidate = date("Y-m-d H:i:s");
        $this->modiby = $modiby;

        return $this->db->update($this->_table, $this, array('id_relawan' => $id));
    }

    public function getRelawanByUserLoginId($idUserLoginId)
    {
        return $this->db
            ->get_where($this->_table, ["id_user_login" => $idUserLoginId])
            ->row();
    }
}
