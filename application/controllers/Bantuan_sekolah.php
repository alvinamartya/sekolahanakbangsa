<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bantuan_sekolah extends CI_Controller
{
	// constructor
    public function __construct()
    {
        parent::__construct();

        //load ke model siswa
        $this->load->model('barang_model');        
    }
		

}