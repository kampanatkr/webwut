$(document).ready(function(e){
	$(".btnDeleteFile").hide();

// display msg
	function displayInbox(){
		$.ajax({
			url: './personalMessage/php/inbox.php',
			type: 'POST',
			success: function(data){
				$("#inbox").html(data);
			}
		});
	}
	function displaySentBox(){
		$.ajax({
			url: './personalMessage/php/sentBox.php',
			type: 'POST',
			success: function(data){
				$("#sentBox").html(data);
			}
		});
	}
	setInterval(function(){
		displayInbox();
		displaySentBox();
	},1000);

// show image after select image file.
	$("#file").change(function(){
		readURL(this);
		console.log(this);
	})
	function readURL(input) {
	  if (input.files && input.files[0]) {
	    var reader = new FileReader();

	    reader.onload = function(e) {
	    	$('#preview').attr('src', e.target.result);
	    	$(".btnDeleteFile").show();
	    }

	    reader.readAsDataURL(input.files[0]);

	  }
	}

// send form(reviever, msg, image file) + upload image
	$("#message-sender").ajaxForm({
		url: "./personalMessage/php/sendMessage.php",
		type: "post",
		success: function(response){
			console.log(response);
			if (response == "true"){
			    $('#snackbar').text('Message sent');
			    document.getElementById('toID').value = '';
				document.getElementById('msg-box').value = '';
				document.getElementById("file").value = '';
				$('#preview').attr('src', '');
				$(".btnDeleteFile").hide();
				document.getElementById("snackbar").style.backgroundColor ="#61cf6a";
			}else if (response == "false"){
				$('#snackbar').text('Invalid user ID');
				document.getElementById("snackbar").style.backgroundColor = "#ff5432";
			}else if (response == "not ID"){
				$('#snackbar').text('Please enter user ID');
				document.getElementById("snackbar").style.backgroundColor = "#ff5432";
			}else{
				$('#snackbar').text('Fill in not complete');
				document.getElementById("snackbar").style.backgroundColor = "#ff5432";
			}

			// snackbar: alert sending msg 
			var x = document.getElementById("snackbar");
		    x.className = "show";
		    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
		}
	})

// delete button for delete image is select
	$('.btnDeleteFile').click(function(e) {
		document.getElementById("file").value = '';
		$('#preview').attr('src', '');
		$(".btnDeleteFile").hide();
	})

	// $('#send').click(function(e) {
	// 	var toID = $('#toID').val();
	// 	var msg = $('#msg-box').val();
	// 	var file = $('#file').val();
	// 	console.log(toID, msg, file);
	// 	var formData = new FormData($("#message-sender")[0]);
	// 	console.log("formData " + FormData);
	// 	$.ajax({
	// 		url: 'sendMessage.php',
	// 		type: 'POST',
	// 		// data: {
	// 		// 	toID: toID,
	// 		// 	msg: msg,
	// 		// 	file: file
	// 		// },
	// 		data:formData,
	// 		cache: false,
 //            contentType: false,
 //            processData: false,
 //            async: false,
	// 		success: function(data){

	// 			if (data == "true"){
	// 				// Get the snackbar DIV
	// 			    $('#snackbar').text('ข้อความถูกส่งแล้ว');
	// 			    document.getElementById('toID').value = '';
	// 				document.getElementById('msg-box').value = '';
	// 				document.getElementById("snackbar").style.backgroundColor ="#00cc00";
	// 			}else if (data == "false"){
	// 				$('#snackbar').text('User ID ไม่ถูกต้อง');
	// 				document.getElementById("snackbar").style.backgroundColor ="red";
	// 			}else{
	// 				$('#snackbar').text('กรอกข้อมูลไม่ครบถ้วน');
	// 				document.getElementById("snackbar").style.backgroundColor ="red";
	// 			}
	// 			var x = document.getElementById("snackbar");

	// 		    // Add the "show" class to DIV
	// 		    x.className = "show";

	// 		    // After 3 seconds, remove the show class from DIV
	// 		    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
				
	// 		}
	// 	});



	// });

});


