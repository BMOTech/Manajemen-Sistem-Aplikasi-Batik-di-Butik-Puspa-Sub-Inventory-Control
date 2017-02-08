<?php
class M_barangkeluar extends CI_Model{
	function __construct(){
		parent::__construct()
		;
	}
	
	function insert() {
        $insert_petugas = array(
            'no_brgkeluar' => $this->input->post('no_brgkeluar'),
			 'tgl_keluar' => $this->input->post('tgl_keluar'),
            'username' => $this->input->post('username'),
            'jml_brg' => $this->input->post('jml_brg'),

			 'kode_brg' => $this->input->post('kode_brg'),

           
			
        );

        $insert = $this->db->insert('barang_keluar', $insert_petugas);
        return $insert;
    }
	function insert2() {
        $insert_petugas1 = array(
            'no_brgkeluar' => $this->input->post('no_brgkeluar'),
			'kode_brg' => $this->input->post('kode_brg'),
            'jml_brg' => $this->input->post('jml_brg'),

			
        );

        $insert = $this->db->insert('detail_brgkeluar', $insert_petugas1);
        return $insert2;
    }

    function updatedata(){
        $no_brgkeluar = $this->input->post('no_brgkeluar');
        $tgl_keluar = $this->input->post('tgl_keluar');
		$username = $this->input->post('username');		
		$jml_brg = $this->input->post('jml_brg');		

		;
		$data = array(
                'no_brgkeluar'=>$no_brgkeluar,
				'tgl_keluar'=>$tgl_keluar,
				'username'=>$username,
				'jml_brg'=>$jml_brg,
				
				
				);
        $this->db->where(array('no_brgkeluar'=>$no_brgkeluar));
        $this->db->update('barang_keluar',$data);
    }

    function deletedata($no_brgkeluar){
        
        $this->db->where('no_brgkeluar', $no_brgkeluar);
        $this->db->delete('barang_keluar'); 
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