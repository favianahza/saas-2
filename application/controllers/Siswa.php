<?php  
defined('BASEPATH') OR exit('No direct script access allowed');

class Siswa extends CI_Controller {

	private $my_acc;

	public function __construct(){
		parent::__construct();
		if( !isset($_SESSION["logged_in"]) || !isset($_SESSION["siswa"]) ){
			header("Location: home");
		}
		$this->load->model('Home_models');
		$this->load->helper(array('url', 'form'));
		$this->Home_models->register_sp();
		$this->Home_models->edit_acc();
		$id = $_SESSION["id_user"];
		$this->my_acc = $this->Home_models->get_data_s_id();
	}

	private function is_ajax(){
		error_reporting(0);
		if( $_SERVER['HTTP_X_REQUESTED_WITH'] != NULL ){
			$ajax = true;
		} else {
			var_dump("MUST BE REQUESTED VIA AJAX"); die();
		}
	}

	public function index(){
		$data["title"] = "Sipulan - Siswa";
		$data["css"] = 'siswa.css';
		$data["js"] = 'siswa.js';
		$data["student"] = $this->Home_models->get_data_s_id();
		$data["acc"] = $this->Home_models->get_data_s_id();
		$this->load->view('templates/header', $data);
		$this->load->view('siswa/index', $data);
		$this->load->view('templates/footer');
	}


	public function data_siswa(){
		$this->is_ajax();
		$data["student"] = $this->Home_models->get_data_s_id();
		$data["acc"] = $this->Home_models->get_data_s_id();
		$this->load->view('siswa/data_siswa', $data);
	}


	public function upload_file(){
		$this->is_ajax();		
		$id_siswa = $_SESSION['id_user'];
		$data["count"] = 0;
		$data["acc"] = $this->Home_models->get_data_s_id();
		$sql = "SELECT * FROM `file_siswa` WHERE id_siswa = $id_siswa";
		$data["file"] = $this->Home_models->q($sql);
		$this->load->view('siswa/upload_file', $data);
	}

	public function upload_files(){
		$id_siswa = $_SESSION['id_user'];
		$data["title"] = "Sipulan - Siswa";
		$data["css"] = 'siswa.css';
		$data["js"] = 'files.js';
		$data["js2"] = 'upload_file.js';
		$data["acc"] = $this->Home_models->get_data_s_id();
		$sql = "SELECT * FROM `file_siswa` WHERE id_siswa = $id_siswa";
		$data["file"] = $this->Home_models->q($sql);
		$this->load->view('templates/header', $data);
		$this->load->view('siswa/upload_files', $data);
		$this->load->view('templates/footer', $data);
	}

	public function upload(){
		if( $this->input->post() ){
			$this->Home_models->upload_file();
		}
		redirect("home/index");
	}	

}