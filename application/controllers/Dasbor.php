<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dasbor extends MX_Controller {

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
						->get()->row();

		$this->load->view('templates/site_tpl', array (
			'header' => 'Dasbor SIGD',
			'content' => 'dasbor_index',
			'data' => $data,
		));
	}

}
