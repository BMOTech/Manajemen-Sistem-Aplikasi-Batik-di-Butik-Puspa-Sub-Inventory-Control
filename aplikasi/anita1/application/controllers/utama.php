<?php 
class Utama extends CI_Controller {

    function __construct(){
		parent::__construct();
        session_start();
        $this->load->model('model_user');
		if ($this->session->userdata('username')=="") {
			redirect('login');
		}
	}
    
	function index()
	{
		$query = $this->db->query("select * from stok where jml_brg < 10");

		    if($query){
		      $datahabis;
		      foreach ($query->result() as $row)
		      {
		          $this->SendSMS("127.0.0.1",80,"admin","admin","085795299549","Data stok habis kode barang = $row->kode_brg , dengan jumlah barang = $row->jml_brg");
		      }
		    }elseif($query == 0){
		      //Todo
		    }
				//$this->SendSMS("127.0.0.1",8800,"admin","admin","085745622496","Test Habis index utama");
            
		$this->load->view('utama/home');
	}

	public function SendSMS($host, $port, $username, $password, $phoneNoRecip, $msgText) { 

/* Parameters:
    $host – IP address or host name of the NowSMS server 083826263232
    $port – “Port number for the web interface” of the NowSMS Server
    $username – <span class="notranslate">“SMS Users”</span> account on the NowSMS server
    $password – Password defined for the <span class="notranslate">“SMS Users”</span> account on the NowSMS Server
    $phoneNoRecip – One or more phone numbers (comma delimited) to receive the text message
    $msgText – Text of the message
*/
 
    $fp = fsockopen($host, $port, $errno, $errstr);
    if (!$fp) {
        echo "errno: $errno \n";
        echo "errstr: $errstr\n";
        return $result;
    }
    
    fwrite($fp, "GET /?Phone=" . rawurlencode($phoneNoRecip) . "&Text=" . rawurlencode($msgText) . " HTTP/1.0\n");
    if ($username != "") {
       $auth = $username . ":" . $password;
       $auth = base64_encode($auth);
       fwrite($fp, "Authorization: Basic " . $auth . "\n");
    }
    fwrite($fp, "\n");
  
    $res = "";
 
    while(!feof($fp)) {
        $res .= fread($fp,1);
    }
    fclose($fp);
    
 
    return $res;
  }

  public function coba(){
     $this->SendSMS("127.0.0.1",80,"admin","admin","085745622496","Test Habis Coba");
  }

    function user()
	{
		$this->load->view('manajemen/addbarang');
	}
	 function home()
	{
		$this->load->view('utama/home1');
	}
    function viewuser()
    {
        $id_petugas=$this->session->userdata('id_petugas');
        $data['result']=$this->model_user->display_dtUser();
        $data['menu_user']=' active';
    	$this->load->view('utama/petugas/listpetugas',$data);

    }
    function adduser()
    { 
        $this->load->view('utama/petugas/addpetugas');
       
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */