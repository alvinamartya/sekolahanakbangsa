<?php
defined('BASEPATH') or exit('No direct script access allowed');

class donatur_aksi_model extends CI_Model
{
	private $_table = "donatur_aksi";

    //contruct
    public function __construct()
    {
        parent::__construct();
    }
	
	public function getDanaValidByIdAksi($id)
	{
		$query = $this->db
            ->from($this->_table)
            ->where(['id_aksi' => $id])
			->where(['is_valid' => 'Y'])
            ->get();
		$jumlah = 0;
		
		foreach($query->result() as $a)
		{
			$jumlah += $a->donasi;
		}
		return $jumlah;
		
	}
	public function getAllDanaValid()
	{
		$query = $this->db
            ->from($this->_table)            
			->where(['is_valid' => 'Y'])
            ->get();
		$jumlah = 0;
		
		foreach($query->result() as $a)
		{
			$jumlah += $a->donasi;
		}
		return $jumlah;
		
	}
}

?>