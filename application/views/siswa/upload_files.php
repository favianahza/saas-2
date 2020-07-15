<?php 
$val = [$file["judul_laporan"], $file["file_laporan"], $file["absensi_pkl"], $file["agenda_pkl"], $file["nilai_pkl"], $file["sertifikat_pkl"]];
$disabled = false;
if( $file["judul_laporan"] != NULL && $file["absensi_pkl"] != NULL && $file["file_laporan"] != NULL && $file["agenda_pkl"] != NULL && $file["nilai_pkl"] != NULL && $file["sertifikat_pkl"] != NULL ){
  
$disabled = true;
  
}

 ?>
<div class="container-fluid">
<div id="content">
  <link rel="stylesheet" type="text/css" href="<?= base_url().'css/upload_file.css' ?>">
  <div class="container">
    <div class="row it">
      <div class="col-sm-offset-1 col-sm-10 mx-auto" id="one">
        <p><i class="fa fa-file"></i> Format File : 'pdf', 'jpg', 'jpeg', dan 'png'.</p>

          <div class="row">
            <div class="col-12 form-group">
              <h3 class="text-center f-poppins">Upload File</h3>
            </div><!--form-group-->
          </div><!--row-->
          
        <?php echo form_open_multipart('siswa/upload');?>
        <form method="POST" action="siswa/upload">
        <input type="hidden" name="nis" value="<?= $_SESSION['nis'] ?>">
        <input type="hidden" name="id" value="<?= $_SESSION['id_user'] ?>">
        <input type="hidden" name="fl_lama" value="<?= $file['file_laporan'] ?>">
        <input type="hidden" name="ap_lama" value="<?= $file['absensi_pkl'] ?>">
        <input type="hidden" name="ag_lama" value="<?= $file['agenda_pkl'] ?>">
        <input type="hidden" name="n_lama" value="<?= $file['nilai_pkl'] ?>">
        <input type="hidden" name="s_lama" value="<?= $file['sertifikat_pkl'] ?>">
        <input type="hidden" name="now" value="<?= date("Y-m-d"); ?>">
        <input type="hidden" name="deadline" value="<?= $acc["deadline"]; ?>">        
        <div id="uploader">
          <div class="row uploadDoc">

            <div class="col-sm-6 offset-sm-3" style="cursor: pointer;">
                  <?php if( $file["judul_laporan"] == NULL ) : ?>
                  <input type="text" class="form-control" name="judul_laporan" placeholder="Masukan Judul Laporan" autocomplete="off" required>
                  <?php else: ?>
                  <input type="text" class="form-control" name="judul_laporan" placeholder="<?= $file["judul_laporan"] ?>" value="<?= $file["judul_laporan"] ?>" autocomplete="off">
                  <?php endif; ?>
            </div>

            <div class="col-sm-6" style="cursor: pointer;">
                  <div class="docErr" id="1">Upload File yang Formatnya sudah ditentukan !</div><!--error-->
                  <div class="fileUpload btn btn-orange">
                    <img src="https://image.flaticon.com/icons/svg/136/136549.svg" class="icon" id="icon-1">
                    <?php if( $file["file_laporan"] != NULL ) : ?>
                    <span class="upl" id="upload-1"><?= $file["file_laporan"] ?></span>
                    <?php else: ?>
                    <span class="upl" id="upload-1">Laporan Prakerin</span>                      
                    <?php endif; ?>
                    <input type="file" class="upload up" name="laporan"  onchange="readURL(this);" required />
                  </div>
            </div>

            <div class="col-sm-6" style="cursor: pointer;">
                  <div class="docErr" id="2">Upload File yang formatnya sudah ditentukan !</div><!--error-->
                  <div class="fileUpload btn btn-orange">
                    <img src="https://image.flaticon.com/icons/svg/136/136549.svg" class="icon" id="icon-2">
                    <?php if( $file["file_laporan"] != NULL ) : ?>
                    <span class="upl" id="upload-2"><?= $file["absensi_pkl"] ?></span>
                    <?php else: ?>
                    <span class="upl" id="upload-2">Absensi Prakerin</span>                      
                    <?php endif; ?>
                    <input type="file" class="upload up" name="absensi" onchange="readURL(this);" required />
                  </div>
            </div>

            <div class="col-sm-6" style="cursor: pointer;">
                  <div class="docErr" id="3">Upload File yang Formatnya sudah ditentukan !</div><!--error-->
                  <div class="fileUpload btn btn-orange">
                    <img src="https://image.flaticon.com/icons/svg/136/136549.svg" class="icon" id="icon-3">
                    <?php if( $file["agenda_pkl"] != NULL ) : ?>
                    <span class="upl" id="upload-3"><?= $file["agenda_pkl"] ?></span>
                    <?php else: ?>
                    <span class="upl" id="upload-3">Agenda Prakerin</span>                      
                    <?php endif; ?>
                    <input type="file" class="upload up" name="agenda" onchange="readURL(this);" required />
                  </div>
            </div>

            <div class="col-sm-6" style="cursor: pointer;">
                  <div class="docErr" id="4">Upload File yang Formatnya sudah ditentukan !</div><!--error-->
                  <div class="fileUpload btn btn-orange">
                    <img src="https://image.flaticon.com/icons/svg/136/136549.svg" class="icon" id="icon-4">
                    <?php if( $file["file_laporan"] != NULL ) : ?>
                    <span class="upl" id="upload-4"><?= $file["nilai_pkl"] ?></span>
                    <?php else: ?>
                    <span class="upl" id="upload-4">Nilai Prakerin</span>                      
                    <?php endif; ?>
                    <input type="file" class="upload up" name="nilai" onchange="readURL(this);" required />
                  </div>
            </div>                    

            <div class="col-sm-6 offset-sm-3" style="cursor: pointer;">
                  <div class="docErr" id="5">Upload File yang Formatnya sudah ditentukan !</div><!--error-->
                  <div class="fileUpload btn btn-orange">
                    <img src="https://image.flaticon.com/icons/svg/136/136549.svg" class="icon" id="icon-5">
                    <?php if( $file["file_laporan"] != NULL ) : ?>
                    <span class="upl" id="upload-5"><?= $file["sertifikat_pkl"] ?></span>
                    <?php else: ?>
                    <span class="upl" id="upload-5">Sertifikat Prakerin</span>                      
                    <?php endif; ?>
                    <input type="file" class="upload up" name="sertifikat" onchange="readURL(this);" required />
                  </div>
            </div>      

          </div><!--row-->
        </div><!--uploader-->

        <?php if($acc["persetujuan"] == 1): ?>
          <p data-persetujuan="true" style="display: none;" id="ps"></p>
        <?php elseif($acc["tgl_pkl"] == NULL || $acc["lama_pkl"] == NULL): ?>
          <p data-deadline="<?= $acc["deadline"] ?>" style="display: none;" id="dl"></p>
        <?php else: ?>
          <p data-persetujuan="false" style="display: none;" id="px"></p>
        <?php endif; ?>

        <?php if( !$disabled ) : ?>
        <div class="text-center">
          <button class="btn btn-warning" type="submit" name="up"><i class="fa fa-paper-plane"></i> Upload</button>
        </div>
        <?php else: ?>

        <div class="text-center">
          <button class="btn btn-warning" type="submit" disabled><i class="fa fa-paper-plane"></i> Upload</button>
        </div>
        <?php endif; ?>
        </form>
        <div class="row">
              <div class="col">

                <?php if($acc["tgl_pkl"] == NULL || $acc["tgl_pkl"] == NULL) : ?>
                <p class="text-danger">Silahkan Edit Tanggal Prakerin dan Lama Prakerin Anda Terlebih Dahulu ! <span class="badge badge-danger h-100" data-toggle="modal" data-target="#editSiswa" style="cursor: pointer;">KLIK DISINI <i class="fa fa-hand-pointer-o"></i></span></p>
                <?php endif; ?>

                <?php if( $acc["deadline"] != NULL && $acc["persetujuan"] == 0 ) : ?>
                <h5 class="text-danger text-center my-4"><span class="badge badge-danger h-100"style="cursor: pointer;">DEADLINE : <?= $acc["deadline"] ?></span></h5>
                <?php endif; ?>

                <?php if( $acc["deadline"] != NULL && $acc["persetujuan"] == 1 ) : ?>
                <h5 class="text-danger text-center my-4"><span class="badge badge-success h-100"style="cursor: pointer;">TELAH DISETUJUI</span></h5>
                <?php endif; ?>

              </div>
        </div>

      </div><!--one-->
    </div><!-- row -->
  </div><!-- container -->
</div>
</div>