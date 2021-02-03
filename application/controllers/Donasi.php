<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Donasi extends CI_Controller
{
	 // rules
	 private $rules = [
        [
            'field' => 'donasi',
            'label' => 'Donasi',
            'rules' => 'required'
        ], [
            'field' => 'keterangan',
            'label' => 'Keterangan',
            'rules' => 'required'
        ],
    ];

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
		$this->load->model('aksi_barang_model');
		$this->load->model('aksi_biaya_lainnya_model');
		$this->load->model('aksi_model');
		$this->load->model('biaya_lainnya_model');
		$this->load->model('donatur_aksi_model');
		$this->load->model('donatur_model');
		$this->load->model('gambar_aksi_model');
		$this->load->model('relawan_model');
		$this->load->model('status_aksi_model');

		//validasi
		$this->load->library('form_validation');
        // set rules
        $this->form_validation->set_rules($this->rules);
        // set error message
        $this->form_validation->set_message($this->errorMessage);
	}

	public function index()
	{
		$get = $this->input->get();

		$id = $get["id"];

		$header['isLogin'] = $this->session->is_login == null ? false : $this->session->is_login;
		// include header
		$this->load->view('templates/donatur_header', $header);

		// main
		$data_aksi = $this->aksi_model->getAksi($id);
		$data_barang = $this->barang_model->getBarang();
		$data_relawan = $this->relawan_model->getByID($data_aksi->id_relawan);
		$data_aksi_barang = $this->aksi_barang_model->getAksiBarangByIdAksi($id);
		$data_aksi_biaya_lainnya = $this->aksi_biaya_lainnya_model->getBiayaLainnyaByIdAksi($id);
		$data_biaya_lainnya = $this->biaya_lainnya_model->getBiayaLainnya();
		$data_donatur_aksi = $this->donatur_aksi_model->getDanaValidByIdAksi($id);
		$data_gambar_aksi = $this->gambar_aksi_model->getGambarByIdAksi($id);

		$data['data_aksi'] = $data_aksi;
		$data['data_barang'] = $data_barang;
		$data['data_relawan'] = $data_relawan;
		$data['data_aksi_barang'] = $data_aksi_barang;
		$data['data_aksi_biaya_lainnya'] = $data_aksi_biaya_lainnya;
		$data['data_biaya_lainnya'] = $data_biaya_lainnya;
		$data['data_donatur_aksi'] = $data_donatur_aksi;
		$data['data_gambar_aksi'] = $data_gambar_aksi;

		$this->load->view('home/aksi-detail', $data);

		// inlcude footer
		$this->load->view('templates/donatur_footer');
	}

    public function pembayaran()
    {
		$get = $this->input->get();
		$id = $get["id"];

		$header['isLogin'] = $this->session->is_login == null ? false : $this->session->is_login;

		// include header
		$this->load->view('templates/donatur_header', $header);

		$data['idkembali'] = $get["id"];
		$data_aksi = $this->aksi_model->getAksi($id);
		$data['data_aksi'] = $data_aksi;

		$this->load->view('home/pembayaran', $data);

		// inlcude footer
		$this->load->view('templates/donatur_footer');
    }

    public function upload_bukti($id)
    {

		$get = $this->input->get();

		$header['isLogin'] = $this->session->is_login == null ? false : $this->session->is_login;

		// include header
		$this->load->view('templates/donatur_header', $header);

		$data_donatur_aksi = $this->donatur_aksi_model->getAksi($id);
		$data['data_aksi'] = $data_donatur_aksi;
		$this->load->view('home/upload-bukti', $data);

		// inlcude footer
		$this->load->view('templates/donatur_footer');
	}


	public function getnumber($string)
	{
		return intval(preg_replace('/[^0-9]+/', '', $string), 10);
	}

	public function add($id)
    {
        $post = $this->input->post();
		var_dump($this->session->id_donatur);
        if ($this->form_validation->run() == true) {

            // insert data
            $insert_data = array(
                'id_donatur' => $this->session->id_donatur,
                'id_aksi' => $id,
                'id_status_aksi' => 1,
                'donasi' => $this->getnumber($post["donasi"]),
                'keterangan' => $post["keterangan"],
                'creaby' => $this->session->nama_donatur,
                'modiby' => $this->session->nama_donatur,
            );

            //save
            $result = $this->donatur_aksi_model->save($insert_data);

            if ($result > 0) {
				$idgetlast = $this->donatur_aksi_model->getLastData();
                $this->session->set_flashdata("success", "Data berhasil ditambahkan.");
                redirect(site_url('donasi/upload_bukti/'. $idgetlast->id));
            } else {
                // error message
                $this->session->set_flashdata("failed", "Gagal menambah donasi");
                redirect(site_url('pembayaran'));
            }
        } else {
            $this->pembayaran((object)$post);
        }
	}

	public function update($id)
    {
        $post = $this->input->post();

        $bukti = $_FILES['foto'];

        if($bukti=''){}else{
            $config['upload_path']      = './assets/images/bukti_transfer';
            $config['allowed_types']    = 'jpg|jpeg|png';
            $this->load->library('upload',$config);
            if(!$this->upload->do_upload('foto')){
                redirect(site_url('home/donatur'));
            }else{
                $bukti=$this->upload->data('file_name');
            }
        }
        // insert data
        $update = array(
            'id_status_aksi' => 2,
            'bukti_transfer' => $bukti,
        );

        // save school
        $result = $this->donatur_aksi_model->update($id, $update);

        if ($result > 0) {
            $this->session->set_flashdata("success", "Data berhasil diubah");
            redirect(site_url('home/donatur'));
        } else {
            // error message
            $this->session->set_flashdata("failed", "Gagal mengubah sekolah");
            redirect(site_url('home/donatur'));
        }
	}
}
