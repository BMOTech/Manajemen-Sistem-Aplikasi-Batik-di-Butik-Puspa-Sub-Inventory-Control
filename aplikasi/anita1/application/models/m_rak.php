<?php
class m_rak extends CI_Model{
	function __construct(){
		parent::__construct()
		;
	}
	function data($number,$offset){
		return $query = $this->db->get('rak',$number,$offset)->result();		
	}
	function jumlah_data(){
		return $this->db->get('rak')->num_rows();
	}
    function get(){
        return $this->db->get("barang");
    }
	function updatedata(){
        $kode_rak = $this->input->post('kode_rak');
        $nama= $this->input->post('nama');
		
		;
		$data = array(
                'kode_rak'=>$kode_rak,
				'nama'=>$nama,
        
				
				);
        $this->db->where(array('kode_rak'=>$kode_rak));
        $this->db->update('rak',$data);
    }
	 
    function filterdata($kode_rak){
        return $this->db->get_where('rak',
                          array('kode_rak'=>$kode_rak))->row();
    }
	function insert() {
        $insert_rak = array(
            'kode_rak' => $this->input->post('kode_rak'),
            'nama' => $this->input->post('nama'),
						
        );
        $insert = $this->db->insert('rak', $insert_rak);
        return $insert;
    }
	

    function bacadata(){
        $baca = $this->db->get('rak');
        if($baca->num_rows() > 0){
            foreach ($baca->result() as $data){
                $hasil[] = $data;
            }
            return $hasil;
        }
    }
    function deletedata($kode_rak){ 
        $this->db->where('kode_rak', $kode_rak);
        $this->db->delete('rak'); 
    }
	
	

}
?>