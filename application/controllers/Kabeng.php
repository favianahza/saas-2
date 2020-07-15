<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Kabeng extends CI_Controller {

	private $my_acc;

	public function __construct(){
		parent::__construct();
		if( !isset($_SESSION["logged_in"]) || !isset($_SESSION["kabeng"]) ){
			echo "<script>document.location.href='home/index'</script>";
		}
		$this->load->model('Home_models');
		$this->load->helper(array('url', 'form'));
		$this->Home_models->register_sp();
		$this->Home_models->edit_acc();
		$id = $_SESSION["id_user"];
		$this->my_acc = $this->Home_models->q("SELECT * FROM `kepala_bengkel` WHERE id_user = $id");		
	}

	private function is_ajax(){
		error_reporting(0);
		if( $_SERVER['HTTP_X_REQUESTED_WITH'] != NULL ){
			$ajax = true;
		} else {
			var_dump("MUST BE REQUESTED VIA AJAX"); die();
		}
	}

	public function index()
	{
		$data["title"] = "Sipulan - Kepala Bengkel";
		$data["css"] = "kabeng-index.css";
		$data["js"] = "kabeng.js";
		$id = $_SESSION["id_user"];
		$data["acc"] = $this->Home_models->q("SELECT * FROM `kepala_bengkel` WHERE id_user = $id");
		$this->load->view('templates/header', $data);
		$this->load->view('kabeng/index');
		$this->load->view('templates/footer');
	}

	// public function data_siswa(){
	// 	$this->is_ajax();
	// 	$data["students"] = $this->Home_models->get_data_s();
	// 	$this->load->view('kabeng/data_siswa', $data);
	// }

	public function data_siswa($start=0){
		$this->is_ajax();
		($start == NULL || $start == 1) ? 0 : $start;
		$start = intval($start);
		$data["students"] = $this->Home_models->get_data_s($start, 5);
		$rows = $this->Home_models->count_row("SELECT * FROM `siswa` WHERE jurusan = ?", $_SESSION['jurusan']);
		$per_page = 5;
		$data['pages'] = ceil($rows/$per_page);

		$this->load->view('kabeng/data_siswa', $data);
	}

	public function detail_siswa($id){
		$this->is_ajax();
		$data["student"] = $this->Home_models->get_data_s_id_p($id)[0];
		$this->load->view('kabeng/detail_siswa', $data);	
	}

	public function data_pembimbing(){
		$this->is_ajax();
		$data["records"] = $this->Home_models->get_data_p();
		$this->load->view('kabeng/data_pembimbing', $data);
	}

	public function detail_pembimbing($id){
		$this->is_ajax();
		$data["acc"] = $this->Home_models->get_d_p_id($id)[0];
		$data["siswa"] = $this->Home_models->s_y_dibimbing_id($id);
		$this->load->view('kabeng/detail_pembimbing', $data);		
	}

	public function file_siswa($start=0){
		$this->is_ajax();
		($start == NULL || $start == 1) ? 0 : $start;
		$start = intval($start);
		$data["files"] = $this->Home_models->get_file_s($start, 5);
		$rows = $this->Home_models->count_row("SELECT * FROM `siswa` WHERE jurusan = ?", $_SESSION['jurusan']);
		$per_page = 5;
		$data['pages'] = ceil($rows/$per_page);		
		$this->load->view('kabeng/file_siswa', $data);
	}

	public function pembagian_pembimbing($start=0){
		$this->is_ajax();
		($start == NULL || $start == 1) ? 0 : $start;
		$start = intval($start);
		$data["students"] = $this->Home_models->get_data_s($start, 5);
		$rows = $this->Home_models->count_row("SELECT * FROM `siswa` WHERE jurusan = ?", $_SESSION['jurusan']);
		$per_page = 5;
		$data["mentors"] = $this->Home_models->p_list();
		$data['pages'] = ceil($rows/$per_page);
		$this->load->view('kabeng/pembagian_pembimbing', $data);
	}

	public function update(){
		$this->load->database();
		$pembimbing = $_POST["id_pembimbing"];
		$siswa = $_POST["id_siswa"];
		$this->db->query("UPDATE `siswa` SET id_pembimbing = ? WHERE id_siswa = ?", array($pembimbing, $siswa));
		redirect('home/index');
	}

	public function delete(){
		$this->load->database();
		if( isset($_POST["id_siswa"]) ){
			$id = $_POST["id_siswa"];
			$this->db->query("DELETE FROM `siswa` WHERE id_siswa = ?", $id);
		} else {
			$id = $_POST["id_pembimbing"];
			$this->db->query("DELETE FROM `pembimbing` WHERE id_pembimbing = ?", $id);
		}
		redirect('home/index');
	}

}