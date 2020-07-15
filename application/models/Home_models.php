<?php 

class Home_models extends CI_Model {

	public function __construct(){
		$this->load->database();
	}


	// REGISTER KEPALA BENGKEL
	public function register($tabel){

		$post = $this->input->post();

		$nama = htmlspecialchars($post["nama"]);
		$jurusan = htmlspecialchars($post["jurusan"]);
		$username = htmlspecialchars($post["username"]);
		$password = htmlspecialchars($post["password"]);
		$konfirmasi = $post["konfirmasi"];

		// PASSWORD CONFIRMATION
		if( $password != $konfirmasi ){
			$this->session->set_flashdata('alert','p_confirm_fail');
			redirect('home/register');
			die();
		}


		// CHECK USERNAME
		$check = $this->db->query("SELECT username FROM `kepala_bengkel` WHERE username = ?", $username);
		$valid = $check->num_rows();

		if( $valid > 0 ){
			$this->session->set_flashdata('alert','user_fail');
			redirect('home/register');
			die();
		} 

		// CHECK JURUSAN
		$c_jurusan = $this->db->query("SELECT jurusan FROM `kepala_bengkel` WHERE jurusan = ?", $jurusan);
		$test = $c_jurusan->num_rows();

		if( $test > 0 ){
			$this->session->set_flashdata('alert','jurusan_fail');
			redirect('home/register');			
			die();
		}

		// HASHING PASSWORD
		$hashed = password_hash($password, PASSWORD_DEFAULT);

		// CHECK USER UPLOADING
		if( $_FILES["foto"]["error"] == 4 ){
			$poto = '00-default.jpg';
		} else {
			$poto = $username.'-'.$_FILES["foto"]['name'];
		}


		// READY TO UPLOAD
		$config['file_name'] 		= $poto;
		$config['upload_path']      = './img/user/';
        $config['allowed_types']    = 'jpg|png|jpeg';
        $config['max_size']         = 133472;
        $config['remove_spaces'] 	= FALSE;
        $this->load->library('upload', $config);

        $up = $this->upload->do_upload('foto');

		if( !$up ){
		       	if($this->upload->display_errors() == "<p>The filetype you are attempting to upload is not allowed.</p>"){
		        $this->session->set_flashdata('alert', 'f_format');
		        redirect('home/register');
		       	return false;
		    }
		 }

        $uploaded = $this->upload->data();
        $foto = $uploaded['file_name'];

        $data = array(
        	'id_user' => '',
        	'nama' => $nama,
        	'jurusan' => $jurusan,
        	'username' => $username,
        	'password' => $hashed,
        	'foto' => $foto
    	);

        $this->db->insert($tabel, $data);

		if ($this->db->affected_rows() > 0)
		{
		  $this->session->set_flashdata('alert','register_kabeng');
		  redirect('home/login_k');
		}
		else
		{
		  header("Location: register");
		}

	}







	// LOGIN
	public function login($table){
		$post = $this->input->post();

		// LOGIN UNTUK SISWA
		if ( isset($post["nis"]) ) {

			$nis = $post["nis"];
			$password = $post["pass"];


			$query = $this->db->query("SELECT * FROM `$table` WHERE NIS = ?", $nis);


			if($query->row_array() == NULL ){
				$this->session->set_flashdata('alert', 'no_nis');
				redirect('home/login_s');
			}


			$persetujuan = $query->row_array()["persetujuan"];

			// CHECK PASSWORD
			$hash = $query->row_array()["password"];
			if( password_verify($password, $hash) ){

						$data_session = array(
							'nis'  => $post["nis"],
							'id_user'  => $query->row_array()["id_siswa"],
							'nama'  => $query->row_array()["nama"],
							'img'		=> $query->row_array()["foto"],
							'jurusan'	=> $query->row_array()["jurusan"],
							'siswa'	=> TRUE,
	        				'logged_in' => TRUE
						);


						$this->session->set_userdata($data_session);

						if( $persetujuan > 0 ){

						$this->session->set_flashdata('alert', 's_accepted');
						
						}
						

						redirect('home/index');				

			} else {
				$this->session->set_flashdata('alert', 'fail_pass_s');
				redirect('home/login_s');
			}

		}







		// LOGIN KEPALA BENGKEL DAN PEMBIMBING
		if( isset($post["username"]) ){



				// LOGIN UNTUK KEPALA BENGKEL
				if( $table == 'kepala_bengkel' ) {

					$username = $post["username"];
					$password = $post["password"];


					$query = $this->db->query("SELECT * FROM `$table` WHERE username = ?", $username);
					
					if($query->row_array() == NULL ){
						$this->session->set_flashdata('alert', 'no_username_k');
						redirect('home/login_k');
					}


					// CHECK PASSWORD
					$hash = $query->row_array()["password"];
					if( password_verify($password, $hash) ){
						
						$data_session = array(
							'id_user'  => $query->row_array()["id_user"],
							'username'  => $username,
							'img'		=> $query->row_array()["foto"],
							'jurusan'	=> $query->row_array()["jurusan"],
							'kabeng'	=> TRUE,
	        				'logged_in' => TRUE
						);


						$this->session->set_userdata($data_session);
						header("Location: ".base_url()."kabeng");

					} else {
						$this->session->set_flashdata('alert', 'fail_pass_k');
						redirect('home/login_k');
					}

				}



				// LOGIN UNTUK PEMBIMBING
				if( $table == 'pembimbing' ) {

					$username = $post["username"];
					$password = $post["password"];


					$query = $this->db->query("SELECT * FROM `$table` WHERE username = ?", $username);
					
					if($query->row_array() == NULL ){
						$this->session->set_flashdata('alert', 'no_username_k');
						redirect('home/login_p');
					}


					// CHECK PASSWORD
					$hash = $query->row_array()["password"];
					if( password_verify($password, $hash) ){
						
						$data_session = array(
							'id_user'  => $query->row_array()["id_pembimbing"],
							'username'  => $username,
							'img'		=> $query->row_array()["foto"],
							'jurusan'	=> $query->row_array()["jurusan"],
							'pembimbing'=> TRUE,
	        				'logged_in' => TRUE
						);


						$this->session->set_userdata($data_session);

						header("Location: ".base_url()."home");

					} else {
						$this->session->set_flashdata('alert', 'fail_pass_k');
						redirect('home/login_p');
					}

				}				

		}

	}








	// REGISTER SISWA OR PEMBIMBING
	public function register_sp(){

		$post = $this->input->post();

		if( isset($post["buat_as"]) ){
			$tabel = 'siswa';
			$nama = htmlspecialchars($post["nama"]);
			$kelas = htmlspecialchars($post["kelas"]);
			$nis = htmlspecialchars($post["nis"]);
			$hashed = password_hash($post["password"], PASSWORD_DEFAULT);
			$kpass = htmlspecialchars($post["kpassword"]);
			$jurusan = $post["jurusan"];
			$repeat = $post["repeat"];
			// CHECK NIS
			$check = $this->db->query("SELECT NIS FROM `siswa` WHERE NIS = ?", $nis);
			$valid = $check->num_rows();			

			if( $valid > 0 ){
				$this->session->set_flashdata('alert', 'nis_used');
				redirect('kabeng/index');        			        		
			}

			if( $post["password"] != $kpass ){
				$this->session->set_flashdata('alert', 'p_confirm_fail_s');
				redirect('kabeng/index');        			        		
			}

			$data = array(
        	'id_siswa' => '',
        	'nama' => $nama,
        	'NIS' => $nis,
        	'password' => $hashed,
        	'kelas' => $kelas,
        	'foto' => '00-default.jpg',
        	'jurusan' => $jurusan
    		);

        	$query =	$this->db->insert($tabel, $data);
        	$get_id = $this->db->query("SELECT LAST_INSERT_ID()");
        	$id = $get_id->row_array()["LAST_INSERT_ID()"];
        	$query_file = $this->db->query("INSERT INTO `file_siswa`(id_siswa) VALUES($id)");

        	if( $query ){

        		if( $repeat == 1 ){
				$this->session->set_flashdata('alert', 'repeat');
				redirect('kabeng/index');        		        			
        		}

				$this->session->set_flashdata('alert', 'register_siswa');
				redirect('kabeng/index');        		
        	} else {
				$this->session->set_flashdata('alert', 'register_siswa_f');
				redirect('kabeng/index');        			        		
        	}

		} else if( isset($post["buat_ap"]) ) {
			$tabel = 'pembimbing';
			$nama = $post["nama"];
			$username = $post["username"];
			$kpass = $post["kpassword"];
			$jurusan = $post["jurusan"];
			$hashed = password_hash($post["password"], PASSWORD_DEFAULT);

			// CHECK USERNAME
			$check = $this->db->query("SELECT username FROM `pembimbing` WHERE username = ?", $username);
			$valid = $check->num_rows();	

			if( $valid > 0 ){
				$this->session->set_flashdata('alert', 'username_used');
				redirect('kabeng/index');   
			}

			if( $post["password"] != $kpass ){
				$this->session->set_flashdata('alert', 'p_confirm_fail_s');
				redirect('kabeng/index');   
			}

			$data = array(
        	'id_pembimbing' => '',
        	'nama' => $nama,
        	'jurusan' => $jurusan,
        	'username' => $username,
        	'password' => $hashed,
        	'foto' => '00-default.jpg'
    		);

        	$query = $this->db->insert($tabel, $data);

        	if( $query ){
				$this->session->set_flashdata('alert', 'register_pembimbing');
				redirect('kabeng/index');   
        	} else {
				$this->session->set_flashdata('alert', 'register_pembimbing_s');
				redirect('kabeng/index');           		
        	}


		} else {
			NULL;
		}


	}



	// GET DATA SISWA BY ID
	public function get_data_s_id_p($id){
		$sql = "SELECT *, (SELECT pembimbing.nama FROM pembimbing WHERE siswa.id_pembimbing = pembimbing.id_pembimbing) pembimbing, (SELECT judul_laporan FROM file_siswa WHERE file_siswa.id_siswa = siswa.id_siswa) AS jdl FROM siswa WHERE id_siswa = ?";
		$query = $this->db->query($sql, $id);

		$result = $query->result_array();
		return $result;
	}




	// GET DATA PEMBIMBING 
	public function get_data_p(){
		$sql = "SELECT *, (SELECT count(id_pembimbing) FROM siswa WHERE siswa.id_pembimbing = pembimbing.id_pembimbing ) AS jml_siswa FROM pembimbing WHERE jurusan = ?";
		$query = $this->db->query($sql, $_SESSION["jurusan"]);

		$result = $query->result_array();

		return $result;
	}

	// GET PEMBIMBING BY ID
	public function get_d_p_id(){
		$sql = "SELECT *, (SELECT count(id_pembimbing) FROM siswa WHERE siswa.id_pembimbing = pembimbing.id_pembimbing ) AS jml_siswa FROM pembimbing WHERE id_pembimbing = ?";
		$query = $this->db->query($sql, $_SESSION["id_user"]);

		$result = $query->result_array();

		return $result;
	}



	// GET DATA SISWA BY JURUSAN
	public function get_data_s($offset=0, $limit=0){
		( $offset == NULL ) ? $offset = 0 : $offset;
		$sql = "SELECT *, (SELECT pembimbing.nama FROM pembimbing WHERE siswa.id_pembimbing = pembimbing.id_pembimbing) pembimbing FROM siswa WHERE jurusan = ? ORDER BY NIS LIMIT ?, ?";
		$query = $this->db->query($sql, array($_SESSION["jurusan"], $offset, $limit));

		$result = $query->result_array();
		return $result;
	}


	// GET DATA SISWA BY PEMBIMBING
	public function get_data_s_p($offset=0,$limit=0){
		$sql = "SELECT *, (SELECT pembimbing.nama FROM pembimbing WHERE siswa.id_pembimbing = pembimbing.id_pembimbing) pembimbing, (SELECT judul_laporan FROM file_siswa WHERE siswa.id_siswa = file_siswa.id_siswa) jdl FROM siswa WHERE id_pembimbing = ? AND jurusan = ? ORDER BY NIS LIMIT ?,?";
		$query = $this->db->query($sql, array($_SESSION["id_user"], $_SESSION["jurusan"], $offset, $limit));
		$result = $query->result_array();


		return $result;
	}


	// GET SISWA YANG DIBIMBING
	public function s_y_dibimbing(){
		$sql = "SELECT nama FROM siswa WHERE id_pembimbing = ?";
		$query = $this->db->query($sql, $_SESSION["id_user"]);
		$result = $query->result_array();

		return $result;		
	}


	public function s_y_dibimbing_id($id){
		$sql = "SELECT nama FROM siswa WHERE id_pembimbing = ?";
		$query = $this->db->query($sql, $id);
		$result = $query->result_array();

		return $result;		
	}


	// GET FILE SISWA BY PEMBIMBING
	public function get_file_s_p($offset=0, $limit=0){
		$sql = "SELECT *, (SELECT NIS FROM siswa WHERE file_siswa.id_siswa = siswa.id_siswa ) AS NIS, (SELECT nama FROM siswa WHERE file_siswa.id_siswa = siswa.id_siswa ) AS nama, (SELECT jurusan FROM siswa WHERE file_siswa.id_siswa = siswa.id_siswa ) AS jurusan, (SELECT id_pembimbing FROM siswa WHERE file_siswa.id_siswa = siswa.id_siswa) AS id_pem FROM file_siswa HAVING jurusan = ? AND id_pem = ? ORDER BY 8 LIMIT ?, ?";
		$query = $this->db->query($sql, array($_SESSION["jurusan"], $_SESSION["id_user"], $offset, $limit));

		$result = $query->result_array();


		return $result;
	}


	// GET FILE SISWA
	public function get_file_s($offset=0, $limit=0){
		( $offset == NULL ) ? $offset = 0 : $offset;
		$sql = "SELECT *, (SELECT NIS FROM siswa WHERE file_siswa.id_siswa = siswa.id_siswa ) AS NIS, (SELECT nama FROM siswa WHERE file_siswa.id_siswa = siswa.id_siswa ) AS nama, (SELECT jurusan FROM siswa WHERE file_siswa.id_siswa = siswa.id_siswa ) AS jurusan FROM file_siswa HAVING jurusan = ? ORDER BY NIS LIMIT ?, ?";
		$query = $this->db->query($sql, array($_SESSION["jurusan"], $offset, $limit));

		$result = $query->result_array();
		return $result;
	}



	// PEMBIMBING LIST
	public function p_list(){
		$sql = "SELECT nama, id_pembimbing FROM `pembimbing` WHERE jurusan = ?";
		$query = $this->db->query($sql, $_SESSION["jurusan"]);

		$result = $query->result_array();
		return $result;
	}



	// UPDATE PEMBIMBING
	public function update_p($pembimbing, $siswa){
		if( isset($pembimbing) && isset($siswa) ){

		$sql = "UPDATE `siswa` SET id_pembimbing = ?, WHERE id_siswa = ?";
		$this->db->query($sql, array($pembimbing, $siswa));

		} else {
			header("Location: kabeng");
		}

	}



	// PERSETUJUAN
	public function get_data_per($offset=0, $limit=0){
		( $offset == NULL ) ? $offset = 0 : $offset;
		$sql = "SELECT *, (SELECT pembimbing.nama FROM pembimbing WHERE siswa.id_pembimbing = pembimbing.id_pembimbing) pembimbing,  ( SELECT ( IF(judul_laporan IS NULL, 1, 0) + IF(file_laporan IS NULL, 1, 0) + IF(absensi_pkl IS NULL, 1, 0) + IF(agenda_pkl IS NULL, 1, 0) + IF(nilai_pkl IS NULL, 1, 0) + IF(sertifikat_pkl IS NULL, 1, 0) ) FROM file_siswa WHERE id_siswa= siswa.id_siswa) AS nv FROM siswa WHERE id_pembimbing = ? AND jurusan = ? ORDER BY NIS LIMIT ?, ?";
		$query = $this->db->query($sql, array($_SESSION["id_user"], $_SESSION["jurusan"], $offset, $limit));
		$result = $query->result_array();


		return $result;
	}



	// GET DATA SISWA BY ID
	public function get_data_s_id(){
		$sql = "SELECT *, (SELECT pembimbing.nama FROM pembimbing WHERE siswa.id_pembimbing = pembimbing.id_pembimbing) pembimbing FROM siswa WHERE jurusan = ? AND id_siswa = ?";
		$query = $this->db->query($sql, array($_SESSION["jurusan"], $_SESSION["id_user"]));

		$result = $query->row_array();
		return $result;
	}








	// UPLOAD FILE
	public function upload_file(){
		$post = $this->input->post();

		$judul_laporan = $post["judul_laporan"];
		$fl_lama = $post["fl_lama"];
		$ap_lama = $post["ap_lama"];
		$ag_lama = $post["ag_lama"];
		$n_lama = $post["n_lama"];
		$s_lama = $post["s_lama"];
		$nis = $post["nis"];
		$id = $post["id"];
		$now = $post["now"];
		$dead = $post["deadline"];

		if( strtotime($now) > strtotime($dead) ){
			$this->session->set_flashdata('alert', 'deadline');
			redirect('siswa/upload_files');
		}


		if( $_FILES["laporan"]["error"] == 4){
			$laporan_fn = $fl_lama;
		}

		if( $_FILES["absensi"]["error"] == 4){			
			$absensi_fn = $ap_lama;
		}

		if( $_FILES["agenda"]["error"] == 4){			
			$agenda_fn = $ag_lama;
		}

		if( $_FILES["nilai"]["error"] == 4){
			$nilai_fn = $n_lama;
		}

		if( $_FILES["sertifikat"]["error"] == 4){			
			$sertifikat_fn = $s_lama;
		}				
		
		$config['upload_path']      = './document/';
        $config['allowed_types']    = 'pdf|jpg|png|jpeg';
        $config['max_size']         = 133472;
        $config['remove_spaces'] 	= FALSE;

        // UPLOAD FILE LAPORAN
        if ( $_FILES["laporan"]["name"] ){
        $laporan_fn = $id."-LPRN-".$nis.'-'.$_FILES["laporan"]["name"];
        $config["file_name"] = $laporan_fn;
        $this->load->library('upload', $config);

        $up_l =  $this->upload->do_upload('laporan');

		    if( !$up_l ){
		       	if($this->upload->display_errors() == "<p>The filetype you are attempting to upload is not allowed.</p>"){
		        $this->session->set_flashdata('alert', 'invalid_f');
		        redirect('siswa/upload_files');
		       	return false;
		    }
		 }

        $u_l = $this->upload->data();
		$u_l_n = $u_l['file_name'];
		$laporan_fn = $u_l_n;
        }

        // UPLOAD ABSENSI PRAKERIN
        if ( $_FILES["absensi"]["name"] != '' ){
			$absensi_fn = $id."-ABS-".$nis.'-'.$_FILES["absensi"]["name"];
        	$config["file_name"] = $absensi_fn;
        	$this->load->library('upload', $config);
        	$this->upload->initialize($config);

			$up_a = $this->upload->do_upload('absensi');

		    if( !$up_a ){
		       	if($this->upload->display_errors() == "<p>The filetype you are attempting to upload is not allowed.</p>"){
		        $this->session->set_flashdata('alert', 'invalid_f');
		        redirect('siswa/upload_files');
		       	return false;
		    }
		 }

	        $u_a = $this->upload->data();
			$u_a_n = $u_a['file_name'];
			$absensi_fn = $u_a_n;			
        }

        // UPLOAD AGENDA PRAKERIN
        if ($_FILES["agenda"]["name"] != ''){
			$agenda_fn = $id."-AGD-".$nis.'-'.$_FILES["agenda"]["name"];
        	$config["file_name"] = $agenda_fn;
        	$this->load->library('upload', $config);
        	$this->upload->initialize($config);

			$up_g = $this->upload->do_upload('agenda');     

		    if( !$up_g ){
		       	if($this->upload->display_errors() == "<p>The filetype you are attempting to upload is not allowed.</p>"){
		        $this->session->set_flashdata('alert', 'invalid_f');
		        redirect('siswa/upload_files');
		       	return false;
		    }
		 }

	        $u_ag = $this->upload->data();
			$u_ag_n = $u_ag['file_name'];
			$agenda_fn = $u_ag_n;						   	
        }

        // UPLOAD NILAI PRAKERIN
        if ($_FILES["nilai"]["name"] != ''){
			$nilai_fn = $id."-NL-".$nis.'-'.$_FILES["nilai"]["name"];
        	$config["file_name"] = $nilai_fn;
        	$this->load->library('upload', $config);
			$this->upload->initialize($config);

			$up_n = $this->upload->do_upload('nilai'); 

		    if( !$up_n ){
		       	if($this->upload->display_errors() == "<p>The filetype you are attempting to upload is not allowed.</p>"){
		        $this->session->set_flashdata('alert', 'invalid_f');
		        redirect('siswa/upload_files');
		       	return false;
		    }
		 }

	        $u_n = $this->upload->data();
			$u_n_n = $u_n['file_name'];
			$nilai_fn = $u_n_n;							
        }

        // UPLOAD SERTIFIKAT PRAKERIN
        if ($_FILES["sertifikat"]["name"] != ''){
			$sertifikat_fn = $id."-ST-".$nis.'-'.$_FILES["sertifikat"]["name"];
        	$config["file_name"] = $sertifikat_fn;
        	$this->load->library('upload', $config);
        	$this->upload->initialize($config);

			$up_s = $this->upload->do_upload('sertifikat');

		    if( !$up_s ){
		       	if($this->upload->display_errors() == "<p>The filetype you are attempting to upload is not allowed.</p>"){
		        $this->session->set_flashdata('alert', 'invalid_f');
		        redirect('siswa/upload_files');
		       	return false;
		    }
		 }

	        $u_st = $this->upload->data();
			$u_st_n = $u_st['file_name'];
			$sertifikat_fn = $u_st_n;						        	
        }

        $sql = "UPDATE `file_siswa` SET `judul_laporan`= ?,`file_laporan`= ?,`absensi_pkl`= ?,`agenda_pkl`= ?,`nilai_pkl`= ?,`sertifikat_pkl`= ? WHERE id_siswa = ?";

        $query = $this->db->query($sql, array($judul_laporan, $laporan_fn, $absensi_fn, $agenda_fn, $nilai_fn, $sertifikat_fn, $id));

		if ($query)
		{
				$this->session->set_flashdata('alert', 'upload_t');
				redirect('siswa/upload_files');
		}
		else
		{
				$this->session->set_flashdata('alert', 'upload_f');
				redirect('siswa/upload_files');
		}

	}





	// EDIT DATA SISWA, PEMBIMBING, KEPALA BENGKEL
	public function edit_acc(){
		$post = $this->input->post();

		// AKUN SISWA
		if( isset($post["edit_as"]) ){
			$id_siswa = $post["id_user"];
			$foto_lama = $post["foto_lama"];
			$pembimbing_pkl = $post["pembimbing_pkl"];
			$tempat_pkl = $post["tempat_pkl"];
			$tgl_pkl = $post["tanggal_pkl"];
			$lama_pkl = intval($post["lama_pkl"]);
			$long = $lama_pkl + 1;


			$time = strtotime($tgl_pkl);
			$deadline = date("Y-m-d", strtotime("+$long month", $time));

			if( $_FILES["foto"]["error"] == 4 ){
				$foto = $foto_lama;
			}


			if( $_FILES["foto"]["name"] != '' ){
				$upload = $id_siswa."-".$_FILES["foto"]["name"];
				$config['file_name'] 		= $upload;
				$config['upload_path']      = './img/siswa/';
		        $config['allowed_types']    = 'jpg|png|jpeg';
		        $config['max_size']         = 133472;
		        $this->load->library('upload', $config);

		        $up = $this->upload->do_upload('foto');

		        if( !$up ){
		        	if($this->upload->display_errors() == "<p>The filetype you are attempting to upload is not allowed.</p>"){
		        		$this->session->set_flashdata('alert', 'f_format');
		        		redirect('siswa');
		        		return false;
		        	}
		        }

		        $uploaded = $this->upload->data();
		        $foto = $uploaded['file_name'];
			}
			$sql = "UPDATE `siswa` SET `pembimbing_pkl`=?,`tempat_pkl`=?,`tgl_pkl`=?,`lama_pkl`=?, `deadline`=?,`foto`=? WHERE `id_siswa` = ?";

			$this->db->query($sql, array($pembimbing_pkl, $tempat_pkl, $tgl_pkl, $lama_pkl, $deadline, $foto, $id_siswa));

			if( $this->db->affected_rows() > 0 ){
				$this->session->set_flashdata('alert', 'edit_acc_t');				
				redirect('siswa');
			} else {
				$this->session->set_flashdata('alert', 'edit_acc_f');				
				redirect('siswa');
			}
			
		}


		// AKUN PEMBIMBING
		if( isset($post["edit_ap"]) ){
			$id_pembimbing = $post["id_pembimbing"];
			$foto_lama = $post["foto_lama"];
			

			if( $_FILES["foto"]["error"] == 4 ){
				$foto = $foto_lama;
			}


			if( $_FILES["foto"]["name"] != '' ){
				$upload = $id_pembimbing."-".$_FILES["foto"]["name"];
				$config['file_name'] 		= $upload;
				$config['upload_path']      = './img/pembimbing/';
		        $config['allowed_types']    = 'jpg|png|jpeg';
		        $config['max_size']         = 133472;
		        $this->load->library('upload', $config);

		        $up = $this->upload->do_upload('foto');

		        if( !$up ){
		        	if($this->upload->display_errors() == "<p>The filetype you are attempting to upload is not allowed.</p>"){
		        		$this->session->set_flashdata('alert', 'f_format');
		        		redirect('pembimbing');
		        		return false;
		        	}
		        }


		        $uploaded = $this->upload->data();
		        $foto = $uploaded["file_name"];
			}

			$sql = "UPDATE `pembimbing` SET `foto`=? WHERE `id_pembimbing` = ?";

			$query = $this->db->query($sql, array($foto, $id_pembimbing));

			if( $query ){
				$this->session->set_flashdata('alert', 'edit_acc_t');				
				redirect('pembimbing');
			} else {
				$this->session->set_flashdata('alert', 'edit_acc_f');				
				redirect('pembimbing');
			}			
		}


		// AKUN KABENG
		if( isset($post["edit_ak"]) ){
			$id_user = $post["id_kabeng"];
			$nama = $post["nama"];
			$foto_lama = $post["foto_lama"];


			if( $_FILES["foto"]["error"] == 4 ){
				$foto = $foto_lama;
			}


			if( $_FILES["foto"]["name"] != '' ){
				$upload = $id_user."-".$_FILES["foto"]["name"];
				$config['file_name'] 		= $upload;
				$config['upload_path']      = './img/user/';
		        $config['allowed_types']    = 'jpg|png|jpeg';
		        $config['max_size']         = 133472;
		        $this->load->library('upload', $config);

		        $up = $this->upload->do_upload('foto');

		        if( !$up ){
		        	if($this->upload->display_errors() == "<p>The filetype you are attempting to upload is not allowed.</p>"){
		        		$this->session->set_flashdata('alert', 'f_format');
		        		redirect('kabeng');
		        		return false;
		        	}
		        }

		        $uploaded = $this->upload->data();
		        $foto = $uploaded['file_name'];
			}

			$sql = "UPDATE `kepala_bengkel` SET nama = ?, foto = ? WHERE id_user = ?";

			$query = $this->db->query($sql, array($nama, $foto, $id_user));

			if( $query ){
				$this->session->set_flashdata('alert', 'edit_acc_t');
				redirect('kabeng');
			} else {
				$this->session->set_flashdata('alert', 'edit_acc_f');				
				redirect('kabeng');
			}			
			
		}

		
		// PASSWORD EDIT AKUN

		// PASSWORD KABENG
		if( isset($post["epk"]) ){
			$old_k = $post["opass_k"];
			$npk = $post["npass_k"];
			$knpk = $post["knpass_k"];
			// CHECK PASS LAMA SISWA
			$query = $this->db->query("SELECT * FROM `kepala_bengkel` WHERE id_user = ?", $_SESSION["id_user"]);

			$hash = $query->row_array()["password"];
			
			if( password_verify($old_k, $hash) ){

				if( $npk != $knpk ){
				$this->session->set_flashdata('alert', 'c_fail');
				redirect('kabeng');					
				}

				$hashed = password_hash($npk, PASSWORD_DEFAULT);
				$query = $this->db->query("UPDATE `kepala_bengkel` SET password = ? WHERE id_user = ?", array($hashed, $_SESSION["id_user"]));

				if( $query ){
				$this->session->set_flashdata('alert', 'spk');
				redirect('kabeng');					
				}


			} else {
				$this->session->set_flashdata('alert', 'epok_f');
				redirect('kabeng');

			}


		}


		// PASSWORD PEMBIMBING
		if( isset($post["epp"]) ){
			$old_p = $post["opass_p"];
			$npp = $post["npass_p"];
			$knpp = $post["knpass_p"];
			// CHECK PASS LAMA PEMBIMBING
			$query = $this->db->query("SELECT * FROM `pembimbing` WHERE id_pembimbing = ?", $_SESSION["id_user"]);

			$hash = $query->row_array()["password"];
			
			if( password_verify($old_p, $hash) ){

				if( $npp != $knpp ){
				$this->session->set_flashdata('alert', 'c_fail');
				redirect('pembimbing');					
				}

				$hashed = password_hash($npp, PASSWORD_DEFAULT);
				$query = $this->db->query("UPDATE `pembimbing` SET password = ? WHERE id_pembimbing = ?", array($hashed, $_SESSION["id_user"]));

				if( $query ){
				$this->session->set_flashdata('alert', 'spk');
				redirect('pembimbing');					
				}


			} else {
				$this->session->set_flashdata('alert', 'epok_f');
				redirect('pembimbing');

			}


		}


		// PASSWORD SISWA
		if( isset($post["eps"]) ){
			$old_s = $post["opass_s"];
			$nps = $post["npass_s"];
			$knps = $post["knpass_s"];
			// CHECK PASS LAMA SISWA
			$query = $this->db->query("SELECT * FROM `siswa` WHERE id_siswa = ?", $_SESSION["id_user"]);

			$hash = $query->row_array()["password"];
			
			if( password_verify($old_s, $hash) ){

				if( $nps != $knps ){
				$this->session->set_flashdata('alert', 'c_fail');
				redirect('siswa');					
				}

				$hashed = password_hash($nps, PASSWORD_DEFAULT);
				$query = $this->db->query("UPDATE `siswa` SET password = ? WHERE id_siswa = ?", array($hashed, $_SESSION["id_user"]));

				if( $query ){
				$this->session->set_flashdata('alert', 'spk');
				redirect('siswa');					
				}


			} else {
				$this->session->set_flashdata('alert', 'epok_f');
				redirect('siswa');

			}


		}


	}

	// QUERY SANTUY

	public function q($sql){
		$query = $this->db->query($sql);

		return $query->row_array();
	}


	public function count_row($sql, $bind){
		$count = $this->db->query($sql, $bind)->num_rows();

		return $count;
	}

}