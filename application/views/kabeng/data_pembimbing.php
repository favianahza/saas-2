<div class="container-fluid py-3">
	<div class="row">
		<div class="col">
			<h3 class="mb-3 text-center">Data Pembimbing Jurusan <?= $_SESSION["jurusan"]; ?></h3>
		</div>
	</div>
	<table class="table table-striped table-bordered">
	  <thead class="text-center">
	    <tr>
	      <th scope="col" class="align-middle">NO</th>
	      <th scope="col" class="align-middle">NAMA</th>
	      <th scope="col" class="align-middle">FOTO</th>
	      <th scope="col" class="align-middle">JUMLAH SISWA YANG DIBIMBING</th>
	      <th scope="col" class="align-middle">LAINNYA</th>
	    </tr>
	  </thead>
	  <?php $no=0; ?>
	  <tbody class="text-center">
	  	<?php foreach($records as $record) : ?>
		<?php $id = $record["id_pembimbing"] ?>
	    <?php $no++; ?>

	    <tr>
	      <th scope="row" style="width: 1%" class="align-middle"><?= $no; ?></th>

	      <td class="align-middle" style="width: 15%"><?= xss($record["nama"]) ?></td>

	      <td class="align-middle" style="width: 10%"><img src="<?=base_url().'img/pembimbing/'. xss($record['foto'])?>" width="50" height="50" class="shadow"></td>

	      
		  <td class="align-middle" style="width: 11%"><?= xss($record["jml_siswa"])?></td>

	  	  <td class="align-middle" style="width: 13%"><div class="col-8 offset-2">
	  	  	<span class="badge badge-info mr-1 p-2" id="detail-<?= $record["id_pembimbing"] ?>" data-detail="<?= $record["id_pembimbing"] ?>" style="cursor: pointer;">DETAIL</span>
	  	  	<span class="badge badge-danger p-2" id="hapus-<?= $record["id_pembimbing"] ?>" data-pembimbing="<?= $record["id_pembimbing"]; ?>" style="cursor: pointer;" data-jml="<?= $record["jml_siswa"] ?>">HAPUS</span></div>
	  	  </td>

	    </tr>

		<?php endforeach; ?>
	   </tbody>
	</table>

</div>
<script type="text/javascript">
	$("span[id*=detail-]").on('click', function() {


		let id = $(this).attr('data-detail');

		$("#content").load("kabeng/detail_pembimbing/"+id, function(status,xhr) {
			if(xhr=="error") {
				$('#content').load("detail_pembimbing/"+id);
			}
		});

	});	

	$('span[id*=hapus-]').on('click',function() {

		let jml = $(this).attr('data-jml');
		if( jml > 0 ){
			return Swal.fire({
				title: 'Tidak Bisa Dihapus !',
				text: 'Pembimbing sedang membimbing Siswa !',
				icon: 'error'
			});			
		}

		let persetujuan = $(this).attr('data-persetujuan');
		if( persetujuan == 1 ){
			return Swal.fire({
				title: 'Tidak Bisa Dihapus !',
				text: 'Siswa telah Disetujui oleh Pembimbing !',
				icon: 'error'
			});
		}
		let id = $(this).attr('data-pembimbing');

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
		  		id_pembimbing: id
		  	});
		    Swal.fire(
		      'Berhasil',
		      'Data Berhasil Dihapus !',
		      'success'
		    ).then(function() {
		    		$("#content").load("http://"+window.location.host+"/SaaS-2/index.php/kabeng/data_pembimbing", function(status,xhr) {
						if( xhr == "error" ){
							$('#content').load("data_pembimbing");
						}
					});
		    });
		  }

		})
	
	});

</script>