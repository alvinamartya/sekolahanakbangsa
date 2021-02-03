<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('aksi_model');
		$this->load->model('relawan_model');
		$this->load->model('donatur_model');
		$this->load->model('donatur_aksi_model');
    }

    public function index()
    {
        $aksi = $this->aksi_model->getAksiHome();
		$data_relawan = $this->relawan_model->countAll();
		$data_donatur = $this->donatur_model->countAll();
		$data_aksi = $this->aksi_model->countAksi();
		$data_donatur_aksi = $this->donatur_aksi_model->getAllDanaValid();
		
        $data['aksi'] = $aksi;
		$data['jumlah_relawan'] = $data_relawan;
		$data['jumlah_donatur'] = $data_donatur;
		$data['jumlah_aksi'] = $data_aksi;
		$data['total_donasi'] = $data_donatur_aksi;
		
        $data['isLogin'] = $this->session->is_login == null ? false : $this->session->is_login;
        $this->load->view('index', $data);
    }

    public function donatur()
    {
        $this->load->view('home/donatur');
    }

    public function pembayaran()
    {
        $this->load->view('home/pembayaran');
    }

    public function upload_bukti()
    {
        $this->load->view('home/upload-bukti');
    }
}
