<div class="row">
    <div class="col-md-12">
        <!-- begin panel -->
        <div data-sortable-id="form-stuff-1" class="panel panel-inverse">
            <div class="panel-heading">                
                <h4 class="panel-title"><?=$name?></h4>
            </div>
            <div class="panel-body">
                <?php echo validation_errors();?>
<?php //echo validation_errors();?>
<?=form_open(NULL, array('class' => 'form-horizontal', 'role'=>'form','enctype'=>"multipart/form-data"))?>
<div class="form-body">                    
	<div class="form-group" >
	<label class="col-lg-2 control-label" style="padding-top:0"><?=show_static_text($lang_id,18);?></label>
    <div class="col-md-10">
	    <?=$user_details->{'email'}?>
    </div>
</div>
    <div class="form-group" >
	<label class="col-lg-2 control-label"><?=show_static_text($lang_id,16);?></label>
    <div class="col-md-10">
	    <?=form_input('first_name', set_value('first_name', $user_details->{'first_name'}), 'class="form-control " id="" placeholder=""')?>
    	<span class="error-span"><?php echo form_error('first_name'); ?></span>
    </div>
</div>
	
    <div class="form-group" >
        <label class="col-lg-2 control-label"><?=show_static_text($lang_id,17);?></label>
        <div class="col-md-10">
        <?=form_input('last_name', set_value('last_name', $user_details->{'last_name'}), 'class="form-control " id="" placeholder=""')?>
        <span class="error-span"><?php echo form_error('last_name'); ?></span>
        </div>
    </div>

<div class="form-group">
      <label class="col-lg-2 control-label"><?=show_static_text($lang_id,145);?></label>
      <div class="col-lg-10">
        <?php echo form_dropdown('gender',array('Male'=>'Male','Female'=>'Female'), $this->input->post('gender')?$this->input->post('gender'):$user_details->gender, 'class="form-control"'); ?>
      </div>
    </div>
    
    <div class="form-group" >
        <label class="col-lg-2 control-label"><?=show_static_text($lang_id,82);?></label>
	    <div class="col-lg-10">
    	    <?=form_input('phone', set_value('phone', $user_details->{'phone'}), 'class="form-control " id="" placeholder=""')?>
        	<span class="error-span"><?php echo form_error('phone'); ?></span>
        </div>
    </div>

    <div class="form-group" >
        <label class="col-lg-2 control-label"><?=show_static_text($lang_id,46);?></label>
	    <div class="col-lg-10">
    	    <?=form_input('address', set_value('address', $user_details->{'address'}), 'class="form-control " id="" placeholder=""')?>
        	<span class="error-span"><?php echo form_error('address'); ?></span>
        </div>
    </div>

    <div class="form-group" >
        <label class="col-lg-2 control-label"><?=show_static_text($lang_id,84);?></label>
	    <div class="col-lg-10">
    	    <?=form_input('city', set_value('city', $user_details->{'city'}), 'class="form-control " id="" placeholder=""')?>
        	<span class="error-span"><?php echo form_error('city'); ?></span>
        </div>
    </div>

    <div class="form-group" >
        <label class="col-lg-2 control-label"><?=show_static_text($lang_id,52);?></label>
	    <div class="col-lg-10">
    	    <?=form_input('state', set_value('state', $user_details->{'state'}), 'class="form-control " id="" placeholder=""')?>
        	<span class="error-span"><?php echo form_error('state'); ?></span>
        </div>
    </div>

    <!--<div class="form-group" >
        <label class="col-lg-2 control-label"><?=show_static_text($lang_id,4010);?>Country</label>
        <div class="col-lg-10">

                    <select class="form-control" title="" name="country" required>
<option value="">Select</option>
<?php
if($country_data){
	foreach($country_data as $setCate){
?>
	<option value="<?=$setCate; ?>" <?= $user_details->{'country'}==$setCate?'selected="selected"':''; ?>  ><?=$setCate; ?></option>
<?php
	}
}
?>
</select>

                    <span class="error-span"><?php echo form_error('country'); ?></span>
            </div>
        </div>-->
    
    <div class="form-group">
      <label class="col-lg-2 control-label"><?=show_static_text($lang_id,263);?></label>
        <div class="col-md-10">
        <div class="fileinput fileinput-new" data-provides="fileinput">
            <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
                <?php echo (isset($user_details->image)&&!empty($user_details->image)) ? '<img src="'.base_url('assets/uploads/users/thumbnails').'/'.$user_details->image.'" >':'<img src="assets/uploads/no-image.gif">'; ?>
            </div>
            <div>
            <span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span>
            <input type="file" name="image" id="logo"></span>
            <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
        </div>
        </div>
            <!--<input type="file" name="logo" id="logo" />-->
      </div>
      </div>
</div>
         <div class="form-actions">
                <div class="row">
                    <div class="col-md-offset-2 col-md-9">
                        <?=form_submit('submit', show_static_text($lang_id,235), 'class="btn btn-primary"')?>
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

