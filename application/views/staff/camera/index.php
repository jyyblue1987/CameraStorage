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
	
    <div class="table-responsive">
        <table id="data-table" class="table table-striped table-hover">
        <thead>
              <tr>
                <th><?=show_static_text($lang_id,150);?></th>								
                <th><?=show_static_text($lang_id,1600);?>Username</th>
                <th><?=show_static_text($lang_id,1600);?>Device Name</th>
                <th><?=show_static_text($lang_id,1600);?>Device Model</th>
                <th><?=show_static_text($lang_id,38);?>Plan</th>
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
    <td><?=$client_data->username;?></td>
    <td><?=$set_data->name;?></td>
    <td><?=print_value('devices',array('id'=>$set_data->model),'name',$set_data->model);?></td>
    <td><?=print_value('plans',array('id'=>$set_data->plan_id),'name');?><br>(<?=print_value('memberships',array('id'=>$set_data->m_id),'name');?>)</td>
	<td>
		<a class="btn btn-icon-only btn-primary" data-toggle="tooltip" data-placement="top"  title="Edit" href="<?=$_cancel.'/edit/'.$set_data->id;?>" >
            <i class="fa fa-edit"></i></a>

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

<script>
function confirm_box(){
    var answer = confirm ("<?=show_static_text($lang_id,265);?>");
    if (!answer)
     return false;
}
</script>
<script>
$('#data-table').DataTable( {
	"bSort": false,
} );

</script>
