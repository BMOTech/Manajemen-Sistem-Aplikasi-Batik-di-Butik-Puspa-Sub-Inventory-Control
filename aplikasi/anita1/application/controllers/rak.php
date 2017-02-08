<?php 
class Kategori extends CI_Controller {

    public function __construct(){
		parent::__construct();
        session_start();
        $this->load->model('m_rak');
		if ($this->session->userdata('username')=="") {
			redirect('login');
		}
	}
    
	public function index()
	{
		$this->load->view('utama/home');
	}
	function updatedata1($kode_rak){
        if($_POST==NULL){
            $this->load->model('m_rak');
            $data['hasil'] = $this->m_rak->filterdata($kode_rak);
            $this->load->view('/utama/rak/editrak',$data);
        }
        else{
            $this->load->model('m_rak');
            $this->m_rak->updatedata();
            redirect('barang');
        }
    }
	 
	  function deletedata1($kode_rak)
    {
        $this->load->model('m_rak');
        $this->m_rak->deletedata($kode_rak);
        redirect('rak/viewrak');
    }
    
  public function viewrak()
    {
     /*  $this->load->model('m_kategori');
        $data['hasil'] = $this->m_kategori->bacadata();
		
		$this->load->library('session');
        $data['menu_user']=' active';
        $this->load->view('utama/kategori/listkategori',$data);*/
		$this->load->database();
		$jumlah_data = $this->m_rak->jumlah_data();
		$this->load->library('pagination');
		$config['base_url'] = base_url().'index.php/rak/viewrak/';
		$config['total_rows'] = $jumlah_data;
		$config['per_page'] = 10;
		$from = $this->uri->segment(3);
		$this->pagination->initialize($config);		
		$data['user'] = $this->m_rak->data($config['per_page'],$from);
		$this->load->view('utama/rak/listrak',$data);
		
    }
    
    public function addrak()
    {
       $this->load->view('utama/rak/addrak');  
    }


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */