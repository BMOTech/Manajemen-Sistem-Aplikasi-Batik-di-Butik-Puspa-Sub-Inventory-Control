 <?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//require APPPATH.'/libraries/REST_Controller.php';
class Witems extends CI_Controller {
	protected $builtInMethods;
	function __construct(){
		parent::__construct();	
	
		$this->load->model('m_items');
require APPPATH.'/libraries/REST_Controller.php';
				
	}
	

	public function all_barang_get(){
		$requesklien = json_decode(file_get_contents ("php://input"));
		header('Content-type: application/json');
		$query = $this->m_items->get_all();
		$json =  json_encode ($query);	
	
		echo $json;
	
	}
		public function index1(){
		$requesklien = json_decode(file_get_contents ("php://input"));
		header('Content-type: application/json');
		$query = $this->m_items->getItems1();
		$json =  json_encode ($query);	
	
		echo $json;
	
	}
	
	  public function save($data)
  {
      $data = (array)json_decode(file_get_contents('php://input'));
      $this->m_items->insert($data);
		var_dump($data);

      $response = array(
        'Success' => true,
        'Info' => 'Data Tersimpan');

      $this->output
        ->set_status_header(201)
        ->set_content_type('application/json', 'utf-8')
        ->set_output(json_encode($response, JSON_PRETTY_PRINT))
        ->_display();
        exit;
  }
  function a_barang_get() {
		/* * check apakah atribut id sudah di set saat pemanggilan */
		if(!$this->get('id')) {
			$this->response(NULL, 400); // jika belom diset maka akan dibawa ke page not found
		}
		/* * jika sudah diset */
		else {
			/* * mengambil data sesuai dengan id */
			$query = $this->m_items->get_one($this->get('id'));
			/* * jika query berhasi akan ditampilkan hasilnya */
			if($query) {
				$this->response($query, 200);
				// 200 being the HTTP response code
			} else {
				$this->response(array('error' => 'User could not be found'), 404);
			}
		}
	}
	
  public function update($kode_kategori)
  {
    $data = (array)json_decode(file_get_contents('php://input'));
    $this->m_items->update($data, $kode_kategori);

    $response = array(
      'Success' => true,
      'Info' => 'Data Berhasil di update');

    $this->output
      ->set_status_header(200)
      ->set_content_type('application/json', 'utf-8')
      ->set_output(json_encode($response, JSON_PRETTY_PRINT))
      ->_display();
      exit;
  }
     public function deletePetugas($id_petugas)
  {
    $this->m_items->deletePetugas($id_petugas);
    $response = array(
      'Success' => true,
      'Info' => 'Data Berhasil di hapus');

    $this->output
      ->set_status_header(200)
      ->set_content_type('application/json', 'utf-8')
      ->set_output(json_encode($response, JSON_PRETTY_PRINT))
      ->_display();
      exit;
  }
  function del_barang($kode_kategori){
           
            $query = $this->m_items->del_barang($kode_kategori);
            echo "<script>alert('Delete Barang Berhasil')</script>";
            $this->response($query, 200); // 200 being the HTTP response code
   }
}

?>