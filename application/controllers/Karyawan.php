<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Karyawan extends CI_Controller
{
	// rules
	private $rules = [
		[
			'field' => 'nama_karyawan',
			'label' => 'Nama Karyawan',
			'rules' => 'required|callback_alpha_space'
		], [
			'field' => 'nik',
			'label' => 'NIK',
			'rules' => 'required|numeric|min_length[16]|max_length[16]'
		], [
			'field' => 'no_telepon',
			'label' => 'No Telepon',
			'rules' => 'required|numeric'
		], [
			'field' => 'email',
			'label' => 'Email Pengguna',
			'rules' => 'required|valid_email'
		], [
			'field' => 'tempat_lahir',
			'label' => 'Tempat Lahir',
			'rules' => 'required'
		], [
			'field' => 'tanggal_lahir',
			'label' => 'Tanggal Lahir',
			'rules' => 'required'
		], [
			'field' => 'username',
			'label' => 'Nama Pengguna',
			'rules' => 'required|is_unique[user_login.username]'
		], [
			'field' => 'password',
			'label' => 'Kata sandi',
			'rules' => 'required'
		], [
			'field' => 'ver_password',
			'label' => 'Konfirmasi Kata sandi',
			'rules' => 'required|matches[password]'
		]

	];
	private $edit_rules = [
		[
			'field' => 'nama_karyawan',
			'label' => 'Nama Karyawan',
			'rules' => 'required|callback_alpha_space'
		], [
			'field' => 'nik',
			'label' => 'NIK',
			'rules' => 'required|numeric|min_length[16]|max_length[16]'
		], [
			'field' => 'no_telepon',
			'label' => 'No Telepon',
			'rules' => 'required|numeric'
		], [
			'field' => 'email',
			'label' => 'Email Pengguna',
			'rules' => 'required|valid_email'
		], [
			'field' => 'tempat_lahir',
			'label' => 'Tempat Lahir',
			'rules' => 'required'
		], [
			'field' => 'tanggal_lahir',
			'label' => 'Tanggal Lahir',
			'rules' => 'required'
		]

	];

	public function alpha_space($str)
	{
		return (preg_match('/^[a-zA-Z ]+$/', $str) ? TRUE : FALSE);
	}

	// form rules error message
	private $errorMessage = [
		'is_unique' => '%s sudah terdaftar.',
		'required' => '%s wajib diisi.',
		'valid_email' => '%s bukan email yang valid.',
		'alpha_space' => '%s hanya bisa diisi dengan huruf.',
		'numeric' => '%s hanya bisa diisi dengan angka.',
		'matches' => '%s tidak sama',
		'min_length' => '%s harus terdiri dari 16 angka',
		'max_length' => '%s harus terdiri dari 16 angka'
	];
	// constructor
	public function __construct()
	{
		parent::__construct();
		$this->load->model('karyawan_model');
		$this->load->model('user_login_model');
		$this->load->model('login_model');

		// form validation
		$this->load->library('form_validation');

		// set error message
		$this->form_validation->set_message($this->errorMessage);
	}

	private function getKaryawanName()
	{
		$this->load->model('karyawan_model');
		$user_id = $this->session->user_id;
		$karyawan = $this->karyawan_model->getKaryawanByUserLoginId($user_id);
		return $karyawan->nama_karyawan;
	}

	private function getKaryawanRole()
	{
		$this->load->model('karyawan_model');
		$user_id = $this->session->user_id;
		$karyawan = $this->karyawan_model->getKaryawanByUserLoginId($user_id);
		return $karyawan->jabatan_karyawan;
	}

	// login view
	public function index()
	{
		// set page title
		$header['title'] = 'Karyawan';

		// set employee 
		$header['name'] =  $this->getKaryawanName();
		$header['role'] =  $this->getKaryawanRole();

		// include header
		$this->load->view('templates/admin_header', $header);

		// data karyawan
		$data_karyawan = $this->karyawan_model->getAllData();
		$data['karyawan'] = $data_karyawan;
		$this->load->view('karyawan/index', $data);

		// inlcude footer
		$this->load->view('templates/footer');
	}

	public function tambah()
	{
		// set page title
		$header['title'] = 'Tambah Karyawan';

		// set employee 
		$header['name'] =  $this->getKaryawanName();
		$header['role'] =  $this->getKaryawanRole();

		// include header
		$this->load->view('templates/admin_header', $header);

		$this->load->view('karyawan/add');

		// inlcude footer
		$this->load->view('templates/footer');
	}

	public function add()
	{
		$user_login = $this->user_login_model;

		// set rules
		$this->form_validation->set_rules($this->rules);

		if ($this->form_validation->run() == true) {
			$user_id = $this->session->user_id;
			$post = $this->input->post();
			$karyawan = $this->karyawan_model->getKaryawanByUserLoginId($user_id);

			//$id;
			$username = $post["username"];
			$password = password_hash($post["password"], PASSWORD_DEFAULT);
			$role = "Karyawan";
			$creaby = $karyawan->nama_karyawan;
			$creadate = date('Y-m-d H:i:s');
			$modiby = $karyawan->nama_karyawan;
			$modidate = date('Y-m-d H:i:s');
			$row_status = 'A';

			$data_user = array(
				'username' 		=> $username,
				'password'		=> $password,
				'role'			=> $role,
				'creaby'		=> $creaby,
				'creadate'		=> $creadate,
				'modiby'		=> $modiby,
				'modidate'		=> $modidate,
				'row_status'	=> $row_status
			);
			$result = $user_login->saveKaryawan($data_user);
			$last_user_login = $user_login->getLastUser();

			// memasukkan seluruh data post ke dalam variable yang akan disimpan
			$nama_karyawan = $post['nama_karyawan'];
			$jenis_kelamin = $post['jenis_kelamin'];
			$jabatan_karyawan = "Admin";
			$nik = $post['nik'];
			$no_telepon = $post['no_telepon'];
			$email = $post['email'];
			$tempat_lahir = $post['tempat_lahir'];
			$tanggal_lahir = $post['tanggal_lahir'];

			// membuar array dari data yang akan diinputkan
			$data_karyawan = array(
				'id_user_login' 	=> $last_user_login->id,
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

			$result2 = $this->karyawan_model->save($data_karyawan);
			if ($result > 0 && $result2 > 0) {
				$this->session->set_flashdata("success", "Data berhasil ditambahkan.");
				redirect(site_url('karyawan'));
			} else {
				$this->session->set_flashdata("failed", "Data gagal ditambahkan.");
				redirect(site_url('karyawan'));
			}
		} else {
			$this->tambah();
		}
	}

	public function ubah($id_karyawan)
	{
		//ambil data karyawan
		$data_karyawan = $this->karyawan_model->getKaryawan($id_karyawan);
		$this->ubahView($data_karyawan);
	}

	public function ubahView($data_karyawan)
	{
		// set page title
		$header['title'] = 'Ubah Karyawan';

		// set employee 
		$header['name'] =  $this->getKaryawanName();
		$header['role'] =  $this->getKaryawanRole();

		// include header
		$this->load->view('templates/admin_header', $header);
		$data['data'] = $data_karyawan;
		$this->load->view('karyawan/edit', $data);

		// inlcude footer
		$this->load->view('templates/footer');
	}

	public function edit()
	{
		//var_dump($this->form_validation->run());
		// set rules
		$this->form_validation->set_rules($this->edit_rules);

		if ($this->form_validation->run() == true) {
			// deklarasi variable dari post(), supaya lebih sederhana;
			$post = $this->input->post();

			// insert seluruh data post ke variable yang akan diupdate
			$id_karyawan = $post['id_karyawan'];
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

			$result = $this->karyawan_model->edit($id_karyawan, $data);
			if ($result > 0) {
				$this->session->set_flashdata("success", "Data berhasil diubah.");
				redirect(site_url('karyawan'));
			} else {
				$this->session->set_flashdata("failed", "Data gagal diubah.");
				redirect(site_url('karyawan'));
			}
		} else {
			//ketampilan tambah
			$data = $this->input->post();
			$this->ubahView((object)$data);
		}
	}

	public function hapus($id_karyawan)
	{
		$id_user_login = $this->karyawan_model->getKaryawan($id_karyawan)->id_user_login;

		$user_id = $this->session->user_id;
		$karyawan = $this->karyawan_model->getKaryawanByUserLoginId($user_id);
		$modiby  = $karyawan->nama_karyawan;
		$modidate = date('Y-m-d H:i:s');

		// set data array yang akan diupdate
		// update row_status menjadi D ('Deactive') atau tidak aktif
		$data_karyawan = array(
			'row_status' => 'D',
			'modiby' => $modiby,
			'modidate' => $modidate
		);

		$result = $this->karyawan_model->hapus($id_karyawan, $data_karyawan);

		$data_login = array(
			'modiby'		=> $modiby,
			'modidate'		=> $modidate,
			'row_status'	=> 'D',
		);
		$result2 = $this->login_model->delete($id_user_login, $data_login);

		if ($result > 0 && $result2 > 0) {
			$this->session->set_flashdata("success", "Data berhasil dihapus.");
			redirect(site_url('karyawan'));
		} else {
			$this->session->set_flashdata("success", "Data gagal dihapus.");
			redirect(site_url('karyawan'));
		}
	}
}
