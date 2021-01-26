<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Biaya_Lainnya extends CI_Controller
{
    // rules
    private $rules = [
        [
            'field' => 'nama_biaya_lainnya',
            'label' => 'Nama Biaya Lainnya',
            'rules' => 'required'
        ], [
            'field' => 'deskripsi_biaya_lainnya',
            'label' => 'Deskripsi Biaya Lainnya',
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
        $this->load->model('biaya_lainnya_model');
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
    View Biaya Lainnya
    ==============================================================
    */
    public function index()
    {
        // set employee
        $header['name'] =  $this->getKaryawanName();
        $header['role'] =  $this->getKaryawanRole();

        // set page title
        $header['title'] = 'Biaya Lainnya';

        // include header
        $this->load->view('templates/admin_header', $header);

        // data sekolah
        $data_biaya_lainnya = $this->biaya_lainnya_model->getBiayaLainnya();
        $data['biaya_lainnya'] = $data_biaya_lainnya;
        $this->load->view('biaya_lainnya/index', $data);

        // inlcude footer
        $this->load->view('templates/footer');
    }

    /*
    ==============================================================
    Add Biaya Lainnya
    ==============================================================
    */
    // view
    public function tambah()
    {
        $this->tambahView(null);
    }

    private function tambahView($data_biaya_lainnya)
    {
        // set employee
        $header['name'] =  $this->getKaryawanName();
        $header['role'] =  $this->getKaryawanRole();

        // set page title
        $header['title'] = 'Tambah Biaya Lainnya';

        $data['biaya_lainnya'] = $data_biaya_lainnya;

        $this->load->view('templates/admin_header', $header);
        $this->load->view('biaya_lainnya/add', $data);

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
                'nama_biaya_lainnya' => $post["nama_biaya_lainnya"],
                'deskripsi_biaya_lainnya' => $post["deskripsi_biaya_lainnya"],
                'creaby' => $this->getKaryawanName(),
                'modiby' => $this->getKaryawanName(),
            );

            // save barang
            $result = $this->biaya_lainnya_model->save($insert_data);

            if ($result > 0) {
                $this->session->set_flashdata("success", "Data berhasil ditambahkan.");
                redirect(site_url('biaya-lainnya'));
            } else {
                // error message
                $this->session->set_flashdata("success", "Gagal menambah biaya lainnya");
                redirect(site_url('biaya-lainnya/add'));
            }
        } else {
            $this->tambahView((object)$post);
        }
    }

    /*
    ==============================================================
    Edit Biaya Lainnya
    ==============================================================
    */
    public function ubah($id_biaya_lainnya)
    {
        $data_biaya_lainnya = $this->biaya_lainnya_model->getBiayaLainnyaID($id_biaya_lainnya);
        $this->ubahView($data_biaya_lainnya);
    }

    public function ubahView($data_biaya_lainnya)
    {
        // set employee
        $header['name'] =  $this->getKaryawanName();
        $header['role'] =  $this->getKaryawanRole();

        //title
        $header['title'] = 'Ubah Biaya Lainnya';
        //template header
        $this->load->view('templates/admin_header', $header);

        $data['data'] = $data_biaya_lainnya;
        $this->load->view('biaya_lainnya/edit', $data);
        //template footer
        $this->load->view('templates/footer');
    }

    public function edit()
    {
        //models->fungsi edit
        if ($this->form_validation->run() == true) {
            $result = $this->biaya_lainnya_model->edit($this->getKaryawanName());
            if ($result > 0) {
                $this->session->set_flashdata("success", "Data berhasil diubah.");
                redirect(site_url('biaya-lainnya'));
            } else {
                // error message
                $this->session->set_flashdata("success", "Gagal mengubah biaya lainnya");
                redirect(site_url('biaya-lainnya/edit'));
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
        $delete = $this->biaya_lainnya_model->delete($id, $this->getKaryawanName());
        if ($delete == true) {
            $this->session->set_flashdata("success", "Data berhasil dihapus.");
            redirect(site_url('biaya-lainnya'));
        } else {
            $this->session->set_flashdata("success", "Data gagal dihapus.");
            redirect(site_url('biaya-lainnya'));
        }
    }
}
