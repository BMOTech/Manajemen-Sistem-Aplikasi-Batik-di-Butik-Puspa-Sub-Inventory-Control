<?php 
class Kategori extends CI_Controller {

    public function __construct(){
		parent::__construct();
        session_start();
        $this->load->model('m_kategori');
		if ($this->session->userdata('username')=="") {
			redirect('login');
		}
	}
    
	public function index()
	{
		$this->load->view('utama/home');
	}
	function updatedata($kode_kategori){
        if($_POST==NULL){
            $this->load->model('m_kategori');
            $data['hasil'] = $this->m_kategori->filterdata($kode_kategori);
            $this->load->view('/utama/kategori/editkategori',$data);
        }
        else{
            $this->load->model('m_kategori');
            $this->m_kategori->updatedata();
            redirect('barang');
        }
    }
	 
	  function deletedata($kode_kategori)
    {
        $this->load->model('m_kategori');
        $this->m_kategori->deletedata($kode_kategori);
        redirect('kategori/viewkategori');
    }
    
  public function viewkategori()
    {
     /*  $this->load->model('m_kategori');
        $data['hasil'] = $this->m_kategori->bacadata();
		
		$this->load->library('session');
        $data['menu_user']=' active';
        $this->load->view('utama/kategori/listkategori',$data);*/
		$this->load->database();
		$jumlah_data = $this->m_kategori->jumlah_data();
		$this->load->library('pagination');
		$config['base_url'] = base_url().'index.php/kategori/viewkategori/';
		$config['total_rows'] = $jumlah_data;
		$config['per_page'] = 10;
		$from = $this->uri->segment(3);
		$this->pagination->initialize($config);		
		$data['user'] = $this->m_kategori->data($config['per_page'],$from);
		$this->load->view('utama/kategori/listkategori',$data);
		
    }
    
    public function addkategori()
    {
       $this->load->view('utama/kategori/addkategori');  
    }


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */