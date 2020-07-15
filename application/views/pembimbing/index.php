<div class="container-fluid">
	<div id="content">
		<div class="container-fluid">
	<div id="content">
		<div class="container-fluid py-3">
		<h1 class="text-center f-poppins mt-0 mb-2">Data Pembimbing</h1>
			<div class="row mt-3">
				<div class="col mx-auto">
					<img src="<?= base_url().'img/pembimbing/'.$acc["foto"] ?>" class="d-block mx-auto rounded-circle shadow" width="450" height="450">
				</div>
				<div class="col my-auto">
					<table class="w-100">
						<tr>
							<td colspan="3"><h2>Halo, <?= $acc["nama"] ?></h2></td>
						</tr>

						<tr>
							<td colspan="3"><h5>Anda merupakan Pembimbing Jurusan <?= $acc["jurusan"]; ?></h5></td>
						</tr>

						<tr>
							<td><h5 style="cursor: pointer;">Siswa yang Dibimbing : <span class="badge badge-success h-100" data-toggle="modal" data-target="#showSiswa">KLIK DISINI <i class="fa fa-hand-pointer-o"></i></span></h5></td>
						</tr>
					</table>
				</div>		
			</div>
		</div>		
	</div>
</div>
	</div>
</div>

<div class="modal fade" id="showSiswa" tabindex="-1" role="dialog" aria-labelledby="showSiswa" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="showSiswa">Siswa yang Dibimbing</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
			<?php for($i=0; $i < count($siswa); $i++ ) : ?>
				<p><?= $siswa[$i]["nama"]; ?></p>
			<?php endfor; ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
