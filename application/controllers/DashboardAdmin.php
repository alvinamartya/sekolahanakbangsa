<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DashboardAdmin extends CI_Controller
{
    // view
    public function index()
    {
        $this->load->view('templates/header');
        $this->load->view('dashboard_admin/body');
        $this->load->view('dashboard_admin/footer');
    }
}
