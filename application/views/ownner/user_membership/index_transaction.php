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
        		<table id="data-table1" class="table table-striped table-bordered">
        <thead>
              <tr>
                <th><?=show_static_text($lang_id,150);?></th>
                <th><?=show_static_text($lang_id,236);?></th>
                <th><?=show_static_text($lang_id,229);?></th>
                <th><?=show_static_text($lang_id,153);?></th>
            </tr>
        </thead>
		<tbody>

<?php
if(count($all_data)){
	$i = 0;
	foreach($all_data as $set_data){
		$i++;
		$showTitle = '-';
		$username = print_value('users',array('id'=>$set_data->user_id),'username');		
		if($set_data->type=='add_coach'){
			$showTitle = $username.' (coach) has created.';
		}
		if($set_data->type=='add_athlete'){
			$showTitle = $username.' (athlete) has created.';
		}
		if($set_data->type=='add_staff'){
			$showTitle = $username.' (staff) has created.';
		}
		if($set_data->type=='athlete_membership'){
			$showTitle = $username.' has got membership.';
		}
		

?>

<tr>
    <td><?=$i; ?></td>
    <td><?=$showTitle?></td>
    <td><?=$set_data->amount?></td>
    <td><?=h_dateFormat($set_data->on_date,'d-m-Y')?></td>
    							
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

$('#data-table1').DataTable({
	aoColumnDefs: [
	{
	 bSortable: false,
	 aTargets: [1]
	}]
});

</script>
