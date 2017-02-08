<?php 
class Pegawai extends CI_Controller {

    public function __construct(){
		parent::__construct();
		
        session_start();
		if ($this->session->userdata('username')=="") {
			redirect('login');
		}
        $this->load->model('m_petugas');
        $this->load->library('fpdf');
	}
    	public function index()
	{
		$this->load->view('utama/home1');
	}
	  
    public function viewpegawai()
    {
    /*   $this->load->model('m_petugas');
        $data['hasil'] = $this->m_petugas->bacadata();
		
        $this->load->view('utama/pegawai/listpegawai',$data);
		
	*/	
		$this->load->database();
		$jumlah_data = $this->m_petugas->jumlah_data();
		$this->load->library('pagination');
		$config['base_url'] = base_url().'index.php/pegawai/viewpegawai/';
		$config['total_rows'] = $jumlah_data;
		$config['per_page'] = 10;
		$from = $this->uri->segment(3);
		$this->pagination->initialize($config);		
		$data['user'] = $this->m_petugas->data($config['per_page'],$from);
		$this->load->view('utama/pegawai/listpegawai',$data);
	
    }
	

	 
	function updatedata($id_pegawai){
        if($_POST==NULL){
            $this->load->model('m_petugas');
            $data['hasil'] = $this->m_petugas->filterdata($id_pegawai);
            $this->load->view('/utama/pegawai/editpegawai',$data);
        }
        else{
            $this->load->model('m_petugas');
            $this->m_petugas->updatedata1();
            redirect('pegawai');
        }
    }
    
  function insertpegawai()
    {
       $this->load->model('m_petugas');
       $this->m_petugas->insertuser();
       redirect('login');
    }
 function insertuser()
    {
       $this->load->model('m_petugas');
       $this->m_petugas->insertuser();
       redirect('pegawai');
    }
    public function addpegawai()
    {
        $this->load->view('/utama/pegawai/addpegawai');
    }
	public function adduser()
    {
        $this->load->view('/user/signup');
    }
 public function addkategori()
    {
        $this->load->view('/utama/kategori/addkategori');
    }
  function deletedata($id_pegawai)
    {
        $this->load->model('m_petugas');
        $this->m_petugas->deletedata($id_pegawai);
        redirect('pegawai/viewpegawai');
    }
}


/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */