
<div class="row">
    <div class="col-md-12">
        <!-- begin panel -->
        <div data-sortable-id="form-stuff-1" class="panel panel-inverse">
            <div class="panel-heading">                
                <h4 class="panel-title"><?=$name?></h4>
            </div>
            <div class="panel-body">

<?php echo validation_errors();?>

<?=form_open($_cancel.'/order_confirm', array('class' => 'form-horizontal', 'role'=>'form','enctype'=>"multipart/form-data"))?>
	    <input type="hidden" name="<?=$this->security->get_csrf_token_name(); ?>" value="<?=$this->security->get_csrf_hash();?>" />
	      	<input type="hidden" name="operation" value="set">
        <fieldset>
<h3>Prorated payment amount has been charged for this month and the monthly recurring payment has been setup. Please delete this camera if you are not 100% satisfied within 3 days (weekends count) and a refund will automatically be posted for the prorated charges for this month, as well as the recurring payment will be removed from your account for this camera. Please click on the Confirm button to continue.</h3>
        </fieldset>


    
     <div class="form-actions">
            <div class="row">
                <div class="col-md-9">
                    <?=form_submit('submit','Confirm' , 'class="btn btn-primary"')?>
                </div>
            </div>
        </div>
 <?=form_close()?>
            </div>
        </div>
        <!-- end panel -->
    </div>

	<!--col-md-12-->

    
    <!--end col-md-12-->
</div>


