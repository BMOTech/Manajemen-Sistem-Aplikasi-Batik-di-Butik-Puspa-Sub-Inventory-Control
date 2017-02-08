<?php
class M_barangmasuk extends CI_Model{
	function __construct(){
		parent::__construct()
		;
	}
	
	function insert() {
        $insert_petugas = array(
            'no_brgmasuk' => $this->input->post('no_brgmasuk'),
			 'tgl_masuk' => $this->input->post('tgl_masuk'),
			'kode_supp' => $this->input->post('kode_supp'),
            'username' => $this->input->post('username'),
            'jml_brg' => $this->input->post('jml_brg'),
           	'kode_brg' => $this->input->post('kode_brg'),
            'rak' => $this->input->post('rak'),

			
        );

        $insert = $this->db->insert('barang_masuk', $insert_petugas);
        return $insert;
    }
function insert2() {
        $insert_petugas1 = array(
            'no_brgmasuk' => $this->input->post('no_brgmasuk'),
			'rak' => $this->input->post('rak'),
			'kode_brg' => $this->input->post('kode_brg'),
            'jml_brg' => $this->input->post('jml_brg'),

			
        );

        $insert = $this->db->insert('detail_brgmasuk', $insert_petugas1);
        return $insert2;
    }

    function updatedata(){
        $no_brgmasuk = $this->input->post('no_brgmasuk');
        $tgl_masuk = $this->input->post('tgl_masuk');
		$kode_supp = $this->input->post('kode_supp');
		$username = $this->input->post('username');		
		$jml_brg = $this->input->post('jml_brg');		

		;
		$data = array(
                'no_brgmasuk'=>$no_brgmasuk,
				'tgl_masuk'=>$tgl_masuk,
                'kode_supp'=>$kode_supp,
				'username'=>$username,
				'jml_brg'=>$jml_brg,
				
				
				);
        $this->db->where(array('no_brgmasuk'=>$no_brgmasuk));
        $this->db->update('barang_masuk',$data);
    }

    function deletedata($no_brgmasuk){
        
        $this->db->where('no_brgmasuk', $no_brgmasuk);
        $this->db->delete('barang_masuk'); 
    }

    function cariPetugas($cari){
        $cari=$this->db->query("select * from petugas where id_petugas LIKE '%$cari%'  ");
        return $cari->result();
    }
    
    function filterdata($id_petugas){
        return $this->db->get_where('petugas',
        array('id_petugas'=>$id_petugas))->row();
    }
	
	function bacadata(){
        $baca = $this->db->get('pegawai');
        if($baca->num_rows() > 0){
            foreach ($baca->result() as $data){
                $hasil[] = $data;
            }
            return $hasil;
        }
    }

   


}

?>