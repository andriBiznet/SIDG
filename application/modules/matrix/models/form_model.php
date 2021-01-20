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
	
	public function series($id_form)
	{
		$tahun_sekarang = date('Y');
		
		$sql = "
			SELECT
				c.tahun
				, a.id AS id_pengukuran
				, a.urutan
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
				ON a.id = b.id_pengukuran
			ORDER BY
				c.tahun DESC
				, a.urutan
		";
		$src = $this->db->query($sql);
		
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
				ON b.id = c.id_pengukuran
			ORDER BY
				a.id
				, b.urutan
		";
		$src = $this->db->query($sql);
		
		$data = array();
		foreach ($src->result() as $row) {
			$data[$row->unit][$row->id_pengukuran] = array (
				'id_unit' => $row->id_unit,
				'nilai' => $row->nilai,
			);
		}
		
		return $data;
	}
	
}
/* End of file form_model.php */
/* Location: ./application/modules/form/models/form_model.php */