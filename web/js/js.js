//js.js

var files;
var path = [];
var files_selected = [];

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
        $.ajax({
            method: "POST",
            url: 'server/createdir',
            data: {dir:folder}
        }).done(function(){
            getDir(path);
            //Materialize.toast();
        }).fail(function(){
            alert('Create folder failed!');
        });
        $('#folder-dialog').closeModal();
    });

    $('#download').click(function(){
        //alert(files_selected.toSource());
        $.post('/server/download',{files:files_selected},function(data,status){
            //alert(data);
            download();
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
    var file = files[$(this).index()];
    if(file['type'] == 'dir'){
        path.push(files[$(this).index()]['name']);
        getDir(path);
        files_selected = [];
        $('#download').addClass('disabled');
    }else{
        var index = files_selected.indexOf(file['name']);
        if(index > -1){
            files_selected.splice(index,1);
            $(this).find('.file-img').css('border', '4px solid #ffffff');
            if(files_selected.length < 1){
                $('#download').addClass('disabled');
            }
        }
        else {
            $(this).find('.file-img').css('border', '4px solid #26A69A');
            files_selected.push(file['name']);
            $('#download').removeClass('disabled');
        }
    }
});

locationToTome = function(){
    window.location.replace("/");
}

getDir = function(path){
    var url = '/';
    if(path.length != 0) {
        $.each(path, function (i, dir) {
            url = url + dir + '/';
        })
    }
    $('#url').html(url);
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
                    img = '<img class="file-img" src="icon/' +
                    item['icon'] +
                    '"/> ';
                } else {
                    img = '<img class="file-img" src="icon/folder.svg"/> ';
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

function download() {
    var event = new MouseEvent('click', {
        'view': window,
        'bubbles': true,
        'cancelable': true
    });
    var cb  = document.createElement("a");
    cb.href = 'server/download';
    cb.dispatchEvent(event);
}