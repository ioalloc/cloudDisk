//js.js

var files;
var path = [];

$(document).ready(function  () {


    //$('.collapsible').collapsible({
    //    accordion : false // A setting that changes the collapsible behavior to expandable instead of the default accordion style
    //});

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

    $('#new-folder').click(function(){
        var folder = $('#new-folder-name').val();
        $('#folder-dialog').closeModal();
        $.ajax({
            method: "POST",
            url: 'server/createdir',
            data: {dir:folder},
            dataType: 'json'
        }).done(function(data,status){
            alert('ss');
        });
    });

    $('#path-back').click(function(){
        path.pop();
        getDir(path);
    });

	//jquery form file upload options
	var options = {
	beforeSend: function()
	{
		//$("#progress").show();
		//clear everything
		$("#bar").width('0%');
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
	complete: function()
	{
        $('#file-dialog').closeModal();
        getDir(path);
	},
	error: function()
	{
        alert('error');
	}
	};
	//file upload ajax submit
	$('#fileSubmit').ajaxForm(options);


    $('.modal-trigger').leanModal();

    getDir(path);

});


$(document).on('click','div.file',function(){
    //alert(files[$(this).index()]['name']);
    if(files[$(this).index()]['type'] == 'dir'){
        path.push(files[$(this).index()]['name']);
        getDir(path);
    }
});

locationToTome = function(){
    window.location.replace("/");
}

getDir = function(path){
    var url = '/';
    $.each(path,function(i,dir){
        url = url + dir;
    })

    url = url + '/';

    $.ajax({
        method: "POST",
        url: 'server/getdir',
        data: {dir:url},
        dataType: 'json'
    }).done(function(data,status){
        if(status == 'success') {
            var fileview_content = $('.fileview-content');
            fileview_content.empty();
            //show folder at begin,this block is to adjust data's index
            var dirCount = 0;
            for (var i = 0; i < data.length; i++) {
                if (data[i]['type'] == 'dir') {
                    var dir = data.splice(i, 1);
                    data.splice(dirCount, 0, dir[0]);
                    dirCount++;
                }
            }
            files = data;

            //show file view
            $.each(data, function (i, item) {
                var name = item['name'];
                if (name.length > 15) {
                    name = name.slice(0, 15) + '...';
                }
                var img;
                if (item['type'] == 'file') {
                    img = '<img src="icon/' +
                    item['icon'] +
                    '"/> ';
                } else {
                    img = '<img src="icon/folder.svg"/> ';
                }
                var file =
                    '<div id="' +
                    item['name'] +
                    '" class="col s3 m2 file center">\n' +
                    img +
                    '<p>' +
                    name +
                    '</p>' +
                    '</div>';
                fileview_content.append(file);
            });
        }
    });
}