<div class="container-fluid py-3">
	<div class="row">
		<div class="col">
			<h3 class="mb-3 text-center">File Siswa Jurusan <?= $_SESSION["jurusan"] ?></h3>
		</div>
	</div>	
<div class="table-responsive">
	<table class="table table-striped table-bordered">
	  <thead class="text-center">
	    <tr>
	      <th scope="col" class="align-middle">NAMA</th>
	      <th scope="col" class="align-middle">JUDUL LAPORAN</th>
	      <th scope="col" class="align-middle">FILE LAPORAN</th>
	      <th scope="col" class="align-middle">ABSENSI PKL</th>
	      <th scope="col" class="align-middle">AGENDA PKL</th>
	      <th scope="col" class="align-middle">NILAI PKL</th>
	      <th scope="col" class="align-middle">SERTIFIKAT PKL</th>
	    </tr>
	  </thead>
	  <tbody class="text-center">
	  	<?php foreach($files as $file) : ?>

	    <tr>

	      <td class="align-middle" style="width:20%"><?= xss($file["nama"]) ?></td>

	      <?php if( $file["judul_laporan"] == NULL ) : ?>
	      <td class="align-middle" style="width:25%"><span class="badge badge-danger">TIDAK ADA</span></td>
	      <?php else : ?>
	      <td class="align-middle" style="width:25%"><?= xss($file["judul_laporan"]) ?></td>
	  	  <?php endif; ?>

	      <?php if( $file["file_laporan"] == NULL ) : ?>
	      <td class="align-middle"><span class="badge badge-danger">TIDAK ADA <i class="fa fa-times-rectangle"></i></span></td>
	      <?php else : ?>
	      <td class="align-middle"><a href="<?= base_url().'document/'.$file["file_laporan"] ?>"><span class="badge badge-success">LIHAT <i class="fa fa-check-square"></i></span></a></td>
	  	  <?php endif; ?>

	      <?php if( $file["absensi_pkl"] == NULL ) : ?>
	      <td class="align-middle"><span class="badge badge-danger">TIDAK ADA <i class="fa fa-times-rectangle"></i></span></td>
	      <?php else : ?>
	      <td class="align-middle"><a href="<?= base_url().'document/'.$file["absensi_pkl"] ?>"><span class="badge badge-success">LIHAT <i class="fa fa-check-square"></i></span></a></td>
	  	  <?php endif; ?>

	      <?php if( $file["agenda_pkl"] == NULL ) : ?>
	      <td class="align-middle"><span class="badge badge-danger">TIDAK ADA <i class="fa fa-times-rectangle"></i></span></td>
	      <?php else : ?>
	      <td class="align-middle"><a href="<?= base_url().'document/'.$file["agenda_pkl"] ?>"><span class="badge badge-success">LIHAT <i class="fa fa-check-square"></i></span></a></td>
	  	  <?php endif; ?>

	      <?php if( $file["nilai_pkl"] == NULL ) : ?>
	      <td class="align-middle"><span class="badge badge-danger">TIDAK ADA <i class="fa fa-times-rectangle"></i></span></td>
	      <?php else : ?>
	      <td class="align-middle"><a href="<?= base_url().'document/'.$file["nilai_pkl"] ?>"><span class="badge badge-success">LIHAT <i class="fa fa-check-square"></i></span></a></td>
	  	  <?php endif; ?>

	  	  <?php if( $file["sertifikat_pkl"] == NULL ) : ?>
	      <td class="align-middle"><span class="badge badge-danger">TIDAK ADA <i class="fa fa-times-rectangle"></i></span></td>
	      <?php else : ?>
	      <td class="align-middle"><a href="<?= base_url().'document/'.$file["sertifikat_pkl"] ?>"><span class="badge badge-success">LIHAT <i class="fa fa-check-square"></i></span></a></td>
	  	  <?php endif; ?>

	    </tr>

		<?php endforeach; ?>
	   </tbody>
	</table>

</div>
</div>
<div class="row">
	<div class="col">
		<ul class="pagination justify-content-center">
		<?php for($i = 1; $i <= $pages; $i++) : ?>
			  <li class="page-item" style="cursor: pointer;" data-pages="<?= $i ?>" id="link-page-<?= $i; ?>"><p class="page-link"><?= $i ?></p></li>
		<?php endfor; ?>
		</ul>
	</div>
</div>
<script type="text/javascript">
	$('li[id*=link-page-]').on('click', function() {
		let data = $(this).attr('data-pages');
		let p = 0;
		if( data % 2 == 1 ){
			p = ((data * 5)/2) + 2.5;
		} else {
			p = ((data*5)/2);
		}
		if( data == 1 ) p = 0;
		$("#content").load("http://"+window.location.host+"/SaaS-2/index.php/pembimbing/file_siswa/"+p, function(xhr,status) {
			$('li[id*=link-page-]').css('fontWeight', 'normal');
			$('#link-page-'+data).css('fontWeight', 'bold');
			if( xhr == "error" ){
				$("#content").load('data_siswa/'+p);
				$('li[id*=link-page-]').css('fontWeight', 'normal');
				$('#link-page-'+data).css('fontWeight', 'bold');
			}
		});

	});	
</script>