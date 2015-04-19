<ul id="userdropdown" class="dropdown-content">
  <li><a href="#!">My profile</a></li>
  <li><a href="#!">Safe</a></li>
  <li class="divider"></li>
  <li id="logout"><a href="#!">logout</a></li>
</ul>
<div class="navbar-fixed">
  <nav class="top-nav">
    <div class="nav-wrapper">
      <li class="left logo"><i class="mdi-file-cloud-queue left"></i>Cloud Disk</li>
      <ul class="right hide-on-med-and-down">
      	<li>
      		<a href="#" class="dropdown-button" data-activates="userdropdown">
      			<i class="mdi-action-account-circle left"></i>
      			<?php echo $username ?>
      		</a>
      	</li>
        <li><a href="#"><i class="mdi-action-search left"></i>search</a></li>
        <li><a href="#"><i class="mdi-action-view-module left"></i>app</a></li>
      </ul>
    </div>
  </nav>
</div>


<!-- Page Layout here -->
<div class="row">

  <div class="col s3 m3">
    <!-- Grey navigation panel -->
    <div class="sidenav center">
  		<li class="sidenav-item">All file</li>
  		<li class="divider"></li>
  		<li class="sidenav-item">Recentlly</li>
  		<li class="divider"></li>
  		<li class="sidenav-item">Image</li>
  		<li class="divider"></li>
  		<li class="sidenav-item">Video</li>
  		<li class="divider"></li>
  		<li class="sidenav-item">Video</li>
  		<li class="divider"></li>
  		<li class="sidenav-item">Video</li>
    </div>
  </div>
  <div class="col s9 m9">
	  <form id="fileSubmit" action="server/upload" method="post" enctype="multipart/form-data">
	    <div class="file-field input-field">
	    	<div class="row">
	    		<div class="col s1 btn">
			        <span>File</span>
			        <input type="file" name="file_upload"/>
	    		</div>
	    		<div class="col s8">
			      <input class="file-path validate" type="text"/>
	    		</div>
	    		<div class="col s1">
			      <input type="submit" class="" value='Upload'/>
			    </div>
	    	</div>
	    </div>
	  </form>
		<div id="progress">
			<div id="bar"></div>
			<div id="percent">0%</div>
		</div>
		<div class="fileview">
			<div class="row fileview-head">
				<div class="col s6 m6">
					<li>filename</li>
				</div>
				<div class="col s3 m3">
					<li>size</li>
				</div>
				<div class="col s3 m3">
					<li>date</li>
				</div>
			</div>
			<div class="row fileview-content">
				<ul class="col s6 m6">
					<li>as</li>
					<li>as</li>
					<li>as</li>
					<li>as</li>
					<li>as</li>
					<li>as</li>
					<li>as</li>
					<li>as</li>
					<li>as</li>
					<li>as</li>
					<li>as</li>
					<li>as</li>
					<li>as</li>
					<li>as</li>
					<li>as</li>
					<li>as</li>
					<li>as</li>
					<li>as</li>
					<li>as</li>
					<li>as</li>
					<li>as</li>
					<li>as</li>
				</ul>
				<ul class="col s3 m3">
					<li>as</li>
				</ul>
				<ul class="col s3 m3">
					<li>as</li>
				</ul>
			</div>
		</div>
		<div id="message"></div>
	</div>

</div>
