<?php 

$start = $_GET["start"];
$end = $_GET["end"];

$x = range($start, $end);

var_dump($x);

 ?>

<div class="modal fade" id="buatASB" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Buat Banyak Akun Siswa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form method="POST">



	<?php for( $i = 0; $i <= count($x); $i++ ) : ?>

	<div class="form-group">
		<label for="<?= $x[$i] ?>">Masukan Nama untuk akun <?= $x[$i]  ?></label>
		<input type="text" name="name_<?= $i?>" placeholder="<?= $x[$i]; ?>" id="<?= $x[$i] ?>">           
    </div>

	<?php endfor; ?>          

         
          <button type="button" class="btn btn-primary" id="nxt-2">Next</button>  

          
        </form>
          


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
      </div>
    </div>
  </div>
</div>

