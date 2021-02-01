<?php
defined('BASEPATH') or exit('No direct script access allowed');

class aksi_barang_model extends CI_Model
{
	private $_table = "aksi_barang";

    //contruct
    public function __construct()
    {
        parent::__construct();
    }
	
	public function getAksiBarangByIdAksi($id)
	{
		$query = $this->db
            ->from($this->_table)
            ->where(['id_aksi' => $id])
            ->get();

        return $query->result();
	}
}

?>