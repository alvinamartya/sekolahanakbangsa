<?php
defined('BASEPATH') or exit('No direct script access allowed');

class barang_model extends CI_Model
{
    //memberikan nilai kevariable
    private $_table = "barang";

    //contruct
    public function __construct()
    {
        parent::__construct();
    }

    //edit data
    public function edit($id, $data)
    {
        $this->db->where('id_barang', $id);
        return $this->db->update($this->_table, $data);
    }

    //mengambil nilai
    public function getBarang()
    {
        $query = $this->db
            ->from($this->_table)
            ->where(['row_status' => 'A'])
            ->order_by('nama_barang', 'asc')
            ->get();

        return $query->result();
    }

    //menyimpan data
    public function save($data)
    {
        return $this->db->insert($this->_table, $data);
    }

    //mengambil data berdasarkan id
    public function getBarangID($id_barang)
    {
        $result = $this->db->query('Select * from barang where id_barang = ' . $id_barang . '');
        return $result->row();
    }

    //menghapus data
    public function delete($id, $modiby)
    {
        $data = array('row_status' => 'D', 'modiby' => $modiby);
        return $this->db
            ->where('id_barang', $id)
            ->update($this->_table, $data);
    }
}
