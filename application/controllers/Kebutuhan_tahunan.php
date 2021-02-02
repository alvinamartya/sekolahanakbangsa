<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kebutuhan_tahunan extends CI_Controller
{

    // constructor
    public function __construct()
    {
        parent::__construct();
    }

    private function getRelawanName()
    {
        $this->load->model('relawan_model');
        $user_id = $this->session->user_id;
        $relawan = $this->relawan_model->getRelawanByUserLoginId($user_id);
        return $relawan->nama_relawan;
    }

    public function index()
    {
        $header['title'] = 'Kebutuhan Tahunan';
        $header['name'] =  $this->getRelawanName();
        $header['active'] = true;

        // include header
        $this->load->view('templates/relawan_header', $header);

        $this->load->view('kebutuhan_tahunan/index');

        // inlcude footer
        $this->load->view('templates/footer');
    }
}
