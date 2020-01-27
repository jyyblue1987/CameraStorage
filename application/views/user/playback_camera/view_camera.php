<!--<link href="https://cdnjs.cloudflare.com/ajax/libs/video.js/5.10.2/alt/video-js-cdn.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/video.js/5.10.2/video.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/videojs-contrib-hls/3.0.2/videojs-contrib-hls.js"></script>-->

<link href="https://cdnjs.cloudflare.com/ajax/libs/video.js/5.13.0/video-js.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/video.js/5.13.0/video.min.js"></script>

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
<div class="form-group"  style="margin-bottom:20px">
<form action="" method="get">
	<label class="col-lg-2 control-label">Date</label>
	<div class="col-lg-4">
	    <input class="form-control" type="text" id="input-date" name="dates" value="<?=$this->input->get('dates');?>" data-date-format="dd-mm-yyyy" />
	</div>
	<div class="col-lg-4">
	    <input type="submit" class="btn btn-primary"  value="submit"/>
	</div>
</form>    
<div style="clear:both"></div>
</div>
<div style="clear:both"></div>
<?php
if(file_exists('data/camera '.$view_data->id.'/all.mp4')){
?>
<video id="my_video_1" class="video-js vjs-default-skin" controls  preload="auto" data-setup='{"controls": true, "autoplay": false, "preload": "auto" '>
    <source src="<?=site_url().'data/camera '.$view_data->id.'/all.mp4'?>" type="video/mp4">
  </video>
<?php
}
?>

</div>

<!--<label>Please refresh any error</label>-->

            </div>
        </div>
        <!-- end panel -->
    </div>   
</div>
<script>
videojs('my_video_1', {
/*    "autoplay": true*/
});
</script>

<link href="assets/global/plugins/bootstrap-datepicker/css/datepicker.css"  rel='stylesheet' type='text/css' >
<script type="text/javascript" src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script>
$(document).ready(function(){
	//$('&nbsp;').appendTo('div.dataTables_filter');
	//$('div.dataTables_filter').appendTo('<button id="refresh">Refresh</button>');
	$('#input-date').datepicker({ dateFormat: 'mm-dd-yy', altField: '#input-date_alt', altFormat: 'yy-mm-dd' }).on('changeDate', function(e){
    $(this).datepicker('hide');});

});
</script>
