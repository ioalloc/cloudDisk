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
            var name = item['name'];
            if(name.length > 15){
                name = name.slice(0,15) + '...';
            }
            var img;
            var file =
                '<div class="col s3 m2 file center">\n' +
                    '<img src="icon/www.svg"/> ' +
                    '<p>' +
                    name +
                    '</p>' +
                '</div>';
            fileview_content.append(file);
        });
    });
}