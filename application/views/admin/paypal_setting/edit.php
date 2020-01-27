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
                 <?=form_open(NULL, array('class' => 'form-horizontal', 'role'=>'form','enctype'=>"multipart/form-data"))?>
                               
                        <div class="form-body">                    
<div class="form-group" >
	<label class="col-lg-2 control-label">Username</label>
	<div class="col-lg-10">
<?=form_input('username', set_value('username', $paypal->username), 'class="form-control " id="" placeholder=""')?>
	</div>
</div>                           
<div class="form-group" >
	<label class="col-lg-2 control-label">Signature</label>
	<div class="col-lg-10">
<?=form_input('signature', set_value('signature', $paypal->signature), 'class="form-control " id="" placeholder=""')?>
	</div>
</div>                           
<div class="form-group" >
	<label class="col-lg-2 control-label">Password</label>
	<div class="col-lg-10">
<?=form_input('password', set_value('password', $paypal->password), 'class="form-control " id="" placeholder=""')?>
	</div>
</div>                           
<div class="form-group" >
	<label class="col-lg-2 control-label">Sandbox</label>
	<div class="col-lg-10">
<?=form_checkbox('sandbox', '1', set_value('sandbox', $paypal->sandbox), 'id="inputDefault" class=""')?>
	</div>
</div>                           

						</div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-2 col-md-9">
                                    <?=form_submit('submit', 'Update', 'class="btn btn-primary"')?>
                                    <!--<button type="button" class="btn default">Cancl</button>-->
                                </div>
                            </div>
                        </div>
                    <?=form_close()?>

            </div>
        </div>
        <!-- end panel -->
    </div>
</div>
