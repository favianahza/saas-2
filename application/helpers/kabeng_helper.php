<?php 

class kabeng_h extends CI_Controller
{

public static function count_s($id){
	 
	var_dump($this->db->query("SELECT * FROM pembimbing"));
	// $sql = $this->db->query("SELECT count(id_pembimbing) jml_siswa FROM siswa JOIN pembimbing USING(id_pembimbing) WHERE id_pembimbing = ?", $id);
	// $result = $sql->row_array();
	
	// return $result;
}	

}