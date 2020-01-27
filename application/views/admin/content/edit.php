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
				<input type="hidden" name="video" id="video-1" value="" />
                <div class="form-body">
     
                    <h5><?=show_static_text($adminLangSession['lang_id'],268);?></h5>
                   <div style="margin-bottom: 0px;" class="tabbable">
                      <ul class="nav nav-tabs">
                        <?php $i=0;
                        foreach($this->content_model->languages_icon as $key_lang=>$val_lang):
    
                          $i++;?>
                        <li class="<?=$i==1?'active':''?>">
                          <a data-toggle="tab" href="#<?=$key_lang?>" title="<?=$key_lang?>"><img src="<?php echo base_url('assets/uploads/language').'/'.$val_lang; ?>" title="<?=$key_lang?>" height="15" width="20" ></a></li>
                        <?php endforeach;?>
                      </ul>
                      <div style="padding-top: 9px; border-bottom: 1px solid #ddd;" class="tab-content">
                        <?php $i=0;foreach($this->content_model->languages as $key_lang=>$val_lang):$i++;?>
                        <div id="<?=$key_lang?>" class="tab-pane <?=$i==1?'active':''?>">
                            
                                                        
                            <div class="form-group">
                              <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],276);?></label>
                              <div class="col-lg-10">
                                <?=form_textarea('body_'.$key_lang, set_value('body_'.$key_lang, $page->{'body_'.$key_lang}), 'placeholder="Body" rows="3" class="cleditor2 form-control"')?>
                              </div>
                            </div>
                              
                        </div>
                        <?php endforeach;?>
                      </div>
                    </div>
                </div>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-2 col-md-9">
                            <?=form_submit('submit', show_static_text($adminLangSession['lang_id'],235), 'class="btn btn-primary"')?>
                            <a href="<?=$_cancel?>" class="btn btn-default" type="button"><?=show_static_text($adminLangSession['lang_id'],22);?></a>
                        </div>
                    </div>
                </div>
            <?=form_close()?>
            </div>
        </div>
        <!-- end panel -->
    </div>
        
</div>



<link href="assets/plugins/jasny-bootstrap/css/jasny-bootstrap.min.css" rel="stylesheet" type="text/css"/>
<script src="assets/plugins/jasny-bootstrap/js/jasny-bootstrap.min.js" type="text/javascript" language="javascript"></script> 
<script src="assets/plugins/ckeditor/ckeditor.js" type="text/javascript" language="javascript"></script> 
<script src="assets/plugins/ckeditor/adapters/jquery.js" type="text/javascript" language="javascript"></script> 
<script>
/* CL Editor */
$(document).ready(function(){
    $('.cleditor2').ckeditor({
	    filebrowserUploadUrl : '<?=site_url("ajax/upload_editor_image")?>'	
	});
});
</script>


<link href="assets/plugins/uploader/css/uploadfile.css" rel="stylesheet">
<script src="assets/plugins/uploader/js/jquery.uploadfile.min.js"></script>
<script>
$(document).ready(function(){
	$("#fileuploader").uploadFile({

		url:"<?=$_cancel;?>/ajax_upload",
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
				//$('#product_files_content').html(data);
				$('#video-1').val(obj.msg);
				refresh_m(obj.msg,1,obj.m_id);
				//window.location.href = "front/videos/"+$("#video_id").val();
			}
			
		},
		onError: function(files,status,errMsg){		
			$("#status").html("<font color='red'>Upload is Failed</font>");
		}

	});
});

function refresh_m(id,v_id,m_id){
	$.ajax({
		type:"POST",
		url:"<?=$_cancel;?>/refresh_m",
		data:{id:id,v_id:v_id,c_id:m_id,<?=$this->security->get_csrf_token_name();?>:'<?=$this->security->get_csrf_hash();?>'},
		success:function(data){
			if(v_id==1){
				$('#product_files_content').append(data);
			}
			else{
				$('#product_files_content2').append(data);
			}
		}
	});

}

function delete_files2(id){
	$('#video-2').val('');
	$('#'+id).remove();
}

function delete_files(id){
	$('#video-1').val('');
	$('#'+id).remove();
}

</script>
