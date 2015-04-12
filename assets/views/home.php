<h2>
	welcome <?php echo $username ?>!
</h2>

<button id="logout">logout</button>

<form id="fileSubmit" action="server/upload" method="post" enctype="multipart/form-data">
	<input type="file" name="file_upload"/>
	<input type="submit" value='Upload'/>
</form>

<div id="progress">
	<div id="bar"></div>
	<div id="percent">0%</div>
</div>
<div id="message"></div>