<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Parameter_model extends CI_Model{

   public function v_data($worksheet){
		$data = $this->db
						->from('worksheet AS a')
						->where('a.sektor', $worksheet)
						->get();
		return $data;
   }

   public function view_data($id){
		$data = $this->db
						->from('worksheet AS a')
						->join('worksheet_ef AS b', 'a.id = b.id_worksheet')
						->where('b.id_worksheet', $id)
						->get();
		return $data;
   }

}
?>
