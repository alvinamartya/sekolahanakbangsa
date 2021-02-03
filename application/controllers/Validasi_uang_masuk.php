<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Validasi_uang_masuk extends CI_Controller
{
    // constructor
    public function __construct()
    {
        parent::__construct();
        $this->load->model('aksi_model');
        $this->load->model('donatur_aksi_model');
        $this->load->model('status_aksi_model');
        $this->load->model('donatur_model');
        $this->load->model('login_model');

        // form validation
        $this->load->library('form_validation');
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


    /*
    ==============================================================
    View Validasi Uang Masuk
    ==============================================================
    */
    //menampilkan data relawan
    public function index()
    {
        // set page title
        $header['title'] = 'Validasi Uang Masuk';

        // set employee 
        $header['name'] =  $this->getKaryawanName();
        $header['role'] =  $this->getKaryawanRole();

        // include header
        $this->load->view('templates/admin_header', $header);

        $data_aksi = $this->aksi_model->getAksiAll();
        $data_status = $this->status_aksi_model->getByStatus();
        $data_donatur = $this->donatur_model->getAll();

        $data['data_aksi'] = $data_aksi;
        $data['donatur'] = $data_donatur;
        $data['status'] = $data_status;
        // data donatur_aksi
        $data['donatur_aksi'] = $this->donatur_aksi_model->getAll();
        $this->load->view('validasi_uang_masuk/index', $data);

        // inlcude footer
        $this->load->view('templates/footer');
    }

    /*
    ==============================================================
    Edit Relawan
    ==============================================================
    */
    public function ubah($id)
    {
        $data_donatur_aksi = $this->donatur_aksi_model->getByID($id);
        $this->loadUbah($data_donatur_aksi);
    }

    public function loadUbah($data_donatur_aksi)
    {
        // set page title
        $header['title'] = 'Validasi Uang Masuk';

        // set employee 
        $header['name'] =  $this->getKaryawanName();
        $header['role'] =  $this->getKaryawanRole();

        // include header
        $this->load->view('templates/admin_header', $header);

        //load data
        $data_aksi = $this->aksi_model->getAksiAll();
        $data_donatur = $this->donatur_model->getAll();

        $data['data_aksi'] = $data_aksi;
        $data['donatur'] = $data_donatur;
        $data['donatur_aksi'] = $data_donatur_aksi;

        $this->load->view('validasi_uang_masuk/edit', $data);

        // inlcude footer
        $this->load->view('templates/footer');
    }

    public function edit($id)
    {
        $post = $this->input->post();
        $id_status = 0;
        if ($post['is_valid'] == 'Y') {
            $id_status = 3;
        } else {
            $id_status = 4;
        }

        $data = [
            'is_valid' => $post['is_valid'],
            'id_status_aksi' => $id_status,
            'modiby' => $this->getKaryawanName(),
        ];

        // save donatur data
        $result = $this
            ->donatur_aksi_model
            ->update($id, $data);

        if ($result > 0) {
            // success message
            $this->session->set_flashdata("success", "Ubah data berhasil");
            redirect(site_url('validasi_uang_masuk/index'));
        } else {
            // error message
            $this->session->set_flashdata("failed", "Ubah data gagal");
            redirect(site_url('validasi_uang_masuk/index'));
        }
    }
}
