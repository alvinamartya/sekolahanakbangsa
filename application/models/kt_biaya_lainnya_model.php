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

    public function getBiayaLainnyaByIdKt($id)
    {
        $query = $this->db
            ->from($this->_table)
            ->where(['id_kt' => $id])
            ->get();

        return $query->result();
    }

    public function getKtBiaya()
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
        return $this->db->get_where($this->_table, ["id" => $id])->row();
    }

    public function getLastData()
    {
        return $this->db->order_by('creadate', "desc")->limit(1)->get($this->_table)->row();
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
