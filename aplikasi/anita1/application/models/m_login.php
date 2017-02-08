<?php
class M_login extends CI_Model{
	function __construct(){
		parent::__construct()
		;
	}
    var $table = "pegawai";
	
	function getLogin($user,$pass){
		$sql="select * from pegawai where username ='$user' and password ='$pass' LIMIT 1";
		//echo $sql; exit;
		return $this->db->query($sql);
	}

	function cek_user($data){
		$query = $this->db->get_where('pegawai',$data);
		return $query;
	}	
}
?>