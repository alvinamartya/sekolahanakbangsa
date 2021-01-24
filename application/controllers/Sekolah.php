<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sekolah extends CI_Controller
{
    // constructor
    public function __construct()
    {
        parent::__construct();
        $this->load->model('sekolah_model');
    }

    /*
    ==============================================================
    View School
    ==============================================================
    */
    public function index()
    {
        // include header
        $this->load->view('templates/admin_header');

        // data sekolah
        $data_sekolah = $this->sekolah_model->getSekolah();
        $data['sekolah'] = $data_sekolah;
        $this->load->view('sekolah/view/body', $data);

        // inlcude footer
        $this->load->view('sekolah/view/footer');
    }

    /*
    ==============================================================
    Add School
    ==============================================================
    */
    public function tambah()
    {
        $this->load->view('templates/admin_header');
        $this->load->view('sekolah/add/body');
        $this->load->view('sekolah/add/footer');
    }

    public function tambah_action()
    {
        $post = $this->input->post();

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
            // success message
            $this->session->set_flashdata("success", "Berhasi menambah sekolah");
            redirect(site_url('sekolah/tambah'));
        } else {
            // error message
            $this->session->set_flashdata("failed", "Gagal menambah sekolah");
            redirect(site_url('sekolah/tambah'));
        }
    }

    /*
    ==============================================================
    Delete School
    ==============================================================
    */
    function destroy($id)
    {
        $delete = $this->sekolah_model->delete();
    }
}
