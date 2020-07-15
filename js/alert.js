let flashData = $('#alert').attr('data-alerts');


switch(flashData){
	// KABENG ALERT
	// KABENG - CONFIRMATION FAIL
	case 'p_confirm_fail':
	Swal.fire({
		title: 'Daftar Gagal',
		text: 'Konfirmasi Password yang dimasukan Salah !',
		icon: 'error'
	});
	break;

	// KABENG - ALREADY EXIST
	case 'jurusan_fail':
	Swal.fire({
		title: 'Daftar Gagal',
		text: 'Kepala Bengkel Jurusan sudah Ada !',
		icon: 'error'
	});	
	break;


	// KABENG - USERNAME FAIL
	case 'user_fail':
	Swal.fire({
		title: 'Daftar Gagal',
		text: 'Username yang dimasukan telah digunakan !',
		icon: 'error'
	});		
	break;

	// KABENG REGISTER SUCCESS	
	case 'register_kabeng':
	Swal.fire({
		title: 'Daftar Berhasil',
		text: 'Silahkan Login !',
		icon: 'success'
	});		
	break;

	// KABENG LOGIN - NO USERNAME
	case 'no_username_k':
	Swal.fire({
		title: 'Login Gagal',
		text: 'Username yang dimasukan tidak terdaftar !',
		icon: 'error'
	});		
	break;

	// KABENG LOGIN - FAIL PASSWORD
	case 'fail_pass_k':
	Swal.fire({
		title: 'Login Gagal',
		text: 'Password yang dimasukan Salah !',
		icon: 'error'
	});		
	break;



	// SISWA ALERT
	// SISWA LOGIN - NO NIS
	case 'no_nis':
	Swal.fire({
		title: 'Login Gagal',
		text: 'NIS yang dimasukan tidak terdaftar !',
		icon: 'error'
	});		
	break;	

	// SISWA LOGIN - FAIL PASS
	case 'fail_pass_s':
	Swal.fire({
		title: 'Login Gagal',
		text: 'Password yang dimasukan Salah !',
		icon: 'error'
	});		
	break;	

	// SISWA REGISTER SUCCESS
	case 'register_siswa':
	Swal.fire({
		title: 'Berhasil !',
		text: 'Berhasil Membuat Akun Siswa',
		icon: 'success'
	});		
	break;

	// SISWA REGISTER FAIL
	case 'register_siswa_f':
	Swal.fire({
		title: 'Gagal !',
		text: 'Gagal Membuat Akun Siswa',
		icon: 'success'
	});		
	break;

	// SISWA LOGIN - NIS USED
	case 'nis_used':
	Swal.fire({
		title: 'Gagal !',
		text: 'NIS yang dimasukan sudah Digunakan !',
		icon: 'error'
	});		
	break;	

	// SISWA LOGIN - PASSWORD CONFIRM
	case 'p_confirm_fail_s':
	Swal.fire({
		title: 'Gagal !',
		text: 'Konfirmasi Password yang dimasukan Salah !',
		icon: 'error'
	});		
	break;	

	// SISWA CONFIRMED
	case 's_accepted':
	Swal.fire({
		title: 'Selamat',
		text: 'Anda Telah Disetujui Untuk Melakukan Sidang !',
		icon: 'success'
	});		
	break;		



	// PEMBIMBING ALERT
	// PEMBIMBING REGISTER SUCCESS
	case 'register_pembimbing':
	Swal.fire({
		title: 'Berhasil !',
		text: 'Berhasil Membuat Akun Pembimbing',
		icon: 'success'
	});		
	break;

	// PEMBIMBING REGISTER FAIL
	case 'register_siswa':
	Swal.fire({
		title: 'Gagal !',
		text: 'Gagal Membuat Akun Pembimbing',
		icon: 'error'
	});		
	break;

	// PEMBIMBING USERNAME USED
	case 'username_used':
	Swal.fire({
		title: 'Gagal !',
		text: 'Username yang dimasukan sudah Digunakan !',
		icon: 'error'
	});		
	break;

	// EDIT AKUN BERHASIL
	case 'edit_acc_t':
	Swal.fire({
		title: 'Edit Akun Berhasil',
		icon: 'success'
	});		
	break;	

	// EDIT AKUN GAGAL
	case 'edit_acc_f':
	Swal.fire({
		title: 'Edit Akun Berhasil',
		icon: 'success'
	});		
	break;	


	// UPLOAD TRUE
	case 'upload_t':
	Swal.fire({
		title: 'Upload Berhasil !',
		icon: 'success'
	});		
	break;	

	// UPLOAD FALSE
	case 'upload_f':
	Swal.fire({
		title: 'Upload Gagal !',
		icon: 'error'
	});		
	break;	

	// DEADLINE
	case 'deadline':
	Swal.fire({
		title: 'Upload Gagal !',
		html: 'Anda telah melewati <b>DEADLINE</b> !',
		icon: 'error'
	});		
	break;	


	// PASS EDIT
	case 'epok_f':
	Swal.fire({
		title: 'Gagal !',
		text: 'Password Lama yang dimasukan Salah !',
		icon: 'error'
	});		
	break;		

	case 'c_fail':
	Swal.fire({
		title: 'Gagal !',
		text: 'Konfirmasi Password yang dimasukan tidak sama !',
		icon: 'error'
	});		
	break;		

	case 'spk':
	Swal.fire({
		title: 'Berhasil !',
		text: 'Password telah Diganti !',
		icon: 'success'
	});		
	break;		

	case 'f_format':
	Swal.fire({
		title: 'Gagal !',
		text: 'Yang anda Upload Bukan Gambar !',
		icon: 'error'
	});		
	break;			

	case 'invalid_f':
	Swal.fire({
		title: 'Upload Gagal !',
		text: 'Upload File yang formatnya sudah Ditentukan !',
		icon: 'error'
	});
	break;

	case 'repeat':
	$('#buatAS').modal('show');
	break;

}
