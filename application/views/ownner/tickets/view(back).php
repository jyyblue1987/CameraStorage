<style>
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

<div class="form-horizontal">
	<div class="form-body">
        <div class="form-group">
            <label class="col-lg-2 col-md-2 control-label"><?=show_static_text($lang_id,2360);?>Company Name</label>
            <div class="col-lg-8 col-md-8"><?=$view_data->company_name;?></div>
        </div>
        <div class="form-group">
            <label class="col-lg-2 col-md-2 control-label"><?=show_static_text($lang_id,236);?></label>
            <div class="col-lg-8 col-md-8"><?=$view_data->name;?></div>
        </div>
        <div class="form-group">
            <label class="col-lg-2 col-md-2 control-label"><?=show_static_text($lang_id,2306);?>Description</label>
            <div class="col-lg-8 col-md-8"><?=$view_data->desc;?></div>
        </div>
        <div class="form-group">
            <label class="col-lg-2 col-md-2 control-label"><?=show_static_text($lang_id,2036);?>Help</label>
            <div class="col-lg-8 col-md-8"><?=$view_data->help;?></div>
        </div>
        <div class="form-group">
            <label class="col-lg-2 col-md-2 control-label"><?=show_static_text($lang_id,2306);?>Date</label>
            <div class="col-lg-8 col-md-8"><?=$view_data->date;?></div>
        </div>
        <div class="form-group">
            <label class="col-lg-2 col-md-2 control-label"><?=show_static_text($lang_id,2306);?>Time</label>
            <div class="col-lg-8 col-md-8"><?=$view_data->time;?></div>
        </div>
        <div class="form-group">
            <label class="col-lg-2 col-md-2 control-label"><?=show_static_text($lang_id,2306);?>Urgency</label>
            <div class="col-lg-8 col-md-8"><?=$view_data->urgency;?></div>
        </div>
        <div class="form-group">
            <label class="col-lg-2 col-md-2 control-label"><?=show_static_text($lang_id,2306);?>Response Time</label>
            <div class="col-lg-8 col-md-8"><?=$view_data->solve_time;?> Hrs</div>
        </div>
        <div class="form-group">
            <label class="col-lg-2 col-md-2 control-label"><?=show_static_text($lang_id,2306);?>User Response Time</label>
            <div class="col-lg-8 col-md-8"><?=$view_data->solve_user_time;?> Hrs</div>
        </div>
<?php
if(!empty($products_file)){
?>        <div class="form-group">
            <label class="col-lg-2 col-md-2 control-label">Documents</label>
        </div>
<?php
	foreach($products_file as $set_products_file){

?>        <div class="form-group">
            <label class="col-lg-2 col-md-2 control-label"><?=$set_products_file->filename;?></label>
            <div class="col-lg-8 col-md-8"><a href="<?=$_cancel.'/download/'.md5($set_products_file->id);?>" >Click Here</a></div>
        </div>
<?php
	}
}
?>

        
	</div>							
</div>
<div class="table-responsive">
        <table id="data-table" class="table table-striped table-bordered">
                <thead>
                <tr>
	                <th><?=show_static_text($lang_id,20044);?>Status</th>
	                <th><?=show_static_text($lang_id,1600);?>Description</th>
	               
                </tr>
                </thead>
                <tbody>

<?php
if(count($problems_status)){
	foreach($problems_status as $set_data){
?>
    <tr>
        <td><?=$set_data->status; ?></td>
        <td><?=$set_data->description;?></td>
    </tr>
<?php             
   }
}
?>                        

                </tbody>
	   </table>
    </div>
            </div>
        </div>
        <!-- end panel -->
    </div>
</div>


<style>
.control-label{
	padding:0px !important;
}
</style>