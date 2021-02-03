<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bantuan_sekolah extends CI_Controller
{
	// constructor
	public function __construct()
	{
		parent::__construct();

		//load ke model
		$this->load->model('kebutuhan_tahunan_model');
		$this->load->model('sekolah_model');
		$this->load->model('relawan_model');
		$this->load->model('barang_model');
		$this->load->model('biaya_lainnya_model');
		$this->load->model('kt_barang_model');
		$this->load->model('kt_biaya_lainnya_model');
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

	public function index()
	{
		// set page title
		$header['title'] = 'Konfirmasi Kebutuhan';

		// set employee
		$header['name'] =  $this->getKaryawanName();
		$header['role'] =  $this->getKaryawanRole();

		// include header
		$this->load->view('templates/admin_header', $header);

		$data_kebutuhan_tahunan = $this->kebutuhan_tahunan_model->getAllDataNotConfirm();
		$data_sekolah = $this->sekolah_model->getSekolah();
		$data_relawan = $this->relawan_model->getAll();

		$data['kebutuhan_tahunan'] = $data_kebutuhan_tahunan;
		$data['sekolah'] = $data_sekolah;
		$data['relawan'] = $data_relawan;

		$this->load->view('bantuan_sekolah/index', $data);

		// inlcude footer
		$this->load->view('templates/footer');
	}
	public function page_konfirmasi()
	{
		// set page title
		$header['title'] = 'Karyawan';

		// set employee
		$header['name'] =  $this->getKaryawanName();
		$header['role'] =  $this->getKaryawanRole();

		// include header
		$this->load->view('templates/admin_header', $header);


		$post = $this->input->post();
		$id = $post["id"];
		$data_kebutuhan_tahunan = $this->kebutuhan_tahunan_model->getKebutuhanTahunanById($id);
		$data_sekolah = $this->sekolah_model->getSekolahById($data_kebutuhan_tahunan->id_sekolah);
		$data_relawan = $this->relawan_model->getByID($data_kebutuhan_tahunan->id_relawan);
		$data_barang = $this->barang_model->getBarang();
		$data_biaya_lainnya = $this->biaya_lainnya_model->getBiayaLainnya();
		$data_kt_barang = $this->kt_barang_model->getKtBarangByIdKt($id);
		$data_kt_biaya_lainnya = $this->kt_biaya_lainnya_model->getKtBiayaLainnyaByIdKt($id);

		$data['kebutuhan_tahunan'] = $data_kebutuhan_tahunan;
		$data['sekolah'] = $data_sekolah;
		$data['relawan'] = $data_relawan;
		$data['barang'] = $data_barang;
		$data['biaya_lainnya'] = $data_biaya_lainnya;
		$data['kt_barang'] = $data_kt_barang;
		$data['kt_biaya_lainnya'] = $data_kt_biaya_lainnya;

		$this->load->view('bantuan_sekolah/page_konfirmasi', $data);

		// inlcude footer
		$this->load->view('templates/footer');
	}
	public function detail()
	{
		// set page title
		$header['title'] = 'Karyawan';

		// set employee
		$header['name'] =  $this->getKaryawanName();
		$header['role'] =  $this->getKaryawanRole();

		// include header
		$this->load->view('templates/admin_header', $header);


		$post = $this->input->post();
		$id = $post["id"];
		$data_kebutuhan_tahunan = $this->kebutuhan_tahunan_model->getKebutuhanTahunanById($id);
		$data_sekolah = $this->sekolah_model->getSekolahById($data_kebutuhan_tahunan->id_sekolah);
		$data_relawan = $this->relawan_model->getByID($data_kebutuhan_tahunan->id_relawan);
		$data_barang = $this->barang_model->getBarang();
		$data_biaya_lainnya = $this->biaya_lainnya_model->getBiayaLainnya();
		$data_kt_barang = $this->kt_barang_model->getKtBarangByIdKt($id);
		$data_kt_biaya_lainnya = $this->kt_biaya_lainnya_model->getKtBiayaLainnyaByIdKt($id);

		$data['kebutuhan_tahunan'] = $data_kebutuhan_tahunan;
		$data['sekolah'] = $data_sekolah;
		$data['relawan'] = $data_relawan;
		$data['barang'] = $data_barang;
		$data['biaya_lainnya'] = $data_biaya_lainnya;
		$data['kt_barang'] = $data_kt_barang;
		$data['kt_biaya_lainnya'] = $data_kt_biaya_lainnya;

		$this->load->view('bantuan_sekolah/detail', $data);

		// inlcude footer
		$this->load->view('templates/footer');
	}

	public function verifikasi()
	{
		$post = $this->input->post();
		$id = $post["id"];

		$modiby = $this->getKaryawanName();
		$modidate = date('Y-m-d H:i:s');

		$data = array(
			'is_approved' => 'Y',
			'modiby' => $modiby,
			'modidate' => $modidate
		);

		$this->kebutuhan_tahunan_model->update($id, $data);
		$this->index();
	}
	public function tolak()
	{
		$post = $this->input->post();
		$id = $post["id"];

		$modiby = $this->getKaryawanName();
		$modidate = date('Y-m-d H:i:s');

		$data = array(
			'is_approved' => 'N',
			'modiby' => $modiby,
			'modidate' => $modidate
		);

		$this->kebutuhan_tahunan_model->update($id, $data);
		$this->index();
	}
}
