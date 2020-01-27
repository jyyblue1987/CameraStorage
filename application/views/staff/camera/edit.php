<div class="row">
    <div class="col-md-12">
        <!-- begin panel -->
        <div data-sortable-id="form-stuff-1" class="panel panel-inverse">
            <div class="panel-heading">                
                <h4 class="panel-title"><?=$name?></h4>
            </div>
            <div class="panel-body">
<?php //echo validation_errors();?>
<?=form_open(NULL, array('class' => 'form-horizontal edit-form', 'role'=>'form','enctype'=>"multipart/form-data"))?>
<div class="form-body">                    
	<div class="col-md-12">                                  

    <div class="form-group">
        <label class="col-lg-2 control-label"><?=show_static_text($lang_id,1088);?>Device Name</label>
        <div class="col-lg-10">
        	<input type="text" name="name" value="<?=set_value('name', $products->name)?>" class="form-control" required />
    	    <span class="error-span"><?php echo form_error('name'); ?></span>
        </div>
	</div>

    <div class="form-group">
	    <label class="col-lg-2 control-label"><?=show_static_text($lang_id,1088);?>Model</label>
    	<div class="col-lg-10">
<select class="form-control" name="model" id="select_category" onChange="change_option(this.value);"  required>
                            	<option value="" >Select</option>
<?php
if(isset($models_data)&&!empty($models_data)){
	foreach($models_data as $setCategory){
?>
    	<option value="<?=$setCategory->id;?>"  <?=($setCategory->id==$products->model)?'selected="selected"':'';?> ><?=$setCategory->name;?></option>
<?php
	}
?>
<option value="Custom RTSP Device" <?=$products->model=='Custom RTSP Device'?'selected="selected"':''?>  >Custom RTSP Device</option>
<?php
	
}
?>
            
							</select>
	    </div>
    </div>

<div class="hide-data" style="">
    <div class="form-group" >
        <label class="col-lg-2 control-label"><?=show_static_text($lang_id,1000);?>IP Address</label>
        <div class="col-sm-10">
            <input class="form-control required-field" name="ip_address" type="text" value="<?=set_value('ip_address', $products->ip_address)?>" required />
            <span class="error-span"><?php echo form_error('ip_address'); ?></span>
        </div>
    </div>

    <div class="form-group" >
        <label class="col-lg-2 control-label"><?=show_static_text($lang_id,1000);?>Port</label>
        <div class="col-sm-10">
            <input class="form-control required-field" name="port" type="text" value="<?=set_value('port', $products->port)?>" required />
            <span class="error-span"><?php echo form_error('port'); ?></span>
        </div>
    </div>    

    <div class="form-group" >
        <label class="col-lg-2 control-label"><?=show_static_text($lang_id,1000);?>User</label>
        <div class="col-sm-10">
            <input class="form-control required-field" name="username" type="text" value="<?=set_value('username', $products->username)?>" required />
            <span class="error-span"><?php echo form_error('username'); ?></span>
        </div>
    </div>
    
    <div class="form-group" >
        <label class="col-lg-2 control-label"><?=show_static_text($lang_id,1000);?>Password</label>
        <div class="col-sm-10">
            <input class="form-control required-field" name="password" type="text" value="<?=set_value('password', $products->password)?>" required />
            <span class="error-span"><?php echo form_error('password'); ?></span>
        </div>
    </div>


    <div class="form-group" >
        <label class="col-lg-2 control-label"><?=show_static_text($lang_id,1000);?>Camera Number</label>
        <div class="col-sm-10">
            <input type="text" name="camera_num" value="<?=set_value('camera_num', $products->camera_num)?>"  min='1' class="form-control required-field" required />
            <span class="error-span"><?php echo form_error('camera_num'); ?></span>
        </div>
    </div>


    <div class="form-group" >
        <label class="col-lg-2 control-label"><?=show_static_text($lang_id,1000);?>Stream</label>
        <div class="col-sm-10">
            <input  type="munber" name="stream" value="<?=set_value('stream', $products->stream)?>" min='1' class="form-control required-field numeric" required />
            <span class="error-span"><?php echo form_error('stream'); ?></span>
        </div>
    </div>

    <div class="form-group" >
        <label class="col-lg-2 control-label"><?=show_static_text($lang_id,1000);?>Channel</label>
        <div class="col-sm-10">
            <input type="munber" name="channel" value="<?=set_value('channel', $products->channel)?>" min='1' class="form-control required-field" required />
            <span class="error-span"><?php echo form_error('channel'); ?></span>
        </div>
    </div>

    
</div>

<div class="hide-data2" style="display:none">
    <div class="form-group" >
        <label class="col-lg-2 control-label"><?=show_static_text($lang_id,1000);?>Url</label>
        <div class="col-sm-10">
            <input class="form-control required-field2" name="url" type="text" value="<?=set_value('url', $products->url)?>" required />
            <span class="error-span"><?php echo form_error('url'); ?></span>
        </div>
    </div>    
</div>

    <div class="form-group">
	    <label class="col-lg-2 control-label"><?=show_static_text($lang_id,1088);?>Motion</label>
    	<div class="col-lg-10">
		<?php echo form_dropdown('motion', $motion_data, $this->input->post('motion') ? $this->input->post('motion') : $products->motion, 'class="form-control" '); ?>
	    </div>
    </div>

    <div class="form-group">
	    <label class="col-lg-2 control-label"><?=show_static_text($lang_id,1088);?>Resolution</label>
    	<div class="col-lg-10">
		<?php echo form_dropdown('resolution', $resolution_data, $this->input->post('resolution') ? $this->input->post('resolution') : $products->resolution, 'class="form-control" '); ?>
	    </div>
    </div>


<div class="form-group">
	    <label class="col-lg-2 control-label">&nbsp;</label>
    	<div class="col-lg-10">
	    <input type="checkbox" name="is_mail" class="" value="1" <?=$products->is_mail==1?'checked="checked"':''?> >
		    <span style="font-size:15px;">Do you want a notification email if the connection is lost and restored for this device?</span>
            
            
	    </div>
    </div>    
	</div>

<div style="clear:both"></div>

        </div>

         <div class="form-actions">
                <div class="row">
                    <div class="col-md-offset-2 col-md-9">
                            <button type="submit" class="btn btn-primary submitBtn" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> <?=show_static_text($lang_id,235)?>"><?=show_static_text($lang_id,235)?></button>
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
change_option('<?=$products->model?>');
function change_option(type){
	if(type=='Custom RTSP Device'){
		$('.required-field').attr('required',false);
		$('.hide-data').hide();
		$('.required-field2').attr('required',true);
		$('.hide-data2').show();
	}
	else{
		$('.required-field').attr('required',true);
		$('.hide-data').show();

		$('.required-field2').attr('required',false);
		$('.hide-data2').hide();
	}
	
}
</script>

<script src="assets/global/scripts/numeric.js"></script>
<script type="text/javascript">

$(document).ready(function(){
    $(".numeric").numeric();
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
