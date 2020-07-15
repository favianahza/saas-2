$(function(){

$('li[id*=link-page-]').on('click', function() {
			let data = $(this).attr('data-pages');
			let p = 0;
			if( data % 2 == 1 ){
				p = ((data * 5)/2) + 2.5;
			} else {
				p = ((data*5)/2);
			}
			if( data == 1 ) p = 0;
			$("#content").load("http://"+window.location.host+"/SaaS-2/index.php/pembimbing/persetujuan/"+p, function(xhr,status) {
				$('li[id*=link-page-]').css('fontWeight', 'normal');
				$('#link-page-'+data).css('fontWeight', 'bold');
				if( xhr == "error" ){
					$("#content").load('lihat_siswa/'+p);
					$('li[id*=link-page-]').css('fontWeight', 'normal');
					$('#link-page-'+data).css('fontWeight', 'bold');
				}
			});

});


$('span[id*="STJ-"]').click(function() {
	var value = $(this).attr('id');
	var arr = value.split('-');
	var null_val = arr[1];
	var id = arr[2];

	if( null_val != 0 ){
		window.alert("PERSYARATAN BELUM TERPENUHI !");
		return false;
	}
	
		$.post('pembimbing/setuju', {
		 	id_siswa: id
		}).done(function(msg){ 
			$('#'+value).removeClass('badge-info').addClass('badge-success').text('SUDAH DISETUJUI');
			window.alert("BERHASIL");
			 }).fail(function(xhr, status, error) {
			 	$.post('setuju', {id_siswa: id}).done(function(msg){
		        	$('#'+value).removeClass('badge-info').addClass('badge-success').text('SUDAH DISETUJUI');
		        	window.alert("BERHASIL");
			 	})


		});


	});

});