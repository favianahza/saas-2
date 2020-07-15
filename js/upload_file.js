var fileTypes = ['pdf', 'jpg', 'jpeg', 'png'];  //acceptable file types
function readURL(input) {
    if (input.files && input.files[0]) {
        var extension = input.files[0].name.split('.').pop().toLowerCase(),  //file extension from input file
            isSuccess = fileTypes.indexOf(extension) > -1;  //is extension in acceptable types

        if (isSuccess) { //yes
            var reader = new FileReader();
            reader.onload = function (e) {
                if (extension == 'pdf'){
                	$(input).closest('.fileUpload').find(".icon").attr('src','https://image.flaticon.com/icons/svg/179/179483.svg');
                }
                else if (extension == 'png'){ $(input).closest('.fileUpload').find(".icon").attr('src','https://image.flaticon.com/icons/svg/136/136523.svg'); 
                }
                else if (extension == 'jpg' || extension == 'jpeg'){
                	$(input).closest('.fileUpload').find(".icon").attr('src','https://image.flaticon.com/icons/svg/136/136524.svg');
                }
                else {
                	//console.log('here=>'+$(input).closest('.uploadDoc').length);
                	$(input).closest('.uploadDoc').find(".docErr").slideUp('slow');
                }
            }

            reader.readAsDataURL(input.files[0]);
        }
        else {
        		//console.log('here=>'+$(input).closest('.uploadDoc').find(".docErr").length);
            $(input).closest('.uploadDoc').find(".docErr").fadeIn();
            setTimeout(function() {
				   	$('.docErr').fadeOut('slow');
					}, 9000);
        }
    }
}
$(document).ready(function(){
   window['ext'] = [];
   for (i = 0; i < 6; i++) {
      window['id'+i] = $('#upload-'+i).text();
   }
  
   ext[0] = 'padding';

   var arr_ext_1 = id1.split('.');
   ext[1] = (arr_ext_1[arr_ext_1.length - 1]);

   var arr_ext_2 = id2.split('.');
   ext[2] = (arr_ext_2[arr_ext_2.length - 1]);

   var arr_ext_3 = id3.split('.');
   ext[3] = (arr_ext_3[arr_ext_3.length - 1]);   

   var arr_ext_4 = id4.split('.');
   ext[4] = (arr_ext_4[arr_ext_4.length - 1]);   

   var arr_ext_5 = id5.split('.');
   ext[5] = (arr_ext_5[arr_ext_5.length - 1]);   

   // CHANGE EACH ICON 
   for( j = 0; j < 6; j++){

    if (ext[j] == 'pdf'){
            $('#icon-'+j).attr('src','https://image.flaticon.com/icons/svg/179/179483.svg');
            }
    else if (ext[j] == 'png'){ 
            $('#icon-'+j).attr('src','https://image.flaticon.com/icons/svg/136/136523.svg'); 
            }
    else if (ext[j] == 'jpg' || ext[j] == 'jpeg'){
            $('#icon-'+j).attr('src','https://image.flaticon.com/icons/svg/136/136524.svg');
    }   

   }

   $(document).on('change','.up', function(){
   	var id = $(this).attr('id'); /* gets the filepath and filename from the input */
	   var profilePicValue = $(this).val();
	   var fileNameStart = profilePicValue.lastIndexOf('\\'); /* finds the end of the filepath */
	   profilePicValue = profilePicValue.substr(fileNameStart + 1).substring(0,20); /* isolates the filename */
	   //var profilePicLabelText = $(".upl"); /* finds the label text */
	   if (profilePicValue != '') {
	   	//console.log($(this).closest('.fileUpload').find('.upl').length);
	      $(this).closest('.fileUpload').find('.upl').html(profilePicValue); /* changes the label text */
	   }
   });

    
   $(document).on("click", "a.btn-check" , function() {
     if($(".uploadDoc").length>1){
        $(this).closest(".uploadDoc").remove();
      }else{
        alert("You have to upload at least one document.");
      } 
   });



   if( $('#ps').length == 1 ){

      $('input').attr('disabled', 'true');
      $('button[type=submit]').attr('disabled', 'true');
      $('button[type=submit]').removeAttr('name');

   }
   
   if( $('#dl').length == 1 ){
      $('button[name=up]').attr('disabled', 'true');
      $('button[name=up]').removeAttr('name');
   }

});