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
            'field' => 'jenis_kelamin',
            'label' => 'Jenis Kelamin',
            'rules' => 'required'
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

        // form validation
        $this->load->library('form_validation');
        // set rules
        $this->form_validation->set_rules($this->rules);
        // set error message
        $this->form_validation->set_message($this->errorMessage);
    }

    //tampilan pertama
    public function index()
    {
        //tittle
        $header['title'] = 'Siswa';
        //template header
        $this->load->view('templates/relawan_header', $header);
        //menampilkan data
        $data_siswa = $this->siswa_model->getSiswa();
        $data['siswa'] = $data_siswa;
        $this->load->view('siswa/index', $data);
        //template footer
        $this->load->view('templates/relawan_footer');
    }

    public function tambah()
    {
        // set page title
        $header['title'] = 'Tambah Siswa';
        //template header
        $this->load->view('templates/relawan_header', $header);
        $this->load->view('siswa/add');
        //template footer
        $this->load->view('templates/relawan_footer');
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
                'tempat_lahir' => $post["tempat_lahir"],
                'tanggal_lahir' => $post["tanggal_lahir"],
                'creaby' => "Muhamad Ivan",
            );

            //save data
            $result = $this->siswa_model->save($insert_data);

            if ($result > 0) {
                //ketampilan view data siswa
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
        //title
        $header['title'] = 'Ubah Siswa';
        //template header
        $this->load->view('templates/relawan_header', $header);

        $data_siswa = $this->siswa_model->getSiswaID($id_siswa);
        $data['data'] = $data_siswa;
        $this->load->view('siswa/edit', $data);
        //template footer
        $this->load->view('templates/relawan_footer');
    }

    public function edit()
    {
        //models->fungsi edit
        $siswa = $this->siswa_model->edit();
        redirect(site_url('siswa'));
    }

    //fungsi menghapus data dengan mengubah status
    function hapus($id)
    {
        $delete = $this->siswa_model->delete($id, 'muhamad ivan');
        if ($delete == true) {
            $this->session->set_flashdata("success", "Data berhasil dihapus.");
            redirect(site_url('siswa'));
        } else {
            $this->session->set_flashdata("success", "Data gagal dihapus.");
            redirect(site_url('siswa'));
        }
    }
}
