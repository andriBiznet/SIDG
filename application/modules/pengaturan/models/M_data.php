<?php 
 
class M_data extends CI_Model{
	function hapus_data($where,$table){
		$this->db->where($where);
		$this->db->delete($table);
	}
	public function tambah($data){
	    $this->db->insert('form_metadata', $data);
	    return TRUE;
	}
	
	public function menu_checklist($id)
	{
		$src =
			$this->db
					->select('a.id AS id, a.teks, a.id_induk, b.id_menu AS access')
					->from('menu AS a')
					->join("(SELECT * FROM pengguna_grup_menu WHERE id_pengguna_grup = '{$id}') AS b", 'a.id = b.id_menu', 'left')
					->where('a.row_status', '1')
					->order_by('id_induk, urutan')
					->get();
		// echo $this->db->last_query();exit();
		$menu = array();
		foreach ($src->result() as $row) {
			if ($row->id_induk == NULL) {
				$menu[$row->id] = array (
					'text' => $row->teks,
					'access' => $row->access,
				);
			}
			else {
				$menu[$row->id_induk]['sub_menu'][$row->id] = array (
					'text' => $row->teks,
					'access' => $row->access,
				);
			}
		}
		
		return $menu;
	}

	public function get()
	{
		$sql = "SELECT a.id, a.kode, a.nama, a.satuan, a.nilai_default, a.nilai, a.keterangan FROM energi_cf AS a";
		$src = $this->db->query($sql);
		
		$retval = array();
		
		foreach ($src->result() as $row) {
			$retval[$row->kode][$row->nama] = $row->nilai;
		}

		return $retval;
	}

}