<?php
defined('BASEPATH') or exit('No direct script access allowed');

class siswa_model extends CI_Model
{
    //memberikan nilai kevariable
    private $_table = "siswa";

    //contruct
    public function __construct()
    {
        parent::__construct();
    }

    private function getRelawanName()
    {
        $this->load->model('relawan_model');
        $user_id = $this->session->user_id;
        $relawan = $this->relawan_model->getRelawanByUserLoginId($user_id);
        return $relawan->nama_relawan;
    }

    //edit data
    public function edit($id_siswa, $data)
    {
        $this->db->where('id_siswa', $id_siswa);
        return $this->db->update($this->_table, $data);
    }

    //mengambil nilai
    public function getSiswa()
    {
        $query = $this->db
            ->from($this->_table)
            ->where(['row_status' => 'A'])
            ->order_by('nama_siswa', 'asc')
            ->get();

        return $query->result();
    }

    //menyimpan data
    public function save($data)
    {
        return $this->db->insert($this->_table, $data);
    }

    //mengambil data berdasarkan id
    public function getSiswaID($id_siswa)
    {
        $result = $this->db->query('Select * from siswa where id_siswa = ' . $id_siswa . '');
        return $result->row();
    }

    //menghapus data
    public function delete($id, $modiby)
    {
        $data = array('row_status' => 'D', 'modiby' => $modiby);
        return $this->db
            ->where('id_siswa', $id)
            ->update($this->_table, $data);
    }
}
