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
        // set page title
        $relawan = $this->getRelawanSession();
        // set relawan
        $header['name'] =  $relawan->nama_relawan;
        $header['role'] =  'Relawan';
        $header['title'] = 'Tambah Aksi';
        $header['active'] = $relawan->id_sekolah != null;


        $data['aksi'] = $data_aksi;
        $data['biaya_lainnya'] = $this->biaya_lainnya_model->getBiayaLainnya();
        $data['barang'] = $this->barang_model->getBarang();

        $this->load->view('templates/relawan_header', $header);
        $this->load->view('aksi/add', $data);

        // inlcude footer
        $this->load->view('aksi/footer');
    }

    // action
    public function add()
    {
        $post = $this->input->post();

        include_once(APPPATH . 'libraries\AksiData.php');
        AksiData::setInstance([
            'nama' => 'Polman Astra'
        ]);

        var_dump(AksiData::getInstance());


        // $this->session->set_flashdata("success", "Data berhasil ditambahkan.");
        // header('Content-Type: application/json');
        // echo json_encode(['result' => true]);

        // if ($this->form_validation->run() == true) {
        //     // insert data
        //     $insert_data = array(
        //         'nama_aksi' => $post["nama_aksi"],
        //         'deskripsi_aksi' => $post["deskripsi_aksi"],
        //         'creaby' => $this->getKaryawanName(),
        //         'modiby' => $this->getKaryawanName(),
        //     );

        //     // save aksi
        //     $result = $this->aksi_model->save($insert_data);

        //     if ($result > 0) {
        //         $this->session->set_flashdata("success", "Data berhasil ditambahkan.");
        //         redirect(site_url('aksi'));
        //     } else {
        //         // error message
        //         $this->session->set_flashdata("failed", "Gagal menambah aksi");
        //         redirect(site_url('aksi/add'));
        //     }
        // } else {
        //     $this->tambahView((object)$post);
        // }
    }

}
?>