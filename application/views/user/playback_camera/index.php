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
<div class="row" style="margin-top:10px;">
    <div class="col-md-6">
        <div class="btn-group">
            <a href="<?=$_cancel.'/c_order'?>" class="btn btn-primary m-r-5 m-b-5"><?=show_static_text($lang_id,20033);?>Set Order <i class="fa fa-sort"></i></a>
        </div>
    </div>
</div>
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
    <td><a href="<?=$_cancel.'/v/'.$set_data->id;?>"><?=$set_data->name;?></a></td>
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

</script>

