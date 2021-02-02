<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('aksi_model');
    }

    public function index()
    {
        $aksi = $this->aksi_model->getAksiHome();
        $data['aksi'] = $aksi;
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
