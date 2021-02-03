<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Aksi extends CI_Controller
{
    // rules
    private $rules = [
        [
            'field' => 'nama_aksi',
            'label' => 'Nama Aksi',
            'rules' => 'required'
        ], [
            'field' => 'tanggal_selesai',
            'label' => 'Tanggal Selesai',
            'rules' => 'required'
        ], [
            'field' => 'deskripsi_aksi',
            'label' => 'Deskripsi Aksi',
            'rules' => 'required'
        ],
    ];

    // form rules error message
    private $errorMessage = [
        'required' => '%s wajib diisi.'
    ];

    // constructor
    public function __construct()
    {
        parent::__construct();

        //load ke model siswa
        $this->load->model('aksi_model');
        $this->load->model('aksi_biaya_lainnya_model');
        $this->load->model('aksi_barang_model');
        $this->load->model('biaya_lainnya_model');
        $this->load->model('barang_model');
        $this->load->model('gambar_aksi_model');

        // form validation
        $this->load->library('form_validation');
        // set rules
        $this->form_validation->set_rules($this->rules);
        // set error message
        $this->form_validation->set_message($this->errorMessage);
    }

    private function getRelawanSession()
    {
        $this->load->model('relawan_model');
        $user_id = $this->session->user_id;
        $relawan = $this->relawan_model->getRelawanByUserLoginId($user_id);
        return $relawan;
    }

    /*
    ==============================================================
    View Aksi
    ==============================================================
    */
    public function index()
    {
        $relawan = $this->getRelawanSession();
        // set relawan
        $header['name'] =  $relawan->nama_relawan;
        $header['role'] =  'Relawan';

        // set page title
        $header['title'] = 'Aksi';
        $header['active'] = $relawan->id_sekolah != null;

        // include header
        $this->load->view('templates/relawan_header', $header);

        // data sekolah
        $data_aksi = $this->aksi_model->getAksiByRelawan($relawan->id_relawan);
        $data['aksi'] = $data_aksi;
        $this->load->view('aksi/index', $data);

        // inlcude footer
        $this->load->view('templates/footer');
    }

    /*
    ==============================================================
    Add Aksi
    ==============================================================
    */
    // view
    public function tambah()
    {
        $this->tambahView(null);
    }

    private function tambahView($data_aksi)
    {
        // set relawan
        $relawan = $this->getRelawanSession();
        // set page title
        $header['name'] =  $relawan->nama_relawan;
        $header['role'] =  'Relawan';
        $header['title'] = 'Tambah Aksi';
        $header['active'] = $relawan->id_sekolah != null;

        $data['aksi'] = $data_aksi;
        $data['biaya_lainnya'] = $this->biaya_lainnya_model->getBiayaLainnya();
        $data['barang'] = $this->barang_model->getBarang();

        if ($data_aksi != null) {
            $this->load->view('aksi/add', $data);
        } else {
            $this->load->view('aksi/header', $header);
            $this->load->view('aksi/add', $data);

            // inlcude footer
            $this->load->view('aksi/footer');
        }
    }

    public function uploadImage($id_aksi, $files)
    {
        $relawan = $this->getRelawanSession();

        for ($i = 0; $i < count($files['name']); $i++) {

            if (!empty($files['name'][$i])) {
                $_FILES['file']['name'] = $files['name'][$i];
                $_FILES['file']['type'] = $files['type'][$i];
                $_FILES['file']['tmp_name'] = $files['tmp_name'][$i];
                $_FILES['file']['error'] = $files['error'][$i];
                $_FILES['file']['size'] = $files['size'][$i];

                $config['upload_path'] = 'assets/images/aksi/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['max_size'] = '5000';
                $config['file_name'] = date('Ymdhis') . $i;

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('file')) {
                    $uploadData = $this->upload->data();
                    $filename = $uploadData['file_name'];

                    $gambar = array(
                        'id_aksi' => $id_aksi,
                        'gambar' => $filename,
                        'creaby' => $relawan->nama_relawan,
                        'modiby' => $relawan->nama_relawan,
                        'row_status' => 'A'
                    );

                    $this->gambar_aksi_model->save($gambar);
                }
            }
        }
    }

    // action
    public function add()
    {
        // get relawan
        $relawan = $this->getRelawanSession();
        $post = $this->input->post();

        $biaya = json_decode(isset($post["biaya"]) ? $post["biaya"] : null);
        $barang = json_decode(isset($post["barang"]) ? $post["barang"] : null);
        $gambar = json_decode(isset($post["gambar"]) ? $post["gambar"] : null);

        if ($this->form_validation->run() == true) {
            // insert data
            $aksi_data = array(
                'id_relawan' => $relawan->id_relawan,
                'nama_aksi' => $post["nama_aksi"],
                'tanggal_selesai' => $post["tanggal_selesai"],
                'target_donasi' => $post['target_donasi'],
                'deskripsi_aksi' => $post["deskripsi_aksi"],
                'creaby' => $relawan->nama_relawan,
                'modiby' => $relawan->nama_relawan,
                'row_status' => 'A'
            );

            $this->aksi_model->save($aksi_data);

            $aksi_id = $this->aksi_model->getLastData()->id_aksi;

            if ($biaya != null) {
                // foreach data biaya
                foreach ($biaya as $b) {
                    $biaya_data = array(
                        'id_aksi' => $aksi_id,
                        'id_biaya_lainnya' => $b->id_biaya,
                        'biaya' => $b->harga,
                        'creaby' => $relawan->nama_relawan,
                        'modiby' => $relawan->nama_relawan,
                        'row_status' => 'A'
                    );

                    $this->aksi_biaya_lainnya_model->save($biaya_data);
                }
            }

            if ($barang != null) {
                // foreach data barang
                foreach ($barang as $b) {
                    $barang_data = array(
                        'id_aksi' => $aksi_id,
                        'id_barang' => $b->id_barang,
                        'jumlah' => $b->jumlah,
                        'harga_satuan' => $b->harga_satuan,
                        'creaby' => $relawan->nama_relawan,
                        'modiby' => $relawan->nama_relawan,
                        'row_status' => 'A'
                    );

                    $this->aksi_barang_model->save($barang_data);
                }
            }

            if (!empty($_FILES['files']['name'])) {
                $this->uploadImage($aksi_id, $_FILES["files"]);
            }

            $this->session->set_flashdata("success", "Data berhasil ditambahkan.");
            echo json_encode(['success' => true, 'message' => '']);
        } else {
            echo json_encode(['success' => false, 'message' => validation_errors()]);
        }
    }

    /*
    ==============================================================
    Edit Aksi
    ==============================================================
    */
    public function ubah($id_aksi)
    {
        $aksi = $this->aksi_model->getByID($id_aksi);
        $this->ubahView($aksi);
    }

    private function ubahView($aksi)
    {
        //title
        // set relawan
        $relawan = $this->getRelawanSession();
        // set page title
        $header['name'] =  $relawan->nama_relawan;
        $header['role'] =  'Relawan';
        $header['title'] = 'Ubah Aksi';
        $header['active'] = $relawan->id_sekolah != null;

        $data['aksi'] = $aksi;
        $data['biaya_lainnya'] = $this->biaya_lainnya_model->getBiayaLainnya();
        $data['barang'] = $this->barang_model->getBarang();
        $data['aksi_biaya'] = $this->aksi_biaya_lainnya_model->getByID($aksi->id_aksi);
        $data['aksi_barang'] = $this->aksi_barang_model->getByID($aksi->id_aksi);
        $data['aksi_gambar'] = $this->gambar_aksi_model->getGambarByIdAksi($aksi->id_aksi);


        //template header
        $this->load->view('templates/relawan_header', $header);

        $this->load->view('aksi/edit', $data);

        //template footer
        $this->load->view('aksi/footer_edit');
    }

    public function edit($aksi_id)
    {
        // get relawan
        $relawan = $this->getRelawanSession();
        $post = $this->input->post();
        $biaya = json_decode(isset($post["biaya"]) ? $post["biaya"] : null);
        $barang = json_decode(isset($post["barang"]) ? $post["barang"] : null);
        $gambar = json_decode(isset($post["gambar"]) ? $post["gambar"] : null);

        if ($this->form_validation->run() == true) {
            // insert data
            $aksi_data = array(
                'id_relawan' => $relawan->id_relawan,
                'nama_aksi' => $post["nama_aksi"],
                'tanggal_selesai' => $post["tanggal_selesai"],
                'target_donasi' => $post['target_donasi'],
                'deskripsi_aksi' => $post["deskripsi_aksi"],
                'modiby' => $relawan->nama_relawan,
                'modidate' => date("Y-m-d H:i:s"),
                'row_status' => 'A'
            );

            $this->aksi_model->update($aksi_id, $aksi_data);
            if($biaya != null) {
                // foreach data biaya
                foreach($biaya as $b) {

                    $biaya_data = array(
                        'id_aksi' => $aksi_id,
                        'id_biaya_lainnya' => $b->id_biaya,
                        'biaya' => $b->harga,
                        'modiby' => $relawan->nama_relawan,
                        'modidate' => date("Y-m-d H:i:s"),
                        'row_status' => $b->row_status
                    );

                    // Check apakah id kosong, jika belum punya id, tambah data, jika sudah punya id, update data
                    if(!isset($b->id)) {
                        // hanya menambahkan data dengan row_status A
                        if($b->row_status == 'A') {
                            $this->aksi_biaya_lainnya_model->save($biaya_data);
                        }
                    } else {
                        // Update data
                        $this->aksi_biaya_lainnya_model->update($b->id, $biaya_data);
                    }
                }
            }

            if($barang != null) {
                // foreach data barang
                foreach($barang as $b) {
                    $barang_data = array(
                        'id_aksi' => $aksi_id,
                        'id_barang' => $b->id_barang,
                        'jumlah' => $b->jumlah,
                        'harga_satuan' => $b->harga_satuan,
                        'modiby' => $relawan->nama_relawan,
                        'modidate' => date("Y-m-d H:i:s"),
                        'row_status' => $b->row_status
                    );

                    // Check apakah id kosong, jika belum punya id, tambah data, jika sudah punya id, update data
                    if(!isset($b->id)) {
                        // hanya menambahkan data dengan row_status A
                        if($b->row_status == 'A') {
                            $this->aksi_barang_model->save($barang_data);
                        }
                    } else {
                        // Update data
                        $this->aksi_barang_model->update($b->id, $barang_data);
                    }
                }
            }

            if($gambar != null) {
                // foreach data barang
                foreach($gambar as $b) {
                    $gambar_data = array(
                        'id_aksi' => $aksi_id,
                        'gambar' => $b->gambar,
                        'modiby' => $relawan->nama_relawan,
                        'modidate' => date('Y-m-d'),
                        'row_status' => $b->row_status
                    );


                    // Check apakah id kosong, jika belum punya id, tambah data, jika sudah punya id, update data
                    if(!isset($b->id)) {
                        // hanya menambahkan data dengan row_status A
                        if($b->row_status == 'A') {
                            $this->gambar_aksi_model->save($gambar_data);
                        }
                    } else {
                        //hapus image jika row_status == D
                        if($b->row_status == 'D') {
                            // delete image
                            if (is_file('assets/images/aksi/'.$b->gambar)) {
                                unlink('assets/images/aksi/'.$b->gambar);
                            }

                            $this->gambar_aksi_model->delete($b->id);
                        }
                    }
                }
            }

            if (!empty($_FILES['files']['name'])) {
                $this->uploadImage($aksi_id, $_FILES["files"]);
            }

            $this->session->set_flashdata("success", "Data berhasil diubah.");
            echo json_encode(['status' => true, 'message' => '']);
        } else {
            echo json_encode(['status' => false, 'message' => validation_errors()]);
        }
    }
}
