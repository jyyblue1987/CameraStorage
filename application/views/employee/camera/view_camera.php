<link rel="stylesheet" href="assets/plugins/video_player/dist/plyr.css">
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
?>

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

<div class="row">
	<div class="col-md-12">
        <!-- begin panel -->
        <div data-sortable-id="form-stuff-1" class="panel panel-inverse">
            <div class="panel-heading">                
                <h4 class="panel-title"><?=$name?></h4>
            </div>
            <div class="panel-body">

<div class="portlet-body">    
<script src="assets/plugins/video_player/dist/hls.min.js"></script>

        <!-- Docs script -->
<video id="video" ></video>
<script>
  if(Hls.isSupported()) {
    var video = document.getElementById('video');
    var hls = new Hls();
    hls.loadSource('<?=site_url().'data/'.$view_data->camera_path.'/camera '.$view_data->id.'/'.$view_data->s_file?>');
    hls.attachMedia(video);
    hls.on(Hls.Events.MANIFEST_PARSED,function() {
		//	  alert('yes');
		video.play();
		$("#video")[0].autoplay = true;	  
		$('#video').play();
//	  console.log('ok');
  });
 }
</script>

        <script src="assets/plugins/video_player/dist/plyr.js"></script>
        <script src="assets/plugins/video_player/dist/demo.js"></script>
<script>

</script>
</div>
            </div>
        </div>
        <!-- end panel -->
    </div>   
</div>

