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
                    <a href="javascript:;"><img src="assets/uploads/profile.jpg" alt="" /></a>
                </div>
                <div class="info"><?=$user_details->first_name.' '.$user_details->last_name;?>
                <br>
<?php
if($user_details->parent_id==0){

if($user_details->plan_id==0){
?>
Free User
<?php	
}
else{
	$show_membership = print_value('memberships',array('id'=>$user_details->plan_id),'name');
	if($show_membership){
		$planName = $show_membership;
	}
	else{
		$planName = $user_details->plan_type;
	}
	echo $planName;
}
}
?>
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

<li class="has-sub <?=$active=='Home'?'active':''; ?> ">
    <a href="javascript:;">
        <b class="caret pull-right"></b>
        <i class="fa fa-calendar"></i>
        <span><?=show_static_text($lang_id,1770);?><?=$settings['site_name']?></span> <span class="requestCount pull-right"></span>
    </a>
    <ul class="sub-menu">
        <li><a href="<?=$_user_link?>"><?=show_static_text($lang_id,58);?></a></li>
        <li><a href="<?=$_user_link.'/gym'?>"><?=show_static_text($lang_id,308);?></a></li>
        <li><a href="<?=$_user_link?>"><?=show_static_text($lang_id,107);?></a></li>
        <li><a href="<?=$_user_link?>"><?=show_static_text($lang_id,136);?></a></li>
        <li><a href="<?=$_user_link?>"><?=show_static_text($lang_id,137);?></a></li>
    </ul>
</li>

<li class="has-sub <?=$active=='People'?'active':''; ?> ">
    <a href="javascript:;">
        <b class="caret pull-right"></b>
        <i class="fa fa-newspaper-o"></i>
        <span><?=show_static_text($lang_id,36);?></span> <span class="requestCount pull-right"></span>
    </a>
    <ul class="sub-menu">
        <li><a href="<?=$_user_link.'/coach'?>"><?=show_static_text($lang_id,139);?></a></li>
        <li><a href="<?=$_user_link.'/athletes'?>"><?=show_static_text($lang_id,140);?></a></li>
        <li><a href="<?=$_user_link.'/staff'?>"><?=show_static_text($lang_id,142);?></a></li>
    </ul>
</li>


<li class="has-sub <?=$active=='Schedule'?'active':''; ?> ">
    <a href="javascript:;">
        <b class="caret pull-right"></b>
        <i class="fa fa-calendar"></i>
        <span><?=show_static_text($lang_id,1770);?>Schedule</span> <span class="requestCount pull-right"></span>
    </a>
    <ul class="sub-menu">
        <li><a href="<?=$_user_link.'/program'?>"><?=show_static_text($lang_id,309);?></a></li>
        <li><a href="<?=$_user_link.'/classes'?>"><?=show_static_text($lang_id,316);?></a></li>
        <li><a href="<?=$_user_link.'/workout'?>"><?=show_static_text($lang_id,1360);?>Work Out</a></li>
    </ul>
</li>


<li class="has-sub <?=$active=='Documents'?'active':''; ?> ">
    <a href="javascript:;">
        <b class="caret pull-right"></b>
        <i class="fa fa-file"></i>
        <span><?=show_static_text($lang_id,300);?></span> <span class="requestCount pull-right"></span>
    </a>
    <ul class="sub-menu">
        <li><a href="<?=$_user_link.'/document'?>"><?=show_static_text($lang_id,304);?></a></li>
    </ul>
</li>


<li class="has-sub <?=$active=='Financial'?'active':''; ?> ">
    <a href="javascript:;">
        <b class="caret pull-right"></b>
        <i class="fa fa-newspaper-o"></i>
        <span><?=show_static_text($lang_id,105);?></span> <span class="requestCount pull-right"></span>
    </a>
    <ul class="sub-menu">
        <li><a href="<?=$_user_link.''?>"><?=show_static_text($lang_id,203);?></a></li>
    </ul>
</li>


<!--<li class="has-sub <?=$active=='Request'?'active':''; ?> ">
    <a href="javascript:;">
        <b class="caret pull-right"></b>
        <i class="fa fa-newspaper-o"></i>
        <span><?=show_static_text($lang_id,1770);?>Request</span> <span class="requestCount pull-right"></span>
    </a>
    <ul class="sub-menu">
        <li><a href="<?=$_user_link?>/request">All Request <span class="requestCount pull-right"></span></a></li>
        <li><a href="<?=$_user_link?>/request/l">My Request</a></li>
    </ul>
</li>-->


<li <?php echo $active=='Membership'?'class="active"':''; ?>>
    <a href="<?=$lang_code.'/membership'?>" target="">
    <i class="fa fa-cog"></i>
    <span class="title"><?=show_static_text($lang_id,32);?></span>
    </a>
</li>



<li class="has-sub <?=$active=='Reporting'?'active':''; ?> ">
    <a href="javascript:;">
        <b class="caret pull-right"></b>
        <i class="fa fa-newspaper-o"></i>
        <span><?=show_static_text($lang_id,1770);?>Reporting</span>
    </a>
    <ul class="sub-menu">
        <li><a href="<?=$_user_link?>"><?=show_static_text($lang_id,310);?></a></li>
        <li><a href="<?=$_user_link?>"><?=show_static_text($lang_id,141);?></a></li>
        <li><a href="<?=$_user_link.'/attendance'?>"><?=show_static_text($lang_id,1306);?>Attendances</a></li>
        <li><a href="<?=$_user_link?>">Financial</a></li>
    </ul>
</li>



<li class="has-sub <?=$active=='GYM'?'active':''; ?> ">
    <a href="javascript:;">
        <b class="caret pull-right"></b>
        <i class="fa fa-newspaper-o"></i>
        <span><?=show_static_text($lang_id,308);?></span>
    </a>
    <ul class="sub-menu">
        <li><a href="<?=$_user_link?>"><?=show_static_text($lang_id,149);?></a></li>
        <li><a href="<?=$_user_link?>"><?=show_static_text($lang_id,285);?></a></li>
        <li><a href="<?=$_user_link?>"><?=show_static_text($lang_id,185);?></a></li>
        <li><a href="<?=$_user_link?>"><?=show_static_text($lang_id,198);?></a></li>
    </ul>
</li>


<li <?php echo $active=='Ticket Management'?'class="active"':''; ?>>
    <a href="<?=$_user_link.'/ticket'?>" target="">
    <i class="fa fa-ticket"></i>
    <span class="title"><?=show_static_text($lang_id,131);?></span>
    </a>
</li>

<li <?php echo $active=='Performance'?'class="active"':''; ?>>
    <a href="<?=$_user_link.'/performance'?>" target="">
    <i class="fa fa-cog"></i>
    <span class="title">performance</span>
    </a>
</li>

<li class="has-sub <?=$active=='Membership Management'?'active':''; ?> ">
    <a href="javascript:;">
        <b class="caret pull-right"></b>
        <i class="fa fa-calendar"></i>
        <span><?=show_static_text($lang_id,1770);?>Membership Management</span>
    </a>
    <ul class="sub-menu">
        <li><a href="<?=$_user_link.'/memberships'?>">Membership</a></li>
        <li><a href="<?=$_user_link.'/memberships/history'?>">History</a></li>
    </ul>
</li>


<li <?php echo $active=='Change Password'?'class="active"':''; ?>>
    <a href="<?=$_user_link.'/account/change_password'?>" target="">
    <i class="fa fa-cog"></i>
    <span class="title">Change Password</span>
    </a>
</li>

<!--<li class="has-sub <?=$active=='Property Management'?'active':''; ?> ">
    <a href="javascript:;">
        <b class="caret pull-right"></b>
        <i class="fa fa-newspaper-o"></i>
        <span><?=show_static_text($lang_id,1770);?>Property Management</span> 
    </a>
    <ul class="sub-menu">
        <li><a href="<?=$_user_link?>/property"><?=show_static_text($lang_id,1780);?>Property</a></li>
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






