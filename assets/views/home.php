<!--dropdown selections-->
<ul id="userdropdown" class="dropdown-content">
  <li><a href="#">My profile</a></li>
  <li><a href="#">Safe</a></li>
  <li class="divider"></li>
  <li id="logout"><a href="#">logout</a></li>
</ul>

<!--fixed navbar-->
<div class="navbar-fixed">
  <nav class="top-nav">
    <div class="nav-wrapper">
      <li class="left logo"><i class="mdi-file-cloud-queue left"></i>Cloud Disk</li>
      <ul class="right hide-on-med-and-down">
      	<li>
      		<a href="#" class="dropdown-button" data-activates="userdropdown">
      			<i class="mdi-action-account-circle left"></i>
      			<?php if (!empty($username)) {
                    echo $username;
                } ?>
      		</a>
      	</li>

<!--          search button-->
        <li><a href="#"><i class="mdi-action-search left"></i>search</a></li>

<!--          app button-->
        <li><a href="#"><i class="mdi-action-view-module left"></i>app</a></li>
      </ul>
    </div>
  </nav>
</div>


<div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
    <a class="btn-floating btn-large red">
        <i class="large mdi-editor-mode-edit"></i>
    </a>
    <ul>
        <li><a class="btn-floating red"><i class="large mdi-editor-insert-chart"></i></a></li>
        <li><a class="btn-floating yellow darken-1"><i class="large mdi-editor-format-quote"></i></a></li>
        <li><a class="btn-floating green"><i class="large mdi-editor-publish"></i></a></li>
        <li><a class="btn-floating blue"><i class="large mdi-editor-attach-file"></i></a></li>
    </ul>
</div>


<!-- Page Layout here -->
<div class="row main-page">


  <div class="col s3 m3">
    <!-- Grey navigation panel -->
    <div class="sidenav center">

        <ul class="collapsible " data-collapsible="expandable">
            <li>
                <div class="collapsible-header sidenav-item"><a>Home</a></div>
            </li>
            <li>
                <div class="collapsible-header sidenav-item"><a>Video</a></div>
            </li>
            <li>
                <div class="collapsible-header sidenav-item"><a>Sound</a></div>
            </li>
            <li>
                <div class="collapsible-header sidenav-item"><a>Image</a></div>
            </li>
            <li>
                <div class="collapsible-header sidenav-item"><a>Recently</a></div>
            </li>
            <li>
                <div class="collapsible-header sidenav-item"><a>Uploading</a></div>
                <div class="progress button-on">
                    <div id="bar" class="determinate" style="width: 0%"></div>
                </div>
                <div class="collapsible-body">
                    <p>There is no file uploading.</p>
                </div>
            </li>
        </ul>
        <div class="info">
            
        </div>
    </div>
  </div>

<!--    file submit form    -->
    <div class="col s9 m9">
        <div class="toolbar">
            <div class="buttons">
                <a id="upload" class="waves-effect waves-light btn modal-trigger" href="#file-dialog">
                    <i class="mdi-file-cloud-upload left"></i>
                    Upload
                </a>
                <a class="waves-effect waves-light btn modal-trigger" href="#folder-dialog">
                    <i class="mdi-content-add-box left"></i>
                    New Folder
                </a>
                <button id="download" class="waves-effect waves-light btn disabled">
                    <i class="mdi-file-cloud-download left"></i>
                    Download
                </button>
            </div>
            <div class="row path">
                <a id="path-back" class="waves-effect waves-teal btn-flat"><-back</a>
                <a id="url" class="waves-effect waves-teal btn-flat"></a>
            </div>


            <div id="file-dialog" class="modal">
                <form id="fileSubmit" action="server/upload" method="post" enctype="multipart/form-data">
                    <div class="input-field">
                        <div class="row modal-content">
                            <input type="file" class="btn-flat" name="file_upload"/>
                        </div>
                        <div class="modal-footer">
                            <input type="submit" class="btn-flat modal-close" value='Upload'/>
                        </div>
                    </div>
                </form>
            </div>
            <div id="folder-dialog" class="modal">
                <div class="row modal-content">
                    <div class="col s6 m6 offset-s3 offset-m3 input-field">
                        <input id="new-folder-name" type="text" class="validate">
                        <label for="new-folder-name">New folder name</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <a id="new-folder" class="modal-action waves-effect waves-green btn-flat ">Agree</a>
                    <a class="modal-action modal-close waves-effect waves-green btn-flat ">Cancel</a>
                </div>
            </div>
        </div>
<!--		<div id="progress">-->
<!--			<div id="bar"></div>-->
<!--			<div id="percent">0%</div>-->
<!--		</div>-->

<!--      file view-->
		<div class="fileview" id="file">
			<div class="row fileview-content">
			</div>
		</div>
	</div>

</div>
