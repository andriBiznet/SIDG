<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Matrix extends MX_Controller {

	public function save($id_form, $tahun)
	{
		$current = $this->input->post('current');
		$new = $this->input->post('new');
		
		$data = array();
		
		foreach ($new as $id_unit => $isi) {
			foreach ($isi as $id_pengukuran => $nilai) {
				
				$nilai_angka = str_to_num($nilai);
				
				$temp = array (
					'id_form' => $id_form,
					'tahun' => $tahun,
					'id_unit' => $id_unit,
					'id_pengukuran' => $id_pengukuran,
					'nilai' => $nilai_angka,
				);
				
				$temp_log = array (
					'id_form' => $id_form,
					'tahun' => $tahun,
					'id_unit' => $id_unit,
					'id_pengukuran' => $id_pengukuran,
					'nilai_sebelumnya' => $current[$id_unit][$id_pengukuran] === '' ? null : $current[$id_unit][$id_pengukuran],
					'nilai_baru' => $nilai_angka,
					'created_at' => date('Y-m-d H:i:s'),
					'created_by' => pengguna_session('id'),
				);
				
				$where = array (
					'id_form' => $id_form,
					'tahun' => $tahun,
					'id_unit' => $id_unit,
					'id_pengukuran' => $id_pengukuran,
				);
				
				# Insert data
				if ($nilai != $current[$id_unit][$id_pengukuran] && $current[$id_unit][$id_pengukuran] === '') {
					
					$temp['created_at'] = date('Y-m-d H:i:s');
					$temp['created_by'] = pengguna_session('id');
					
					$data[] = $temp;
					$log[] = $temp_log;
				}
				
				# Update data
				if ($nilai != $current[$id_unit][$id_pengukuran] && $nilai !== '' && $current[$id_unit][$id_pengukuran] !== '') {
					
					$temp['updated_at'] = date('Y-m-d H:i:s');
					$temp['updated_by'] = pengguna_session('id');
					
					db_update('form_matrix', $temp, $where);
					$log[] = $temp_log;
				}
				
				# Delete data
				if ($nilai === '' && $current[$id_unit][$id_pengukuran] !== '') {
					
					$this->db->delete('form_matrix', $where);
					$log[] = $temp_log;
				}
			}
		}
		
		if (count($data) != 0)
			$this->db->insert_batch('form_matrix', $data);
		
		if (count($log) != 0)
			$this->db->insert_batch('form_matrix_log', $log);
		
		redirect($this->agent->referrer());
	}

}
