<style>
.navbar-default .navbar-brand{
	background:#454E57;
	color:#FFF;
	font-size:17px;
	font-weight:600;
}
.navbar-default .navbar-brand:hover{
	background:#454E57;
	color:#FFF;
}
</style>
<!-- begin #header -->
<div id="header" class="header navbar navbar-default navbar-fixed-top">
    <!-- begin container-fluid -->
    <div class="container-fluid">
        <!-- begin mobile sidebar expand / collapse button -->
        <div class="navbar-header">
					<a href="" class="navbar-brand"><?=$settings['site_name']?></a>
            <button type="button" class="navbar-toggle" data-click="sidebar-toggled">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <!-- end mobile sidebar expand / collapse button -->
        
        <!-- begin header navigation right -->
        <ul class="nav navbar-nav navbar-right">
            <!--<li>
                <form class="navbar-form full-width">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Enter keyword" />
                        <button type="submit" class="btn btn-search"><i class="fa fa-search"></i></button>
                    </div>
                </form>
            </li>-->            
            <li class="dropdown navbar-user">
                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                    <img src="assets/uploads/admin/profile.jpg" alt="" /> 
                    <span class="hidden-xs"><?=$admin_details->username?>
</span> <b class="caret"></b>
                </a>
                <ul class="dropdown-menu animated fadeInLeft">
                    <li class="arrow"></li>
<?php
if($admin_details->role=='super admin'){
?>
<li><a href="<?=$admin_link.'/account/setting'?>">Web Profile Setting</a></li>
<?php
}
else if(checkPermission('admin_permission',array('user_id'=>$admin_details->id,'type'=>'general_setting','value'=>1))){
?>
<li><a href="<?=$admin_link.'/account/setting'?>">Web Profile Setting</a></li>
<?php
}
?>
                    <li><a href="<?=$admin_link?>/account/change_password"><?=show_static_text($adminLangSession['lang_id'],50);?></a></li>
                    <li class="divider"></li>
                    <li><a href="<?=$admin_link?>/account/logout"><?=show_static_text($adminLangSession['lang_id'],57);?></a></li>
                </ul>
            </li>
<?php
if($admin_details->role=='super admin'){
?>
<!--      <li>				
		<a href="#menu-toggle" id="menu-toggle"><i class="fa fa-comments"></i></a>
	  </li>-->
<?php
}
elseif(checkPermission('admin_permission',array('user_id'=>$admin_details->id,'type'=>'chat','value'=>1))){
?>
<!--      <li>				
		<a href="#menu-toggle" id="menu-toggle"><i class="fa fa-comments"></i></a>
	  </li>-->
<?php
}
?>      
        </ul>
        <!-- end header navigation right -->
    </div>
    <!-- end container-fluid -->
</div>
<!-- end #header -->
