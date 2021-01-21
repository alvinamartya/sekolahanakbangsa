<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DashboardAdmin extends CI_Controller
{
    // view
    public function index()
    {
        $this->load->view('templates/dashboard_admin/header');
        $this->load->view('dashboard_admin');
        $this->load->view('templates/dashboard_admin/footer');
    }
}
