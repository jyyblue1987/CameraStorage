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
                <th>Performance</th>
            </tr>
        </thead>
		<tbody>

<?php
if($all_data){
	$i=0;
	foreach($all_data as $set_data){
		$user_data = $this->comman_model->get_by('users',array('id'=>$set_data->user_id),false,false,true);
		if($user_data){
			$i++;
		$totalData = 0;
		$TotalCount = 0;
		$performance_data =array();
			if($set_data->per_power_lift>0){
				if($set_data->l_per_power_lift>0){
					$TotalCount++;
					$performance_data['b1'] = round(($set_data->l_per_power_lift/$set_data->per_power_lift)*100,0);
					$totalData = $performance_data['b1']+$totalData;
				}
			}
			if($set_data->per_olympic_lift>0){
				if($set_data->l_per_olympic_lift>0){
					$TotalCount++;
					$performance_data['b2'] = round(($set_data->l_per_olympic_lift/$set_data->per_olympic_lift)*100,0);
					$totalData = $performance_data['b2']+$totalData;
				}
			}
			if($set_data->per_speed>0){
				if($set_data->l_per_speed>0){
					$TotalCount++;
					$performance_data['b3'] = round(($set_data->l_per_speed/$set_data->per_speed)*100,0);
					$totalData = $performance_data['b3']+$totalData;
				}
			}
			if($set_data->per_endurance>0){
				if($set_data->l_per_endurance>0){
					$TotalCount++;
					$performance_data['b4'] = round(($set_data->l_per_endurance/$set_data->per_endurance)*100,0);
					$totalData = $performance_data['b4']+$totalData;
				}
			}
			if($set_data->per_bodyweight>0){
				if($set_data->l_per_bodyweight>0){
					$TotalCount++;
					$performance_data['b5'] = round(($set_data->l_per_bodyweight/$set_data->per_bodyweight)*100,0);
					$totalData = $performance_data['b5']+$totalData;
				}
			}
			if($set_data->per_heavy>0){
				if($set_data->l_per_heavy>0){
					$TotalCount++;
					$performance_data['b6'] = round(($set_data->l_per_heavy/$set_data->per_heavy)*100,0);
					$totalData = $performance_data['b6']+$totalData;
				}
			}
			if($set_data->per_light>0){
				if($set_data->l_per_light>0){
					$TotalCount++;
					$performance_data['b7'] = round(($set_data->l_per_light/$set_data->per_light)*100,0);
					$totalData = $performance_data['b7']+$totalData;
				}
			}
			if($set_data->per_longs>0){
				if($set_data->l_per_longs>0){
					$TotalCount++;
					$performance_data['b8'] = round(($set_data->l_per_longs/$set_data->per_longs)*100,0);
					$totalData = $performance_data['b8']+$totalData;
				}
			}
			
			if($TotalCount>0&&$totalData){
				$fitness_per	= round($totalData/$TotalCount);
			}
?>
<tr>
    <td><?=$user_data->username?></td>
    <td><?=print_value('users',array('id'=>$user_data->parent_id),'username')?></td>
    <td><?=($performance_data&&isset($performance_data['b1']))?$performance_data['b1']:0?></td>
    <td><?=($performance_data&&isset($performance_data['b2']))?$performance_data['b2']:0?></td>
    <td><?=($performance_data&&isset($performance_data['b3']))?$performance_data['b3']:0?></td>
    <td><?=($performance_data&&isset($performance_data['b4']))?$performance_data['b4']:0?></td>
    <td><?=($performance_data&&isset($performance_data['b5']))?$performance_data['b5']:0?></td>
    <td><?=($performance_data&&isset($performance_data['b6']))?$performance_data['b6']:0?></td>
    <td><?=($performance_data&&isset($performance_data['b7']))?$performance_data['b7']:0?></td>
    <td><?=($performance_data&&isset($performance_data['b8']))?$performance_data['b8']:0?></td>
    <td><?=$fitness_per?></td>
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
