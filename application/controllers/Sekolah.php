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
        $this->load->view('templates/header');
        $this->load->view('sekolah');
        $this->load->view('templates/footer');
    }
}
