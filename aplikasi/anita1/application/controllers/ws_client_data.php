<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Ws_client_data extends CI_Controller{
    function __construct(){
        parent::__construct();
		 //if($this->session->userdata('login_status') != TRUE ){
            //$this->session->set_flashdata('notif','LOGIN GAGAL USERNAME ATAU PASSWORD ANDA SALAH !');
            //redirect('');
        //};
       //di versi client ini tidak perleu  nge-load model anda. si file ini hanya memanggil fungsi yang  terlah kita buat dicontroller wsitems yang kita buat.
    }
	
	public function index()
	{
		$d1=array(
            'title'=>'View Data Mahasiswa webservice',
            'active_Dbarang'=>'active',
			);
		
		$url = file_get_contents('http://proyek.ac.id/login_session5/index.php/witems/');
		$data['items'] = json_decode($url);
		$this->load->view('element/v_header',$d1);
		$this->load->view('pages/v_barang_ws', $data);
		$this->load->view('element/v_footer');
		$dc = json_decode($data);
		var_dump($data);
		echo $this->ambilData();
	}
	
	public function ambilData(){
		header('Content-type: application/json');
		
	}
	
	public function ex(){
		$url = file_get_contents('http://proyek.ac.id/login_session5/index.php/witems/');
		$data['dataws'] = json_decode($url);
		$this->load->view('v_ws_Barang_ex', $data);
		//$dc = json_decode($data);
		var_dump($data);
	}
		public function ex1(){
		$url = file_get_contents('http://proyek.ac.id/login_session5/index.php/witems/index1');
		$data['dataws'] = json_decode($url);
		$this->load->view('v_ws_Barang_ex1', $data);
		//$dc = json_decode($data);
		//var_dump($data);
	}
	
	public function getData(){
	$c = curl_init ();
	curl_setopt ( $c, CURLOPT_RETURNTRANSFER, true );
	curl_setopt ( $c, CURLOPT_HTTPHEADER, array (
	'Accept: application/json',
	'Content-Type: application/json'
		) );

	curl_setopt ( $c, CURLOPT_URL, 'http://proyek.ac.id/login_session5/index.php/witems/');

	}
}