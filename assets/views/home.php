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
                <div class="collapsible-body">
                    <p>There is no file uploading.</p>
                </div>
            </li>
            <li class="divider"></li>
            <li>
                <div class="collapsible-header">Downloading</div>
                <div class="collapsible-body">
                    <p>There is no file downloading.</p>
                </div>
            </li>
        </ul>
    </div>
  </div>

<!--    file submit form    -->
  <div class="col s9 m9">
      <div class="toolbar">
          <div class="buttons">
              <a class="waves-effect waves-light btn">
                  <i class="mdi-file-cloud-upload left"></i>
                  Upload
              </a>
              <a class="waves-effect waves-light btn">
                  <i class="mdi-content-add-box left"></i>
                  New Folder
              </a>
          </div>
          <div class="row path">
              <a class="waves-effect waves-teal btn-flat">/home</a>
              <a class="waves-effect waves-teal btn-flat">/file</a>
              <a class="waves-effect waves-teal btn-flat">/Dir</a>
          </div>
<!--          <form id="fileSubmit" action="server/upload" method="post" enctype="multipart/form-data">-->
<!--            <div class="file-field input-field">-->
<!--                <div class="row">-->

<!--                    file select button      -->
<!--                    <div class="col s1 btn">-->
<!--                        <span>File</span>-->
<!--                        <input type="file" name="file_upload"/>-->
<!--                    </div>-->

<!--                    file path-->
<!--                    <div class="col s8">-->
<!--                      <input class="file-path validate" type="text"/>-->
<!--                    </div>-->
<!---->
<!--                    submit button-->
<!--                    <div class="col s1">-->
<!--                      <input type="submit" class="" value='Upload'/>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--          </form>-->
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
