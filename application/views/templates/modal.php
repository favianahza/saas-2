
<!-- MODAL BUAT AKUN -->
<div class="modal fade" id="buatAkun" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Buat Akun</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      	<div class="row">
      		<div class="col-6 mx-auto">
        	<button type="button" class="btn btn-primary btn-block py-3 h-100" data-toggle="modal" data-target="#buatAS"><h5>AKUN SISWA</h5></button>
        	</div>
        </div>

        <div class="row mt-4">
        	<div class="col-6 mx-auto">
        	<button type="button" class="btn btn-primary btn-block py-3 h-100" data-toggle="modal" data-target="#buatAP"><h5>AKUN PEMBIMBING</h5></button>
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
				<select class="form-control" name="kelas" id="Kelas" required>
  					<option selected disabled>Pilih Kelas Siswa</option>
  					<option value="XIII-A">XIII-A</option>
  					<option value="XIII-B">XIII-B</option>
  					<option value="XIII-C">XIII-C</option>
  					<option value="XIII-D">XIII-D</option>
				</select>
          </div>

          <div class="form-group">
            <label for="NIS" class="col-form-label">NIS</label>
            <input type="text" class="form-control" id="NIS" name="nis" required placeholder="Masukan NIS Siswa" autocomplete="off" maxlength="9" onkeypress="isInputNumber(event);">
          </div>

          <div class="form-group">
            <label for="Password" class="col-form-label">Password</label>
            <input type="password" class="form-control" id="Password" name="password" required placeholder="Masukan Password" autocomplete="off">
          </div>

          <div class="form-group">
            <label for="KPassword" class="col-form-label">Konfirmasi Password</label>
            <input type="password" class="form-control" id="KPassword" name="kpassword" required placeholder="Masukan Konfirmasi Password" autocomplete="off">
          </div>

          <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" id="spass" name="spass">
              <label class="custom-control-label" for="spass" style="cursor: pointer;">Tampilkan Password</label>
          </div>

        <div class="custom-control custom-checkbox mt-3">
            <input type="checkbox" class="custom-control-input" id="repeat" name="repeat" value="1">
            <label class="custom-control-label" for="repeat" style="cursor: pointer;">Buat Akun Siswa Lagi ?</label>
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
            <input class="form-control" type="password" id="password" name="password" required placeholder="Masukan Password" autocomplete="off">
        </div>

        <div class="form-group">
            <label for="KPassword" class="col-form-label">Konfirmasi Password</label>
            <input class="form-control" type="password" id="Kpassword" name="kpassword" required placeholder="Masukan Konfirmasi Password" autocomplete="off">
        </div>

        <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="show" name="show">
            <label class="custom-control-label" for="show" style="cursor: pointer;">Tampilkan Password</label>
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
<script type="text/javascript">
// CHECK NUMBER
// IS INPUT NUMBER ?
 function isInputNumber(evt){
                
    var ch = String.fromCharCode(evt.which);
            
        if(!(/[0-9]/.test(ch))){
        evt.preventDefault();
    }                
}

$(function() {


    // SHOW PASSWORD SISWA
    var pass = $('#Password');
    var kpass = $('#KPassword');
    $('#spass').on('click', function(){

    if ( pass.attr('type') == 'password' && kpass.attr('type') == 'password' ) {

      pass.attr('type', 'text'); kpass.attr('type', 'text');

    } else {

      pass.attr('type', 'password'); kpass.attr('type', 'password');

    }

    });


    // SHOW PASSWORD PEMBIMBING
    var pAss = $('#password');
    var kPass = $('#Kpassword');
    $('#show').on('click', function(){

    if ( pAss.attr('type') == 'password' && kPass.attr('type') == 'password' ) {

      pAss.attr('type', 'text'); kPass.attr('type', 'text');

    } else {

      pAss.attr('type', 'password'); kPass.attr('type', 'password');

    } });

    /// ALIGN MODALLL
    function alignModal(){

        var modalDialog = $(this).find(".modal-dialog");

        /* Applying the top margin on modal dialog to align it vertically center */

        modalDialog.css({"margin-top": Math.max(0, ($(window).height() - modalDialog.height()) / 2),
          "transition":'.1s'
        });

    }

    // Align modal when it is displayed

    $(".modal").on("shown.bs.modal", alignModal);

    

    // Align modal when user resize the window

    $(window).on("resize", function(){

        $(".modal:visible").each(alignModal);

    });   

});
</script>