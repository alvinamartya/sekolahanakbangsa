<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Siswa extends CI_Controller
{
    //rules
    private $rules = [
        [
            'field' => 'nama_siswa',
            'label' => 'Nama Siswa',
            'rules' => 'required|callback_alpha_space'
        ], [
            'field' => 'nisn',
            'label' => 'NISN',
            'rules' => 'required'
        ], [
            'field' => 'tempat_lahir',
            'label' => 'Tempat Lahir',
            'rules' => 'required'
        ], [
            'field' => 'tanggal_lahir',
            'label' => 'Tanggal Lahir',
            'rules' => 'required'
        ], [
            'field' => 'id_sekolah',
            'label' => 'Sekolah',
            'rules' => 'required',
        ], [
            'field' => 'jenis_kelamin',
            'label' => 'Jenis Kelamin',
            'rules' => 'required',
        ],
    ];

    //validasi hanya huruf
    public function alpha_space($str)
    {
        return (preg_match('/^[a-zA-Z ]+$/', $str) ? TRUE : FALSE);
    }

    //menampilkan error
    private $errorMessage = [
        'required' => '%s wajib diisi.',
        'alpha_space' => '%s hanya bisa diisi dengan huruf.',
    ];

    //construct
    public function __construct()
    {
        parent::__construct();
        //load ke model siswa
        $this->load->model('siswa_model');
        $this->load->model('relawan_model');
        $this->load->model('sekolah_model');

        // form validation
        $this->load->library('form_validation');
        // set rules
        $this->form_validation->set_rules($this->rules);
        // set error message
        $this->form_validation->set_message($this->errorMessage);
    }

    private function getRelawanName()
    {
        $this->load->model('relawan_model');
        $user_id = $this->session->user_id;
        $relawan = $this->relawan_model->getRelawanByUserLoginId($user_id);
        return $relawan->nama_relawan;
    }

    //tampilan pertama
    public function index()
    {
        //tittle
        $header['title'] = 'Siswa';
        $header['name'] =  $this->getRelawanName();
        //template header
        $this->load->view('templates/relawan_header', $header);
        //menampilkan data
        $data_siswa = $this->siswa_model->getSiswa();
        $data['siswa'] = $data_siswa;
        $this->load->view('siswa/index', $data);
        //template footer
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        // set page title
        $header['title'] = 'Tambah Siswa';
        $header['name'] =  $this->getRelawanName();
        //template header
        $this->load->view('templates/relawan_header', $header);

        $data['sekolah'] = $this->sekolah_model->getSekolah();
        $this->load->view('siswa/add', $data);

        //template footer
        $this->load->view('templates/footer');
    }

    public function add()
    {
        //method form
        $post = $this->input->post();

        //pengecekan
        if ($this->form_validation->run() == true) {
            //data array
            $insert_data = array(
                'nama_siswa' => $post["nama_siswa"],
                'id_sekolah' => 1,
                'jenis_kelamin' => $post["jenis_kelamin"],
                'nisn' => $post["nisn"],
                'id_sekolah' => $post['id_sekolah'],
                'tempat_lahir' => $post["tempat_lahir"],
                'tanggal_lahir' => $post["tanggal_lahir"],
                'creaby' => $this->getRelawanName(),
                'modiby' => $this->getRelawanName(),
            );

            //save data
            $result = $this->siswa_model->save($insert_data);

            if ($result > 0) {
                //ketampilan view data siswa
                $this->session->set_flashdata("success", "Data berhasil ditambahkan.");
                redirect(site_url('siswa'));
            } else {
                // error message
                $this->session->set_flashdata("failed", "Gagal menambah sekolah");
                redirect(site_url('siswa/add'));
            }
        } else {
            //ketampilan tambah
            $this->tambah();
        }
    }

    public function ubah($id_siswa)
    {
        $data_siswa = $this->siswa_model->getSiswaID($id_siswa);
        $this->ubahView($data_siswa);
    }

    public function ubahView($data_siswa)
    {
        //title
        $header['title'] = 'Ubah Siswa';
        $header['name'] =  $this->getRelawanName();

        //template header
        $this->load->view('templates/relawan_header', $header);
        $data['sekolah'] = $this->sekolah_model->getSekolah();
        $data['data'] = $data_siswa;
        $this->load->view('siswa/edit', $data);
        //template footer
        $this->load->view('templates/footer');
    }

    public function edit()
    {
        $data = $this->input->post();
        //pengecekan
        if ($this->form_validation->run() == true) {
            //models->fungsi edit
            $result = $this->siswa_model->edit($this->getRelawanName());
            if ($result > 0) {
                //ketampilan view data siswa
                $this->session->set_flashdata("success", "Data berhasil diubah.");
                redirect(site_url('siswa'));
            } else {
                // error message
                $this->session->set_flashdata("failed", "Gagal mengubah sekolah");
                redirect(site_url('siswa/edit'));
            }
        } else {
            //ketampilan tambah
            $this->ubahView((object)$data);
        }
    }

    //fungsi menghapus data dengan mengubah status
    function hapus($id)
    {
        $delete = $this->siswa_model->delete($id, $this->getRelawanName());
        if ($delete == true) {
            $this->session->set_flashdata("success", "Data berhasil dihapus.");
            redirect(site_url('siswa'));
        } else {
            $this->session->set_flashdata("success", "Data gagal dihapus.");
            redirect(site_url('siswa'));
        }
    }
}
