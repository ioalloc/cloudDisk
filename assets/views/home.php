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
<div class="row">


  <div class="col s3 m3">
    <!-- Grey navigation panel -->
    <div class="sidenav center">

        <ul class="collapsible" data-collapsible="expandable">
            <li>
                <div class="collapsible-header">All File</div>
            </li>
            <li>
                <div class="collapsible-header">Video</div>
            </li>
            <li>
                <div class="collapsible-header">Sound</div>
            </li>
            <li>
                <div class="collapsible-header">Image</div>
            </li>
            <li>
                <div class="collapsible-header">Recently</div>
            </li>
            <li>
                <div class="collapsible-header">Uploading</div>
                <div class="progress button-on">
                    <div class="determinate" style="width: 65%"></div>
                </div>
                <div class="collapsible-body">
                    <p>There is no file uploading.</p>
                </div>
            </li>
            <li class="divider"></li>
            <li>
                <div class="collapsible-header">Downloading</div>
                <div class="progress button-on">
                    <div class="determinate" style="width: 44%"></div>
                </div>
                <div class="collapsible-body">
                    <div class="progress progress-list">
                        <div class="determinate center" style="width: 44%">
                        </div>
                    </div>
                </div>
            </li>
        </ul>
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
            </div>
            <div class="row path">
                <a id="path-back" class="waves-effect waves-light btn">
                    <i class="mdi-content-reply left"></i>
                </a>
                <a class="waves-effect waves-teal btn-flat">/home</a>
                <a class="waves-effect waves-teal btn-flat">/file</a>
                <a class="waves-effect waves-teal btn-flat">/Dir</a>
            </div>


            <div id="file-dialog" class="modal">
                <form id="fileSubmit" action="server/upload" method="post" enctype="multipart/form-data">
                    <div class="input-field">
                        <div class="row modal-content">
                            <input type="file" class="btn-flat" name="file_upload"/>
                        </div>
                        <div class="modal-footer">
                            <input type="submit" class="btn-flat" value='Upload'/>
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
		<div id="message"></div>
	</div>

</div>
