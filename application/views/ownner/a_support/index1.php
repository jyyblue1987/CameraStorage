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

<div class="row">
	<div class="col-md-12">
        <!-- begin panel -->
        <div data-sortable-id="form-stuff-1" class="panel panel-inverse">
            <div class="panel-heading">                
                <h4 class="panel-title"><?=$name?></h4>
            </div>
            <div class="panel-body">
<div class="portlet-body">
<?php
if(!empty($view_data->company_name)){
?>
    <div class="row static-info">
        <div class="col-md-3 name"><b><?=show_static_text($lang_id,10000);?>Company Name</b></div>
        <div class="col-md-9 value"><?=$view_data->company_name;?></div>
    </div>    
<?php
}
if(!empty($view_data->contact_name)){
?>

    <div class="row static-info">
        <div class="col-md-3 name"><b><?=show_static_text($lang_id,10000);?>Contact Name</b></div>
        <div class="col-md-9 value"><?=$view_data->contact_name;?></div>
    </div>    
<?php
}
if(!empty($view_data->website)){
?>

    <div class="row static-info">
        <div class="col-md-3 name"><b><?=show_static_text($lang_id,10000);?>Website</b></div>
        <div class="col-md-9 value"><?=$view_data->website;?></div>
    </div>    
<?php
}
if(!empty($view_data->email)){
?>

    <div class="row static-info">
        <div class="col-md-3 name"><b><?=show_static_text($lang_id,10000);?>Email Address</b></div>
        <div class="col-md-9 value"><?=$view_data->email;?></div>
    </div>    
<?php
}
if(!empty($view_data->support_num)){
?>

    <div class="row static-info">
        <div class="col-md-3 name"><b><?=show_static_text($lang_id,10000);?>Support Number</b></div>
        <div class="col-md-9 value"><?=$view_data->support_num;?></div>
    </div>    
<?php
}
if(!empty($view_data->support_hour)){
?>
    <div class="row static-info">
        <div class="col-md-3 name"><b><?=show_static_text($lang_id,10000);?>Support Hour</b></div>
        <div class="col-md-9 value"><?=$view_data->support_hour;?></div>
    </div>    
<?php
}
if(!empty($view_data->business_hour)){
?>
    <div class="row static-info">
        <div class="col-md-3 name"><b><?=show_static_text($lang_id,10000);?>Business Hour</b></div>
        <div class="col-md-9 value"><?=$view_data->business_hour;?></div>
    </div>    
<?php
}
if(!empty($view_data->sales_num)){
?>

    <div class="row static-info">
        <div class="col-md-3 name"><b><?=show_static_text($lang_id,10000);?>Sales Number</b></div>
        <div class="col-md-9 value"><?=$view_data->sales_num;?></div>
    </div>    
<?php
}
if(!empty($view_data->notes)){
?>

    <div class="row static-info">
        <div class="col-md-3 name"><b><?=show_static_text($lang_id,10000);?>Additional Notes</b></div>
        <div class="col-md-9 value"><?=$view_data->notes;?></div>
    </div>    
<?php
}
?>

</div>

            </div>
        </div>
        <!-- end panel -->
    </div>   
</div>

