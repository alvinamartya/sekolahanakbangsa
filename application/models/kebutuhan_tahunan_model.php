<?php
defined('BASEPATH') or exit('No direct script access allowed');

class kebutuhan_tahunan_model extends CI_Model
{
    //memberikan nilai kevariable
    private $_table = "kebutuhan_tahunan";

    //contruct
    public function __construct()
    {
        parent::__construct();
    }

    //mengambil nilai
    public function getKebutuhanTahunanByIdSekolah($id)
    {
        $query = $this->db
            ->from($this->_table)
            ->where(['id_sekolah' => $id])
            ->order_by('tahun', 'asc')
            ->get();

        return $query->result();
    }

    public function getApprovedKebutuhanTahunanByIdSekolah($id)
    {
        $query = $this->db
            ->from($this->_table)
            ->where(['id_sekolah' => $id, 'kt_status' => 'Disetujui'])
            ->order_by('tahun', 'asc')
            ->get();

        return $query->result();
    }

    public function getKebutuhanTahunanByRelawan($id_relawan)
    {
        $query = $this->db
            ->from($this->_table)
            ->where(['id_relawan' => $id_relawan, 'row_status' => 'A'])
            ->order_by('tahun', 'asc')
            ->order_by('kt_status', 'asc')
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
            ->where('id', $id)
            ->update($this->_table, $data);
    }

    public function getByID($id)
    {
        return $this->db->get_where($this->_table, ["id" => $id])->row();
    }

    public function delete($id, $modiby)
    {
        $data = array('row_status' => 'D', 'modiby' => $modiby);
        return $this->db
            ->where('id', $id)
            ->update($this->_table, $data);
    }

    public function getLastData()
    {
        return $this->db->order_by('id', "desc")->limit(1)->get($this->_table)->row();
    }

    public function getKebutuhanTahunanByYearAndSchool($year, $id_sekolah)
    {
        $query = $this->db
            ->from($this->_table)
            ->where(['tahun' => $year, 'id_sekolah' => $id_sekolah, 'kt_status' => 'Disetujui'])
            ->get();

        return $query->row();
    }

    public function getKebutuhanTahunanByYearAndSchoolProcess($year, $id_sekolah)
    {
        $query = $this->db
            ->from($this->_table)
            ->where(['tahun' => $year, 'id_sekolah' => $id_sekolah, 'kt_status' => 'Menunggu Persetujuan'])
            ->get();

        return $query->row();
    }

    public function getKebutuhanTahunanByYearAndSchoolAll($year, $id_sekolah)
    {
        $query = $this->db
            ->from($this->_table)
            ->where(['tahun' => $year, 'id_sekolah' => $id_sekolah])
            ->get();

        return $query->row();
    }

    public function getKebutuhanTahunan($id)
    {
        $query = $this->db
            ->from($this->_table)
            ->where(['id' => $id])
            ->get();

        return $query->row();
    }

    public function getAllDataNotConfirm()
    {
        $query = $this->db
            ->from($this->_table)
            ->where(['kt_status' => 'Menunggu Persetujuan'])
            ->order_by('tahun', 'asc')
            ->get();

        return $query->result();
    }

    public function getAllDataConfirmed()
    {
        $query = $this->db
            ->from($this->_table.' a')
            ->join('sekolah s', 's.id_sekolah = a.id_sekolah')
            ->where(['kt_status' => 'Diterima'])
            ->order_by('tahun', 'asc')
            ->get();

        return $query->result();
    }

    public function getKebutuhanTahunanById($id)
    {
        $query = $this->db
            ->from($this->_table)
            ->where(['id' => $id])
            ->get();

        return $query->row();
    }
}
