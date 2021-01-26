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

    public function save($data)
    {
        return $this->db->insert($this->_table, $data);
    }

    public function getLastData()
    {
        return $this->db->order_by('id', "desc")->limit(1)->get($this->_table)->row();
    }

    public function update($id, $data)
    {
        return $this->db->update($this->_table, $this, array('id' => $id));
    }

    public function delete($id, $modiby)
    {
        $this->row_status = 'D';
        $this->modiby = $modiby;
        $this->modidate = date("Y-m-d H:i:s");

        return $this->db->update($this->_table, $this, array('id' => $id));
    }
}
