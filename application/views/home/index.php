<!DOCTYPE html>
<html lang="en">
  <head>
	    <meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		  <link href="https://fonts.googleapis.com/css?family=Lato|Lobster|Poppins&display=swap" rel="stylesheet">
	    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"> -->
	    <link rel="stylesheet" type="text/css" href="<?= base_url() . 'css/custom.css'; ?>">
	    <title>Sipulan - Sistem Pengumpulan Laporan Online</title>
	    <link rel="stylesheet" type="text/css" href="<?= base_url() . 'css/index.css'; ?>">
          <link rel="stylesheet" type="text/css" href="<?= base_url() . 'css/bootstrap.css'; ?>">

  </head>
  <body>

  <?php if( $this->session->flashdata('alert') ) : ?>
    <div id="alert" data-alerts="<?= $this->session->flashdata('alert') ?>">
      
    </div>
  <?php endif; ?>

  <div class="top gd-green">

  <nav class="navbar navbar-light bg-transparent navbar-expand-sm gd-green" style="z-index: 10;">
        <div class="container-fluid px-4">
          <a class="navbar-brand f-lobster" href="<?= base_url() . 'home/index' ?>"><span class="h1">Sipulan</span></a>
          <button class="navbar-toggler" data-toggle="collapse" data-target="#navMenu">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navMenu">
            <ul class="navbar-nav ml-auto f-lato">



              <!-- ANONYMOUS -->
            <?php if( !isset($_SESSION["logged_in"]) ) : ?>

              <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    LOG IN
                  </a>
                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown" id="e1">
                      <a class="dropdown-item" href="<?= base_url().'home/login_s' ?>">Siswa</a>
                      <a class="dropdown-item" href="<?= base_url().'home/login_p' ?>">Pembimbing</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="<?= base_url().'home/login_k' ?>">Kepala Bengkel</a>
                  </div>
                </li>
              <li class="nav-item"><a href="<?= base_url() . 'home/register' ?>" class="nav-link text-light">REGISTER</a></li>    



              <!-- KEPALA BENGKEL -->
              <?php elseif( isset($_SESSION["logged_in"]) && isset($_SESSION["kabeng"]) ) : ?>

              <li class="nav-item my-auto text-dark"><button type="button" class="btn btn-light shadow" data-toggle="modal" data-target="#buatAkun" id="b1">TAMBAH AKUN</button></li>

              <li class="nav-item my-auto ml-3 mr-2"><a href="<?= base_url() . 'kabeng'  ?>" class="text-dark" style="text-decoration: none;"><button type="button" class="btn btn-light shadow" id="b2">DASHBOARD</button></a></li>

              <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="<?= base_url() . 'img/user/' . $acc["foto"] ?>" class="rounded-circle shadow" width="50" height="50">
                  </a>
                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink" id="e2">
                      <a class="dropdown-item" href="#" data-toggle="modal" data-target="#editKabeng">Edit Akun</a>
                      <a class="dropdown-item" href="#" data-toggle="modal" data-target="#epK">Edit Password</a>
                      <a class="dropdown-item" href="<?= base_url() . 'home/logout' ?>" class="nav-link text-light">Logout</a>
                  </div>
              </li>   
            


              <!-- SISWA -->
              <?php elseif( isset($_SESSION["logged_in"]) && isset($_SESSION["siswa"]) ) : ?>

              <li class="nav-item my-auto"><a href="<?= base_url() . 'siswa/upload_files'  ?>" class="text-dark" style="text-decoration: none;"><button type="button" class="btn btn-light shadow" id="b2">UPLOAD FILE</button></a></li>

              <li class="nav-item my-auto ml-3 mr-2"><a href="<?= base_url() . 'siswa'  ?>" class="text-dark" style="text-decoration: none;"><button type="button" class="btn btn-light shadow" id="b2">DASHBOARD</button></a></li>

            <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="<?= base_url() . 'img/siswa/' . $acc["foto"] ?>" class="rounded-circle shadow" width="50" height="50">
                  </a>
                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink" id="e2">
                      <a class="dropdown-item" href="#" data-toggle="modal" data-target="#editSiswa">Edit Akun</a>
                      <a class="dropdown-item" href="#" data-toggle="modal" data-target="#epS">Edit Password</a>
                      <a class="dropdown-item" href="<?= base_url() . 'home/logout' ?>" class="nav-link text-light">Logout</a>
                  </div>
              </li>   



              <?php else: ?>

              <li class="nav-item my-auto"><a href="<?= base_url() . 'pembimbing/lihat_siswa'  ?>" class="text-dark" style="text-decoration: none;"><button type="button" class="btn btn-light shadow" id="b2">LIHAT SISWA</button></a></li>

              <li class="nav-item my-auto ml-3 mr-2"><a href="<?= base_url() . 'pembimbing'  ?>" class="text-dark" style="text-decoration: none;"><button type="button" class="btn btn-light shadow" id="b2">DASHBOARD</button></a></li>

            <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="<?= base_url() . 'img/pembimbing/' . $acc["foto"] ?>" class="rounded-circle shadow" width="50" height="50">
                  </a>
                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink" id="e2">
                      <a class="dropdown-item" href="#" data-toggle="modal" data-target="#editPembimbing">Edit Akun</a>
                      <a class="dropdown-item" href="#" data-toggle="modal" data-target="#epP">Edit Password</a>
                      <a class="dropdown-item" href="<?= base_url() . 'home/logout' ?>" class="nav-link text-light">Logout</a>
                  </div>
              </li>   

              <?php endif; ?>
            </ul>
          </div>
        </div>
  </nav>

		<div class="container-fluid">
	  		<div class="row p-4 text-center text-md-left">
	  			<div class="col-12 col-md-6 align-self-center pl-md-5" id="top-text">
	  				<h3 class="f-poppins font-weight-bolder d-inline-block mb-2">Sistem Pengumpulan Laporan Online</h3>
	  				<h5 class="mb-4">Kumpulkan dimana saja, Kapan saja.</h5>
	  				<img src="<?= base_url() . 'img/icon.png' ?>" class="img-fluid d-sm-inline-block d-md-none mb-2 text" id="icon">
	  				<a href="#" class="c-dblue"><h5 class="d-none d-md-inline-block bg-silver pt-2 pb-3 px-5 mt-3" id="signUp">Sign Up</h5></a>
	  			</div>
	  			<div class="col-12 col-md-6 text-center align-self-center">
	  				<img src="<?= base_url() . 'img/icon.png' ?>" class="img-fluid  d-none d-md-inline-block" id="icon">
	  				<a href="#" class="c-dblue"><h5 class="d-inline-block d-md-none bg-silver pt-2 pb-3 px-5 mt-3" id="signUp">Sign Up</h5></a>
	  			</div>
	  			<div class="col-12">
	  				
	  			</div>
	  		</div>
	  	</div>

		</div>

		<div class="middle container-fluid">
			<div class="row text-center">
				<div class="col-10 p-3 offset-1 mid-text">
					<h2 class="text-center font-weight-bolder f-lato">Dibuat untuk memudahkan.</h2>
					<p class="text-center">Bisa diakses kapan saja dan dimana saja. Sudah Responsive layak dilihat diperangkat apapun !</p>
				</div>
			</div>
			<div class="row">
				<div class="col">
					<hr>
				</div>
			</div>
			<div class="row">
				<div class="col-md">
					
				</div>
				<div class="col-md">
					
				</div>
			</div>
			<div class="row text-center">
				<div class="col">
					<a href="about.php">About Me</a>
				</div>
			</div>
		</div>

  </div>



<?php if( isset($_SESSION["logged_in"]) && isset($_SESSION["kabeng"]) ) : ?>

<!-- MODAL BUAT AKUN -->
<div class="modal fade" id="buatAkun" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-center" id="exampleModalLongTitle">Buat Akun</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      	<div class="row">
      		<div class="col-6 mx-auto">
        	<button type="button" class="btn btn-primary btn-block py-3" data-toggle="modal" data-target="#buatAS"><h5>AKUN SISWA</h5></button>
        	</div>
        </div>

        <div class="row mt-4">
        	<div class="col-6 mx-auto">
        	<button type="button" class="btn btn-primary btn-block py-3" data-toggle="modal" data-target="#buatAP"><h5>AKUN PEMBIMBING</h5></button>
        	</div>
        </div>	
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>  




<!-- MODAL DAFTAR SISWA -->
<div class="modal fade" id="buatAS" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Buat Akun Siswa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form method="POST">

          <input type="hidden" name="jurusan" value="<?= $_SESSION['jurusan']; ?>">

          <div class="form-group">
            <label for="Nama" class="col-form-label">Nama Siswa</label>
            <input type="text" class="form-control" id="Nama" name="nama" required placeholder="Masukan Nama Siswa" autocomplete="off">
          </div>

          <div class="form-group">
            <label for="Kelas" class="col-form-label">Kelas Siswa</label>
				<select class="form-control" name="kelas" id="Kelas">
  					<option selected disabled>Pilih Kelas Siswa</option>
  					<option value="XIII-A">XIII-A</option>
  					<option value="XIII-B">XIII-B</option>
  					<option value="XIII-C">XIII-C</option>
  					<option value="XIII-D">XIII-D</option>
				</select>
          </div>

          <div class="form-group">
            <label for="NIS" class="col-form-label">NIS</label>
            <input type="text" class="form-control" id="NIS" name="nis" required placeholder="Masukan NIS Siswa" autocomplete="off">
          </div>

          <div class="form-group">
            <label for="Password" class="col-form-label">Password</label>
            <input type="password" class="form-control" id="Password" name="password" required placeholder="Masukan Password" autocomplete="off">
          </div>

          <div class="form-group">
            <label for="KPassword" class="col-form-label">Konfirmasi Password</label>
            <input type="password" class="form-control" id="KPassword" name="kpassword" required placeholder="Masukan Konfirmasi Password" autocomplete="off">
          </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
        <button type="submit" class="btn btn-primary" name="buat_as">Buat</button>
        </form>
      </div>
    </div>
  </div>
</div>




<!-- MODAL DAFTAR PEMBIMBING -->
<div class="modal fade" id="buatAP" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Buat Akun Pembimbing</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form method="POST">

       	<input type="hidden" name="jurusan" value="<?= $_SESSION['jurusan']; ?>">

       	<div class="form-group">
            <label for="Nama" class="col-form-label">Nama Pembimbing</label>
            <input type="text" class="form-control" id="Nama" name="nama" required placeholder="Masukan Nama Pembimbing" autocomplete="off">
        </div>

        <div class="form-group">
            <label for="Username" class="col-form-label">Username</label>
            <input type="text" class="form-control" id="Username" name="username" required placeholder="Masukan Username Pembimbing" autocomplete="off">
        </div>

        <div class="form-group">
            <label for="Password" class="col-form-label">Password</label>
            <input class="form-control" type="password" id="Password" name="password" required placeholder="Masukan Password" autocomplete="off">
        </div>

        <div class="form-group">
            <label for="KPassword" class="col-form-label">Konfirmasi Password</label>
            <input class="form-control" type="password" id="KPassword" name="kpassword" required placeholder="Masukan Konfirmasi Password" autocomplete="off">
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
        <button type="submit" class="btn btn-primary" name="buat_ap">Buat</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php endif; ?>

		<script type="text/javascript">
		var navs = document.querySelector('nav.navbar div.container-fluid');
		var mids = document.querySelector('div.mid-text');


		setTimeout(function(){
			navs.style.animation = 'floatDown 1s'
			navs.style.animationFillMode = 'forwards';
		} , 700)

		setTimeout(function(){
			mids.style.animation = 'floatUp 1s';
			mids.style.animationFillMode = 'forwards';
		}, 900);
		</script>