<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Parameter extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('parameter_model');
		$this->load->helper('url');
	}

	public function index($action="update")
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
			'header' 	=> 'Pengaturan Parameter Inventarisasi GRK (Energi)',
			'content' 	=> 'parameter_index',
			'action' 	=> site_url('/pengaturan/parameter/'.$action),
		));
	}

	public function get_sektor()
	{
		$sektor = $this->input->post('sektor');
		// $klub = $this->klub[$sektor];
        $worksheet = $this->db
						->select('*')
						->from('worksheet AS a')
						->where('a.sektor', $sektor)
						->get()->result();
		// echo $this->db->last_query();exit();
		
		header('Content-Type: application/json');
		echo json_encode($worksheet);
	}
	
	public function get_worksheet()
	{
		$worksheet = $this->input->post('worksheet');
		// $pemain = isset($this->pemain[$worksheet]) ? $this->pemain[$worksheet] : array();
        $pemain = $this->db
						->select('*')
						->from('worksheet_ef AS a')
						->where('a.id_worksheet', $worksheet)
						->get()->result();
		
		header('Content-Type: application/json');
		echo json_encode($pemain);
	}

	public function update()
	{
		$nilai = $this->input->post('nilai');
		$ket = $this->input->post('keterangan');
		$id = $this->input->post('id');

		// print_r($ket);exit();
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
			$update = $this->db->update('worksheet_ef');
			// echo $this->db->last_query();exit();
		}
		if ($update) {
			redirect(site_url('/pengaturan/parameter/'));
		}else{
			redirect(site_url('/dasbor'));
		}
	}

}
