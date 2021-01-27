<?php
defined('BASEPATH') or exit('No direct script access allowed');

class cluster_relawan_model extends CI_Model
{
	// deklarasi nama table yang diolah
	private $_cluster = "cluster_relawan";

	public function getAllData()
	{
		// mengambil seluruh data dari table cluster_relawan
		return $this->db->get($this->_cluster)->result();
	}

	public function save()
	{
		// deklarasi variable dari post(), supaya sederhana
		$post = $this->input->post();

		// memasukkan seluruh data post ke dalam variable yang akan diinputkan
		$nama_cluster = $post['nama_cluster'];
		$deskripsi_cluster = $post['deskripsi_cluster'];

		$user_id = $this->session->user_id;
		$karyawan = $this->karyawan_model->getKaryawanByUserLoginId($user_id);
		$creaby  = $karyawan->nama_karyawan;		
		
		$creadate = date('Y-m-d H:i:s');
		$modiby = '';
		$modidate = date('Y-m-d H:i:s');
		$row_status = 'A';

		// membuat array dari data inputan
		$data = array(
			'nama_cluster'	=> $nama_cluster,
			'deskripsi_cluster' => $deskripsi_cluster,
			'creaby'		=> $creaby,
			'creadate'		=> $creadate,
			'modiby'		=> $modiby,
			'modidate'		=> $modidate,
			'row_status'	=> $row_status
		);

		// return hasil inputan sekaligus menginput
		// 0 jika gagal, 1 jika berhasil
		return $this->db->insert($this->_cluster, $data);
	}

	public function edit()
	{
		// deklarasi variable dari post(), supaya lebih sederhana;
		$post = $this->input->post();

		// insert seluruh data post ke variable yang akan diupdate
		$id_cluster_relawan = $post['id_cluster_relawan'];
		$nama_cluster = $post['nama_cluster'];
		$deskripsi_cluster = $post['deskripsi_cluster'];

		$user_id = $this->session->user_id;
		$karyawan = $this->karyawan_model->getKaryawanByUserLoginId($user_id);
		$modiby  = $karyawan->nama_karyawan;		
		
		$modidate = date('Y-m-d H:i:s');

		// memasukkan data ke dalam array
		$data = array(
			'nama_cluster'		=> $nama_cluster,
			'deskripsi_cluster'		=> $deskripsi_cluster,
			'modiby'				=> $modiby,
			'modidate'		=> $modidate
		);

		// set query dengan where untuk menentukan data yang akan diupdate
		$this->db->where('id_cluster_relawan', $id_cluster_relawan);

		// update data sekaligus mengembalikan nilai
		// 0 jika gagal, 1 jika berhasil
		return $this->db->update($this->_cluster, $data);
	}

	public function hapus($id_cluster_relawan)
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
		$this->db->where('id_cluster_relawan', $id_cluster_relawan);

		// update data sekaligus mengembalikan nilai
		// 0 jika gagal, 1 jika berhasil
		return $this->db->update($this->_cluster, $data);
	}

	public function getCluster($id_cluster_relawan)
	{
		// mengambil data sesuai dengan id_cluster_relawan
		$result = $this->db->query('Select * from cluster_relawan where id_cluster_relawan = ' . $id_cluster_relawan . '');

		// mengembalikan hasil query dalam bentuk row
		return $result->row();
	}
}
