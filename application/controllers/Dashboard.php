<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    // constructor
    public function __construct()
    {
        parent::__construct();
        $this->load->model('karyawan_model');
        $this->load->model('relawan_model');
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

    private function getRelawanName()
    {
        $this->load->model('relawan_model');
        $user_id = $this->session->user_id;
        $relawan = $this->relawan_model->getRelawanByUserLoginId($user_id);
        return $relawan->nama_relawan;
    }

    // view
    public function admin()
    {
        // set page title
        $header['title'] = "Dashboard Admin";

        // set employee 
        $header['name'] =  $this->getKaryawanName();
        $header['role'] =  $this->getKaryawanRole();

        $this->load->view('templates/admin_header', $header);
        $this->load->view('dashboard/admin');
        $this->load->view('templates/footer');
    }

    public function relawan()
    {
        $user_id = $this->session->user_id;
        $active = $this->relawan_model->getRelawanByUserLoginId($user_id)->id_sekolah != null;

        // set page title
        $header['title'] = "Dashboard Relawan";
        $header['name'] =  $this->getRelawanName();
        $header['active'] = $active;

        $this->load->view('templates/relawan_header', $header);
        $this->load->view('dashboard/relawan');
        $this->load->view('templates/footer');
    }
}
