$(document).ready(function  () {


	//input detect
	$('#username').blur(function  () {
		var username = $('#username').val();
		$.ajax({
			url:"http://localhsot/users",
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
		$.get('/views/css/css.css',function  (data,status) {
			alert("Data: " + data + "\nStatus: " + status);
		});
	});
});