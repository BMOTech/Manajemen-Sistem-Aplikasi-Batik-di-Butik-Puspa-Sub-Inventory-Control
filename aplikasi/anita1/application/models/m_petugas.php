<?php
class M_petugas extends CI_Model{
	function __construct(){
		parent::__construct()
		;
	}
		function data($number,$offset){
		return $query = $this->db->get('pegawai',$number,$offset)->result();		
	}
 function jumlah_data(){
		return $this->db->get('barang')->num_rows();
	}
	
    function get(){
        return $this->db->get("pegawai");
    }
	
	function insertuser() {
		$id_pegawai = $this->input->post('id_pegawai');
		$username = $this->input->post('username');
        $password = $this->input->post('password');
		$level = $this->input->post('level');
        $insert_user = array(
			'id_pegawai'=>$id_pegawai,
			'username' => $username,
			'password' =>MD5($this->input->post('password')),
            'level' => $level,
        );

        $insert = $this->db->insert('pegawai', $insert_user);
        return $insert;
    }
	
    function updatedata1(){
        $id_pegawai = $this->input->post('id_pegawai');
        $username = $this->input->post('username');
		$password = $this->input->post('password');
		$level = $this->input->post('level');
		$status = $this->input->post('status');		
		
		;
		$data = array(
                'id_pegawai'=>$id_pegawai,
				'username'=>$username,
			'password' =>MD5($this->input->post('password')),
				'level'=>$level,
					'status'=>$status
				
	
				);
        $this->db->where(array('id_pegawai'=>$id_pegawai));
        $this->db->update('pegawai',$data);
    }
	function updatedata(){
       $id_pegawai = $this->input->post('id_pegawai');
        $username = $this->input->post('username');
		$password = $this->input->post('password');
		$level = $this->input->post('level');		
		;
		;
		$data = array(
               'id_pegawai'=>$id_pegawai,
				'username'=>$username,
			'password' =>MD5($this->input->post('password')),
				'level'=>$level,
        
				
				);
        $this->db->where(array('id_pegawai'=>$id_pegawai));
        $this->db->update('pegawai',$data);
    }
	 
    function filterdata($id_pegawai){
        return $this->db->get_where('pegawai',
                          array('id_pegawai'=>$id_pegawai))->row();
    }
    function bacadata(){
        $baca = $this->db->get('pegawai');
        if($baca->num_rows() > 0){
            foreach ($baca->result() as $data){
                $hasil[] = $data;
            }
            return $hasil;
        }
    }
    function deletedata($id_pegawai){ 
        $this->db->where('id_pegawai', $id_pegawai);
        $this->db->delete('pegawai'); 
    }
}
?>