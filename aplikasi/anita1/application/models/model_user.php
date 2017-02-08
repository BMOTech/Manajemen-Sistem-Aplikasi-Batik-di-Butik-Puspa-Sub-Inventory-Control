<?php
class Model_user extends CI_Model{
	function __construct(){
		parent::__construct()
		;
	}
	
    var $table = "pegawai";
	
	function add_dtUser($data){
        $this->db->insert($this->table, $data);
        return TRUE;
    }
	function getLogin($user,$pass){
		$sql="select * from pegawai where username ='$user' and password ='$pass' LIMIT 1";
		//echo $sql; exit;
		return $this->db->query($sql);
	}
	function display_dtUser(){
		return $this->db->select('*')->from('petugas')->group_by('id_petugas')->where('id_petugas IS NOT NULL')->get()->result_array();
    }
	function display_dtUser2(){
		return $this->db->select('a.*,b.*')->from('petugas a')->join('penempatan_brg b','a.id_petugas=b.id_petugas')->group_by('a.id_petugas')->where('a.id_petugas IS NOT NULL')->get()->result_array();
    }
	function delete_dtUser($id){
		$this->db->where('id_petugas', $id);
		return $this->db->delete($this->table);
    }
	function detail_dtUser($id){
		return $this->db->where('id_petugas',$id)->get('user')->result_array();
	}
	
	function edit_dtUser($id,$arrayData){
        $this->db->where('id_petugas', $id);
        return $this->db->update($this->table, $arrayData); 
    }
}
?>