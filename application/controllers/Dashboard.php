<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    // constructor
    public function __construct()
    {
        parent::__construct();
        $this->load->model('karyawan_model');
        $this->load->model('relawan_model');
		$this->load->model('kebutuhan_tahunan_model');
		$this->load->model('sekolah_model');
				
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

    private function getRelawanName()
    {
        $this->load->model('relawan_model');
        $user_id = $this->session->user_id;
        $relawan = $this->relawan_model->getRelawanByUserLoginId($user_id);
        return $relawan->nama_relawan;
    }

    // view
    public function admin()
    {
        // set page title
        $header['title'] = "Dashboard Admin";

        // set employee 
        $header['name'] =  $this->getKaryawanName();
        $header['role'] =  $this->getKaryawanRole();
		
		$post = $this->input->post();
		if(Isset($post["id_sekolah"])){
			$id_sekolah = $post["id_sekolah"];
		}else{
			$sekolah = $this->sekolah_model->getSekolah();
			foreach($sekolah as $s){
				$id_sekolah = $s->id_sekolah;
				break;
			}
		}
		
		$kebutuhan_tahunan = $this->kebutuhan_tahunan_model->getKebutuhanTahunanByIdSekolah($id_sekolah);
		$sekolah = $this->sekolah_model->getSekolah();
		
		$data["kebutuhan_tahunan"] = $kebutuhan_tahunan;
		$data["sekolah"] = $sekolah;
		$data["id_sekolah"] = $id_sekolah;
		
        $this->load->view('templates/admin_header', $header);
		
        $this->load->view('dashboard/admin',$data);
		
        $this->load->view('templates/footer');
    }
	public function detail_kebutuhan()
	{
		// set page title
        $header['title'] = "Dashboard Admin";

        // set employee 
        $header['name'] =  $this->getKaryawanName();
        $header['role'] =  $this->getKaryawanRole();
		
		$post = $this->input->post();
		$id = $post["id"];
		
		$this->load->model('barang_model');
		$this->load->model('biaya_lainnya_model');
        $this->load->model('kt_barang_model');
		$this->load->model('kt_biaya_lainnya_model');
		
		
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
		
		$this->load->view('templates/admin_header', $header);
		
        $this->load->view('dashboard/detail_kebutuhan',$data);
		
        $this->load->view('templates/footer');
		
	}
    public function relawan()
    {
        $user_id = $this->session->user_id;
        $active = $this->relawan_model->getRelawanByUserLoginId($user_id)->id_sekolah != null;

        // set page title
        $header['title'] = "Dashboard Relawan";
        $header['name'] =  $this->getRelawanName();
        $header['active'] = $active;

        $this->load->view('templates/relawan_header', $header);
        $this->load->view('dashboard/relawan');
        $this->load->view('templates/footer');
    }
}
