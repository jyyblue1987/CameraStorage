<link href="assets/global/css/star.css" rel="stylesheet" />
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
        <div class="col-md-3 name"><b>Userame</b></div>
        <div class="col-md-9 value"><?=print_value('users',array('id'=>$view_data->user_id),'username');?></div>
    </div>

    <div class="row static-info">
        <div class="col-md-3 name"><b>Name</b></div>
        <div class="col-md-9 value"><?=$view_data->name;?></div>
    </div>            

    <div class="row static-info">
        <div class="col-md-3 name"><b>Workout</b></div>
        <div class="col-md-9 value"><?=$view_data->workout?></div>
    </div>    
        
    <div class="row static-info">
        <div class="col-md-3 name"><b>Styles</b></div>
        <div class="col-md-9 value"><?=$view_data->style_type?></div>
    </div>    

<?php
if($view_data->type=='Schedule'){
?>
<div class="row static-info">
    <div class="col-md-3 name"><b>Date</b></div>
    <div class="col-md-9 value"><?=h_dateFormat($view_data->dates,'d-m-Y');?></div>
</div>
<?php
}
?>

    <div class="row static-info">
        <div class="col-md-3 name"><b>Difficult Score</b></div>
        <div class="col-md-9 value"><?=$view_data->d_score;?></div>
    </div>

    <div class="row static-info">
        <div class="col-md-3 name"><b>Description</b></div>
        <div class="col-md-9 value"><?=$view_data->description;?></div>
    </div>

	<h3>Workout</h3>
<?php
if(isset($options_data)&&!empty($options_data)){
?>

<?php
	foreach($options_data as $set_option){
?>
<div class="col-md-10">
    <div class="row static-info workout-lists">
    <?=!empty($set_option->excercise_id)?'<div class="col-md-2 name"><b>Excercise</b></div>':'';?>
    <?=!empty($set_option->part_id)?'<div class="col-md-2 name"><b>Body Part</b></div>':'';?>
    <?=!empty($set_option->machine_id)?'<div class="col-md-2 name"><b>Machine</b></div>':'';?>
    <?=!empty($set_option->count)?'<div class="col-md-2 name"><b>Round 1</b></div>':'';?>
    <?=!empty($set_option->count2)?'<div class="col-md-2 name"><b>Round 2</b></div>':'';?>
    <?=!empty($set_option->count3)?'<div class="col-md-2 name"><b>Round 3</b></div>':'';?>
    <?=!empty($set_option->height)?'<div class="col-md-2 name"><b>Height</b></div>':'';?>
    <?=!empty($set_option->weight)?'<div class="col-md-2 name"><b>Weight</b></div>':'';?>    
    </div>
    <div class="row static-info workout-lists">
    <?=!empty($set_option->excercise_id)?'<div class="col-md-2 value">'.print_lang_value('excercises',$adminLangSession['lang_id'],array('id'=>$set_option->excercise_id),'excercise_id','title').'</div>':'';?>
    <?=!empty($set_option->part_id)?'<div class="col-md-2 value">'.print_lang_value('parts',$adminLangSession['lang_id'],array('id'=>$set_option->part_id),'part_id','title').'</div>':'';?>
    <?=!empty($set_option->machine_id)?'<div class="col-md-2 value">'.print_lang_value('tags',$adminLangSession['lang_id'],array('id'=>$set_option->machine_id),'tag_id','title').'</div>':'';?>
    <?=!empty($set_option->count)?'<div class="col-md-2 value">'.$set_option->count.'</div>':'';?>
    <?=!empty($set_option->count2)?'<div class="col-md-2 value">'.$set_option->count2.'</div>':'';?>
    <?=!empty($set_option->count3)?'<div class="col-md-2 value">'.$set_option->count3.'</div>':'';?>
    <?=!empty($set_option->height)?'<div class="col-md-2 value">'.$set_option->height.'</div>':'';?>
    <?=!empty($set_option->weight)?'<div class="col-md-2 value">'.$set_option->weight.'</div>':'';?>
    </div>
</div>
<!--<div class="col-md-2">
<button class="btn btn-primary btn-xs ">Automatic</button>
<button class="btn btn-primary btn-xs " onclick="window.location='<?=$_cancel.'/manual_entry/'.$view_data->id?>'" >Manual</button>
</div>-->
<?php
	}
}
?>
</div>



            </div>
        </div>
        <!-- end panel -->
    </div>    
</div>



<link href="assets/plugins/jasny-bootstrap/css/jasny-bootstrap.min.css" rel="stylesheet" type="text/css"/>
<script src="assets/plugins/jasny-bootstrap/js/jasny-bootstrap.min.js" type="text/javascript" language="javascript"></script> 

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


<link href="assets/admin_temp/plugins/bootstrap-eonasdan-datetimepicker/build/css/bootstrap-datetimepicker.min.css" rel="stylesheet" />
<script src="assets/admin_temp/plugins/bootstrap-daterangepicker/moment.js"></script>
<script src="assets/admin_temp/plugins/bootstrap-eonasdan-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript">
$(function () {
	$('.datetimepicker1').datetimepicker({
		format: 'HH:mm'
	});
	$('.datetimepicker2').datetimepicker({
		format: 'HH:mm'
	});
});
</script>

<style>
.workout-lists .value, .workout-lists .name{
	width:14%;
}
</style>
