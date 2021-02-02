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
	public function getAllDataNotConfirm()
	{
		$query = $this->db
            ->from($this->_table)
            ->where(['is_approved' => null])
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
	public function update($id, $data)
	{
		return $this->db
            ->where('id', $id)
            ->update($this->_table, $data);
	}
}
