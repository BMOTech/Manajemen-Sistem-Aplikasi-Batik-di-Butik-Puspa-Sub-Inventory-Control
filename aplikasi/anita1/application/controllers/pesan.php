<?php 
class pesan extends CI_Controller {

    public function __construct(){
		parent::__construct();
        session_start();
		$this->load->helper(array('url'));
		$this->load->model('m_pemesanan');
        $this->load->library('fpdf');
		if ($this->session->userdata('username')=="") {
			redirect('login');
		}
	}
     function pesan(){
       
        $this->load->view('utama/laporan/faktur');
    }
	  function cari(){
       
        $this->load->view('user/cari');
    }
	function print_($id_pemesanan){
        if($_POST==NULL){
  $this->load->model('m_pemesanan');
  $data['hasil'] = $this->m_pemesanan->filterdata($id_pemesanan);
            $this->load->view('/utama/laporan/faktur',$data);
        }
        else{
            $this->load->model('m_pemesanan');
            $this->m_pemesanan->updatedata();
            redirect('barang');
        }
    }
	 public function addbarang()
    {
	    $this->load->view('/user/cari');
    }
		function viewpesanan(){
$cari=$this->input->get('cari');
$this->load->model('m_pemesanan');
$beda['user']=$this->m_pemesanan->pesan1($cari);
$this->load->view('user/listbarang',$beda);
}
    
       public function viewpesanan1()
    {
     /*  $this->load->model('m_barang');
        $data['hasil'] = $this->m_barang->bacadata();
		
		$this->load->library('session');
        $data['menu_user']=' active';
        $this->load->view('utama/barang/listbarang',$data);
		*/
		
		$this->load->database();
		$jumlah_data = $this->m_pemesanan->jumlah_pesanan();
		$this->load->library('pagination');
		$config['base_url'] = base_url().'index.php/user/viewpemesanan/';
		$config['total_rows'] = $jumlah_data;
		$config['per_page'] = 10;
		$from = $this->uri->segment(3);
		$this->pagination->initialize($config);		
		$data['user'] = $this->m_pemesanan->data($config['per_page'],$from);
		$this->load->view('user/listpesanan',$data);
		
    }
    
}


/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */