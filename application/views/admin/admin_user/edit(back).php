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
			<label class="col-lg-2 col-md-2 control-label">Crendential</label>
        <div class="col-lg-10">
<ul class="main_checkbox">
  <li>
	<?=form_checkbox('permission[general_setting]', '1', set_value('permission[general_setting]',checkPermission('admin_permission',array('user_id'=>$employee->id,'type'=>'general_setting','value'=>1))), 'id="tall" class=""')?>
    <label for="class">General Settings</label>
  </li>

  <li>
	<?=form_checkbox('permission[products]', '1',set_value('permission[products]',checkPermission('admin_permission',array('user_id'=>$employee->id,'type'=>'products','value'=>1))), 'id="tall" class=""')?>
    <label for="workout">Products Management</label>
    <ul class="checkbox2">
        <li>
	        <?=form_checkbox('permission[category]', '1',set_value('permission[category]',checkPermission('admin_permission',array('user_id'=>$employee->id,'type'=>'category','value'=>1))), 'id="tall-1" class=""')?>
    	    <label for="tall-1">Category</label>
        </li>        
        <li>
	        <?=form_checkbox('permission[product]', '1',set_value('permission[product]',checkPermission('admin_permission',array('user_id'=>$employee->id,'type'=>'product','value'=>1))), 'id="tall-1" class=""')?>
    	    <label for="tall-1">Body Part</label>
        </li>
    </ul>
  </li>

  
  <li>
	<?=form_checkbox('permission[user_manage]', '1',set_value('permission[user_manage]',checkPermission('admin_permission',array('user_id'=>$employee->id,'type'=>'user_manage','value'=>1))), 'id="tall" class=""')?>
    <label for="Salary">User Management</label>
  </li>


  

  

  <!--<li>
	<?=form_checkbox('permission[memberships]', '1',set_value('permission[memberships]',checkPermission('admin_permission',array('user_id'=>$employee->id,'type'=>'memberships','value'=>1))), 'id="tall" class=""')?>
    <label for="workout">Membership</label>
    <ul class="checkbox2">
        <li>
	        <?=form_checkbox('permission[membership]', '1',set_value('permission[membership]',checkPermission('admin_permission',array('user_id'=>$employee->id,'type'=>'membership','value'=>1))), 'id="tall-1" class=""')?>
    	    <label for="tall-1">Membership</label>
        </li>
        <li>
	        <?=form_checkbox('permission[membership_history]', '1',set_value('permission[membership_history]',checkPermission('admin_permission',array('user_id'=>$employee->id,'type'=>'membership_history','value'=>1))), 'id="tall-1" class=""')?>
    	    <label for="tall-1">History</label>
        </li>
    </ul>
  </li>-->

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
	        <?=form_checkbox('permission[page]', '1',set_value('permission[page]',checkPermission('admin_permission',array('user_id'=>$employee->id,'type'=>'page','value'=>1))), 'id="tall-1" class=""')?>
    	    <label for="tall-1">Page</label>
        </li>
        <li>
	        <?=form_checkbox('permission[slider]', '1',set_value('permission[slider]',checkPermission('admin_permission',array('user_id'=>$employee->id,'type'=>'slider','value'=>1))), 'id="tall-1" class=""')?>
    	    <label for="tall-1">Slider</label>
        </li>
    </ul>
  </li>

  
  

  

  

    

  <li>
	<?=form_checkbox('permission[place_manage]', '1',set_value('permission[place_manage]',checkPermission('admin_permission',array('user_id'=>$employee->id,'type'=>'place_manage','value'=>1))), 'id="tall" class=""')?>
    <label for="workout">Place Management</label>
    <ul class="checkbox2">
        <li>
	        <?=form_checkbox('permission[country]', '1',set_value('permission[country]',checkPermission('admin_permission',array('user_id'=>$employee->id,'type'=>'country','value'=>1))), 'id="tall-1" class=""')?>
    	    <label for="tall-1">Country</label>
        </li>
        <li>
	        <?=form_checkbox('permission[state]', '1',set_value('permission[state]',checkPermission('admin_permission',array('user_id'=>$employee->id,'type'=>'state','value'=>1))), 'id="tall-1" class=""')?>
    	    <label for="tall-1">State</label>
        </li>
        <li>
	        <?=form_checkbox('permission[city]', '1', set_value('permission[city]',checkPermission('admin_permission',array('user_id'=>$employee->id,'type'=>'city','value'=>1))), 'id="tall-1" class=""')?>
    	    <label for="tall-1">city</label>
        </li>
    </ul>
  </li>
  
      <li>
	    <?=form_checkbox('permission[public_chat]', '1',set_value('permission[public_chat]',checkPermission('admin_permission',array('user_id'=>$employee->id,'type'=>'public_chat','value'=>1))), 'id="tall" class=""')?>
    	<label for="Review">Public Chat</label>
    </li>
    <li>
	    <?=form_checkbox('permission[chat]', '1',set_value('permission[chat]',checkPermission('admin_permission',array('user_id'=>$employee->id,'type'=>'chat','value'=>1))), 'id="tall" class=""')?>
    	<label for="Review">Chat</label>
    </li>



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