<script>
jQuery(document).ready(function() {
	jQuery(window).load(function() { 
		getUserUpdate();
		//getCameraOnLeft();
		getCameraRemove();
		inactive_send_mail();
//		setInterval("getUserUpdate()", 60*1000); // Get users-online every 5 seconds 
	});
});

function inactive_send_mail(){
	$.ajax({
		type: 'GET',
		url : "<?='/ajax_debt/last_date_amount'?>",
		dataType:'json',
		success: function(data){}
	});
	$.ajax({
		type: 'GET',
		url : "<?=$lang_code.'/ajax_user_amount/send_3'?>",
		dataType:'json',
		success: function(data){}
	});
	$.ajax({
		type: 'GET',
		url : "<?=$lang_code.'/ajax_user_amount/send_6'?>",
		dataType:'json',
		success: function(data){}
	});
	$.ajax({
		type: 'GET',
		url : "<?=$lang_code.'/ajax_user_amount/send_14'?>",
		dataType:'json',
		success: function(data){}
	});
	$.ajax({
		type: 'GET',
		url : "<?=$_user_link.'/ajax_user/inactive_dealer'?>",
		dataType:'json',
		success: function(data){}
	});
}
function getUserUpdate(){
	$.ajax({
		type: 'GET',
		url : "<?=$_user_link.'/account/userDetail'?>",
		async : true,
		cache : false,
		dataType:'json',
		success: function(data){
/*			if(data.requestCount>0){
				$('.requestCount').html(data.requestCount);
				$('.requestCount').addClass('badge');			
			}
			else{
				$('.requestCount').html('');
				$('.requestCount').removeClass('badge');
			}*/
		}
	});
}

function getCameraOnLeft(){}

function getCameraRemove(){
	$.ajax({
		type: 'GET',
		url : "<?='ajax_send/ajax32'?>",
		cache : false,
		dataType:'json',
		success: function(data){
			//console.log('ok');
		}
	});
}



</script>
<style>
.sub-menu .badge, .sidebar .nav > li > a .badge{
	background-color:#0C0;	
}
#sidebar li > a > span,
#sidebar li .sub-menu li a{
	font-weight:bold;
	
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
                <div class="info"><?=$user_details->username;?>
                <br>

                </div>
                
                <div class="info hidden-md hidden-lg">
                <br>
<strong><?=show_static_text($lang_id,130);?></strong> : <?=($user_details->total_point)?> &nbsp;&nbsp;&nbsp;
<strong><?=show_static_text($lang_id,2050);?>Income Balance</strong> : <?=$user_details->credits_point?>&nbsp;&nbsp;&nbsp;
                
                </div>
            </li>
        </ul>
        <!-- end sidebar user -->
        <!-- begin sidebar nav -->
        <ul class="nav">
<!--<li <?php echo $active=='hosme'?'class=" active"':'class=""'; ?> >
    <a href="<?=$lang_code?>" target="">
    <i class="fa fa-home"></i>
    <span class="title">Visit</span>
    </a>
</li>-->

<li <?php echo $active=='home'?'class=" active"':'class=""'; ?> >
    <a href="<?=$_user_link?>" target="">
    <i class="fa fa-home"></i>
    <span class="title"><?=show_static_text($lang_id,80);?></span>
    </a>
</li>

<!--<li <?php echo $active=='Profile'?'class="active"':''; ?>>
    <a href="<?=$_user_link.'/account/edit_profile'?>" target="">
    <i class="fa fa-pencil-square-o"></i>
    <span class="title">Edit Profile</span>
    </a>
</li>-->

<li class="has-sub <?=$active=='People'?'active':''; ?> ">
    <a href="javascript:;">
        <b class="caret pull-right"></b>
        <i class="fa fa-users"></i>
        <span><?=show_static_text($lang_id,31006);?>Client Management</span> 
    </a>
    <ul class="sub-menu">
        <li><a href="<?=$_user_link.'/user'?>"><?=show_static_text($lang_id,13900);?>Client</a></li>
        <li><a href="<?=$_user_link.'/c_camera'?>"><?=show_static_text($lang_id,13900);?>Client Camera</a></li>
<?php
if($user_details->is_set_price==1){
?>
        <li><a href="<?=$_user_link.'/client_plan'?>"><?=show_static_text($lang_id,13900);?>Client Plan</a></li>
<?php
}
?>        
    </ul>
</li>

<li <?php echo $active=='Staff'?'class="active"':''; ?> >
    <a href="<?=$_user_link.'/staff'?>" target="">
    <i class="fa fa-user"></i>
    <span class="title"><?=show_static_text($lang_id,1031);?>Staff Management</span>
    </a>
</li>

<li class="has-sub <?=$active=='Content Management'?'active':''; ?> ">
    <a href="javascript:;">
        <b class="caret pull-right"></b>
        <i class="fa fa-life-ring"></i>
        <span><?=show_static_text($lang_id,31006);?>Content Management</span> 
    </a>
    <ul class="sub-menu">
        <li><a href="<?=$_user_link.'/email_setup'?>"><?=show_static_text($lang_id,13900);?>E-mail Server Setup</a></li>
        <li><a href="<?=$_user_link.'/support'?>"><?=show_static_text($lang_id,13900);?>Client's Support Info</a></li>
        
        <li><a href="<?=$_user_link.'/notification'?>"><?=show_static_text($lang_id,13900);?>Notifications</a></li>
        <li><a href="javascript:void(0);" data-toggle="modal" data-target="#referralModal" ><?=show_static_text($lang_id,13900);?>Client Self Registration Link</a></li>
    </ul>
</li>


<li class="has-sub <?=$active=='Home'?'active':''; ?> ">
    <a href="javascript:;">
        <b class="caret pull-right"></b>
        <i class="fa fa-paypal"></i>
        <span><?=show_static_text($lang_id,3080);?>Payment Account</span> 
    </a>
    <ul class="sub-menu">
        <li><a href="<?=$_user_link.'/paypal_account'?>"><?=show_static_text($lang_id,1350);?>PayPal Account</a></li>
        <li><a href="<?=$_user_link.'/paypal_account/settings'?>"><?=show_static_text($lang_id,1350);?>Settings</a></li>
    </ul>
</li>



<li <?php echo $active=='Payment History'?'class="active"':''; ?> >
    <a href="<?=$_user_link.'/payment_history'?>" target="">
    <i class="fa fa-list-ul"></i>
    <span class="title"><?=show_static_text($lang_id,1031);?>Payment History</span>
    </a>
</li>


<li class="has-sub <?=$active=='Update Balance'?'active':''; ?> ">
    <a href="javascript:;">
        <b class="caret pull-right"></b>
        <i class="fa fa-book"></i>
        <span><?=show_static_text($lang_id,3080);?>Monthly Payment</span> 
    </a>
    <ul class="sub-menu">
        <li><a href="<?=$_user_link.'/update_balance'?>">Make Monthly Payment</a></li>
        <li><a href="<?=$_user_link.'/user_payment_history'?>"><?=show_static_text($lang_id,1350);?>Payment History</a></li>
    </ul>
</li>


<li class="<?php echo $active=='condition'?'active':''; ?> hidden-md hidden-lg" >
    <a href="<?=$_user_link.'/condition'?>" target="">
    <i class="fa fa-life-ring"></i>
    <span class="title"><?=show_static_text($lang_id,1031);?>Terms and Conditions</span>
    </a>
</li>

<li class="<?php echo $active=='Support'?'active':''; ?> hidden-md hidden-lg" >
    <a href="<?=$_user_link.'/supports'?>" target="">
    <i class="fa fa-life-ring"></i>
    <span class="title"><?=show_static_text($lang_id,1031);?>Support Information</span>
    </a>
</li>

<li <?php echo $active=='Ticket Management'?'class="active"':''; ?> >
    <a href="<?=$_user_link.'/ticket'?>" target="">
    <i class="fa fa-ticket"></i>
    <span class="title"><?=show_static_text($lang_id,131);?></span>
    </a>
</li>

            
            
            <!-- begin sidebar minify button -->
            <li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li>
            <!-- end sidebar minify button -->
        </ul>
        <!-- end sidebar nav -->
    </div>
    <!-- end sidebar scrollbar -->
</div>


