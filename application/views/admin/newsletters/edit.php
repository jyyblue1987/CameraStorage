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
                   
	    	<div class="form-body">              
            	<div class="form-group">
                        <label class="col-lg-2 col-md-2 col-sm-2 control-label"><?=show_static_text($adminLangSession['lang_id'],18);?></label>
                        <div class="col-md-10 col-lg-10">
							<select id="user_email" multiple="multiple" class="multiselect populate placeholder form-control user-list" name="email[]" required>

<?php
$selectUser = unserialize($news->user_id);
$user_data  = $this->comman_model->get('newsletters',false);
if(count($user_data)){
	foreach($user_data as $set_user){
		if(!empty($set_user)){
		if(!empty($selectUser)&&in_array($set_user->email,$selectUser)){
?>
		<option value="<?php echo $set_user->email; ?>"  selected="selected" ><?php echo $set_user->email; ?></option>
<?php
		}
		else{
?>
		<option value="<?php echo $set_user->email; ?>" ><?php echo $set_user->email; ?></option>
<?php
		}
?>
<?php
		}
	}
}
?>
							</select>                            
                        </div>
                    </div>      
            	<div class="form-group" >
                        <label class="col-lg-2 col-md-2 control-label"><?=show_static_text($adminLangSession['lang_id'],255);?></label>
                        <div class="col-lg-10 col-md-10">
                           <?=form_input('subject', set_value('subject', $news->subject), 'class="form-control " id="" placeholder="Subject"')?>
                        </div>
                    </div>
                <div class="form-group">
                    <label class="col-md-2 col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],55);?></label>
                    <div class="col-lg-10 col-md-10">
				<?=form_textarea('desc', set_value('desc', $news->{'desc'}), 'placeholder="Message" rows="3" class="cleditor2 form-control"')?>
                    </div>
                </div>
		    </div>
    		<div class="form-actions">
        <div class="row">
            <div class="col-md-offset-2 col-md-9">
            <?=form_submit('submit',show_static_text($adminLangSession['lang_id'],293), 'class="btn btn-primary"')?>
            <a href="<?=$_cancel;?>" class="btn btn-default" type="button"><?=show_static_text($adminLangSession['lang_id'],22);?></a>
            </div>
        </div>
    </div>
           <?=form_close()?>
            </div>
        </div>
        <!-- end panel -->
    </div>
</div>




<link rel="stylesheet" href="assets/plugins/bootstrap-multiselect/bootstrap-multiselect.css" type="text/css">
<script type="text/javascript" src="assets/plugins/bootstrap-multiselect/bootstrap-multiselect.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$('.multiselect').multiselect({
		buttonWidth: '100%',
		includeSelectAllOption: true,
		enableFiltering: true,
	});
});
</script>


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