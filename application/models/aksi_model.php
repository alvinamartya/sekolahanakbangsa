<?php
defined('BASEPATH') or exit('No direct script access allowed');

class aksi_model extends CI_Model
{
    private $_table = "aksi";

    //contruct
    public function __construct()
    {
        parent::__construct();
    }

	public function getAksiBySekolah($id_sekolah)
    {
        $query = $this->db
            ->from($this->_table)
			->join('relawan', 'relawan.id_relawan = aksi.id_relawan')
            ->where(['relawan.id_sekolah' => $id_sekolah, 'aksi.row_status' => 'A'])
            ->order_by('aksi.tanggal_selesai', 'asc')
            ->get();

        return $query->result();
    }
    public function getAksiByRelawan($id_relawan)
    {
        $query = $this->db
            ->from($this->_table)
            ->where(['id_relawan' => $id_relawan, 'row_status' => 'A'])
            ->order_by('tanggal_selesai', 'asc')
            ->get();

        return $query->result();
    }

    public function save($data)
    {
        return $this->db->insert($this->_table, $data);
    }

    public function update($id, $data)
    {
        return $this->db
            ->where('id_aksi', $id)
            ->update($this->_table, $data);
    }

    public function getByID($id)
    {
        return $this->db->get_where($this->_table, ["id_aksi" => $id])->row();
    }

    public function delete($id, $modiby)
    {
        $data = array('row_status' => 'D', 'modiby' => $modiby);
        return $this->db
            ->where('id_aksi', $id)
            ->update($this->_table, $data);
    }

    public function getLastData()
    {
        return $this->db->order_by('id_aksi', "desc")->limit(1)->get($this->_table)->row();
    }

    public function getAksi($id)
    {
        $query = $this->db
            ->from($this->_table)
            ->where(['id_aksi' => $id])
            ->get();

        return $query->row();
    }

    public function getAksiAll()
    {
        $query = $this->db
            ->from($this->_table)
            ->get();
        return $query->result();
    }
	public function getAksiAllActive()
    {
        $query = $this->db
            ->from($this->_table)
			->where(['row_status' => 'A'])
            ->get();
			
        return $query->result();
    }

    public function getAksiHome()
    {
        $query = $this->db
            ->query("SELECT 
            a.id_aksi, 
            a.nama_aksi, 
            DATEDIFF(a.tanggal_selesai,NOW()) as selisih_hari, 
            SUM(d.donasi) as total_donasi, (SUM(d.donasi) * 100 / a.target_donasi) as percentage, 
            g.gambar 
            FROM aksi a 
            JOIN donatur_aksi d ON a.id_aksi = d.id_aksi 
            JOIN gambar_aksi g ON g.id_aksi = a.id_aksi 
            WHERE d.id_status_aksi = 3 and d.is_valid = 'Y' and a.row_status = 'A' 
            and a.tanggal_selesai >= NOW() GROUP BY a.id_aksi, a.nama_aksi,selisih_hari 
            ORDER BY a.tanggal_selesai ASC LIMIT 6");

        return $query->result();
    }
	public function countAksi()
	{
		$aksi = $this->db
            ->from($this->_table)
            ->where(['row_status' => 'A'])
            ->get()->result();
		$jumlah = 0;
		foreach($aksi as $a){
			$jumlah++;
		}
		return $jumlah;
	}
}
