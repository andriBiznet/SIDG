<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Form_tambah extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('m_data');
		$this->load->helper('url');
	}

	public function tambah(){
	    $data = array(
	        'id_form'  => $this->input->post('id_form'),
	        'tahun' => $this->input->post('tahun'),
	        'judul' => $this->input->post('judul'),
	        'sumber_data' => $this->input->post('sumber_data'),
	        'keterangan' => $this->input->post('keterangan'),
	        'nama_kontak' => $this->input->post('nama_kontak'),
	        'no_hp_kontak' => $this->input->post('no_hp_kontak'),
	        'email_kontak' => $this->input->post('email_kontak')
	    );

	    // var_export($data);exit();
	    $this->m_data->tambah($data);
	    $this->session->set_flashdata('notif','<div class="alert alert-success" role="alert"> Data Berhasil ditambahkan <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
	    redirect(site_url('/form/form'));
	}


}
