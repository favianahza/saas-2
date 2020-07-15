<div class="container-fluid py-3">
	<div class="row">
		<div class="col">
			<h3 class="mb-3 text-center">Data Siswa Jurusan <?= $_SESSION["jurusan"] ?></h3>
		</div>
	</div>	
	<table class="table table-striped table-bordered">
	  <thead class="text-center">
	    <tr>
	      <th scope="col" class="align-middle">NIS</th>
	      <th scope="col" class="align-middle">NAMA</th>
	      <th scope="col" class="align-middle">KELAS</th>
	      <th scope="col" class="align-middle">PEMBIMBING SEKOLAH</th>
	      <th scope="col" class="align-middle">PEMBIMBING PERUSAHAAN</th>
	      <th scope="col" class="align-middle">LAINNYA</th>
	    </tr>
	  </thead>
	  <tbody class="text-center">
	  	<?php foreach($students as $student) : ?>

	    <tr>

	      <th scope="row" style="width: 3%" class="align-middle"><?= xss($student["NIS"]) ?></th>

	      <td class="align-middle" style="width: 15%"><?= xss($student["nama"]) ?></td>

	      <td class="align-middle" style="width: 5%;"><?= xss($student["kelas"]) ?></td>

	      <?php if( $student["id_pembimbing"] == 0 || $student["id_pembimbing"] == NULL) : ?>
	      <td class="align-middle" style="width: 16%"><span class="badge badge-danger py-2 px-3">BELUM DIMASUKAN</span></td>	      
	      <?php else:?>
	      <td class="align-middle" style="width: 16%"><?= xss($student["pembimbing"]) ?></td>
	  	  <?php endif; ?>
	  	  
	      <?php if( $student["pembimbing_pkl"] == NULL) : ?>
	      <td class="align-middle" style="width: 16%"><span class="badge badge-danger py-2 px-3">BELUM DIMASUKAN</span></td>	      
	      <?php else:?>
	      <td class="align-middle" style="width: 16%"><?= xss($student["pembimbing_pkl"]) ?></td>
	  	  <?php endif; ?>

	  	  <td class="align-middle" style="width: 15%"><div class="col-8 offset-2">
	  	  	<span class="badge badge-info my-2 my-sm-0 mr-sm-1 p-2 d-block d-sm-inline-block" id="detail-<?= $student['id_siswa'] ?>" data-detail="<?= $student["id_siswa"] ?>" style="cursor: pointer;">DETAIL</span>
	  	  	<span class="badge badge-danger p-2 d-block d-sm-inline-block my-2 my-sm-0" id="hapus-<?= $student['id_siswa'] ?>" data-hapus="<?= $student['id_siswa'] ?>" style="cursor: pointer;" data-persetujuan="<?= $student['persetujuan'] ?>">HAPUS</span></div>
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
	$("span[id*=detail-]").on('click', function() {
		let id = $(this).attr('data-detail');

		$("#content").load("kabeng/detail_siswa/"+id, function(status,xhr) {
			if(xhr=="error") {
				$('#content').load("detail_siswa/"+id);
			}
		});

	});	

	$('li[id*=link-page-]').on('click', function() {
		let data = $(this).attr('data-pages');
		let p = 0;
		if( data % 2 == 1 ){
			p = ((data * 5)/2) + 2.5;
		} else {
			p = ((data*5)/2);
		}
		if( data == 1 ) p = 0;
		$("#content").load("http://"+window.location.host+"/SaaS-2/index.php/kabeng/data_siswa/"+p, function(xhr,status) {
			$('li[id*=link-page-]').css('fontWeight', 'normal');
			$('#link-page-'+data).css('fontWeight', 'bold');
			if( xhr == "error" ){
				$("#content").load('data_siswa/'+p);
				$('li[id*=link-page-]').css('fontWeight', 'normal');
				$('#link-page-'+data).css('fontWeight', 'bold');
			}
		});

	});


	$('span[id*=hapus-]').on('click',function() {

		let persetujuan = $(this).attr('data-persetujuan');
		if( persetujuan == 1 ){
			return Swal.fire({
				title: 'Tidak Bisa Dihapus !',
				text: 'Siswa telah Disetujui oleh Pembimbing !',
				icon: 'error'
			});
		}
		let id = $(this).attr('data-hapus');

		Swal.fire({
		  title: 'Yakin Dihapus ?',
		  text: "Data tidak bisa dikembalikan lagi setelah dihapus !",
		  icon: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#dc3545',
		  cancelButtonColor: '#3085d6',
		  confirmButtonText: 'Hapus'
		}).then((result) => {

		  if (result.value) {
		  	$.post("http://"+window.location.host+"/SaaS-2/index.php/kabeng/delete", {
		  		id_siswa: id
		  	});
		    Swal.fire(
		      'Berhasil',
		      'Data Berhasil Dihapus !',
		      'success'
		    ).then(function() {
		    		$("#content").load("http://"+window.location.host+"/SaaS-2/index.php/kabeng/data_siswa", function(status,xhr) {
						if( xhr == "error" ){
							$('#content').load("data_siswa");
						}
					});
		    });
		  }

		})
	
	});






</script>