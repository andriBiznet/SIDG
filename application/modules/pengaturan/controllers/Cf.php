<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cf extends MX_Controller {

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
			$data = $this->db
							->select('
								a.id
								, a.kode
								, a.nama
								, a.satuan
								, a.nilai_default
								, a.nilai
								, a.keterangan
							')
							->from('energi_cf AS a')
							->where('a.row_status', 1)
							->order_by('id')
							->get();
		}
		
		$this->load->view('templates/site_tpl', array (
			'header' => 'Conversion Factor Bahan Bakar',
			'content' => 'energi_cf_form',
			'action' => site_url('/pengaturan/cf/'.$action),
			'data' => $data,
		));
	}
	
	public function ubah($id)
	{
		$this->_form('update', $id);
	}
	
	public function update()
	{
		$nilai = $this->input->post('nilai');
		$ket = $this->input->post('keterangan');
		$id = $this->input->post('id');
		for ($i=0; $i < count($nilai); $i++) { 
			$data = array(
				'nilai'=>$nilai[$i],
				'keterangan'=>$ket[$i],
			);
			$where = array(
				'id'=>$id[$i]
			);
			$this->db->set($data);
			$this->db->where($where);
			$update = $this->db->update('energi_cf');
		}
			// echo $this->db->last_query();exit();
		if ($update) {
			redirect(site_url('/pengaturan/cf'));
		}else{
			redirect(site_url('/dasbor'));
		}
	}

}
//Mana ?
