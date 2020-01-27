<div class="row">
    <div class="col-md-12">
        <!-- begin panel -->
        <div data-sortable-id="form-stuff-1" class="panel panel-inverse">
            <div class="panel-heading">                
                <h4 class="panel-title"><?=$name?></h4>
            </div>
            <div class="panel-body">
<?php validation_errors();?>
<?=form_open(NULL, array('class' => 'form-horizontal', 'role'=>'form','enctype'=>"multipart/form-data"))?>
<div class="form-body">                    
	<div class="col-md-12">                                  

    <div class="form-group">
        <label class="col-lg-2 control-label"><?=show_static_text($lang_id,1088);?>Name</label>
        <div class="col-lg-10">
        	<input type="text" name="name" value="<?=set_value('name', $products->name)?>" class="form-control" required />
    	    <span class="error-span"><?php echo form_error('name'); ?></span>
        </div>
	</div>

    <div class="form-group" >
    <label class="col-lg-2 control-label"><?=show_static_text($lang_id,1039);?>Camera</label>
    <div class="col-lg-10">

		<select multiple="multiple" class="tag_field" name="camera[]" id="select_colour" style="width:100%" required >
<?php
$temp_siz = '';
if(!empty($products->camera_id)){
	$temp_siz = explode(',',$products->camera_id);
}
if(!empty($camera_data)){
foreach($camera_data as $value){		
    if(!empty($temp_siz)&&in_array($value->id,$temp_siz)){
?>
    <option value="<?=$value->id; ?>" selected="selected"><?=$value->name; ?></option>
<?php
    }
    else{
?>
    <option value="<?=$value->id; ?>"><?=$value->name; ?></option>
<?php
    }
}
}
?>
    </select>
	    <span class="error-span"><?php echo form_error('camera'); ?></span>
    </div>
</div>


    
	</div>

<div style="clear:both"></div>

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

<link href="assets/plugins/select2/select2.css" rel="stylesheet"/>
<script type="text/javascript" src="assets/plugins/select2/select2.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$('.tag_field').select2({placeholder: "Select"});
});

</script>
