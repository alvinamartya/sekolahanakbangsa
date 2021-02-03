<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sdm_relawan extends CI_Controller
{
    // constructor
    public function __construct()
    {
        parent::__construct();
        $this->load->model('relawan_model');
        $this->load->model('cluster_relawan_model');
        $this->load->model('sekolah_model');
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
    View Relawan
    ==============================================================
    */
    //menampilkan data relawan
    public function index()
    {
        // set page title
        $header['title'] = 'Pengelolaan SDM';

        // set employee 
        $header['name'] =  $this->getKaryawanName();
        $header['role'] =  $this->getKaryawanRole();

        // include header
        $this->load->view('templates/admin_header', $header);

        $data['sekolah'] = $this->sekolah_model->getSekolah();
        // data relawan
        $data['relawan'] = $this->relawan_model->getAllBySekolah();
        $this->load->view('sdm_relawan/index', $data);

        // inlcude footer
        $this->load->view('templates/footer');
    }

    /*
    ==============================================================
    Edit Relawan
    ==============================================================
    */
    public function ubah($id_relawan)
    {
        $data_relawan = $this->relawan_model->getByID($id_relawan);
        $this->loadUbah($data_relawan);
    }

    public function loadUbah($data_relawan)
    {
        // set page title
        $header['title'] = 'Pengelolaan SDM';

        // set employee 
        $header['name'] =  $this->getKaryawanName();
        $header['role'] =  $this->getKaryawanRole();

        // include header
        $this->load->view('templates/admin_header', $header);

        $data['sekolah'] = $this->sekolah_model->getSekolah();
        $data['r'] = $data_relawan;

        $this->load->view('sdm_relawan/edit', $data);

        // inlcude footer
        $this->load->view('templates/footer');
    }

    public function edit($id_relawan)
    {
        $post = $this->input->post();

        $cek=0;
        if($post['id_sekolah']==null){
            $cek=null;
        }else{
            $cek = $post['id_sekolah'];
        }
        // relawan data
        $sdm_relawan_data = [
            'nama_relawan' => $post['nama_relawan'],
            'id_sekolah' => $cek,
            'modiby' => $this->getKaryawanName(),
        ];

        // save donatur data
        $result = $this
            ->relawan_model
            ->update($id_relawan, $sdm_relawan_data);

        if ($result > 0) {
            // success message
            $this->session->set_flashdata("success", "Data Sekolah berhasil Ditambahakan");
            redirect(site_url('sdm_relawan/index'));
        } else {
            // error message
            $this->session->set_flashdata("failed", "Data Sekolah gagal Ditambahakan");
            redirect(site_url('sdm_relawan/index'));
        }
    }
}