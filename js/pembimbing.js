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

let persetujuan = false;
let detail = false;

$("#n1").click(function(){
	persetujuan = false;
	if( detail ) return true;

	$("#content").load("http://"+window.location.host+"/SaaS-2/pembimbing/data_siswa");
	detail = true;
});

$("#n2").click(function(){
	persetujuan = false;
	detail = false;
	$("#content").load("http://"+window.location.host+"/SaaS-2/pembimbing/file_siswa");

});

$("#n3").click(function(){
	detail = false;
	if(persetujuan) return;

	$("#content").load("http://"+window.location.host+"/SaaS-2/pembimbing/persetujuan");
	persetujuan = true;
});


}); 