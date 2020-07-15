<?php  
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembimbing extends CI_Controller {

	private $my_acc;

	private function is_ajax(){
		error_reporting(0);
		if( $_SERVER['HTTP_X_REQUESTED_WITH'] != NULL ){
			$ajax = true;
		} else {
			var_dump("MUST BE REQUESTED VIA AJAX"); die();
		}
	}


	public function __construct(){
		parent::__construct();
		if( !isset($_SESSION["logged_in"]) || !isset($_SESSION["pembimbing"]) ){
			header("Location: home");
		}		
		$this->load->model('Home_models');
		$this->load->helper(array('url', 'form'));
		$this->Home_models->register_sp();
		$this->Home_models->edit_acc();
		$this->my_acc = $this->Home_models->get_d_p_id()[0];
	}

	public function index(){
		$data["title"] = "Sipulan - Pembimbing";
		$data["css"] = 'pembimbing.css';
		$data["js"] = 'pembimbing.js';
		$data["acc"] = $this->Home_models->get_d_p_id()[0];
		// var_dump($this->Home_models->get_data_p()[0]); die();
		$data["siswa"] = $this->Home_models->s_y_dibimbing();
		$this->load->view('templates/header', $data);
		$this->load->view('pembimbing/index', $data);
		$this->load->view('templates/footer');
	}

	public function lihat_siswa($start=0){
		($start == NULL || $start == 1) ? 0 : $start;
		$start = intval($start);
		$data["title"] = "Sipulan - Pembimbing";
		$data["css"] = 'pembimbing.css';
		$data["js"] = 'lihat_siswa.js';
		$data["acc"] = $this->Home_models->get_d_p_id()[0];
		$data["students"] = $this->Home_models->get_data_s_p($start, 5);
		$rows = $this->Home_models->count_row("SELECT * FROM `siswa` WHERE id_pembimbing = ?", $_SESSION['id_user']);
		$per_page = 5;
		$data['pages'] = ceil($rows/$per_page);
		$this->load->view('templates/header', $data);
		$this->load->view('pembimbing/lihat_siswa', $data);
		$this->load->view('templates/footer', $data);		
	}

	public function detail_siswa($id){
		$this->is_ajax();
		$data["student"] = $this->Home_models->get_data_s_id_p($id)[0];
		$this->load->view('pembimbing/detail_siswa', $data);
	}


	public function data_siswa($start=0){
		($start == NULL || $start == 1) ? 0 : $start;
		$start = intval($start);		
		$this->is_ajax();
		$data["students"] = $this->Home_models->get_data_s_p($start, 5);
		$rows = $this->Home_models->count_row("SELECT * FROM `siswa` WHERE id_pembimbing = ?", $_SESSION['id_user']);
		$per_page = 5;
		$data['pages'] = ceil($rows/$per_page);
		$data["acc"] = $this->Home_models->get_d_p_id()[0];
		$this->load->view('pembimbing/data_siswa', $data);
	}

	public function file_siswa($start=0){
		($start == NULL || $start == 1) ? 0 : $start;
		$start = intval($start);
		$this->is_ajax();
		$data["files"] = $this->Home_models->get_file_s_p($start, 5);
		$rows = $this->Home_models->count_row("SELECT * FROM `siswa` WHERE id_pembimbing = ?", $_SESSION['id_user']);
		$per_page = 5;
		$data['pages'] = ceil($rows/$per_page);	
		$data["acc"] = $this->Home_models->get_d_p_id()[0];
		$this->load->view('pembimbing/file_siswa', $data);
	}

	public function persetujuan($start=0){
		($start == NULL || $start == 1) ? 0 : $start;
		$start = intval($start);		
		$this->is_ajax();
		$rows = $this->Home_models->count_row("SELECT * FROM `siswa` WHERE id_pembimbing = ?", $_SESSION['id_user']);
		$per_page = 5;
		$data['pages'] = ceil($rows/$per_page);			
		$data["students"] = $this->Home_models->get_data_per($start, 5);
		$data["acc"] = $this->Home_models->get_d_p_id()[0];
		$this->load->view('pembimbing/persetujuan', $data);
	}

	public function setuju(){
		$this->load->database();
		$id_siswa = $_POST["id_siswa"];

		$this->db->query("UPDATE `siswa` SET persetujuan = TRUE WHERE id_siswa = ?", $id_siswa);
	}

}