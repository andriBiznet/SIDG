<?php

function ci()
{
	$ci =& get_instance();
	return $ci;
}

function sigd_password($raw_password)
{
	return md5('sigd-'.$raw_password.'-135$#');
}

function pengguna_session($key)
{
	$ci = ci();
	return $ci->session->userdata('pengguna')->$key;
}

function initial($str)
{
	$words = explode(' ', $str);
	$retval = '';
	foreach ($words as $word) $retval .= $word[0];
	return $retval;
}

function get_menu($id_pengguna_grup)
{
    $ci = ci(); 

    $id_pengguna_grup = pengguna_session('id_pengguna_grup');

    //get menu
    $join  = [
    			['table' => 'menu b', 'on' => 'a.role_menu = b.id AND b.row_status = 1', 'join' => 'INNER'],
    			['table' => 'menu c', 'on' => 'b.id_induk = b.id AND c.row_status = 1', 'join' => 'LEFT']
			];
    $arr_role = $ci->m_global->getDataAll('m_role AS a',$join, NULL, 'role_menu,b.teks,b.id_induk,b.uri', 'id_pengguna_grup IN('.$id_pengguna_grup.')');
    // echo $ci->db->last_query();exit; 
    $arr_no   = [];
    foreach ($arr_role as $row) {
        $pecah = explode(',',$row->role_menu);
        $arr_no = array_merge($arr_no,$pecah);
    }
    $arr_menu = array_unique($arr_no);
    $arr_menu = implode(',', $arr_menu);
    $where_e = "id IN(".$arr_menu.")";

    $tmp = $ci->m_global->getDataAll('menu', NULL, NULL, 'id,teks,uri,id_induk', $where_e, NULL);
    // echo $ci->db->last_query();exit; 

    $menu = [];
    foreach($tmp as $row){
    	if ($row->id_induk == null) {
    		$menu[$row->teks] = array(
				'uri' => $row->uri,
				'teks' => $row->teks,
				'sub_menu' => array(),
			);
    	}else{
			$menu[$row->id_induk]['sub_menuu'][] = array (
				'teks' => $row->teks,
				'uri' => $row->uri,
			);
		}
    }

    return $menu;
}

function get_menu_rekursif($row, $idmenu, $where_e)
{
    $ci = ci(); 

    $tmp = $ci->m_global->getDataAll('menu', NULL, NULL, 'id, teks, uri, id_induk', $where_e, NULL);
    // echo $ci->db->last_query();exit; 

    if(!empty($tmp)){
        $row->sub = $tmp;
    }

    return $row;

}

function menu($id_pengguna_grup)
{
	$ci = ci();
	// echo $id_pengguna_grup;exit();
	
	$src = $ci->db
				->select('
					b.teks
					, b.uri
					, b.urutan
					, b.id_induk
					, c.teks AS menu_induk
				')
				->from('pengguna_grup_menu AS a')
				->join('menu AS b', 'a.id_menu = b.id AND b.row_status = 1')
				->join('menu AS c', 'b.id_induk = c.id AND c.row_status = 1', 'left')
				->where('a.id_pengguna_grup', $id_pengguna_grup)
				->order_by('b.urutan')
				->get();
	// echo $ci->db->last_query($src);exit();

	$menu = array();
	foreach ($src->result() as $row) {
		if ($row->menu_induk == null) {
			$menu[$row->teks] = array (
				'uri' => $row->uri,
				'sub_menu' => array(),
			);
		}
		else {
			$menu[$row->menu_induk]['sub_menu'][] = array (
				'teks' => $row->teks,
				'uri' => $row->uri,
			);
		}
	}
	
	return $menu;
}

function options($src, $id, $ref_value, $text_field)
{
	$options = '';
	
	foreach ($src->result() as $row) {
		$option_value = $row->$id;
		$text_value = $row->$text_field;
		
		if ($row->$id == $ref_value)
			$options .= '<option value="'.$option_value.'" selected>'.$text_value.'</option>';
		else
			$options .= '<option value="'.$option_value.'">'.$text_value.'</option>';
	}
	
	return $options;
}

function db_insert($table, $data)
{
	$ci = ci();
	$data['created_at'] = date('Y-m-d H:i:s');
	$data['created_by'] = pengguna_session('id');
	$ci->db->insert($table, $data);
}

function db_update($table, $data, $where)
{
	$ci = ci();
	$data['updated_at'] = date('Y-m-d H:i:s');
	$data['updated_by'] = pengguna_session('id');
	$ci->db->update($table, $data, $where);
}

function str_to_num($str)
{
	if ($str === '') return null;
	return str_replace(',', '.', str_replace('.', '', $str));
}
