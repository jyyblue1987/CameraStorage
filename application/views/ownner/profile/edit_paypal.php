<div class="row">
    <div class="col-md-12">
        <!-- begin panel -->
        <div data-sortable-id="form-stuff-1" class="panel panel-inverse">
            <div class="panel-heading">                
                <h4 class="panel-title"><?=$name?></h4>
            </div>
            <div class="panel-body">

<?php echo validation_errors();?>
<?=form_open(NULL, array('class' => 'form-horizontal', 'role'=>'form','enctype'=>"multipart/form-data"))?>
<div class="form-body">                    
	<div class="col-md-12">						                        
<h3><?=show_static_text($lang_id,210);?></h3>
<div>
<div class="form-group" >
	<label class="col-lg-2 control-label"><?=show_static_text($lang_id,48);?></label>
	<div class="col-lg-10">
<?=form_input('bank_name', set_value('bank_name', $user_details->bank_name), 'class="form-control " id="" placeholder="" required')?>
	</div>
</div>                           
<div class="form-group" >
	<label class="col-lg-2 control-label"><?=show_static_text($lang_id,210);?></label>
	<div class="col-lg-10">
<?=form_input('bank_account', set_value('bank_account', $user_details->bank_account), 'class="form-control " id="" placeholder="" required')?>
	</div>
</div>                                                      
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
                 <?=form_close()?>
            </div>
        </div>
        <!-- end panel -->
    </div>
    
    <!--end col-md-12-->
</div>

