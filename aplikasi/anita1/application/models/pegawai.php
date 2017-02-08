<?php
class pegawai extends CI_Model{
	function __construct(){
		parent::__construct()
		;
	}
	function data($number,$offset){
		return $query = $this->db->get('barang',$number,$offset)->result();		
	}
    function get(){
        return $this->db->get("barang");
    }
	
	function insert() {
        $insert_ruangan = array(
            'kode_brg' => $this->input->post('kode_brg'),
            'serial' => $this->input->post('serial'),
			'kode_kategori' => $this->input->post('kode_kategori'),
            'detail_brg' => $this->input->post('detail_brg'),			
        );
        $insert = $this->db->insert('barang', $insert_ruangan);
        return $insert;
    }
	   //fungsi untuk menampilkan semua data dari tabel database
 function get_allimage() {
        $this->db->from($this->tabel);
  $query = $this->db->get();
        return $query->result();
 }

    //fungsi insert ke database
    function get_insert($data){
       $this->db->insert($this->tabel, $data);
       return TRUE;
    }
	function get_insert1($data){
       $this->db->insert($this->tabel1, $data);
       return TRUE;
    }
	    var $tabel = 'barang';
		var $tabel1 = 'tmp';

    function updatedata(){
        $id_pegawai = $this->input->post('id_pegawai');
        $username = $this->input->post('username');
		$password = $this->input->post('password');
		$level = $this->input->post('level');		
		$status = $this->input->post('status');		

		;
		$data = array(
                'id_pegawai'=>$id_pegawai,
				'username'=>$username,
                'password'=>$password,
				'level'=>$level,
				'status'=>$status,

				
				);
        $this->db->where(array('id_pegawai'=>$id_pegawai));
        $this->db->update('pegawai',$data);
    }
function filterdata($kode_brg){
        return $this->db->get_where('barang',
                          array('kode_brg'=>$kode_brg))->row();
    }
function update2($data, $kode_brg){
	$this->db->where('kode_brg', $kode_brg);
	$this->db->update('barang', $data);
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
    function deletedata($kode_brg){ 
        $this->db->where('kode_brg', $kode_brg);
        $this->db->delete('barang'); 
    }
	function jumlah_data(){
		return $this->db->get('barang')->num_rows();
	}
	
	function detail_dtBarang($id){
		return $this->db->where('kd_barang',$id)->get('kd_barang')->result_array();
	}
	
	function edit_dtBarang($id,$arrayData){
        $this->db->where('kd_barang', $id);
        return $this->db->update($this->table, $arrayData); 
    }
    function get_all()
    {
        $this->db->get('barang');       
    }     

}
?>