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
        <table id="data-table" class="table table-striped table-bordered">
        <thead>
              <tr>
                <th>Rank</th>								
                <th>Name</th>
                <th>Gym Ownner</th>
                <th>Power Lifts</th>
                <th>Olympic Lift</th>
                <th>Speed</th>
                <th>Endurance</th>
                <th>Bodyweight</th>
                <th>Heavy</th>
                <th>Light</th>
                <th>Long</th>
                <th>Fitnes Level</th>
            </tr>
        </thead>
		<tbody>

<?php
if($all_data){
	$i=0;
	foreach($all_data as $set_use){
		$user_data = $this->comman_model->get_by('users',array('id'=>$set_use->user_id),false,false,true);
		if($user_data){
			$i++;
?>
<tr>
    <td><?=$i; ?></td>
    <td><?=$user_data->username?></td>
    <td><?=$ownner_data->username?></td>
    <td><?=$set_use->p_power_lift?></td>
    <td><?=$set_use->p_olympic_lift?></td>
    <td><?=$set_use->p_speed?></td>
    <td><?=$set_use->p_endurance?></td>
    <td><?=$set_use->p_bodyweight?></td>
    <td><?=$set_use->p_heavy?></td>
    <td><?=$set_use->p_light?></td>
    <td><?=$set_use->p_longs?></td>
    <td><?=$set_use->p_avgs?></td>
</tr>

<?php             
		}
   }
}
?>                        

</tbody>							
        </table>
    </div>
<!--tab1-->        
</div><!--//tab-content//-->
    </div>
</div>

        <!-- end panel -->
    </div>
</div>

<link href="assets/admin_temp/plugins/DataTables/css/data-table.css" rel="stylesheet" />
<script src="assets/admin_temp/plugins/DataTables/js/jquery.dataTables.js"></script>
<script>
$('#data-table').DataTable({
    language: {
		"emptyTable": "You cant see workouts before join classes."
    },
	aoColumnDefs: [{
		bSortable: false,
		aTargets: [1]
	}
]});

$('#data-table1').DataTable({
    language: {
      "emptyTable": "You cant see workouts before join classes."
    },
	aoColumnDefs: [
	{
	 bSortable: false,
	 aTargets: [1]
	}]
});

</script>

