$(document).ready(function  () {


	//input detect
	$('#signup-form #email').blur(function  () {
		var email = $('#email').val();
		$.ajax({
			url:"http://localhost/server/checkemail",
			jsonp:"callback",
			dataType:"jsonp",
			data:{
				e:email,
				format:"json"
			},
			success: function  (response) {
				alert(response);
			}
		});
	});

	//login button listen...
	$('#login').click(function(){
		var email = $('#email').val();
		var password = $('#password').val();
		$.post('/server/login', {e:email,p:password},function  (data,status) {
			alert(data);
			if (data == 'success') {
				window.location.replace("/");
			}
			else{
				alert('login failed,please try again!');
			}
		});
	});

	//logout button listen
	$('#logout').click(function () {
		$.post('/server/logout', function  (data,status) {
			if (data == 'success') {
				window.location.replace("/login");
			}
		});
	});


	//sign up button listen
	$('#signup').click(function  () {

		//get the account information
		var email = $('#email').val();
		var password = $('#password').val();

		//post the email and password to server
		$.post('/server/signup', {e:email,p:password}, function  (data,status) {
			if (data == 'success') {
				window.location.replace("/");
			}
			else{
				alert('sign up failed,please try again!');
			}
		});
	});

	//file upload button event
	// $('#upload').click(function  () {
	// 	var file_data = $('#file')[0].files[0];
	// 	var form_data = new FormData();
	// 	form_data.append('file', file_data);
	// 	alert(form_data);
	// 	$.ajax({
	// 		url: '/server/upload', // point to server-side PHP script
	// 		dataType: 'text',  // what to expect back from the PHP script, if anything
	// 		cache: false,
	// 		contentType: false,
	// 		processData: false,
	// 		data: form_data,
	// 		type: 'post',
	// 		success: function(php_script_response){
	// 			alert(php_script_response); // display response from the PHP script, if any
	// 		}
	// 	});
	// });

	var options = {
	beforeSend: function()
	{
		$("#progress").show();
		//clear everything
		$("#bar").width('0%');
		$("#message").html("");
		$("#percent").html("0%");
	},
	uploadProgress: function(event, position, total, percentComplete)
	{
		$("#bar").width(percentComplete+'%');
		$("#percent").html(percentComplete+'%');
	},
	success: function()
	{
		$("#bar").width('100%');
		$("#percent").html('100%');
	},
	complete: function(response)
	{
		$("#message").html("<font color='green'>"+response.responseText+"</font>");
	},
	error: function()
	{
		$("#message").html("<font color='red'> ERROR: unable to upload files</font>");
	}
	};
	$('#fileSubmit').ajaxForm(options);

});