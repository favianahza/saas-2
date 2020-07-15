<style type="text/css">
	option {
		color: black;
	}

	option:first-child {  
		
		color: silver !important;
	}
</style>
<div class="container-fluid py-3">
	<div class="row">
		<div class="col">
			<h3 class="mb-3 text-center">Pembagian Pembimbing Siswa Jurusan <?= $_SESSION["jurusan"] ?></h3>
		</div>
	</div>	
	<table class="table table-striped table-bordered">
	  <thead class="text-center">
	    <tr>
	      <th scope="col" class="align-middle">NIS</th>
	      <th scope="col" class="align-middle">NAMA</th>
	      <th scope="col" class="align-middle">FOTO</th>
	      <th scope="col" class="align-middle">TEMPAT PKL</th>
	      <th scope="col" class="align-middle">PERSETUJUAN</th>
	      <th scope="col" class="align-middle">PEMBIMBING</th>
	    </tr>
	  </thead>
	  <tbody class="text-center">
	  	<?php foreach($students as $student) : ?>
	    <tr>
	      <th scope="row" style="width: 1%" class="align-middle"><?= xss($student["NIS"]) ?></th>

	      <td class="align-middle" style="width: 9%"><?= xss($student["nama"]) ?></td>

	      <td class="align-middle" style="width: 5%"><img src="<?=base_url().'img/siswa/'. xss($student['foto'])?>" width="45" height="45" class="shadow"></td>

	      
		  <?php if( $student["tempat_pkl"] == NULL) : ?>
	      <td class="align-middle" style="width: 12%"><span class="badge badge-danger py-2 px-3">BELUM DIMASUKAN</span></td>	      
	      <?php else:?>
	      <td class="align-middle" style="width: 12%"><?= xss($student["tempat_pkl"]) ?></td>
	  	  <?php endif; ?>

	  	  <?php if( $student["persetujuan"] == 1 ) : ?>
		  <td class="align-middle" style="width: 5%"><span class="badge badge-success py-2 px-3">SUDAH DISETUJUI</span></td>
		  <?php else: ?>
		  <td class="align-middle" style="width: 5%"><span class="badge badge-danger py-2 px-3">BELUM DISETUJUI</span></td>
		  <?php endif; ?>

	  	  <td class="align-middle" style="width: 13%">
	  	  	<?php if( $student["persetujuan"] == 1 ) : ?>
	  	  	<select name="pembimbing_already" class="custom-select PMB-<?= $student['id_siswa']?>" id="<?= $student["id_siswa"]; ?>" disabled>
	  	  		<?php else: ?>
			<select name="pembimbing" class="custom-select PMB-<?= $student['id_siswa']?>" id="<?= $student["id_siswa"]; ?>">
			<?php endif; ?> 			
	  	  		<option selected disabled>Pilih Pembimbing</option>
			    <?php foreach( $mentors as $mentor ) : ?>
			    <?php $id_pembimbing = $mentor['id_pembimbing']; ?>
			    	<option <?= ($student["id_pembimbing"] == $id_pembimbing) ? "selected value='$id_pembimbing'" : "value='$id_pembimbing'" ?> ><?= $mentor["nama"] ?></option>
			    <?php endforeach; ?>
  			</select>
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
		$("#content").load("http://"+window.location.host+"/SaaS-2/index.php/kabeng/pembagian_pembimbing/"+p, function(xhr,status) {
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
<script type="text/javascript" src="<?= base_url(). 'js/kabeng-pembagian_pembimbing.js' ?>"></script>