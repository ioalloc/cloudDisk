$(document).ready(function  () {


	//input detect
	$('#username').blur(function  () {
		var username = $('#username').val();
		$.ajax({
			url:"http://localhost/server/checkname",
			jsonp:"callback",
			dataType:"jsonp",
			data:{
				u:username,
				format:"json"
			},
			success: function  (response) {
				alert(response);
			}
		});
	});

	//login button listen...
	$('#login').click(function(){
		var username = $('#username').val();
		var password = $('#password').val();
		$.post('/server/login', {u:username,p:password},function  (data,status) {
			if (data == 'success') {
				window.location.replace("/home");
			}
			else{
				alert('login failed,please try again!');
			}
		});
	});

	//logout button listen
	$('#logout').click(function () {
		$.post('/server/logout', function  (data,status) {
			alert("Data: " + data + "\nStatus: " + status);
			if (data == 'success') {
				window.location.replace("/login");
			}
		});
	});


	//sign up button listen
	$('#signup').click(function  () {

	});


});