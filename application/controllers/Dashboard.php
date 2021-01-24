<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    // view
    public function admin()
    {
        // set page title
        $header['title'] = "Dashboard";

        $this->load->view('templates/admin_header', $header);
        $this->load->view('dashboard/admin');
        $this->load->view('templates/admin_footer');
    }

    public function relawan()
    {
        // set page title
        $header['title'] = "Dashboard";

        $this->load->view('templates/relawan_header', $header);
        $this->load->view('dashboard/relawan');
        $this->load->view('templates/relawan_footer');
    }
}
