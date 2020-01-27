<?php $this->load->view('ownner/includes/header'); ?>
<style>
.sidebar .nav>li.active>a,
.sidebar .nav>li.active>a:focus,
.sidebar .nav>li.active>a:hover {
    color: #fff;
    background: #FF871C
}
.footer-wrapper{	
	background: #2D353C;
	height: 35px;
	padding: 8px 0 0 17%;
	position: fixed;	
	width: 100%;
	left: 0;
	bottom:0;
}

</style>
<!--<link href="assets/admin_temp/css/custom.css" rel="stylesheet" />
<link href="assets/admin_temp/css/chat.css" rel="stylesheet" />-->

	<script src="assets/admin_temp/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<!--	<script src="assets/admin_temp/plugins/jquery-cookie/jquery.cookie.js"></script>-->
	<!-- ================== END BASE JS ================== -->
	
	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<!--	<script src="assets/admin_temp/plugins/gritter/js/jquery.gritter.js"></script>
	<script src="assets/admin_temp/plugins/flot/jquery.flot.min.js"></script>
	<script src="assets/admin_temp/plugins/flot/jquery.flot.time.min.js"></script>
	<script src="assets/admin_temp/plugins/flot/jquery.flot.resize.min.js"></script>
	<script src="assets/admin_temp/plugins/flot/jquery.flot.pie.min.js"></script>
	<script src="assets/admin_temp/plugins/sparkline/jquery.sparkline.js"></script>
	<script src="assets/admin_temp/plugins/jquery-jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
	<script src="assets/admin_temp/plugins/jquery-jvectormap/jquery-jvectormap-world-mill-en.js"></script>-->
<!--	<script src="assets/admin_temp/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>-->
	<script src="assets/admin_temp/js/dashboard.min.js"></script>
	<script src="assets/admin_temp/js/apps.min.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->
	
	<script>
		$(document).ready(function() {
			App.init();
			//Dashboard.init();
		});
	</script>

<?php
if(isset($table)){
?>


<link href="assets/admin_temp/plugins/DataTables/css/data-table.css" rel="stylesheet" />
<script src="assets/admin_temp/plugins/DataTables/js/jquery.dataTables.js"></script>
<script src="assets/admin_temp/js/table-manage-default.demo.min.js"></script>

<script>
$(document).ready(function() {
	TableManageDefault.init();
});
</script>

<?php
}
?>


<body>
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade in"><span class="spinner"></span></div>
	<!-- end #page-loader -->
	
	<!-- begin #page-container -->
	<div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
<?php $this->load->view('ownner/includes/header_menu'); ?>
		
<?php $this->load->view('ownner/includes/left_menu'); ?>
<?php // $this->load->view('ownner/includes/chat_list'); ?>
		<div class="sidebar-bg"></div>
		<!-- end #sidebar -->
		
		<!-- begin #content -->
		<div id="content" class="content">
<?php $this->load->view('ownner/includes/address'); ?>
<?php $this->load->view($subview); ?>
</div>
		<!-- end #content -->

<div class="footer-wrapper">
<div  style="text-align:center;color:#FFF">
<?=show_static_text($lang_id,66)?>
&nbsp;&nbsp;<a href="<?=$_user_link.'/condition'?>">Terms and Conditions</a>
</div>

</div>
		
		
		<!-- begin scroll to top btn -->
		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
		<!-- end scroll to top btn -->
	</div>
	<!-- end page container -->
<script>
$("#menu-toggle").click(function(e) {
	e.preventDefault();
	$("#wrapper").toggleClass("toggled");
});


</script>	
	<!-- ================== BEGIN BASE JS ================== -->
	<!--[if lt IE 9]>
		<script src="assets/admin_temp/crossbrowserjs/html5shiv.js"></script>
		<script src="assets/admin_temp/crossbrowserjs/respond.min.js"></script>
		<script src="assets/admin_temp/crossbrowserjs/excanvas.min.js"></script>
	<![endif]-->

<div class="modal fade" id="referralModal" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    ×</button>
                <h4 class="modal-title" id="myModalLabel">Client Self Registration Link</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12" style="border-right: 1px dotted #C2C2C2;padding-right: 30px;min-height:45px;">

<?php
if(!empty($user_details->company_name)){
?>

                    <?=site_url($lang_code.'/l/'.url_title($user_details->company_name, 'dash', true).'/'.$user_details->id)?>

<hr>
<h4 style="text-align:center">Or Share</h4>
<div class="" style="text-align:center">
    	                    <div class="links-post" style="display:block">

<a href="http://www.facebook.com/sharer/sharer.php?u=<?=site_url($lang_code.'/l/'.url_title($user_details->company_name, 'dash', true).'/'.$user_details->id)?>" target="_blank" class="btn btn-social-icon btn-facebook">
    <i class="fa fa-facebook"></i>
</a>

<a href="https://plus.google.com/share?url=<?=site_url($lang_code.'/l/'.url_title($user_details->company_name, 'dash', true).'/'.$user_details->id)?>" target="_blank" class="btn btn-social-icon btn-google-plus">
    <i class="fa fa-google-plus"></i>
</a>

<a href="http://twitter.com/share?url=<?=site_url($lang_code.'/l/'.url_title($user_details->company_name, 'dash', true).'/'.$user_details->id)?>&text=Re" target="_blank" class="btn btn-social-icon btn-twitter">
    <i class="fa fa-twitter"></i>
</a>

<a href="http://www.linkedin.com/shareArticle?url=<?=site_url($lang_code.'/l/'.url_title($user_details->company_name, 'dash', true).'/'.$user_details->id)?>&title=Referrals Link&summary=<?=site_url($lang_code.'/l/'.url_title($user_details->company_name, 'dash', true).'/'.$user_details->id)?>" target="_blank" class="btn btn-social-icon btn-linkedin">
    <i class="fa fa-linkedin"></i>
</a>

                    </div>
	                    </div>
<?php
}
else{
	echo '<h5>Please Update your profile</h5>';
}
?>

                    </div>                    
                </div>
            </div>
        </div>
    </div>
</div>

<div id="chatWrap"></div>
<?php
if($user_details->status==0){
	$uri_string = uri_string();
	if($uri_string==$lang_code.'/dealer/account'||$uri_string==$lang_code.'/dealer/update_balance'){
	}
	else{
		redirect($lang_code.'/dealer/account');
	}
}
?>
</body>
</html>
