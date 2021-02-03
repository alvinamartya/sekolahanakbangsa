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
		$this->load->model('status_aksi_model');
    }

    public function index()
    {
        $aksi = $this->aksi_model->getAksiHome();
		$data_relawan = $this->relawan_model->countAll();
		$data_donatur = $this->donatur_model->countAll();
		$data_aksi = $this->aksi_model->countAksi();
		$data_donatur_aksi = $this->donatur_aksi_model->getSumDanaValid();
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
        $get = $this->input->get();

		$id = $this->session->id_donatur;
		$header['isLogin'] = $this->session->is_login == null ? false : $this->session->is_login;

		// include header
		$this->load->view('templates/donatur_header', $header);

		// donasi
		$data_aksi = $this->aksi_model->getAksiAll();
		$data['data_aksi'] = $data_aksi;
		$data_donatur_aksi = $this->donatur_aksi_model->getByIdDonatur($id);
		$data['data'] = $data_donatur_aksi;
		$data_status_aksi = $this->status_aksi_model->getByStatus();
		$data['status'] = $data_status_aksi;
		$this->load->view('home/donatur', $data);

		// inlcude footer
		$this->load->view('templates/donatur_footer');
    }

    public function aksi()
    {
		$header['isLogin'] = $this->session->is_login == null ? false : $this->session->is_login;
        // include header
		$this->load->view('templates/donatur_header', $header);

		// donasi
        $data['aksi'] = $this->aksi_model->getAksiHome();

		$this->load->view('home/aksi', $data);

		// inlcude footer
		$this->load->view('templates/donatur_footer');
    }

}
