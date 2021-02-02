<?php
defined('BASEPATH') or exit('No direct script access allowed');

class aksi_model extends CI_Model
{
    private $_table = "aksi";

    //contruct
    public function __construct()
    {
        parent::__construct();
    }

    public function getAksiByRelawan($id_relawan)
    {
        $query = $this->db
            ->from($this->_table)
            ->where(['id_relawan' => $id_relawan, 'row_status' => 'A'])
            ->order_by('tanggal_selesai', 'asc')
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

    public function getLastData()
    {
        return $this->db->order_by('id_aksi', "desc")->limit(1)->get($this->_table)->row();
    }

    public function getAksi($id)
    {
      $query = $this->db
              ->from($this->_table)
              ->where(['id_aksi' => $id])
              ->get();

          return $query->row();
    }
}
