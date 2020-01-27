<div class="row">
	<div class="col-md-12">
        <!-- begin panel -->
        <div data-sortable-id="form-stuff-1" class="panel panel-inverse">
            <div class="panel-heading">                
                <h4 class="panel-title"><?='Live Camera View'?></h4>
            </div>
            <div class="panel-body">
<div class="portlet-body">    
<ul class="nav nav-tabs">
    <li class="active">
        <a href="<?=$_user_link.'/account'?>">All</a>
    </li>
<?php
$all_data = $this->comman_model->get_by('groups',array('user_id'=>$user_details->parent_id),false,false,false);
if($all_data){
	foreach($all_data as $set_g){
?>
    <li class="">
        <a href="<?=$_user_link.'/group/v/'.$set_g->id?>" ><?=$set_g->name?></a>
    </li>
<?php
	}
}
?>    
</ul>

<div class="row camera-list" style="margin-top:20px">
<?php
$this->db->order_by('order','asc');
$all_data = $this->comman_model->get_by('camera',array('user_id'=>$user_details->parent_id,'is_expire'=>0,'payment_id !='=>0),false,false,false);
if($all_data){
	foreach($all_data  as $view_data){
?>
<div class="col-md-4 " style="margin-bottom:10px;">
<iframe id="video-iframe-<?=$view_data->id?>" frameborder="0" scrolling="no" src="<?=site_url($_user_link.'/account/iframe/'.$view_data->id)?>" style="height:340px;width:100%" ></iframe>
<button onclick="goFullscreen('video-iframe-<?=$view_data->id?>'); return false" class="btn btn-primary btn-block">Fullscreen</button>
</div>
<?php
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

