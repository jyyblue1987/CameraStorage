<div class="row">
    <div class="col-md-12">
        <!-- begin panel -->
        <div data-sortable-id="form-stuff-1" class="panel panel-inverse">
            <div class="panel-heading">                
                <h4 class="panel-title"><?=$name?></h4>
            </div>
            <div class="panel-body">

            <?php echo validation_errors();?>
<?=form_open(NULL, array('class' => 'form-horizontal edit-form', 'role'=>'form','enctype'=>"multipart/form-data"))?>
<input type="hidden" value="create" name="formType">
      <div id="more_pic" style="display:none"></div>

<div class="form-body">                    
	<div class="col-md-12">						                        

    

<div class="form-group" >
    <label class="col-lg-2 control-label"><?=show_static_text($lang_id,1039);?>User</label>
    <div class="col-lg-10">

		<select  class="form-control" name="user_id" id="input-user-id" required >
        	<option value="">Select</option>
<?php
if(!empty($user_data)){
	foreach($user_data as $value){		
?>
    <option value="<?=$value->id; ?>" <?=isset($products)&&$products->user_id==$value->id?'selected="selected"':''?>  ><?=$value->username; ?></option>
<?php
	}
}
?>
    </select>
    </div>
</div>

<div class="form-group" >
    <label class="col-lg-2 control-label">Plan</label>
    <div class="col-lg-10">
		<select name="plan_id" class="form-control" id="input-plan-id"  required >
        	<option value="">Select</option>
<?php
if(!empty($plan_data)){
	foreach($plan_data as $set_d){
?>
    <option value="<?=$set_d->id; ?>" <?=isset($products)&&$products->plan_id==$set_d->id?'selected="selected"':''?>  ><?=print_value('plans',array('id'=>$set_d->plan_id),'name').' ( '.$set_d->name.' $'.$set_d->price.'/mo USD (';?>
		<?=array_key_exists($set_d->month,$month_data)?$month_data[$set_d->month]:$set_d->month?><?=') )'?></option>
<?php
    }
}
?>
    </select>
	    <span class="error-span"><?php echo form_error('plan_id'); ?></span>
    </div>
</div>

<div class="form-group" >
    <label class="col-lg-2 control-label">Price</label>
    <div class="col-lg-10">
		<?=form_input('price', set_value('price',$products->price), 'class="form-control " id="" placeholder=""')?>
        <span class="error-span"><?php echo form_error('price'); ?></span>
    </div>
</div>

<div class="form-group" >
    <label class="col-lg-2 control-label" style="padding-top:0">Default</label>
    <div class="col-lg-10">
	    <input type="checkbox" name="is_set" class="" value="1" <?=$products->is_set==1?'checked="checked"':''?> >
    </div>
</div>

<div id="input-plan">
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
function checkPlan(id){	
	user = $('#input-user-id').val();
	$.ajax({
		type:"POST",
		url:"<?=$_cancel.'/ajaxPlan'?>",
		data:{id:id},
		dataType: 'json',
		success: function(json) {	
			if(json.status=='ok'){
				$('#input-plan').html(json.content);
			}
			if(json.status=='error'){
				$('#input-plan').html(json.msge);
			}
		}
		
	});
}

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
