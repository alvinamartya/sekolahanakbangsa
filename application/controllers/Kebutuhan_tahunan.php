<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kebutuhan_tahunan extends CI_Controller
{
    // rules
    private $rules = [
        [
            'field' => 'year',
            'label' => 'Tahun',
            'rules' => 'required'
        ], [
            'field' => 'desc',
            'label' => 'Deskripsi',
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
        //load ke model kebutuhan lainnya
        $this->load->model('kt_biaya_lainnya_model');
        $this->load->model('kt_barang_model');
        $this->load->model('biaya_lainnya_model');
        $this->load->model('barang_model');
        $this->load->model('kebutuhan_tahunan_model');
        $this->load->model('sekolah_model');

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

    private function getKaryawan()
	{
		$this->load->model('karyawan_model');
		$user_id = $this->session->user_id;
        return $this->karyawan_model->getKaryawanByUserLoginId($user_id);
    }

    /*
    ==============================================================
    View Kebutuhan Tahunan
    ==============================================================
    */
    public function index()
    {
        $relawan = $this->getRelawanSession();
        // set relawan
        $header['name'] =  $relawan->nama_relawan;
        $header['role'] =  'Relawan';

        // set page title
        $header['title'] = 'Kebutuhan Tahunan';
        $header['active'] = $relawan->id_sekolah != null;

        // include header
        $this->load->view('templates/relawan_header', $header);

        // data sekolah
        $data_kt = $this->kebutuhan_tahunan_model->getKebutuhanTahunanByRelawan($relawan->id_relawan);
        $data['kebutuhan_tahunan'] = $data_kt;
        $this->load->view('kebutuhan_tahunan/index', $data);

        // inlcude footer
        $this->load->view('templates/footer');
    }

    /*
    ==============================================================
    Add Kebutuhan Tahunan
    ==============================================================
    */
    public function tambah()
    {
        $this->tambahView(null);
    }

    private function tambahView($data_kt)
    {
        // set relawan
        $relawan = $this->getRelawanSession();
        // set page title
        $header['title'] = 'Kebutuhan Tahunan';
        $header['name'] =  $relawan->nama_relawan;
        $header['active'] = $relawan->id_sekolah != null;

        $data['kt'] = $data_kt;
        $data['biaya_lainnya'] = $this->biaya_lainnya_model->getBiayaLainnya();
        $data['barang'] = $this->barang_model->getBarang();

        if ($data_kt != null) {
            $this->load->view('kebutuhan_tahunan/add', $data);
        } else {
            $this->load->view('kebutuhan_tahunan/header', $header);
            $this->load->view('kebutuhan_tahunan/add', $data);

            // inlcude footer
            $this->load->view('kebutuhan_tahunan/footer');
        }
    }


    // action
    public function add()
    {
        // get relawan
        $relawan = $this->getRelawanSession();
        $post = $this->input->post();

        $biaya = json_decode($post["biaya"]);
        $barang = json_decode($post["barang"]);

        if ($this->form_validation->run() == true) {
            $is_approved_data = $this->kebutuhan_tahunan_model->getKebutuhanTahunanByYearAndSchool($post["year"], $relawan->id_sekolah);
            $is_process_data = $this->kebutuhan_tahunan_model->getKebutuhanTahunanByYearAndSchoolProcess($post["year"], $relawan->id_sekolah);

            if ($is_approved_data != null) {
                echo json_encode(['success' => false, 'message' => '<p>Kebutuhan tahun ' . $post["year"] . ' sudah disetujui.</p>']);
            } else if ($is_process_data != null) {
                echo json_encode(['success' => false, 'message' => '<p>Kebutuhan tahun ' . $post["year"] . ' sedang diproses.</p>']);
            } else {
                // insert data
                $aksi_data = array(
                    'id_relawan' => $relawan->id_relawan,
                    'id_sekolah' => $relawan->id_sekolah,
                    'tahun' => $post["year"],
                    'total_kebutuhan' => $post['target_donasi'],
                    'deskripsi' => $post["desc"],
                    'creaby' => $relawan->nama_relawan,
                    'modiby' => $relawan->nama_relawan,
                    'row_status' => 'A'
                );

                $this->kebutuhan_tahunan_model->save($aksi_data);

                $kt_id = $this->kebutuhan_tahunan_model->getLastData()->id;
                if ($biaya != null) {
                    // foreach data biaya
                    foreach ($biaya as $b) {
                        $biaya_data = array(
                            'id_kt' => $kt_id,
                            'id_biaya_lainnya' => $b->id_biaya,
                            'biaya' => $b->harga,
                            'creaby' => $relawan->nama_relawan,
                            'modiby' => $relawan->nama_relawan,
                            'row_status' => 'A'
                        );

                        $this->kt_biaya_lainnya_model->save($biaya_data);
                    }
                }

                if ($barang != null) {
                    // foreach data barang
                    foreach ($barang as $b) {
                        $barang_data = array(
                            'id_kt' => $kt_id,
                            'id_barang' => $b->id_barang,
                            'jumlah' => $b->jumlah,
                            'harga_satuan' => $b->harga_satuan,
                            'creaby' => $relawan->nama_relawan,
                            'modiby' => $relawan->nama_relawan,
                            'row_status' => 'A'
                        );

                        $this->kt_barang_model->save($barang_data);
                    }
                }
                $this->session->set_flashdata("success", "Data berhasil ditambahkan.");
                echo json_encode(['success' => true, 'message' => '']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => validation_errors()]);
        }
    }

    /*
    ==============================================================
    Edit Kebutuhan Tahunan
    ==============================================================
    */
	public function edit($kt_id)
    {
        $this->editView($kt_id);
    }
	private function editView($kt_id)
    {
        // set relawan
        $relawan = $this->getRelawanSession();
        // set page title
        $header['title'] = 'Kebutuhan Tahunan';
        $header['name'] =  $relawan->nama_relawan;
        $header['active'] = $relawan->id_sekolah != null;

        $data['kt'] = $this->kebutuhan_tahunan_model->getKebutuhanTahunan($kt_id);
		$data['kt_biaya_lainnya'] = $this->kt_biaya_lainnya_model->getByID($kt_id);
		$data['kt_barang'] = $this->kt_barang_model->getByID($kt_id);
        $data['biaya_lainnya'] = $this->biaya_lainnya_model->getBiayaLainnya();
        $data['barang'] = $this->barang_model->getBarang();

		$this->load->view('kebutuhan_tahunan/header', $header);
		$this->load->view('kebutuhan_tahunan/edit', $data);

		// inlcude footer
		$this->load->view('kebutuhan_tahunan/footer_edit');

    }


	public function ubah($kt_id)
    {
        // get relawan
        $relawan = $this->getRelawanSession();
        $post = $this->input->post();

        $biaya = json_decode(isset($post["biaya"]) ? $post["biaya"] : null);
        $barang = json_decode(isset($post["barang"]) ? $post["barang"] : null);

        if ($this->form_validation->run() == true) {
            $kt_data = $this->kebutuhan_tahunan_model->getByID($kt_id);
            $is_process_data = $this->kebutuhan_tahunan_model->getKebutuhanTahunanByYearAndSchoolAll($post["year"], $relawan->id_sekolah);

            if ($is_process_data != null) {
                if($is_process_data->tahun != $kt_data->tahun) {
                    echo json_encode(['success' => false, 'message' => '<p>Kebutuhan tahun ' . $post["year"] . ' sudah terbuat.</p>']);
                    return;
                }
            }

            $aksi_data = array(
                'id_relawan' => $relawan->id_relawan,
                'id_sekolah' => $relawan->id_sekolah,
                'tahun' => $post["year"],
                'total_kebutuhan' => $post['target_donasi'],
                'deskripsi' => $post["desc"],
                'creaby' => $relawan->nama_relawan,
                'modiby' => $relawan->nama_relawan,
                'row_status' => 'A'
            );

            $this->kebutuhan_tahunan_model->update($kt_id, $aksi_data);
            if($biaya != null) {
                // foreach data biaya
                foreach($biaya as $b) {

                    $biaya_data = array(
                        'id_kt' => $kt_id,
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
                            $this->kt_biaya_lainnya_model->save($biaya_data);
                        }
                    } else {
                        // Update data
                        $this->kt_biaya_lainnya_model->update($b->id, $biaya_data);
                    }
                }
            }

            if($barang != null) {
                // foreach data barang
                foreach($barang as $b) {
                    $barang_data = array(
                        'id_kt' => $kt_id,
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
                            $this->kt_barang_model->save($barang_data);
                        }
                    } else {
                        // Update data
                        $this->kt_barang_model->update($b->id, $barang_data);
                    }
                }
            }

            $this->session->set_flashdata("success", "Data berhasil diubah.");
            echo json_encode(['status' => true, 'message' => '']);

        } else {
            echo json_encode(['status' => false, 'message' => validation_errors()]);
        }


    }
    /*

    /*
    ==============================================================
    Delete Kebutuhan Tahunan
    ==============================================================
    */
    function destroy($id)
    {
        $relawan = $this->getRelawanSession();
        $kebutuhan_tahunan = $this->kebutuhan_tahunan_model->getKebutuhanTahunan($id);
        if ($kebutuhan_tahunan->is_approved == 'Disetujui') {
            $this->session->set_flashdata("failed", "Kebutuhan tahunan yang sudah disetujui tidak dapat dihapus");
            redirect(site_url('kebutuhan-tahunan'));
        } else {
            $delete = $this->kebutuhan_tahunan_model->delete($id, $relawan->nama_relawan);
            if ($delete == true) {
                $this->session->set_flashdata("success", "Data berhasil dihapus.");
                redirect(site_url('kebutuhan-tahunan'));
            } else {
                $this->session->set_flashdata("failed", "Data gagal dihapus.");
                redirect(site_url('kebutuhan-tahunan'));
            }
        }
    }

    /*
    ==============================================================
    Delete Kebutuhan Tahunan
    ==============================================================
    */
    public function detail($id)
    {
        // set page title
        $header['title'] = "Dashboard Admin";

        // set employee
        $relawan = $this->getRelawanSession();

        // set page title
        $header['title'] = 'Kebutuhan Tahunan';
        $header['name'] =  $relawan->nama_relawan;
        $header['active'] = $relawan->id_sekolah != null;

        $this->load->model('barang_model');
        $this->load->model('biaya_lainnya_model');
        $this->load->model('kt_barang_model');
        $this->load->model('kt_biaya_lainnya_model');

        $data_kebutuhan_tahunan = $this->kebutuhan_tahunan_model->getKebutuhanTahunanById($id);
        $data_sekolah = $this->sekolah_model->getSekolahById($data_kebutuhan_tahunan->id_sekolah);
        $data_relawan = $this->relawan_model->getByID($data_kebutuhan_tahunan->id_relawan);
        $data_barang = $this->barang_model->getBarang();
        $data_biaya_lainnya = $this->biaya_lainnya_model->getBiayaLainnya();
        $data_kt_barang = $this->kt_barang_model->getKtBarangByIdKt($id);
        $data_kt_biaya_lainnya = $this->kt_biaya_lainnya_model->getKtBiayaLainnyaByIdKt($id);

        $data['kebutuhan_tahunan'] = $data_kebutuhan_tahunan;
        $data['sekolah'] = $data_sekolah;
        $data['relawan'] = $data_relawan;
        $data['barang'] = $data_barang;
        $data['biaya_lainnya'] = $data_biaya_lainnya;
        $data['kt_barang'] = $data_kt_barang;
        $data['kt_biaya_lainnya'] = $data_kt_biaya_lainnya;

        $this->load->view('templates/relawan_header', $header);

        $this->load->view('kebutuhan_tahunan/detail', $data);

        $this->load->view('templates/footer');
    }

    /*
    ==============================================================
    Upload LPJ Kebutuhan Tahunan
    ==============================================================
    */
    public function unggahlpj($id)
    {
        $relawan = $this->getRelawanSession();

        if (!empty($_FILES['lpj']['name'])) {

            $config['upload_path'] = 'assets/lpj/';
            $config['allowed_types'] = 'docx|doc|xlsx|xls';
            $config['max_size'] = '5000';
            $config['file_name'] = date('Ymdhis');


            $this->load->library('upload', $config);

            if ($this->upload->do_upload('lpj')) {
                $uploadData = $this->upload->data();
                $filename = $uploadData['file_name'];

                $kt = $this->kebutuhan_tahunan_model->getByID($id);
                if (is_file('assets/lpj/'.$kt->laporan_pertanggung_jawaban)) {
                    unlink('assets/lpj/'.$kt->laporan_pertanggung_jawaban);
                }

                $kebutuhan_tahunan = array(
                    'id' => $id,
                    'laporan_pertanggung_jawaban' => $filename,
                    'modiby' => $relawan->nama_relawan,
                    'modidate' => date('Y-m-d H:i:s')
                );

                $this->kebutuhan_tahunan_model->update($id, $kebutuhan_tahunan);
                $this->session->set_flashdata("success", "LPJ berhasil diunggah.");

                redirect(site_url('kebutuhan-tahunan/detail/'.$id));
            } else {
                $this->session->set_flashdata("failed", "LPJ tidak dapat diunggah");

                redirect(site_url('kebutuhan-tahunan/detail/'.$id));
            }

        }
    }

    /*
    ==============================================================
    Kirim Kebutuhan Tahunan
    ==============================================================
    */
    public function kirim($id)
    {
        $relawan = $this->getRelawanSession();

        $kebutuhan_tahunan = array(
            'kt_status' => 'Menunggu Persetujuan',
        );

        $this->kebutuhan_tahunan_model->update($id, $kebutuhan_tahunan);
        $this->session->set_flashdata("success", "Kebutuhan Tahunan berhasil dikirim.");

        redirect(site_url('kebutuhan-tahunan'));
    }


    public function data()
    {
        $karyawan = $this->getKaryawan();
        // set karyawan
        $header['name'] =  $karyawan->nama_karyawan;
        $header['role'] =  $karyawan->jabatan_karyawan;

        // set page title
        $header['title'] = 'Daftar Kebutuhan Tahunan';

        // include header
        $this->load->view('templates/admin_header', $header);

        $data_kt = $this->kebutuhan_tahunan_model->getAllDataConfirmed();
        $data['kebutuhan_tahunan'] = $data_kt;
        $this->load->view('kebutuhan_tahunan/data', $data);

        // inlcude footer
        $this->load->view('templates/footer');
    }
}
