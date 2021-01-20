<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Site_profile extends MX_Controller {

	private function _form_profile($action = 'insert', $id = '')
	{
		$data = null;
		$data = $this->db
						->select('
							a.id
							, a.nama
							, a.username
							, a.id_pengguna_grup
							, b.nama AS pengguna_grup
							, a.id_instansi
							, c.nama AS instansi
						')
						->from('pengguna AS a')
						->join('pengguna_grup AS b', 'a.id_pengguna_grup = b.id AND b.row_status = 1')
						->join('instansi AS c', 'a.id_instansi = c.id AND c.row_status = 1')
						->where('a.row_status', 1)
						->get();
		
		if ($this->session->flashdata('data')) {
			$data = (object) $this->session->flashdata('data');
		}
		else {
			if ($action == 'update') {
				$this->db->where('row_status', 1);
				$this->db->where('id', $id);
				$src = $this->db->get('pengguna');
				
				if ($src->num_rows() == 0) redirect(site_url('/site_profile/profile'));
				else $data = $src->row();
			}
		}
		
		$this->load->view('templates/site_tpl_profile', array (
			'header' => 'Form Pengguna',
			'toolbar' => array (
				array (
					'url' => site_url('/site_profile'),
					'text' => 'Kembali',
				),
			),
			'content' => 'profile',
			'action' => site_url('/Site_profile/'.$action),
			'data' => $data,
		));
	}

	private function _form_data_profile($action)
	{
		$this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim');
		$this->form_validation->set_rules('username', 'Username', 'required|trim');
		// $this->form_validation->set_rules('id_instansi', 'Instansi', 'required');
		
		if ($this->form_validation->run()) {
			$data = array (
				'nama' => $this->input->post('nama'),
				'username' => $this->input->post('username'),
				// 'id_instansi' => $this->input->post('id_instansi'),
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
		$data = $this->_form_data_profile('update');
		$id = $this->input->post('id');
		$pengguna = $this->input->post('nama');
		// print_r($pengguna);exit();
		db_update('pengguna', $data, array('id' => $id));
		// echo $this->db->last_query();exit();
		redirect(site_url('/site_profile/profile'));
	}

	public function profile()
	{
		$id = pengguna_session('id');
		$src = $this->db
						->select('
							a.id
							, a.nama
							, a.username
							, a.id_pengguna_grup
							, b.nama AS pengguna_grup
							, a.id_instansi
							, c.nama AS instansi
						')
						->from('pengguna AS a')
						->join('pengguna_grup AS b', 'a.id_pengguna_grup = b.id AND b.row_status = 1')
						->join('instansi AS c', 'a.id_instansi = c.id AND c.row_status = 1')
						->get();
		
		if ($src->num_rows() > 0) {
			$pengguna = $src->row();
			$this->session->set_userdata('pengguna', $pengguna);
		}
		$this->_form_profile('update', $id,$pengguna);
	}

}