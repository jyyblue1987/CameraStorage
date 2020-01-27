<div class="row">
    <div class="col-md-12">
        <!-- begin panel -->
        <div data-sortable-id="form-stuff-1" class="panel panel-inverse">
            <div class="panel-heading">                
                <h4 class="panel-title"><?=$name?></h4>
            </div>
            <div class="panel-body">

            <?php echo validation_errors();?>
<?=form_open(NULL, array('class' => 'form-horizontal edit-form', 'role'=>'form','enctype'=>"multipart/form-data"))?>
<input type="hidden" value="create" name="formType">
<div class="form-body">                    
	<div class="col-md-12">						                        

	<div class="form-group" >
        <label class="col-lg-2 control-label"><?=show_static_text($lang_id,1000);?>Company Name</label>
        <div class="col-lg-10">
			<?=form_input('company_name', set_value('company_name',$support_data->company_name), 'class="form-control " id="" placeholder=""')?>
    	    <span class="error-span"><?php echo form_error('company_name'); ?></span>
        </div>
    </div>
    
    <div class="form-group" >
        <label class="col-lg-2 control-label"><?=show_static_text($lang_id,1000);?>Contact Name</label>
        <div class="col-lg-10">
			<?=form_input('contact_name', set_value('contact_name',$support_data->contact_name), 'class="form-control " id="" placeholder=""')?>
    	    <span class="error-span"><?php echo form_error('contact_name'); ?></span>
        </div>
    </div>    

    <div class="form-group" >
        <label class="col-lg-2 control-label"><?=show_static_text($lang_id,1000);?>Website</label>
        <div class="col-lg-10">
			<?=form_input('website', set_value('website',$support_data->website), 'class="form-control " id="" placeholder="http://www.domain.com"')?>
    	    <span class="error-span"><?php echo form_error('website'); ?></span>
        </div>
    </div>    

    <div class="form-group" >
        <label class="col-lg-2 control-label"><?=show_static_text($lang_id,18);?></label>
        <div class="col-lg-10">
			<?=form_input('email', set_value('email',$support_data->email), 'class="form-control " id="" placeholder=""')?>
    	    <span class="error-span"><?php echo form_error('email'); ?></span>
        </div>
    </div>    

    <div class="form-group" >
        <label class="col-lg-2 control-label"><?=show_static_text($lang_id,1000);?>Support Number</label>
        <div class="col-lg-10">
			<?=form_input('support_num', set_value('support_num',$support_data->support_num), 'class="form-control " id="" placeholder=""')?>
    	    <span class="error-span"><?php echo form_error('support_num'); ?></span>
        </div>
    </div>    
    
    <div class="form-group" >
        <label class="col-lg-2 control-label"><?=show_static_text($lang_id,1700);?>Support Hour</label>
        <div class="col-lg-10">
			<?=form_input('support_hour', set_value('support_hour',$support_data->support_hour), 'class="form-control " id="" placeholder=""')?>
    	    <span class="error-span"><?php echo form_error('support_hour'); ?></span>
        </div>
    </div>

   <div class="form-group" >
        <label class="col-lg-2 control-label"><?=show_static_text($lang_id,1000);?>Sales Number</label>
        <div class="col-lg-10">
			<?=form_input('sales_num', set_value('sales_num',$support_data->sales_num), 'class="form-control " id="" placeholder=""')?>
    	    <span class="error-span"><?php echo form_error('sales_num'); ?></span>
        </div>
    </div>    

   <div class="form-group" >
        <label class="col-lg-2 control-label"><?=show_static_text($lang_id,1000);?>Business Hour</label>
        <div class="col-lg-10">
			<?=form_input('business_hour', set_value('business_hour',$support_data->business_hour), 'class="form-control " id="" placeholder=""')?>
    	    <span class="error-span"><?php echo form_error('business_hour'); ?></span>
        </div>
    </div>    

<div class="form-group" >
	<label class="col-lg-2 control-label"><?=show_static_text($lang_id,8400);?>Additional Notes</label>
	<div class="col-lg-10">
		<?=form_textarea('notes', set_value('notes',$support_data->notes), 'placeholder="" rows="3" class="cleditor2 form-control"')?>
        <span class="error-span"><?php echo form_error('notes'); ?></span>
	</div>
</div>

<div class="form-group" >
	<label class="col-lg-2 control-label"><?=show_static_text($lang_id,8400);?>Terms & Conditions</label>
	<div class="col-lg-10">
		<?=form_textarea('term_desc', set_value('term_desc',$support_data->term_desc), 'placeholder="" rows="3" class="cleditor2 form-control"')?>
        <span class="error-span"><?php echo form_error('term_desc'); ?></span>
	</div>
</div>

</div>
</div>

 <div class="form-actions">
        <div class="row">
            <div class="col-md-offset-2 col-md-9">
                    <button type="submit" class="btn btn-primary submitBtn" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> <?=show_static_text($lang_id,235)?>"><?=show_static_text($lang_id,235)?></button>
                <a href="<?=$_user_link.'/account';?>" class="btn btn-default" type="button"><?=show_static_text($lang_id,22);?></a>
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
    //$('.cleditor3').ckeditor();


});
</script>

<script>
$('.edit-form').on('keyup keypress', function(e) {
  var keyCode = e.keyCode || e.which;
  if (keyCode === 13) { 
    e.preventDefault();
    return false;
  }
});
$(document).ready(function () {
    $(".edit-form").submit(function () {
//        $(".submitBtn").attr("disabled", true);
		$(".submitBtn").button('loading');
        return true;
    });
});


</script>
