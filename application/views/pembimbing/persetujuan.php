<style type="text/css">
	.badge {
		cursor: pointer !important;
	}
</style>
<div class="container-fluid py-3">
	<div class="row">
		<div class="col">
			<h3 class="mb-3 text-center">Persetujuan Siswa</h3>
		</div>
	</div>
	<table class="table table-striped table-bordered">
	  <thead class="text-center">
	    <tr>
	      <th scope="col" class="align-middle">NIS</th>
	      <th scope="col" class="align-middle">NAMA</th>
	      <th scope="col" class="align-middle">KELAS</th>
	      <th scope="col" class="align-middle">PEMBIMBING</th>
	      <th scope="col" class="align-middle">PERSYARATAN</th>
	      <th scope="col" class="align-middle">PERSETUJUAN</th>
	    </tr>
	  </thead>
	  <tbody class="text-center">
	  	<?php foreach($students as $student) : ?>
	  	<?php $id = $student["id_siswa"]; ?>
	    <tr>

	      <th scope="row" style="width: 3%" class="align-middle"><?= xss($student["NIS"]) ?></th>

	      <td class="align-middle" style="width: 15%"><?= xss($student["nama"]) ?></td>

	      <td class="align-middle" style="width: 5%;"><?= xss($student["kelas"]) ?></td>

	      <td class="align-middle" style="width: 15%;"><?= xss($student["pembimbing"]) ?></td>

	      <?php if( $student["nv"] == 0 ) : ?>
	      <td class="align-middle" style="width: 5%"><span class="badge badge-success py-2 px-3">SUDAH MEMENUHI</span></td>	      
	      <?php else:?>
	      <td class="align-middle" style="width: 5%"><span class="badge badge-danger py-2 px-3">BELUM MEMENUHI</span></td>
	  	  <?php endif; ?>
	  	  
	      <?php if( $student["persetujuan"] == 0 || $student["persetujuan"] == NULL) : ?>
	      <td class="align-middle" style="width: 16%"><span class="badge badge-info py-2 px-3" id="<?= 'STJ-'.$student["nv"].'-'.$id ?>">SETUJUI ?</span></td>	      
	      <?php else:?>
	      <td class="align-middle" style="width: 16%"><span class="badge badge-success py-2 px-3">SUDAH DISETUJUI</span></td>	      
	  	  <?php endif; ?>



	    </tr>

		<?php endforeach; ?>
	   </tbody>
	</table>
		<div class="row">
			<div class="col">
				<ul class="pagination justify-content-center">
				<?php for($i = 1; $i <= $pages; $i++) : ?>
					  <li class="page-item" style="cursor: pointer;" data-pages="<?= $i ?>" id="link-page-<?= $i; ?>"><p class="page-link"><?= $i ?></p></li>
				<?php endfor; ?>
				</ul>
			</div>
		</div>	
</div>
<script type="text/javascript" src="<?= base_url().'js/persetujuan.js' ?>"></script>