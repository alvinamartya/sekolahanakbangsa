<?php
defined('BASEPATH') or exit('No direct script access allowed');

class gambar_aksi_model extends CI_Model
{
	private $_table = "gambar_aksi";

    //contruct
    public function __construct()
    {
        parent::__construct();
    }
	
	public function getGambarByIdAksi($id)
	{
		$query = $this->db
            ->from($this->_table)
            ->where(['id_aksi' => $id])
            ->get();

        return $query->result();
	}
}

?>