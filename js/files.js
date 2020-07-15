$(function(){

let u_f = false;

$("#n1").click(function(){

	u_f = false;
	$("#content").load("http://"+window.location.host+"/SaaS-2/index.php/siswa/data_siswa");

});

$("#n2").click(function(){

	if( u_f ) return;
	$("#content").load("http://"+window.location.host+"/SaaS-2/index.php/siswa/upload_file");
	u_f = true;

});

$("#n3").click(function(){

	u_f = false;
	$("#content").load("http://"+window.location.host+"/SaaS-2/index.php/siswa/edit_data");

});

});