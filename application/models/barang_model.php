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
    public function edit($modiby)
    {
        //menampung nilai array
        $post = $this->input->post();
        $id_barang = $post['id_barang'];
        $nama_barang = $post['nama_barang'];
        $deskripsi_barang = $post['deskripsi_barang'];

        $data = array(
            'nama_barang'        => $nama_barang,
            'deskripsi_barang'    => $deskripsi_barang,
            'modiby'            => $modiby
        );
        $this->db->where('id_barang', $id_barang);
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
        $delete = $this->input->post();
        $data = array('row_status' => 'D');
        return $this->db
            ->where('id_barang', $id)
            ->update($this->_table, $data);
    }
}
