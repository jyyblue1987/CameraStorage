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
        <label class="col-lg-2 control-label" style="padding-top:0;"><?=show_static_text($lang_id,18);?></label>
        <div class="col-lg-10">
			<?=$users->email?>
        </div>
    </div>
    
<div class="form-group" >
    <label class="col-lg-2 control-label"  style="padding-top:0;">Name</label>
    <div class="col-lg-10">
			<?=$users->first_name.' '.$users->last_name?>
    </div>
</div>    

<div class="form-group" >
    <label class="col-lg-2 control-label">Free Camera</label>
    <div class="col-lg-4">
		<select class="form-control " name="free_camera" id="select_category" >
                    <option value="0">None</option>
<?php
for($i=1;$i<=$user_details->c_num;$i++){
?>
    <option value="<?=$i?>" <?=$users->free_camera==$i?'selected="selected"':''?> ><?=$i.' camera'?></option>
<?php
}
?>

                </select>
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