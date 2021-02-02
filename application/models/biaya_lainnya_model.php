<?php
defined('BASEPATH') or exit('No direct script access allowed');

class biaya_lainnya_model extends CI_Model
{
    //memberikan nilai kevariable
    private $_table = "biaya_lainnya";

    //contruct
    public function __construct()
    {
        parent::__construct();
    }

    //edit data
    public function edit($id_biaya_lainnya, $data)
    {
        $this->db->where('id_biaya_lainnya', $id_biaya_lainnya);
        return $this->db->update($this->_table, $data);
    }

    //mengambil nilai
    public function getBiayaLainnya()
    {
        $query = $this->db
            ->from($this->_table)
            ->where(['row_status' => 'A'])
            ->order_by('nama_biaya_lainnya', 'asc')
            ->get();

        return $query->result();
    }

    //menyimpan data
    public function save($data)
    {
        return $this->db->insert($this->_table, $data);
    }

    //mengambil data berdasarkan id
    public function getBiayaLainnyaID($id_biaya_lainnya)
    {
        $result = $this->db->query('Select * from biaya_lainnya where id_biaya_lainnya = ' . $id_biaya_lainnya . '');
        return $result->row();
    }

    //menghapus data
    public function delete($id, $modiby)
    {
        $data = array('row_status' => 'D', 'modiby' => $modiby);
        return $this->db
            ->where('id_biaya_lainnya', $id)
            ->update($this->_table, $data);
    }
}
