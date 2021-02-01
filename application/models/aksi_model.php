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
	
	public function getAksi($id)
	{
		$query = $this->db
            ->from($this->_table)
            ->where(['id_aksi' => $id])
            ->get();

        return $query->row();
	}
}

?>