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
<select class=" tag_field" name="user_id" style="width:100%" required>
<option value="">Select</option>
<?php
if(isset($user_data)&&!empty($user_data)){
foreach($user_data as $setCategory){
?>
<option value="<?=$setCategory->id;?>"  ><?=$setCategory->username;?></option>
<?php
}
}
?>
</select>
                    </div>
                </div>

                <div class="form-group" >
                    <label class="col-lg-2 control-label">Plan</label>
                    <div class="col-lg-10">
<select class="form-control" name="plan_id" required>
<option value="">Select</option>
<?php
if(isset($membership_data)&&!empty($membership_data)){
foreach($membership_data as $setCategory){
?>
<option value="<?=$setCategory->id;?>"  ><?=$setCategory->name .' ( price: '.$setCategory->price.', class: '.$setCategory->member.')';?></option>
<?php
}
}
?>
</select>
                    </div>
                </div>
                
                    <div class="form-group" >
        <label class="col-lg-2 control-label"><?=show_static_text($lang_id,271);?></label>
        <div class="col-lg-10">
			<select name="discount" class="form-control ">
            	<option value="0">Select</option>
                
<?php
for($i=1;$i<=100;$i++){
?>
			<option value="<?=$i?>" ><?=$i?>%</option>
<?php
}
?>
            </select>
<!--    	    <span class="error-span"><?php echo form_error('discount'); ?></span>-->
        </div>
    </div>
    

<div class="form-group" >
	<label class="col-lg-2 control-label">Start Date</label>
	<div class="col-lg-10">
    <input class="form-control" type="text" id="input-date" name="s_date" value="<?=h_dateFormat(set_value('s_date', date('d-m-Y')),'d-m-Y')?>" data-date-format="dd-mm-yyyy" data-date-start-date="+0d"  required   />
    <span class="error-span"><?php echo form_error('s_date'); ?></span>
	</div>
</div>
                                   
                </div>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-2 col-md-9">
                            <?=form_submit('submit', 'Save', 'class="btn btn-primary"')?>
                            <a href="<?=$_cancel?>" class="btn btn-default" type="button"><?='Cancel'?></a>
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


<!--<script src="assets/plugins/ckeditor/ckeditor.js" type="text/javascript" language="javascript"></script> 
<script src="assets/plugins/ckeditor/adapters/jquery.js" type="text/javascript" language="javascript"></script> 
<script>
/* CL Editor */
$(document).ready(function(){
    $('.cleditor2').ckeditor({});
});
</script>
-->

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

<link href="assets/plugins/select2/select2.css" rel="stylesheet"/>
<script type="text/javascript" src="assets/plugins/select2/select2.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$('.tag_field').select2({placeholder: "Select"});
});

</script>
