<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengguna_grup extends MX_Controller {

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
							, a.urutan
							, a.row_status
							, b.nama As pengguna_grup
							, a.created_by 
						')
						->from('pengguna_grup AS a')
						->join('pengguna AS b', 'a.created_by = b.id AND b.row_status = 1')
						->where('a.row_status', 1)
						->order_by('id')
						->get();
		
		$this->load->view('templates/site_tpl', array (
			'header' => 'Pengaturan Pengguna Grup',
			'toolbar' => array (
				array (
					'url' => site_url('/pengaturan/pengguna_grup/tambah'),
					'text' => 'Tambah',
				),
			),
			'content' => 'pengguna_grup_index',
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
				$src = $this->db->get('pengguna_grup');
				
				if ($src->num_rows() == 0) redirect(site_url('/pengaturan/pengguna_grup'));
				else $data = $src->row();
			}
		}
		
		$this->load->view('templates/site_tpl', array (
			'header' => 'Form Pengguna Grup',
			'toolbar' => array (
				array (
					'url' => site_url('/pengaturan/pengguna_grup'),
					'text' => 'Kembali',
				),
			),
			'content' => 'pengguna_grup_form',
			'action' => site_url('/pengaturan/pengguna_grup/'.$action),
			'action_menu' => site_url('/pengaturan/pengguna_grup/update_menu/'.$id),
			'data' => $data,
			'redirect' => $this->agent->referrer(),
			'menu' => $this->m_data->menu_checklist($id),
		));
	}

	private function _form_hak_akses($action = 'insert', $id = '')
	{
		$data = null;
		
		if ($this->session->flashdata('data')) {
			$data = (object) $this->session->flashdata('data');
		}
		else {
			if ($action == 'update') {
				$this->db->where('row_status', 1);
				$this->db->where('id', $id);
				$src = $this->db->get('pengguna_grup');
				
				if ($src->num_rows() == 0) redirect(site_url('/pengaturan/pengguna_grup'));
				else $data = $src->row();
			}
		}
		
		$this->load->view('templates/site_tpl', array (
			'header' => 'Form Hak Akses Menu',
			'toolbar' => array (
				array (
					'url' => site_url('/pengaturan/pengguna_grup'),
					'text' => 'Kembali',
				),
			),
			'content' => 'pengguna_grup_hak_akses_menu_form',
			'action_menu' => site_url('/pengaturan/pengguna_grup/update_menu/'.$id),
			'data' => $data,
			'redirect' => $this->agent->referrer(),
			'menu' => $this->m_data->menu_checklist($id),
		));
	}
	
	public function update_menu($id)
	{
		$parent_id_arr = $this->input->post('id_induk');
		$access_arr = $this->input->post('access');
		
		$data = array();
		$parent_id_insert = array();
		
		foreach ($access_arr as $i => $access) {
			$data[] = array (
				'id_pengguna_grup' => $id,
				'id_menu' => $i,
			);
			
			if (array_key_exists($i, $parent_id_arr)) {
				$parent_id_insert[$parent_id_arr[$i]] = 1;
			}
		}
		
		foreach ($parent_id_insert as $i => $val) {
			$data[] = array (
				'id_pengguna_grup' => $id,
				'id_menu' => $i,
			);
		}
		// var_dump($data);exit();
		
		$this->db->delete('pengguna_grup_menu', array('id_pengguna_grup' => $id));
		$this->db->insert_batch('pengguna_grup_menu', $data);
		redirect(site_url('/pengaturan/pengguna_grup'));
	}

	public function tambah()
	{
		$this->_form();
	}
	
	public function ubah_data($id)
	{
		$this->_form('update', $id);
	}
	
	public function ubah_hak_akses($id)
	{
		$this->_form_hak_akses('update', $id);
	}
	
	private function _form_data($action)
	{
		$this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim');
		$this->form_validation->set_rules('urutan', 'Username', 'required|trim');
		
		if ($this->form_validation->run()) {
			$data = array (
				'nama' => $this->input->post('nama'),
				'urutan' => $this->input->post('urutan'),
				'row_status' => '1',
			);
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
		db_insert('pengguna_grup', $data);
		redirect(site_url('/pengaturan/pengguna_grup'));
	}

	public function hapus($id){
		$where = array('id' => $id);
		$data = array (
				'row_status' => $this->input->post('0'),
			);
		db_update('pengguna_grup', $data, array('id' => $id));
		redirect(site_url('/pengaturan/pengguna_grup'));
	}
	
	public function update()
	{
		$data = $this->_form_data('update');
		$id = $this->input->post('id');
		db_update('pengguna_grup', $data, array('id' => $id));
		redirect(site_url('/pengaturan/pengguna_grup'));
	}

}
