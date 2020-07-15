  <?php if( $this->session->flashdata('alert') ) : ?>
    <div id="alert" data-alerts="<?= $this->session->flashdata('alert') ?>">
      
    </div>
  <?php endif; ?>
<div class="container my-5">
	<div class="row">
		<div class="col-8 col-md-6 col-lg-4 offset-2 offset-md-3 offset-lg-4 px-5 pt-2 py-4 rounded my-5" id="formContainer">
			<form method="post">

				<div class="row">
					<div class="col text-center">
						<h5 class="text-secondary">Login Kepala Bengkel</h5>
					</div>
				</div>
				
					<div class="form-group mt-2">
						<label for="Username" class="text-left text-secondary">Username</label>
						<input type="text" name="username" class="form-control form-control-md" autocomplete="off" id="Username" placeholder="Masukan Username">
					</div>

					<div class="form-group">
						<label for="Password" class="text-left text-secondary">Password</label>
						<input type="password" name="password" class="form-control form-control-md" autocomplete="off" id="Password" placeholder="Masukan Password">
					</div>

					<div class="col text-center">
						<div class="custom-control custom-checkbox">
      						<input type="checkbox" class="custom-control-input" id="cookie" name="cookie">
      						<label class="custom-control-label" for="cookie" style="cursor: pointer;">Remember Me</label>
    					</div>
    				</div>

					<div class="col text-center">
						  <div class="form-group">
							<button type="submit" id="button" class="btn mt-4 text-center py-2 px-4 font-weight-bold">Log In</button>
						  </div>
					</div>
			</form>
		</div>
	</div>
</div>