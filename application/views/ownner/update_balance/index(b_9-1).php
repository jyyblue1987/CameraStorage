<div class="row">
    <div class="col-md-12">
        <!-- begin panel -->
        <div data-sortable-id="form-stuff-1" class="panel panel-inverse">
            <div class="panel-heading">                
                <h4 class="panel-title"><?=$name?></h4>
            </div>
            <div class="panel-body">
                <?php //echo validation_errors();?>
<?php echo validation_errors();?>
<?=form_open(NULL, array('class' => 'form-horizontal', 'role'=>'form','enctype'=>"multipart/form-data"))?>
<div class="form-body">                    
	<div class="form-group" >
        <div class="col-md-12">
            <div class="alert alert-info"> You must make your payment to iLink Professionals, Inc. for this service on the 1st of each month. Failure to pay by the 5th of each month will suspend your service without any notifications and a $50 reactivation fee will be required. It is the dealer’s responsibility to keep the account current.</div>
        </div>
	</div>        
	<div class="form-group" >
	<label class="col-lg-2 control-label" style="padding-top:0"><?=show_static_text($lang_id,4001);?>Total payment due to iLink Professionals, Inc. for</label>
    <div class="col-md-10">
	    <?=$user_details->total_point?>
    </div>
</div>


    <div class="form-group" >
        <label class="col-lg-2 control-label"><?=show_static_text($lang_id,4001);?>Get Amount</label>
        <div class="col-md-10">
            <?=form_input('amount', set_value('amount',1), 'class="form-control " id="" placeholder=""')?>
            <span class="error-span"><?php echo form_error('amount'); ?></span>
        </div>
    </div>
              
</div>
         <div class="form-actions">
                <div class="row">
                    <div class="col-md-offset-2 col-md-9">
                        <?=form_submit('submit', show_static_text($lang_id,235), 'class="btn btn-primary"')?>
                    </div>
                </div>
            </div>
            
	<div class="form-group" style="margin-top:10px" >
        <div class="col-md-12">
            <div class="alert alert-info">
Failure to reactivate your suspended account by 15th of the month may result in complete termination of your account without any notification and all your clients as well as the videos from all the cameras may be permanently deleted without any recovery option.
<br>Even though it is a dealer’s responsibility to keep the account current, we may try to send a warning email from the email address “No-Reply@MyOnlineCameras.com”, so please add this email address to your email white list to avoid emails going into junk mail.  iLink Professionals, Inc. is not responsible for sending warning emails or contacting for any outstanding balance.
</div>
        </div>
	</div>        


            
     <?=form_close()?>
            </div>
        </div>
        <!-- end panel -->
    </div>
</div>

