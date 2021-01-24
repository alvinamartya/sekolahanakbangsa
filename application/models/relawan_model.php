<?php
defined('BASEPATH') or exit('No direct script access allowed');

class relawan_model extends CI_Model
{
    //memberikan nilai 
    private $_table = "relawan";

    //contruct
    public function __construct()
    {
        parent::__construct();
    }

    //mengambil nilai
    public function getRelawan()
    {
        $query = $this->db
            ->from($this->_table)
            ->where(['row_status' => 'A'])
            ->order_by('nama_relawan', 'asc')
            ->get();

        return $query->result();
    }

    //menyimpan data
    public function save($data)
    {
        return $this->db->insert($this->_table, $data);
    }

    //ubah data
    public function edit()
	{
		$post = $this->input->post();
		$id_relawan = $post['id_relawan'];
		$nama_relawan = $post['nama_relawan'];
		$jenis_kelamin = $post['jenis_kelamin'];
		$nik = $post['nik'];
		$tempat_lahir = $post['tempat_lahir'];
        $tanggal_lahir = $post['tanggal_lahir'];
        $email = $post['email'];
        $no_telepon = $post['no_telepon'];
		$modiby = 'firmansyah';

		$data = array(
			'nama_relawan'		=> $nama_relawan,
			'jenis_kelamin'		=> $jenis_kelamin,
            'nik'				=> $nik,
            'email'				=> $email,
            'no_telepon'		=> $no_telepon,
			'tempat_lahir'		=> $tempat_lahir,
			'tanggal_lahir'		=> $tanggal_lahir,
			'modidate'		    => $modidate
		);
		$this->db->where('id_relawan', $id_relawan);
		return $this->db->update($this->_table, $data);
	}

    //mengambil data berdasarkan id
    public function getRelawanID($id_relawan)
	{
		$result = $this->db->query('Select * from relawan where id_relawan = ' . $id_relawan . '');
		return $result->row();
	}

    //menghapus data
    public function delete($id, $modiby)
    {
        $delete = $this->input->post();
        $data = array('row_status' => 'D');
        return $this->db
            ->where('id_relawan', $id)
            ->update($this->_table, $data);
    }
}
