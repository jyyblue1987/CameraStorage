<div class="row">
    <div class="col-md-12">
        <!-- begin panel -->
        <div class="panel panel-inverse">
            <div class="panel-heading">                
                <h4 class="panel-title"><?=$name?></h4>
            </div>
            <div class="panel-body">

<?php echo validation_errors();?>
<?=form_open(NULL, array('class' => 'form-horizontal', 'role'=>'form','enctype'=>"multipart/form-data"))?>
<input type="hidden" name="product_id" id="input-type"  value="Product" />
<input type="hidden" name="order" value="set"  />
<div class="form-body">                    
    <div class="col-md-12">						                                                                        
        <div class="form-group">
    <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],1039);?>Employee</label>
    <div class="col-lg-8">
    <select class="form-control" name="emp_id" id="" required>
    <option value="" >Select</option>
<?php
if($customer_data){
	foreach($customer_data as $set_c){
?>
    <option value="<?=$set_c->id;?>" ><?=$set_c->username;?></option>
<?php
	}
}
?>
<!--    <option value="other" >Other</option>-->
    </select>
    </div>    
    </div>
	
    <div class="form-group" >
        <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],3007);?>Salary Amount</label>
        <div class="col-lg-8">
	        <input class="form-control" type="text" name="price" value="<?=set_value('price')?>" required  />
        <span class="error-span"><?php echo form_error('price'); ?></span>
        </div>
    </div>

    <div class="form-group" >
        <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],3107);?>Observations</label>
        <div class="col-lg-8">
	        <input class="form-control" type="text" name="description" value="<?=set_value('description')?>" required  />
        <span class="error-span"><?php echo form_error('description'); ?></span>
        </div>
    </div>

    <div class="form-group" >
        <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],3107);?>Account</label>
        <div class="col-lg-8">
	        <input class="form-control" type="text" name="account_num" value="<?=set_value('account_num')?>" required  />
        <span class="error-span"><?php echo form_error('account_num'); ?></span>
        </div>
    </div>

        <!--<div class="form-group" >
	<label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],153);?></label>
	<div class="col-lg-8">
    <input class="form-control" type="text" id="input-date" name="dates" value="<?=h_dateFormat(set_value('dates',date('d-m-Y')),'d-m-Y')?>" data-date-format="dd-mm-yyyy" required  />
    <span class="error-span"><?php echo form_error('dates'); ?></span>
	</div>
</div>-->
                
    </div>

	<div style="clear:both"></div>

</div>
<div class="form-actions">
	<div class="row">
		<div class="col-md-offset-2 col-md-9">
<?=form_submit('submit', show_static_text($adminLangSession['lang_id'],235), 'class="btn btn-primary" ')?> 
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


<link href="assets/global/plugins/bootstrap-datepicker/css/datepicker.css"  rel='stylesheet' type='text/css' >
<script type="text/javascript" src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script>
$(document).ready(function(){
	//$('&nbsp;').appendTo('div.dataTables_filter');
	//$('div.dataTables_filter').appendTo('<button id="refresh">Refresh</button>');
	$('#input-date').datepicker({ dateFormat: 'mm-dd-yy', altField: '#input-date_alt', altFormat: 'yy-mm-dd' }).on('changeDate', function(e){
		
    $(this).datepicker('hide');});

});
</script>
