<div class="row">
    <div class="col-md-12">
        <!-- begin panel -->
        <div data-sortable-id="form-stuff-1" class="panel panel-inverse">
            <div class="panel-heading">                
                <h4 class="panel-title"><?=$name?></h4>
            </div>
            <div class="panel-body">
                <?php echo validation_errors();?>
<?php //echo validation_errors();?>
<?=form_open(NULL, array('class' => 'form-horizontal edit-form', 'role'=>'form','enctype'=>"multipart/form-data"))?>
<input type="hidden" name="name" value="set" />
<div class="form-body">                    
	<div class="form-group" >
	<label class="col-lg-2 control-label" style="padding-top:0"><?=show_static_text($adminLangSession['lang_id'],4001);?>Due Amount</label>
    <div class="col-md-10">
	   $<?=abs($users->debt_point)?>
    </div>
</div>

</div>
         <div class="form-actions">
                <div class="row">
                    <div class="col-md-offset-2 col-md-9">
                    <button type="submit" class="btn btn-primary submitBtn" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> <?=show_static_text($lang_id,235)?>"><?=show_static_text($lang_id,235)?></button>
                        <a href="<?=$_cancel;?>" class="btn btn-default" type="button"><?=show_static_text($adminLangSession['lang_id'],22);?></a>
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
