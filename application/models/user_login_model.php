<?php
defined('BASEPATH') or exit('No direct script access allowed');

class user_login_model extends CI_Model
{
    private $_user_login = "user_login";
	private $_karyawan = "karyawan";

    public function getAllData()
    {        
        return $this->db->get($this->_user_login)->result();
    }
	
	public function saveKaryawan()
	{
		$post = $this->input->post();
		//$id;
		$username = $post["username"];
		$password = password_hash($post["username"],PASSWORD_DEFAULT);
		$role = "Karyawan";
		$creaby = "user_login";
		$creadate = date('Y-m-d H:i:s');
		$modiby = '';
		$modidate = date('Y-m-d H:i:s');
		$row_status = 'A';
		
		$data = array(
				'username' 		=> $username,
				'password'		=> $password,
				'role'			=> $role,
				'creaby'		=> $creaby,
				'creadate'		=> $creadate,
				'modiby'		=> $modiby,
				'modidate'		=> $modidate,
				'row_status'	=> $row_status
		);
			
		return $this->db->insert($this->_user_login, $data);
	}
	public function edit()
	{
		$post = $this->input->post();
		$id = $post["id"];
		$username = $post["username"];
		$password = password_hash($post["username"],PASSWORD_DEFAULT);				
		$modiby = 'user_login';
		$modidate = date('Y-m-d H:i:s');		
		
		$data = array(				
				'password'		=> $password,
				'modiby'		=> $modiby,
				'modidate'		=> $modidate				
		);
		$this->db->where('id',$id);
		return $this->db->update($this->_user_login, $data);
	}
	public function hapus($id)
	{
		$post = $this->input->post();
		$id = $post["id"];		
		$modiby = 'user_login';
		$modidate = date('Y-m-d H:i:s');		
		$row_status = "D";
		
		$data = array(								
				'modiby'		=> $modiby,
				'modidate'		=> $modidate,
				'row_status'	=> $row_status
		);
		$this->db->where('id',$id);
		return $this->db->update($this->_user_login, $data);
	}
	public function getUser($id)
	{
		$result = $this->db->query('Select * from user_login where id = '.$id.'');
		return $result->row();
	}
}

