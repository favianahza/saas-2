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

let k_p_p = false;

$("#n1").click(function(){

	k_p_p = false;
	$("#content").load("http://"+window.location.host+"/SaaS-2/index.php/kabeng/data_siswa", function(status,xhr) {
		if( xhr == "error" ){
			$('#content').load("data_siswa");
		}
	});

});

$("#n2").click(function(){

	k_p_p = false;
	$("#content").load("http://"+window.location.host+"/SaaS-2/index.php/kabeng/data_pembimbing", function(status, xhr) {
		if( xhr == "error" ){
			$('#content').load("data_pembimbing");
		}
	});

});

$("#n3").click(function(){

	k_p_p = false;
	$("#content").load("http://"+window.location.host+"/SaaS-2/index.php/kabeng/file_siswa", function(status, xhr)  {
		if( xhr == "error" ){
			$('#content').load("file_siswa");
		}
	});

});

$("#n4").click(function(){
	if(k_p_p) return;
	
	$("#content").load("http://"+window.location.host+"/SaaS-2/index.php/kabeng/pembagian_pembimbing", function(status, xhr)  {
		if( xhr == "error" ){
			$('#content').load("pembagian_pembimbing");
			k_p_p = true;
		}
	});
	k_p_p = true;

});

});