<div class="login-form">
		<fieldset>
			<legend>cloudDisk login</legend>
			<label>Username</label>
			<input id="username" type="text" name="username" placeholder="Your name...">
			<label>Password</label>
			<input id="password" type="password" name="password">
			<span class="help-block">Enter the fairy realm.</span>
			<input id="login" type="button" value="login">
		</fieldset>
</div>
<script>
    //A very basic way to open a popup
    function popup(link, windowname) {
        window.open(link.href, windowname, 'width=400,height=200,scrollbars=yes');
        return false;
    }
</script>