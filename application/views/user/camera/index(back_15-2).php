<style>
.table th{
	vertical-align:top !important;
}
</style>
<!--<div class="alert alert-block alert-danger fade in">All recorded video/audio will be deleted immediately with no recovery option. If the camera was added more than three days ago then no refund will be issued for this camera for the current month to you as a dealer and to your client.</div>-->

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
            <a href="#tab1" data-toggle="tab">NVR/DVR <?=$all_c_data>0?'&nbsp;&nbsp;&nbsp;<span class="badge ">'.$all_c_data.'</span>':''?></a>
        </li>
        <li class="">
            <a href="#tab2" data-toggle="tab">IP Camera <?=$all_c_data2>0?'&nbsp;&nbsp;&nbsp;<span class="badge ">'.$all_c_data2.'</span>':''?></a>
        </li>
        <li class="">
            <a href="#tab3" data-toggle="tab">Custom RTSP Device <?=$all_c_data3>0?'&nbsp;&nbsp;&nbsp;<span class="badge ">'.$all_c_data3.'</span>':''?></a>
        </li>


    </ul>	
    
    
<div class="tab-content tab-content2" style="border:none;padding:10px 0px">
<div class="row" style="margin-top:10px;">
	    <div class="col-md-6">
    		<div class="btn-group">
			    <a href="<?=$_add?>" class="btn btn-primary m-r-5 m-b-5"><?=show_static_text($lang_id,20033);?>Add New Device <i class="fa fa-plus"></i></a>
			    <a href="<?=$_cancel.'/c_order'?>" class="btn btn-primary m-r-5 m-b-5"><?=show_static_text($lang_id,20033);?>Set Order <i class="fa fa-sort"></i></a>
		    </div>
	    </div>

	    </div>        
<div class="tab-pane fade in active " id="tab1">
    <div class="table-responsive">
        <table id="data-table" class="table table-striped table-bordered">
        <thead>
              <tr>
                <th><?=show_static_text($lang_id,150);?></th>								
                <th><?=show_static_text($lang_id,1600);?>Device Name</th>
                <th><?=show_static_text($lang_id,1600);?>Device Model</th>
                <th><?=show_static_text($lang_id,3800);?>Plan</th>
                <th width="240"><?=show_static_text($lang_id,1670);?>Options</th>
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
		<a class="btn btn-icon-only btn-primary" data-toggle="tooltip" data-placement="top"  title="View Settings" href="<?=$_cancel.'/view/'.$set_data->id;?>" >
            <i class="fa fa-eye"></i></a>
		<a class="btn btn-icon-only btn-primary" data-toggle="tooltip" data-placement="top"  title="Edit" href="<?=$_cancel.'/edit/'.$set_data->id;?>" >
            <i class="fa fa-edit"></i></a>

		<a class="btn btn-icon-only btn-info" data-toggle="tooltip" data-placement="top"  title="View Camera" href="<?=$_cancel.'/v/'.$set_data->id;?>" >
            <i class="fa fa-eye"></i></a>
<?php
$Pbtn =false;
if($set_data->payment_id!=0){
	if($set_data->is_expire==1){
		$Pbtn= true;
	}
}
else{
	$Pbtn= true;
}
if($Pbtn){
?>
		<a class="btn btn-icon-only btn-warning" data-toggle="tooltip" data-placement="top"  title="Upgrade" href="<?=$_user_link.'/c_upgrade/l/'.$set_data->id;?>" >
            <i class="fa fa-server"></i></a>
<?php
}
?>            
		<a class="btn btn-icon-only btn-danger" data-toggle="tooltip" data-placement="top"  title="Delete" href="<?=$_cancel.'/delete/'.$set_data->id;?>" onclick="return confirm_box();" ><i class="fa fa-trash"></i></a>

<?php
if($set_data->sys_file==0&&$set_data->is_connect==0){
?>
<br>
<span class="label label-sm label-warning">Connection Lost</span>
<?php
}
?>        
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
                <th width="250"><?=show_static_text($lang_id,1670);?>Options</th>
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

		<a class="btn btn-icon-only btn-primary" data-toggle="tooltip" data-placement="top"  title="View Settings" href="<?=$_cancel.'/view/'.$set_data->id;?>" >
            <i class="fa fa-eye"></i></a>

		<a class="btn btn-icon-only btn-primary" data-toggle="tooltip" data-placement="top"  title="Edit" href="<?=$_cancel.'/edit/'.$set_data->id;?>" >
            <i class="fa fa-edit"></i></a>
  
  		<a class="btn btn-icon-only btn-info" data-toggle="tooltip" data-placement="top"  title="View Camera" href="<?=$_cancel.'/v/'.$set_data->id;?>" >
            <i class="fa fa-eye"></i></a>
<?php
$Pbtn =false;
if($set_data->payment_id!=0){
	if($set_data->is_expire==1){
		$Pbtn= true;
	}
}
else{
	$Pbtn= true;
}
if($Pbtn){
?>
		<a class="btn btn-icon-only btn-warning" data-toggle="tooltip" data-placement="top"  title="Upgrade" href="<?=$_user_link.'/c_upgrade/l/'.$set_data->id;?>" >
            <i class="fa fa-server"></i></a>
<?php
}
?>            
		<a class="btn btn-icon-only btn-danger" data-toggle="tooltip" data-placement="top"  title="Delete" href="<?=$_cancel.'/delete/'.$set_data->id;?>"  onclick="return confirm_box();"><i class="fa fa-trash"></i></a>
<?php
if($set_data->sys_file==0&&$set_data->is_connect==0){
?>
<br>
<span class="label label-sm label-warning">Connection Lost</span>
<?php
}
?>        

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
                <th style="width:250px"><?=show_static_text($lang_id,1670);?>Options</th>
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
		<a class="btn btn-icon-only btn-primary" data-toggle="tooltip" data-placement="top"  title="View Settings" href="<?=$_cancel.'/view/'.$set_data->id;?>" >
            <i class="fa fa-eye"></i></a>

		<a class="btn btn-icon-only btn-primary" data-toggle="tooltip" data-placement="top"  title="Edit" href="<?=$_cancel.'/edit/'.$set_data->id;?>" >
            <i class="fa fa-edit"></i></a>
            
		<a class="btn btn-icon-only btn-info" data-toggle="tooltip" data-placement="top"  title="View Camera" href="<?=$_cancel.'/v/'.$set_data->id;?>" >
            <i class="fa fa-eye"></i></a>
<?php
$Pbtn =false;
if($set_data->payment_id!=0){
	if($set_data->is_expire==1){
		$Pbtn= true;
	}
}
else{
	$Pbtn= true;
}
if($Pbtn){
?>
		<a class="btn btn-icon-only btn-warning" data-toggle="tooltip" data-placement="top"  title="Upgrade" href="<?=$_user_link.'/c_upgrade/l/'.$set_data->id;?>" >
            <i class="fa fa-server"></i></a>
<?php
}
?>            
		<a class="btn btn-icon-only btn-danger" data-toggle="tooltip" data-placement="top"  title="Delete" href="<?=$_cancel.'/delete/'.$set_data->id;?>" onclick="return confirm_box();"><i class="fa fa-trash"></i></a>
<?php
if($set_data->sys_file==0&&$set_data->is_connect==0){
?>
<br>
<span class="label label-sm label-warning">Connection Lost</span>
<?php
}
?>        

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
    var answer = confirm ("All recorded video/audio will be deleted immediately with no recovery option. If the camera was added more than three days ago then no refund will be issued for this camera for the reminder of the month. Do you still want to delete this camera?");
    if (!answer)
     return false;
}
</script>