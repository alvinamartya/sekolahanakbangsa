<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Relawan extends CI_Controller
{
    private $rules = [
        [
            'field' => 'nik',
            'label' => 'Nik Relawan',
            'rules' => 'required',
        ], [
            'field' => 'nama_relawan',
            'label' => 'Nama Relawan',
            'rules' => 'required|callback_alpha_space',
        ], [
            'field' => 'id_cluster_relawan',
            'label' => 'Cluster Relawan',
            'rules' => 'required',
        ], [
            'field' => 'email',
            'label' => 'Email Relawan',
            'rules' => 'required|valid_email',
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
        ],
    ];

    //validasi hanya huruf
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
    ];

    // constructor
    public function __construct()
    {
        parent::__construct();
        $this->load->model('relawan_model');
        $this->load->model('cluster_relawan_model');

        // form validation
        $this->load->library('form_validation');

        // set rules
        $this->form_validation->set_rules($this->rules);

        // set error message
        $this->form_validation->set_message($this->errorMessage);
    }

    /*
    ==============================================================
    View Relawan
    ==============================================================
    */
    //menampilkan data relawan
    public function index()
    {
        // set page title
        $header['title'] = 'Relawan';

        // include header
        $this->load->view('templates/admin_header', $header);

        // data relawan
        $data['relawan'] = $this->relawan_model->getAll();
        $this->load->view('relawan/index', $data);

        // inlcude footer
        $this->load->view('templates/admin_footer');
    }

    /*
    ==============================================================
    Delete Relawan
    ==============================================================
    */
    function destroy($id)
    {
        $delete = $this->relawan_model->delete($id, 'Alvin Amartya');
        if ($delete == true) {
            $this->session->set_flashdata("success", "Data berhasil dihapus.");
            redirect(site_url('relawan'));
        } else {
            $this->session->set_flashdata("success", "Data gagal dihapus.");
            redirect(site_url('relawan'));
        }
    }

    /*
    ==============================================================
    Edit Relawan
    ==============================================================
    */
    public function ubah($id_relawan)
    {
        $data_relawan = $this->relawan_model->getByID($id_relawan);
        $this->loadUbah($data_relawan);
    }

    public function loadUbah($data_relawan)
    {
        // set page title
        $header['title'] = 'Ubah Relawan';

        // include header
        $this->load->view('templates/admin_header', $header);

        $data['r'] = $data_relawan;
        $data['cluster'] = $this->cluster_relawan_model->getAllData();

        $this->load->view('relawan/edit', $data);

        // inlcude footer
        $this->load->view('templates/admin_footer');
    }

    public function edit($id_relawan)
    {
        $post = $this->input->post();

        if ($this->form_validation->run() == true) {
            // relawan data
            $relawan_data = [
                'id_cluster_relawan' => $post['id_cluster_relawan'],
                'nik' => $post['nik'],
                'nama_relawan' => $post['nama_relawan'],
                'jenis_kelamin' => $post['jenis_kelamin'],
                'no_telepon' => $post['no_telepon'],
                'email' => $post['email'],
                'tempat_lahir' => $post['tempat_lahir'],
                'tanggal_lahir' => $post['tanggal_lahir'],
            ];

            // save donatur data
            $result = $this
                ->relawan_model
                ->update($id_relawan, $relawan_data);

            if ($result > 0) {
                // success message
                $this->session->set_flashdata("success", "Ubah data relawan berhasil");
                redirect(site_url('relawan/index'));
            } else {
                // error message
                $this->session->set_flashdata("failed", "Ubah data relawan gagal");
                redirect(site_url('relawan/index'));
            }
        } else {
            $post['id_relawan'] = $id_relawan;
            $this->loadUbah((object)$post);
        }
    }
}
