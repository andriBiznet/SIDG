<?php

require_once('PHPExcel/PHPExcel.php');

function series_import($id_form, $file, $start_col, $start_row)
{
	# deklarasi variabel
	$ci =& get_instance();
	
	$reader = PHPExcel_IOFactory::createReaderForFile($file);
	$xls = $reader->load($file);
	$ws = $xls->getSheet(0);
	
	$last_col = $ws->getHighestColumn();
	$last_row = $ws->getHighestRow();
	
	$pengukuran = array();
	$current = array();
	$temp = array();
	$data = array();
	$log = array();
	
	# ambil data pengukuran
	$ci->db->where('row_status', 1);
	$ci->db->where('id_form', $id_form);
	$src = $ci->db->order_by('urutan')->get('pengukuran');
	
	foreach ($src->result() as $row) {
		$pengukuran[] = $row->id;
	}
	
	# ambil data dari database
	$ci->db->where('id_form', $id_form);
	$src = $ci->db->get('form_series');
	
	foreach ($src->result() as $row) {
		$current[$row->tahun][$row->id_pengukuran] = $row->nilai;
	}
	
	# ambil data dari excel
	$tahun = null;
	$idx_pengukuran = 0;
	
	for ($row = $start_row; $row <= $last_row; $row++) {
		for ($col = $start_col; $col <= $last_col; $col++) {
			
			if ($col == $start_col) {
				$tahun = $ws->getCell($col.$row)->getValue();
				$idx_pengukuran = 0;
			}
			else {
				$id_pengukuran = $pengukuran[$idx_pengukuran];
				$nilai_sekarang = isset($current[$tahun][$id_pengukuran]) ? $current[$tahun][$id_pengukuran] : null;
				$nilai = $ws->getCell($col.$row)->getValue();
				$created_at = date('Y-m-d H:i:s');
				
				$data_row = array (
					'id_form' => $id_form,
					'tahun' => $tahun,
					'id_pengukuran' => $id_pengukuran,
					'nilai' => $nilai,
				);
				
				$log_row = array (
					'id_form' => $id_form,
					'tahun' => $tahun,
					'id_pengukuran' => $id_pengukuran,
					'nilai_sebelumnya' => $nilai_sekarang,
					'nilai_baru' => $nilai,
					'created_at' => $created_at,
					'created_by' => 1,
				);
				
				$where = array (
					'id_form' => $id_form,
					'tahun' => $tahun,
					'id_pengukuran' => $id_pengukuran,
				);
				
				# insert
				if ( ! isset($current[$tahun][$id_pengukuran]) && $nilai !== null) {
					$data_row['created_at'] = $created_at;
					$data_row['created_by'] = 1;
					
					$data[] = $data_row;
					$log[] = $log_row;
				}
				
				# update
				else if (($nilai !== null || $nilai === 0) && $nilai != $nilai_sekarang) {
					$data_row['updated_at'] = $created_at;
					$data_row['updated_by'] = 1;
					
					$ci->db->update('form_series', $data_row, $where);
					$log[] = $log_row;
				}
				
				# hapus
				else if ($nilai === null && $nilai !== 0 && $nilai_sekarang !== null) {
					$ci->db->delete('form_series', $where);
					$log[] = $log_row;
				}
				
				$idx_pengukuran++;
			}
		}
	}
	
	if (count($data) != 0)
		$ci->db->insert_batch('form_series', $data);
			
	if (count($log) != 0)
		$ci->db->insert_batch('form_series_log', $log);
}

function matrix_import($id_form, $tahun, $file, $start_col, $start_row)
{
	# deklarasi variabel
	$ci =& get_instance();
	
	$kode_form = str_pad($id_form, 3, '0', STR_PAD_LEFT);
	
	$reader = PHPExcel_IOFactory::createReaderForFile($file);
	$xls = $reader->load($file);
	$ws = $xls->getSheet(0);
	
	$last_col = $ws->getHighestColumn();
	$last_row = $ws->getHighestRow();
	
	$unit = array();
	$pengukuran = array();
	$current = array();
	$temp = array();
	$data = array();
	$log = array();
	
	# ambil data unit
	$ci->db->where('row_status', 1);
	$src = $ci->db->order_by('id')->get('unit_'.$kode_form);
	
	foreach ($src->result() as $row) {
		$unit[] = $row->id;
	}
	
	# ambil data pengukuran
	$ci->db->where('row_status', 1);
	$ci->db->where('id_form', $id_form);
	$src = $ci->db->order_by('urutan')->get('pengukuran');
	
	foreach ($src->result() as $row) {
		$pengukuran[] = $row->id;
	}
	
	# ambil data dari database
	$ci->db->where('id_form', $id_form);
	$src = $ci->db->get('form_matrix');
	
	foreach ($src->result() as $row) {
		$current[$row->tahun][$row->id_unit][$row->id_pengukuran] = $row->nilai;
	}
	
	# ambil data dari excel
	$idx_unit = 0;
	
	for ($row = $start_row; $row <= $last_row; $row++) {
		
		$idx_pengukuran = 0;
		
		for ($col = $start_col; $col <= $last_col; $col++) {
			
			if ($col == $start_col) $col++;
			
			$id_unit = $unit[$idx_unit];
			$id_pengukuran = $pengukuran[$idx_pengukuran];
			$nilai_sekarang = isset($current[$tahun][$id_unit][$id_pengukuran]) ? $current[$tahun][$id_unit][$id_pengukuran] : null;
			$nilai = $ws->getCell($col.$row)->getValue();
			$created_at = date('Y-m-d H:i:s');
			
			$data_row = array (
				'id_form' => $id_form,
				'tahun' => $tahun,
				'id_unit' => $id_unit,
				'id_pengukuran' => $id_pengukuran,
				'nilai' => $nilai,
			);
			
			$log_row = array (
				'id_form' => $id_form,
				'tahun' => $tahun,
				'id_unit' => $id_unit,
				'id_pengukuran' => $id_pengukuran,
				'nilai_sebelumnya' => $nilai_sekarang,
				'nilai_baru' => $nilai,
				'created_at' => $created_at,
				'created_by' => 1,
			);
			
			$where = array (
				'id_form' => $id_form,
				'tahun' => $tahun,
				'id_unit' => $id_unit,
				'id_pengukuran' => $id_pengukuran,
			);
			
			# insert
			if ( ! isset($current[$tahun][$id_unit][$id_pengukuran]) && $nilai !== null) {
				$data_row['created_at'] = $created_at;
				$data_row['created_by'] = 1;
				
				$data[] = $data_row;
				$log[] = $log_row;
			}
			
			# update
			else if (($nilai !== null || $nilai === 0) && $nilai != $nilai_sekarang) {
				$data_row['updated_at'] = $created_at;
				$data_row['updated_by'] = 1;
				
				$ci->db->update('form_matrix', $data_row, $where);
				$log[] = $log_row;
			}
			
			# hapus
			else if ($nilai === null && $nilai !== 0 && $nilai_sekarang !== null) {
				$ci->db->delete('form_matrix', $where);
				$log[] = $log_row;
			}
			
			$idx_pengukuran++;
		}
		
		$idx_unit++;
	}
	
	if (count($data) != 0)
		$ci->db->insert_batch('form_matrix', $data);
			
	if (count($log) != 0)
		$ci->db->insert_batch('form_matrix_log', $log);
}
