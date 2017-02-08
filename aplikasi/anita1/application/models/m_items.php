<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 
Class M_items extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	
	public function insert($data)
  {
      $val = array(
        'kode_kategori' => $data['kode_kategori'],
        'nama_kategori' => $data['nama_kategori']
       
      );
      $this->db->insert('kategori_brg', $val);
  }

	function update($data, $kode_kategori){
		$this->db->where('kode_kategori', $id);
		$this->db->update('kategori_brg', $data);
		die('tes');
	}
	function get_one($id){
		$data = array();
		$this->db->select('*');
		$this->db->from('barang');
		$this->db->where('kode_brg', $id);
		$hasil = $this->db->get();
		if($hasil->num_rows() > 0){
			return $hasil->row();
		}else{
			return $data;
		}
	}
/*
	function get_all(){
		$data = array();
		$this->db->select('*');
		$this->db->from('barang');
		$hasil = $this->db->get();
		if($hasil->num_rows() > 0){
			$data = $hasil->result();
		}
		$hasil->free_result();
		return $data;
	}

	function get_all(){
		$this->db->select('*');
		$this->db->from('stok');
		$hasil = $this->db->get();
		return $hasil->result();
	}*/
		function get_all(){
		$this->db->select('stok.kode_brg,stok.jml_brg,
		stok.rak,barang.kode_brg,barang.nama_brg')
		->join('barang','barang.kode_brg=stok.kode_brg');
		return $this->db->get('stok')->result();
		}

	function del_barang($kode_kategori){
		var_dump($kode_kategori);
		$this->db->where('kode_kategori', $kode_kategori);
		$this->db->delete('kategori_brg');
	}
	  function deletedata($id_pegawai){
        
        $this->db->where('id_pegawai', $id_pegawai);
        $this->db->delete('pegawai'); 
    }

	
}

/* End of file absen_m.php */
/* Location: ./application/models/absen_m.php */