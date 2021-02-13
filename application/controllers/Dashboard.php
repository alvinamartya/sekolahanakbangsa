<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
	// constructor
	public function __construct()
	{
		parent::__construct();
		$this->load->model('karyawan_model');
		$this->load->model('relawan_model');
		$this->load->model('kebutuhan_tahunan_model');
		$this->load->model('sekolah_model');
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

	private function getRelawanName()
	{
		$this->load->model('relawan_model');
		$user_id = $this->session->user_id;
		$relawan = $this->relawan_model->getRelawanByUserLoginId($user_id);
		return $relawan->nama_relawan;
	}

	// view
	public function admin()
	{
		// set page title
		$header['title'] = "Dashboard Admin";

		// set employee 
		$header['name'] =  $this->getKaryawanName();
		$header['role'] =  $this->getKaryawanRole();

		$post = $this->input->post();
		if (isset($post["id_sekolah"])) {
			$id_sekolah = $post["id_sekolah"];
		} else {
			$sekolah = $this->sekolah_model->getSekolah();
			foreach ($sekolah as $s) {
				$id_sekolah = $s->id_sekolah;
				break;
			}
		}

		$kebutuhan_tahunan = $this->kebutuhan_tahunan_model->getApprovedKebutuhanTahunanByIdSekolah($id_sekolah);
		$sekolah = $this->sekolah_model->getSekolah();

		$data["kebutuhan_tahunan"] = $kebutuhan_tahunan;
		$data["sekolah"] = $sekolah;
		$data["id_sekolah"] = $id_sekolah;

		$this->load->view('templates/admin_header', $header);

		$this->load->view('dashboard/admin', $data);

		$this->load->view('templates/footer');
	}

	public function export_all_relawan()
	{
		include APPPATH . 'third_party/PHPExcel/PHPExcel.php';

		$this->load->model('aksi_model');
		$this->load->model('relawan_model');
		$this->load->model('donatur_aksi_model');
		$this->load->model('sekolah_model');

		$data = $this->input->post();

		if ($data['sekolah'] != null) {
			$excel = new PHPExcel();

			// style
			$style_col = array(
				'font' => array("bold" => true),
				'alignment' => array(
					'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
					'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
				),
				'borders' => array(
					'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
					'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
					'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
					'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
				)
			);

			$style_row = array(
				'alignment' => array(
					'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
				),
				'borders' => array(
					'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
					'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
					'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
					'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
				)
			);

			$sheet = $excel->getActiveSheet();
			$i = 0;
			$first = true;
			foreach ($data['sekolah'] as $s) {
				if ($first == true) {
					$first = false;
				} else {
					$sheet = $excel->createSheet($i);
				}

				// header
				$sheet->setCellValue('A1', 'Laporan Aksi Galang Dana');
				$sheet->mergeCells("A1:G1");
				$sheet->getStyle("A1")->getFont()->setBold(TRUE);
				$sheet->getStyle("A1")->getFont()->setSize(16);
				$sheet->getStyle("A1")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

				// table header
				$sheet->setCellValue('A3', 'No');
				$sheet->setCellValue('B3', 'Penanggung Jawab');
				$sheet->setCellValue('C3', 'Nama Aksi');
				$sheet->setCellValue('D3', 'Donasi Terkumpul');
				$sheet->setCellValue('E3', 'Target Donasi');
				$sheet->setCellValue('F3', 'Persentase');
				$sheet->setCellValue('G3', 'Tanggal Selesai');

				// style
				$sheet->getStyle("A3")->applyFromArray($style_col);
				$sheet->getStyle("B3")->applyFromArray($style_col);
				$sheet->getStyle("C3")->applyFromArray($style_col);
				$sheet->getStyle("D3")->applyFromArray($style_col);
				$sheet->getStyle("E3")->applyFromArray($style_col);
				$sheet->getStyle("F3")->applyFromArray($style_col);
				$sheet->getStyle("G3")->applyFromArray($style_col);

				$data_aksi = $this->aksi_model->getAksiBySekolah($s);
				$data_sekolah = $this->sekolah_model->getByID($s);
				$data_relawan = $this->relawan_model->getAll();
				$data_donatur_aksi = $this->donatur_aksi_model->getDanaValid();

				$no = 1;
				$numrow = 4;
				foreach ($data_aksi as $k) {
					$sheet->setCellValue('A' . $numrow, $no);
					foreach ($data_relawan as $r) {
						$sheet->setCellValue('B' . $numrow,  $r->nama_relawan);
					}

					$sheet->setCellValue('C' . $numrow,  $k->nama_aksi);

					$jumlah = 0;
					if ($data_donatur_aksi != null) {
						foreach ($data_donatur_aksi as $d) {
							if ($d->id_aksi == $k->id_aksi) {
								$jumlah += $d->donasi;
							}
						}
					}

					$percentage = $jumlah * 100 / $k->target_donasi;

					$sheet->setCellValue('D' . $numrow, 'Rp ' . number_format($jumlah, 2, ',', '.'));
					$sheet->setCellValue('E' . $numrow,  'Rp ' . number_format($k->target_donasi, 2, ',', '.'));
					$sheet->setCellValue('F' . $numrow,  round($percentage) . '%');
					$sheet->setCellValue('G' . $numrow, date("d-m-Y", strtotime($k->tanggal_selesai)));


					$sheet->getStyle("A" . $numrow)->applyFromArray($style_row);
					$sheet->getStyle("B" . $numrow)->applyFromArray($style_row);
					$sheet->getStyle("C" . $numrow)->applyFromArray($style_row);
					$sheet->getStyle("D" . $numrow)->applyFromArray($style_row);
					$sheet->getStyle("E" . $numrow)->applyFromArray($style_row);
					$sheet->getStyle("F" . $numrow)->applyFromArray($style_row);
					$sheet->getStyle("G" . $numrow)->applyFromArray($style_row);

					$no++;
					$numrow++;
				}

				$sheet->getColumnDimension("A")->setWidth(5);
				$sheet->getColumnDimension("B")->setWidth(30);
				$sheet->getColumnDimension("C")->setWidth(30);
				$sheet->getColumnDimension("D")->setWidth(20);
				$sheet->getColumnDimension("E")->setWidth(30);
				$sheet->getColumnDimension("F")->setWidth(20);
				$sheet->getColumnDimension("G")->setWidth(20);

				$sheet->getDefaultRowDimension()->setRowHeight(-1);

				$sheet->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);

				$sheet->setTitle($data_sekolah->nama_sekolah);
				$i++;
			}

			$excel->setActiveSheetIndex(0);

			// ouput file
			ob_end_clean();
			header("Content-type: application/vnd.ms-excel");
			header('Content-Disposition: attachment; filename="Laporan Aksi.xls"');
			header("Pragma: no-cache");
			header("Expires: 0");

			$objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel5');
			$objWriter->save('php://output');
			redirect(site_url('dashboard/relawan'));
		}
	}

	public function export_all_admin()
	{
		include APPPATH . 'third_party/PHPExcel/PHPExcel.php';

		$this->load->model('kebutuhan_tahunan_model');
		$this->load->model('sekolah_model');

		$data = $this->input->post();

		if ($data['sekolah'] != null) {
			$excel = new PHPExcel();

			// style
			$style_col = array(
				'font' => array("bold" => true),
				'alignment' => array(
					'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
					'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
				),
				'borders' => array(
					'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
					'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
					'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
					'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
				)
			);

			$style_row = array(
				'alignment' => array(
					'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
				),
				'borders' => array(
					'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
					'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
					'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
					'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
				)
			);

			$sheet = $excel->getActiveSheet();
			$i = 0;
			$first = true;
			foreach ($data['sekolah'] as $s) {
				if ($first == true) {
					$first = false;
				} else {
					$sheet = $excel->createSheet($i);
				}

				// header
				$sheet->setCellValue('A1', 'Laporan Aksi Kebutuhan Tahunan');
				$sheet->mergeCells("A1:C1");
				$sheet->getStyle("A1")->getFont()->setBold(TRUE);
				$sheet->getStyle("A1")->getFont()->setSize(16);
				$sheet->getStyle("A1")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

				// table header
				$sheet->setCellValue('A3', 'No');
				$sheet->setCellValue('B3', 'Tahun');
				$sheet->setCellValue('C3', 'Kebutuhan');

				// style
				$sheet->getStyle("A3")->applyFromArray($style_col);
				$sheet->getStyle("B3")->applyFromArray($style_col);
				$sheet->getStyle("C3")->applyFromArray($style_col);

				$kebutuhan_tahunan = $this->kebutuhan_tahunan_model->getApprovedKebutuhanTahunanByIdSekolah($s);
				$data_sekolah = $this->sekolah_model->getByID($s);

				$no = 1;
				$numrow = 4;
				foreach ($kebutuhan_tahunan as $k) {
					$excel->setActiveSheetIndex(0)->setCellValue('A' . $numrow, $no);

					$excel->setActiveSheetIndex(0)->setCellValue('B' . $numrow, $k->tahun);
					$excel->setActiveSheetIndex(0)->setCellValue('C' . $numrow,  'Rp ' . number_format($k->total_kebutuhan, 2, ',', '.'));

					$excel->getActiveSheet()->getStyle("A" . $numrow)->applyFromArray($style_row);
					$excel->getActiveSheet()->getStyle("B" . $numrow)->applyFromArray($style_col);
					$excel->getActiveSheet()->getStyle("C" . $numrow)->applyFromArray($style_col);

					$no++;
					$numrow++;
				}

				$excel->getActiveSheet()->getColumnDimension("A")->setWidth(5);
				$excel->getActiveSheet()->getColumnDimension("B")->setWidth(30);
				$excel->getActiveSheet()->getColumnDimension("C")->setWidth(30);

				$sheet->getDefaultRowDimension()->setRowHeight(-1);

				$sheet->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);

				$sheet->setTitle($data_sekolah->nama_sekolah);
				$i++;
			}

			$excel->setActiveSheetIndex(0);

			// ouput file
			ob_end_clean();
			header("Content-type: application/vnd.ms-excel");
			header('Content-Disposition: attachment; filename="Laporan Aksi.xls"');
			header("Pragma: no-cache");
			header("Expires: 0");

			$objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel5');
			$objWriter->save('php://output');
			redirect(site_url('dashboard/relawan'));
		}
	}

	public function export_laporan_admin($id)
	{
		include APPPATH . 'third_party/PHPExcel/PHPExcel.php';

		$this->load->model('kebutuhan_tahunan_model');
		$this->load->model('sekolah_model');

		$excel = new PHPExcel();

		// style
		$style_col = array(
			'font' => array("bold" => true),
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
			),
			'borders' => array(
				'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
				'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
				'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
				'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
			)
		);

		$style_row = array(
			'alignment' => array(
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
			),
			'borders' => array(
				'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
				'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
				'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
				'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
			)
		);

		// header
		$excel->setActiveSheetIndex(0)->setCellValue('A1', 'Laporan Kebutuhan Tahunan');
		$excel->getActiveSheet()->mergeCells("A1:C1");
		$excel->getActiveSheet()->getStyle("A1")->getFont()->setBold(TRUE);
		$excel->getActiveSheet()->getStyle("A1")->getFont()->setSize(16);
		$excel->getActiveSheet()->getStyle("A1")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		// table header
		$excel->setActiveSheetIndex(0)->setCellValue('A3', 'No');
		$excel->setActiveSheetIndex(0)->setCellValue('B3', 'Tahun');
		$excel->setActiveSheetIndex(0)->setCellValue('C3', 'Kebutuhan');

		// style
		$excel->getActiveSheet()->getStyle("A3")->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle("B3")->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle("C3")->applyFromArray($style_col);

		$kebutuhan_tahunan = $this->kebutuhan_tahunan_model->getApprovedKebutuhanTahunanByIdSekolah($id);
		$data_sekolah = $this->sekolah_model->getByID($id);

		$no = 1;
		$numrow = 4;
		foreach ($kebutuhan_tahunan as $k) {
			$excel->setActiveSheetIndex(0)->setCellValue('A' . $numrow, $no);

			$excel->setActiveSheetIndex(0)->setCellValue('B' . $numrow, $k->tahun);
			$excel->setActiveSheetIndex(0)->setCellValue('C' . $numrow,  'Rp ' . number_format($k->total_kebutuhan, 2, ',', '.'));

			$excel->getActiveSheet()->getStyle("A" . $numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle("B" . $numrow)->applyFromArray($style_col);
			$excel->getActiveSheet()->getStyle("C" . $numrow)->applyFromArray($style_col);

			$no++;
			$numrow++;
		}

		$excel->getActiveSheet()->getColumnDimension("A")->setWidth(5);
		$excel->getActiveSheet()->getColumnDimension("B")->setWidth(30);
		$excel->getActiveSheet()->getColumnDimension("C")->setWidth(30);

		$excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);

		$excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);

		$excel->getActiveSheet()->setTitle($data_sekolah->nama_sekolah);
		$excel->setActiveSheetIndex(0);

		// ouput file
		ob_end_clean();
		header("Content-type: application/vnd.ms-excel");
		header('Content-Disposition: attachment; filename="Laporan Tahunan ' . $data_sekolah->nama_sekolah . '.xls"');
		header("Pragma: no-cache");
		header("Expires: 0");

		$objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel5');
		$objWriter->save('php://output');
		redirect(site_url('dashboard/admin'));
	}

	public function export_laporan_relawan($id)
	{
		include APPPATH . 'third_party/PHPExcel/PHPExcel.php';

		$this->load->model('aksi_model');
		$this->load->model('relawan_model');
		$this->load->model('donatur_aksi_model');
		$this->load->model('sekolah_model');

		$excel = new PHPExcel();

		// style
		$style_col = array(
			'font' => array("bold" => true),
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
			),
			'borders' => array(
				'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
				'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
				'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
				'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
			)
		);

		$style_row = array(
			'alignment' => array(
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
			),
			'borders' => array(
				'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
				'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
				'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
				'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
			)
		);

		// header
		$excel->setActiveSheetIndex(0)->setCellValue('A1', 'Laporan Aksi Galang Dana');
		$excel->getActiveSheet()->mergeCells("A1:G1");
		$excel->getActiveSheet()->getStyle("A1")->getFont()->setBold(TRUE);
		$excel->getActiveSheet()->getStyle("A1")->getFont()->setSize(16);
		$excel->getActiveSheet()->getStyle("A1")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		// table header
		$excel->setActiveSheetIndex(0)->setCellValue('A3', 'No');
		$excel->setActiveSheetIndex(0)->setCellValue('B3', 'Penanggung Jawab');
		$excel->setActiveSheetIndex(0)->setCellValue('C3', 'Nama Aksi');
		$excel->setActiveSheetIndex(0)->setCellValue('D3', 'Donasi Terkumpul');
		$excel->setActiveSheetIndex(0)->setCellValue('E3', 'Target Donasi');
		$excel->setActiveSheetIndex(0)->setCellValue('F3', 'Persentase');
		$excel->setActiveSheetIndex(0)->setCellValue('G3', 'Tanggal Selesai');

		// style
		$excel->getActiveSheet()->getStyle("A3")->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle("B3")->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle("C3")->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle("D3")->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle("E3")->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle("F3")->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle("G3")->applyFromArray($style_col);

		$data_aksi = $this->aksi_model->getAksiBySekolah($id);
		$data_sekolah = $this->sekolah_model->getByID($id);
		$data_relawan = $this->relawan_model->getAll();
		$data_donatur_aksi = $this->donatur_aksi_model->getDanaValid();

		$no = 1;
		$numrow = 4;
		foreach ($data_aksi as $k) {
			$excel->setActiveSheetIndex(0)->setCellValue('A' . $numrow, $no);
			foreach ($data_relawan as $r) {
				$excel->setActiveSheetIndex(0)->setCellValue('B' . $numrow,  $r->nama_relawan);
			}

			$excel->setActiveSheetIndex(0)->setCellValue('C' . $numrow,  $k->nama_aksi);

			$jumlah = 0;
			if ($data_donatur_aksi != null) {
				foreach ($data_donatur_aksi as $d) {
					if ($d->id_aksi == $k->id_aksi) {
						$jumlah += $d->donasi;
					}
				}
			}

			$percentage = $jumlah * 100 / $k->target_donasi;

			$excel->setActiveSheetIndex(0)->setCellValue('D' . $numrow, 'Rp ' . number_format($jumlah, 2, ',', '.'));
			$excel->setActiveSheetIndex(0)->setCellValue('E' . $numrow,  'Rp ' . number_format($k->target_donasi, 2, ',', '.'));
			$excel->setActiveSheetIndex(0)->setCellValue('F' . $numrow,  round($percentage) . '%');
			$excel->setActiveSheetIndex(0)->setCellValue('G' . $numrow, date("d-m-Y", strtotime($k->tanggal_selesai)));


			$excel->getActiveSheet()->getStyle("A" . $numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle("B" . $numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle("C" . $numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle("D" . $numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle("E" . $numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle("F" . $numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle("G" . $numrow)->applyFromArray($style_row);

			$no++;
			$numrow++;
		}

		$excel->getActiveSheet()->getColumnDimension("A")->setWidth(5);
		$excel->getActiveSheet()->getColumnDimension("B")->setWidth(30);
		$excel->getActiveSheet()->getColumnDimension("C")->setWidth(30);
		$excel->getActiveSheet()->getColumnDimension("D")->setWidth(20);
		$excel->getActiveSheet()->getColumnDimension("E")->setWidth(30);
		$excel->getActiveSheet()->getColumnDimension("F")->setWidth(20);
		$excel->getActiveSheet()->getColumnDimension("G")->setWidth(20);

		$excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);

		$excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);

		$excel->getActiveSheet()->setTitle($data_sekolah->nama_sekolah);
		$excel->setActiveSheetIndex(0);

		// ouput file
		ob_end_clean();
		header("Content-type: application/vnd.ms-excel");
		header('Content-Disposition: attachment; filename="Laporan Aksi ' . $data_sekolah->nama_sekolah . '.xls"');
		header("Pragma: no-cache");
		header("Expires: 0");

		$objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel5');
		$objWriter->save('php://output');
		redirect(site_url('dashboard/relawan'));
	}

	public function detail_kebutuhan()
	{
		// set page title
		$header['title'] = "Dashboard Admin";

		// set employee 
		$header['name'] =  $this->getKaryawanName();
		$header['role'] =  $this->getKaryawanRole();

		$post = $this->input->post();
		$id = $post["id"];

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

		$this->load->view('templates/admin_header', $header);

		$this->load->view('dashboard/detail_kebutuhan', $data);

		$this->load->view('templates/footer');
	}

	public function relawan()
	{
		$user_id = $this->session->user_id;
		$active = $this->relawan_model->getRelawanByUserLoginId($user_id)->id_sekolah != null;

		// set page title
		$header['title'] = "Dashboard Relawan";
		$header['name'] =  $this->getRelawanName();
		$header['active'] = $active;


		$post = $this->input->post();
		if (isset($post["id_sekolah"])) {
			$id_sekolah = $post["id_sekolah"];
		} else {
			$sekolah = $this->sekolah_model->getSekolah();
			foreach ($sekolah as $s) {
				$id_sekolah = $s->id_sekolah;
				break;
			}
		}

		// set kebutuhan data pada dashboard
		$this->load->model('barang_model');
		$this->load->model('aksi_barang_model');
		$this->load->model('aksi_biaya_lainnya_model');
		$this->load->model('aksi_model');
		$this->load->model('biaya_lainnya_model');
		$this->load->model('donatur_aksi_model');
		$this->load->model('relawan_model');
		$this->load->model('status_aksi_model');
		$this->load->model('sekolah_model');

		$data_sekolah = $this->sekolah_model->getSekolah();
		$data_barang = $this->barang_model->getBarang();
		$data_aksi_barang = $this->aksi_barang_model->getAksiBarang();
		$data_aksi_biaya_lainnya = $this->aksi_biaya_lainnya_model->getAksiBiaya();
		$data_aksi = $this->aksi_model->getAksiBySekolah($id_sekolah);
		$data_biaya_lainnya = $this->biaya_lainnya_model->getBiayaLainnya();
		$data_donatur_aksi = $this->donatur_aksi_model->getDanaValid();
		$data_relawan = $this->relawan_model->getAll();

		$data['id_sekolah'] = $id_sekolah;
		$data['sekolah'] = $data_sekolah;
		$data['barang'] = $data_barang;
		$data['aksi_barang'] = $data_aksi_barang;
		$data['aksi_biaya_lainnya'] = $data_aksi_biaya_lainnya;
		$data['aksi'] = $data_aksi;
		$data['biaya_lainnya'] = $data_biaya_lainnya;
		$data['donatur_aksi'] = $data_donatur_aksi;
		$data['relawan'] = $data_relawan;

		// set header template
		$this->load->view('templates/relawan_header', $header);

		$this->load->view('dashboard/relawan', $data);

		//set footer template
		$this->load->view('templates/footer');
	}

	public function detail_donasi()
	{
		$user_id = $this->session->user_id;
		$active = $this->relawan_model->getRelawanByUserLoginId($user_id)->id_sekolah != null;

		// set page title
		$header['title'] = "Dashboard Relawan";
		$header['name'] =  $this->getRelawanName();
		$header['active'] = $active;

		$post = $this->input->post();
		$id = $post["id"];


		//set kebutuhan data
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

		$this->load->view('templates/relawan_header', $header);

		$this->load->view('dashboard/detail_donasi', $data);

		$this->load->view('templates/footer');
	}
}
