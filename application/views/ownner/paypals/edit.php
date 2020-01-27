<div class="row">
    <div class="col-md-12">
        <!-- begin panel -->
        <div class="panel panel-inverse">
            <div class="panel-heading">                
                <h4 class="panel-title"><?=$name?></h4>
            </div>
            <div class="panel-body">

<?php //echo validation_errors();?>
<?=form_open(NULL, array('class' => 'form-horizontal edit-form', 'role'=>'form','enctype'=>"multipart/form-data"))?>
<input type="hidden" name="product_id" id="input-type"  value="Product" />
<input type="hidden" name="order" value="set"  />
<div class="form-body">                    
    <div class="col-md-12">						                                                                        	

    <div class="form-group">
	    <label class="col-lg-2 control-label"><?=show_static_text($lang_id,242);?></label>
	    <div class="col-lg-8">
    	    <input class="form-control" type="text" name="username" value="<?=set_value('username',$products->username)?>" required  />
        	<span class="error-span"><?php echo form_error('username'); ?></span>
		</div>    
    </div>

    <div class="form-group">
	<label class="col-lg-2 control-label"><?=show_static_text($lang_id,20);?> </label>
	    <div class="col-lg-8">
    	    <input class="form-control" type="text" name="password" value="<?=set_value('signature',$products->password)?>" required  />
        	<span class="error-span"><?php echo form_error('password'); ?></span>
		</div>    
    </div>

    <div class="form-group">
		<label class="col-lg-2 control-label"><?=show_static_text($lang_id,102);?> </label>
	    <div class="col-lg-8">
    	    <input class="form-control" type="text" name="signature" value="<?=set_value('signature',$products->signature)?>" required  />
        	<span class="error-span"><?php echo form_error('signature'); ?></span>
		</div>    
    </div>

<div class="form-group" >
	<label class="col-lg-2 control-label">Sandbox</label>
	<div class="col-lg-10">
		<?=form_checkbox('sandbox', '1', set_value('sandbox', $products->sandbox), 'id="inputDefault" class=""')?>
	</div>
</div>                           

    <div class="form-group">
		<label class="col-lg-2 control-label"><?=show_static_text($lang_id,125);?></label>
	    <div class="col-lg-8">
    	    <input class="form-control" type="text" name="account" value="<?=set_value('account',$products->account)?>" required  />
        	<span class="error-span"><?php echo form_error('account'); ?></span>
		</div>    
    </div>
		
    <div class="form-group">
        <label class="col-lg-2 control-label">Set Recurring</label>
        <div class="col-lg-10">
        <?=form_checkbox('is_recurring', '1', set_value('is_recurring', $products->is_recurring), '')?>
        </div>
    </div>
    
    <div class="form-group">
        <label class="col-lg-2 control-label"><?=show_static_text($lang_id,260);?></label>
        <div class="col-lg-10">
        <?=form_checkbox('is_default', '1', set_value('is_default', $products->is_default), 'id="inputDefault"')?>
        </div>
    </div>
		
                
    </div>

	<div style="clear:both"></div>

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
