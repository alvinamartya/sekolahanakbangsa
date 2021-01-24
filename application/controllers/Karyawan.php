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

	// login view
	public function index()
	{
		// include header
		$this->load->view('templates/admin_header');

		// data karyawan
		$data_karyawan = $this->karyawan_model->getAllData();
		$data['karyawan'] = $data_karyawan;
		$this->load->view('karyawan/_view', $data);

		// inlcude footer
		$this->load->view('karyawan/footer');
	}

	public function page_tambah()
	{
		// include header
		$this->load->view('templates/admin_header');

		$this->load->view('karyawan/_add');

		// inlcude footer
		$this->load->view('karyawan/footer');
	}
	public function tambah()
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
	public function page_edit($id_karyawan)
	{
		// include header
		$this->load->view('templates/admin_header');

		//ambil data karyawan
		$data_karyawan = $this->karyawan_model->getKaryawan($id_karyawan);
		$data['data'] = $data_karyawan;
		$this->load->view('karyawan/_edit', $data);

		// inlcude footer
		$this->load->view('karyawan/footer');
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
