<?php
defined('BASEPATH') or exit('No direct script access allowed');

class cluster_relawan_model extends CI_Model
{
	private $_cluster = "cluster_relawan";


	public function getAllData()
	{
		return $this->db
			->order_by('nama_cluster', 'asc')
			->get($this->_cluster)
			->result();
	}

	public function save()
	{

		$post = $this->input->post();
		//$id_cluster_relawan;		
		$nama_cluster = $post['nama_cluster'];
		$deskripsi_cluster = $post['deskripsi_cluster'];
		$creaby  = 'user_login';
		$creadate = date('Y-m-d H:i:s');
		$modiby = '';
		$modidate = date('Y-m-d H:i:s');
		$row_status = 'A';

		$data = array(
			'nama_cluster'	=> $nama_cluster,
			'deskripsi_cluster' => $deskripsi_cluster,
			'creaby'		=> $creaby,
			'creadate'		=> $creadate,
			'modiby'		=> $modiby,
			'modidate'		=> $modidate,
			'row_status'	=> $row_status
		);

		return $this->db->insert($this->_cluster, $data);
	}
	public function edit()
	{

		$post = $this->input->post();
		$id_cluster_relawan = $post['id_cluster_relawan'];
		$nama_cluster = $post['nama_cluster'];
		$deskripsi_cluster = $post['deskripsi_cluster'];
		$modiby = 'user_login';
		$modidate = date('Y-m-d H:i:s');

		$data = array(
			'nama_cluster'		=> $nama_cluster,
			'deskripsi_cluster'		=> $deskripsi_cluster,
			'modiby'				=> $modiby,
			'modidate'		=> $modidate
		);
		$this->db->where('id_cluster_relawan', $id_cluster_relawan);
		return $this->db->update($this->_cluster, $data);
	}
	public function hapus($id_cluster_relawan)
	{
		$data = array(
			'row_status' => 'D'
		);
		$this->db->where('id_cluster_relawan', $id_cluster_relawan);
		return $this->db->update($this->_cluster, $data);
	}
	public function getCluster($id_cluster_relawan)
	{
		$result = $this->db->query('Select * from cluster_relawan where id_cluster_relawan = ' . $id_cluster_relawan . '');
		return $result->row();
	}
}
