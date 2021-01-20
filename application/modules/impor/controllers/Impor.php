<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Impor extends MX_Controller {
    private $filename = "import_data";

    public function index()
    {
        $this->load->view('impor_index');
    }
    
    public function upload()
    {
        $id_form = $this->uri->segment(4);

        $config = array (
            'upload_path' => './uploads/',
            'allowed_types' => 'xls|xlsx',
            'max_size' => 2048,
            'max_width' => 1024,
            'max_height' => 1024,
        );
        
        $this->load->library('upload', $config);
        
        if ($this->upload->do_upload('userfile')) {
            include APPPATH.'third_party/PHPExcel/PHPExcel.php';

            $data_upload = $this->upload->data();

            $excelreader     = new PHPExcel_Reader_Excel2007();
            $loadexcel         = $excelreader->load('uploads/'.$data_upload['file_name']); // Load file yang telah diupload ke folder excel
            // print_r($loadexcel);exit();
            $sheet             = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);

            $data = array();

            $numrow = 4;
            foreach($sheet as $row){
                if($numrow > 4){
                    array_push($data, array(
                        'tahun' => $row['A'],
                        // 'nama'      => $row['B'],
                        // 'jenis_kelamin'      => $row['C'],
                        // 'alamat'      => $row['D'],
                    ));
                }
                $numrow++;
            }
            print_r($data);exit();
            $this->db->insert_batch('form_series', $data);
            //delete file from server\
            unlink(realpath('excel/'.$data_upload['file_name']));
            $this->session->set_flashdata('notif', '<div class="alert alert-success"><b>PROSES IMPORT BERHASIL!</b> Data berhasil diimport!</div>');
            //redirect halaman
            redirect(site_url('/form/'.$id_form));
        }
        else {
            $this->session->set_flashdata('notif', '<div class="alert alert-danger"><b>PROSES IMPORT GAGAL!</b> '.$this->upload->display_errors().'</div>');
            // redirect halaman
            redirect(site_url('/form/'.$id_form));
        }
    }

}
