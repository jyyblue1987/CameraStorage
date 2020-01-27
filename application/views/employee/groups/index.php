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
	<div class="tab-pane fade in active " id="tab1">
    <div class="table-responsive">
        <table id="data-table" class="table table-striped table-bordered">
        <thead>
              <tr>
                <th><?=show_static_text($lang_id,150);?></th>								
                <th><?=show_static_text($lang_id,1600);?>Name</th>
                <th><?=show_static_text($lang_id,1600);?>Camera</th>
                <th width="190"><?=show_static_text($lang_id,1670);?>Options</th>
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
    <td><?=count(explode(',',$set_data->camera_id))?></td>
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


<script>
function confirm_box(){
    var answer = confirm ("<?=show_static_text($lang_id,265);?>");
    if (!answer)
     return false;
}
</script>