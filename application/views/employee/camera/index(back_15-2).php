<style>
.table th{
	vertical-align:top !important;
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
<ul class="nav nav-tabs">
        <li class="active">
            <a href="#tab1" data-toggle="tab">NVR/DVR</a>
        </li>
        <li class="">
            <a href="#tab2" data-toggle="tab">IP Camera</a>
        </li>
        <li class="">
            <a href="#tab3" data-toggle="tab">Custom RTSP Device</a>
        </li>


    </ul>	
    
    
<div class="tab-content tab-content2" style="border:none;padding:10px 0px">        
<div class="tab-pane fade in active " id="tab1">
    <div class="table-responsive">
        <table id="data-table" class="table table-striped table-bordered">
        <thead>
              <tr>
                <th><?=show_static_text($lang_id,150);?></th>								
                <th><?=show_static_text($lang_id,1600);?>Device Name</th>
                <th><?=show_static_text($lang_id,1600);?>Device Model</th>
                <th><?=show_static_text($lang_id,3800);?>Plan</th>
                <th><?=show_static_text($lang_id,1670);?>Options</th>
            </tr>
        </thead>
		<tbody>

<?php
if(count($all_data)){
	$i=0;
	foreach($all_data as $set_data){
		$i++;
?>
<tr>
    <td><?=$i;?></td>
    <td><?=$set_data->name;?></td>
    <td><?=$set_data->model?></td>
    <td><?=print_value('plans',array('id'=>$set_data->plan_id),'name');?><br>(<?=print_value('memberships',array('id'=>$set_data->m_id),'name');?>)</td>
	<td>
		<a class="btn btn-icon-only btn-info" data-toggle="tooltip" data-placement="top"  title="View" href="<?=$_cancel.'/v/'.$set_data->id;?>" >
            <i class="fa fa-eye"></i></a>
    </td>
</tr>

<?php             
   }
}
?>                        

</tbody>							
        </table>
    </div>
</div>

<div class="tab-pane fade in " id="tab2">
    <div class="table-responsive">
        <table id="data-table1" class="table table-striped table-bordered">
        <thead>
              <tr>
                <th><?=show_static_text($lang_id,150);?></th>								
                <th><?=show_static_text($lang_id,1600);?>Device Name</th>
                <th><?=show_static_text($lang_id,1600);?>Device Model</th>
                <th><?=show_static_text($lang_id,3800);?>Plan</th>
                <th><?=show_static_text($lang_id,1670);?>Options</th>
            </tr>
        </thead>
		<tbody>

<?php
if(count($all_data2)){
	$i=0;
	foreach($all_data2 as $set_data){
		$i++;
?>
<tr>
    <td><?=$i;?></td>
    <td><?=$set_data->name;?></td>
    <td><?=$set_data->model?></td>
    <td><?=print_value('plans',array('id'=>$set_data->plan_id),'name');?><br>(<?=print_value('memberships',array('id'=>$set_data->m_id),'name');?>)</td>
	<td>
		<a class="btn btn-icon-only btn-info" data-toggle="tooltip" data-placement="top"  title="View" href="<?=$_cancel.'/v/'.$set_data->id;?>" >
            <i class="fa fa-eye"></i></a>
      </td>
</tr>

<?php             
   }
}
?>                        

</tbody>							
        </table>
    </div>
</div>

<div class="tab-pane fade in " id="tab3">
    <div class="table-responsive">
        <table id="data-table2" class="table table-striped table-bordered">
        <thead>
              <tr>
                <th><?=show_static_text($lang_id,150);?></th>								
                <th><?=show_static_text($lang_id,1600);?>Device Name</th>
                <th><?=show_static_text($lang_id,1600);?>Device Model</th>
                <th><?=show_static_text($lang_id,38000);?>Plan</th>
                <th><?=show_static_text($lang_id,1670);?>Options</th>
            </tr>
        </thead>
		<tbody>

<?php
if(count($all_data3)){
	$i=0;
	foreach($all_data3 as $set_data){
		$i++;
?>
<tr>
    <td><?=$i;?></td>
    <td><?=$set_data->name;?></td>
    <td><?=$set_data->model?></td>
    <td><?=print_value('plans',array('id'=>$set_data->plan_id),'name');?><br>(<?=print_value('memberships',array('id'=>$set_data->m_id),'name');?>)</td>
	<td>
		<a class="btn btn-icon-only btn-info" data-toggle="tooltip" data-placement="top"  title="View" href="<?=$_cancel.'/v/'.$set_data->id;?>" >
            <i class="fa fa-eye"></i></a>
    </td>
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
    </div>
</div>

        <!-- end panel -->
    </div>
</div>

<link href="assets/admin_temp/plugins/DataTables/css/data-table.css" rel="stylesheet" />
<script src="assets/admin_temp/plugins/DataTables/js/jquery.dataTables.js"></script>
<script>
$('#data-table').DataTable({
 	aoColumnDefs: [{
		bSortable: false,
		aTargets: [1]
	}]
});

$('#data-table1').DataTable({
	aoColumnDefs: [
	{
	 bSortable: false,
	 aTargets: [1]
	}]
});

$('#data-table2').DataTable({
	aoColumnDefs: [
	{
	 bSortable: false,
	 aTargets: [1]
	}]
});

</script>


<script>
function confirm_box(){
    var answer = confirm ("<?=show_static_text($lang_id,265);?>");
    if (!answer)
     return false;
}
</script>