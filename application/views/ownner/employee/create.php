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
        <label class="col-lg-2 control-label"><?=show_static_text($lang_id,16);?></label>
        <div class="col-lg-10">
			<?=form_input('first_name', set_value('first_name'), 'class="form-control " id="" placeholder=""')?>
    	    <span class="error-span"><?php echo form_error('first_name'); ?></span>
        </div>
    </div>    
    	        
    <div class="form-group" >
        <label class="col-lg-2 control-label"><?=show_static_text($lang_id,18);?></label>
        <div class="col-lg-10">
			<?=form_input('email', set_value('email'), 'class="form-control " id="" placeholder=""')?>
    	    <span class="error-span"><?php echo form_error('email'); ?></span>
        </div>
    </div>
    <div class="form-group" >
        <label class="col-lg-2 control-label"><?=show_static_text($lang_id,20);?></label>
        <div class="col-lg-10">
	        <input type="password" name="password" class="form-control " value="<?=set_value('password');?>">
    	    <span class="error-span"><?php echo form_error('password'); ?></span>
        </div>
    </div>

    <div class="form-group" >
        <label class="col-lg-2 control-label"><?=show_static_text($lang_id,82);?></label>
        <div class="col-lg-10">
	        <input type="text" name="phone" class="form-control " value="<?=set_value('phone');?>">
    	    <span class="error-span"><?php echo form_error('phone'); ?></span>
        </div>
    </div>
    
    <div class="form-group" >
        <label class="col-lg-2 control-label"><?=show_static_text($lang_id,46);?></label>
        <div class="col-lg-10">
	        <input type="text" name="address" class="form-control " value="<?=set_value('address');?>" id="input-address">
    	    <span class="error-span"><?php echo form_error('address'); ?></span>
        </div>
    </div>




<div class="form-group" >
        <label class="col-lg-2 control-label"><?=show_static_text($lang_id,1440);?>Permissions</label>
        <div class="col-lg-10">
<ul class="main_checkbox">
<?php
echo get_ol1($permissions,0);

function get_ol1 ($array,$user_id, $child = FALSE){
	$CI =& get_instance();
	$str = '';
	if (count($array)) {
//		$str .= $child == FALSE ? '<ol class="sortable" style="margin-top:10px">' : '<ol>';
		foreach ($array as $item) {
//			echo $key.' : '.$item;
			$str .='<li>';
			$str .=form_checkbox('permission['.$item['id'].']', '1',set_value('permission['.$item['id'].']'), 'id="tall" class=""').' <label for="Review"> '.$item['value'].'</label>';
			if (isset($item['children']) && count($item['children'])) {
				$str .= '<ul class="checkbox2">'.get_ol1($item['children'],$user_id, TRUE).'</ul>';
			}
			$str .='</li>';
		}
	//	$str .= '</ol>' . PHP_EOL;

	}
	return $str;
}
?>
  

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
