<div class="container-fluid py-3">
<h1 class="text-center f-poppins mt-0 mb-2">Data Siswa</h1>
	<div class="row mt-3">
		<div class="col mx-auto">
			<img src="<?= base_url().'img/siswa/'.$student['foto'] ?>" class="d-block mx-auto rounded-circle shadow" height="450" width="450">
		</div>
		<div class="col my-auto">
			<table class="w-100">
				<tr>
					<td style="width: 35%"><h5>Nama</h5></td>
					<td><h5>:</h5></td>
					<td><h5><?= $student["nama"] ?></h5></td>
				</tr>

				<tr>
					<td style="width: 35%"><h5>NIS</h5></td>
					<td><h5>:</h5></td>
					<td><h5><?= $student["NIS"]; ?></h5></td>
				</tr>

				<tr>
					<td><h5>Jurusan</h5></td>
					<td><h5>:</h5></td>
					<td><h5><?= $student["jurusan"]; ?></h5></td>
				</tr>

				<tr>
					<td><h5>Kelas</h5></td>
					<td><h5>:</h5></td>
					<td><h5><?= $student["kelas"]; ?></h5></td>
				</tr>

				<tr>
					<td><h5>Pembimbing Sekolah</h5></td>
					<td><h5>:</h5></td>
					<td><h5><?= $student["pembimbing"]; ?></h5></td>
				</tr>				

				<tr>
					<td><h5>Pembimbing Perusahaan</h5></td>
					<td><h5>:</h5></td>
					<?php if( $student["pembimbing_pkl"] == NULL ) : ?>
					<td><h5><span class="badge badge-danger">BELUM DIMASUKAN</h5></td>
					<?php else: ?>
					<td><h5><?= $student["pembimbing_pkl"]; ?></h5></td>
					<?php endif; ?>
				</tr>

				<tr>
					<td><h5>Tempat Prakerin</h5></td>
					<td><h5>:</h5></td>
					<?php if( $student["tempat_pkl"] == NULL ) : ?>
					<td><h5><span class="badge badge-danger">BELUM DIMASUKAN</h5></td>
					<?php else: ?>
					<td><h5><?= $student["tempat_pkl"]; ?></h5></td>
					<?php endif; ?>
				</tr>

				<tr>
					<td><h5>Tanggal Prakerin</h5></td>
					<td><h5>:</h5></td>
					<?php if( $student["tgl_pkl"] == NULL ) : ?>
					<td><h5><span class="badge badge-danger">BELUM DIMASUKAN</h5></td>
					<?php else: ?>
					<td><h5><?= $student["tgl_pkl"]; ?></h5></td>
					<?php endif; ?>
				</tr>

				<tr>
					<td><h5>Lama Prakerin</h5></td>
					<td><h5>:</h5></td>
					<?php if( $student["lama_pkl"] == NULL ) : ?>
					<td><h5><span class="badge badge-danger">BELUM DIMASUKAN</h5></td>
					<?php else: ?>
					<td><h5><?= $student["lama_pkl"]; ?> Bulan</h5></td>
					<?php endif; ?>
				</tr>

				<tr>
					<td><h5>Persetujuan</h5></td>
					<td><h5>:</h5></td>
					<?php if( $student["persetujuan"] == false ) : ?>
					<td><h5><span class="badge badge-danger h-100">BELUM DISETUJUI</h5></td>
					<?php else: ?>
					<td><h5><span class="badge badge-success h-100">SUDAH DISETUJUI</h5></h5></td>
					<?php endif; ?>
				</tr>

			</table>

		</div>		
	</div>
</div>