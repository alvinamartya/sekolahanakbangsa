<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang extends CI_Controller
{
    // rules
    private $rules = [
        [
            'field' => 'nama_barang',
            'label' => 'Nama Barang',
            'rules' => 'required'
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
        // form validation
        $this->load->library('form_validation');
        // set rules
        $this->form_validation->set_rules($this->rules);
        // set error message
        $this->form_validation->set_message($this->errorMessage);
    }

    /*
    ==============================================================
    View Barang
    ==============================================================
    */
    public function index()
    {
        // set page title
        $header['title'] = 'Barang';

        // include header
        $this->load->view('templates/admin_header', $header);

        // data sekolah
        $data_barang = $this->barang_model->getBarang();
        $data['barang'] = $data_barang;
        $this->load->view('barang/index', $data);

        // inlcude footer
        $this->load->view('templates/admin_footer');
    }

    /*
    ==============================================================
    Add Barang
    ==============================================================
    */
    // view
    public function tambah()
    {
        // set page title
        $header['title'] = 'Tambah Barang';

        $this->load->view('templates/admin_header', $header);
        $this->load->view('barang/add');

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
                'nama_barang' => $post["nama_barang"],
                'deskripsi_barang' => $post["deskripsi_barang"],
                'creaby' => "Arnida",
            );

            // save barang
            $result = $this->barang_model->save($insert_data);

            if ($result > 0) {
                redirect(site_url('barang'));
            } else {
                // error message
                $this->session->set_flashdata("failed", "Gagal menambah barang");
                redirect(site_url('barang/add'));
            }
        } else {
            $this->tambah();
        }
    }

    /*
    ==============================================================
    Edit Barang
    ==============================================================
    */
    public function ubah($id_barang)
    {
        //title
        $header['title'] = 'Ubah Barang';
        //template header
        $this->load->view('templates/admin_header', $header);

        $data_barang = $this->barang_model->getBarangID($id_barang);
        $data['data'] = $data_barang;
        $this->load->view('barang/edit', $data);
        //template footer
        $this->load->view('templates/admin_footer');
    }

    public function edit()
    {
        //models->fungsi edit
        $barang = $this->barang_model->edit();
        redirect(site_url('barang'));
    }

    /*
    ==============================================================
    Delete Barang
    ==============================================================
    */
    function destroy($id)
    {
        $delete = $this->barang_model->delete($id, 'Arnidalaili');
        if ($delete == true) {
            $this->session->set_flashdata("success", "Data berhasil dihapus.");
            redirect(site_url('barang'));
        } else {
            $this->session->set_flashdata("success", "Data gagal dihapus.");
            redirect(site_url('barang'));
        }
    }
}
