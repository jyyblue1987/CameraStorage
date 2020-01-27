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
            <form class="form-horizontal"  method="post" enctype="multipart/form-data" data-parsley-validate="true">
					<input type="hidden" name="<?=$this->security->get_csrf_token_name(); ?>" value="<?=$this->security->get_csrf_hash();?>" />
                	<input type="hidden" name="operation" value="set" />
                    <div class="form-body">
                        <div class="form-group" >
                            <label class="col-lg-2 control-label" style="padding-top:0px">Username</label>
                            <div class="col-lg-10"><?=$employee->username?></div>
                        </div>                        
                        <div class="form-group" style="padding-top:0px" >
                            <label class="col-lg-2 control-label">Email-ID</label>
                            <div class="col-lg-10"><?=$employee->email?></div>
                        </div>                                                                        
						                                
                                        
<div class="form-group" >
			<label class="col-lg-2 col-md-2 control-label">Permissions</label>
        <div class="col-lg-10">
<ul class="main_checkbox">
  <li>
	<?=form_checkbox('permission[general_setting]', '1', set_value('permission[general_setting]',checkPermission('admin_permission',array('user_id'=>$employee->id,'type'=>'general_setting','value'=>1))), 'id="tall" class=""')?>
    <label for="class">General Settings</label>
  </li>

  <li>
	<?=form_checkbox('permission[Devices]', '1', set_value('permission[Devices]',checkPermission('admin_permission',array('user_id'=>$employee->id,'type'=>'Devices','value'=>1))), 'id="tall" class=""')?>
    <label for="class">Devices</label>
  </li>


    <li>
        <?=form_checkbox('permission[user_manage]', '1',set_value('permission[user_manage]',checkPermission('admin_permission',array('user_id'=>$employee->id,'type'=>'plans','value'=>1))), 'id="tall" class=""')?>
        <label for="workout">Dealer Management</label>
        <ul class="checkbox2">
            <li>
                <?=form_checkbox('permission[dealer]', '1',set_value('permission[dealer]',checkPermission('admin_permission',array('user_id'=>$employee->id,'type'=>'dealer','value'=>1))), 'id="tall-1" class=""')?>
                <label for="tall-1">Dealer</label>
            </li>
            <li>
                <?=form_checkbox('permission[dealer_plan]', '1',set_value('permission[dealer_plan]',checkPermission('admin_permission',array('user_id'=>$employee->id,'type'=>'dealer_plan','value'=>1))), 'id="tall-1" class=""')?>
                <label for="tall-1">Custom Dealer Plan</label>
            </li>

            <li>
                <?=form_checkbox('permission[client_camera]', '1',set_value('permission[client_camera]',checkPermission('admin_permission',array('user_id'=>$employee->id,'type'=>'client_camera','value'=>1))), 'id="tall-1" class=""')?>
                <label for="tall-1">Dealers client's cameras</label>
            </li>
            <li>
                <?=form_checkbox('permission[lost_camera]', '1',set_value('permission[lost_camera]',checkPermission('admin_permission',array('user_id'=>$employee->id,'type'=>'lost_camera','value'=>1))), 'id="tall-1" class=""')?>
                <label for="tall-1">Lost Connection Cameras</label>
            </li>
  
        </ul>
      </li>

	<li>
	<?=form_checkbox('permission[plans]', '1',set_value('permission[plans]',checkPermission('admin_permission',array('user_id'=>$employee->id,'type'=>'plans','value'=>1))), 'id="tall" class=""')?>
    <label for="workout">Plan Management</label>
    <ul class="checkbox2">
        <li>
	        <?=form_checkbox('permission[plan]', '1',set_value('permission[plan]',checkPermission('admin_permission',array('user_id'=>$employee->id,'type'=>'plan','value'=>1))), 'id="tall-1" class=""')?>
    	    <label for="tall-1">Plan</label>
        </li>
        <li>
	        <?=form_checkbox('permission[membership]', '1',set_value('permission[membership]',checkPermission('admin_permission',array('user_id'=>$employee->id,'type'=>'membership','value'=>1))), 'id="tall-1" class=""')?>
    	    <label for="tall-1">Membership</label>
        </li>
        
    </ul>
  </li>

  <li>
	<?=form_checkbox('permission[payment_history]', '1',set_value('permission[payment_history]',checkPermission('admin_permission',array('user_id'=>$employee->id,'type'=>'payment_history','value'=>1))), 'id="tall" class=""')?>
    <label for="Review">Payment History</label>
  </li>

  
  
  <li>
	<?=form_checkbox('permission[content_manage]', '1',set_value('permission[content_manage]',checkPermission('admin_permission',array('user_id'=>$employee->id,'type'=>'content_manage','value'=>1))), 'id="tall" class=""')?>
    <label for="workout">Content Management</label>
    <ul class="checkbox2">
        <li>
	        <?=form_checkbox('permission[content]', '1',set_value('permission[content]',checkPermission('admin_permission',array('user_id'=>$employee->id,'type'=>'content','value'=>1))), 'id="tall-1" class=""')?>
    	    <label for="tall-1">Content</label>
        </li>

        <li>
	        <?=form_checkbox('permission[flash_note]', '1',set_value('permission[flash_note]',checkPermission('admin_permission',array('user_id'=>$employee->id,'type'=>'flash_note','value'=>1))), 'id="tall-1" class=""')?>
    	    <label for="tall-1">Flash Note</label>
        </li>

        <li>
	        <?=form_checkbox('permission[notification]', '1',set_value('permission[notification]',checkPermission('admin_permission',array('user_id'=>$employee->id,'type'=>'notification','value'=>1))), 'id="tall-1" class=""')?>
    	    <label for="tall-1">Notification</label>
        </li>

        <li>
	        <?=form_checkbox('permission[default_image]', '1',set_value('permission[default_image]',checkPermission('admin_permission',array('user_id'=>$employee->id,'type'=>'default_image','value'=>1))), 'id="tall-1" class=""')?>
    	    <label for="tall-1">Default Image</label>
        </li>
        <li>
	        <?=form_checkbox('permission[support]', '1',set_value('permission[support]',checkPermission('admin_permission',array('user_id'=>$employee->id,'type'=>'support','value'=>1))), 'id="tall-1" class=""')?>
    	    <label for="tall-1">Support</label>
        </li>
        <li>
	        <?=form_checkbox('permission[notification_setting]', '1',set_value('permission[notification_setting]',checkPermission('admin_permission',array('user_id'=>$employee->id,'type'=>'notification_setting','value'=>1))), 'id="tall-1" class=""')?>
    	    <label for="tall-1">Notification Setting</label>
        </li>
    </ul>
  </li>

    <li>
	    <?=form_checkbox('permission[ticket_manage]', '1',set_value('permission[ticket_manage]',checkPermission('admin_permission',array('user_id'=>$employee->id,'type'=>'ticket_manage','value'=>1))), 'id="tall" class=""')?>
    	<label for="Review">Ticket Management</label>
    </li>
    <li>
	    <?=form_checkbox('permission[public_chat]', '1',set_value('permission[public_chat]',checkPermission('admin_permission',array('user_id'=>$employee->id,'type'=>'public_chat','value'=>1))), 'id="tall" class=""')?>
    	<label for="Review">Public Chat</label>
    </li>

    <!--<li>
	    <?=form_checkbox('permission[chat]', '1',set_value('permission[chat]',checkPermission('admin_permission',array('user_id'=>$employee->id,'type'=>'chat','value'=>1))), 'id="tall" class=""')?>
    	<label for="Review">Chat</label>
    </li>-->



</ul>

        </div>
    </div>
	                </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-2 col-md-9">
                                    <?=form_submit('submit', lang('Save'), 'class="btn btn-success"')?>
                                    <a href="<?=$_cancel?>" class="btn btn-default" type="button"><?=lang('Cancel')?></a>
                                    <!--<button type="button" class="btn default">Cancl</button>-->
                                </div>
                            </div>
                        </div>
               </form>
            </div>
        </div>
        <!-- end panel -->
    </div>
</div>





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