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

        // form validation
        $this->load->library('form_validation');
        // set rules
        $this->form_validation->set_rules($this->rules);
        // set error message
        $this->form_validation->set_message($this->errorMessage);
    }

    /*
    ==============================================================
    View School
    ==============================================================
    */
    public function index()
    {
        // set page title
        $header['title'] = 'Sekolah';

        // include header
        $this->load->view('templates/admin_header', $header);

        // data sekolah
        $data_sekolah = $this->sekolah_model->getSekolah();
        $data['sekolah'] = $data_sekolah;
        $this->load->view('sekolah/index', $data);

        // inlcude footer
        $this->load->view('templates/admin_footer');
    }

    /*
    ==============================================================
    Add School
    ==============================================================
    */
    // view
    public function tambah()
    {
        // set page title
        $header['title'] = 'Tambah Sekolah';

        $this->load->view('templates/admin_header', $header);
        $this->load->view('sekolah/add');

        // inlcude footer
        $this->load->view('templates/add_school_footer');
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
                'creaby' => "Alvin Amarty",
                'modiby' => "Alvin Amartya",
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
            $this->tambah();
        }
    }

    /*
    ==============================================================
    Delete School
    ==============================================================
    */
    function destroy($id)
    {
        $delete = $this->sekolah_model->delete($id, 'Alvin Amartya');
        if ($delete == true) {
            $this->session->set_flashdata("success", "Data berhasil dihapus.");
            redirect(site_url('sekolah'));
        } else {
            $this->session->set_flashdata("success", "Data gagal dihapus.");
            redirect(site_url('sekolah'));
        }
    }
}
