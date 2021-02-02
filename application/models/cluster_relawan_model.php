<?php
defined('BASEPATH') or exit('No direct script access allowed');

class cluster_relawan_model extends CI_Model
{
	// deklarasi nama table yang diolah
	private $_cluster = "cluster_relawan";

	public function getAllData()
	{
		// mengambil seluruh data dari table cluster_relawan
		return $this->db->get_where($this->_cluster, ["row_status" => 'A'])->result();
	}

	public function save($data)
	{
		return $this->db->insert($this->_cluster, $data);
	}

	public function edit($id_cluster_relawan, $data)
	{
		// set query dengan where untuk menentukan data yang akan diupdate
		$this->db->where('id_cluster_relawan', $id_cluster_relawan);

		// update data sekaligus mengembalikan nilai
		// 0 jika gagal, 1 jika berhasil
		return $this->db->update($this->_cluster, $data);
	}

	public function hapus($id_cluster_relawan, $data)
	{
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
