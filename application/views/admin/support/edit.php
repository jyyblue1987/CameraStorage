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
<input type="hidden" value="create" name="formType">
<div class="form-body">                    
	<div class="col-md-12">						                        

	<div class="form-group" >
        <label class="col-lg-2 control-label">Company Name</label>
        <div class="col-lg-10">
			<?=form_input('company_name', set_value('company_name',$support_data->company_name), 'class="form-control " id="" placeholder=""')?>
    	    <span class="error-span"><?php echo form_error('company_name'); ?></span>
        </div>
    </div>
    
    <div class="form-group" >
        <label class="col-lg-2 control-label">Contact Name</label>
        <div class="col-lg-10">
			<?=form_input('contact_name', set_value('contact_name',$support_data->contact_name), 'class="form-control " id="" placeholder=""')?>
    	    <span class="error-span"><?php echo form_error('contact_name'); ?></span>
        </div>
    </div>    

    <div class="form-group" >
        <label class="col-lg-2 control-label">Website</label>
        <div class="col-lg-10">
			<?=form_input('website', set_value('website',$support_data->website), 'class="form-control " id="" placeholder=""')?>
    	    <span class="error-span"><?php echo form_error('website'); ?></span>
        </div>
    </div>    

    <div class="form-group" >
        <label class="col-lg-2 control-label">E-mail</label>
        <div class="col-lg-10">
			<?=form_input('email', set_value('email',$support_data->email), 'class="form-control " id="" placeholder=""')?>
    	    <span class="error-span"><?php echo form_error('email'); ?></span>
        </div>
    </div>    

    <div class="form-group" >
        <label class="col-lg-2 control-label">Support Number</label>
        <div class="col-lg-10">
			<?=form_input('support_num', set_value('support_num',$support_data->support_num), 'class="form-control " id="" placeholder=""')?>
    	    <span class="error-span"><?php echo form_error('support_num'); ?></span>
        </div>
    </div>    
    
    <div class="form-group" >
        <label class="col-lg-2 control-label">Support Hour</label>
        <div class="col-lg-10">
			<?=form_input('support_hour', set_value('support_hour',$support_data->support_hour), 'class="form-control " id="" placeholder=""')?>
    	    <span class="error-span"><?php echo form_error('support_hour'); ?></span>
        </div>
    </div>

   <div class="form-group" >
        <label class="col-lg-2 control-label">Sales Number</label>
        <div class="col-lg-10">
			<?=form_input('sales_num', set_value('sales_num',$support_data->sales_num), 'class="form-control " id="" placeholder=""')?>
    	    <span class="error-span"><?php echo form_error('sales_num'); ?></span>
        </div>
    </div>    

   <div class="form-group" >
        <label class="col-lg-2 control-label">Business Hour</label>
        <div class="col-lg-10">
			<?=form_input('business_hour', set_value('business_hour',$support_data->business_hour), 'class="form-control " id="" placeholder=""')?>
    	    <span class="error-span"><?php echo form_error('business_hour'); ?></span>
        </div>
    </div>    

<div class="form-group" >
	<label class="col-lg-2 control-label">Additional Notes</label>
	<div class="col-lg-10">
		<?=form_textarea('notes', set_value('notes',$support_data->notes), 'placeholder="" rows="3" class="cleditor2 form-control"')?>
        <span class="error-span"><?php echo form_error('notes'); ?></span>
	</div>
</div>

<!--<div class="form-group" >
	<label class="col-lg-2 control-label">Terms & Conditions</label>
	<div class="col-lg-10">
		<?=form_textarea('term_desc', set_value('flash_notes',$support_data->term_desc), 'placeholder="" rows="3" class="cleditor2 form-control"')?>
        <span class="error-span"><?php echo form_error('term_desc'); ?></span>
	</div>
</div>-->

</div>
</div>

 <div class="form-actions">
        <div class="row">
            <div class="col-md-offset-2 col-md-9">
                <?=form_submit('submit', 'Submit', 'class="btn btn-primary"')?>
            </div>
        </div>
    </div>
<?=form_close()?>
      </div>
        </div>
        <!-- end panel -->
    </div>
	    
</div>


<script src="assets/plugins/ckeditor/ckeditor.js" type="text/javascript" language="javascript"></script>
<script src="assets/plugins/ckeditor/adapters/jquery.js" type="text/javascript" language="javascript"></script>
<script>
/* CL Editor */
$(document).ready(function(){
    $('.cleditor2').ckeditor();


});
</script>