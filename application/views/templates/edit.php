<?php if( isset($_SESSION["siswa"]) && isset($_SESSION["logged_in"]) ) : ?>
<!-- MODAL DAFTAR SISWA -->
<?php 
if( $acc['pembimbing_pkl'] != NULL && $acc['id_pembimbing'] != NULL && $acc['tempat_pkl'] != NULL && $acc['tgl_pkl'] != NULL && $acc['lama_pkl'] != NULL) {

  $dis = true;
} else {
  $dis = false;
}
?>
<div class="modal fade" id="editSiswa" tabindex="-1" role="dialog" aria-labelledby="editSiswa" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content px-3">
      <div class="modal-header">
        <h5 class="modal-title" id="editSiswa">Edit Data Siswa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form method="POST" enctype="multipart/form-data">

          <input type="hidden" name="id_user" value="<?= $_SESSION['id_user']; ?>">
          <input type="hidden" name="foto_lama" value="<?= $acc['foto']; ?>">
          <input type="hidden" name="deadline_old" value="<?= $acc['deadline']  ?>">
          <div class="form-group">
            <label for="Nama" class="col-form-label">Nama Siswa</label>
            <input type="text" class="form-control" id="Nama" name="nama" placeholder="<?= $acc['nama']; ?>" disabled value="<?= $acc['nama']; ?>">
          </div>

          <div class="form-group">
            <label for="Nama" class="col-form-label">Jurusan</label>
            <input type="text" class="form-control" id="Jurusan" name="jurusan" placeholder="<?= $acc['jurusan']; ?>" disabled value="<?= $acc['jurusan']; ?>">
          </div>

          <div class="form-group">
            <label for="Kelas" class="col-form-label">Kelas Siswa</label>
    				<select class="form-control" name="kelas" id="Kelas" disabled="">
      					<option <?= ($acc["kelas"] == 'XIII-A') ? "selected value='XIII-A' disabled" : "" ?> >XIII-A</option>
      					<option <?= ($acc["kelas"] == 'XIII-B') ? "selected value='XIII-B' disabled" : "" ?> >XIII-B</option>
      					<option <?= ($acc["kelas"] == 'XIII-C') ? "selected value='XIII-C' disabled" : "" ?> >XIII-C</option>
      					<option <?= ($acc["kelas"] == 'XIII-D') ? "selected value='XIII-D' disabled" : "" ?> >XIII-D</option>
    				</select>
          </div>

          <div class="row">
            <div class="col">
              <div class="form-group text-center font-weight-bolder">
                <img src="<?=  base_url().'img/siswa/'.$acc['foto'] ?>" id="preview-img" onclick="triggerClick();" class="cursor-pointer rounded-circle shadow" width="100" height="100" style="cursor: pointer;"><br>
                <label for="foto" class="cursor-pointer">Foto</label>
                <input type="file" name="foto" id="foto" class="form-control" style="display: none;" onchange="preview(this);" required oninvalid="Swal.fire('Tolong Edit Gambar Anda !');">
              </div>
            </div>
          </div>    

          <div class="form-group">
            <label for="Pembimbing" class="col-form-label">Pembimbing Sekolah</label>
            <input type="text" class="form-control" id="Pembimbing" name="pembimbing" disabled placeholder="<?= $acc['pembimbing']; ?>" value="<?= $acc['pembimbing']; ?>" required>
          </div>

          <div class="form-group">
            <label for="Pembimbing_K" class="col-form-label">Pembimbing Perusahaan</label>
            <input type="text" class="form-control" id="Pembimbing_k" name="pembimbing_pkl" placeholder="Masukan Nama Pembimbing Perusahaan" value="<?= $acc['pembimbing_pkl']; ?>" autocomplete="off" <?= ($acc['pembimbing_pkl'] != NULL) ? 'readonly' : 'required' ?>>
          </div>

          <div class="form-group">
            <label for="Tempat_p" class="col-form-label">Tempat Prakerin</label>
            <input type="text" class="form-control" id="Tempat_p" name="tempat_pkl" placeholder="Masukan Nama Tempat Prakerin" value="<?= $acc['tempat_pkl']; ?>" autocomplete="off" <?= ($acc['tempat_pkl'] != NULL) ? 'readonly' : 'required' ?>>
          </div>

          <div class="form-group">
            <label for="Tanggal_p" class="col-form-label">Tanggal Prakerin</label>
            <input type="date" class="form-control" id="Tanggal_p" name="tanggal_pkl" placeholder="<?= $acc['tgl_pkl']; ?>" value="<?= $acc['tgl_pkl']; ?>" autocomplete="off" <?= ($acc['tgl_pkl'] != NULL) ? 'readonly' : 'required' ?> >
          </div>

          <div class="form-group">
            <label for="Lama_p" class="col-form-label">Lama Prakerin</label>
            <input type="text" class="form-control" id="Lama_p" name="lama_pkl" placeholder="Lama Prakerin dalam Bulan" value="<?= $acc['lama_pkl']; ?>" autocomplete="off" maxlength="2" onkeypress="isInputNumber(event)" <?= ($acc['lama_pkl'] != NULL) ? 'readonly' : '' ?>>
          </div>

          <p class="text-center text-danger"><span>Edit Data hanya bisa <b>SEKALI</b></span><br><span>WAJIB MENGEDIT FOTO !</span></p>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
        <?php if(!$dis) : ?>
        <button type="submit" class="btn btn-primary" name="edit_as">Edit</button>          
        <?php else: ?>
        </form>
        <button type="submit" class="btn btn-primary" disabled>Edit</button>        
        <?php endif; ?>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal Siswa -->
<div class="modal fade" id="epS" tabindex="-1" role="dialog" aria-labelledby="epS" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="epS">Edit Password</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form method="POST">
      <div class="modal-body">
          
        <div class="form-group">
            <label for="Password" class="col-form-label">Password Lama</label>
            <input class="form-control" type="password" id="opass_s" name="opass_s" required placeholder="Masukan Password Lama" autocomplete="off">
        </div>

        <div class="form-group">
            <label for="KPassword" class="col-form-label">Password Baru</label>
            <input class="form-control" type="password" id="npass_s" name="npass_s" required placeholder="Masukan Password Baru" autocomplete="off" minlength="4">
        </div>

        <div class="form-group">
            <label for="KPassword" class="col-form-label">Konfirmasi Password Baru</label>
            <input class="form-control" type="password" id="knpass_s" name="knpass_s" required placeholder="Masukan Konfirmasi Password Baru" autocomplete="off" minlength="4">
        </div>

        <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="show_s" name="show_s">
            <label class="custom-control-label" for="show_s" style="cursor: pointer;">Tampilkan Password</label>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <?php if(!$dis) : ?>
        <button type="submit" class="btn btn-primary" name="eps">Edit</button>
        <?php else: ?>
        </form>
        <button type="submit" class="btn btn-primary" disabled>Edit</button>        
        <?php endif; ?>
        </form>
      </div>
    </div>
  </div>
</div>

<?php endif; ?>


<?php if( isset($_SESSION["pembimbing"]) && isset($_SESSION["logged_in"]) ) : ?>
<!-- MODAL EDIT PEMBIMBING -->
<div class="modal fade" id="editPembimbing" tabindex="-1" role="dialog" aria-labelledby="editPembimbing" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editPembimbing">Edit Data Pembimbing</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form method="POST" enctype="multipart/form-data">

       	<input type="hidden" name="jurusan" value="<?= $_SESSION['jurusan']; ?>">
        <input type="hidden" name="id_pembimbing" value="<?= $_SESSION['id_user'] ?>">
        <input type="hidden" name="foto_lama" value="<?= $acc["foto"] ?>">

       	<div class="form-group">
            <label for="Nama" class="col-form-label">Nama Pembimbing</label>
            <input type="text" class="form-control" id="Nama" name="nama" placeholder="<?= $acc["nama"] ?>" autocomplete="off" value="<?= $acc["nama"] ?>" disabled>
        </div>

        <div class="form-group">
            <label for="Jurusan" class="col-form-label">Jurusan</label>
            <input type="text" class="form-control" id="Jurusan" name="jurusan" placeholder="<?= $acc["jurusan"] ?>" autocomplete="off" disabled value="<?= $acc["jurusan"] ?>">
        </div>

        <div class="form-group">
            <label for="jml_siswa" class="col-form-label">Jumlah Siswa yang Dibimbing</label>
            <input type="text" class="form-control" id="jml_siswa" name="nama" placeholder="<?= $acc["jml_siswa"] ?>" autocomplete="off" disabled value="<?= $acc["jml_siswa"] ?>">
        </div>

          <div class="row">
            <div class="col">
              <div class="form-group text-center font-weight-bolder">
                <img src="<?=  base_url().'img/pembimbing/'.$acc['foto'] ?>" id="preview-img" onclick="triggerClick();" class="cursor-pointer rounded-circle shadow" width="100" height="100" style="cursor: pointer;"><br>
                <label for="foto" class="cursor-pointer">Foto</label>
                <input type="file" name="foto" id="foto" class="form-control" style="display: none;" onchange="preview(this);">
              </div>
            </div>
          </div>    

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
        <button type="submit" class="btn btn-primary" name="edit_ap">Edit</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal Pembimbing -->
<div class="modal fade" id="epP" tabindex="-1" role="dialog" aria-labelledby="epP" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="epP">Edit Password</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form method="POST">
      <div class="modal-body">
          
        <div class="form-group">
            <label for="Password" class="col-form-label">Password Lama</label>
            <input class="form-control" type="password" id="opass_p" name="opass_p" required placeholder="Masukan Password Lama" autocomplete="off">
        </div>

        <div class="form-group">
            <label for="KPassword" class="col-form-label">Password Baru</label>
            <input class="form-control" type="password" id="npass_p" name="npass_p" required placeholder="Masukan Password Baru" autocomplete="off" minlength="4">
        </div>

        <div class="form-group">
            <label for="KPassword" class="col-form-label">Konfirmasi Password Baru</label>
            <input class="form-control" type="password" id="knpass_p" name="knpass_p" required placeholder="Masukan Konfirmasi Password Baru" autocomplete="off" minlength="4">
        </div>

        <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="show_p" name="show_p">
            <label class="custom-control-label" for="show_p" style="cursor: pointer;">Tampilkan Password</label>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="epp">Edit</button>
        </form>
      </div>
    </div>
  </div>
</div>


<?php endif; ?>




<?php if( isset($_SESSION["kabeng"]) && isset($_SESSION["logged_in"]) ) : ?>
<!-- MODAL EDIT KABENG -->
<div class="modal fade" id="editKabeng" tabindex="-1" role="dialog" aria-labelledby="editKabeng" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editKabeng">Edit Data Pembimbing</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form method="POST" enctype="multipart/form-data">

        <input type="hidden" name="id_kabeng" value="<?= $_SESSION['id_user'] ?>">
        <input type="hidden" name="foto_lama" value="<?= $acc["foto"] ?>">

        <div class="form-group">
            <label for="Nama" class="col-form-label">Nama Kepala Bengkel</label>
            <input type="text" class="form-control" id="Nama" name="nama" placeholder="<?= $acc["nama"] ?>" autocomplete="off" value="<?= $acc["nama"] ?>">
        </div>

        <div class="form-group">
            <label for="Jurusan" class="col-form-label">Jurusan</label>
            <input type="text" class="form-control" id="Jurusan" name="jurusan" placeholder="<?= $acc["jurusan"] ?>" autocomplete="off" value="<?= $acc["jurusan"] ?>" disabled>
        </div>


          <div class="row">
            <div class="col">
              <div class="form-group text-center font-weight-bolder">
                <img src="<?=  base_url().'img/user/'.$acc['foto'] ?>" id="preview-img" onclick="triggerClick();" class="cursor-pointer rounded-circle shadow" width="100" height="100" style="cursor: pointer;"><br>
                <label for="foto" class="cursor-pointer">Foto</label>
                <input type="file" name="foto" id="foto" class="form-control" style="display: none;" onchange="preview(this);">
              </div>
            </div>
          </div>    

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
        <button type="submit" class="btn btn-primary" name="edit_ak">Edit</button>
        </form>
      </div>
    </div>
  </div>
</div>


<!-- Modal Kabeng -->
<div class="modal fade" id="epK" tabindex="-1" role="dialog" aria-labelledby="epK" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="epK">Edit Password</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST">
          
        <div class="form-group">
            <label for="Password" class="col-form-label">Password Lama</label>
            <input class="form-control" type="password" id="opass_k" name="opass_k" required placeholder="Masukan Password Lama" autocomplete="off">
        </div>

        <div class="form-group">
            <label for="KPassword" class="col-form-label">Password Baru</label>
            <input class="form-control" type="password" id="npass_k" name="npass_k" required placeholder="Masukan Password Baru" autocomplete="off" minlength="4">
        </div>

        <div class="form-group">
            <label for="KPassword" class="col-form-label">Konfirmasi Password Barus</label>
            <input class="form-control" type="password" id="knpass_k" name="knpass_k" required placeholder="Masukan Konfirmasi Password Baru" autocomplete="off" minlength="4">
        </div>

        <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="show_k" name="show_k">
            <label class="custom-control-label" for="show_k" style="cursor: pointer;">Tampilkan Password</label>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="epk">Edit</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php endif; ?>



<script type="text/javascript">


    // SHOW PASSWORD KABENG
    var pass_k = $('#npass_k');
    var kpass_k = $('#knpass_k');
    $('#show_k').on('click', function(){

    if ( pass_k.attr('type') == 'password' && kpass_k.attr('type') == 'password' ) {

      pass_k.attr('type', 'text'); kpass_k.attr('type', 'text');

    } else {

      pass_k.attr('type', 'password'); kpass_k.attr('type', 'password');

    }

    });


    // SHOW PASSWORD PEMBIMBING
    var pass_p = $('#npass_p');
    var kpass_p = $('#knpass_p');
    $('#show_p').on('click', function(){

    if ( pass_p.attr('type') == 'password' && kpass_p.attr('type') == 'password' ) {

      pass_p.attr('type', 'text'); kpass_p.attr('type', 'text');

    } else {

      pass_p.attr('type', 'password'); kpass_p.attr('type', 'password');

    }

    });

    // SHOW PASSWORD SISWA
    var pass_s = $('#npass_s');
    var kpass_s = $('#knpass_s');
    $('#show_s').on('click', function(){

    if ( pass_s.attr('type') == 'password' && kpass_s.attr('type') == 'password' ) {

      pass_s.attr('type', 'text'); kpass_s.attr('type', 'text');

    } else {

      pass_s.attr('type', 'password'); kpass_s.attr('type', 'password');

    }

    });

 function isInputNumber(evt){
                
    var ch = String.fromCharCode(evt.which);
            
        if(!(/[0-9]/.test(ch))){
        evt.preventDefault();
    }                
}

      // PREVIEW PICT
    function triggerClick() {
      document.getElementById('foto').click();
    }

    function preview(e) {
      if(e.files[0]){
        var reader = new FileReader();

        reader.onload = function(e) {
          document.getElementById('preview-img').setAttribute('src', e.target.result);
        }
        reader.readAsDataURL(e.files[0]);
      }
    }  

$(function() {


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