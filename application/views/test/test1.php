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


<style>
#my_video_1{
		width:100%;
		min-height:100%;
}


</style>
</head>

<body>
        <!-- Docs script -->
<!--//rtsp://demo.itechproducts.info:9095/video1.sdp-->

<video x-webkit-airplay="allow" alt="Calvary Worship Center" width="520" height="292" src="http://f.wa.edge.christianworldmedia.com:1935/calvarylivestream/mp4:calvarylivestream/playlist.m3u8" autoplay controls poster="http://www.christianworldmedia.com/screencap919"></video>
<video src="<?=site_url().'data/ajit-24/client-25/camera 1/capture.m3u8'?>" id="my_video_1" class="video-js vjs-default-skin" >
 <!-- Fallback here -->
</video>        
<a href="javascript:" onClick="parent.reload_page('test_safari/safari');" ><h3 style="text-align:center">Video</h3></a>
<a href="javascript:" onClick="parent.reload_page('test_safari/safari');" ><h3 class="colors" style="text-align:center">Playback</h3></a>

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


</body>

</html>