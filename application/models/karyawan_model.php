<?php
defined('BASEPATH') or exit('No direct script access allowed');

class karyawan_model extends CI_Model
{
    private $_karyawan = "karyawan";
	

    public function getAllData()
    {        
        return $this->db->get($this->_karyawan)->result();
    }
	
	public function save()
	{
		$post = $this->input->post();
		//$id_karyawan;
		$id = $this->db->query('select max(id) ID from user_login');				
		foreach ($id->result() as $row)
		{
			$id_user_login =  $row->ID;
		}		
		$nama_karyawan = $post['nama_karyawan'];
		$jenis_kelamin = $post['jenis_kelamin'];
		$jabatan_karyawan = "Admin";
		$nik = $post['nik'];
		$no_telepon = $post['no_telepon'];
		$email = $post['email'];
		$tempat_lahir = $post['tempat_lahir'];
		$tanggal_lahir = $post['tanggal_lahir'];
		$creaby  = 'user_login';
		$creadate = date('Y-m-d H:i:s');
		$modiby = '';
		$modidate = date('Y-m-d H:i:s');
		$row_status = 'A';
		
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
		/*$query = $this->db->query('insert into karyawan values(DEFAULT,$id_user_login,$nama_karyawan,
		$jenis_kelamin,$jabatan_karyawan,$nik,$no_telepon,$email,$tempat_lahir,$tanggal_lahir,$creaby,$creadate,
		$modiby,$modidate,$row_status)');
		return $query;*/
		return $this->db->insert($this->_karyawan, $data);
	}
	public function edit()
	{
		$post = $this->input->post();
		$id_karyawan = $post['id_karyawan'];	
		$id_user_login = $post['id_user_login'];
		$nama_karyawan = $post['nama_karyawan'];
		$jenis_kelamin = $post['jenis_kelamin'];		
		$nik = $post['nik'];
		$no_telepon = $post['no_telepon'];
		$email = $post['email'];
		$tempat_lahir = $post['tempat_lahir'];
		$tanggal_lahir = $post['tanggal_lahir'];				
		$modiby = 'user_login';
		$modidate = date('Y-m-d H:i:s');		
		
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
		$this->db->where('id_karyawan',$id_karyawan);
		return $this->db->update($this->_karyawan, $data);
		
	}
	public function hapus($id_karyawan)
	{
		$data = array(					
			'row_status' => 'D'
		);
		$this->db->where('id_karyawan', $id_karyawan);
		return $this->db->update($this->_karyawan,$data);
	}
	public function getKaryawan($id_karyawan)
	{
		$result = $this->db->query('Select * from karyawan where id_karyawan = '.$id_karyawan.'');
		return $result->row();
	}
}


