<!DOCTYPE HTML>
<html>
<head>
<base href="<?php echo base_url();?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="assets/frontend/css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
<link rel="stylesheet" href="assets/global/plugins/font-awesome/css/font-awesome.min.css">
<script src="assets/frontend/js/jquery.min.js"></script>
<script src='assets/frontend/js/bootstrap.js'></script>
</head>
<body>
<link rel="stylesheet" href="assets/plugins/video_player/dist/plyr.css">
<script src="assets/plugins/video_player/dist/plyr.js"></script>
<style>
#video{
	width:100%;
	height:268px;
}

.plyr{
	width:100%;
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
if($view_data->sys_file==0){
?>
<script>/*<![CDATA[*/
get_start_v();
function get_start_v(){
	$.ajax({
		type:"POST",
		url:"<?=$_user_link.'/camera/get_start_link2'?>",
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
		url:"<?=$_user_link.'/account/ajax_camera'?>",
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

<body>    
<script src="assets/plugins/video_player/dist/hls.min.js"></script>

        <!-- Docs script -->
<video id="video" ></video>
<a href="javascript:" onClick="parent.reload_page('<?=$_user_link.'/camera/v/'.$view_data->id?>');" ><h3 style="text-align:center"><?=$view_data->name?></h3></a>
<a href="javascript:" onClick="parent.reload_page('<?=$_user_link.'/playback_camera/v/'.$view_data->id?>');" ><h3 class="colors" style="text-align:center">Playback</h3></a>
<?php
if($view_data->sys_file==0){/*
?>
    <button  onclick="start_video('<?=$view_data->id?>');" class="btn btn-default btn-block">Start</button>
<?php
*/}
?>

<script>
  if(Hls.isSupported()) {
    var video = document.getElementById('video');
    var hls = new Hls();
    hls.loadSource('<?=site_url().'data/'.$view_data->camera_path.'/camera '.$view_data->id.'/'.$view_data->s_file?>');
    hls.attachMedia(video);
    hls.on(Hls.Events.MANIFEST_PARSED,function() {
     video.play();
  });
 }
</script>

<!--        <script src="assets/plugins/video_player/dist/demo.js"></script>-->
<script>

</script>
<style>
h3{
	margin:0;
	padding:2px;
	background:#999;
}
h3.colors{
	background:#CCC;
}
</style>
<script>
plyr.loadSprite("assets/plugins/video_player/dist/demo.svg");
plyr.setup();
</script>


<style>
.plyr--captions-enabled [data-plyr=captions], .plyr--fullscreen-enabled [data-plyr=fullscreen]{
	display:none;
}
video{
	width:100;
	height:
	
}
</style>
<script>
var $video  = $('video'),
    $window = $(window); 

$(window).resize(function(){
    var height = $window.height();
    $video.css('height', height);

    var videoWidth = $video.width(),
        windowWidth = $window.width(),
    marginLeftAdjust =   (windowWidth - videoWidth) / 2;

    $video.css({
        'height': height-60, 
        'marginLeft' : marginLeftAdjust
    });
}).resize();
</script>
</body>

</html>