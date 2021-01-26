<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Register extends CI_Controller
{
    // form rules
    private $rulesDonatur = [
        [
            'field' => 'nama_donatur',
            'label' => 'Nama Donatur',
            'rules' => 'required|callback_alpha_space',
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
        ], [
            'field' => 'password_confirmation',
            'label' => 'Konfirmasi Kata sandi',
            'rules' => 'required|matches[password]'
        ]
    ];

    private $rulesRelawan = [
        [
            'field' => 'nik_relawan',
            'label' => 'Nik Relawan',
            'rules' => 'required',
        ], [
            'field' => 'nama_relawan',
            'label' => 'Nama Relawan',
            'rules' => 'required|callback_alpha_space',
        ], [
            'field' => 'cluster',
            'label' => 'Cluster Relawan',
            'rules' => 'required',
        ], [
            'field' => 'email',
            'label' => 'Email Relawan',
            'rules' => 'required|valid_email|is_unique[relawan.email]',
        ], [
            'field' => 'jenis_kelamin',
            'label' => 'Jenis Kelamin',
            'rules' => 'required',
        ], [
            'field' => 'no_telepon',
            'label' => 'No. Telepon',
            'rules' => 'required|numeric',
        ], [
            'field' => 'tempat_lahir',
            'label' => 'Tempat Lahir',
            'rules' => 'required|callback_alpha_space',
        ], [
            'field' => 'tanggal_lahir',
            'label' => 'Tanggal Lahir',
            'rules' => 'required',
        ], [
            'field' => 'username',
            'label' => 'Nama Pengguna',
            'rules' => 'required|is_unique[user_login.username]',
        ], [
            'field' => 'password',
            'label' => 'Kata sandi',
            'rules' => 'required',
        ], [
            'field' => 'password_confirmation',
            'label' => 'Konfirmasi Kata sandi',
            'rules' => 'required|matches[password]'
        ]
    ];

    public function alpha_space($str)
    {
        return (preg_match('/^[a-zA-Z ]+$/', $str) ? TRUE : FALSE);
    }

    // form rules error message
    private $errorMessage = [
        'is_unique' => '%s sudah terdaftar.',
        'required' => '%s wajib diisi.',
        'valid_email' => '%s bukan email yang valid.',
        'alpha_space' => '%s hanya bisa diisi dengan huruf.',
        'numeric' => '%s hanya bisa diisi dengan angka.',
        'matches' => '%s tidak sama'
    ];

    public function __construct()
    {
        parent::__construct();
        $this->load->model('donatur_model');
        $this->load->model('relawan_model');
        $this->load->model('login_model');
        $this->load->model('cluster_relawan_model');

        // form validation
        $this->load->library('form_validation');

        // set error message
        $this->form_validation->set_message($this->errorMessage);
    }

    public function donatur()
    {
        $this->load->view('register/donatur');
    }

    public function relawan()
    {
        $data['cluster'] = $this->cluster_relawan_model->getAllData();
        $this->load->view('register/relawan', $data);
    }

    public function register_donatur()
    {
        // set rules
        $this->form_validation->set_rules($this->rulesDonatur);

        // data
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
                $this->session->set_flashdata("success", "Pendaftaran berhasil");
                redirect(site_url('register/donatur'));
            } else {
                // error message
                $this->session->set_flashdata("failed", "Pendaftaran gagal");
                redirect(site_url('register/donatur'));
            }
        }

        $this->load->view('register/donatur');
    }

    public function register_relawan()
    {
        // set rules
        $this->form_validation->set_rules($this->rulesRelawan);

        // data
        $relawan = $this->relawan_model;
        $user_login = $this->login_model;
        $post = $this->input->post();
        $data['cluster'] = $this->cluster_relawan_model->getAllData();

        if ($this->form_validation->run() == true) {
            // userlogin data
            $userlogin_data = [
                'username' => $post["username"],
                'password' => password_hash($post["password"], PASSWORD_DEFAULT),
                'role' => 'Relawan',
                'creaby' => '-',
                'modiby' => '-',
                'row_status' => 'A',
            ];

            // save relawan user login data
            $user_login->save($userlogin_data);

            // relawan data
            $relawan_data = [
                'id_user_login' => $user_login->getLastData()->id,
                'nik' => $post["nik_relawan"],
                'nama_relawan' => $post["nama_relawan"],
                'id_cluster_relawan' => $post["cluster"],
                'jenis_kelamin' => $post["jenis_kelamin"],
                'no_telepon' => $post["no_telepon"],
                'email' => $post["email"],
                'tempat_lahir' => $post["tempat_lahir"],
                'tanggal_lahir' => $post["tanggal_lahir"],
                'creaby' => '-',
                'modiby' => '-',
                'row_status' => 'A'
            ];

            // save relawan data
            $result = $relawan->save($relawan_data);

            if ($result > 0) {
                // success message
                $this->session->set_flashdata("success", "Pendaftaran berhasil");
                redirect(site_url('register/relawan'));
            } else {
                // error message
                $this->session->set_flashdata("failed", "Pendaftaran gagal");
                redirect(site_url('register/relawan'));
            }
        }

        $this->load->view('register/relawan', $data);
    }
}
