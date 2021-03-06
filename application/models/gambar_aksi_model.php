<?php
defined('BASEPATH') or exit('No direct script access allowed');

class gambar_aksi_model extends CI_Model
{
    private $_table = "gambar_aksi";

    public function __construct()
    {
        parent::__construct();
    }

    public function get($id_aksi)
    {
        $query = $this->db
            ->from($this->_table)
            ->where(['id_aksi' => $id_aksi, 'row_status' => 'A'])
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

    public function delete($id)
    {
        return $this->db->delete($this->_table, array('id' => $id));
    }

    public function getGambarByIdAksi($id)
    {
      $query = $this->db
              ->from($this->_table)
              ->where(['id_aksi' => $id, 'row_status' => 'A'])
              ->get();

          return $query->result();
    }

    public function getAksiAll()
    {
        $query = $this->db
            ->from($this->_table)
            ->get();
        return $query->result();
    }
}

?>
