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
	<label class="col-lg-2 control-label" style="padding-top:0"><?=show_static_text($adminLangSession['lang_id'],4001);?>Email</label>
    <div class="col-md-10">
	    <?=$users->{'email'}?>
    </div>
</div>

    <div class="form-group" >
        <label class="col-lg-2 control-label">Name</label>
        <div class="col-lg-10">
            <?=form_input('first_name', set_value('first_name', $users->{'first_name'}), 'class="form-control " id="" placeholder=""')?>
        </div>
    </div>
    <div class="form-group" >
        <label class="col-lg-2 control-label">Company Name</label>
        <div class="col-lg-10">
            <?=form_input('company_name', set_value('company_name', $users->{'company_name'}), 'class="form-control " id="" placeholder=""')?>
        </div>
    </div>

	<div class="form-group" >
        <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],4010);?>Days</label>
        <div class="col-lg-10">
		<?php echo form_dropdown('c_days', $days_data, $this->input->post('c_days') ? $this->input->post('c_days') :$users->c_days, 'class="form-control"'); ?>
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
    <option value="<?=$i?>" <?=$users->c_num==$i?'selected="selected"':''?> ><?=$i.' camera'?></option>
<?php
}
?>

                </select>
        </div>
    </div>

<div class="form-group" >
                            <label class="col-lg-2 control-label">Phone</label>
                            <div class="col-lg-10">
                                <?=form_input('phone', set_value('phone', $users->{'phone'}), 'class="form-control " id="" placeholder="Phone"')?>
                            </div>
                        </div>

<div class="form-group" >
	<label class="col-lg-2 control-label">Set Custom Price For Client</label>
	<div class="col-lg-10">
    <input type="checkbox" name="is_set_price" class="" value="1" <?=$users->is_set_price==1?'checked="checked"':''?> >
	</div>
</div>

    <div class="form-group" >
	<label class="col-lg-2 control-label">Flash Notice</label>
	<div class="col-lg-10">
		<?=form_textarea('flash_notes', set_value('flash_notes',$users->flash_notes), 'placeholder="" rows="3" class="cleditor2 form-control"')?>
        <span class="error-span"><?php echo form_error('flash_notes'); ?></span>
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

<link href="assets/plugins/jasny-bootstrap/css/jasny-bootstrap.min.css" rel="stylesheet" type="text/css"/>
<script src="assets/plugins/jasny-bootstrap/js/jasny-bootstrap.min.js" type="text/javascript" language="javascript"></script> 

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