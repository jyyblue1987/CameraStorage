<div class="row">
	<div class="col-md-12">
        <!-- begin panel -->
        <div data-sortable-id="form-stuff-1" class="panel panel-inverse">
            <div class="panel-heading">                
                <h4 class="panel-title"><?=$name?></h4>
            </div>
            <div class="panel-body">
<div class="portlet-body">
    <div class="row static-info">
        <div class="col-md-3 name"><b>Title</b></div>
        <div class="col-md-9 value"><?=$view_data->name;?></div>
    </div>    
    <div class="row static-info">
        <div class="col-md-3 name"><b>Price</b></div>
        <div class="col-md-9 value"><?=$view_data->price;?> Peso</div>
    </div>    
        
    <div class="row static-info">
        <div class="col-md-3 name"><b>1 Coach</b></div>
        <div class="col-md-9 value"><?=$view_data->coach?> </div>
    </div>

    <div class="row static-info">
        <div class="col-md-3 name"><b>1 Athlete</b></div>
        <div class="col-md-9 value"><?=$view_data->member?> </div>
    </div>

    <div class="row static-info">
        <div class="col-md-3 name"><b>1 Staff</b></div>
        <div class="col-md-9 value"><?=$view_data->staff?> </div>
    </div>
   
    <div class="row static-info">
        <div class="col-md-3 name"><b>1 Competition</b></div>
        <div class="col-md-9 value"><?=$view_data->competition?></div>
    </div>

    <div class="row static-info">
        <div class="col-md-3 name"><b>1 Photographer</b></div>
        <div class="col-md-9 value"><?=$view_data->photographer?></div>
    </div>

    <div class="row static-info">
        <div class="col-md-3 name"><b>1 Sport Nutritionist</b></div>
        <div class="col-md-9 value"><?=$view_data->nutritionist?></div>
    </div>

    <div class="row static-info">
        <div class="col-md-3 name"><b>1 Affiliate Business</b></div>
        <div class="col-md-9 value"><?=$view_data->business?></div>
    </div>

    <div class="row static-info">
        <div class="col-md-3 name"><b>1 Tournament</b></div>
        <div class="col-md-9 value"><?=$view_data->tournament?></div>
    </div>

    <div class="row static-info">
        <div class="col-md-3 name"><b>Description</b></div>
        <div class="col-md-9 value"><?=$view_data->desc;?></div>
    </div>

</div>

<div style="margin-top:30px" >
<h3>Payment</h3>
<hr>
<?php echo validation_errors();?>
 <?=form_open(NULL, array('class' => 'form-horizontal', 'role'=>'form','enctype'=>"multipart/form-data"))?>
 <input type="hidden" name="operation" value="1" />
<div class="form-body">                    
	<div class="col-md-12">                                  

        <div class="form-group">
  <label class="col-lg-2 control-label">Payment Type</label>
  <div class="col-lg-10">
    <select class="form-control" name="payment_type" onchange="change_option(this.value)" >
        <option value="bank deposit"  >Bank Deposit</option>
        <option value="paypal" >Paypal</option>
    </select>
  </div>
</div>

<div class="hide-data" style="">
    <div class="form-group" >
        <label class="col-lg-2 control-label">Bank Name</label>
        <div class="col-sm-10">
            <input class="form-control required-field" name="bank_name" type="text" value="" required />
            <span class="error-span"><?php echo form_error('classes'); ?></span>
        </div>
    </div>
    <div class="form-group" >
        <label class="col-lg-2 control-label">Diposit Number</label>
        <div class="col-sm-10">
            <input class="form-control required-field" type="text" name="bank_num" value="" required/>
            <span class="error-span"><?php echo form_error('classes'); ?></span>
        </div>
    </div>
    <div class="form-group" >
        <label class="col-lg-2 control-label" style="padding-top:0">Bank Name</label>
        <div class="col-sm-10"><?=$settings['bank_name']?></div>
    </div>
    <div class="form-group" >
        <label class="col-lg-2 control-label" style="padding-top:0">Account Number</label>
        <div class="col-sm-10"><?=$settings['bank_account']?></div>
    </div>
</div>
	</div>

<div style="clear:both"></div>

        </div>
     <div class="form-actions">
            <div class="row">
                <div class="col-md-offset-2 col-md-9">
                    <?=form_submit('submit', show_static_text($lang_id,235), 'class="btn btn-primary"')?>
                    <a href="<?=$_cancel;?>" class="btn btn-default" type="button"><?=show_static_text($lang_id,22);?></a>
                </div>
            </div>
        </div>
 <?=form_close()?>

</div>



            </div>
        </div>
        <!-- end panel -->
    </div>   
</div>



<style>
.static-info {
  margin-bottom: 10px;
}
.static-info .name {
  font-size: 14px;
  font-weight: 600;
}
.static-info .value {
  font-size: 14px;
}
</style>
<style>
.dl-horizontal dt {
  width: 80px;
}
.dl-horizontal dd {
  margin-left: 112px;
}

@media (max-width: 979px) {
	.dl-horizontal dd {
	  margin-left: 0px;
	}
}
.view-data .control-label {
  text-align: left;
  margin-left:10px;
}
/*label.radio-inline.checked, label.checkbox-inline.checked, label.radio.checked, label.checkbox.checked {
  background-color: #266c8e;
  color: #fff !important;
}*/
</style>


<style>
.well{
min-height:178px;
}
</style>


<script>
$(document).ready(function () {
	var maxAllowed = <?=$view_data->member?>;
	$("input[name='classes[]']").change(function () {
		var cnt = $("input[name='classes[]']:checked").length;
		if (cnt > maxAllowed){
			$(this).prop("checked", "");
			alert('Select maximum ' + maxAllowed + ' Classes!');
		}
	});
});

function change_option(type){
	if(type=='bank deposit'){
		$('.required-field').attr('required',true);
		$('.hide-data').show();
	}
	else{
		$('.required-field').attr('required',false);
		$('.hide-data').hide();
	}
	
}
</script>
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
