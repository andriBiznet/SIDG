<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Form extends MX_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
	}

	public function index()
	{
		$this->load->model('form_model');
		$id_form = $this->uri->segment(2);
		$tahun = $this->uri->segment(3);
		$id_form_str = str_pad($id_form, 3, '0', STR_PAD_LEFT);
		// echo $id_form_str;exit();
		
		if ($tahun == '') $tahun = date('Y') - 1;
		
		$this->db->where('row_status', 1);
		$this->db->where('id', $id_form);
		$src = $this->db->get('form');
		
		if ($src->num_rows() == 0) redirect(site_url('/dasbor'));
		$form = $src->row();
		
		if ($form->tipe == 'series') $data = $this->form_model->series($id_form);
		if ($form->tipe == 'matrix') $data = $this->form_model->matrix($id_form, $tahun);
		
		$toolbar = array();
		
		if ($form->tipe == 'matrix') {
			$toolbar = array (
				array(
					'url' => '#',
					'text' => '<i class="ti ti-plus"></i> Tambah Unit',
				),
			);
		}
		$join = 'unit_'.$id_form_str.' AS b';
		
		if ($form->tipe == 'series') {
			$dataa = $this->db
							->select('
								a.id
								, a.id_form
								, a.tahun
								, a.id_pengukuran
								, a.nilai_sebelumnya
								, a.nilai_baru
								, a.created_at
								, a.created_by
								, b.nama AS pengguna_grup
								, c.teks
							')
							->from('form_series_log AS a')
							->join('pengguna AS b', 'a.created_by = b.id')
							->join('pengukuran AS c', 'a.id_pengukuran = c.id')
							->where('a.id_form', $id_form)
							->order_by('id DESC')
							->get();
		}else{
			$dataa = $this->db
						->select('
							`a`.`id`,
							`a`.`id_form`,
							`a`.`tahun`,
							`a`.`id_unit`,
							`a`.`id_pengukuran`,
							`a`.`nilai_sebelumnya`,
							`a`.`nilai_baru`,
							`a`.`created_at`,
							`a`.`created_by`,
							`b`.`nama` AS `unit`,
							`d`.`teks` AS `nama_pengukuran`,
							`c`.`nama` AS `pengguna_grup` 
						')
						->from('form_matrix_log AS a')
						->join('pengguna AS c', 'a.created_by = c.id')
						->join('pengukuran AS d', 'a.id_pengukuran = d.id')
						->join($join, 'a.id_unit = b.id')
						->where('a.id_form', $id_form)
						->where('a.tahun', $tahun)
						->order_by('id DESC')
						->get();
		}

		// echo $this->db->last_query();exit();

		$metadata_matrix = $this->db
						->select('
							a.id
							, a.id_form
							, a.tahun
							, a.judul
							, a.sumber_data
							, a.keterangan
							, a.nama_kontak
							, a.no_hp_kontak
							, a.email_kontak
							, a.row_status
							, a.created_at
							, a.created_by
							, c.nama AS pengguna_grup
						')
						->from('form_metadata AS a')
						->where('a.row_status', 1)
						->where('tahun LIKE', $tahun)
						->where('a.id_form', $id_form)
						->join('pengguna AS c', 'a.created_by = c.id')
						->order_by('id')
						->get();
		// echo $this->db->last_query();exit();
						

		$metadata_series = $this->db
						->select('
							a.id
							, a.id_form
							, a.judul
							, a.sumber_data
							, a.keterangan
							, a.nama_kontak
							, a.no_hp_kontak
							, a.email_kontak
							, a.row_status
							, a.created_at
							, a.created_by
							, c.nama AS pengguna_grup
						')
						->from('form_metadata AS a')
						->where('a.row_status', 1)
						->where('a.id_form', $id_form)
						->join('pengguna AS c', 'a.created_by = c.id')
						->order_by('id')
						->get();

		// echo $this->db->last_query();exit();

		$forms = $this->db
						->from('form')
						->where('row_status', 1)
						->where('id_instansi', $form->id_instansi)
						->order_by('urutan')
						->get();
		
		
		$kode_instansi = $this->db->get_where('instansi', array('id' => $form->id_instansi))->row('kode');
		$this->load->view('templates/site_tpl', array (
			'id_form' => $id_form,
			'header' => $form->nama,
			'hforms' => $forms,
			'kode_instansi' => $kode_instansi,
			'toolbar' => $toolbar,
			'content' => 'form_index',
			'cols' => $this->form_model->cols($id_form),
			'tahun' => $tahun,
			'data' => $data,
			'dataa' => $dataa,
			'metadata_matrix' => $metadata_matrix,
			'metadata_series' => $metadata_series,
			'tipe' => $form->tipe,
		));
	}

	public function _form_tambah_data_matrix($id_form){
		$this->form_validation->set_rules('judul', 'Judul', 'required|trim');
		$this->form_validation->set_rules('sumber_data', 'Sumber Data', 'required|trim');

		$tahun = $this->uri->segment(5);
		if ($this->form_validation->run()) {
			$data = array (
				'id_form' => $id_form,
				'tahun' => $tahun,
				'judul' => $this->input->post('judul'),
				'sumber_data' => $this->input->post('sumber_data'),
				'keterangan' => $this->input->post('keterangan'),
				'nama_kontak' => $this->input->post('nama_kontak'),
				'no_hp_kontak' => $this->input->post('no_hp_kontak'),
				'email_kontak' => $this->input->post('email_kontak'),
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

	public function _form_tambah_data_series($id_form){
		$this->form_validation->set_rules('judul', 'Judul', 'required|trim');
		$this->form_validation->set_rules('sumber_data', 'Sumber Data', 'required|trim');
		// echo $id_form;exit();
		if ($this->form_validation->run()) {
			$data = array (
				'id_form' => $id_form,
				'judul' => $this->input->post('judul'),
				'sumber_data' => $this->input->post('sumber_data'),
				'keterangan' => $this->input->post('keterangan'),
				'nama_kontak' => $this->input->post('nama_kontak'),
				'no_hp_kontak' => $this->input->post('no_hp_kontak'),
				'email_kontak' => $this->input->post('email_kontak'),
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

	public function _form_ubah_data_matrix(){
		$this->form_validation->set_rules('judul', 'Judul', 'required|trim');
		$this->form_validation->set_rules('sumber_data', 'Sumber Data', 'required|trim');

		if ($this->form_validation->run()) {
			$data = array (
				'tahun' => $this->input->post('tahun'),
				'judul' => $this->input->post('judul'),
				'sumber_data' => $this->input->post('sumber_data'),
				'keterangan' => $this->input->post('keterangan'),
				'nama_kontak' => $this->input->post('nama_kontak'),
				'no_hp_kontak' => $this->input->post('no_hp_kontak'),
				'email_kontak' => $this->input->post('email_kontak'),
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

	public function _form_ubah_data_series(){
		$this->form_validation->set_rules('judul', 'Judul', 'required|trim');
		$this->form_validation->set_rules('sumber_data', 'Sumber Data', 'required|trim');

		if ($this->form_validation->run()) {
			$data = array (
				'judul' => $this->input->post('judul'),
				'sumber_data' => $this->input->post('sumber_data'),
				'keterangan' => $this->input->post('keterangan'),
				'nama_kontak' => $this->input->post('nama_kontak'),
				'no_hp_kontak' => $this->input->post('no_hp_kontak'),
				'email_kontak' => $this->input->post('email_kontak'),
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

	public function export_excel(){
		$this->_form_excel();
	}

	public function tambah_matrix($id_form){
		$data = $this->_form_tambah_data_matrix($id_form);
		// print_r($data);exit();
		db_insert('form_metadata', $data);
		// echo $this->db->last_query();exit();
		redirect(site_url('/form/'.$id_form));	
	}

	public function tambah_series($id_form){
		$data = $this->_form_tambah_data_series($id_form);
		// print_r($data);exit();
		db_insert('form_metadata', $data);
		redirect(site_url('/form/'.$id_form));	
	}

	public function ubah_matrix($id_form){
		$data = $this->_form_ubah_data_matrix();
		$id = $this->input->post('eid');
		// var_dump($data);exit();
		db_update('form_metadata', $data, array('id' => $id));
		redirect(site_url('/form/'.$id_form));
	}

	public function ubah_series($id_form){
		$data = $this->_form_ubah_data_series();
		$id = $this->input->post('eid');
		// var_dump($id);exit();
		db_update('form_metadata', $data, array('id' => $id));
		// echo $this->db->last_query();exit();
		redirect(site_url('/form/'.$id_form));
	}

	public function hapus($id_form, $id){
		$data = array (
				'row_status' => $this->input->post('0'),
			);
		// echo $id_form;exit();
		db_update('form_metadata', $data, array('id' => $id));
		redirect(site_url('/form/'.$id_form));
	}

}
