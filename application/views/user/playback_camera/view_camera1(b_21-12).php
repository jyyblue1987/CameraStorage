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
<form action="" method="get">
	<div class="col-lg-3">
		<label class=" control-label">Date</label>
<?php
$getD = $this->input->get('dates');
?>        
	    <input class="form-control" type="text" id="input-date" name="dates" value="<?=$getD?$getD:date('m-d-Y');?>" data-date-format="mm-dd-yyyy" readonly="true"/>
	</div>
	<div class="col-lg-2">
		<label class=" control-label">Time From</label>
<select name="s_time" class="form-control">
<?php
foreach($time_data as $set_time){
?>
	<option value="<?=$set_time?>" <?=$this->input->get('s_time')==$set_time?'selected="selected"':''?> ><?=$set_time?></option>
<?php	
}
?>
</select>
	</div>
	<div class="col-lg-2">
		<label class=" control-label">Time To</label>
<select name="e_time" class="form-control">
<?php
foreach($time_data as $set_time){
?>
	<option value="<?=$set_time?>" <?=$this->input->get('e_time')==$set_time?'selected="selected"':''?> ><?=$set_time?></option>
<?php	
}
?>
</select>
	</div>
	<div class="col-lg-2" style="padding-top:20px;">
	    <input type="submit" class="btn btn-primary"  value="submit"/>
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
    <th>Click To Watch</th>
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
?>
<tr class="w-list"  data-workout="<?=$filesNameArr[0]?>" style="" >
    <td><a class="play" movieurl="<?=site_url().'data/'.$view_data->camera_path.'/camera '.$view_data->id.'/'.$dateFolder.'/'.$set_mp?>" moviesposter=""><?=$set_mp?></a></td>
    <td><a href="<?=$_cancel.'/download?id='.$view_data->id.'&file='.$set_mp.''?>">Download</a> &nbsp;&nbsp;<a href="<?=$_cancel.'/send_mail?id='.$view_data->id.'&file='.$set_mp.''?>">Email</a> </td>
</tr>
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
$(document).ready(function(){
	//$('&nbsp;').appendTo('div.dataTables_filter');
	//$('div.dataTables_filter').appendTo('<button id="refresh">Refresh</button>');
var inRange=false;
//var SelectedDates = {'12-12-2016':'12-12-2016as','11-12-2016':'11-12-2016'};
//var SelectedDates = ['12-12-2016'=>'12-12-2016','11-12-2016'=>'11-12-2016'];
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
			
			setDates = date.getMonth()+1;
			if((date.getMonth()+1)<10){
				setDates = '0'+(date.getMonth()+1);
			}
	
			setMonths= date.getDate();
			if((date.getDate())<10){
				setMonths = '0'+(date.getDate());
			}
			
            var Highlight = SelectedDates[setDates + '-' + (date.getDate()) + '-' +date.getFullYear()];
			//console.log('OK:'+Highlight+' De:'+(date.getMonth()+1) + '-' + (date.getDate()) + '-' +date.getFullYear());
            if (Highlight) {		
				console.log('OK:');
			      return {classes: 'highlight', tooltip: 'Title'};
        //        return [true, "Highlighted", Highlight];
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
<!--//snapshot//-->