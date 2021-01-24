<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Donatur extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('donatur_model');
        $this->load->model('login_model');
    }

    public function index()
    {
        $donatur = $this->donatur_model;

        // set page title
        $header['title'] = 'Donatur';
        // get data
        $data['data'] = $donatur->getAll();

        $this->load->view('templates/admin_header', $header);
        $this->load->view('donatur/index', $data);
        $this->load->view('templates/admin_footer');
    }

    public function destroy($id)
    {
        // model
        $donatur = $this->donatur_model;
        $userlogin = $this->login_model;

        $id_userlogin = $donatur->getByID($id)->id_user_login;

        // delete
        $donatur->delete($id);
        $userlogin->delete($id_userlogin);

        $this->session->set_flashdata("success", "Data berhasil dihapus.");
        redirect(site_url('donatur'));
    }

}
