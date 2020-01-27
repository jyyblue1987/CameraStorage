
<style>
.sub-menu .badge, .sidebar .nav > li > a .badge{
	background-color:#0C0;	
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
                
<!--                <div class="info">balance: $<?=$user_details->credits_point;?></div>-->
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

<?php
if(checkPermission('users_permission',array('user_id'=>$user_details->id,'type'=>'users','value'=>1))==1||
checkPermission('users_permission',array('user_id'=>$user_details->id,'type'=>'client','value'=>1))==1||
checkPermission('users_permission',array('user_id'=>$user_details->id,'type'=>'client_plan','value'=>1))==1||
checkPermission('users_permission',array('user_id'=>$user_details->id,'type'=>'client_camera','value'=>1))==1){
?>
<li class="has-sub <?=$active=='People'?'active':''; ?> ">
    <a href="javascript:;">
        <b class="caret pull-right"></b>
        <i class="fa fa-users"></i>
        <span><?=show_static_text($lang_id,31006);?>Client Management</span> 
    </a>
    <ul class="sub-menu">
<?php
if(checkPermission('users_permission',array('user_id'=>$user_details->id,'type'=>'client','value'=>1))==1){
?>
        <li><a href="<?=$_user_link.'/user'?>"><?=show_static_text($lang_id,13900);?>Client</a></li>
<?php
}
if(checkPermission('users_permission',array('user_id'=>$user_details->id,'type'=>'client_camera','value'=>1))==1){
?>

        <li><a href="<?=$_user_link.'/c_camera'?>"><?=show_static_text($lang_id,13900);?>Client Camera</a></li>
<?php
}
if(checkPermission('users_permission',array('user_id'=>$user_details->id,'type'=>'client_plan','value'=>1))==1){
	if(checkPermission('users',array('id'=>$user_details->parent_id,'is_set_price'=>1))==1){
?>
        <li><a href="<?=$_user_link.'/client_plan'?>"><?=show_static_text($lang_id,13900);?>Client Plan</a></li>
<?php
	}
}
?>
    </ul>
</li>    
<?php
}
if(checkPermission('users_permission',array('user_id'=>$user_details->id,'type'=>'support','value'=>1))==1||
checkPermission('users_permission',array('user_id'=>$user_details->id,'type'=>'notification','value'=>1))==1||
checkPermission('users_permission',array('user_id'=>$user_details->id,'type'=>'email_setup','value'=>1))==1||
checkPermission('users_permission',array('user_id'=>$user_details->id,'type'=>'client_link','value'=>1))==1
){
?>
<li class="has-sub <?=$active=='Content Management'?'active':''; ?> ">
    <a href="javascript:;">
        <b class="caret pull-right"></b>
        <i class="fa fa-life-ring"></i>
        <span><?=show_static_text($lang_id,31006);?>Content Management</span> 
    </a>
    <ul class="sub-menu">
<?php
if(checkPermission('users_permission',array('user_id'=>$user_details->id,'type'=>'email_setup','value'=>1))==1){
?>   
        <li><a href="<?=$_user_link.'/email_setup'?>"><?=show_static_text($lang_id,13900);?>E-mail Server Setup</a></li>
<?php
}
if(checkPermission('users_permission',array('user_id'=>$user_details->id,'type'=>'support','value'=>1))==1){
?>   
		<li><a href="<?=$_user_link.'/support'?>"><?=show_static_text($lang_id,13900);?>Client's Support Info</a></li>
<?php
}
if(checkPermission('users_permission',array('user_id'=>$user_details->id,'type'=>'notification','value'=>1))==1){
?>
        <li><a href="<?=$_user_link.'/notification'?>"><?=show_static_text($lang_id,13900);?>Notifications</a></li>
<?php
}
if(checkPermission('users_permission',array('user_id'=>$user_details->id,'type'=>'notification','value'=>1))==1
){
?>
        <li><a href="javascript:void(0);" data-toggle="modal" data-target="#referralModal" ><?=show_static_text($lang_id,13900);?>Client Self Registration Link</a></li>
<?php
}
?>

    </ul>
</li>
<?php
}
if(checkPermission('users_permission',array('user_id'=>$user_details->id,'type'=>'payment_manage','value'=>1))==1||
checkPermission('users_permission',array('user_id'=>$user_details->id,'type'=>'paypal_account','value'=>1))==1||
checkPermission('users_permission',array('user_id'=>$user_details->id,'type'=>'paypal_setting','value'=>1))==1
){
?>
<li class="has-sub <?=$active=='Payment Account'?'active':''; ?> ">
    <a href="javascript:;">
        <b class="caret pull-right"></b>
        <i class="fa fa-paypal"></i>
        <span><?=show_static_text($lang_id,31006);?>Payment Account</span> 
    </a>
    <ul class="sub-menu">
<?php
if(checkPermission('users_permission',array('user_id'=>$user_details->id,'type'=>'paypal_account','value'=>1))==1){
?>   
        <li><a href="<?=$_user_link.'/paypal_account'?>">PayPal Account</a></li>
<?php
}
if(checkPermission('users_permission',array('user_id'=>$user_details->id,'type'=>'paypal_setting','value'=>1))==1){
?>   
        <li><a href="<?=$_user_link.'/paypal_account/settings'?>">Settings</a></li>
<?php
}
?>

    </ul>
</li>
<?php
}
if(checkPermission('users_permission',array('user_id'=>$user_details->id,'type'=>'ticket','value'=>1))==1){
?>
<li <?php echo $active=='Ticket Management'?'class="active"':''; ?> >
    <a href="<?=$_user_link.'/ticket'?>" target="">
    <i class="fa fa-ticket"></i>
    <span class="title"><?=show_static_text($lang_id,131);?></span>
    </a>
</li>
<?php
}
if(checkPermission('users_permission',array('user_id'=>$user_details->id,'type'=>'payment_history','value'=>1))==1){
?>
<li <?php echo $active=='Payment History'?'class="active"':''; ?> >
    <a href="<?=$_user_link.'/payment_history'?>" target="">
    <i class="fa fa-list-ul"></i>
    <span class="title"><?=show_static_text($lang_id,1031);?>Payment History</span>
    </a>
</li>
<?php
}
if(checkPermission('users_permission',array('user_id'=>$user_details->id,'type'=>'monthly_payment_history','value'=>1))==1||
checkPermission('users_permission',array('user_id'=>$user_details->id,'type'=>'monthly_payment_manage','value'=>1))==1){
?>
<li class="has-sub <?=$active=='Update Balance'?'active':''; ?> ">
    <a href="javascript:;">
        <b class="caret pull-right"></b>
        <i class="fa fa-book"></i>
        <span><?=show_static_text($lang_id,3080);?>Monthly Payment</span> 
    </a>
    <ul class="sub-menu">
        <li><a href="<?=$_user_link.'/user_payment_history'?>"><?=show_static_text($lang_id,1350);?>Payment History</a></li>
    </ul>
</li>
<?php
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






