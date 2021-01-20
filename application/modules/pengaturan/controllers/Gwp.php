<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gwp extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('m_data');
		$this->load->helper('url');
	}

	public function index()
	{
		$id = pengguna_session('id');
		$this->_form('update', $id);
	}
	
	private function _form($action = 'insert', $id = '')
	{
		$data = null;
		if ($action == 'update') {
			$this->db->where('row_status', 1);
			$this->db->where('id', $id);
			$src = $this->db->get('gwp');
			
			if ($src->num_rows() == 0) redirect(site_url('/pengaturan/gwp'));
			else $data = $src->row();
		}
		
		$this->load->view('templates/site_tpl', array (
			'header' => 'Nilai GWP',
			'content' => 'gwp_form',
			'action' => site_url('/pengaturan/gwp/'.$action),
			'data' => $data,
		));
	}
	
	public function ubah($id)
	{
		$this->_form('update', $id);
	}
	
	private function _form_data($action)
	{
		$this->form_validation->set_rules('ch4', 'CH4 Equivalent', 'required|trim');
		$this->form_validation->set_rules('n2o', 'N2O Equivalent', 'required|trim');
		
		if ($this->form_validation->run()) {
			$data = array (
				'ch4' => $this->input->post('ch4'),
				'n2o' => $this->input->post('n2o'),
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
	
	public function update()
	{
		$data = $this->_form_data('update');
		$id = $this->input->post('id');
		db_update('gwp', $data, array('id' => $id));
		redirect(site_url('/pengaturan/gwp'));
	}

}
