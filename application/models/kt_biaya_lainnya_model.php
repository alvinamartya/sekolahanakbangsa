<?php
defined('BASEPATH') or exit('No direct script access allowed');

class kt_biaya_lainnya_model extends CI_Model
{
    private $_table = "kt_biaya_lainnya";

    //contruct
    public function __construct()
    {
        parent::__construct();
    }
	
	public function getKtBiayaLainnyaByIdKt($id)
	{
		$query = $this->db
              ->from($this->_table)
              ->where(['id_kt' => $id])
              ->get();

          return $query->result();
	}
	
}
?>