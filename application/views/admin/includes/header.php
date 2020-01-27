<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
    <title><?php echo $title;?></title>
    <base href="<?php echo base_url();?>" />

	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	
	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="//fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
	<link href="assets/admin_temp/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css" rel="stylesheet" />
	<link href="assets/admin_temp/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	<link href="assets/admin_temp/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
	<link href="assets/admin_temp/css/animate.min.css" rel="stylesheet" />
	<link href="assets/admin_temp/css/style.min.css" rel="stylesheet" />
	<link href="assets/admin_temp/css/style-responsive.min.css" rel="stylesheet" />
	<link href="assets/admin_temp/css/theme/default.css" rel="stylesheet" id="theme" />
	<!-- ================== END BASE CSS STYLE ================== -->
	
	<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
<!--	<link href="assets/admin_temp/plugins/jquery-jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" />-->
	<link href="assets/admin_temp/plugins/bootstrap-datepicker/css/datepicker.css" rel="stylesheet" />
	<link href="assets/admin_temp/plugins/bootstrap-datepicker/css/datepicker3.css" rel="stylesheet" />
<!--    <link href="assets/admin_temp/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" />-->
	<!-- ================== END PAGE LEVEL STYLE ================== -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="assets/admin_temp/plugins/pace/pace.min.js"></script>
	<!-- ================== END BASE JS ================== -->


	<script src="assets/admin_temp/plugins/jquery/jquery-1.9.1.min.js"></script>
	<script src="assets/admin_temp/plugins/jquery/jquery-migrate-1.1.0.min.js"></script>
	<script src="assets/admin_temp/plugins/jquery-ui/ui/minified/jquery-ui.min.js"></script>
	<script src="assets/admin_temp/plugins/bootstrap/js/bootstrap.min.js"></script>


<!--<script>
setInterval("admin_update()", 5000); // Update every 5 seconds 
function admin_update(){ 
	$.post("admin/chat/online_update"); // Sends request to update.php 

	$.ajax({
		type:"POST",
		url:"admin/chat/read_message",
		data:"id=1",
		dataType:'json',
		success:function(data){
			if(data['result']=='success'){
				$('.count-message').html(data['count']);
			}
			else{
				$('.count-message').html('');
			}
		}
	}); // Sends request to update.php 
} 

</script>        
-->


</head>
<!-- END HEAD -->
