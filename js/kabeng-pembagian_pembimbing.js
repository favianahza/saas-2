$(function(){

	$('select').on('mouseover', function(){
		$('#Pembimbing').css({
			'cursor':'pointer'
		});
	});

	
	$('select[class*="PMB-"]').on('change', function(){
		$(this).css('color', 'black');
		var value = $(this).val();
		var id = $(this).attr('id');
		$.post("http://"+window.location.host+"/SaaS-2/index.php/kabeng/update", 
		{
		 	id_siswa: id, id_pembimbing: value
		}).done(function(msg){  }).fail(function(xhr, status, error) {
		        	$.post('update', {
		        		id_siswa: id, id_pembimbing: value
		        	}).done(function(msg){  });
		     });

	});



});