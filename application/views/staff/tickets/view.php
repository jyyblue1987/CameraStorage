<link href="assets/global/css/star.css" rel="stylesheet" />
<link href="assets/plugins/star_rating/css/star-rating.css" media="all" rel="stylesheet" type="text/css"/>
<script src="assets/plugins/star_rating/js/star-rating.js" type="text/javascript"></script>
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
<?php

?>
    <div class="row static-info">
        <div class="col-md-3 name"><b>title</b></div>
        <div class="col-md-9 value"><?=$view_data->name;?></div>
    </div>    
    <div class="row static-info">
        <div class="col-md-3 name"><b>Information</b></div>
        <div class="col-md-9 value"><?=$view_data->desc;?></div>
    </div>
<!--    <div class="row static-info">
        <div class="col-md-3 name"><b>Urgency</b></div>
        <div class="col-md-9 value"><?=$view_data->urgency;?></div>
    </div>-->
    
    
<?php
if(!empty($products_file)){
?> 
    <div class="row static-info">
        <div class="col-md-3 name"><b>Documents</b></div>
        <div class="col-md-9 value">&nbsp;</div>
    </div>
<?php
	$j=0;
	foreach($products_file as $set_products_file){
	$j++;
?>
    <div class="row static-info">
        <div class="col-md-3 name"><b>File <?=$j?></b></div>
        <div class="col-md-9 value"><a href="<?=$_cancel.'/download/'.md5($set_products_file->id);?>" ><?=$set_products_file->filename;?></a></div>
    </div>
<?php
	}
}
?>

</div>

            </div>
        </div>
        <!-- end panel -->
    </div>    
    <!--//col-md-8//-->
<div class="col-md-4">
<div class="panel panel-default">
    <div class="panel-heading">                            
        <h4 class="panel-title">Details</h4>
    </div>
    <div class="panel-body">
<dl class="dl-horizontal">
    <dt>Date</dt>
    <dd><?=$view_data->on_date;?></dd>
    <dt>Status</dt>
    <dd class="show-status"><?=(!empty($view_data->status))?$view_data->status:'-';?></dd>
</dl>


    </div>
</div>
    </div>
</div>
<div class="row">
	<div class="col-md-12">
<ul class="timeline">
<?php
if(count($problems_status)){
	foreach($problems_status as $set_data){
		$rProductsFile = $this->comman_model->get_by('tickets_files',array('reply_id'=>$set_data->id,'ticket_type'=>'reply'),false,false,false);
		$commentName = 'Admin';
		if($set_data->user_id!=0){
			$userData = $this->comman_model->get_by('users',array('id'=>$set_data->user_id),false,false,true);
			if($userData){
				$commentName = $userData->first_name.' '.$userData->last_name;
			}
		}
		else{
		}
?>
			    <li>
			        <!-- begin timeline-icon -->
			        <div class="timeline-icon">
			            <a href="javascript:;"><i class="fa fa-user"></i></a>
			        </div>
			        <!-- end timeline-icon -->
			        <!-- begin timeline-body -->
			        <div class="timeline-body">
			            <div class="timeline-header">
<!--			                <span class="userimage"><img src="assets/img/user-1.jpg" alt="" /></span>-->
			                <span class="username"><a href="javascript:;"><?=$commentName?></a> <small></small></span>
			                <span class="pull-right text-muted"><?=date('d M Y, h:i:A',$set_data->created);?></span>
			            </div>
			            <div class="timeline-content">
                            <p><?=$set_data->description;?></p>
<dl class="dl-horizontal">
<?php
if(!empty($rProductsFile)){
	$j=0;
	foreach($rProductsFile as $set_products_file){
	$j++;
?>
    <dt>File <?=$j?></dt>
    <dd><a href="<?=$_cancel.'/download/'.md5($set_products_file->id);?>" ><?=$set_products_file->filename;?></a></dd>
<?php
	}
}
?>
</dl>
			            </div>
			            <!--<div class="timeline-footer">
			                <a href="javascript:;" class="m-r-15"><i class="fa fa-edit fa-fw"></i> Edit</a>
			            </div>-->
			        </div>
			        <!-- end timeline-body -->
			    </li>
<?php             
   }
}
?>                        
<?php
if($view_data->status !='Completed'){
?>				
                <li>
			        <div class="timeline-icon">
			            <a href="javascript:;"><i class="fa fa-edit"></i></a>
			        </div>
			        <div class="timeline-body">
	                    <div class="timeline-header">
			                <span class="username"><a href="javascript:;">Reply To</a> <small></small></span>

			            </div>
						<div class="panel-body" style="padding:5px 0 0 0">
                        <form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
						    <input type="hidden" name="<?=$this->security->get_csrf_token_name(); ?>" value="<?=$this->security->get_csrf_hash();?>" />
		                	<input type="hidden" name="reply_set" value="set"  />
                      <div id="more_pic" style="display:none"></div>
                     <div class="form-body">                    
                      
                    <div class="col-md-12">						                                                
                        
                <div class="form-group">
                  <label class="col-lg-2 control-label"><?=show_static_text($lang_id,2706);?>Comment</label>
                  <div class="col-lg-10">
                    <?=form_textarea('description', set_value('description'), 'placeholder="" id="input-comment" rows="1" style="height:100px" class=" form-control" required')?>
                  </div>
                </div>
                

                			</div>

                    <div class="form-group">  
        <label class="col-lg-2 control-label">Upload File</label>
        <div class="col-lg-10">
            <div id="fileuploader" class="fileuploader" style="background-color:#268abe"><i class="fa fa-plus"></i> <?=show_static_text($lang_id,278);?></div>
            <span id="filesUpload" class="filesUpload"></span>
            <div id="status"></div>        		            
<div style="clear:both"></div>                    
<table  class="" style="margin-top:10px;">
    <tbody class="files" id="product_files_content">
    </tbody>
</table>

        </div>
</div>



						</div>
	                 <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-2 col-md-9">
                                    <?=form_submit('submit', show_static_text($lang_id,235), 'class="btn btn-primary"')?>
                                    <a href="<?=$_cancel;?>" class="btn btn-default" type="button"><?=show_static_text($lang_id,22);?></a>
                                </div>
                            </div>
                        </div>
                        </form>
            </div>
			        </div>
			    </li>	
<?php
}
?>
			</ul>
    </div>
    
</div>

<link href="assets/plugins/uploader/css/uploadfile.css" rel="stylesheet">
<script src="assets/plugins/uploader/js/jquery.uploadfile.min.js"></script>
<script>
$(document).ready(function(){
	$(".fileuploader").uploadFile({
		url:"<?=$_cancel?>/ajax_upload",
		fileName:"myfile",
		showStatusAfterSuccess:false,
		uploadButtonClass:"ajax-file-upload-blue",
		allowedTypes:"*",
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
				//$('#more_pic').append(pic_id);
				var pic_id = '<input type="hidden" name="more_pic[]" value="'+obj.msg+'" />';
				$('#more_pic').append(pic_id);
				refresh_image(obj.msg,obj.file_size,obj.duration);
				//window.location.href = "front/videos/"+$("#video_id").val();
			}
			
		},
		onError: function(files,status,errMsg){		
			$("#status").html("<font color='red'>Upload is Failed</font>");
		}

	});
});

function refresh_image(id,size,duration){
	$.ajax({
		type:"POST",
		url:"<?=$_cancel?>/ajax_refresh",
		data:{id:id,size:size,duration:duration,<?=$this->security->get_csrf_token_name();?>:'<?=$this->security->get_csrf_hash();?>'},
		success:function(data){
			$('#product_files_content').append(data);
		}
	});

}
function delete_files(id){
	$('#'+id).remove();
}
function delete_image(id){
	$.ajax({
		type:"POST",
		url:"<?=$_cancel?>/remove_file",
		data:{id:id,<?=$this->security->get_csrf_token_name();?>:'<?=$this->security->get_csrf_hash();?>'},
		success:function(data){
			$('#product_image_'+id).hide();
		}
	});

}
</script>

<style>
.control-label{
	padding:0px !important;
}
</style>
<style>
.timeline {
    list-style-type: none;
    margin: 0;
    padding: 0;
    position: relative;
}
.timeline:before {
    content: '';
    position: absolute;
    top: 5px;
    bottom: 5px;
    width: 5px;
    background: #2d353c;
    left: 5%;
    margin-left: -2.5px;
}
.timeline > li {
    position: relative;
    min-height: 50px;
}
.timeline > li + li {
    margin-top: 10px;
}
.timeline .timeline-time {
    position: absolute;
    left: 0;
    width: 15%;
    text-align: right;
    padding-top: 7px;
}
.timeline .timeline-time .date,
.timeline .timeline-time .time {
    display: block;
}
.timeline .timeline-time .date {
    line-height: 18px;
    font-size: 14px;
}
.timeline .timeline-time .time {
    line-height: 28px;
    font-size: 24px;
    color: #242a30;
}
.timeline .timeline-icon {
    left: 0%;
    position: absolute;
    width: 10%;
    text-align: center;
    top: 5px;
}
.timeline .timeline-icon a {
    text-decoration: none;
    width: 50px;
    height: 50px;
    display: inline-block;
    -webkit-border-radius: 50px;
    -moz-border-radius: 50px;
    border-radius: 50px;
    background: #575d63;
    line-height: 40px;
    color: #fff;
    font-size: 14px;
    border: 5px solid #2d353c;
    transition: background .2s linear;
    -moz-transition: background .2s linear;
    -webkit-transition: background .2s linear;
}
.timeline .timeline-icon a:hover,
.timeline .timeline-icon a:focus {
    background: #00acac;
}
.timeline .timeline-body {
    margin-left: 9%;
    margin-right: 0%;
    background: #f4f4f4;
    position: relative;
    padding: 8px 10px;
    border-radius: 4px;
    -moz-border-radius: 4px;
    -webkit-border-radius: 4px;
}
.timeline .timeline-body:before {
    content: '';
    display: block;
    position: absolute;
    border: 10px solid transparent;
    border-right-color: #f4f4f4;
    left: -20px;
    top: 20px;
}
.timeline-header {
    padding-bottom: 5px;
    border-bottom: 1px solid #e2e7eb;
    line-height: 15px;
}
.timeline-header .userimage {
    float: left;
    width: 34px;
    height: 34px;
    -webkit-border-radius: 40px;
    -moz-border-radius: 40px;
    border-radius: 40px;
    overflow: hidden;
    margin: -2px 10px -2px 0;
}
.timeline-header .username {
    font-size: 16px;
    font-weight: 600;
}
.timeline-header .username,
.timeline-header .username a {
    color: #00acac;
}
.timeline img {
    max-width: 100%;
    display: block;
}
.timeline-content {
    font-size: 14px;
}
.timeline-header + .timeline-content,
.timeline-header + .timeline-footer,
.timeline-content + .timeline-footer {
    margin-top: 20px;
}
.timeline-content:before,
.timeline-content:after {
    content: '';
    display: table;
    clear: both;
}
.timeline-title {
    margin-top: 0;
}
.timeline-footer {
    margin: -20px -30px;
    padding: 20px 30px;
    background: #e8ecf1;
    -webkit-border-radius: 0 0 4px 4px;
    -moz-border-radius: 0 0 4px 4px;
    border-radius: 0 0 4px 4px;
}
.timeline-footer a:not(.btn) {
    color: #575d63;
}
.timeline-footer a:not(.btn):hover,
.timeline-footer a:not(.btn):focus {
    color: #2d353c;
}
.timeline .dl-horizontal{
	margin-bottom:4px;
}
/* Timeline Setting */

@media (max-width: 979px) {
    .timeline .timeline-body {
        margin-left: 25%;
        margin-right: 10%;
    }
    .timeline .timeline-time {
        width: 13%;
    }
    .timeline .timeline-icon {
        left: 13%;
        width: 12%;
    }
    .timeline:before {
        left: 19%;
    }
}
@media (max-width: 767px) {
    .timeline:before {
        left: 50%;
    }
    .timeline .timeline-body {
        margin-right: 0;
        margin-left: 0;
        margin-top: 10px;
        padding: 20px;
    }
    .timeline .timeline-footer {
        margin: 20px -20px -20px;
        padding: 20px;
    }
    .timeline .timeline-body:before {
        border-bottom-color: #fff;
        border-right-color: transparent;
        left: 50%;
        top: -20px;
        margin-left: -10px;
    }
    .timeline .timeline-time {
        right: 50%;
        left: 0;
        width: auto;
        margin-right: 40px;
        padding-top: 5px;
    }
    .timeline .timeline-icon {
        left: 0;
        width: 80px;
        position: relative;
        margin: 0 auto;
    }
}


</style>