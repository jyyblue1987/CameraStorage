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
	<div class="form-group " >
        <label class="col-lg-2 control-label"><?=show_static_text($lang_id,1000);?>To</label>
        <div class="col-lg-10">
			<input type="email" name="email" value="" class="form-control " required="required"  />
        </div>
    </div>

	<div class="form-group " >
        <label class="col-lg-2 control-label">Message</label>
        <div class="col-lg-10">
			<textarea name="message" class="form-control" required="required"></textarea>
        </div>
    </div>
</div>
</div>

 <div class="form-actions">
        <div class="row">
            <div class="col-md-offset-2 col-md-9">
                <button type="submit" class="btn btn-primary submitBtn" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Sending">Send</button>
                <a href="<?=$_cancel;?>" class="btn btn-default" type="button">Back</a>
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
