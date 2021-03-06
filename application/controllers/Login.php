<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    // constructor
    public function __construct()
    {
        parent::__construct();
        $this->load->model('login_model');
        $this->load->model('donatur_model');
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
                if ($data_user->row_status == 'A') {
                    // create new session
                    $session_arr = array('user_id' => $data_user->id, 'role' => $data_user->role);
                    $this->session->set_userdata($session_arr);

                    // redirect another page according to role user
                    if ($data_user->role == 'Karyawan') {
                        // employee dashboard
                        redirect(site_url(('dashboard/admin')));
                    } else if ($data_user->role == 'Donatur') {
                        $donatur = $this->donatur_model->getDonaturByUserLoginId($data_user->id);
                        $session_login = array(
                            'is_login' => true,
                            'id_donatur' => $donatur->id_donatur,
                            'nama_donatur' => $donatur->nama_donatur);
                        $this->session->set_userdata($session_login);

                        redirect(site_url(('home')));
                    } else if ($data_user->role == 'Relawan') {
                        // volunteer dashboard
                        redirect(site_url(('dashboard/relawan')));
                    }
                } else {
                    // incorrect password
                    $data['err'] = 'Akun sudah dinonaktifkan!';
                    $this->load->view('login', $data);
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

    public function logout()
    {
        $this->session->sess_destroy();
        redirect(site_url('/'));
    }
}
