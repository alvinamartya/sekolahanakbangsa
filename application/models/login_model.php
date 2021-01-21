<?php
defined('BASEPATH') or exit('No direct script access allowed');

class login_model extends CI_Model
{
    private $_table = "user_login";

    public function getDataByUsername()
    {
        $data = $this->input->post();
        $where = array('username' => $data['username']);
        $query = $this->db->get_where($this->_table, $where);
        return $query->row();
    }
}
