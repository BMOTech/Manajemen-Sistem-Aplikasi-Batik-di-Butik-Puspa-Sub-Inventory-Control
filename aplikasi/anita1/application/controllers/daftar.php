<?php 
class Daftar extends CI_Controller {

    public function __construct(){
		parent::__construct();
		
        session_start();
		
        $this->load->model('m_petugas');
        $this->load->library('fpdf');
	}
    	public function index()
	{
		$this->load->view('utama/home');
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
       redirect('barang');
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
  function deletedata($kode_brg)
    {
        $this->load->model('m_barng');
        $this->m_barang->deletedata($kode_brg);
        redirect('barang/viewbarang');
    }
}


/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */