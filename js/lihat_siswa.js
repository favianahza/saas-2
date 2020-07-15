$(function(){

// // DETAIL BADGE
// if( $('#detail').length > 0 ){

// 	$('#detail').on('mouseover', function(){
// 		$(this).css({
// 			'cursor':'pointer',
// 			'backgroundColor':'#038ea4'
// 		});
// 	});

// }

rofl = true;
if( rofl ){

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

}



let persetujuan = false;
let detail = false;

$("#n1").click(function(){
	persetujuan = false;
	if( detail ) return;

	$("#content").load("data_siswa");
	detail = true;

});

$("#n2").click(function(){
	detail = false;
	persetujuan = false;
	$("#content").load("file_siswa");

});

$("#n3").click(function(){
	detail = false;
	if(persetujuan) return;

	persetujuan = true;
	$("#content").load("persetujuan");
});

$("span[id*=detail-]").on('click', function() {


	let id = $(this).attr('data-detail');

	$("#content").load("detail_siswa/"+id);

});

});