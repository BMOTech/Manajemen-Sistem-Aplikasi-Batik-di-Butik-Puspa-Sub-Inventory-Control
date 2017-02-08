<?php 
class Pdf_report extends CI_Controller {

    public function index()
    {
        // Load library FPDF
        $this->load->library('fpdf');
         
        // Load Database
        $this->load->database();
         
        /* buat konstanta dengan nama FPDF_FONTPATH, kemudian kita isi value-nya
           dengan alamat penyimpanan FONTS yang sudah kita definisikan sebelumnya.
           perhatikan baris $config['fonts_path']= 'system/fonts/';
           didalam file application/config/config.php
        */           
        define('FPDF_FONTPATH',$this->config->item('fonts_path'));
         
        // Load model "karyawan_model"
        $this->load->model('model_barang');
         
        /* Kita akses function get_all didalam karyawan_model
           function get_all merupakan fungsi yang dibuat untuk mengambil
           seluruh data karyawan didalam database.
        */
        $data['barang'] = $this->model_barang->get_all();
         
        // Load view "pdf_report" untuk menampilkan hasilnya       
        $this->load->view('pdf_report', $data);
    }
}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */