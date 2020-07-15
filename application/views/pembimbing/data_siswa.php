<div class="container-fluid py-3">
	<div class="row">
		<div class="col">
			<h3 class="mb-3 text-center">Data Siswa yang Dibimbing</h3>
		</div>
	</div>
	<div class="table-responsive">
	<table class="table table-striped table-bordered">
	  <thead class="text-center">
	    <tr>
	      <th scope="col" class="align-middle">NIS</th>
	      <th scope="col" class="align-middle">NAMA</th>
	      <th scope="col" class="align-middle">KELAS</th>
	      <th scope="col" class="align-middle">JUDUL LAPORAN</th>
	      <th scope="col" class="align-middle">PERSETUJUAN</th>
	      <th scope="col" class="align-middle">LAINNYA</th>
	    </tr>
	  </thead>
	  <tbody class="text-center">
	  	<?php foreach($students as $student) : ?>

	    <tr>

	      <th scope="row" style="width: 3%" class="align-middle"><?= xss($student["NIS"]) ?></th>

	      <td class="align-middle" style="width: 15%"><?= xss($student["nama"]) ?></td>

	      <td class="align-middle" style="width: 3%;"><?= xss($student["kelas"]) ?></td>

	      <?php if($student["jdl"] == NULL) : ?>
	      <td class="align-middle" style="width: 16%"><span class="badge badge-danger py-2 px-3">BELUM ADA</span></td>	      
	      <?php else:?>
	      <td class="align-middle" style="width: 16%"><?= xss($student["jdl"]) ?></td>
	  	  <?php endif; ?>
	  	  
	      <?php if( $student["persetujuan"] == 0 || $student["persetujuan"] == false) : ?>
	      <td class="align-middle" style="width: 3%"><span class="badge badge-danger py-2 px-3">BELUM DISETUJUI</span></td>	      
	      <?php else:?>
	      <td class="align-middle" style="width: 3%"><span class="badge badge-success py-2 px-3">SUDAH DISETUJUI</span></td>	      
	  	  <?php endif; ?>

	  	  <td class="align-middle" style="width: 3%"><div class="col-8 offset-2">
	  	  	<span class="badge badge-info mr-2 p-2" id="detail-<?= $student['id_siswa'] ?>" data-detail="<?= $student["id_siswa"] ?>" style="cursor: pointer;">DETAIL</span></div>
	  	  </td>

	    </tr>

		<?php endforeach; ?>
	   </tbody>
	</table>
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
			$("#content").load("http://"+window.location.host+"/SaaS-2/index.php/pembimbing/data_siswa/"+p, function(xhr,status) {
				$('li[id*=link-page-]').css('fontWeight', 'normal');
				$('#link-page-'+data).css('fontWeight', 'bold');
				if( xhr == "error" ){
					$("#content").load('lihat_siswa/'+p);
					$('li[id*=link-page-]').css('fontWeight', 'normal');
					$('#link-page-'+data).css('fontWeight', 'bold');
				}
			});

});

$("span[id*=detail-]").on('click', function() {


	let id = $(this).attr('data-detail');

	$("#content").load("http://"+window.location.host+"/SaaS-2/index.php/pembimbing/detail_siswa/"+id, function(status,xhr) {
		if(xhr=="error"){
			$('#content').load("detail_siswa/"+id);
		}
	});

});
</script>