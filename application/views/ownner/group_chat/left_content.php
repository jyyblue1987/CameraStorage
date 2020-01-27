<script>
own_user = '<?=$user_details->id?>';
</script>
<style>
.user-tab > li.active > a, .user-tab > li.active > a:focus, .user-tab > li.active > a:hover {
  background: #008A8A;
}
.user-tab > li{
  padding:0;
}

.user-tab > li > a {
  color:#333;
}

.chat-datetime{
	font-size:11px;
}
</style>

<div class="tab-content">
	<div id="home" class="tab-pane fade in active">
		<div id="usersListWrapper">
        <ul class="list-unstyled">
<?php

if(isset($user_data)&&!empty($user_data)){
	$image = 'assets/uploads/profile.jpg';
	if(!empty($user_data->image)){
		$image = 'assets/uploads/users/small/'.$user_data->image;
	}
?>
<li class="user-item" data-name="<?=$user_data->first_name.' '.$user_data->last_name?>" online-user="<?=$user_data->id?>"  data-ol="0" >    
    <span class="user_status"><span class="user-status is-offline " data-ol="0" online-data="<?=$user_data->id?>"></span></span>
<!--	<a data-toggle="inboxMsgs" href="<?=site_url($lang_code.'/user/chat/'.$user_data->id)?>" data-original-title="" title="" >-->
	<a data-toggle="inboxMsgs" href="javascript:void(0)" data-original-title="" title="" >
	<div class="contact-wrap">
        <input name="Msguser_id" value="<?=$user_data->id?>" type="hidden">
        <div class="contact-profile-img">
            <div class="profile-img">
                <img class="img-responsive" src="<?=$image?>" alt="Profile" style="height:25px;width:25px;">
            </div>
        </div>
		<span class="contact-name"><small class="user-name"><?=$user_data->first_name.' '.$user_data->last_name?></small>
            <span class="badge progress-bar-danger" rel="<?=$user_data->id?>"></span>
        
        </span>

	</div>
</a>
<div style="clear:both"></div>
</li>
<?php
}
?>	
        </ul>
</div>
	</div>	    
</div>    
<script type="text/javascript">
$(document).ready(function(){
    $(".friend_name").keyup(function(){
        var str = $(".friend_name").val();
		var count = 0;
        $("#usersListWrapper .user-item").each(function(index){
            if($(this).attr("data-name")){
				//case insenstive search
                if(!$(this).attr("data-name").match(new RegExp(str, "i"))){
                    $(this).fadeOut("fast");
                }else{
                    $(this).fadeIn("slow");
					count++;
                }
            }
        }); 
    });

});


</script>