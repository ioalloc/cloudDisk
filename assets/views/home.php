<!--dropdown selections-->
<ul id="userdropdown" class="dropdown-content">
  <li><a href="#">我的资料</a></li>
  <li><a href="#">我的账户</a></li>
  <li class="divider"></li>
  <li id="logout"><a href="#">注销</a></li>
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
        <li><a href="#"><i class="mdi-action-search left"></i>搜索</a></li>

<!--          app button-->
        <li><a href="#"><i class="mdi-action-view-module left"></i>应用</a></li>
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
                <div class="collapsible-header sidenav-item"><a>文件</a></div>
            </li>
            <li>
                <div class="collapsible-header sidenav-item"><a>视频</a></div>
            </li>
            <li>
                <div class="collapsible-header sidenav-item"><a>音乐</a></div>
            </li>
            <li>
                <div class="collapsible-header sidenav-item"><a>图片</a></div>
            </li>
            <li>
                <div class="collapsible-header sidenav-item"><a>最近</a></div>
            </li>
            <li>
                <div class="collapsible-header sidenav-item"><a>上传</a></div>
                <div class="progress button-on">
                    <div id="bar" class="determinate" style="width: 0%"></div>
                </div>
                <div class="collapsible-body">
                    <p>没有上传的文件。</p>
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
                <button id="upload" class="waves-effect waves-light btn modal-trigger" href="#file-dialog">
                    <i class="mdi-file-cloud-upload left"></i>
                    上传
                </button>
                <button class="waves-effect waves-light btn modal-trigger" href="#folder-dialog">
                    <i class="mdi-content-add-box left"></i>
                    新建文件夹
                </button>
                <button id="btn-rename" class="waves-effect waves-light btn modal-trigger disabled" href="#file-rename">
                    <i class="mdi-editor-border-color left"></i>
                    重命名
                </button>
                <button id="download" class="waves-effect waves-light btn disabled">
                    <i class="mdi-file-cloud-download left"></i>
                    下载
                </button>
                <button id="btn-delete" class="waves-effect waves-light btn modal-trigger disabled">
                    <i class="mdi-action-delete left"></i>
                    删除
                </button>
            </div>
            <div class="row path">
                <a id="path-back" class="waves-effect waves-teal btn-flat"><-后退</a>
                <a id="url" class="waves-effect waves-teal btn-flat"></a>
            </div>


            <div id="file-dialog" class="modal">
                <form id="fileSubmit" action="server/upload" method="post" enctype="multipart/form-data">
                    <div class="input-field">
                        <div class="row modal-content">
                            <input type="file" class="btn-flat" name="file_upload"/>
                        </div>
                        <div class="modal-footer">
                            <input type="submit" class="btn-flat modal-close" value='上传'/>
                            <a class="modal-action modal-close waves-effect waves-green btn-flat ">取消</a>
                        </div>
                    </div>
                </form>
            </div>
            <div id="folder-dialog" class="modal">
                <div class="row modal-content">
                    <div class="col s6 m6 offset-s3 offset-m3 input-field">
                        <input id="new-folder-name" type="text" class="validate">
                        <label for="new-folder-name">文件夹名</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <a id="new-folder" class="modal-action waves-effect waves-green btn-flat ">同意</a>
                    <a class="modal-action modal-close waves-effect waves-green btn-flat ">取消</a>
                </div>
            </div>
            <div id="file-rename" class="modal">
                <div class="row modal-content">
                    <div class="col s6 m6 offset-s3 offset-m3 input-field">
                        <input id="new-file-name" type="text" class="validate">
                        <label for="new-file-name">新文件名</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <a id="rename" class="modal-action waves-effect waves-green btn-flat ">同意</a>
                    <a class="modal-action modal-close waves-effect waves-green btn-flat ">取消</a>
                </div>
            </div>
            <div id="file-delete" class="modal">
                <div class="row modal-content">
                    <div class="col s6 m6 offset-s3 offset-m3">
                        确定要删除这些文件吗？
                    </div>
                </div>
                <div class="modal-footer">
                    <a id="delete-file" class="modal-action waves-effect waves-green btn-flat ">确定</a>
                    <a class="modal-action modal-close waves-effect waves-green btn-flat ">取消</a>
                </div>
            </div>
            <div id="folder-delete" class="modal">
                <div class="row modal-content">
                    <div class="col s6 m6 offset-s3 offset-m3">
                        您没有选中任何文件，确定删除整个目录？
                    </div>
                </div>
                <div class="modal-footer">
                    <a id="delete-folder" class="modal-action waves-effect waves-green btn-flat ">确定</a>
                    <a class="modal-action modal-close waves-effect waves-green btn-flat ">取消</a>
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
