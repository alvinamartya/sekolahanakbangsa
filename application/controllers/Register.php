<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Register extends CI_Controller
{
    // form rules
    private $rules = [
        [
            'field' => 'nama_donatur',
            'label' => 'Nama Donatur',
            'rules' => 'required|alpha',
        ], [
            'field' => 'email_donatur',
            'label' => 'Email Donatur',
            'rules' => 'required|valid_email|is_unique[donatur.email_donatur]',
        ], [
            'field' => 'jenis_kelamin',
            'label' => 'Jenis Kelamin',
            'rules' => 'required',
        ], [
            'field' => 'no_telepon',
            'label' => 'No. Telepon',
            'rules' => 'required|numeric',
        ], [
            'field' => 'username',
            'label' => 'Nama Pengguna',
            'rules' => 'required|is_unique[user_login.username]',
        ], [
            'field' => 'password',
            'label' => 'Kata sandi',
            'rules' => 'required',
        ],
    ];

    // form rules error message
    private $errorMessage = [
        'is_unique' => '%s sudah terdaftar.',
        'required' => '%s wajib diisi.',
        'valid_email' => '%s bukan email yang valid.',
        'alpha' => '%s hanya bisa diisi dengan huruf.',
        'numeric' => '%s hanya bisa diisi dengan angka.'
    ];

    public function __construct()
    {
        parent::__construct();
        $this->load->model('donatur_model');
        $this->load->model('login_model');

        // form validation
        $this->load->library('form_validation');
        // set rules
        $this->form_validation->set_rules($this->rules);
        // set error message
        $this->form_validation->set_message($this->errorMessage);
    }

    public function donatur()
    {
        $this->load->view('register/donatur');
    }

    public function register_donatur()
    {
        $donatur = $this->donatur_model;
        $user_login = $this->login_model;
        $post = $this->input->post();

        if ($this->form_validation->run() == true) {
            // userlogin data
            $userlogin_data = [
                'username' => $post["username"],
                'password' => password_hash($post["password"], PASSWORD_DEFAULT),
                'role' => 'Donatur',
                'creaby' => '-',
                'modiby' => '-',
                'row_status' => 'A',
            ];

            // save donatur user login data
            $user_login->save($userlogin_data);

            // donatur data
            $donatur_data = [
                'id_user_login' => $user_login->getLastData()->id,
                'nama_donatur' => $post["nama_donatur"],
                'email_donatur' => $post["email_donatur"],
                'jenis_kelamin' => $post["jenis_kelamin"],
                'no_telepon' => $post["no_telepon"],
                'creaby' => '-',
                'modiby' => '-',
                'row_status' => 'A'
            ];

            // save donatur data
            $result = $donatur->save($donatur_data);

            if ($result > 0) {
                // success message
                $this->session->set_flashdata("success", "Register berhasil");
                redirect(site_url('register/donatur'));
            } else {
                // error message
                $this->session->set_flashdata("failed", "Register gagal");
                redirect(site_url('register/donatur'));
            }
        }

        $this->load->view('register/donatur');
    }
}
