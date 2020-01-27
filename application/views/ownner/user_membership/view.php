<link href="assets/global/css/star.css" rel="stylesheet" />
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
</style>
<style>
.dl-horizontal dt {
  width: 80px;
}
.dl-horizontal dd {
  margin-left: 112px;
}

@media (max-width: 979px) {
	.dl-horizontal dd {
	  margin-left: 0px;
	}
}
.view-data .control-label {
  text-align: left;
  margin-left:10px;
}
/*label.radio-inline.checked, label.checkbox-inline.checked, label.radio.checked, label.checkbox.checked {
  background-color: #266c8e;
  color: #fff !important;
}*/
</style>

<div class="row">
	<div class="col-md-8">
        <!-- begin panel -->
        <div data-sortable-id="form-stuff-1" class="panel panel-inverse">
            <div class="panel-heading">                
                <h4 class="panel-title"><?=$name?></h4>
            </div>
            <div class="panel-body">
<div class="portlet-body">
    <div class="row static-info">
        <div class="col-md-3 name"><b>Title</b></div>
        <div class="col-md-9 value"><?=$view_data->name;?></div>
    </div>    
    <div class="row static-info">
        <div class="col-md-3 name"><b>Price</b></div>
        <div class="col-md-9 value">$<?=$view_data->price;?></div>
    </div>    
    <div class="row static-info">
        <div class="col-md-3 name"><b>Want</b></div>
        <div class="col-md-9 value"><?=$view_data->gender;?></div>
    </div>    
    <div class="row static-info">
        <div class="col-md-3 name"><b>Date</b></div>
        <div class="col-md-9 value"><?=h_dateFormat($view_data->dates,'d-m-Y');?></div>
    </div>
    <div class="row static-info">
        <div class="col-md-3 name"><b>Time</b></div>
        <div class="col-md-9 value"><?=$view_data->s_time.'-'.$view_data->e_time?></div>
    </div>
    <div class="row static-info">
        <div class="col-md-3 name"><b>Service</b></div>
        <div class="col-md-9 value"><?=print_value('categories',array('id'=>$view_data->service),'name')?></div>
    </div>    
    <div class="row static-info">
        <div class="col-md-3 name"><b>Description</b></div>
        <div class="col-md-9 value"><?=$view_data->description;?></div>
    </div>
<?php
if($view_data->set_user!=0&&$view_data->status=='confirm'&&$view_data->payment==0){
?>
<div class="row divider" style="margin-top:10px;">
        <div class="col-xs-12 col-sm-6 ">
<button class="btn btn-success " id="" onclick="window.location='<?=$_user_link.'/payment/checkout/'.$view_data->id?>'">
Get Payment</button>

        </div>        
    </div>
<?php
}
elseif($view_data->payment==1){
?>
    <div class="row static-info">
        <div class="col-md-3 name"><b>Payment</b></div>
        <div class="col-md-9 value" style="color:#090">DONE</div>
    </div>

<?php
}
?>
<?php
if($view_data->payment==1&&$view_data->status=='confirm'){

?>
<hr>
<h3>Review</h3>
<?php
	$checkClientReview = $this->comman_model->get_by('requests_review',array('user_id'=>$user_details->id,'sender_id'=>$view_data->set_user,'request_id'=>$view_data->id),false,false,true);
	$checkYourReview = $this->comman_model->get_by('requests_review',array('sender_id'=>$user_details->id,'user_id'=>$view_data->set_user,'request_id'=>$view_data->id),false,false,true);
	if($checkClientReview){
?>
<div class="row static-info">
    <div class="col-md-3 name"><b>Client Review</b></div>
    <div class="col-md-9 value" style="">
<div class="item-rating store" >
    <div class="star_content clearfix">
        <div class="star <?=$checkClientReview->rate>=1?'star_on':''?>"></div>
        <div class="star <?=$checkClientReview->rate>=2?'star_on':''?>"></div>
        <div class="star <?=$checkClientReview->rate>=3?'star_on':''?>"></div>
        <div class="star <?=$checkClientReview->rate>=4?'star_on':''?>"></div>
        <div class="star <?=$checkClientReview->rate>=5?'star_on':''?>" style="margin-right:5px;"></div>
    </div> 
</div>	
    
    </div>
</div>

<div class="row static-info">
    <div class="col-md-3 name"><b>Comment</b></div>
    <div class="col-md-9 value" style=""><?=$checkClientReview->comment?></div>
</div>
<?php
	}
	if($checkYourReview){
?>
<div class="row static-info">
    <div class="col-md-3 name"><b>Your Review</b></div>
    <div class="col-md-9 value" style="">
<div class="item-rating store" >
    <div class="star_content clearfix">
        <div class="star <?=$checkYourReview->rate>=1?'star_on':''?>"></div>
        <div class="star <?=$checkYourReview->rate>=2?'star_on':''?>"></div>
        <div class="star <?=$checkYourReview->rate>=3?'star_on':''?>"></div>
        <div class="star <?=$checkYourReview->rate>=4?'star_on':''?>"></div>
        <div class="star <?=$checkYourReview->rate>=5?'star_on':''?>" style="margin-right:5px;"></div>
    </div> 
</div>	
    
    </div>
</div>

<div class="row static-info">
    <div class="col-md-3 name"><b>Comment</b></div>
    <div class="col-md-9 value" style=""><?=$checkYourReview->comment?></div>
</div>
<?php
	}
	else{
?>
<button class="btn btn-primary girl-list-btn" id="" onclick="window.location='<?=$_cancel.'/review/'.$view_data->id?>'">Get Review</button>
<?php
	}
}
?>

</div>



            </div>
        </div>
        <!-- end panel -->
    </div>
    <div class="col-md-4">
<div data-sortable-id="ui-widget-10" class="panel panel-default">
    <div class="panel-heading">                            
        <h4 class="panel-title">Location</h4>
    </div>
    <div class="panel-body">
<div id="map_canvas" class="gmap"></div>	
    </div>
                    </div>

    </div>
</div>

<div class="row">
	<div class="col-md-12">
<ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#tab1" data-toggle="tab">User</a>
                    </li>

<?php
if(!empty($user_chat_data)){
?>
<li class="">
    <a href="#tab2" data-toggle="tab">Chat</a>
</li>
<?php
}
?>
                </ul>
<div class="tab-content" style="border:none;padding:10px 0px">
        <div class="tab-pane fade in active" id="tab1">
<div>
<?php
if($user_data){
	foreach($user_data as $set_use){
	$query = "SELECT AVG(rate) AS rate FROM requests_review where user_id='".$set_use->id."' GROUP BY user_id ORDER BY rate DESC;";
	$checkRate = $this->comman_model->get_query($query,true);
	if($checkRate){
		$userRatingCount = round($checkRate->rate,1);
	}
	else{
		$userRatingCount = 0;
	}

?>
<div class="col-xs-12 col-sm-4 col-md-4">
	<div class="well well-sm user-list">
		<div class="row">
    <div class="col-sm-6 col-md-4">
        <a href="javascript:void(0)">
        <img src="<?=!empty($set_use->image)?'assets/uploads/users/thumbnails/'.$set_use->image:$default_image?>" alt="" class="img-rounded img-responsive" style="width:100%;height:100px" />
        </a>
    </div>
    <div class="col-sm-6 col-md-8">
        <a href="javascript:void(0)">
        <h4><?=$set_use->first_name.' '.$set_use->last_name;?></h4>
        </a>
<div class="item-rating store" >
    <div class="star_content clearfix">
        <div class="star <?=$userRatingCount>=1?'star_on':''?>"></div>
        <div class="star <?=$userRatingCount>=2?'star_on':''?>"></div>
        <div class="star <?=$userRatingCount>=3?'star_on':''?>"></div>
        <div class="star <?=$userRatingCount>=4?'star_on':''?>"></div>
        <div class="star <?=$userRatingCount>=5?'star_on':''?>" style="margin-right:5px;"></div>
    </div> 
</div>        
        <p>

         </p>

    </div>
</div>
<?php
if($view_data->set_user==0){
?>
	<div class="row divider text-center" style="margin-top:10px;">
                <div class="col-xs-12 col-sm-6 emphasis add-btn">
<button class="btn btn-primary btn-block gir-list-btn" id="follow-<?=$set_use->id?>" onclick="add_to_following(<?=$set_use->id?>,<?=$view_data->id?>,'<?='add'?>');">
<span class="fa fa-plus"></span> Award</button>

                </div>
                
                
            </div>
<?php
}
else {
	if($view_data->set_user==$set_use->id){
?>
	<div class="row divider text-center" style="margin-top:10px;">
                <div class="col-xs-12 col-sm-6 emphasis add-btn">
<button class="btn btn-success btn-block gir-list-btn" id="follow-<?=$set_use->id?>" >
<span class="fa fa-check"></span> Awarded</button>

                </div>
                
                
            </div>
<?php	
	}
	else if($view_data->status=='cancel'){
?>
	<div class="row divider text-center" style="margin-top:10px;">
                <div class="col-xs-12 col-sm-6 emphasis add-btn">
<button class="btn btn-primary btn-block gir-list-btn" id="follow-<?=$set_use->id?>" onclick="add_to_following(<?=$set_use->id?>,<?=$view_data->id?>,'<?='add'?>');">
<span class="fa fa-plus"></span> Award</button>

                </div>
                
                
            </div>
<?php
	}
}
?>            
	</div>
</div>
<?php
	}
}
?>
</div>
<div style="clear:both"></div>
        </div><!--//tab2//-->
        
<?php
if(!empty($user_chat_data)){
?>
        <div class="tab-pane fade in active" id="tab2">
<?php $this->load->view('user/group_chat/tab_content.php');?>
        </div>
<?php
}
?>

        
       
      </div>
    </div>
    
</div>


<style>
.control-label{
	padding:0px !important;
}
</style>

<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places"></script>
<script type="text/javascript" src="assets/plugins/gmap/jquery.gmap.js"></script> 
<script type="text/javascript" src="assets/plugins/gmap/jquery.ui.map.js"></script>
<script type="text/javascript" charset="utf-8">
$(function(){
	var val = '<?=$view_data->gps?>';
	$('#map_canvas').gmap({ 'center': val,scrollwheel: false ,zoom:13}).bind('init', function(event, map) { 
			
		$('#map_canvas').gmap('addMarker', {
			'position': val, 
		'draggable': false,
		}).mouseover(function() {
			$('#map_canvas').gmap('openInfoWindow', { 'content': '<b><?=$view_data->name?></b>' }, this);
        }).mouseout(function() {
            $('#map_canvas').gmap('closeInfoWindow');
        });
	});

	// Detect user location
});
</script>
<style>
.gmap{
    margin-bottom:10px;
    width:100%;
    height:250px;
	
}
</style>
<script>
function add_to_following(id,request,type){
	if(type=='remove'){
		var answer = confirm ("Are you want to unfollow?");
		if (!answer)
			 return false;
	}
	$('#follow-'+id).attr('disabled','disabled');
	$.ajax({
		type:"POST",
		url:"<?=site_url($_cancel.'/set_add')?>",
		data:{id:id,request:request,type:type,<?=$this->security->get_csrf_token_name();?>:'<?=$this->security->get_csrf_hash();?>'},
		dataType: 'json',
		success: function(json) {	
			$('#follow-'+id).removeAttr('disabled');
			if(json.status=='ok'){
				if(type=='add'){
					$('#follow-'+id).attr("onclick","add_to_following("+id+",'remove')");
					$('#follow-'+id).removeClass('btn-primary');
					$('#follow-'+id).removeClass('gir-list-btn');
					$('#follow-'+id).addClass('btn-success');
					$('#follow-'+id).html('<span class="fa fa-check"></span> Awarded');
					$('.gir-list-btn').remove();
				}
				else{
					$('#follow-'+id).attr("onclick","add_to_following("+id+",'add')");
					$('#follow-'+id).removeClass('btn-success');
					$('#follow-'+id).addClass('btn-primary');
					$('#follow-'+id).html('<span class="fa fa-plus"></span> Follow');
				}
			}
			if(json.status=='error'){
				alert(json.msg);
			}
		}
	});
}
</script>
<style>
.well{
min-height:178px;
}
</style>

<link href="assets/plugins/uploader/css/uploadfile.css" rel="stylesheet">
<script src="assets/plugins/uploader/js/jquery.uploadfile.min.js"></script>
<script>
$(".fileuploader").uploadFile({
	url:"<?=$lang_code.'/ajax_user/ajax_upload'?>",
	fileName:"myfile",
	showStatusAfterSuccess:false,
	uploadButtonClass:"ajax-file-upload-blue",
	allowedTypes:"jpeg,jpg,png,gif",
	multiple: false,
	onSuccess:function(files,data,xhr){
		var obj = jQuery.parseJSON(data);
		if(obj.result=='error'){
			$('.ajax-file-upload-statusbar').hide();
			$("#status").html("<font color='red'>"+obj.msg+"</font>");
		}
		else if(obj.result=='success'){
			//$("#status").html("<font color='red'>image is uploaded. </font>");
			//var pic_id = '<input type="hidden" name="more_pic[]" value="'+obj.msg+'" />';
			$('#file-name').val(obj.msg);
			refresh_image(obj.msg);
			//window.location.href = "front/videos/"+$("#video_id").val();
		}
		
	},
	onError: function(files,status,errMsg){		
		$("#status").html("<font color='red'>There is some problem</font>");
	}

});


function refresh_image(id){
	$.ajax({
		type:"POST",
		url:"<?=$lang_code.'/ajax_user/refresh'?>",
		data:{id:id,<?=$this->security->get_csrf_token_name();?>:'<?=$this->security->get_csrf_hash();?>'},
		success:function(data){
			$('#product_files_content').html(data);
		}
	});

}
function delete_files(id){
	$('#'+id).remove();
	$('#file-name').val('');
}

</script>
<script>
jQuery(document).ready(function() {
	jQuery(window).load(function() { 
		$('.Msg_chat-textarea').hide();
		$('#tab2').removeClass('active');
		$('#tab2').removeClass('in');
	});
});




</script>