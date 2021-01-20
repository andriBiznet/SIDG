<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengguna extends MX_Controller {

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
							, a.username
							, a.id_instansi
							, b.nama AS instansi
							, a.id_pengguna_grup
							, c.nama AS pengguna_grup
						')
						->from('pengguna AS a')
						->join('instansi AS b', 'a.id_instansi = b.id AND b.row_status = 1')
						->join('pengguna_grup AS c', 'a.id_pengguna_grup = c.id AND c.row_status = 1')
						->where('a.row_status', 1)
						->order_by('id')
						->get();
		
		$this->load->view('templates/site_tpl', array (
			'header' => 'Pengaturan Pengguna',
			'toolbar' => array (
				array (
					'url' => site_url('/pengaturan/pengguna/tambah'),
					'text' => 'Tambah',
				),
			),
			'content' => 'pengguna_index',
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
				$src = $this->db->get('pengguna');
				
				if ($src->num_rows() == 0) redirect(site_url('/pengaturan/pengguna'));
				else $data = $src->row();
			}
		}
		
		$this->load->view('templates/site_tpl', array (
			'header' => 'Form Pengguna',
			'toolbar' => array (
				array (
					'url' => site_url('/pengaturan/pengguna'),
					'text' => 'Kembali',
				),
			),
			'content' => 'pengguna_form',
			'action' => site_url('/pengaturan/pengguna/'.$action),
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
		$this->form_validation->set_rules('username', 'Username', 'required|trim');
		$this->form_validation->set_rules('id_instansi', 'Instansi', 'required');
		$this->form_validation->set_rules('id_pengguna_grup', 'Grup Pengguna', 'required');
		
		if ($action == 'insert'):
		$this->form_validation->set_rules('password', 'Password', 'required|trim');
		endif;
		
		if ($this->form_validation->run()) {
			$data = array (
				'nama' => $this->input->post('nama'),
				'username' => $this->input->post('username'),
				'id_instansi' => $this->input->post('id_instansi'),
				'id_pengguna_grup' => $this->input->post('id_pengguna_grup'),
			);
			
			if ($action == 'insert' || ($action == 'update' && $this->input->post('password') != '')) {
				$data['password'] = sigd_password($this->input->post('password'));
			}
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
		// print_r($data);exit();
		db_insert('pengguna', $data);
		redirect(site_url('/pengaturan/pengguna'));
	}

	public function hapus($id){
		$where = array('id' => $id);
		$data = array (
				'row_status' => $this->input->post('0'),
			);
		db_update('pengguna', $data, array('id' => $id));
		redirect(site_url('/pengaturan/pengguna'));
	}
	
	public function update()
	{
		$data = $this->_form_data('update');
		$id = $this->input->post('id');
		db_update('pengguna', $data, array('id' => $id));
		redirect(site_url('/pengaturan/pengguna'));
	}

}
