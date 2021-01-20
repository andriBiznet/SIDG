<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Site extends MX_Controller {

	public function index()
	{
		$this->load->view('templates/login_tpl');
	}
	
	public function login()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		
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
						->where('a.row_status', 1)
						->where('a.username', $username)
						->where('a.password', sigd_password($password))
						->get();
		
		if ($src->num_rows() > 0) {
			$pengguna = $src->row();
			$this->session->set_userdata('pengguna', $pengguna);
			redirect(site_url('/dasbor'));
		}
		else {
			$this->session->set_flashdata('login_status', 'err');
			redirect(site_url());
		}
	}
	
	private function _form_password($action = 'insert', $id = '')
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
				
				if ($src->num_rows() == 0) redirect(site_url('/dasbor'));
				else $data = $src->row();
			}
		}
		
		$this->load->view('templates/site_tpl', array (
			'header' => 'Ubah Password',
			'toolbar' => array (
				array (
					'url' => site_url('/site'),
					'text' => 'Kembali',
				),
			),
			'content' => 'site_password',
			'action' => site_url('/site/'.$action),
			'data' => $data,
		));
	}

	public function password()
	{
		$id = pengguna_session('id');
		$this->_form_password('update', $id);
	}

	private function _form_data_password($action)
	{
		$this->form_validation->set_rules('new_password', 'Password Baru', 'required|trim');
		$this->form_validation->set_rules('old_password', 'Password lama', 'required|trim');

		if ($this->form_validation->run()) {
			if ($action == 'insert' || ($action == 'update' && $this->input->post('new_password') && $this->input->post('old_password') != '')) {
				$data['password'] = sigd_password($this->input->post('new_password'));
			}
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

	public function update()
	{
		$data = $this->_form_data_password('update');
		$id = pengguna_session('id');
		$this->db->where('id', $id);
		$src = $this->db->get('pengguna')->row();
		$pass = $src->password;
		$dataa['old_password'] = sigd_password($this->input->post('old_password'));

		if ($dataa['old_password'] == $pass) {
			$id = pengguna_session('id');
			db_update('pengguna', $data, array('id' => $id));
		    echo '<script>
		        var yakin = confirm("Data sudah terupdate!");
		        window.location = "'.site_url('site/password').'";
		    </script>';
			// redirect(site_url('/site/password'));	
		}else{
		    echo '<script>
		        var yakin = confirm("Maaf Password lama yang anda masukan salah, Silahkan masukan kembali password lama anda!");
		        window.location = "'.site_url('site/password').'";
		    </script>';
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('pengguna');
		$this->session->sess_destroy();
		redirect(site_url());
	}

}
