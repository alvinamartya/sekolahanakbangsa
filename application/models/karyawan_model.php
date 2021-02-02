<?php
defined('BASEPATH') or exit('No direct script access allowed');

class karyawan_model extends CI_Model
{
	// deklarasi nama table yang diolah
	private $_karyawan = "karyawan";

	public function getAllData()
	{
		// mengambil seluruh data dari table karyawan
		return $this->db
			->where('row_status', 'A')
			->where('jabatan_karyawan', 'Admin')
			->get($this->_karyawan)
			->result();
	}

	public function save($data)
	{
		// return hasil inputan sekaligus menginput
		// 0 jika gagal, 1 jika berhasil
		return $this->db->insert($this->_karyawan, $data);
	}
	public function edit($id_karyawan, $data)
	{
		// set query dengan where untuk menentukan data yang akan diupdate		
		$this->db->where('id_karyawan', $id_karyawan);

		// update data sekaligus mengembalikan nilai
		// 0 jika gagal, 1 jika berhasil
		return $this->db->update($this->_karyawan, $data);
	}

	public function hapus($id_karyawan, $data)
	{
		// set query dengan where untuk menentukan data yang akan diupdate
		$this->db->where('id_karyawan', $id_karyawan);

		// update data sekaligus mengembalikan nilai
		// 0 jika gagal, 1 jika berhasil
		return $this->db->update($this->_karyawan, $data);
	}

	public function getKaryawan($id_karyawan)
	{
		// mengambil data sesuai dengan id_karyawan
		$result = $this->db->query('Select * from karyawan where id_karyawan = ' . $id_karyawan . '');

		// mengembalikan hasil query dalam bentuk row
		return $result->row();
	}

	public function getKaryawanByUserLoginId($idUserLoginId)
	{
		return $this->db
			->get_where($this->_karyawan, ["id_user_login" => $idUserLoginId])
			->row();
	}
}
