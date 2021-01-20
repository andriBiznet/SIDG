<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Options extends MX_Controller {

	public function instansi($selected = '')
	{
		$src = $this->db
						->from('instansi')
						->where('row_status', 1)
						->order_by('nama')
						->get();
		return options($src, 'id', $selected, 'nama');
	}
	
	public function pengguna_grup($selected = '')
	{
		$src = $this->db
						->from('pengguna_grup')
						->where('row_status', 1)
						->order_by('urutan')
						->get();
		return options($src, 'id', $selected, 'nama');
	}
	
	public function sektor($selected = '')
	{
		$src = $this->db
						->from('worksheet')
						->where('row_status', 1)
						->order_by('urutan')
						->get();
		return options($src, 'id', $selected, 'nama');
	}

}
