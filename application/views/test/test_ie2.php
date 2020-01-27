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
<link href="https://cdnjs.cloudflare.com/ajax/libs/video.js/5.13.0/video-js.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/video.js/5.13.0/video.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/videojs-contrib-hls/3.5.3/videojs-contrib-hls.min.js"></script>

<style>
#my_video_1{
		width:100%;
		min-height:100%;
}


</style>
</head>

<body>
        <!-- Docs script -->
<video id="my_video_1" class="video-js vjs-default-skin" controls autoplay preload="auto" data-setup='{"controls": true, "autoplay": true, "preload": "auto" , "customControlsOnMobile": true,"nativeControlsForTouch": false}'>
    <source src="<?=site_url().'data/user-1/client-2/camera 62/capture1-.m3u8'?>" type="application/x-mpegURL">
  </video>
  

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
videojs('my_video_1', {
    "autoplay": true,
	"nativeControlsForTouch": false,
	"customControlsOnMobile": true
});
</script>

<script>
var $video  = $('#my_video_1'),
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