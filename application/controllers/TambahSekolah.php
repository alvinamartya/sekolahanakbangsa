<?php
defined('BASEPATH') or exit('No direct script access allowed');

class TambahSekolah extends CI_Controller
{
    // view
    public function index()
    {
        $this->load->view('templates/header');
        $this->load->view('tambah_sekolah/body');
        $this->load->view('tambah_sekolah/footer');
    }
}
