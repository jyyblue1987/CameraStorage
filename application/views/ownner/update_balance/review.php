
<div class="row">
    <div class="col-md-12">
        <!-- begin panel -->
        <div data-sortable-id="form-stuff-1" class="panel panel-inverse">
            <div class="panel-heading">                
                <h4 class="panel-title"><?=$name?></h4>
            </div>
            <div class="panel-body">

<?php echo validation_errors();?>

<?php echo form_open($_cancel.'/order_confirm', array('class' => 'form-horizontal', 'role'=>'form','enctype'=>"multipart/form-data",'id'=>'payment-form'))?>
	    <input type="hidden" name="<?=$this->security->get_csrf_token_name(); ?>" value="<?=$this->security->get_csrf_hash();?>" />
	      	<input type="hidden" name="operation" value="set">
        <fieldset>
<h4>Processing..</h4>
        </fieldset>


    
     <!--<div class="form-actions">
            <div class="row">
                <div class="col-md-9">
                    <?=form_submit('submit','Confirm' , 'class="btn btn-primary"')?>
                </div>
            </div>
        </div>-->
 <?=form_close()?>
            </div>
        </div>
        <!-- end panel -->
    </div>

	<!--col-md-12-->

    
    <!--end col-md-12-->
</div>



<script>
jQuery(document).ready(function() {
	jQuery(window).load(function() { 
		$( "#payment-form" ).submit();
	});
});
</script>
