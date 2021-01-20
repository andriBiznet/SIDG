<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Form_model extends CI_Model {
	
	public function cols($id_form)
	{
		$src = $this->db
						->from('pengukuran')
						->where('row_status', 1)
						->where('id_form', $id_form)
						->order_by('urutan')
						->get();
		return $src;
	}

	public function menu($id_form)
	{
		
		$sql = "
			SELECT
				a.id
				, a.teks
				, a.id_form
				, a.kode_satuan
			FROM 
				pengukuran AS a
			WHERE
				id_form = {$id_form}
		";
		$src = $this->db->query($sql);
		// echo $this->db->last_query();exit();

		return $src;
	}

	public function series($id_form)
	{
		$tahun_sekarang = date('Y');
		
		$sql = "
			SELECT
				c.tahun
				, a.id AS id_pengukuran
				, a.urutan
				, a.kode
				, b.nilai
			FROM (
				SELECT *
				FROM pengukuran
				WHERE
					row_status = 1
					AND id_form = '{$id_form}'
			) AS a
			JOIN (
				SELECT *
				FROM tahun
				WHERE tahun BETWEEN '2010' AND '{$tahun_sekarang}'
			) AS c
			LEFT JOIN (
				SELECT *
				FROM form_series
				WHERE
					id_form = '{$id_form}'
					AND tahun BETWEEN '2010' AND '{$tahun_sekarang}'
			) AS b
				ON
					c.tahun = b.tahun
					AND a.id = b.id_pengukuran
			ORDER BY
				c.tahun DESC
				, a.urutan
		";
		$src = $this->db->query($sql);
		// echo $this->db->last_query();exit();
		
		$data = array();
		foreach ($src->result() as $row) {
			$data[$row->tahun][$row->id_pengukuran] = $row->nilai;
		}
		
		return $data;
	}
	
	public function matrix($id_form, $tahun)
	{
		$id_form_str = str_pad($id_form, 3, '0', STR_PAD_LEFT);
		
		$sql = "
			SELECT
				a.id AS id_unit
				, a.nama AS unit
				, b.id AS id_pengukuran
				, c.nilai
			FROM (
				SELECT *
				FROM unit_{$id_form_str}
				WHERE row_status = 1
			) AS a
			JOIN (
				SELECT *
				FROM pengukuran
				WHERE
					row_status = 1
					AND id_form = '{$id_form}'
			) AS b
			LEFT JOIN (
				SELECT *
				FROM form_matrix
				WHERE
					id_form = '{$id_form}'
					AND tahun = '{$tahun}'
			) AS c
				ON
					a.id = c.id_unit
					AND b.id = c.id_pengukuran
			ORDER BY
				a.id
				, b.urutan
		";
		$src = $this->db->query($sql);
		// echo $this->db->last_query();exit();
		
		$data = array();
		foreach ($src->result() as $row) {
			$data[$row->unit][$row->id_pengukuran] = array (
				'id_unit' => $row->id_unit,
				'nilai' => $row->nilai,
			);
		}
		
		return $data;
	}

	public function tambah($data){
	    $this->db->insert('form_metadata', $data);
	    return TRUE;
	}

}
/* End of file form_model.php */
/* Location: ./application/modules/form/models/form_model.php */