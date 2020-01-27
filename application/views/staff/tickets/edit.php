<div class="row">
    <div class="col-md-12">
        <!-- begin panel -->
        <div data-sortable-id="form-stuff-1" class="panel panel-inverse">
            <div class="panel-heading">                
                <h4 class="panel-title"><?=$name?></h4>
            </div>
            <div class="panel-body">
                <?php echo validation_errors();?>
                 <?=form_open(NULL, array('class' => 'form-horizontal', 'role'=>'form','enctype'=>"multipart/form-data"))?>
<!--                 	<input type="hidden" name="solve_time" id="sub-category" value="<?=$tickets->{'solve_time'}?>" />-->
                     <div class="form-body">                    
                      <div id="more_pic" style="display:none"></div>
                    <div class="col-md-12">						                                                
                        
                      
                
				<div class="form-group" >
                  <label class="col-lg-2 control-label"><?=show_static_text($lang_id,1600);?>Title</label>
                  <div class="col-lg-10">
                    <?=form_input('name', set_value('name', $tickets->{'name'}), 'class="form-control " id="" placeholder="" required')?>
                  </div>
                </div>

                

	

<div class="form-group">
  <label class="col-lg-2 control-label"><?=show_static_text($lang_id,2706);?>Information</label>
  <div class="col-lg-10">
    <?=form_textarea('desc', html_entity_decode(set_value('desc', $tickets->{'desc'})), 'placeholder="" id="information" rows="3" class="cleditor2 form-control"')?>
  </div>
</div>

			
                
  <div class="form-group">  
                    <label class="col-lg-2 control-label"><?=show_static_text($lang_id,6000);?>Upload a File</label>
                    <div class="col-lg-10">
                        <div id="fileuploader" class="fileuploader" style="background-color:#268abe"><i class="fa fa-plus"></i> Upload</div>
                        <span id="filesUpload" class="filesUpload"></span>
		                <div id="status"></div>        		            
            <div style="clear:both"></div>                    
            <table  class="" style="margin-top:10px;">
                <tbody class="files" id="product_files_content">
<?php
if(isset($products_file)&&!empty($products_file)){
$modal =1;
foreach($products_file as $set_products_file){
?>
<tr class="fade in" id="product_image_<?=$set_products_file->id?>">
    <td width="60%" class="name"><?=$set_products_file->filename?></td>
    
                    
    <td width="10%" align="right" class="delete" >
        <a href="javascript:void(0);" class="btn default" onclick="delete_image('<?=$set_products_file->id?>'); return false;">
            <i class="fa fa-times"></i>
        </a>
    </td>
</tr>
<?php
$modal++;
}
}
?>    

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

                 <?=form_close()?>
            </div>
        </div>
            
</div>
	</div>
</div>

    

<!--<link href="assets/plugins/jasny-bootstrap/css/jasny-bootstrap.min.css" rel="stylesheet" type="text/css"/>
<script src="assets/plugins/jasny-bootstrap/js/jasny-bootstrap.min.js" type="text/javascript" language="javascript"></script> -->

<!--<script src="assets/plugins/ckeditor/ckeditor.js" type="text/javascript" language="javascript"></script> 
<script src="assets/plugins/ckeditor/adapters/jquery.js" type="text/javascript" language="javascript"></script>
<script>
$(document).ready(function(){
    $('.cleditor2').ckeditor();
});
</script>-->

<link href="assets/global/plugins/bootstrap-datepicker/css/datepicker.css"  rel='stylesheet' type='text/css' >
<script type="text/javascript" src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script>
$(document).ready(function(){
	//$('&nbsp;').appendTo('div.dataTables_filter');
	//$('div.dataTables_filter').appendTo('<button id="refresh">Refresh</button>');
	$('#best_sellers_start').datepicker({ dateFormat: 'mm-dd-yy', altField: '#best_sellers_start_alt', altFormat: 'yy-mm-dd' });

});
</script>

<script>
function get_process(id){	
	$.ajax({
		type:"POST",
		url:"<?=$_cancel?>/ajax_get_hour",
		data:{id:id,<?=$this->security->get_csrf_token_name();?>:'<?=$this->security->get_csrf_hash();?>'},
		dataType: 'json',
		success: function(json) {	
			if(json.status=='ok'){
				$('#sub-category').val(json.hour_time);
				$('.show-ticket').show();
				$('.show-desc').html(json.desc);
				$('#solve-user-time').html(json.option);
				$('#information').val(json.desc2);
				//createSelect(json.hour_time);
			}
			if(json.status=='error'){
				$('#sub-category').val('');
				$('.show-ticket').hide();
				$('.show-desc').html('');
				$('#information').val('');
			}
		}
		
	});
}
</script>
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
<script>
$(document).ready(function(){
$('#is-responsive').change(function(){
	if(this.checked)
		$('#custom_time').fadeIn('slow');
	else
		$('#custom_time').fadeOut('slow');

});
});
var atLeastOneIsChecked = $('#is-responsive:checkbox:checked').length > 0;
if(atLeastOneIsChecked ){
	$('#custom_time').fadeIn('slow');
}
</script>