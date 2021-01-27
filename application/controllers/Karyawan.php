<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Karyawan extends CI_Controller
{
	// rules
    private $rules = [
        [
            'field' => 'nama_karyawan',
            'label' => 'Nama Karyawan',
            'rules' => 'required|callback_alpha_space'
        ], [
            'field' => 'nik',
            'label' => 'NIK',
            'rules' => 'required|numeric|min_length[16]|max_length[16]'
        ], [
            'field' => 'no_telepon',
            'label' => 'No Telepon',
            'rules' => 'required|numeric'
        ], [
            'field' => 'email',
            'label' => 'Email Pengguna',
            'rules' => 'required|valid_email'
        ], [
            'field' => 'tempat_lahir',
            'label' => 'Tempat Lahir',
            'rules' => 'required'
        ], [
            'field' => 'tanggal_lahir',
            'label' => 'Tanggal Lahir',
            'rules' => 'required'
        ], [
            'field' => 'username',
            'label' => 'Nama Pengguna',
            'rules' => 'required|is_unique[user_login.username]'
        ], [
            'field' => 'password',
            'label' => 'Kata sandi',
            'rules' => 'required'
        ], [
            'field' => 'ver_password',
            'label' => 'Konfirmasi Kata sandi',
            'rules' => 'required|matches[password]'
        ]
		
    ];
	private $edit_rules = [
        [
            'field' => 'nama_karyawan',
            'label' => 'Nama Karyawan',
            'rules' => 'required|callback_alpha_space'
        ], [
            'field' => 'nik',
            'label' => 'NIK',
            'rules' => 'required|numeric|min_length[16]|max_length[16]'
        ], [
            'field' => 'no_telepon',
            'label' => 'No Telepon',
            'rules' => 'required|numeric'
        ], [
            'field' => 'email',
            'label' => 'Email Pengguna',
            'rules' => 'required|valid_email'
        ], [
            'field' => 'tempat_lahir',
            'label' => 'Tempat Lahir',
            'rules' => 'required'
        ], [
            'field' => 'tanggal_lahir',
            'label' => 'Tanggal Lahir',
            'rules' => 'required'
        ]
		
    ];
    
	public function alpha_space($str)
    {
        return (preg_match('/^[a-zA-Z ]+$/', $str) ? TRUE : FALSE);
    }

    // form rules error message
    private $errorMessage = [
        'is_unique' => '%s sudah terdaftar.',
        'required' => '%s wajib diisi.',
        'valid_email' => '%s bukan email yang valid.',
        'alpha_space' => '%s hanya bisa diisi dengan huruf.',
        'numeric' => '%s hanya bisa diisi dengan angka.',
        'matches' => '%s tidak sama',
		'min_length' => '%s harus terdiri dari 16 angka',
		'max_length' => '%s harus terdiri dari 16 angka'
    ];
	// constructor
	public function __construct()
	{
		parent::__construct();
		$this->load->model('karyawan_model');
		$this->load->model('user_login_model');
		
		// form validation
        $this->load->library('form_validation');
        
        // set error message
        $this->form_validation->set_message($this->errorMessage);
	}

	private function getKaryawanName()
	{
		$this->load->model('karyawan_model');
		$user_id = $this->session->user_id;
		$karyawan = $this->karyawan_model->getKaryawanByUserLoginId($user_id);
		return $karyawan->nama_karyawan;
	}

	private function getKaryawanRole()
	{
		$this->load->model('karyawan_model');
		$user_id = $this->session->user_id;
		$karyawan = $this->karyawan_model->getKaryawanByUserLoginId($user_id);
		return $karyawan->jabatan_karyawan;
	}

	// login view
	public function index()
	{
		// set page title
		$header['title'] = 'Karyawan';

		// set employee 
		$header['name'] =  $this->getKaryawanName();
		$header['role'] =  $this->getKaryawanRole();

		// include header
		$this->load->view('templates/admin_header', $header);

		// data karyawan
		$data_karyawan = $this->karyawan_model->getAllData();
		$data['karyawan'] = $data_karyawan;
		$this->load->view('karyawan/index', $data);

		// inlcude footer
		$this->load->view('templates/footer');
	}

	public function tambah()
	{
		// set page title
		$header['title'] = 'Tambah Karyawan';

		// set employee 
		$header['name'] =  $this->getKaryawanName();
		$header['role'] =  $this->getKaryawanRole();

		// include header
		$this->load->view('templates/admin_header', $header);

		$this->load->view('karyawan/add');

		// inlcude footer
		$this->load->view('templates/footer');
	}

	public function add()
	{
		$karyawan = $this->karyawan_model;
		$user_login = $this->user_login_model;
		
		// set rules
        $this->form_validation->set_rules($this->rules);
		
		if ($this->form_validation->run() == true)
		{
			$result = $user_login->saveKaryawan();
			if ($result < 0) {
				$this->session->set_flashdata("failed", "Data gagal ditambahkan.");	
				$this->gagal();
				return;
			}
			$result = $karyawan->save();
			if ($result > 0)
			{
				$this->session->set_flashdata("success", "Data berhasil ditambahkan.");
				$this->sukses();
			}			
			else
			{
				$this->session->set_flashdata("failed", "Data gagal ditambahkan.");	
				$this->gagal();	
			} 
		}else{
			$this->tambah();
		}
		
	}

	public function ubah($id_karyawan)
	{
		// set page title
		$header['title'] = 'Ubah Karyawan';

		// set employee 
		$header['name'] =  $this->getKaryawanName();
		$header['role'] =  $this->getKaryawanRole();

		// include header
		$this->load->view('templates/admin_header', $header);

		//ambil data karyawan
		$data_karyawan = $this->karyawan_model->getKaryawan($id_karyawan);
		$data['data'] = $data_karyawan;
		$this->load->view('karyawan/edit', $data);

		// inlcude footer
		$this->load->view('templates/footer');
	}

	public function edit()
	{
		$karyawan = $this->karyawan_model;
		
		//var_dump($this->form_validation->run());
		// set rules
        $this->form_validation->set_rules($this->edit_rules);
		
		if ($this->form_validation->run() == true)
		{
			$result = $karyawan->edit();
			if ($result > 0){
				$this->session->set_flashdata("success", "Data berhasil diubah.");
				$this->sukses();	
			}else{
				$this->session->set_flashdata("failed", "Data gagal diubah.");
				$this->gagal();	
			} 
		}else{
			//ketampilan tambah
            $data = $this->input->post();
            $this->ubah($data['id_karyawan']);
		}
		
	}

	public function hapus($id_karyawan)
	{
		$data_karyawan = $this->karyawan_model;
		$result = $data_karyawan->hapus($id_karyawan);
		if ($result > 0) $this->sukses();
		else $this->gagal();
	}

	function sukses()
	{
		redirect(base_url('Karyawan'));
	}
	function gagal()
	{
		echo "<script>alert('Input data gagal')</script>";
		redirect(base_url('Karyawan'));
	}
}
