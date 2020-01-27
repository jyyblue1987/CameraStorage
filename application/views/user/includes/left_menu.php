<?php
if($user_details->account_type=='A'){
?>
<script>
jQuery(document).ready(function() {
	jQuery(window).load(function() { 
		getUserUpdate();
		getUserUpdate2();
		getUserUpdate3();
	});
});

function getUserUpdate(){
	$.ajax({
		type: 'GET',
		url : "<?=$_user_link.'/account/save_file'?>",
		async : true,
		cache : false,
		dataType:'json',
		success: function(data){
			if(data.connect>0){
				$('.cameraCount').html(data.connect);
				$('.cameraCount').addClass('badge');			
			}
			else{
				$('.cameraCount').html('');
				$('.cameraCount').removeClass('badge');
			}
		}
	});
}
function getUserUpdate2(){
	$.ajax({
		type: 'GET',
		url : "<?=$_user_link.'/account/notification'?>",
		async : true,
		cache : false,
		dataType:'json',
		success: function(data){
		}
	});
}

function getUserUpdate3(){
	$.ajax({
		type: 'GET',
		url : "<?='ajax_send/ajax4321'?>",
		async : true,
		cache : false,
		dataType:'json',
		success: function(data){
		}
	});
}

</script>
<?php
}
?>

<style>
.sub-menu .badge, .sidebar .nav > li > a .badge{
	background-color:#EA4335;	
}
</style>

<div id="sidebar" class="sidebar">
    <!-- begin sidebar scrollbar -->
    <div data-scrollbar="true" data-height="100%">
        <!-- begin sidebar user -->
        <ul class="nav">
            <li class="nav-profile">
                <div class="image">
                    <a href="javascript:;"><img src="<?=!empty($user_details->image)?'assets/uploads/users/thumbnails/'.$user_details->image:'assets/uploads/profile.jpg'?>" alt="" /></a>
                </div>
                <div class="info"><?=$user_details->first_name.' '.$user_details->last_name;?></div>
            </li>
        </ul>
        <!-- end sidebar user -->
        <!-- begin sidebar nav -->
        <ul class="nav">

<li <?php echo $active=='home'?'class=" active"':'class=""'; ?> >
    <a href="<?=$_user_link?>" target="">
    <i class="fa fa-home"></i>
    <span class="title"><?=show_static_text($lang_id,80000);?>Live Cameras</span>
    </a>
</li>

<li <?php echo $active=='playback'?'class=" active"':'class=""'; ?> >
    <a href="<?=$_user_link.'/playback_camera'?>" target="">
    <i class="fa fa-camera"></i>
    <span class="title"><?=show_static_text($lang_id,80000);?>Playback Camera</span>
    </a>
</li>

<!--<li <?php echo $active=='Profile'?'class="active"':''; ?>>
    <a href="<?=$_user_link.'/account/edit_profile'?>" target="">
    <i class="fa fa-pencil-square-o"></i>
    <span class="title">Edit Profile</span>
    </a>
</li>-->
<li <?php echo $active=='Camera'?'class="active"':''; ?>>
    <a href="<?=$_user_link.'/camera'?>" target="">
		<i class="fa fa-video-camera"></i>
    	<span class="title"><?=show_static_text($lang_id,5004);?>Settings</span> <span class="cameraCount pull-right"></span>
    </a>
</li>

<li <?php echo $active=='Group'?'class="active"':''; ?>>
    <a href="<?=$_user_link.'/group'?>" target="">
		<i class="fa fa-users"></i>
    	<span class="title"><?=show_static_text($lang_id,5004);?>Group</span> 
    </a>
</li>

<li <?php echo $active=='Employee'?'class="active"':''; ?>>
    <a href="<?=$_user_link.'/employee'?>" target="">
		<i class="fa fa-user"></i>
    	<span class="title"><?=show_static_text($lang_id,5004);?>User</span> 
    </a>
</li>


<li <?php echo $active=='Payment History'?'class="active"':''; ?>>
    <a href="<?=$_user_link.'/payment_history'?>" target="">
		<i class="fa fa-list-ul"></i>
    	<span class="title"><?=show_static_text($lang_id,5004);?>Payment History</span> 
    </a>
</li>

<li class="<?php echo $active=='Support'?'active':''; ?> hidden-md hidden-lg" >
    <a href="<?=$_user_link.'/support'?>" target="">
    <i class="fa fa-life-ring"></i>
    <span class="title"><?=show_static_text($lang_id,1031);?>Support Information</span>
    </a>
</li>




<!--
<li class="has-sub <?=$active=='User Management'?'active':''; ?> ">
    <a href="javascript:;">
        <b class="caret pull-right"></b>
        <i class="fa fa-users"></i>
        <span><?=show_static_text($lang_id,177);?></span> 
    </a>
    <ul class="sub-menu">
        <li><a href="<?=$lang_code?>/userlist/agency"><?=show_static_text($lang_id,1780);?>Agency</a></li>
        <li><a href="<?=$lang_code?>/userlist"><?=show_static_text($lang_id,178);?></a></li>
    </ul>
</li>-->



            
            
            
            
            <!-- begin sidebar minify button -->
            <li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li>
            <!-- end sidebar minify button -->
        </ul>
        <!-- end sidebar nav -->
    </div>
    <!-- end sidebar scrollbar -->
</div>






