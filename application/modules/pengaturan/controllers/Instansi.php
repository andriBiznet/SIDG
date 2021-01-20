<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Instansi extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('m_data');
		$this->load->helper('url');
	}

	public function index()
	{
		$data = $this->db
						->select('
							a.id
							, a.nama
							, a.alias
							, a.kode
							, a.created_by
							, b.nama as nama_by
						')
						->from('instansi AS a')
						->join('pengguna AS b', 'b.id = a.created_by AND b.row_status = 1')
						->where('a.row_status', 1)
						->order_by('id')
						->get();
		
		$this->load->view('templates/site_tpl', array (
			'header' => 'Pengaturan Instansi',
			'toolbar' => array (
				array (
					'url' => site_url('/pengaturan/instansi/tambah'),
					'text' => 'Tambah',
				),
			),
			'content' => 'instansi_index',
			'data' => $data,
		));
	}
	
	private function _form($action = 'insert', $id = '')
	{
		$data = null;
		
		if ($this->session->flashdata('data')) {
			$data = (object) $this->session->flashdata('data');
		}
		else {
			if ($action == 'update') {
				$this->db->where('row_status', 1);
				$this->db->where('id', $id);
				$src = $this->db->get('instansi');
				
				if ($src->num_rows() == 0) redirect(site_url('/pengaturan/instansi'));
				else $data = $src->row();
			}
		}
		
		$this->load->view('templates/site_tpl', array (
			'header' => 'Form Instansi',
			'toolbar' => array (
				array (
					'url' => site_url('/pengaturan/instansi'),
					'text' => 'Kembali',
				),
			),
			'content' => 'instansi_form',
			'action' => site_url('/pengaturan/instansi/'.$action),
			'data' => $data,
		));
	}
	
	public function tambah()
	{
		$this->_form();
	}
	
	public function ubah($id)
	{
		$this->_form('update', $id);
	}
	
	private function _form_data($action)
	{
		$this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim');
		$this->form_validation->set_rules('alias', 'Alias', 'required|trim');
		// $this->form_validation->set_rules('kode', 'Kode', 'required');		
		$edit_kode 	= strtolower($this->input->post('alias'));
		$kode 		= str_replace(' ', '_', $edit_kode);

		if ($this->form_validation->run()) {
			$data = array (
				'nama' => $this->input->post('nama'),
				'alias' => $this->input->post('alias'),
				'kode' => $kode,
				'row_status' => '1',
			);			
			// var_dump($data);exit();
			return $data;
		}
		else {
			$this->session->set_flashdata('save_status', 'err');
			$this->session->set_flashdata('save_message', validation_errors());
			$this->session->set_flashdata('data', $this->input->post());
			
			redirect($this->agent->referrer());
		}
	}
	
	public function insert()
	{
		$data = $this->_form_data('insert');
		db_insert('instansi', $data);
		redirect(site_url('/pengaturan/instansi'));
	}

	public function hapus($id){
		$where = array('id' => $id);
		$data = array (
				'row_status' => $this->input->post('0'),
			);
		db_update('instansi', $data, array('id' => $id));
		redirect(site_url('/pengaturan/instansi'));
	}
	
	public function update()
	{
		$data = $this->_form_data('update');
		$id = $this->input->post('id');
		db_update('instansi', $data, array('id' => $id));
		redirect(site_url('/pengaturan/instansi'));
	}

}
