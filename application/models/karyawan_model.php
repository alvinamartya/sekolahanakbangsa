<?php
defined('BASEPATH') or exit('No direct script access allowed');

class karyawan_model extends CI_Model
{
	// deklarasi nama table yang diolah
	private $_karyawan = "karyawan";

	public function getAllData()
	{
		// mengambil seluruh data dari table karyawan
		return $this->db->get($this->_karyawan)->result();
	}

	public function save()
	{
		// deklarasi variable dari post(), supaya lebih sederhana;
		$post = $this->input->post();

		// pengambilan data id terbaru dari table user_login
		$id = $this->db->query('select max(id) ID from user_login');

		// memasukkan id terbaru ke variable id_user_login
		foreach ($id->result() as $row) {
			$id_user_login =  $row->ID;
		}

		// memasukkan seluruh data post ke dalam variable yang akan disimpan
		$nama_karyawan = $post['nama_karyawan'];
		$jenis_kelamin = $post['jenis_kelamin'];
		$jabatan_karyawan = "Admin";
		$nik = $post['nik'];
		$no_telepon = $post['no_telepon'];
		$email = $post['email'];
		$tempat_lahir = $post['tempat_lahir'];
		$tanggal_lahir = $post['tanggal_lahir'];
		
		$user_id = $this->session->user_id;
		$karyawan = $this->karyawan_model->getKaryawanByUserLoginId($user_id);
		$creaby  = $karyawan->nama_karyawan;		
		
		$creadate = date('Y-m-d H:i:s');
		$modiby = '';
		$modidate = date('Y-m-d H:i:s');
		$row_status = 'A';

		// membuar array dari data yang akan diinputkan
		$data = array(
			'id_user_login' 	=> $id_user_login,
			'nama_karyawan'		=> $nama_karyawan,
			'jenis_kelamin'		=> $jenis_kelamin,
			'jabatan_karyawan'	=> $jabatan_karyawan,
			'nik'				=> $nik,
			'no_telepon'		=> $no_telepon,
			'email'				=> $email,
			'tempat_lahir'		=> $tempat_lahir,
			'tanggal_lahir'		=> $tanggal_lahir,
			'creaby'		=> $creaby,
			'creadate'		=> $creadate,
			'modiby'		=> $modiby,
			'modidate'		=> $modidate,
			'row_status'	=> $row_status
		);

		// return hasil inputan sekaligus menginput
		// 0 jika gagal, 1 jika berhasil
		return $this->db->insert($this->_karyawan, $data);
	}
	public function edit()
	{
		// deklarasi variable dari post(), supaya lebih sederhana;
		$post = $this->input->post();

		// insert seluruh data post ke variable yang akan diupdate
		$id_karyawan = $post['id_karyawan'];
		$id_user_login = $post['id_user_login'];
		$nama_karyawan = $post['nama_karyawan'];
		$jenis_kelamin = $post['jenis_kelamin'];
		$nik = $post['nik'];
		$no_telepon = $post['no_telepon'];
		$email = $post['email'];
		$tempat_lahir = $post['tempat_lahir'];
		$tanggal_lahir = $post['tanggal_lahir'];

		$user_id = $this->session->user_id;
		$karyawan = $this->karyawan_model->getKaryawanByUserLoginId($user_id);
		$modiby  = $karyawan->nama_karyawan;
		 
		$modidate = date('Y-m-d H:i:s');

		// memasukkan data ke dalam array
		$data = array(
			'nama_karyawan'		=> $nama_karyawan,
			'jenis_kelamin'		=> $jenis_kelamin,
			'nik'				=> $nik,
			'no_telepon'		=> $no_telepon,
			'email'				=> $email,
			'tempat_lahir'		=> $tempat_lahir,
			'tanggal_lahir'		=> $tanggal_lahir,
			'modiby'		=> $modiby,
			'modidate'		=> $modidate
		);

		// set query dengan where untuk menentukan data yang akan diupdate		
		$this->db->where('id_karyawan', $id_karyawan);

		// update data sekaligus mengembalikan nilai
		// 0 jika gagal, 1 jika berhasil
		return $this->db->update($this->_karyawan, $data);
	}
	public function hapus($id_karyawan)
	{		
		$user_id = $this->session->user_id;
		$karyawan = $this->karyawan_model->getKaryawanByUserLoginId($user_id);
		$modiby  = $karyawan->nama_karyawan;
		
		$modidate = date('Y-m-d H:i:s');

		// set data array yang akan diupdate
		// update row_status menjadi D ('Deactive') atau tidak aktif
		$data = array(
			'row_status' => 'D',
			'modiby' => $modiby,
			'modidate' => $modidate
		);

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
