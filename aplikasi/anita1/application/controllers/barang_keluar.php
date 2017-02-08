<?php 
class Barang_keluar extends CI_Controller {

    public function __construct(){
		parent::__construct();
        session_start();
        $this->load->model('m_barangkeluar');
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
       $this->load->model('m_barangkeluar');
        $data['hasil'] = $this->m_barangkeluar->bacadata();
		
		$this->load->library('session');
        $data['menu_user']=' active';
        $this->load->view('utama/barang/listbarang_keluar',$data);
    }
	
	
  function insertbarang()
    {
       $this->load->model('m_barangkeluar');
       $this->m_barangkeluar->insert();
	   $this->m_barangkeluar->insert2();
       redirect('barang');
    }
	
    public function addbarangkeluar()
    {
		$this->load->model('m_barang');
        $data['hasil1'] = $this->m_barang->bacadata();
		
        $this->load->view('/utama/barang_keluar/addbarang_keluar',$data);
    }

  function deletedata($kode_brg)
    {
        $this->load->model('m_barangkeluar');
        $this->m_baangkeluar->deletedata($no_brgkeluar);
        redirect('barang_keluar/viewbarang');
    }
}


/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */