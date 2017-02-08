<?php 
class Barang_masuk extends CI_Controller {

    public function __construct(){
		parent::__construct();
        session_start();
        $this->load->model('m_barangmasuk');
        $this->load->library('fpdf');
		if ($this->session->userdata('username')=="") {
			redirect('login');
		}
	}
    
	public function index()
	{
		$this->load->view('utama/home');
	}
    
    public function viewbarang()
    {
       $this->load->model('m_barangmasuk');
        $data['hasil'] = $this->m_barangmasuk->bacadata();
		
		$this->load->library('session');
        $data['menu_user']=' active';
        $this->load->view('utama/barang_masuk/listbarang_masuk',$data);
    }
	
	
  function insertbarang()
    {
       $this->load->model('m_barangmasuk');
       $this->m_barangmasuk->insert();
       $this->m_barangmasuk->insert2();

       redirect('barang_masuk');
    }
	
    public function addbarang()
    {
		
		$this->load->model('m_barang');
        $data['hasil1'] = $this->m_barang->bacadata();

    $this->load->model('m_rak');
        $data['hasil2'] = $this->m_rak->bacadata();
		
		$this->load->model('m_supplier');
        $data['hasil'] = $this->m_supplier->bacadata();
        $this->load->view('/utama/barang_masuk/addbarang_masuk',$data);
    }
 public function addkategori()
    {
        $this->load->view('/utama/kategori/addkategori');
    }
  function deletedata($kode_brg)
    {
        $this->load->model('m_barangmasuk');
        $this->m_barang->deletedata($no_brgmasuk);
        redirect('barang_masuk/viewbarang');
    }
}


/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */