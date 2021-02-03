<?php
defined('BASEPATH') or exit('No direct script access allowed');

class donatur_aksi_model extends CI_Model
{
	private $_table = "donatur_aksi";

    //contruct
    public function __construct()
    {
        parent::__construct();

    }
	
	public function getDanaValidByIdAksi($id)
	{
		$query = $this->db
            ->from($this->_table)
            ->where(['id_aksi' => $id])
			->where(['is_valid' => 'Y'])
            ->get();
		$jumlah = 0;
		
		foreach($query->result() as $a)
		{
			$jumlah += $a->donasi;
		}
		return $jumlah;
		
	}
  
  public function getAllDanaValid()
  {
    $query = $this->db
            ->from($this->_table)            
      ->where(['is_valid' => 'Y'])
            ->get();
    $jumlah = 0;

    foreach($query->result() as $a)
    {
      $jumlah += $a->donasi;
    }
    return $jumlah;

  }
  
    }
    
    public function getLastData()
    {
        return $this->db->order_by('id', "desc")->limit(1)->get($this->_table)->row();
    }

    //menyimpan data
    public function save($data)
    {
        return $this->db->insert($this->_table, $data);
    }

    public function update($id, $data)
    {
        return $this->db
            ->where('id_aksi', $id)
            ->update($this->_table, $data);
    }

    public function getByID($id)
    {
        return $this->db->get_where($this->_table, ["id_aksi" => $id])->row();
    }	

    public function getAksi($id){
        $this->db->select('*');
        $this->db->from('donatur_aksi as a');
        $this->db->join('aksi as b', 'b.id_aksi = a.id_aksi');
        return $this->db->where(["a.id" => $id, "a.row_status" => "A"])->get()->row();
    }

    public function getByIdDonatur($id)
    {
        $query = $this->db
            ->from($this->_table)
            ->where(['id_donatur' => $id])
            ->get();

        return $query->result();
    }

}

?>