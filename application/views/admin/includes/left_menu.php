<style>
.sub-menu .badge, .sidebar .nav > li > a .badge{
	background-color:#0C0;	
}
</style>
<style>
.sub-menu .badge, .sidebar .nav > li > a .badge{
	background-color:#0C0;	
}
#sidebar li > a > span,
#sidebar li .sub-menu li a{
	font-weight:bold;
	
}
</style>

<script>
jQuery(document).ready(function() {
	jQuery(window).load(function() { 
		getUserUpdate();
		setInterval("getUserUpdate()", 60*1000); // Get users-online every 5 seconds 
	});
});

function getUserUpdate(){
	$.ajax({
		type: 'GET',
		url : "<?=$admin_link.'/ajax_admin/userDetail'?>",
		async : true,
		cache : false,
		dataType:'json',
		success: function(data){
			if(data.requestCount>0){
				$('.requestCount').html(data.requestCount);
				$('.requestCount').addClass('badge');			
			}
			else{
				$('.requestCount').html('');
				$('.requestCount').removeClass('badge');
			}
			if(data.publicChatCount>0){
				$('.publicChatCount').html(data.publicChatCount);
				$('.publicChatCount').addClass('badge');			
			}
			else{
				$('.publicChatCount').html('');
				$('.publicChatCount').removeClass('badge');
			}

		}
	});
}


</script>
<!--<style>
.sidebar .nav > li > a .badge{
	background:#777;	
}
</style>-->
<div id="sidebar" class="sidebar">
    <!-- begin sidebar scrollbar -->
    <div data-scrollbar="true" data-height="100%">
        <!-- begin sidebar user -->
        <ul class="nav">
            <li class="nav-profile">
                <div class="image">
                    <a href="javascript:;"><img src="assets/uploads/admin/profile.jpg" alt="" /></a>
                </div>
                <div class="info">Super Admin</div>
            </li>
        </ul>
        <!-- end sidebar user -->
        <!-- begin sidebar nav -->
        <ul class="nav">
                
                <li <?php echo $active=='home'?'class=" active"':'class=""'; ?> >
					<a href="<?=$admin_link?>/dashboard" target="">
					<i class="fa fa-home"></i>
					<span class="title"><?=show_static_text($adminLangSession['lang_id'],80);?></span>
					</a>
				</li>

            
            
            
<?php
if($admin_details->role=='super admin'){
?>
<li class="has-sub <?=$active=='General Settings'?'active':''; ?> ">
    <a href="javascript:;">
        <b class="caret pull-right"></b>
        <i class="fa fa-gears"></i>
        <span><?=show_static_text($adminLangSession['lang_id'],162);?></span> 
    </a>
    <ul class="sub-menu">
        <li><a href="<?=$admin_link?>/email"><?=show_static_text($adminLangSession['lang_id'],163);?></a></li>
        <li><a href="<?=$admin_link?>/account/socialnetwork"><?=show_static_text($adminLangSession['lang_id'],188);?></a></li>
        <li><a href="<?=$admin_link?>/language"><?=show_static_text($adminLangSession['lang_id'],164);?></a></li>
        <li><a href="<?=$admin_link?>/static_text"><?=show_static_text($adminLangSession['lang_id'],189);?></a></li>
        <li><a href="<?=$admin_link?>/update_lang"><?=show_static_text($adminLangSession['lang_id'],165);?></a></li>

        <li><a href="<?=$admin_link?>/backup"><?=show_static_text($adminLangSession['lang_id'],1650);?>Backup</a></li>
        <li><a href="<?=$admin_link?>/paypal_setting"><?=show_static_text($adminLangSession['lang_id'],1650);?>Paypal Setting</a></li>
        <li><a href="<?=$admin_link?>/account/background"><?=show_static_text($adminLangSession['lang_id'],1030);?>Background Image</a></li>
        <li><a href="<?=$admin_link?>/account/chat_setting"><?=show_static_text($adminLangSession['lang_id'],1650);?>Chat Setting</a></li>
        <li><a href="admin_dir"><?=show_static_text($adminLangSession['lang_id'],1020);?>Admin Link</a></li>
    </ul>
</li>


<li <?php echo $active=='Employee Management'?'class="active"':''; ?>>
    <a href="<?=$admin_link.'/admin_user'?>" target="">
    <i class="fa fa-users"></i>
    <span class="title">Employee Management<?=show_static_text($adminLangSession['lang_id'],4704);?></span>
    </a>
</li>

<li <?php echo $active=='Devices'?'class="active"':''; ?>>
    <a href="<?=$admin_link.'/device'?>" target="">
    <i class="fa fa-link"></i>
    <span class="title">Devices<?=show_static_text($adminLangSession['lang_id'],4704);?></span>
    </a>
</li>

<li class="has-sub <?=$active=='User Management'?'active':''; ?> ">
    <a href="javascript:;">
        <b class="caret pull-right"></b>
        <i class="fa fa-file-code-o"></i>
        <span>Dealer Management</span> 
    </a>
    <ul class="sub-menu">
        <li><a href="<?=$admin_link.'/dealer'?>">Dealer</a></li>
        <li><a href="<?=$admin_link.'/dealer_plan'?>">Custom Dealer Plan</a></li>
        <li><a href="<?=$admin_link.'/client_camera'?>">Dealers client's cameras</a></li>
        <li><a href="<?=$admin_link.'/camera'?>">Lost Connection Cameras</a></li>
    </ul>
</li>

<li class="has-sub <?=$active=='Membership Management'?'active':''; ?> ">
    <a href="javascript:;">
        <b class="caret pull-right"></b>
        <i class="fa fa-newspaper-o"></i>
        <span><?=show_static_text($adminLangSession['lang_id'],1850);?>Plans</span> 
    </a>
    <ul class="sub-menu">
        <li><a href="<?=$admin_link?>/plan"><?=show_static_text($adminLangSession['lang_id'],1806);?>Plan</a></li>
        <li><a href="<?=$admin_link?>/membership"><?=show_static_text($adminLangSession['lang_id'],1870);?>Membership Levels</a></li>		
    </ul>
</li>

<li <?php echo $active=='Payment History'?'class="active"':''; ?>>
    <a href="<?=$admin_link?>/payment_history" target="">
    <i class="fa fa-history"></i>
    <span class="title">Payment History<?=show_static_text($adminLangSession['lang_id'],4704);?></span>
    </a>
</li>


<li class="has-sub <?=$active=='Content Management'?'active':''; ?> ">
    <a href="javascript:;">
        <b class="caret pull-right"></b>
        <i class="fa fa-file-code-o"></i>
        <span><?=show_static_text($adminLangSession['lang_id'],180);?></span> 
    </a>
    <ul class="sub-menu">
        <li><a href="<?=$admin_link?>/content"><?=show_static_text($adminLangSession['lang_id'],181);?></a></li>
        <li><a href="<?=$admin_link?>/flash_note"><?=show_static_text($adminLangSession['lang_id'],1081);?>Flash Notice</a></li>
        <li><a href="<?=$admin_link.'/notification'?>"><?=show_static_text($adminLangSession['lang_id'],18002);?>Notification</a></li>
        <li><a href="<?=$admin_link?>/default_image"><?=show_static_text($adminLangSession['lang_id'],16500);?>Default Image</a></li>
        <li><a href="<?=$admin_link?>/support"><?=show_static_text($adminLangSession['lang_id'],1650);?>Support</a></li>
        <li><a href="<?=$admin_link?>/account/notification_setting"><?=show_static_text($adminLangSession['lang_id'],1650);?>Notification Setting</a></li>
    </ul>
</li>

<li <?php echo $active=='Ticket Management'?'class="active"':''; ?>>
    <a href="<?=$admin_link?>/ticket" target="">
    <i class="fa fa-ticket"></i>
    <span class="title">Ticket Management<?=show_static_text($adminLangSession['lang_id'],4704);?></span> <span class="requestCount pull-right"></span>
    </a>
</li>



<li <?php echo $active=='Public Chat'?'class=" active"':'class=""'; ?> >
    <a href="<?=$admin_link.'/public_chat'?>" id="">
    <i class="fa fa-comments"></i>
    <span class="title">Public Chat</span><span class="publicChatCount pull-right"></span>
    </a>
</li>


<?php
}
else{
if(checkPermission('admin_permission',array('user_id'=>$admin_details->id,'type'=>'general_setting','value'=>1))){
?>
<li class="has-sub <?=$active=='General Settings'?'active':''; ?> ">
    <a href="javascript:;">
        <b class="caret pull-right"></b>
        <i class="fa fa-gears"></i>
        <span><?=show_static_text($adminLangSession['lang_id'],162);?></span> 
    </a>
    <ul class="sub-menu">
        <li><a href="<?=$admin_link?>/email"><?=show_static_text($adminLangSession['lang_id'],163);?></a></li>
        <li><a href="<?=$admin_link?>/account/socialnetwork"><?=show_static_text($adminLangSession['lang_id'],188);?></a></li>
        <li><a href="<?=$admin_link?>/language"><?=show_static_text($adminLangSession['lang_id'],164);?></a></li>
        <li><a href="<?=$admin_link?>/static_text"><?=show_static_text($adminLangSession['lang_id'],189);?></a></li>
        <li><a href="<?=$admin_link?>/update_lang"><?=show_static_text($adminLangSession['lang_id'],165);?></a></li>
        <li><a href="<?=$admin_link?>/backup"><?=show_static_text($adminLangSession['lang_id'],1650);?>Backup</a></li>
        <li><a href="<?=$admin_link?>/paypal_setting"><?=show_static_text($adminLangSession['lang_id'],1650);?>Paypal Setting</a></li>
        <li><a href="<?=$admin_link?>/account/background"><?=show_static_text($adminLangSession['lang_id'],1030);?>Background Image</a></li>
        <li><a href="<?=$admin_link?>/account/chat_setting"><?=show_static_text($adminLangSession['lang_id'],1650);?>Chat Setting</a></li>
        
    </ul>
</li>
<?php
}
if(checkPermission('admin_permission',array('user_id'=>$admin_details->id,'type'=>'dealer','value'=>1))||
checkPermission('admin_permission',array('user_id'=>$admin_details->id,'type'=>'dealer_plan','value'=>1))||
checkPermission('admin_permission',array('user_id'=>$admin_details->id,'type'=>'lost_camera','value'=>1))||
checkPermission('admin_permission',array('user_id'=>$admin_details->id,'type'=>'client_camera','value'=>1))){}
if(checkPermission('admin_permission',array('user_id'=>$admin_details->id,'type'=>'user_manage','value'=>1))){
?>
<li class="has-sub <?=$active=='User Management'?'active':''; ?> ">
    <a href="javascript:;">
        <b class="caret pull-right"></b>
        <i class="fa fa-file-code-o"></i>
        <span>Dealer Management</span> 
    </a>
    <ul class="sub-menu">
<?php
if(checkPermission('admin_permission',array('user_id'=>$admin_details->id,'type'=>'dealer','value'=>1))){
?>
        <li><a href="<?=$admin_link.'/dealer'?>">Dealer</a></li>
<?php
}if(checkPermission('admin_permission',array('user_id'=>$admin_details->id,'type'=>'client_camera','value'=>1))){
?>
        <li><a href="<?=$admin_link.'/client_camera'?>">Dealers client's cameras</a></li>
<?php
}if(checkPermission('admin_permission',array('user_id'=>$admin_details->id,'type'=>'dealer_plan','value'=>1))){
?>
        <li><a href="<?=$admin_link.'/dealer_plan'?>">Custom Dealer Plan</a></li>
<?php
}if(checkPermission('admin_permission',array('user_id'=>$admin_details->id,'type'=>'lost_camera','value'=>1))){
?>
        <li><a href="<?=$admin_link.'/camera'?>">Lost Connection Cameras</a></li>
<?php
}
?>
    </ul>
</li>
<?php
}
if(checkPermission('admin_permission',array('user_id'=>$admin_details->id,'type'=>'plans','value'=>1))){}
if(checkPermission('admin_permission',array('user_id'=>$admin_details->id,'type'=>'membership','value'=>1))||
checkPermission('admin_permission',array('user_id'=>$admin_details->id,'type'=>'plan','value'=>1))){
?>
<li class="has-sub <?=$active=='Membership Management'?'active':''; ?> ">
    <a href="javascript:;">
        <b class="caret pull-right"></b>
        <i class="fa fa-calendar"></i>
        <span>Membership</span><span class="requestMCount pull-right"></span>
    </a>
    <ul class="sub-menu">
<?php
if(checkPermission('admin_permission',array('user_id'=>$admin_details->id,'type'=>'plan','value'=>1))){
?>
        <li><a href="<?=$admin_link?>/plan">Plan</a></li>
<?php
}
if(checkPermission('admin_permission',array('user_id'=>$admin_details->id,'type'=>'membership','value'=>1))){
?>
        <li><a href="<?=$admin_link?>/membership">Membership Levels</a></li>		
<?php
}
?>

    </ul>
</li>
<?php
}
if(checkPermission('admin_permission',array('user_id'=>$admin_details->id,'type'=>'payment_history','value'=>1))){
?>
<li <?php echo $active=='Payment History'?'class="active"':''; ?>>
    <a href="<?=$admin_link?>/payment_history" target="">
    <i class="fa fa-history"></i>
    <span class="title">Payment History<?=show_static_text($adminLangSession['lang_id'],4704);?></span>
    </a>
</li>
<?php
}
if(checkPermission('admin_permission',array('user_id'=>$admin_details->id,'type'=>'content','value'=>1))||
checkPermission('admin_permission',array('user_id'=>$admin_details->id,'type'=>'page','value'=>1))||
checkPermission('admin_permission',array('user_id'=>$admin_details->id,'type'=>'support','value'=>1))||
checkPermission('admin_permission',array('user_id'=>$admin_details->id,'type'=>'default_image','value'=>1))||
checkPermission('admin_permission',array('user_id'=>$admin_details->id,'type'=>'flash_note','value'=>1))||
checkPermission('admin_permission',array('user_id'=>$admin_details->id,'type'=>'notification','value'=>1))||
checkPermission('admin_permission',array('user_id'=>$admin_details->id,'type'=>'slider','value'=>1))){
?>
<li class="has-sub <?=$active=='Content Management'?'active':''; ?> ">
    <a href="javascript:;">
        <b class="caret pull-right"></b>
        <i class="fa fa-file-code-o"></i>
        <span><?=show_static_text($adminLangSession['lang_id'],180);?></span> 
    </a>
    <ul class="sub-menu">
<?php

if(checkPermission('admin_permission',array('user_id'=>$admin_details->id,'type'=>'content','value'=>1))){
?>
        <li><a href="<?=$admin_link?>/content"><?=show_static_text($adminLangSession['lang_id'],181);?></a></li>
<?php
}
if(checkPermission('admin_permission',array('user_id'=>$admin_details->id,'type'=>'support','value'=>1))){
?>
        <li><a href="<?=$admin_link?>/support"><?=show_static_text($adminLangSession['lang_id'],1650);?>Support</a></li>
<?php
}
if(checkPermission('admin_permission',array('user_id'=>$admin_details->id,'type'=>'default_image','value'=>1))){
?>
        <li><a href="<?=$admin_link?>/default_image"><?=show_static_text($adminLangSession['lang_id'],16500);?>Default Image</a></li>
<?php
}
if(checkPermission('admin_permission',array('user_id'=>$admin_details->id,'type'=>'flash_note','value'=>1))){
?>
        <li><a href="<?=$admin_link?>/flash_note"><?=show_static_text($adminLangSession['lang_id'],1081);?>Flash Notice</a></li>
<?php
}
if(checkPermission('admin_permission',array('user_id'=>$admin_details->id,'type'=>'notification','value'=>1))){
?>
        <li><a href="<?=$admin_link.'/notification'?>"><?=show_static_text($adminLangSession['lang_id'],18002);?>Notification</a></li>
<?php
}
if(checkPermission('admin_permission',array('user_id'=>$admin_details->id,'type'=>'notification_setting','value'=>1))){
?>
<li><a href="<?=$admin_link?>/account/notification_setting"><?=show_static_text($adminLangSession['lang_id'],1650);?>Notification Setting</a></li>
<?php
}
?>

    </ul>
</li>
<?php
}
if(checkPermission('admin_permission',array('user_id'=>$admin_details->id,'type'=>'ticket_manage','value'=>1))){

?>
<li <?php echo $active=='Ticket Management'?'class="active"':''; ?>>
    <a href="<?=$admin_link?>/ticket" target="">
    <i class="fa fa-ticket"></i>
    <span class="title">Ticket Management<?=show_static_text($adminLangSession['lang_id'],4704);?></span> <span class="requestCount pull-right"></span>
    </a>
</li>
<?php
}
if(checkPermission('admin_permission',array('user_id'=>$admin_details->id,'type'=>'public_chat','value'=>1))){
?>
<li <?php echo $active=='Public Chat'?'class=" active"':'class=""'; ?> >
    <a href="<?=$admin_link.'/public_chat'?>" id="">
    <i class="fa fa-comments"></i>
    <span class="title">Public Chat</span><span class="publicChatCount pull-right"></span>
    </a>
</li>
<?php
}
}
?>
            
            
            
            
            <!-- begin sidebar minify button -->
            <li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li>
            <!-- end sidebar minify button -->
        </ul>
        <!-- end sidebar nav -->
    </div>
    <!-- end sidebar scrollbar -->
</div>






