<?php $this->load->view('employee/includes/header'); ?>
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
	left: 0;
	padding: 8px 0 0 17%;
	position: fixed;
	
	width: 100%;
	bottom:0;
}
</style>

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
<?php $this->load->view('employee/includes/header_menu'); ?>
		
<?php $this->load->view('employee/includes/left_menu'); ?>
<?php // $this->load->view('employee/includes/chat_list'); ?>
		<div class="sidebar-bg"></div>
		<!-- end #sidebar -->
		
		<!-- begin #content -->
<div id="content" class="content">
	<?php $this->load->view('employee/includes/address'); ?>
    <?php $this->load->view($subview); ?>
</div>

<div class="footer-wrapper">
<div  style="text-align:center;color:#FFF">
© All rights reserved 

<?php
$memU = $this->comman_model->get_by('users',array('id'=>$user_details->parent_id),false,false,true);
if($memU){
	$DD = $this->comman_model->get_by('users',array('id'=>$memU->parent_id),false,false,true);
	if($DD){
		echo $DD->company_name;
	}
}
?>
&nbsp;&nbsp;<a href="<?=$_user_link.'/condition'?>">Terms and Conditions</a>

</div>

</div>
		<!-- end #content -->
		
		
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
<div id="chatWrap"></div>
<?php
$checkParent = $this->comman_model->get_by('users',array('id'=>$this->data['user_details']->parent_id),false,false,true);
if($checkParent){
	$checkDealerStatus = $this->comman_model->get_by('users',array('id'=>$checkParent->parent_id),false,false,true);
	if($checkDealerStatus){
		if($checkDealerStatus->status==0){
			$uri_string = uri_string();
			if($uri_string!=$lang_code.'/member/inactive')
				redirect($lang_code.'/user/inactive');
		}
	}
	else{
		redirct($lang_code.'/user/account/logout');
	}
}
else{
	redirct($lang_code.'/user/account/logout');
}
?>

</body>
</html>
