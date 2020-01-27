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
        <label class="col-lg-2 control-label"><?=show_static_text($lang_id,17);?></label>
        <div class="col-lg-10">
			<?=form_input('last_name', set_value('last_name'), 'class="form-control " id="" placeholder=""')?>
    	    <span class="error-span"><?php echo form_error('last_name'); ?></span>
        </div>
    </div>
    
	<div class="form-group">
      <label class="col-lg-2 control-label"><?=show_static_text($lang_id,2880);?>Gender</label>
      <div class="col-lg-10">
        <?php echo form_dropdown('gender',array('Male'=>'Male','Female'=>'Female'), $this->input->post('gender'), 'class="form-control"'); ?>
      </div>
    </div>
        
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
	        <input type="text" name="password" class="form-control " value="<?=set_value('password');?>">
    	    <span class="error-span"><?php echo form_error('password'); ?></span>
        </div>
    </div>

    <div class="form-group" >
        <label class="col-lg-2 control-label"><?=show_static_text($lang_id,2000);?>Phone</label>
        <div class="col-lg-10">
	        <input type="text" name="phone" class="form-control " value="<?=set_value('phone');?>">
    	    <span class="error-span"><?php echo form_error('phone'); ?></span>
        </div>
    </div>
    <div class="form-group" >
        <label class="col-lg-2 control-label"><?=show_static_text($lang_id,2000);?>Address</label>
        <div class="col-lg-10">
	        <input type="text" name="address" class="form-control " value="<?=set_value('address');?>" id="input-address">
    	    <span class="error-span"><?php echo form_error('address'); ?></span>
        </div>
    </div>

    <div class="form-group" >
        <label class="col-lg-2 control-label"><?=show_static_text($lang_id,2000);?>City</label>
        <div class="col-lg-10">
	        <input type="text" name="city" class="form-control " value="<?=set_value('city');?>" id="input-address">
    	    <span class="error-span"><?php echo form_error('city'); ?></span>
        </div>
    </div>
    
    <div class="form-group" >
        <label class="col-lg-2 control-label"><?=show_static_text($lang_id,2000);?>State</label>
        <div class="col-lg-10">
	        <input type="text" name="state" class="form-control " value="<?=set_value('state');?>" id="input-address">
    	    <span class="error-span"><?php echo form_error('state'); ?></span>
        </div>
    </div>

	<div class="form-group" >
        <label class="col-lg-2 control-label"><?=show_static_text($lang_id,2000);?>Zipcode</label>
        <div class="col-lg-10">
	        <input type="text" name="zip" class="form-control " value="<?=set_value('zip');?>" id="input-address">
    	    <span class="error-span"><?php echo form_error('zip'); ?></span>
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


