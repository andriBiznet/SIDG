<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Author : Ismo Broto : git @ismo1106
 */
  use PhpOffice\PhpSpreadsheet\Spreadsheet;
  use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Export extends CI_Controller {

   public function export_data_series($id_form){
      $this->load->helper('file');
      $this->load->helper('download');
      $this->load->helper('file');    
      $this->load->model('form_model');
    
      $id_form = $this->uri->segment(4);
      $tahun = $this->uri->segment(5);
    
      if ($tahun == '') $tahun = date('Y') - 1;
    
      $this->db->where('row_status', 1);
      $this->db->where('id', $id_form);
      $src = $this->db->get('form');
    
      if ($src->num_rows() == 0) redirect(site_url('/dasbor'));
      $form         = $src->row();
      $data_series  = $this->form_model->series($id_form);
      $cols         = $this->form_model->cols($id_form);
      $judul        = $form->nama;
    
      $data = "";
      $data .= '

      <style type="text/css">
        .num  {
          mso-number-format:"#,##0"
        }
        .dsgn {
          text-align: center;
        }
        .dsgn_tr{
          background-color : #4682b4;
          color   : white;
        }
      </style>

      <h2 class="dsgn">'.$judul.'</h2>
        <table border="1" width="auto">
          <tr class="dsgn_tr">
            <th>Tahun</th>';
            foreach ($cols->result() as $col):;
              $data .= '<th>'.$col->teks.'<br>('.$col->kode_satuan.')</th>';
            endforeach;
          $data .='</tr>';
          if(is_array($data_series)):
            foreach ($data_series as $tahun => $isi):;
                $data .=  '<tr>
                  <td class=dsgn>'.$tahun.'</td>';
                  foreach ($isi as $id_pengukuran => $nilai):;
                    $data .= '<td class="num">'.$nilai.'</td>';
                  endforeach;
                $data .= '</tr>';
            endforeach;
          endif;
        $data .= '</table>';

        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=".$judul.".xls");

        header("Content-Transfer-Encoding: binary ");
   }

   public function export_data_matrix($id_form, $tahun){
      $this->load->helper('file');
      $this->load->helper('download');
      $this->load->helper('file');    
      $this->load->model('form_model');
    
      $id_form = $this->uri->segment(4);
      $tahun = $this->uri->segment(5);

      // echo $tahun;exit();
    
      if ($tahun == '') $tahun = date('Y') - 1;
    
      $this->db->where('row_status', 1);
      $this->db->where('id', $id_form);
      $src = $this->db->get('form');
    
      if ($src->num_rows() == 0) redirect(site_url('/dasbor'));
      $form         = $src->row();
      $data_matrix  = $this->form_model->matrix($id_form,$tahun);
      $cols         = $this->form_model->cols($id_form);
      $judul        = $form->nama;
      // echo $judul;exit();

      $data = "";
      $data .= '

      <style type="text/css">
        .num  {
          mso-number-format:"#,##0"
        }
        .dsgn_tr{
          background-color : #4682b4;
          color   : white;
        }
        .dsgn {
          text-align: center;
        }
      </style>

      <h2 align="center">'.$judul.' || '.$tahun.'</h2>
        <table>
          <tr>
            <th>Tahun Inventori:</th>
            <th style=text-align:left;>'.$tahun.'</th>
          </tr>
        </table><br>
        <table border="1" width="auto">
          <tr class="dsgn_tr">
            <th>No</th>
            <th>Unit</th>';
            foreach ($cols->result() as $col):;
              $data .= '<th>'.$col->teks.'<br>('.$col->kode_satuan.')</th>';
            endforeach;
          $data .='</tr>';
          if(is_array($data_matrix)):
            $no = 1;
            foreach ($data_matrix as $unit => $sub):;
               $data .= '
                  <tr>
                     <td style="text-align:left;">'.$no++.'</td>';
               $data .= ' 
                     <td>'.$unit.'</td>';
                  foreach ($sub as $id_pengukuran => $isi):;
                    $data .= '<td class="num">'.$isi['nilai'].'</td>';
                  endforeach;
                $data .= '</tr>';
            endforeach;
          endif;
        $data .= '</table>';

        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=".$judul."_".$tahun.".xls");

        header("Content-Transfer-Encoding: binary ");
   }

}