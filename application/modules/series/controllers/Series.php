<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Series extends MX_Controller {

	public function save($id_form)
	{
		$current = $this->input->post('current');
		$new = $this->input->post('new');
		
		$data = array();
		
		foreach ($new as $tahun => $isi) {
			foreach ($isi as $id_pengukuran => $nilai) {
				
				$nilai_angka = str_to_num($nilai);
				
				$temp = array (
					'id_form' => $id_form,
					'tahun' => $tahun,
					'id_pengukuran' => $id_pengukuran,
					'nilai' => $nilai_angka,
				);
				
				$temp_log = array (
					'id_form' => $id_form,
					'tahun' => $tahun,
					'id_pengukuran' => $id_pengukuran,
					'nilai_sebelumnya' => $current[$tahun][$id_pengukuran] === '' ? null : $current[$tahun][$id_pengukuran],
					'nilai_baru' => $nilai_angka,
					'created_at' => date('Y-m-d H:i:s'),
					'created_by' => pengguna_session('id'),
				);
				
				$where = array (
					'id_form' => $id_form,
					'tahun' => $tahun,
					'id_pengukuran' => $id_pengukuran,
				);
				
				# Insert data
				if ($nilai != $current[$tahun][$id_pengukuran] && $current[$tahun][$id_pengukuran] === '') {
					
					$temp['created_at'] = date('Y-m-d H:i:s');
					$temp['created_by'] = pengguna_session('id');
					
					$data[] = $temp;
					$log[] = $temp_log;
				}
				
				# Update data
				if ($nilai != $current[$tahun][$id_pengukuran] && $nilai !== '' && $current[$tahun][$id_pengukuran] !== '') {
					
					$temp['updated_at'] = date('Y-m-d H:i:s');
					$temp['updated_by'] = pengguna_session('id');
					
					db_update('form_series', $temp, $where);
					$log[] = $temp_log;
				}
				
				# Delete data
				if ($nilai === '' && $current[$tahun][$id_pengukuran] !== '') {
					
					$this->db->delete('form_series', $where);
					$log[] = $temp_log;
				}
			}
		}
		
		if (count($data) != 0)
			$this->db->insert_batch('form_series', $data);
		
		if (count($log) != 0)
			$this->db->insert_batch('form_series_log', $log);
		
		redirect($this->agent->referrer());
	}

}
