<?php 
class Barang extends CI_Controller {

    public function __construct(){
		parent::__construct();
        session_start();
		$this->load->helper(array('url'));
        $this->load->model('m_barang');
        $this->load->library('fpdf');
		if ($this->session->userdata('username')=="") {
			redirect('login');
		}
	}
     function pesan(){
       
        $this->load->view('utama/laporan/faktur');
    }

    
    public function viewbarang()
    {
      /* $this->load->model('m_barang');
        $data['hasil'] = $this->m_barang->bacadata();
		
		$this->load->library('session');
        $data['menu_user']=' active';
        $this->load->view('utama/barang/listbarang',$data);
		*/
		
		$this->load->database();
		$jumlah_data = $this->m_barang->jumlah_data();
		$this->load->library('pagination');
		$config['base_url'] = base_url().'index.php/barang/viewbarang/';
		$config['total_rows'] = $jumlah_data;
		$config['per_page'] = 10;
		$from = $this->uri->segment(3);
		$this->pagination->initialize($config);		
		$data['user'] = $this->m_barang->data($config['per_page'],$from);
		$this->load->view('utama/barang/listbarang',$data);
		
    }
	 

	
	
	
	public function index($page=NULL,$offset='',$key=NULL)
    {        
        $data['query'] = $this->m_barang->get_allimage(); //query dari model
        
        $this->load->view('utama/home',$data); //tampilan awal ketika controller upload di akses
    }

    public function add() {
        //view yang tampil jika fungsi add diakses pada url
        $this->load->view('listbarang');
       
    }
    public function insert(){
        $this->load->library('upload');
        $nmfile = "file_".time(); //nama file + fungsi time
        $config['upload_path'] = './assets/uploads/'; //Folder untuk menyimpan hasil upload
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
        $config['max_size'] = '3072'; //maksimum besar file 3M
        $config['max_width']  = '5000'; //lebar maksimum 5000 px
        $config['max_height']  = '5000'; //tinggi maksimu 5000 px
        $config['file_name'] = $nmfile; //nama yang terupload nantinya

        $this->upload->initialize($config);
        
        if($_FILES['filefoto']['name'])
        {
            if ($this->upload->do_upload('filefoto'))
            {
                $gbr = $this->upload->data();
                $data = array(
				'kode_brg' =>$this->input->post('kode_brg'),
				'serial' =>$this->input->post('serial'),
				'kode_kategori' =>$this->input->post('kode_kategori'),
				'nama_brg' =>$this->input->post('nama_brg'),
				'detail_brg' =>$this->input->post('detail_brg'),


                'file' =>$gbr['file_name'],
                'type' =>$gbr['file_type'],                  
                );

                $this->m_barang->get_insert($data); //akses model untuk menyimpan ke database
                //dibawah ini merupakan code untuk resize
                $config2['image_library'] = 'gd2'; 
                $config2['source_image'] = $this->upload->upload_path.$this->upload->file_name;
                $config2['new_image'] = './assets/hasil_resize/'; // folder tempat menyimpan hasil resize
                $config2['maintain_ratio'] = TRUE;
                $config2['width'] = 100; //lebar setelah resize menjadi 100 px
                $config2['height'] = 100; //lebar setelah resize menjadi 100 px
                $this->load->library('image_lib',$config2); 

                //pesan yang muncul jika resize error dimasukkan pada session flashdata
                if ( !$this->image_lib->resize()){
                $this->session->set_flashdata('errors', $this->image_lib->display_errors('', ''));   
              }
                //pesan yang muncul jika berhasil diupload pada session flashdata
                $this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-success\" id=\"alert\">Upload gambar berhasil !!</div></div>");
                redirect('barang'); //jika berhasil maka akan ditampilkan view upload
            }else{
                //pesan yang muncul jika terdapat error dimasukkan pada session flashdata
                $this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-danger\" id=\"alert\">Gagal upload gambar !!</div></div>");
                redirect('barang'); //jika gagal maka akan ditampilkan form upload
            }
        }
	}
	 function insertkategori()
    {
       $this->load->model('m_kategori');
       $this->m_kategori->insert();
       redirect('barang');
    }
	function pesan_brg()
    {
				$sess_data['id_pemesanan'] = $sess->id_pemesanan;
				$sess_data['nama_pemesan'] = $sess->nama_pemesan;
				$sess_data['alamat'] = $sess->alamat;
				$sess_data['jumlah'] = $sess->jumlah;
				$sess_data['no_pemesan'] = $sess->no_pemesan;
				$sess_data['kode_brg'] = $sess->kode_brg;
				$this->session->set_userdata($sess_data);
       $this->load->model('m_barang');
       $this->m_barang->pesan();
       redirect('utama/home');
    }

    public function addbarang()
    {
		$this->load->model('m_kategori');
        $data['hasil'] = $this->m_kategori->bacadata();
		
        $this->load->view('/utama/barang/addbarang',$data);
    }
/*---------------------------------------------------------------http://alldie.co.id-----------------------------------------------------*/
  public function viewrak()
    {

        $this->load->model('m_rak');
        $jumlah_data = $this->m_rak->jumlah_data();
        $this->load->library('pagination');
        $config['base_url'] = base_url().'index.php/Barang/viewrak/';
        $config['total_rows'] = $jumlah_data;
        $config['per_page'] = 10;
        $from = $this->uri->segment(3);
        $this->pagination->initialize($config);     
        $data['user'] = $this->m_rak->data($config['per_page'],$from);
        $this->load->view('utama/rak/listrak',$data);
        
    }

    public function addrak()
    {
        $this->load->model('m_kategori');
        $data['hasil'] = $this->m_kategori->bacadata();
        
        $this->load->view('/utama/rak/addrak',$data);
    }

     function insertrak()
    {
       $this->load->model('m_rak');
       $this->m_rak->insert();
       redirect('barang/viewrak');
    }


      function deletedata1($kode_rak)
    {
        $this->load->model('m_rak');
        $this->m_rak->deletedata($kode_rak);
        redirect('barang/viewrak');
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
            redirect('barang/viewrak');
        }
    }

/*---------------------------------------------------------------http://alldie.co.id-----------------------------------------------------*/
	 public function update($kode_brg)
    {
		if($_POST==NULL){
            $this->load->model('m_barang');
            $data['hasil'] = $this->m_barang->filterdata($kode_brg);
            $this->load->view('/utama/barang/editbarang',$data);
        }
		
    }
	  public function update1(){
        $this->load->library('upload');
        $nmfile = "file_".time(); //nama file + fungsi time
        $config['upload_path'] = './assets/uploads/'; //Folder untuk menyimpan hasil upload
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
        $config['max_size'] = '3072'; //maksimum besar file 3M
        $config['max_width']  = '5000'; //lebar maksimum 5000 px
        $config['max_height']  = '5000'; //tinggi maksimu 5000 px
        $config['file_name'] = $nmfile; //nama yang terupload nantinya

        $this->upload->initialize($config);
        
        if($_FILES['file']['name'])
        {
            if ($this->upload->do_upload('file'))
            {
                $gbr = $this->upload->data();
                $data = array(
				'kode_brg' =>$this->input->post('kode_brg'),
				'serial' =>$this->input->post('serial'),
				'kode_kategori' =>$this->input->post('kode_kategori'),
				'nama_brg' =>$this->input->post('nama_brg'),
				'detail_brg' =>$this->input->post('detail_brg'),
                'file' =>$gbr['file_name'],
                'type' =>$gbr['file_type'],                  
                );

 $this->m_barang->update2($data, $this->input->post('kode_brg'));

               // $this->m_barang->get_insert($data); //akses model untuk menyimpan ke database
                //dibawah ini merupakan code untuk resize
                $config2['image_library'] = 'gd2'; 
                $config2['source_image'] = $this->upload->upload_path.$this->upload->file_name;
                $config2['new_image'] = './assets/hasil_resize/'; // folder tempat menyimpan hasil resize
                $config2['maintain_ratio'] = TRUE;
                $config2['width'] = 100; //lebar setelah resize menjadi 100 px
                $config2['height'] = 100; //lebar setelah resize menjadi 100 px
                $this->load->library('image_lib',$config2); 

                //pesan yang muncul jika resize error dimasukkan pada session flashdata
                if ( !$this->image_lib->resize()){
                $this->session->set_flashdata('errors', $this->image_lib->display_errors('', ''));   
              }
                //pesan yang muncul jika berhasil diupload pada session flashdata
                $this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-success\" id=\"alert\">Upload gambar berhasil !!</div></div>");
                redirect('barang'); //jika berhasil maka akan ditampilkan view upload
            }else{
                //pesan yang muncul jika terdapat error dimasukkan pada session flashdata
                $this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-danger\" id=\"alert\">Gagal upload gambar !!</div></div>");
                redirect('barang'); //jika gagal maka akan ditampilkan form upload
            }
        }
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