<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	private $my_acc;

	private function get_acc(){
		if( isset($_SESSION["logged_in"]) && isset($_SESSION["siswa"]) ){
			$id = $_SESSION["id_user"];
			$result = $this->Home_models->get_data_s_id();
			return $result;
		}

		if( isset($_SESSION["logged_in"]) && isset($_SESSION["pembimbing"]) ){
			$id = $_SESSION["id_user"];
			$result = $this->Home_models->get_d_p_id()[0];
			return $result;
		}

		if( isset($_SESSION["logged_in"]) && isset($_SESSION["kabeng"]) ){
			$id = $_SESSION["id_user"];
			$result = $this->Home_models->q("SELECT * FROM `kepala_bengkel` WHERE id_user = $id");
			return $result;
		}

	}

	public function __construct(){
		parent::__construct();
		$this->load->model('Home_models');
		$this->my_acc = $this->get_acc();
	}



	public function index()
	{
		$data["title"] = "Sipulan - Sistem Pengumpulan Laporan Online";
		$data["css"] = "index.css";
		$data["js"] = "index.js";
		$data["acc"] = $this->get_acc();;
		$this->load->view('home/index', $data);
		$this->load->view('templates/footer');
		if( isset($_SESSION["logged_in"]) ){
			$this->Home_models->register_sp();			
			$this->Home_models->edit_acc();
		}

	}



	public function login_s(){
		if( isset($_SESSION["logged_in"]) ){
			header("Location: index");
		}
		$data["title"] = "Sipulan - Login Siswa";
		$data["css"] = "login.css";
		$data["js"] = "login.js";

		if( $this->input->post() ){
		$this->Home_models->login('siswa');
		}

		$this->load->view('templates/header', $data);
		$this->load->view('home/login_s');
		$this->load->view('templates/footer', $data);	
	}

	public function login_p(){
		if( isset($_SESSION["logged_in"]) ){
			header("Location: index");
		}		
		$data["title"] = "Sipulan - Login Pembimbing";
		$data["css"] = "login.css";
		$data["js"] = "login.js";

		if( $this->input->post() ){
		$this->Home_models->login('pembimbing');
		}

		$this->load->view('templates/header', $data);
		$this->load->view('home/login_p');
		$this->load->view('templates/footer', $data);		
	}

	public function login_k(){
		if( isset($_SESSION["logged_in"]) ){
			header("Location: index");
		}		
		$data["title"] = "Sipulan - Login Kepala Bengkel";
		$data["css"] = "login.css";
		$data["js"] = "login.js";

		if( $this->input->post() ){
			$this->Home_models->login('kepala_bengkel');	
		}

		$this->load->view('templates/header', $data);
		$this->load->view('home/login_k');
		$this->load->view('templates/footer', $data);		
	}



	public function logout(){
		$this->load->view('home/logout');
	}



	public function register(){
		if( isset($_SESSION["logged_in"]) ){
			header("Location: index");
		}		
		$data["title"] = "Sipulan - Register";
		$data["css"] = "daftar.css";
		$data["js"] = "daftar.js";
		$this->load->helper('form');

		$this->load->view('templates/header', $data);
		$this->load->view('home/register');
		$this->load->view('templates/footer');	
		if( $this->input->post() ){
			$this->Home_models->register('kepala_bengkel');			
		}

	}



}
