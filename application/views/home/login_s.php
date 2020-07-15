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
						<h5 class="text-secondary">Login Siswa</h5>
					</div>
				</div>
				
					<div class="form-group mt-2">
						<label for="NIS" class="text-left text-secondary">NIS</label>
						<input type="text" name="nis" class="form-control form-control-md" autocomplete="off" id="NIS" placeholder="Masukan NIS" maxlength="9" onkeypress="isInputNumber(event)">
					</div>

					<div class="form-group">
						<label for="Password" class="text-left text-secondary">Password</label>
						<input type="password" name="pass" class="form-control form-control-md" autocomplete="off" id="Password" placeholder="Masukan Password">
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

					<div class="col text-center">
						<a href="<?= base_url().'home/login_p' ?>" class="text-center">Bukan Siswa ?</a>
					</div>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript">
	
 function isInputNumber(evt){
                
    var ch = String.fromCharCode(evt.which);
            
        if(!(/[0-9]/.test(ch))){
        evt.preventDefault();
    }                
}
</script>