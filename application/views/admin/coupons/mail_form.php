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
		<?=validation_errors()?>
        <?=form_open(NULL, array('class' => 'form-horizontal', 'role'=>'form','enctype'=>"multipart/form-data"))?>
                   <input type="hidden" name="operation" value="set" />
 	    	<div class="form-body">              
            	<div class="form-group">
                        <label class="col-lg-2 col-md-2 col-sm-2 control-label">user Email-ID</label>
                        <div class="col-md-10 col-lg-10">
							<select id="user_email" multiple="multiple" class="multiselect populate placeholder form-control user-list" name="email[]" required>

<?php
$user_data  = $this->comman_model->get_by('users',array('account_type !='=>'P'),false,false,false);
if(count($user_data)){
	foreach($user_data as $set_user){
?>
		<option value="<?php echo $set_user->email; ?>" ><?php echo $set_user->email; ?></option>
<?php
	}
}
?>
							</select>                            
                        </div>
                    </div>      
            	<div class="form-group" >
                        <label class="col-lg-2 col-md-2 control-label"><?=lang('')?>Subject</label>
                        <div class="col-lg-10 col-md-10">
                           <?=form_input('subject', set_value('subject', $news->subject), 'class="form-control " id="" placeholder="Subject"')?>
                        </div>
                    </div>
                <div class="form-group">
                    <label class="col-md-2 col-lg-2 control-label">Message</label>
                    <div class="col-lg-10 col-md-10">
				<?=form_textarea('desc', set_value('desc', $news->{'message'}), 'placeholder="Message" rows="3" class="cleditor2 form-control"')?>
                    </div>
                </div>
		    </div>
    		<div class="form-actions">
        <div class="row">
            <div class="col-md-offset-2 col-md-9">
            <?=form_submit('submit', 'Send', 'class="btn btn-primary"')?>
            </div>
        </div>
    </div>
           <?=form_close()?>
            <!-- END FORM-->
        </div>
    </div>
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
    $('.cleditor2').ckeditor();
});
</script>