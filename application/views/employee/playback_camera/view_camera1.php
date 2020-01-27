<script src="assets/plugins/timepicker/dist/datepair.js"></script>
<script src="assets/plugins/timepicker/dist/jquery.datepair.js"></script>
<!--<script src="http://jonthornton.github.io/Datepair.js/dist/datepair.js"></script>
<script src="http://jonthornton.github.io/Datepair.js/dist/jquery.datepair.js"></script>-->
<link rel="stylesheet" type="text/css" href="assets/plugins/timepicker/jquery.timepicker.css" />
<script type="text/javascript" src="assets/plugins/timepicker/jquery.timepicker.js"></script>

<style>
.header-fixed {
    width: 100% 
}

.header-fixed > thead,
.header-fixed > tbody,
.header-fixed > thead > tr,
.header-fixed > tbody > tr,
.header-fixed > thead > tr > th,
.header-fixed > tbody > tr > td {
    display: block;
}

.header-fixed > tbody > tr:after,
.header-fixed > thead > tr:after {
    content: ' ';
    display: block;
    visibility: hidden;
    clear: both;
}

.header-fixed > tbody {
    overflow-y: auto;
    height: 350px;
}

.header-fixed > tbody > tr > td,
.header-fixed > thead > tr > th {
    width: 50%;
    float: left;
}

#playlist a{
    cursor:pointer;
}

#playlist li:hover{
    color:#000;
}

#videoarea{
	width:620px;
	height:368px;
}

@media (max-width: 991px) {
	#videoarea{
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
<form action="" method="get" class="edit-form">
	<div class="col-lg-3">
		<label class=" control-label">Date</label>
<?php
$getD = $this->input->get('dates');
?>        
	    <input class="form-control" type="text" id="input-date" name="dates" value="<?=$getD?$getD:date('m-d-Y');?>" data-date-format="mm-dd-yyyy" readonly="true"/>
	</div>
<div id="datepairExample">
	<div class="col-lg-2">
		<label class=" control-label">Time From</label>
		<input type="text" name="s_time" value="<?=$this->input->get('s_time')?>" id="input-start-time" class="time start form-control" required/> 
	</div>
	<div class="col-lg-2">
		<label class=" control-label">Time To</label>
		<input type="text" name="e_time" value="<?=$this->input->get('e_time')?>" id="input-end-time"  class="time end form-control" required/> 

	</div>
</div>    
	<div class="col-lg-2" style="padding-top:20px;">
	    <button type="submit" class="btn btn-primary submitBtn" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Submit">submit</button>
	</div>
</form>    
<div style="clear:both"></div>
</div>
<div style="clear:both"></div>
<div class="row">
<div class="col-md-7">
    <video src="" type="video/mp4" id="videoarea" controls preload="auto" ></video>	
<div>
<button id="snap" class="btn btn-primary" onclick="snap()">Snap Photo</button>
</div>
<canvas id="canvas" width="620" height="480" style="display:none"></canvas>
<div id="images_lst" class="row" style="margin-top:10px"></div>
<!--<a id="downloads" class="btn btn-primary" onclick="$('#downloads').attr('href', canvas.toDataURL());" download="MyImage.png" target="_blank">Download</a>-->
</div>

<div class="col-md-5">
<table class="table table-valign-middle m-b-0 header-fixed" id="playlist">
<thead>
<tr>	
    <th>Click To Watch (Size)</th>
    <th>Click To Download or E-mail</th>
</tr>
</thead>
<tbody class="playback-list">
<?php
$array =array();
if($mp4_files){
	foreach($mp4_files as $set_mp){
		if(preg_match("/\.(ts)$/", $set_mp)){
			continue;
		}
	$filesNameArr = explode(' ',$set_mp);
	if($filesNameArr[0]){
		$date= trim($filesNameArr[0],'file-');
		$array[$date]= "'".$date."'";
	}
/*	echo '<pre>'; 		
	print_r($filesNameArr);*/
	$video_clipSent = print_count('user_playback_sent',array('files'=>$set_mp,'user_id'=>$user_details->id));
?>
<tr class="w-list"  data-workout="<?=$filesNameArr[0]?>" style="" >
    <td><a class="play" movieurl="<?=site_url().'data/'.$view_data->camera_path.'/camera '.$view_data->id.'/'.$dateFolder.'/'.$set_mp?>" moviesposter=""><?=$set_mp?> (<?=formatSizeUnits(filesize(FCPATH.'data/'.$view_data->camera_path.'/camera '.$view_data->id.'/'.$dateFolder.'/'.$set_mp));?>)</a></td>
    <td><a href="<?=$_cancel.'/download?id='.$view_data->id.'&file='.$set_mp.''?>">Download</a> &nbsp;&nbsp;<a href="<?=$_cancel.'/send_mail?id='.$view_data->id.'&file='.$set_mp.''?>"><?=$video_clipSent>0?'Video clip sent':'Default Email'?></a>
    &nbsp;&nbsp;<a href="javascript:;" onclick="send_modal('<?=$set_mp?>')">Another Email</a> </td>
</tr>
<?php
	}
}
else {
	if($_GET){
?>
<tr class="w-list"><td colspan="2" style="width:100%"  ><div class="alert alert-warning">No recorded video found in this time slot</div></td></tr>
<?php		
	}
}
?>
        </tbody>
    </table>
<?php
/*echo '<pre>';
print_r($array);*/
$strin = "";
if($array){
	foreach($array as $set_a){
		$strin .= "".$set_a." : ".$set_a.", ";
	}
}

//echo $strin = trim($strin,', ');
?>                            
	
</div>
</div><!--//row//-->
</div>

<!--<label>Please refresh any error</label>-->

            </div>
        </div>
        <!-- end panel -->
    </div>   
</div>

<link href="assets/global/plugins/bootstrap-datepicker/css/datepicker.css"  rel='stylesheet' type='text/css' >
<script type="text/javascript" src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script>
var nowDate = '<?=date('Y/m/d')?>';
$(document).ready(function () {
    $(".edit-form").submit(function () {
/*		sTime = $('#input-start-time').val();
		eTime = $('#input-end-time').val();
		diff = Math.abs(new Date(nowDate+' '+sTime) - new Date(nowDate+' '+eTime));
		minutes = Math.floor((diff/1000)/60);
		if(minutes>5){
			alert('It is recommended to select no more than 5 minutes time window');
	        return false;
		}*/
		
		$(".submitBtn").button('loading');
        return true;
    });
});
</script>

<script>

var disableddates = <?=json_encode($disabled_date);?>;


function DisableSpecificDates(date) {
    var string = jQuery.datepicker.formatDate('dd-mm-yy', date);
    return [disableddates.indexOf(string) == -1];
}
$(document).ready(function(){
var inRange=false;
//var SelectedDates = {'12-12-2018':'12-12-2018'};
var SelectedDates = {<?=$strin?>};
$.each(SelectedDates, function(i,post){
		//console.log(post);
        });
	//console.log('k:'+SelectedDates['s']);
	$('#input-date').datepicker({ 
		dateFormat: 'mm-dd-yy', 
		altField: '#input-date_alt',
		altFormat: 'yy-mm-dd',
		disableTouchKeyboard: true,
		beforeShowDay: function(date) {
/*            var Highlight = (date.getMonth()+1) + '-' + (date.getDate()) + '-' +date.getFullYear();
            if (Highlight=='12-2-2016') {				
			      return {classes: 'highlight', tooltip: 'Title'};
            }    */
			
			setMonths = date.getMonth()+1;
			if((date.getMonth()+1)<10){
				setMonths = '0'+(date.getMonth()+1);
			}
	
			setDates= date.getDate();
			if((date.getDate())<10){
				setDates = '0'+(date.getDate());
			}
			
            var Highlight = SelectedDates[setMonths + '-' + (date.getDate()) + '-' +date.getFullYear()];
            var DisabledDate = disableddates[setMonths + '-' + setDates+ '-' +date.getFullYear()];
			//console.log('OK:'+DisabledDate+' De:'+(date.getMonth()+1) + '-' + (date.getDate()) + '-' +date.getFullYear());
			//console.log('OK:'+Highlight+' De:'+(date.getMonth()+1) + '-' + (date.getDate()) + '-' +date.getFullYear());
            if (Highlight) {		
			    return {classes: 'highlight', tooltip: 'Title'};
            }    
			else if (DisabledDate) {		
				return true;
			}    
			else{
				return false;
			}
        }		

		}).on('changeDate', function(e){
    	$(this).datepicker('hide');
		check_files();
	});

});
check_files();

function check_files(){
	dates = $('#input-date').val();
	if(dates==''){
	}
	else{
		filesName = 'file-'+dates;
		//console.log(filesName);
		$(".playback-list .w-list").each(function(index){
			//console.log('yes');
			
			if($(this).attr("data-workout")){
				//console.log('ok');
				//case insenstive search
				str = filesName;
	//				checkID = $(this).attr("data-workout");
				if(!$(this).attr("data-workout").match(new RegExp(str, "i"))){
					//console.log('okk');
					$(this).fadeOut("fast");
				}else{
					//console.log('No');
					$(this).fadeIn("slow");
				}
			}
		}); 
	}
}
</script>
<script>
$(function() {
    $("#playlist .play").on("click", function() {
        $("#videoarea").attr({
            "src": $(this).attr("movieurl"),
            "poster": "",
            "autoplay": "autoplay"
        })
    })
    $("#videoarea").attr({
        "src": $("#playlist .play").eq(0).attr("movieurl"),
    })
})
</script>

<!--snapshot-->
<script type="application/javascript">
var video=document.querySelector('video');
var canvas=document.querySelector('canvas');
var context=canvas.getContext('2d');
var images_c = document.getElementById('images_lst');
var w,h,ratio;
//add loadedmetadata which will helps to identify video attributes......
video.addEventListener('loadedmetadata',function(){
	ratio=video.videoWidth/video.videoHeight;
	w=video.videoWidth-100;
	h=parseInt(w/ratio,10);
	canvas.width=w;
	canvas.height=h;
},false);
///define a function
var i =0;
function snap(){
	context.fillRect(0,0,w,h);
	context.drawImage(video,0,0,w,h);
	htmls ='';
	htmls +='<div class="col-md-3">';
	htmls +='<img src="'+canvas.toDataURL()+'" style="width:100%;height:100px"><br><a href="'+canvas.toDataURL()+'" download="snapshot'+i+'.png">Download</a>';
	htmls +='</div>';
//	console.log(htmls);
//	$('#images_lst').append(htmls);
	$('#images_lst').prepend(htmls);
	i++;
}

function snap_back(){
	context.fillRect(0,0,w,h);
	context.drawImage(video,0,0,w,h);
	var img = new Image();
	img.src = canvas.toDataURL();
	html = '<a href="">'+img+'</a>';

	var links = document.createElement('a');
	links.innerHTML = 'download image';
	links.href = canvas.toDataURL();
    links.download = "mypainting.png";
//	images_c.append('<div>asda</div>');
	images_c.append(links);
}
</script>
<style>
.datepicker .highlight{
   background-color :#F00;
   font-weight:bold !important;
}
</style>
<script>
	// initialize input widgets first
	$('#datepairExample .time').timepicker({
		'showDuration': true,
		'timeFormat': 'H:i',
		'step': 05
	});

	$('#datepairExample').datepair({
		'defaultTimeDelta': 60000*5 // millisecond
	});
</script>
<!--//snapshot//-->
<script>
function send_modal(files){
	$('#input-files').val(files);
	$('#squarespaceModal').modal();
}
</script>
<!-- line modal -->
<div class="modal fade" id="squarespaceModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
			<h3 class="modal-title" id="lineModalLabel">My Modal</h3>
		</div>
		<div class="modal-body">
			
            <!-- content goes here -->
			<form action="<?=$_cancel.'/send_custom/'?>" method="get">
	            <input type="hidden" name="<?=$this->security->get_csrf_token_name(); ?>" value="<?=$this->security->get_csrf_hash();?>" />
	            <input type="hidden" name="files" id="input-files" value="" />
	            <input type="hidden" name="id" value="<?=$view_data->id?>" />
              <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" name="email" class="form-control" required="required">
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Subject</label>
                <input type="text" name="subject" class="form-control"  required="required">
              </div>

              <div class="form-group">
                <label for="exampleInputPassword1">Mesage</label>
                <textarea name="mesage" class="form-control"  required="required"></textarea>
              </div>
              
              <button type="submit" class="btn btn-default">Submit</button>
            </form>

		</div>
	</div>
  </div>
</div>