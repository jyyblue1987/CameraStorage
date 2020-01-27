<div class="row">
    <div class="col-md-12">
        <!-- begin panel -->
        <div data-sortable-id="form-stuff-1" class="panel panel-inverse">
            <div class="panel-heading">                
                <h4 class="panel-title"><?=$name?></h4>
            </div>
            <div class="panel-body">
            <!-- BEGIN FORM-->
            <?php echo validation_errors();?>
                    <?=form_open(NULL, array('class' => 'form-horizontal', 'role'=>'form','enctype'=>"multipart/form-data"))?>                                                             
                        <div class="form-body">
	                                                   	
	                    <div class="form-group" >
                  			<label class="col-lg-2 control-label"><?=show_static_text($lang_id,116);?></label>
                            <div class="col-lg-10">
	                        <?php echo form_dropdown('type', $type_data, $this->input->post('type') ? $this->input->post('type') : $products->type, 'class="form-control"'); ?>
                            </div>
                        </div>


                        <div class="form-group" >
                  			<label class="col-lg-2 control-label"><?=show_static_text($lang_id,236);?></label>
                            <div class="col-lg-10">
                               <?=form_input('name', set_value('name', $products->name), 'class="form-control " id="" placeholder=""')?>
                            </div>
                        </div>

                    
<div class="form-group">
  <label class="col-lg-2 control-label">Gym</label>
  <div class="col-lg-10">
<select class="form-control" name="gym_id" id="" required>
<?php
if(isset($gym_data)&&!empty($gym_data)){
	foreach($gym_data as $set_sub){
?>
<option value="<?=$set_sub->id; ?>" <?=$products->gym_id==$set_sub->id?'selected="selected"':''?> ><?=$set_sub->name; ?></option>
<?php
	}
}
?>

    </select>
    <span class="error-span"><?php echo form_error('gym_id'); ?></span>
  </div>
</div>

<div class="form-group">
  <label class="col-lg-2 control-label"><?=show_static_text($lang_id,309);?></label>
  <div class="col-lg-10">

<select class="tag_field" name="program_id[]" id="" multiple="multiple" style="width:100%"  required>
<?php
$temp_subC = '';
if(!empty($products->program_id)){
	$temp_subC = explode(',',$products->program_id);
}
if(isset($program_data)&&!empty($program_data)){
	foreach($program_data as $set_sub){
		if(!empty($temp_subC)&&in_array($set_sub->id,$temp_subC)){
?>
<option value="<?=$set_sub->id; ?>" selected="selected"><?=$set_sub->name; ?></option>
<?php
		}
		else{
?>
<option value="<?=$set_sub->id; ?>"><?=$set_sub->name; ?></option>
<?php
		}
	}
}
?>

    </select>
    <span class="error-span"><?php echo form_error('program_id'); ?></span>
  </div>
</div>

<!--<div class="form-group" >
	<label class="col-lg-2 control-label">Start Date</label>
	<div class="col-lg-10">
    <input class="form-control input-date" type="text" id="" name="s_date" value="<?=!empty($products->{'s_date'})?h_dateFormat(set_value('s_date', $products->{'s_date'}),'d-m-Y'):set_value('dates', $products->{'s_date'})?>" data-date-format="dd-mm-yyyy" data-date-start-date="+0d"   />
    <span class="error-span"><?php echo form_error('dates'); ?></span>
	</div>
</div>-->
		
                        <div class="form-group" >
                  			<label class="col-lg-2 control-label"><?=show_static_text($lang_id,41);?></label>
                            <div class="col-lg-10">
                               <?=form_input('price', set_value('price', $products->price), 'class="form-control " id="" placeholder="price"')?>
                            </div>
                        </div>

                        <!--<div class="form-group" >
                  			<label class="col-lg-2 control-label">Month</label>
                            <div class="col-lg-10">
                        <?php echo form_dropdown('month', $month, $this->input->post('month') ? $this->input->post('month') : $products->month, 'class="form-control"'); ?>
                            </div>
                        </div>-->                        

						<div class="form-group" >
                  			<label class="col-lg-2 control-label"><?=show_static_text($lang_id,316);?></label>
                            <div class="col-lg-10">
    <select class="form-control " name="member" onchange="changeOption(this.value);" required>
        	<option value="" >Select</option>
<?php
if($class_data){
	foreach($class_data as $key=>$value){
?>
    <option value="<?=$key?>" <?=$key==$products->member?'selected="selected"':''?> ><?=$value?></option>
<?php
	}
}
?>
	</select>

                            </div>
                        </div>

                        <div class="form-group day-hida" style="" >
                  			<label class="col-lg-2 control-label"><?=show_static_text($lang_id,64);?></label>
                            <div class="col-lg-10">
                        <?php echo form_dropdown('month', $month, $this->input->post('month') ? $this->input->post('month') : $products->month, 'class="form-control"'); ?>
                            </div>
                        </div>                        
						
                        <!--<div class="form-group" >
                  			<label class="col-lg-2 control-label">Credit Point</label>
                            <div class="col-lg-10">
                               <?=form_input('c_point', set_value('c_point', $products->c_point), 'class="form-control " id="" placeholder=""')?>
                            </div>
                        </div>-->
                      

<!--			<div class="form-group hide-data2" style=" <?=$products->member==100?'':'display:none'?>">
	<label class="col-lg-2 control-label"><?=show_static_text($lang_id,232);?></label>
	<div class="col-lg-10">
    <input class="form-control input-date" type="text" id="" name="e_date" value="<?=!empty($products->{'e_date'})?h_dateFormat(set_value('e_date', $products->{'e_date'}),'d-m-Y'):date('d-m-Y')?>" data-date-format="dd-mm-yyyy" data-date-start-date="+0d"  required-field2 />
    <span class="error-span"><?php echo form_error('dates'); ?></span>
	</div>
</div>                        
	    -->                    
            <div class="form-group">
              <label class="col-lg-2 control-label"><?=show_static_text($lang_id,38);?></label>
              <div class="col-lg-10">
                <?=form_textarea('desc', set_value('desc', $products->desc), 'placeholder="" rows="3" class="cleditor2 form-control"')?>
              </div>
            </div>
                        
                           
						</div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-2 col-md-9">
                                    <?=form_submit('submit', show_static_text($lang_id,235), 'class="btn btn-primary"')?>
                                    <a href="<?=$_cancel?>" class="btn btn-default" type="button"><?=show_static_text($lang_id,22);?></a>
                                    <!--<button type="button" class="btn default">Cancl</button>-->
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
function changeOption(type){
	return false;
	if(type==100){
		$('.required-field2').attr('required',true);		
		$('.day-hida').hide();
		$('.hide-data2').show();
	}
	else{
		$('.hide-data2').hide();
		$('.day-hida').show();
		$('.required-field2').attr('required',false);
	}
}

</script>

<link href="assets/global/plugins/bootstrap-datepicker/css/datepicker.css"  rel='stylesheet' type='text/css' >
<script type="text/javascript" src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script>
$(document).ready(function(){
	//$('&nbsp;').appendTo('div.dataTables_filter');
	//$('div.dataTables_filter').appendTo('<button id="refresh">Refresh</button>');
	$('.input-date').datepicker({ dateFormat: 'mm-dd-yy', altField: '#input-date_alt', altFormat: 'yy-mm-dd' }).on('changeDate', function(e){
    $(this).datepicker('hide');});

});
</script>

<!--<script src="assets/plugins/ckeditor/ckeditor.js" type="text/javascript" language="javascript"></script> 
<script src="assets/plugins/ckeditor/adapters/jquery.js" type="text/javascript" language="javascript"></script> 
<script>
/* CL Editor */
$(document).ready(function(){
    $('.cleditor2').ckeditor({});
});
</script>
-->
<link href="assets/plugins/select2/select2.css" rel="stylesheet"/>
<script type="text/javascript" src="assets/plugins/select2/select2.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$('.tag_field').select2({placeholder: "Select"});
});

</script>
