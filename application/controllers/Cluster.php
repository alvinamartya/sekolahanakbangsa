<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cluster extends CI_Controller
{
    // constructor
    public function __construct()
    {
        parent::__construct();
        $this->load->model('cluster_relawan_model');
    }

    // login view
    public function index()
    {
        // include header
        $this->load->view('templates/admin_header');

        // data karyawan
        $data_karyawan = $this->cluster_relawan_model->getAllData();
        $data['cluster'] = $data_karyawan;
        $this->load->view('cluster/index', $data);

        // inlcude footer
        $this->load->view('templates/admin_footer');
    }

    public function tambah()
    {
        // include header
        $this->load->view('templates/admin_header');

        $this->load->view('cluster/add');

        // inlcude footer
        $this->load->view('templates/admin_footer');
    }

    public function add()
    {
        $cluster = $this->cluster_relawan_model;

        $result = $cluster->save();
        if ($result > 0) $this->sukses();
        else $this->gagal();
    }

    public function ubah($id_cluster)
    {
        // include header		
        $this->load->view('templates/admin_header');

        //ambil data cluster
        $data_cluster = $this->cluster_relawan_model->getCluster($id_cluster);
        $data['cluster'] = $data_cluster;
        $this->load->view('cluster/edit', $data);

        // inlcude footer
        $this->load->view('templates/admin_footer');
    }

    public function edit()
    {
        $cluster = $this->cluster_relawan_model->edit();
        $this->sukses();
    }

    public function hapus($id_karyawan)
    {
        $data_karyawan = $this->cluster_relawan_model->hapus($id_karyawan);
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
