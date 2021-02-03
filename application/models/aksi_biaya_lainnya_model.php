<?php
defined('BASEPATH') or exit('No direct script access allowed');

class aksi_biaya_lainnya_model extends CI_Model
{
	private $_table = "aksi_biaya_lainnya";

    //contruct
    public function __construct()
    {
        parent::__construct();
    }

	public function getBiayaLainnyaByIdAksi($id)
	{
		$query = $this->db
            ->from($this->_table)
            ->where(['id_aksi' => $id])
            ->get();

        return $query->result();
    }

    public function getAksiBiaya()
    {
        $query = $this->db
            ->from($this->_table)
            ->order_by('creadate', 'desc')
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
            ->where('id', $id)
            ->update($this->_table, $data);
    }

    public function getByID($id)
    {
        $this->db->select('*');
        $this->db->from('aksi_biaya_lainnya as a');
        $this->db->join('biaya_lainnya as b', 'b.id_biaya_lainnya = a.id_biaya_lainnya');
        return $this->db->where(["a.id_aksi" => $id, "a.row_status" => "A"])->get()->result();
    }

    public function getLastData()
    {
        return $this->db->order_by('creadate', "desc")->limit(1)->get($this->_table)->row();
    }
}

?>