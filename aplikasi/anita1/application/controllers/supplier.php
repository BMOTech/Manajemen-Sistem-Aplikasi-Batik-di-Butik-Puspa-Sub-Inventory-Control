<?php 
class Supplier extends CI_Controller {

    public function __construct(){
		parent::__construct();
        session_start();
        $this->load->model('m_supplier');
        $this->load->library('fpdf');
		if ($this->session->userdata('username')=="") {
			redirect('login');
		}
	}
    
	public function index()
	{
		$this->load->view('utama/home');
	}
    
	function updatedata($kode_supp){
        if($_POST==NULL){
            $this->load->model('m_supplier');
            $data['hasil'] = $this->m_supplier->filterdata($kode_supp);
            $this->load->view('/utama/supplier/editsupplier',$data);
        }
        else{
            $this->load->model('m_supplier');
            $this->m_supplier->updatedata();
            redirect('barang');
        }
    }
    
    public function viewsupplier()
    {
     /*  $this->load->model('m_supplier');
        $data['hasil'] = $this->m_supplier->bacadata();
		
		$this->load->library('session');
        $data['menu_user']=' active';
        $this->load->view('utama/supplier/listsupplier',$data);
    */
	$this->load->database();
		$jumlah_data = $this->m_supplier->jumlah_data();
		$this->load->library('pagination');
		$config['base_url'] = base_url().'index.php/supplier/viwsupplier/';
		$config['total_rows'] = $jumlah_data;
		$config['per_page'] = 10;
		$from = $this->uri->segment(3);
		$this->pagination->initialize($config);		
		$data['user'] = $this->m_supplier->data($config['per_page'],$from);
		$this->load->view('utama/supplier/listsupplier',$data);
		
	}
	
	
  function insertsupplier()
    {
       $this->load->model('m_supplier');
       $this->m_supplier->insert();
       redirect('supplier');
    }
	
    public function addsupplier()
    {
        $this->load->view('/utama/supplier/addsupplier');
    }

  function deletedata($kode_supp)
    {
        $this->load->model('m_supplier');
        $this->m_supplier->deletedata($kode_supp);
        redirect('supplier/viewsupplier');
    }
}


/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */