<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sekolah extends CI_Controller
{
    // rules
    private $rules = [
        [
            'field' => 'nama_sekolah',
            'label' => 'Nama Sekolah',
            'rules' => 'required|callback_alpha_space'
        ], [
            'field' => 'jenis_sekolah',
            'label' => 'Jenis Sekolah',
            'rules' => 'required'
        ], [
            'field' => 'alamat',
            'label' => 'Alamat Sekolah',
            'rules' => 'required'
        ], [
            'field' => 'jenis_sekolah',
            'label' => 'Jenis Sekolah',
            'rules' => 'required'
        ], [
            'field' => 'provinsi',
            'label' => 'Provinsi',
            'rules' => 'required'
        ], [
            'field' => 'kota',
            'label' => 'Kota',
            'rules' => 'required'
        ],
    ];

    public function alpha_space($str)
    {
        return (preg_match('/^[a-zA-Z ]+$/', $str) ? TRUE : FALSE);
    }

    // form rules error message
    private $errorMessage = [
        'required' => '%s wajib diisi.',
        'alpha_space' => '%s hanya bisa diisi dengan huruf.',
    ];

    // constructor
    public function __construct()
    {
        parent::__construct();
        $this->load->model('sekolah_model');
        $this->load->model('karyawan_model');

        // form validation
        $this->load->library('form_validation');
        // set rules
        $this->form_validation->set_rules($this->rules);
        // set error message
        $this->form_validation->set_message($this->errorMessage);
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

    /*
    ==============================================================
    View School
    ==============================================================
    */
    public function index()
    {
        // set employee 
        $header['name'] =  $this->getKaryawanName();
        $header['role'] =  $this->getKaryawanRole();

        // set page title
        $header['title'] = 'Sekolah';

        // include header
        $this->load->view('templates/admin_header', $header);

        // data sekolah
        $data_sekolah = $this->sekolah_model->getSekolah();
        $data['sekolah'] = $data_sekolah;
        $this->load->view('sekolah/index', $data);

        // inlcude footer
        $this->load->view('templates/footer');
    }

    /*
    ==============================================================
    Add School
    ==============================================================
    */
    // view
    public function tambah($err = false)
    {
        if ($err == false) {
            $cookie_provinsi = array(
                'name' => 'provinsi',
                'value' => '',
                'expire' => 3600,
            );

            $cookie_kota = array(
                'name' => 'kota',
                'value' => '',
                'expire' => 3600,
            );

            $this->input->set_cookie($cookie_provinsi);
            $this->input->set_cookie($cookie_kota);
        }

        // set page title
        $header['title'] = 'Tambah Sekolah';

        // set employee 
        $header['name'] =  $this->getKaryawanName();
        $header['role'] =  $this->getKaryawanRole();

        $this->load->view('templates/admin_header', $header);
        $this->load->view('sekolah/add');
    }

    // action
    public function add()
    {
        $post = $this->input->post();

        if ($this->form_validation->run() == true) {
            var_dump("test");

            // insert data
            $insert_data = array(
                'nama_sekolah' => $post["nama_sekolah"],
                'jenis_sekolah' => $post["jenis_sekolah"],
                'alamat' => $post["alamat"],
                'provinsi' => $post["provinsi"],
                'kota' => $post["kota"],
                'creaby' => $this->getKaryawanName(),
                'modiby' => $this->getKaryawanName(),
            );

            // save school
            $result = $this->sekolah_model->save($insert_data);

            if ($result > 0) {
                redirect(site_url('sekolah'));
            } else {
                // error message
                $this->session->set_flashdata("failed", "Gagal menambah sekolah");
                redirect(site_url('sekolah/add'));
            }
        } else {
            $cookie_provinsi = array(
                'name' => 'provinsi',
                'value' => $post['provinsi'],
                'expire' => 3600,
            );

            $cookie_kota = array(
                'name' => 'kota',
                'value' => $post['kota'],
                'expire' => 3600,
            );

            $this->input->set_cookie($cookie_provinsi);
            $this->input->set_cookie($cookie_kota);

            $this->tambah(true);
        }
    }

    /*
    ==============================================================
    Delete School
    ==============================================================
    */
    function destroy($id)
    {
        $delete = $this->sekolah_model->delete($id, $this->getKaryawanName());
        if ($delete == true) {
            $this->session->set_flashdata("success", "Data berhasil dihapus.");
            redirect(site_url('sekolah'));
        } else {
            $this->session->set_flashdata("success", "Data gagal dihapus.");
            redirect(site_url('sekolah'));
        }
    }

    /*
    ==============================================================
    Edit School
    ==============================================================
    */
    // view
    public function ubah($id)
    {
        $data_sekolah = $this->sekolah_model->getByID($id);
        $this->ubahView($data_sekolah);
    }

    public function ubahView($data_sekolah)
    {
        // set page title
        $header['title'] = 'Ubah Sekolah';

        // set employee 
        $header['name'] =  $this->getKaryawanName();
        $header['role'] =  $this->getKaryawanRole();

        $data['s'] = $data_sekolah;

        $cookie_provinsi = array(
            'name' => 'provinsi',
            'value' => $data_sekolah->provinsi,
            'expire' => 3600,
        );

        $cookie_kota = array(
            'name' => 'kota',
            'value' => $data_sekolah->kota,
            'expire' => 3600,
        );

        $this->input->set_cookie($cookie_provinsi);
        $this->input->set_cookie($cookie_kota);

        $this->load->view('templates/admin_header', $header);
        $this->load->view('sekolah/edit', $data);
    }

    public function edit($id)
    {
        $post = $this->input->post();

        if ($this->form_validation->run() == true) {
            var_dump("test");

            // insert data
            $update = array(
                'nama_sekolah' => $post["nama_sekolah"],
                'jenis_sekolah' => $post["jenis_sekolah"],
                'alamat' => $post["alamat"],
                'provinsi' => $post["provinsi"],
                'kota' => $post["kota"],
                'modiby' => $this->getKaryawanName(),
            );

            // save school
            $result = $this->sekolah_model->update($id, $update);

            if ($result > 0) {
                redirect(site_url('sekolah'));
            } else {
                // error message
                $this->session->set_flashdata("failed", "Gagal mengubah sekolah");
                redirect(site_url('sekolah/edit'));
            }
        } else {
            $cookie_provinsi = array(
                'name' => 'provinsi',
                'value' => $post['provinsi'],
                'expire' => 3600,
            );

            $cookie_kota = array(
                'name' => 'kota',
                'value' => $post['kota'],
                'expire' => 3600,
            );

            $this->input->set_cookie($cookie_provinsi);
            $this->input->set_cookie($cookie_kota);
            $post['id_sekolah'] = $id;

            $this->ubahView((object)$post);
        }
    }
}
