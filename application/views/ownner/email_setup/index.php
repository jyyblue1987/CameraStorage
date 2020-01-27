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
<input type="hidden" value="create" name="formType">
<div class="form-body">                    
	<div class="col-md-12">						                        

	<div class="form-group" >
        <label class="col-lg-2 control-label"><?=show_static_text($lang_id,1000);?>Type</label>
        <div class="col-lg-10">
<select name="type" class="form-control" id="input-type" onchange="select_type()">
<?php
foreach($type_list as $key=>$val){
?>
<option value="<?=$key?>" <?=$support_data->type==$key?'selected="selected"':''?>><?=$val?></option>
<?php	
}
?>
</select>
        </div>
    </div>


	<div class="form-group hide-data" >
        <label class="col-lg-2 control-label"><?=show_static_text($lang_id,1000);?>SMTP Host</label>
        <div class="col-lg-10">
			<?=form_input('smtp_host', set_value('smtp_host',$support_data->smtp_host), 'class="form-control " ')?>
    	    <span class="error-span"><?php echo form_error('smtp_host'); ?></span>
        </div>
    </div>

	<div class="form-group hide-data" >
        <label class="col-lg-2 control-label"><?=show_static_text($lang_id,1000);?>SMTP Port</label>
        <div class="col-lg-10">
			<?=form_input('smtp_port', set_value('smtp_port',$support_data->smtp_port), 'class="form-control " ')?>
    	    <span class="error-span"><?php echo form_error('smtp_port'); ?></span>
        </div>
    </div>

	<div class="form-group hide-data" >
        <label class="col-lg-2 control-label"><?=show_static_text($lang_id,1000);?>SMTP User</label>
        <div class="col-lg-10">
			<?=form_input('smtp_user', set_value('smtp_user',$support_data->smtp_user), 'class="form-control " ')?>
    	    <span class="error-span"><?php echo form_error('smtp_user'); ?></span>
        </div>
    </div>

	<div class="form-group hide-data " >
        <label class="col-lg-2 control-label"><?=show_static_text($lang_id,1000);?>Password</label>
        <div class="col-lg-10">
			<input type="password" name="password" value="<?=set_value('password',$support_data->password)?>" class="form-control " />
    	    <span class="error-span"><?php echo form_error('password'); ?></span>
        </div>
    </div>
    
    <div class="form-group email-message " >
        <label class="col-lg-2 control-label"></label>
        <div class="col-lg-10 ">
        <div class="alert alert-info">
<span class="">To minimize your emails going into your client’s junk/spam folder, please make sure you are using your own domain name and add or edit your domain’s DNS PTR record (TXT) Host = “@” with TXT Value = “v=spf1 mx ip4:50.73.87.221 ip4:50.73.87.209 ip4:50.73.87.218 a:mail.myonlinecameras.com a:www.myonlinecameras.com ~all” contact your ISP or your IT staff to make these changes</span>
        </div>
        </div>
    </div>    



    <div class="form-group email-div hide-data" >
        <label class="col-lg-2 control-label"><?=show_static_text($lang_id,18);?></label>
        <div class="col-lg-10">
			<?=form_input('email', set_value('email',$support_data->email), 'class="form-control " ')?>
    	    <span class="error-span"><?php echo form_error('email'); ?></span>
        </div>
    </div>    

        
    
    <div class="form-group" >
	<label class="col-lg-2 control-label">Default</label>
	<div class="col-lg-10">
	    <input type="checkbox" name="is_used" class="" value="1" <?=$support_data->is_used==1?'checked="checked"':''?> >
	</div>
</div>


<div class="form-group" >
	<div class="col-lg-12">
        <span class="label label-sm label-warning" style="display:block;white-space:normal;font-size:14px;line-height:20px;text-align:justify">
<?php
$condition = $this->comman_model->get_lang('content',$lang_id,NULL,array('id'=>4),'content_id',true);
if($condition){
	echo $condition->body;
}
?>        


</span>
	</div>
</div>

</div>
</div>

 <div class="form-actions">
        <div class="row">
            <div class="col-md-offset-2 col-md-9">
                <button type="submit" class="btn btn-primary submitBtn" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> <?=show_static_text($lang_id,235)?>"><?=show_static_text($lang_id,235)?></button>
                <a href="<?=$_user_link.'/account';?>" class="btn btn-default" type="button"><?=show_static_text($lang_id,22);?></a>
                <a href="<?=$_cancel.'/test_mail';?>" class="btn btn-default" type="button">Test E-Mail</a>
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
function select_type(){
	val = $('#input-type').val();
	if(val=='email'){
		$('.hide-data').hide();
		$('.email-div').show();
		$('.email-message').show();
		
		$('.hide-data .form-control').removeAttr('required');
		$('.email-div .form-control').prop('required',true);
	}
	else if(val=='smtp'){
		$('.email-message').hide();
		$('.hide-data').show();
		$('.hide-data .form-control').prop('required',true);
	}
	else{
		$('.email-message').hide();
		$('.hide-data').hide();
		$('.hide-data .form-control').removeAttr('required');
	}
}
select_type();
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
