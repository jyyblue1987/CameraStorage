<style>
.static-info {
  margin-bottom: 10px;
}
.static-info .name {
  font-size: 14px;
  font-weight: 600;
}
.static-info .value {
  font-size: 14px;
}
</style>

<div class="row">
	<div class="col-md-12">
        <!-- begin panel -->
        <div data-sortable-id="form-stuff-1" class="panel panel-inverse">
            <div class="panel-heading">                
                <h4 class="panel-title"><?=$name?></h4>
            </div>
            <div class="panel-body">

<div style="margin-top:30px" >

<?php echo validation_errors();?>
 <?=form_open(NULL, array('class' => 'form-horizontal', 'role'=>'form','enctype'=>"multipart/form-data"))?>
 <input type="hidden" name="operation" value="1" />
<div class="form-body">                    
	<div class="col-md-12">                                  

<?php
if($all_data){
	foreach($all_data as $set_data){
		$get_membership = $this->comman_model->get_by('memberships',array('plan_id'=>$set_data->id),false,false,false);
?>
<div class="form-group" >
    <label class="col-lg-2 control-label"><?=$set_data->name?></label>
    <div class="col-lg-10">
<?php
if($get_membership){
foreach($get_membership as $set_d){
$setPrice = $set_d->price;
$checkDealer = $this->comman_model->get_by('users',array('id'=>$user_details->parent_id),false,false,true);
if($checkDealer){
    if($checkDealer->is_set_price==1){
        $checkUsePrice = $this->comman_model->get_by('plans_c',array('user_id'=>$user_details->id,'plan_id'=>$set_d->id,'is_set'=>1),false,false,true);
        if($checkUsePrice){
            $setPrice = $checkUsePrice->price;
        }
    }
}
?>
<div class="radio">
<label><input type="radio" name="m_id" value="<?=$set_d->id?>" required><?=$set_d->name.' $'.$setPrice.'/mo USD (';?>
<?=array_key_exists($set_d->month,$month_data)?$month_data[$set_d->month]:$set_d->month?><?=')'?></label>
</div>
<?php
}
}

?>



</div>
</div>
<?php
	}
}
?>

        <div class="form-group">
  <label class="col-lg-2 control-label"><?=show_static_text($lang_id,1088);?>Name Your Device</label>
  <div class="col-lg-10">
    	<input type="text" name="name" value="" class="form-control" required />
  </div>
</div>

    <div class="form-group">
	    <label class="col-lg-2 control-label"><?=show_static_text($lang_id,1088);?>Model</label>
    	<div class="col-lg-10">
		    <select class="form-control" name="model" onchange="change_option(this.value)"  required>
                <option value="NVR"  >NVR/DVR</option>
                <option value="IP Camera"  >IP Camera</option>
                <option value="Custom RTSP Device"  >Custom RTSP Device</option>        
		    </select>
	    </div>
    </div>

<div class="hide-data" style="">
    <div class="form-group" >
        <label class="col-lg-2 control-label"><?=show_static_text($lang_id,1000);?>IP Address or FQDN</label>
        <div class="col-sm-10">
            <input class="form-control required-field" name="ip_address" type="text" value="" required />
            <span class="error-span"><?php echo form_error('ip_address'); ?></span>
        </div>
    </div>

    <div class="form-group" >
        <label class="col-lg-2 control-label"><?=show_static_text($lang_id,1000);?>Port</label>
        <div class="col-sm-10">
            <input class="form-control required-field" name="port" type="text" value="" required />
            <span class="error-span"><?php echo form_error('port'); ?></span>
        </div>
    </div>    

    <div class="form-group" >
        <label class="col-lg-2 control-label"><?=show_static_text($lang_id,1000);?>User</label>
        <div class="col-sm-10">
            <input class="form-control required-field" name="username" type="text" value="" required />
            <span class="error-span"><?php echo form_error('username'); ?></span>
        </div>
    </div>
    
    <div class="form-group" >
        <label class="col-lg-2 control-label"><?=show_static_text($lang_id,1000);?>Password</label>
        <div class="col-sm-10">
            <input class="form-control required-field" name="password" type="text" value="" required />
            <span class="error-span"><?php echo form_error('password'); ?></span>
        </div>
    </div>


    <div class="form-group hide-for-ip" >
        <label class="col-lg-2 control-label"><?=show_static_text($lang_id,1000);?>Camera Number</label>
        <div class="col-sm-10">
            <input type="text" name="camera_num" value="1"  min='1' class="form-control required-field not-r-for-ip" required />
            <span class="error-span"><?php echo form_error('camera_num'); ?></span>
        </div>
    </div>


    <div class="form-group" >
        <label class="col-lg-2 control-label"><?=show_static_text($lang_id,1000);?>Stream</label>
        <div class="col-sm-10">
            <input name="stream" type="munber" value="1" min='1' class="form-control required-field numeric" required />
            <span class="error-span"><?php echo form_error('camera_num'); ?></span>
        </div>
    </div>
    

    
</div>

<div class="hide-data2" style="display:none">
    <div class="form-group" >
        <label class="col-lg-2 control-label"><?=show_static_text($lang_id,1000);?>Url</label>
        <div class="col-sm-10">
            <input class="form-control required-field2" name="url" type="text" value="" />
            <span class="error-span"><?php echo form_error('port'); ?></span>
        </div>
    </div>    
</div>

    <div class="form-group">
	    <label class="col-lg-2 control-label"><?=show_static_text($lang_id,1088);?>Motion</label>
    	<div class="col-lg-10">
		    <select class="form-control" name="motion" required>
                <option value="Enable"  >Enable</option>
                <option value="Disable"  >Disable</option>
		    </select>
	    </div>
    </div>

    <div class="form-group">
	    <label class="col-lg-2 control-label"><?=show_static_text($lang_id,1088);?>Resolution</label>
    	<div class="col-lg-10">
		    <select class="form-control" name="resolution" required>
                <option value="CIF – 352x240"  >CIF – 352x240</option>
                <option value="VGA 640x480"  >VGA 640x480</option>
                <option value="1MP/720p 1280x720"  >1MP/720p 1280x720</option>
		    </select>
	    </div>
    </div>

	<div class="form-group">
	    <label class="col-lg-2 control-label">&nbsp;</label>
    	<div class="col-lg-10">
	    <input type="checkbox" name="is_mail" class="" value="1" >
		    <span style="font-size:15px;">Do you want a notification email if the connection is lost and restored for this device?</span>
            
            
	    </div>
    </div>
    
	</div>

<div style="clear:both"></div>

        </div>
     <div class="form-actions">
            <div class="row">
                <div class="col-md-offset-2 col-md-9">
                    <?=form_submit('submit', show_static_text($lang_id,235), 'class="btn btn-primary"')?>
                    <a href="<?=$_cancel.'/create';?>" class="btn btn-default" type="button"><?=show_static_text($lang_id,22);?></a>
                </div>
            </div>
        </div>
 <?=form_close()?>

</div>



            </div>
        </div>
        <!-- end panel -->
    </div>   
</div>






<script>

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
		if(type=='IP Camera'){
			$('.not-r-for-ip').attr('required',false);
			$('.hide-for-ip').hide();
		}
		else{
			$('.not-r-for-ip').attr('required',true);
			$('.hide-for-ip').show();
		}
	}
	
}
</script>

<script src="assets/global/scripts/numeric.js"></script>
<script type="text/javascript">

$(document).ready(function(){
    $(".numeric").numeric();
});
</script>
