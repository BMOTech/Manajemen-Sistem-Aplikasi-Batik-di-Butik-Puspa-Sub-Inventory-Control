<?php
class M_kategori extends CI_Model{
	function __construct(){
		parent::__construct()
		;
	}
	function data($number,$offset){
		return $query = $this->db->get('kategori_brg',$number,$offset)->result();		
	}
	function jumlah_data(){
		return $this->db->get('kategori_brg')->num_rows();
	}
    function get(){
        return $this->db->get("barang");
    }
	function updatedata(){
        $kode_kategori = $this->input->post('kode_kategori');
        $nama_kategori = $this->input->post('nama_kategori');
		
		;
		$data = array(
                'kode_kategori'=>$kode_kategori,
				'nama_kategori'=>$nama_kategori,
        
				
				);
        $this->db->where(array('kode_kategori'=>$kode_kategori));
        $this->db->update('kategori_brg',$data);
    }
	 
    function filterdata($kode_kategori){
        return $this->db->get_where('kategori_brg',
                          array('kode_kategori'=>$kode_kategori))->row();
    }
	function insert() {
        $insert_kategori = array(
            'kode_kategori' => $this->input->post('kode_kategori'),
            'nama_kategori' => $this->input->post('nama_kategori'),
						
        );
        $insert = $this->db->insert('kategori_brg', $insert_kategori);
        return $insert;
    }
	

    function bacadata(){
        $baca = $this->db->get('kategori_brg');
        if($baca->num_rows() > 0){
            foreach ($baca->result() as $data){
                $hasil[] = $data;
            }
            return $hasil;
        }
    }
    function deletedata($kode_kategori){ 
        $this->db->where('kode_kategori', $kode_kategori);
        $this->db->delete('kategori_brg'); 
    }
	
	

}
?>