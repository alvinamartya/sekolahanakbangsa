<?php
defined('BASEPATH') or exit('No direct script access allowed');

class user_login_model extends CI_Model
{
	private $_user_login = "user_login";

	public function getAllData()
	{
		return $this->db->get($this->_user_login)->result();
	}

	public function saveKaryawan($data)
	{
		return $this->db->insert($this->_user_login, $data);
	}

	public function getLastUser()
	{
		return $this->db
			->order_by('id', 'desc')
			->get($this->_user_login)
			->row();
	}

	public function edit($id, $data)
	{
		$this->db->where('id', $id);
		return $this->db->update($this->_user_login, $data);
	}

	public function hapus($id, $data)
	{

		$this->db->where('id', $id);
		return $this->db->update($this->_user_login, $data);
	}

	public function getUser($id)
	{
		$result = $this->db->query('Select * from user_login where id = ' . $id . '');
		return $result->row();
	}
}
