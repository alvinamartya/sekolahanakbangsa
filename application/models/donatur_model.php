<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Donatur_model extends CI_Model
{
    private $_table = "donatur";

    public function __construct()
    {
        parent::__construct();
    }

    public function getAll()
    {
        return $this->db->get_where($this->_table, ["row_status" => 'A'])->result();
    }
	public function countAll()
    {
        $donatur = $this->db->get_where($this->_table, ["row_status" => 'A'])->result();
		$jumlah = 0;
		foreach($donatur as $d){
			$jumlah++;
		}
		return $jumlah;
    }

    public function getDOnaturByUserLoginId($idUserLoginId)
	{
		return $this->db
			->get_where($this->_table, ["id_user_login" => $idUserLoginId])
			->row();
    }
    
    public function getByID($id)
    {
        return $this->db->get_where($this->_table, ["id_donatur" => $id])->row();
    }

    public function save($data)
    {
        return $this->db->insert($this->_table, $data);
    }

    public function delete($id, $modiby)
    {
        $this->row_status = 'D';
        $this->modiby = $modiby;
        $this->modidate = date("Y-m-d H:i:s");

        return $this->db->update($this->_table, $this, array('id_donatur' => $id));
    }
}
