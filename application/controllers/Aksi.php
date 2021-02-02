<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Aksi extends CI_Controller
{
    // rules
    private $rules = [
        [
            'field' => 'nama_aksi',
            'label' => 'Nama Aksi',
            'rules' => 'required|callback_alpha_space'
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
        $this->load->model('aksi_model');
        $this->load->model('aksi_biaya_model');
        $this->load->model('aksi_barang_model');
        $this->load->model('biaya_lainnya_model');
        $this->load->model('barang_model');

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
        $data_aksi = $this->aksi_model->getAksi($relawan->id_relawan);
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

        if($data_aksi != null) {
            $this->load->view('aksi/add', $data);
        } else {
            $this->load->view('templates/relawan_header', $header);
            $this->load->view('aksi/add', $data);

            // inlcude footer
            $this->load->view('aksi/footer');
        }
    }

    // action
    public function add()
    {
        // get relawan
        $relawan = $this->getRelawanSession();
        $post = $this->input->post();

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

            if($post["biaya"] != null) {
                // foreach data biaya
                foreach($post["biaya"] as $biaya) {
                    $biaya_data = array(
                        'id_aksi' => $aksi_id,
                        'id_biaya_lainnya' => $biaya["id_biaya"],
                        'biaya' => $biaya["harga"],
                        'creaby' => $relawan->nama_relawan,
                        'modiby' => $relawan->nama_relawan,
                        'row_status' => 'A'
                    );

                    $this->aksi_biaya_model->save($biaya_data);
                }
            }

            if($post["barang"] != null) {
                // foreach data barang
                foreach($post["barang"] as $barang) {
                    $barang_data = array(
                        'id_aksi' => $aksi_id,
                        'id_barang' => $barang["id_barang"],
                        'jumlah' => $barang["jumlah"],
                        'harga_satuan' => $barang["harga_satuan"],
                        'creaby' => $relawan->nama_relawan,
                        'modiby' => $relawan->nama_relawan,
                        'row_status' => 'A'
                    );

                    $this->aksi_barang_model->save($barang_data);
                }
            }

            $this->session->set_flashdata("success", "Data berhasil ditambahkan.");
            echo json_encode(['success' => true, 'message' => '']);
        } else {
            echo json_encode(['success' => false, 'message' => validation_errors()]);
        }
    }

}
?>