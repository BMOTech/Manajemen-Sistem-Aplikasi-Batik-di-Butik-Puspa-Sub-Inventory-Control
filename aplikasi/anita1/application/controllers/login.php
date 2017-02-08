<?php 
class Login extends CI_Controller {
    public function __construct(){
		parent::__construct();
		session_start();
		$this->load->model('m_login');
		
	}
	
	public function index()
	{
		$this->load->view('login');
	}

	public function process()
	{
		$data = array('username' => $this->input->post('username',TRUE),
					'password' => md5($this->input->post('password', TRUE))
			);
		$this->load->model('m_login');
		$hasil = $this->m_login->cek_user($data);
		if($hasil->num_rows()==1){
			foreach ($hasil->result() as $sess) {
				$sess_data['logged_in'] = 'Sudah_Login';
				$sess_data['id_pegawai'] = $sess->id_pegawai;
				$sess_data['username'] = $sess->username;
				$sess_data['level'] = $sess->level;
				$sess_data['status'] = $sess->status;

				$this->session->set_userdata($sess_data);
			
			}
			if ($this->session->userdata('level')=='management') {
				redirect('utama/user');
			}
			elseif ($this->session->userdata('level')=='admin') {
				if ($this->session->userdata('status')=='Aktif'){
				redirect('utama');
				}
				else {
				echo "<script> alert ('Maaf akun anda belum aktif, mohon tunggu sesaat'); history.go(-1); </script>";
				}
			}
			
			elseif ($this->session->userdata('level')=='8') {
				redirect('utama/spvrembang');
			}
			
			elseif ($this->session->userdata('level')=='9') {
				redirect('utama/regional');
			}
		}
		else {
			echo "<script> alert ('Gagal Login: cek username, password'); history.go(-1); </script>";
		}
	}

    
   /* public function logout(){
		$array=array(
			'id_user' => '',	
			'username'=>'',
			'password'=>'',
			);
		$this->session->sess_destroy();
		redirect('login');
	}*/
		public function logout() {
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('level');
		session_destroy();
		redirect('login','index');
	}
}

?>
