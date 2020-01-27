<div class="row">
    <div class="col-md-12">
        <!-- begin panel -->
        <div data-sortable-id="form-stuff-1" class="panel panel-inverse">
            <div class="panel-heading">                
                <h4 class="panel-title"><?=$name?></h4>
            </div>
            <div class="panel-body">

<?=form_open(NULL, array('class' => 'form-horizontal', 'role'=>'form','enctype'=>"multipart/form-data"))?>
<input type="hidden" value="<?=set_value('gps','51.5073509, -0.12775829999998223')?>" id="inputGps" name="gps">
      <div id="more_pic" style="display:none"></div>

<div class="form-body">                    
	<div class="col-md-12">						                        
	    

    <div class="form-group" >
        <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],16);?></label>
        <div class="col-lg-10">
			<?=form_input('first_name', set_value('first_name', $users->{'first_name'}), 'class="form-control " id="" placeholder=""')?>
    	    <span class="error-span"><?php echo form_error('first_name'); ?></span>
        </div>
    </div>
    

    <div class="form-group" >
        <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],17000);?>Company Name</label>
        <div class="col-lg-10">
			<?=form_input('company_name', set_value('company_name', $users->{'company_name'}), 'class="form-control " id="" placeholder=""')?>
    	    <span class="error-span"><?php echo form_error('company_name'); ?></span>
        </div>
    </div>
	
	
    <div class="form-group" >
        <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],18);?></label>
        <div class="col-lg-10">
			<?=form_input('email', set_value('email', $users->{'email'}), 'class="form-control " id="" placeholder=""')?>
    	    <span class="error-span"><?php echo form_error('email'); ?></span>
        </div>
    </div>
    <div class="form-group" >
        <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],20);?></label>
        <div class="col-lg-10">
	        <input type="password" name="password" class="form-control " value="<?=set_value('password');?>">
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
        <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],4010);?>Days</label>
        <div class="col-lg-10">
		<?php echo form_dropdown('c_days', $days_data, $this->input->post('c_days') ? $this->input->post('c_days') :'', 'class="form-control"'); ?>
        </div>
    </div>
    <div class="form-group" >
        <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],4010);?>Free Camera</label>
        <div class="col-lg-10">

<select class="form-control " name="c_num" id="select_category" >
                    <option value="">None</option>
<?php
for($i=1;$i<=16;$i++){
?>
    <option value="<?=$i?>" <?=$this->input->post('c_num')==$i?'selected="selected"':""?>  ><?=$i.' camera'?></option>
<?php
}
?>

                </select>
        </div>
    </div>


	<div class="form-group" >
	<label class="col-lg-2 control-label">Set Custom Price For Client</label>
	<div class="col-lg-10">
    <input type="checkbox" name="is_set_price" class="" value="1">
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



