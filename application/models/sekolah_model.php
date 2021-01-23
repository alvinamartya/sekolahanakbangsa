<?php
defined('BASEPATH') or exit('No direct script access allowed');

class sekolah_model extends CI_Model
{
    private $_table = "sekolah";

    public function getSekolah()
    {
        $where = array('row_status' => 'A');
        $query = $this->db
            ->from($this->_table)
            ->where($where)
            ->order_by('jenis_sekolah', 'asc')
            ->get();

        return $query->result();
    }

    public function add()
    {
        $data = $this->input->post();
        $insert_data = array(
            'nama_sekolah' => $data["nama_sekolah"],
            'jenis_sekolah' => $data["jenis_sekolah"],
            'alamat' => $data["alamat"],
            'provinsi' => $data["provinsi"],
            'kota' => $data["kota"],
            'creaby' => "Alvin Amarty",
            'modiby' => "Alvin Amartya",
        );

        return $this->db->insert($this->_table, $insert_data);
    }

    public function delete()
    {
        $delete = $this->input->post();
        $data = array('row_status' => 'D');
        return $this->db
            ->where('id_sekolah', $delete["id"])
            ->update($this->_table, $data);
    }
}
