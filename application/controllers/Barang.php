<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang extends CI_Controller
{
    // rules
    private $rules = [
        [
            'field' => 'nama_barang',
            'label' => 'Nama Barang',
            'rules' => 'required|callback_alpha_space'
        ], [
            'field' => 'deskripsi_barang',
            'label' => 'Deskripsi Barang',
            'rules' => 'required'
        ],
    ];

    //validasi huruf
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

        //load ke model siswa
        $this->load->model('barang_model');
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
    View Barang
    ==============================================================
    */
    public function index()
    {
        // set employee
        $header['name'] =  $this->getKaryawanName();
        $header['role'] =  $this->getKaryawanRole();

        // set page title
        $header['title'] = 'Barang';

        // include header
        $this->load->view('templates/admin_header', $header);

        // data sekolah
        $data_barang = $this->barang_model->getBarang();
        $data['barang'] = $data_barang;
        $this->load->view('barang/index', $data);

        // inlcude footer
        $this->load->view('templates/footer');
    }

    /*
    ==============================================================
    Add Barang
    ==============================================================
    */
    // view
    public function tambah()
    {
        $this->tambahView(null);
    }

    private function tambahView($data_barang)
    {
        // set page title
        $header['name'] =  $this->getKaryawanName();
        $header['role'] =  $this->getKaryawanRole();
        $header['title'] = 'Tambah Barang';
        $data['barang'] = $data_barang;

        $this->load->view('templates/admin_header', $header);
        $this->load->view('barang/add', $data);

        // inlcude footer
        $this->load->view('templates/footer');
    }

    // action
    public function add()
    {
        $post = $this->input->post();

        if ($this->form_validation->run() == true) {
            // insert data
            $insert_data = array(
                'nama_barang' => $post["nama_barang"],
                'deskripsi_barang' => $post["deskripsi_barang"],
                'creaby' => $this->getKaryawanName(),
                'modiby' => $this->getKaryawanName(),
            );

            // save barang
            $result = $this->barang_model->save($insert_data);

            if ($result > 0) {
                $this->session->set_flashdata("success", "Data berhasil ditambahkan.");
                redirect(site_url('barang'));
            } else {
                // error message
                $this->session->set_flashdata("failed", "Gagal menambah barang");
                redirect(site_url('barang/add'));
            }
        } else {
            $this->tambahView((object)$post);
        }
    }

    /*
    ==============================================================
    Edit Barang
    ==============================================================
    */
    public function ubah($id_barang)
    {
        $data_barang = $this->barang_model->getBarangID($id_barang);
        $this->ubahView($data_barang);
    }

    private function ubahView($data_barang)
    {
        //title
        $header['title'] = 'Ubah Barang';
        $header['name'] =  $this->getKaryawanName();
        $header['role'] =  $this->getKaryawanRole();

        //template header
        $this->load->view('templates/admin_header', $header);

        $data['data'] = $data_barang;
        $this->load->view('barang/edit', $data);


        //template footer
        $this->load->view('templates/footer');
    }

    public function edit()
    {
        //models->fungsi edit
        if ($this->form_validation->run() == true) {
            $result = $this->barang_model->edit($this->getKaryawanName());
            if ($result > 0) {
                $this->session->set_flashdata("success", "Data berhasil diubah.");
                redirect(site_url('barang'));
            } else {
                // error message
                $this->session->set_flashdata("success", "Gagal mengubah barang");
                redirect(site_url('barang/edit'));
            }
        } else {
            $data = $this->input->post();
            $this->ubahView((object)$data);
        }
    }

    /*
    ==============================================================
    Delete Barang
    ==============================================================
    */
    function destroy($id)
    {
        $delete = $this->barang_model->delete($id, $this->getKaryawanName());
        if ($delete == true) {
            $this->session->set_flashdata("success", "Data berhasil dihapus.");
            redirect(site_url('barang'));
        } else {
            $this->session->set_flashdata("success", "Data gagal dihapus.");
            redirect(site_url('barang'));
        }
    }
}
