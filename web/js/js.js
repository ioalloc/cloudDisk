$(document).ready(function  () {


	//input detect
	$('#username').blur(function  () {
		var username = $('#username').val();
		$.ajax({
			url:"http://localhost/hello",
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
		$.get('/css/css.css',function  (data,status) {
			alert("Data: " + data + "\nStatus: " + status);
		});
	});
});