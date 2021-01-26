<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Karyawan extends CI_Controller
{
	// constructor
	public function __construct()
	{
		parent::__construct();
		$this->load->model('karyawan_model');
		$this->load->model('user_login_model');
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
		$karyawan = $this->karyawan_model;
		$user_login = $this->user_login_model;

		$result = $user_login->saveKaryawan();
		if ($result < 0) {
			$this->gagal();
			return;
		}
		$result = $karyawan->save();
		if ($result > 0) $this->sukses();
		else $this->gagal();
	}

	public function ubah($id_karyawan)
	{
		// set page title
		$header['title'] = 'Ubah Karyawan';

		// set employee 
		$header['name'] =  $this->getKaryawanName();
		$header['role'] =  $this->getKaryawanRole();

		// include header
		$this->load->view('templates/admin_header', $header);

		//ambil data karyawan
		$data_karyawan = $this->karyawan_model->getKaryawan($id_karyawan);
		$data['data'] = $data_karyawan;
		$this->load->view('karyawan/edit', $data);

		// inlcude footer
		$this->load->view('templates/footer');
	}

	public function edit()
	{
		$karyawan = $this->karyawan_model;

		$result = $karyawan->edit();
		if ($result > 0) $this->sukses();
		else $this->gagal();
	}

	public function hapus($id_karyawan)
	{
		$data_karyawan = $this->karyawan_model;
		$result = $data_karyawan->hapus($id_karyawan);
		if ($result > 0) $this->sukses();
		else $this->gagal();
	}

	function sukses()
	{
		redirect(base_url('Karyawan'));
	}
	function gagal()
	{
		echo "<script>alert('Input data gagal')</script>";
		redirect(base_url('Karyawan'));
	}
}
