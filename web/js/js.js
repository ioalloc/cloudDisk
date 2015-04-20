$(document).ready(function  () {

    getDir('/');

	// input detect
	$('#signup-form').find('#email').blur(function  () {
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
				// alert(response);
			}
		});
	});

	//login button listen...
	$('#login').click(function(){
		var email = $('#email').val();
		var password = $('#password').val();
		$.post('/server/login', {e:email,p:password},function  (data,status) {
			if (data == 'success') {
				alert('success');
                locationToTome();
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
                locationToTome();
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
            alert(data);
			if (data == 'success') {
                locationToTome();
			}
			else{
				alert('sign up failed,please try again!');
			}
		});
	});

	//jquery form file upload options
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
		$("#message").html('<span style="color: green; ">'+response.responseText+"</span>");
	},
	error: function()
	{
		$("#message").html('<span style="color: red; "> ERROR: unable to upload files</span>');
	}
	};
	//file upload ajax submit
	$('#fileSubmit').ajaxForm(options);

});

locationToTome = function(){
    window.location.replace("/");
}

getDir = function(url){
    $.ajax({
        method: "POST",
        url: 'server/getdir',
        data: {dir:url},
        dataType: 'json'
    }).done(function(data){
        var fileview_content = $('.fileview-content');
        $.each(data,function(i,item){
            var li_name = '<li class="col s6 m6">' + item['name'] + '</li>';
            var li_size = '<li class="col s3 m3">' + item['size'] + '</li>';
            var li_time = '<li class="col s3 m3">' + item['time'] + '</li>';
            var row = '<ul class="row">' + li_name + li_size + li_time + '</ul>';
            fileview_content.append(row);
        });
    });
}