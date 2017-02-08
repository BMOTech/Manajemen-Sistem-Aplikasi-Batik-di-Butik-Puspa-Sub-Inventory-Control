<?php 
class Laporan extends CI_Controller {

    public function __construct(){
		parent::__construct();
        session_start();
		if ($this->session->userdata('username')=="") {
			redirect('login');
		}
		$this->load->helper(array('url'));
        $this->load->model('m_laporan');
        $this->load->library('fpdf');
	}

     
    
public function index($page=NULL,$offset='',$key=NULL)
    {

        $data['query'] = $this->m_laporan->get_allimage(); //query dari model

        $this->load->view('utama/home',$data); //tampilan awal ketika controller upload di akses
    }

    

 public function viewstock()
    {
     //$query = $this->db->query("select * from stok where jml_brg < 10");

    // if($query){
    //   $datahabis;
    //   foreach ($query->result() as $row)
    //   {
    //       $datahabis = " $row->kode_brg : $row->jml_brg ";
    //       //$this->SendSMS("127.0.0.1",8800,"admin","admin","083826263232","Test Habis");
    //   }
    // }elseif($query == 0){
    //   //Todo
    // }
        
      /* $this->load->model('m_barang');
        $data['hasil'] = $this->m_barang->bacadata();
		
		$this->load->library('session');
        $data['menu_user']=' active';
        $this->load->view('utama/barang/listbarang',$data);
		*/
		
		$this->load->database();
		$jumlah_data = $this->m_laporan->jumlah_data();
		$this->load->library('pagination');
		$config['base_url'] = base_url().'index.php/laporan/stock/';
		$config['total_rows'] = $jumlah_data;
		$config['per_page'] = 10;
		$from = $this->uri->segment(3);
		$this->pagination->initialize($config);		
		$data['user'] = $this->m_laporan->data($config['per_page'],$from);
		$this->load->view('utama/laporan/liststok',$data);
		
    }

    public function viewstock_user()
    {
     //$query = $this->db->query("select * from stok where jml_brg < 10");

    // if($query){
    //   $datahabis;
    //   foreach ($query->result() as $row)
    //   {
    //       $datahabis = " $row->kode_brg : $row->jml_brg ";
    //       //$this->SendSMS("127.0.0.1",8800,"admin","admin","083826263232","Test Habis");
    //   }
    // }elseif($query == 0){
    //   //Todo
    // }
        
      /* $this->load->model('m_barang');
        $data['hasil'] = $this->m_barang->bacadata();
        
        $this->load->library('session');
        $data['menu_user']=' active';
        $this->load->view('utama/barang/listbarang',$data);
        */
        
        $this->load->database();
        $jumlah_data = $this->m_laporan->jumlah_data();
        $this->load->library('pagination');
        $config['base_url'] = base_url().'index.php/laporan/stock/';
        $config['total_rows'] = $jumlah_data;
        $config['per_page'] = 10;
        $from = $this->uri->segment(3);
        $this->pagination->initialize($config);     
        $data['user'] = $this->m_laporan->data($config['per_page'],$from);
        $this->load->view('utama/laporan/liststok_management',$data);
        
    }

	function carirekap(){
	
		$cari1=$this->input->get('cari1');
        $cari2=$this->input->get('cari2');
		$this->load->model('m_laporan');
        $beda['cari']=$this->m_laporan->carirekap($cari1);
        $this->load->view('utama/laporan/listlaporan',$beda);   
    }
		function carirekap1(){
	
		$cari1=$this->input->get('cari1');
        $cari2=$this->input->get('cari2');
		$this->load->model('m_laporan');
        $beda['cari']=$this->m_laporan->carirekap1($cari1);
        $this->load->view('utama/laporan/listlaporan_keluar',$beda);   
    }
	
	 function insertkategori()
    {
       $this->load->model('m_kategori');
       $this->m_kategori->insert();
       redirect('barang');
    }
    public function laporan_brgmasuk()
    {
		/*$this->load->model('m_laporan');
        $data['hasil'] = $this->m_laporan->bacadata();
		*/
        $this->load->view('/utama/laporan/cari');
    }
    public function laporan_brgmasuk_user()
    {
        /*$this->load->model('m_laporan');
        $data['hasil'] = $this->m_laporan->bacadata();
        */
        $this->load->view('/utama/laporan/cari_user');
    }
	    public function laporan_brgkeluar()
    {
		/*$this->load->model('m_laporan');
        $data['hasil'] = $this->m_laporan->bacadata();
		*/
        $this->load->view('/utama/laporan/cari_brgkeluar');
    }
     public function laporan_brgkeluar_user()
    {
        /*$this->load->model('m_laporan');
        $data['hasil'] = $this->m_laporan->bacadata();
        */
        $this->load->view('/utama/laporan/cari_brgkeluar_user');
    }
	 public function update()
    {
		$this->load->model('m_kategori');
        $data['hasil'] = $this->m_kategori->bacadata();
		
        $this->load->view('/utama/barang/addbarang',$data);
    }
 public function addkategori()
    {
        $this->load->view('/utama/kategori/addkategori');
    }
	

    function bacadata(){
        $baca = $this->db->get('barang');
        if($baca->num_rows() > 0){
            foreach ($baca->result() as $data){
                $hasil[] = $data;
            }
            return $hasil;
        }
    }
  function deletedata($kode_brg)
    {
        $this->load->model('m_barang');
        $this->m_barang->deletedata($kode_brg);
        redirect('barang/viewbarang');
    }
	
    
}


/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */