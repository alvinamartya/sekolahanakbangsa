<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    // constructor
    public function __construct()
    {
        parent::__construct();
        $this->load->model('login_model');
    }

    // login view
    public function index()
    {
        $this->load->view('login');
    }

    public function login()
    {
        // get data post
        $data_login = $this->input->post();
        $data['l'] = $data_login;

        // get data by username
        $data_user = $this->login_model->getDataByUsername();

        // validate
        if (!isset($data_login['username']) || $data_login['username'] == "") {
            // username is not filled
            $data['err'] = 'Nama pengguna harus diisi!';
            $this->load->view('login', $data);
        } else if (!isset($data_login['password']) || $data_login['password'] == "") {
            // password is not filled
            $data['err'] = 'Kata sandi harus diisi!';
            $this->load->view('login', $data);
        } else if ($data_user != null) {
            if (password_verify($data_login['password'], $data_user->password)) {
                // create new session
                $this->session->set_userdata('user_id', $data_user->id);

                // redirect another page according to role user
                if ($data_user->role == 'Karyawan') {
                    // employee dashboard
                    echo '<script>alert("Karyawan ");</script>';
                } else if ($data_user->role == 'Donatur') {
                    // landing page
                    echo '<script>alert("Donatur");</script>';
                } else if ($data_user->role == 'Relawan') {
                    // volunteer dashboard
                    echo '<script>alert("Relawan");</script>';
                }
            } else {
                // incorrect password
                $data['err'] = 'Kata sandi salah!';
                $this->load->view('login', $data);
            }
        } else {
            // username is not found
            $data['err'] = 'Nama pengguna tidak ditemukan';
            $this->load->view('login', $data);
        }
    }
}
