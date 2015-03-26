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
			alert("Data: " + data + "\nStatus: " + status);
			window.location.replace("/home");
		});
	});
});