
<link href="https://cdnjs.cloudflare.com/ajax/libs/video.js/5.13.0/video-js.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/video.js/5.13.0/video.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/videojs-contrib-hls/3.5.3/videojs-contrib-hls.min.js"></script>
<?php
if($view_data->sys_file==0){
?>
<script>/*<![CDATA[*/
get_start_v();

function get_start_v(){
	$.ajax({
		type:"POST",
		url:"<?=$_cancel.'/get_start_link2'?>",
		data:{id:<?=$view_data->id?>,<?=$this->security->get_csrf_token_name();?>:'<?=$this->security->get_csrf_hash();?>'},
		dataType: 'json',
		success: function(json){
		}
	});
}
/*]]>*/
</script>
<?php
}
else{
?>
<script>/*<![CDATA[*/
get_start_v();
function get_start_v(){
	$.ajax({
		type:"POST",
		url:"<?=$admin_link.'/account/ajax_camera'?>",
		data:{id:<?=$view_data->id?>,<?=$this->security->get_csrf_token_name();?>:'<?=$this->security->get_csrf_hash();?>'},
		dataType: 'json',
		success: function(json){
		}
	});
}
/*]]>*/
</script>
<?php
}
?>

<style>
.static-info {
  margin-bottom: 10px;
}
.static-info .name {
  font-size: 14px;
  font-weight: 600;
}
.static-info .value {
  font-size: 14px;
}
#my_video_1{
	width:640px;
	height:268px;
}

@media (max-width: 991px) {
	#my_video_1{
		width:100%;
		height:268px;
	}
}

</style>

<div class="row">
	<div class="col-md-12">
        <!-- begin panel -->
        <div data-sortable-id="form-stuff-1" class="panel panel-inverse">
            <div class="panel-heading">                
                <h4 class="panel-title"><?=$name?></h4>
            </div>
            <div class="panel-body">

<div class="portlet-body">    
<video id="my_video_1" class="video-js vjs-default-skin" controls autoplay preload="auto" data-setup='{"controls": true, "autoplay": false, "preload": "auto" , "customControlsOnMobile": true,"nativeControlsForTouch": false}'>
    <source src="<?=site_url().'data/'.$view_data->camera_path.'/camera '.$view_data->id.'/'.$view_data->s_file?>" type="application/x-mpegURL">
  </video>
</div>

<!--<label>Please refresh any error</label>-->

            </div>
        </div>
        <!-- end panel -->
    </div>   
</div>
<script>
videojs('my_video_1', {
    "autoplay": true,
	"nativeControlsForTouch": false,
	"customControlsOnMobile": true
});
</script>
