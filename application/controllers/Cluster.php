<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cluster extends CI_Controller
{
    // rules
    private $rules = [
        [
            'field' => 'nama_cluster',
            'label' => 'Nama Cluster',
            'rules' => 'required'
        ], [
            'field' => 'deskripsi_cluster',
            'label' => 'Deskripsi Cluster',
            'rules' => 'required'
        ],
    ];

    // form rules error message
    private $errorMessage = [
        'required' => '%s wajib diisi.',
    ];

    // constructor
    public function __construct()
    {
        parent::__construct();
        $this->load->model('cluster_relawan_model');
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

    // login view
    public function index()
    {
        // set employee
        $header['name'] =  $this->getKaryawanName();
        $header['role'] =  $this->getKaryawanRole();

        // set page title
        $header['title'] = 'Cluster Relawan';

        // include header
        $this->load->view('templates/admin_header', $header);

        // data karyawan
        $data_karyawan = $this->cluster_relawan_model->getAllData();
        $data['cluster'] = $data_karyawan;
        $this->load->view('cluster/index', $data);

        // inlcude footer
        $this->load->view('templates/footer');
    }


    public function tambah()
    {
        // set employee
        $header['name'] =  $this->getKaryawanName();
        $header['role'] =  $this->getKaryawanRole();

        // set page title
        $header['title'] = 'Tambah Cluster Relawan';

        // include header
        $this->load->view('templates/admin_header', $header);

        $this->load->view('cluster/add');

        // inlcude footer
        $this->load->view('templates/footer');
    }

    public function add()
    {
        $cluster = $this->cluster_relawan_model;

        if ($this->form_validation->run() == true) {
            $result = $cluster->save();
            if ($result > 0)  {
                $this->session->set_flashdata("success", "Data berhasil ditambahkan.");
                $this->sukses();
            } else {
                $this->session->set_flashdata("failed", "Data gagal ditambahkan.");
                $this->gagal();
            }
        } else {			
            $this->tambah();
        }
    }

    public function ubah($id_cluster)
    {
        // set employee
        $header['name'] =  $this->getKaryawanName();
        $header['role'] =  $this->getKaryawanRole();

        // set page title
        $header['title'] = 'Ubah Cluster Relawan';

        // include header
        $this->load->view('templates/admin_header', $header);

        //ambil data cluster
        $data_cluster = $this->cluster_relawan_model->getCluster($id_cluster);
        $data['cluster'] = $data_cluster;
        $this->load->view('cluster/edit', $data);

        // inlcude footer
        $this->load->view('templates/footer');
    }

    public function ubahView($data_siswa)
    {
        // set employee
        $header['name'] =  $this->getKaryawanName();
        $header['role'] =  $this->getKaryawanRole();

        // set page title
        $header['title'] = 'Ubah Cluster Relawan';

        // include header
        $this->load->view('templates/admin_header', $header);

        //ambil data cluster
        $data['cluster'] = $data_siswa;
        $this->load->view('cluster/edit', $data);

        // inlcude footer
        $this->load->view('templates/footer');
    }

    public function edit()
    {
        //pengecekan
        if ($this->form_validation->run() == true) {
            //models->fungsi edit
            $cluster = $this->cluster_relawan_model->edit();
            if ($cluster > 0) {
                //ketampilan view data siswa
                $this->session->set_flashdata("success", "Data berhasil diubah.");
                redirect(site_url('cluster'));
            } else {
                // error message
                $this->session->set_flashdata("failed", "Data gagal diubah.");
                redirect(site_url('cluster/edit'));
            }
        } else {
            //ketampilan tambah
            $data = $this->input->post();
            $this->ubahView((object)$data);
        }
    }

    public function hapus($id_karyawan)
    {
        $data_karyawan = $this->cluster_relawan_model->hapus($id_karyawan);
        $this->session->set_flashdata("success", "Data berhasil dihapus");
        $this->sukses();
    }

    function sukses()
    {
        redirect(base_url('Cluster'));
    }
    function gagal()
    {
        echo "<script>alert('Input data gagal')</script>";
        redirect(base_url('Cluster'));
    }
}
