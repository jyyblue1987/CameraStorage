<div class="row">
    <div class="col-md-12">
        <!-- begin panel -->
        <div data-sortable-id="form-stuff-1" class="panel panel-inverse">
            <div class="panel-heading">                
                <h4 class="panel-title"><?=$name?></h4>
            </div>
            <div class="panel-body">

            <?php //echo validation_errors();?>
<?=form_open(NULL, array('class' => 'form-horizontal', 'role'=>'form','enctype'=>"multipart/form-data"))?>
<input type="hidden" value="create" name="formType">
      <div id="more_pic" style="display:none"></div>

<div class="form-body">                    
	<div class="col-md-12">						                        

    <div class="form-group" >
        <label class="col-lg-2 control-label"><?=show_static_text($lang_id,16);?></label>
        <div class="col-lg-10">
			<?=form_input('first_name', set_value('first_name'), 'class="form-control " id="" placeholder=""')?>
    	    <span class="error-span"><?php echo form_error('first_name'); ?></span>
        </div>
    </div>    
    
    <div class="form-group" >
        <label class="col-lg-2 control-label"><?=show_static_text($lang_id,17000);?>Company Name</label>
        <div class="col-lg-10">
			<?=form_input('company_name', set_value('company_name'), 'class="form-control " id="" placeholder=""')?>
    	    <span class="error-span"><?php echo form_error('company_name'); ?></span>
        </div>
    </div>
    
	<!--<div class="form-group">
      <label class="col-lg-2 control-label"><?=show_static_text($lang_id,145);?></label>
      <div class="col-lg-10">
        <?php echo form_dropdown('gender',array('Male'=>'Male','Female'=>'Female'), $this->input->post('gender'), 'class="form-control"'); ?>
      </div>
    </div>-->
        
    <div class="form-group" >
        <label class="col-lg-2 control-label"><?=show_static_text($lang_id,18);?></label>
        <div class="col-lg-10">
			<?=form_input('email', set_value('email'), 'class="form-control " id="" placeholder=""')?>
    	    <span class="error-span"><?php echo form_error('email'); ?></span>
        </div>
    </div>
    <div class="form-group" >
        <label class="col-lg-2 control-label"><?=show_static_text($lang_id,20);?></label>
        <div class="col-lg-10">
	        <input type="password" name="password" class="form-control " value="<?=set_value('password');?>">
    	    <span class="error-span"><?php echo form_error('password'); ?></span>
        </div>
    </div>


    <div class="form-group" >
        <label class="col-lg-2 control-label"><?=show_static_text($lang_id,82);?></label>
        <div class="col-lg-10">
	        <input type="text" name="phone" class="form-control " value="<?=set_value('phone');?>">
    	    <span class="error-span"><?php echo form_error('phone'); ?></span>
        </div>
    </div>


    <div class="form-group" >
        <label class="col-lg-2 control-label"><?=show_static_text($lang_id,8002);?>Mobile Number</label>
        <div class="col-lg-10">
	        <input type="text" name="phone2" class="form-control " value="<?=set_value('phone2');?>">
    	    <span class="error-span"><?php echo form_error('phone2'); ?></span>
        </div>
    </div>
    
    <div class="form-group" >
        <label class="col-lg-2 control-label"><?=show_static_text($lang_id,46);?></label>
        <div class="col-lg-10">
	        <input type="text" name="address" class="form-control " value="<?=set_value('address');?>" id="input-address">
    	    <span class="error-span"><?php echo form_error('address'); ?></span>
        </div>
    </div>

<div class="form-group" >
	<label class="col-lg-2 control-label"><?=show_static_text($lang_id,84);?></label>
	<div class="col-lg-10">
    <input type="text" name="city" class="form-control " value="<?=set_value('city');?>">
    	<span class="error-span"><?php echo form_error('city'); ?></span>
	</div>
</div>


<div class="form-group" >
	<label class="col-lg-2 control-label"><?=show_static_text($lang_id,52);?></label>
	<div class="col-lg-10">
    <input type="text" name="state" class="form-control " value="<?=set_value('state');?>">
		
    	<span class="error-span"><?php echo form_error('state'); ?></span>
	</div>
</div>    


<div class="form-group" >
	<label class="col-lg-2 control-label"><?=show_static_text($lang_id,1000);?>Zip Code</label>
	<div class="col-lg-10">
	    <input type="text" name="zip" class="form-control " value="<?=set_value('zip');?>">
    	<span class="error-span"><?php echo form_error('zip'); ?></span>
	</div>
</div>    

<div class="form-group" >
	<label class="col-lg-2 control-label"><?=show_static_text($lang_id,85);?></label>
	<div class="col-lg-10">
    <input type="text" name="country" class="form-control " value="<?=set_value('country');?>">

    	<span class="error-span"><?php echo form_error('Country'); ?></span>
	</div>
</div>


<div class="form-group" >
	<label class="col-lg-2 control-label"><?=show_static_text($lang_id,8400);?>Flash Notice</label>
	<div class="col-lg-10">
		<?=form_textarea('flash_notes', set_value('flash_notes'), 'placeholder="" rows="3" class="cleditor2 form-control"')?>
        <span class="error-span"><?php echo form_error('flash_notes'); ?></span>
                <br />
        <span class="label label-sm label-warning" style="display:block;white-space:normal;font-size:14px;line-height:20px;text-align:justify">
        Information in this field will show up on the top in this client's control panel over Live Camera View section. This is to send any short temporary alert message to that client and this message will stay there until it's removed from this field. Use only if necessary and keep it for a short amount of time</span>

	</div>
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
        <!-- end panel -->
    </div>
	    
</div>




<script>
function get_region(id){	
	$.ajax({
		type:"POST",
		url:"<?='ajax_product/getRegion'?>",
		data:{id:id,<?=$this->security->get_csrf_token_name();?>:'<?=$this->security->get_csrf_hash();?>'},
		dataType: 'json',
		success: function(json) {	
			if(json.status=='ok'){
				$('#input-region').html(json.msge);
			}
			if(json.status=='error'){
				$('#input-region').html('<option value="">Select</option>');
			}
		}
		
	});
}
function get_city(id){	
	$.ajax({
		type:"POST",
		url:"<?='ajax_product/getCities'?>",
		data:{id:id,<?=$this->security->get_csrf_token_name();?>:'<?=$this->security->get_csrf_hash();?>'},
		dataType: 'json',
		success: function(json) {	
			if(json.status=='ok'){
				$('#input-city').html(json.msge);
			}
			if(json.status=='error'){
				$('#input-city').html('<option value="">Select</option>');
			}
		}
		
	});
}

</script>