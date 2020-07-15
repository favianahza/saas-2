<!DOCTYPE html>
<html lang="en">
  <head>
	    <meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link href="https://fonts.googleapis.com/css?family=Lato|Lobster|Poppins&display=swap" rel="stylesheet">
<!-- 	    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="<?= base_url() . 'css/bootstrap.css'; ?>">
	    <link rel="stylesheet" type="text/css" href="<?= base_url() . 'css/custom.css'; ?>">
	    <title><?= $title; ?></title>
	    <link rel="stylesheet" type="text/css" href="<?= base_url() . 'css/' . $css; ?>">
  </head>
  <body>
  <?php if( $this->session->flashdata('alert') ) : ?>
    <div id="alert" data-alerts="<?= $this->session->flashdata('alert') ?>">
      
    </div>
  <?php endif; ?>
      <div id="animation"></div>
  <nav class="navbar navbar-light bg-transparent navbar-expand-sm gd-green shadow" style="z-index: 10;">
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

  <!-- KEPALA BENGKEL DASHBOARD -->
  <?php if( isset($_SESSION["logged_in"]) && isset($_SESSION["kabeng"]) ) : ?>
  <div class="row bg-mute br-dmute px-4 py-4">
    <div class="container-fluid ">
      <div class="row px-3">

        <div class="col-md-3">
          <button type="button" class="btn btn-gblue btn-lg btn-block text-uppercase f-poppins h-100" id="n1">Data Siswa</button></a>
        </div>

        <div class="col-md-3">
          <button type="button" class="btn btn-ggreen btn-lg btn-block text-uppercase f-poppins h-100" id="n2">Data Pembimbing</button></a>
        </div>

        <div class="col-md-3">
          <button type="button" class="btn btn-gyellow btn-lg btn-block text-uppercase f-poppins h-100" id="n3">File Siswa</button></a>
        </div>

        <div class="col-md-3">
          <button type="button" class="btn btn-gpink btn-lg btn-block text-uppercase f-poppins h-100" id="n4">Pembagian Pembimbing</button></a>
        </div>

      </div>
    </div>
  </div>
  <?php endif; ?>




  <!-- PEMBIMBING DASHBOARD -->
  <?php if( isset($_SESSION["logged_in"]) && isset($_SESSION["pembimbing"]) ) : ?>
  <div class="row bg-mute br-dmute px-4 py-4">
    <div class="container-fluid ">
      <div class="row px-3">

        <div class="col-md-3 mx-auto">
          <button type="button" class="btn btn-gblue btn-lg btn-block text-uppercase f-poppins h-100" id="n1">Data Siswa</button></a>
        </div>

        <div class="col-md-3 mx-auto">
          <button type="button" class="btn btn-gyellow btn-lg btn-block text-uppercase f-poppins h-100" id="n2">File Siswa</button></a>
        </div>

        <div class="col-md-3 mx-auto">
          <button type="button" class="btn btn-gpink btn-lg btn-block text-uppercase f-poppins h-100" id="n3">Persetujuan</button></a>
        </div>

      </div>
    </div>
  </div>
  <?php endif; ?>




  <!-- SISWA DASHBOARD -->
  <?php if( isset($_SESSION["logged_in"]) && isset($_SESSION["siswa"]) ) : ?>
  <div class="row bg-mute br-dmute px-4 py-4">
    <div class="container-fluid ">
      <div class="row px-3">

        <div class="col-md-3 mx-auto">
          <button type="button" class="btn btn-gblue btn-lg btn-block text-uppercase f-poppins h-100" id="n1">Data Siswa</button></a>
        </div>

        <div class="col-md-3 mx-auto">
          <button type="button" class="btn btn-ggreen btn-lg btn-block text-uppercase f-poppins h-100" id="n2">Upload File</button></a>
        </div>

      </div>
    </div>
  </div>
  <?php endif; ?>