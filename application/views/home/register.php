 <?php if( $this->session->flashdata() ) : ?>
    <div id="alert" data-alerts="<?= $this->session->flashdata('alert') ?>">
     
    </div>
  <?php endif; ?>
<?php echo form_open_multipart('home/register');?>
<div class="container my-5">
	<div class="row">
		<div class="col-8 col-md-7 col-lg-6 offset-2 offset-md-3 offset-lg-3 px-5 pt-2 py-4 rounded my-5 d-block mx-auto" id="formContainer">
			<form method="post" enctype="multipart/form-data">

				<div class="row">
					<div class="col text-center">
						<h3 class="font-weight-bold">DAFTAR</h3>
					</div>
				</div>
				
					<div class="form-group">
						<label for="Nama" class="text-left text-secondary">Nama</label>
						<input type="text" name="nama" class="form-control form-control-md" id="Nama" placeholder="Masukan Nama" required autocomplete="off">
					</div>

					<div class="form-group">
						<label for="Jurusan" class="text-left text-secondary">Jurusan</label>
						<select class="form-control" name="jurusan" id="Jurusan">
  							<option selected disabled>Pilih Jurusan</option>
  							<option value="IOP">IOP</option>
  							<option value="MEKATRONIKA">MEKATRONIKA</option>
  							<option value="PFPT">PFPT</option>
  							<option value="RPL">RPL</option>
  							<option value="SIJA">SIJA</option>
  							<option value="TEDK">TEDK</option>
  							<option value="TEI">TEI</option>
  							<option value="TOI">TOI</option>
  							<option value="TPTU">TPTU</option>
						</select>
					</div>

					<div class="form-group">
						<label for="username" class="text-left text-secondary">Username</label>
						<input type="username" name="username" class="form-control form-control-md" id="username" placeholder="Masukan Username" required autocomplete="off">
					</div>


					<div class="form-group">
						<label for="Password" class="text-left text-secondary">Password</label>
						<input type="password" name="password" class="form-control form-control-md" id="Password" placeholder="Masukan Password" required>
					</div>

					<div class="form-group">
						<label for="KPassword" class="text-left text-secondary">Konfirmasi Password</label>
						<input type="password" name="konfirmasi" class="form-control form-control-md" id="KPassword" placeholder="Masukan Konfirmasi Password" required>
					</div>

					<div class="col text-center">
						<div class="custom-control custom-checkbox">
      						<input type="checkbox" class="custom-control-input" id="spass" name="spass">
      						<label class="custom-control-label" for="spass" style="cursor: pointer;">Tampilkan Password</label>
    					</div>
    				</div>

					<div class="form-group text-center">
						<label for="foto" class="cursor-pointer">
						<img src="<?= base_url(); ?>img/placeholder.jpg" id="preview-img" onclick="triggerClick();" class="cursor-pointer rounded-circle img-fluid shadow">
						</label><br>						
						<p>Foto</p>
						<input type="file" name="foto" id="foto" class="form-control" style="display: none;" onchange="preview(this);">
					</div>

					<div class="col text-center">
						  <div class="form-group">
							<button type="submit" id="daftar" class="btn mt-4 text-center py-2 px-4 font-weight-bold" name="daftar">Daftar</button>
						  </div>
					</div>

			</form>
		</div>
	</div>
</div>