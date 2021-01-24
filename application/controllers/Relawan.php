<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Relawan extends CI_Controller
{
    // rules
    private $rules = [
        [
            'field' => 'nama_relawan',
            'label' => 'Nama Relawan',
            'rules' => 'required|callback_alpha_space'
        ], [
            'field' => 'nik',
            'label' => 'NIK',
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
        ], [
            'field' => 'no_telepon',
            'label' => 'No Telepon',
            'rules' => 'required'
        ], [
            'field' => 'email',
            'label' => 'Email',
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

    //contruct
    public function __construct()
    {
        parent::__construct();
        //load ke relawan_model
        $this->load->model('relawan_model');

        $this->load->library('form_validation');
        //validasi
        $this->form_validation->set_rules($this->rules);
        // set error message
        $this->form_validation->set_message($this->errorMessage);
    }

    //menampilkan data relawan
    public function index()
    {
        // set page title
        $header['title'] = 'Relawan';
        //template header
        $this->load->view('templates/admin_header', $header);
        //menampilan data
        $data_relawan = $this->relawan_model->getRelawan();
        $data['relawan'] = $data_relawan;
        $this->load->view('relawan/index', $data);
        //template footer
        $this->load->view('templates/admin_footer');
    }

    public function tambah()
    {
        // set page title
        $header['title'] = 'Relawan';
        //template header
        $this->load->view('templates/admin_header', $header);
        $this->load->view('relawan/add');
        // inlcude footer
        $this->load->view('templates/add_school_footer');
    }

    //action
    public function add()
    {
        //method post
        $post = $this->input->post();
        if ($this->form_validation->run() == true) {
            // insert data
            $insert_data = array(
                'nama_relawan' => $post["nama_relawan"],
                'id_cluster_relawan' => 1,
                'id_user_login' => 1,
                'id_sekolah' => 1,
                'jenis_kelamin' => $post["jenis_kelamin"],
                'nik' => $post["nik"],
                'no_telepon' =>  $post["no_telepon"],
                'email' =>  $post["email"],
                'tempat_lahir' => $post["tempat_lahir"],
                'tanggal_lahir' => $post["tanggal_lahir"],
                'creaby' => "Muhamad Ivan",
            );
            //menyimpan data
            $result = $this->relawan_model->save($insert_data);
            if ($result > 0) {
                redirect(site_url('relawan'));
            } else {
                // error message
                $this->session->set_flashdata("failed", "Gagal menambah sekolah");
                redirect(site_url('relawan/add'));
            }
        } else {
            //mengarah ketampilan tambah
            $this->tambah();
        }
    }

    public function ubah($id_relawan)
    {
        //title
        $header['title'] = 'Ubah Relawan';
        //template header
        $this->load->view('templates/admin_header', $header);
        //ambil data relawan
        $data_relawan = $this->relawan_model->getRelawanID($id_relawan);
        $data['data'] = $data_relawan;
        $this->load->view('relawan/edit', $data);

        // inlcude footer
        $this->load->view('templates/admin_footer');
    }

    public function edit()
    {
        //menyimpan hasil pengubahan
        $relawan = $this->relawan_model->edit();
        redirect(site_url('relawan'));
    }

    function hapus($id)
    {
        //
        $delete = $this->relawan_model->delete($id, 'muhamad ivan');
        if ($delete == true) {
            $this->session->set_flashdata("success", "Data berhasil dihapus.");
            redirect(site_url('relawan'));
        } else {
            $this->session->set_flashdata("success", "Data gagal dihapus.");
            redirect(site_url('relawan'));
        }
    }
}
