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

    // login view
    public function index()
    {
        // include header
        $this->load->view('templates/header');

        // data sekolah
        $data_sekolah = $this->sekolah_model->getSekolah();
        $data['sekolah'] = $data_sekolah;
        $this->load->view('sekolah/body', $data);

        // inlcude footer
        $this->load->view('sekolah/footer');
    }
}
