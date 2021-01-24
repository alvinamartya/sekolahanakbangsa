<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sekolah extends CI_Controller
{
    // constructor
    public function __construct()
    {
        parent::__construct();
        $this->load->model('sekolah_model');
    }

    /*
    ==============================================================
    View School
    ==============================================================
    */
    public function index()
    {
        // include header
        $this->load->view('templates/admin_header');

        // data sekolah
        $data_sekolah = $this->sekolah_model->getSekolah();
        $data['sekolah'] = $data_sekolah;
        $this->load->view('sekolah/view/body', $data);

        // inlcude footer
        $this->load->view('sekolah/view/footer');
    }

    /*
    ==============================================================
    Add School
    ==============================================================
    */
    public function tambah()
    {
        $this->load->view('templates/header');
        $this->load->view('sekolah/add/body');
        $this->load->view('sekolah/add/footer');
    }

    public function tambah_action()
    {
        $input = $this->sekolah_model->add();

        if ($input > 0) $this->success();
        else $this->add_failed();
    }

    /*
    ==============================================================
    Delete School
    ==============================================================
    */
    function hapus()
    {
        $delete = $this->sekolah_model->delete();

        if ($delete > 0) $this->success();
        else $this->add_failed();
    }

    /*
    ==============================================================
    Response
    ==============================================================
    */
    function success()
    {
        redirect(site_url('sekolah'));
    }

    function add_failed()
    {
        echo "<script>alert('Input data Gagal')</script>";
    }
}
