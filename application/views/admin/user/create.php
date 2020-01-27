<div class="row">
    <div class="col-md-12">
        <!-- begin panel -->
        <div data-sortable-id="form-stuff-1" class="panel panel-inverse">
            <div class="panel-heading">                
                <h4 class="panel-title"><?=$name?></h4>
            </div>
            <div class="panel-body">

<?=form_open(NULL, array('class' => 'form-horizontal', 'role'=>'form','enctype'=>"multipart/form-data"))?>

<div class="form-body">                    
	<div class="col-md-12">						                        
	
    <div class="form-group">
      <label class="col-lg-2 control-label">Account Type</label>
      <div class="col-lg-10">
        <?php echo form_dropdown('type', array('Person'=>'Person','student'=>'Student'), $this->input->post('type') ? $this->input->post('type') : $users->type, 'class="form-control"'); ?>
      </div>
    </div>

    <div class="form-group" >
        <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],16);?></label>
        <div class="col-lg-10">
			<?=form_input('first_name', set_value('first_name', $users->{'first_name'}), 'class="form-control " id="address-input" placeholder=""')?>
    	    <span class="error-span"><?php echo form_error('first_name'); ?></span>
        </div>
    </div>

    <div class="form-group" >
        <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],17);?></label>
        <div class="col-lg-10">
			<?=form_input('last_name', set_value('last_name', $users->{'last_name'}), 'class="form-control " id="address-input" placeholder=""')?>
    	    <span class="error-span"><?php echo form_error('last_name'); ?></span>
        </div>
    </div>

	<div class="form-group" >
        <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],18);?></label>
        <div class="col-lg-10">
			<?=form_input('email', set_value('email', $users->{'email'}), 'class="form-control " id="address-input" placeholder=""')?>
    	    <span class="error-span"><?php echo form_error('email'); ?></span>
        </div>
    </div>
    <div class="form-group" >
        <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],20);?></label>
        <div class="col-lg-10">
	        <input type="text" name="password" class="form-control " value="<?=set_value('password');?>">
    	    <span class="error-span"><?php echo form_error('password'); ?></span>
        </div>
    </div>
    <div class="form-group" >
        <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],2000);?>Phone</label>
        <div class="col-lg-10">
	        <input type="text" name="phone" class="form-control " value="<?=set_value('phone');?>">
    	    <span class="error-span"><?php echo form_error('phone'); ?></span>
        </div>
    </div>
    <div class="form-group" >
        <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],2000);?>Address</label>
        <div class="col-lg-10">
	        <input type="text" name="address" class="form-control " value="<?=set_value('address');?>">
    	    <span class="error-span"><?php echo form_error('address'); ?></span>
        </div>
    </div>
    <div class="form-group" >
        <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],2000);?>City</label>
        <div class="col-lg-10">
	        <input type="text" name="city" class="form-control " value="<?=set_value('city');?>">
    	    <span class="error-span"><?php echo form_error('city'); ?></span>
        </div>
    </div>
    
    <div class="form-group" >
        <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],20000);?>Country</label>
        <div class="col-lg-10">
<select class="form-control" title="" name="country" id="form-country" required>
<option value="">Select</option>
<?php
$country_data = $this->custom_model->get_country_name();
if($country_data){
foreach($country_data as $setCate){
?>
<option value="<?=$setCate; ?>" <?= set_select('country',$setCate); ?> ><?=$setCate; ?></option>
<?php
}
}
?>
</select>
    	    <span class="error-span"><?php echo form_error('country'); ?></span>
        </div>
    </div>

<div class="form-group" >
        <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],2000);?>Monthly Fees</label>
        <div class="col-lg-10">
	        <input type="text" name="fees" class="form-control " value="<?=set_value('fees');?>">
    	    <span class="error-span"><?php echo form_error('fees'); ?></span>
        </div>
    </div>
</div>






</div>
	                 <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-2 col-md-9">
                                    <?=form_submit('submit', show_static_text($adminLangSession['lang_id'],235), 'class="btn btn-primary"')?>
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

