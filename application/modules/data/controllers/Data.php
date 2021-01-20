<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data extends MX_Controller {

	public function index()
	{
		$kode_instansi = strtolower($this->uri->segment(2));
		
		$src = $this->db
						->from('instansi')
						->where('row_status', 1)
						->where('kode', $kode_instansi)
						->get();
		
		if ($src->num_rows() == 0) redirect(site_url('/dasbor'));
		
		$instansi = $src->row();
		
		$forms = $this->db
						->from('form')
						->where('row_status', 1)
						->where('id_instansi', $instansi->id)
						->order_by('urutan')
						->get();
		
		$this->load->view('templates/site_tpl', array (
			'header' => 'Data Aktivitas dari '.$instansi->alias,
			'content' => 'data_index',
			'forms' => $forms,
		));
	}

}
