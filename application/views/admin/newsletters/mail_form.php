<div class="row">
	<div class="col-md-12">
	    <div class="portlet box blue-hoki">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-gift"></i><?php echo $name;?>
            </div>
            <!--<div class="tools">
                <a href="javascript:;" class="collapse">
                </a>
                <a href="#portlet-config" data-toggle="modal" class="config">
                </a>
                <a href="javascript:;" class="reload">
                </a>
                <a href="javascript:;" class="remove">
                </a>
            </div>-->
        </div>
        <div class="portlet-body form">
            <!-- BEGIN FORM-->
            <?php //echo validation_errors();?>
            <form action="" class="form-horizontal" method="post"enctype="multipart/form-data" > 
                	<input type="hidden" name="operation" value="set" />
                <div class="form-body">

					<div class="form-group">
                        <label class="col-sm-2 control-label">user Email-ID</label>
                        <div class="col-sm-8">
							<select id="user_email" multiple="multiple" class="user_email populate placeholder form-control" name="email[]">
<?php
$user_data  = $this->comman_model->get('newsletters',false);
if(count($user_data)){
	foreach($user_data as $set_user){
		if(!empty($set_user)){
?>
		<option value="<?php echo $set_user->email; ?>"  ><?php echo $set_user->email; ?></option>
<?php
		}
	}
}
?>
							</select>                            
                        </div>
                    </div>                    
                    <div class="form-group">
                        <label class="col-md-2 control-label">Subject</label>
                        <div class="col-md-8">
                             <input type="text" name="subject" size="50px" value="<?php echo set_value('subject'); ?>" class="form-control"   required/>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-md-2 control-label">Message</label>
                        <div class="col-md-8">
                             <textarea class="form-control" name="message" rows="5" ><?php echo set_value('message'); ?></textarea>
                        </div>
                    </div>                    
                    
                    
                </div>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-2 col-md-9">
                            <button type="submit" class="btn green">Create</button>
                            <!--<button type="button" class="btn default">Cancl</button>-->
                        </div>
                    </div>
                </div>
            </form>
            <!-- END FORM-->
        </div>
    </div>
    </div>
</div>




<script src="assets/plugins/ckeditor/ckeditor.js" type="text/javascript" language="javascript"></script> 
<script src="assets/plugins/ckeditor/adapters/jquery.js" type="text/javascript" language="javascript"></script> 
<!--<script>
/* CL Editor */
$(document).ready(function(){
    $('.cleditor2').ckeditor({
	    filebrowserUploadUrl : '<?=site_url("ajax/upload_editor_image")?>'	
	});
});
</script>
-->
