<?php
class M_supplier extends CI_Model{
	function __construct(){
		parent::__construct()
		;
	}
	
    function get(){
        return $this->db->get("supplier");
    }
	function jumlah_data(){
		return $this->db->get('supplier')->num_rows();
	}
	
	function data($number,$offset){
		return $query = $this->db->get('supplier',$number,$offset)->result();		
	}
	
	function updatedata(){
        $kode_supp = $this->input->post('kode_supp');
        $nama_supp= $this->input->post('nama_supp');
		$alamat = $this->input->post('alamat');
		
		;
		$data = array(
                'kode_supp'=>$kode_supp,
				'nama_supp'=>$nama_supp,
				'alamat'=>$alamat,
        
				
				);
        $this->db->where(array('kode_supp'=>$kode_supp));
        $this->db->update('supplier',$data);
    }
	 
    function filterdata($kode_supp){
        return $this->db->get_where('supplier',
                          array('kode_supp'=>$kode_supp))->row();
    }
	
	function insert() {
        $insert_kategori = array(
            'kode_supp' => $this->input->post('kode_supp'),
            'nama_Supp' => $this->input->post('nama_supp'),
            'alamat' => $this->input->post('alamat'),

						
        );
        $insert = $this->db->insert('supplier', $insert_kategori);
        return $insert;
    }
	

	
    function bacadata(){
        $baca = $this->db->get('supplier');
        if($baca->num_rows() > 0){
            foreach ($baca->result() as $data){
                $hasil[] = $data;
            }
            return $hasil;
        }
    }
    function deletedata($kode_supp){ 
        $this->db->where('kode_supp', $kode_supp);
        $this->db->delete('supplier'); 
    }
	
	

}
?>