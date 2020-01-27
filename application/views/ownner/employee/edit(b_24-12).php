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
        <label class="col-lg-2 control-label"><?=show_static_text($lang_id,16);?></label>
        <div class="col-lg-10">
			<?=form_input('first_name', set_value('first_name',$users->first_name), 'class="form-control " id="" placeholder=""')?>
    	    <span class="error-span"><?php echo form_error('first_name'); ?></span>
        </div>
    </div>    
    
    <div class="form-group" >
        <label class="col-lg-2 control-label"><?=show_static_text($lang_id,20);?></label>
        <div class="col-lg-10">
	        <input type="password" name="password" class="form-control " value="<?=set_value('password',$users->password);?>">
    	    <span class="error-span"><?php echo form_error('password'); ?></span>
        </div>
    </div>

    <div class="form-group" >
        <label class="col-lg-2 control-label"><?=show_static_text($lang_id,82);?></label>
        <div class="col-lg-10">
	        <input type="text" name="phone" class="form-control " value="<?=set_value('phone',$users->phone);?>">
    	    <span class="error-span"><?php echo form_error('phone'); ?></span>
        </div>
    </div>
    <div class="form-group" >
        <label class="col-lg-2 control-label"><?=show_static_text($lang_id,46);?></label>
        <div class="col-lg-10">
	        <input type="text" name="address" class="form-control " value="<?=set_value('address',$users->address);?>" id="input-address">
    	    <span class="error-span"><?php echo form_error('address'); ?></span>
        </div>
    </div>

    





    
<div class="form-group" >
        <label class="col-lg-2 control-label"><?=show_static_text($lang_id,1440);?>Permissions</label>
        <div class="col-lg-10">
<ul class="main_checkbox">
  <li>
	<?=form_checkbox('permission[users]', '1', set_value('permission[users]',checkPermission('users_permission',array('user_id'=>$users->id,'owner_id'=>$user_details->id,'type'=>'users','value'=>1))), 'id="tall" class=""')?>
    <label for="workout">Client Management</label>
    <ul class="checkbox2">
        <li>
	        <?=form_checkbox('permission[client]', '1',set_value('permission[client]',checkPermission('users_permission',array('user_id'=>$users->id,'owner_id'=>$user_details->id,'type'=>'client','value'=>1))), 'id="tall-1" class=""')?>
    	    <label for="tall-1">Client</label>
        </li>
        <li>
	        <?=form_checkbox('permission[client_camera]', '1', set_value('permission[client_camera]',checkPermission('users_permission',array('user_id'=>$users->id,'owner_id'=>$user_details->id,'type'=>'client_camera','value'=>1))), 'id="tall-1" class=""')?>
    	    <label for="tall-1">Client Camera</label>
        </li>

        <li>
	        <?=form_checkbox('permission[client_plan]', '1', set_value('permission[client_plan]',checkPermission('users_permission',array('user_id'=>$users->id,'owner_id'=>$user_details->id,'type'=>'client_plan','value'=>1))), 'id="tall-1" class=""')?>
    	    <label for="tall-1">Client Plan</label>
        </li>
    </ul>
  </li>

	<li>
	<?=form_checkbox('permission[content]', '1', set_value('permission[content]',checkPermission('users_permission',array('user_id'=>$users->id,'owner_id'=>$user_details->id,'type'=>'content','value'=>1))), 'id="tall" class=""')?>
    <label for="workout">Content Management</label>
    <ul class="checkbox2">

        <li>
            <?=form_checkbox('permission[email_setup]', '1', set_value('permission[email_setup]',checkPermission('users_permission',array('user_id'=>$users->id,'owner_id'=>$user_details->id,'type'=>'email_setup','value'=>1))), 'id="tall" class=""')?>
            <label for="tall-1">E-Mail Server Setup</label>
        </li>

        <li>
            <?=form_checkbox('permission[support]', '1', set_value('permission[support]',checkPermission('users_permission',array('user_id'=>$users->id,'owner_id'=>$user_details->id,'type'=>'support','value'=>1))), 'id="tall" class=""')?>
            <label for="tall-1">Support</label>
        </li>
        <li>
        <?=form_checkbox('permission[notification]', '1', set_value('permission[notification]',checkPermission('users_permission',array('user_id'=>$users->id,'owner_id'=>$user_details->id,'type'=>'notification','value'=>1))), 'id="tall" class=""')?>
        <label for="notification">Notifications</label>
        </li>

        <li>
        <?=form_checkbox('permission[client_link]', '1', set_value('permission[client_link]',checkPermission('users_permission',array('user_id'=>$users->id,'owner_id'=>$user_details->id,'type'=>'client_link','value'=>1))), 'id="tall" class=""')?>
        <label for="">Client Self Registration Link</label>
        </li>


    </ul>
  </li>

  <li>
	<?=form_checkbox('permission[payment_history]', '1', set_value('permission[payment_history]',checkPermission('users_permission',array('user_id'=>$users->id,'owner_id'=>$user_details->id,'type'=>'payment_history','value'=>1))), 'id="tall" class=""')?>
    <label for="payment_history">Payment History</label>
  </li>

  <li>
	<?=form_checkbox('permission[staff_manage]', '1', set_value('permission[staff_manage]',checkPermission('users_permission',array('user_id'=>$users->id,'owner_id'=>$user_details->id,'type'=>'staff_manage','value'=>1))), 'id="tall" class=""')?>
    <label for="staff_manage">Staff Management</label>
  </li>


<li>
	<?=form_checkbox('permission[payment_manage]', '1', set_value('permission[payment_manage]',checkPermission('users_permission',array('user_id'=>$users->id,'owner_id'=>$user_details->id,'type'=>'payment_manage','value'=>1))), 'id="tall" class=""')?>
    <label for="workout">Payment Account</label>
    <ul class="checkbox2">
        <li>
            <?=form_checkbox('permission[paypal_account]', '1', set_value('permission[paypal_account]',checkPermission('users_permission',array('user_id'=>$users->id,'owner_id'=>$user_details->id,'type'=>'paypal_account','value'=>1))), 'id="tall" class=""')?>
            <label for="tall-1">Paypal Account</label>
        </li>

    </ul>
  </li>

<li>
<?=form_checkbox('permission[ticket]', '1', set_value('permission[ticket]',checkPermission('users_permission',array('user_id'=>$users->id,'owner_id'=>$user_details->id,'type'=>'ticket','value'=>1))), 'id="tall" class=""')?> 
<label for=""> Ticket Management</label>
</li>
  
<!--<li>
<?=form_checkbox('permission[staff]', '1', set_value('permission[staff]',checkPermission('users_permission',array('user_id'=>$users->id,'owner_id'=>$user_details->id,'type'=>'staff','value'=>1))), 'id="tall" class=""')?>
<label for=""> Staff Management</label>
</li>-->



</ul>

        </div>
    </div>

</div>
</div>
	                 <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-2 col-md-9">
                            <button type="submit" class="btn btn-primary submitBtn" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> <?=show_static_text($lang_id,235)?>"><?=show_static_text($lang_id,235)?></button>
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
<script>
$('input[type="checkbox"]').change(function(e) {

  var checked = $(this).prop("checked"),
      container = $(this).parent(),
      siblings = container.siblings();

  container.find('input[type="checkbox"]').prop({
    indeterminate: false,
    checked: checked
  });

  function checkSiblings(el) {

    var parent = el.parent().parent(),
        all = true;

    el.siblings().each(function() {
      return all = ($(this).children('input[type="checkbox"]').prop("checked") === checked);
    });

    if (all && checked) {

      parent.children('input[type="checkbox"]').prop({
        indeterminate: false,
        checked: checked
      });

      checkSiblings(parent);

    } else if (all && !checked) {

      parent.children('input[type="checkbox"]').prop("checked", checked);
      parent.children('input[type="checkbox"]').prop("indeterminate", (parent.find('input[type="checkbox"]:checked').length > 0));
      checkSiblings(parent);

    } else {

      el.parents("li").children('input[type="checkbox"]').prop({
        indeterminate: true,
        checked: false
      });

    }

  }

  checkSiblings(container);
});
</script>

<style>
ul.main_checkbox{
	padding-left:0px;
	list-style: none;
}
ul.checkbox2 { 
	padding-left:20px;
	list-style: none;
	margin: 0px 0px;
}
.checkbox input[type="checkbox"]{
}
</style>
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
