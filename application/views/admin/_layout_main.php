<?php $this->load->view('admin/includes/header'); ?>
<!--<link href="assets/admin_temp/css/custom.css" rel="stylesheet" />-->
<script src="assets/admin_temp/plugins/slimscroll/jquery.slimscroll.min.js"></script>
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
<?php $this->load->view('admin/includes/header_menu'); ?>
		
<?php $this->load->view('admin/includes/left_menu'); ?>
<?php
if($admin_details->role=='super admin'){
	//$this->load->view('admin/includes/chat_list');
}
elseif(checkPermission('admin_permission',array('user_id'=>$admin_details->id,'type'=>'chat','value'=>1))){
	//$this->load->view('admin/includes/chat_list'); 
}
?>      

		<div class="sidebar-bg"></div>
		<!-- end #sidebar -->
		
		<!-- begin #content -->
		<div id="content" class="content">
<?php $this->load->view('admin/includes/address'); ?>
<?php $this->load->view($subview); ?>
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
<style>
.chatbox{
z-index:99999 !important;
}
</style>
<div id="chatWrap"></div>

</body>
</html>
