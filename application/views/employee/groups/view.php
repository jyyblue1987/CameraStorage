<style>
#video{
	width:640px;
	height:268px;
}

.plyr{
	width:638px
}
@media (max-width: 991px) {
.plyr{
	width:100%
}
	#video{
		width:100%;
		height:268px;
	}
}

</style>
<?php
//$stores= $this->comman_model->get_by('users_support',array('user_id'=>$user_details->parent_id),false,false,true);
if(!empty($user_details->flash_notes)){
?>
<div class="alert alert-block alert-danger fade in hidden-xs">
	<?=$user_details->flash_notes?>
</div>
<?php
}
?>

<div class="row">
	<div class="col-md-12">
        <!-- begin panel -->
        <div data-sortable-id="form-stuff-1" class="panel panel-inverse">
            <div class="panel-heading">                
                <h4 class="panel-title"><?=$view_data->name?></h4>
            </div>
            <div class="panel-body">
<div class="portlet-body">    

<ul class="nav nav-tabs">
    <li class="">
        <a href="<?=$_user_link.'/account'?>">All</a>
    </li>
<?php
if($all_data){
	foreach($all_data as $set_g){
?>
    <li class="<?=$view_data->id==$set_g->id?'active':''?>">
        <a href="<?=$_cancel.'/v/'.$set_g->id?>" ><?=$set_g->name?></a>
    </li>
<?php
	}
}
?>    
</ul>

<div class="row camera-list" style="margin-top:20px">
<?php
$camera_ids = explode(',',$view_data->camera_id);
if($camera_ids){
	$this->db->order_by('order','asc');
	$this->db->where_in('id',$camera_ids);
	$all_datas = $this->comman_model->get_by('camera',array('user_id'=>$user_details->parent_id,'is_expire'=>0,'payment_id !='=>0),false,false,false);
	if($all_datas){
		foreach($all_datas  as $view_data){
?>	
<div class="col-md-4 " style="margin-bottom:10px;">
<iframe id="video-iframe-<?=$view_data->id?>" frameborder="0" scrolling="no" src="<?=site_url($_user_link.'/account/iframe/'.$view_data->id)?>" style="height:300px;width:100%" ></iframe>
<button onclick="goFullscreen('video-iframe-<?=$view_data->id?>'); return false" class="btn btn-primary btn-block">Fullscreen</button>
</div>
<?php
		}
	}
}
?>
 
</div>
</div>


            </div>
        </div>
        <!-- end panel -->
    </div>   
</div>




<style>
.camera-list h3{
	margin:0;
	padding:2px;
	background:#999;
}
</style>


<script>
function reload_page(url) {
	window.location = url;
}
function goFullscreen(id) {
    var element = document.getElementById(id);

    if (element.mozRequestFullScreen) {
      element.mozRequestFullScreen();
    } else if (element.webkitRequestFullScreen) {
      element.webkitRequestFullScreen();
   }
}
</script>

