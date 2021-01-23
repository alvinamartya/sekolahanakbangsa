<?php
defined('BASEPATH') or exit('No direct script access allowed');

class sekolah_model extends CI_Model
{
    private $_table = "sekolah";

    public function getSekolah()
    {
        $where = array('row_status' => 'A');
        $query = $this->db
            ->from($this->_table)
            ->where($where)
            ->order_by('jenis_sekolah', 'asc')
            ->get();

        return $query->result();
    }
}
