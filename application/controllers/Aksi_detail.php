<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Aksi_detail extends CI_Controller
{
    // constructor
    public function __construct()
    {
        parent::__construct();

        $this->load->model('barang_model');
        $this->load->model('aksi_barang_model');
        $this->load->model('aksi_biaya_lainnya_model');
        $this->load->model('aksi_model');
        $this->load->model('biaya_lainnya_model');
        $this->load->model('donatur_aksi_model');
        $this->load->model('gambar_aksi_model');
        $this->load->model('relawan_model');
    }

    public function index($id)
    {
        // include header
        $header['isLogin'] = $this->session->is_login == null ? false : $this->session->is_login;
        $this->load->view('templates/donatur_header', $header);

        // main
        $data_aksi = $this->aksi_model->getAksi($id);
        $data_barang = $this->barang_model->getBarang();
        $data_relawan = $this->relawan_model->getByID($id);
        $data_aksi_barang = $this->aksi_barang_model->getAksiBarangByIdAksi($id);
        $data_aksi_biaya_lainnya = $this->aksi_biaya_lainnya_model->getBiayaLainnyaByIdAksi($id);
        $data_biaya_lainnya = $this->biaya_lainnya_model->getBiayaLainnya();
        $data_donatur_aksi = $this->donatur_aksi_model->getDanaValidByIdAksi($id);
        $data_gambar_aksi = $this->gambar_aksi_model->getGambarByIdAksi($id);

        $data['data_aksi'] = $data_aksi;
        $data['data_barang'] = $data_barang;
        $data['data_relawan'] = $data_relawan;
        $data['data_aksi_barang'] = $data_aksi_barang;
        $data['data_aksi_biaya_lainnya'] = $data_aksi_biaya_lainnya;
        $data['data_biaya_lainnya'] = $data_biaya_lainnya;
        $data['data_donatur_aksi'] = $data_donatur_aksi;
        $data['data_gambar_aksi'] = $data_gambar_aksi;

        $this->load->view('home/aksi-detail', $data);

        // inlcude footer
        $this->load->view('templates/donatur_footer');
    }
}
