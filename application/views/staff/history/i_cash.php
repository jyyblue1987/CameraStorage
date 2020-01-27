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
                <th><?=show_static_text($lang_id,150);?></th>
                <th><?=show_static_text($lang_id,308);?></th>
                <th><?=show_static_text($lang_id,229);?></th>
            </tr>
        </thead>
		<tbody>

<?php
$total =0;
if(count($all_data)){
	$i=0;
	foreach($all_data as $set_gym){
		$i++;
		$payment =0;
	$query = "SELECT SUM(amount) as price FROM user_membership_history WHERE ownner_id =".$user_details->id." and payment_type='Cash' and status ='confirm' and gym_id = $set_gym->id";
	$result= $this->comman_model->get_query($query,true);
	if($result){
		$payment = round($result->price>0?$result->price:0,2);
		$total = $total+$payment;
	}

?>
                        <tr>
							<td><?=$i; ?></td>
							<td><?=$set_gym->name?></td>
							<td><?=$payment?></td>
                        </tr>

<?php             
   }
}
?>                        

</tbody>							

        <thead>
              <tr>
                <th colspan="2"><?=show_static_text($lang_id,43);?></th>
                <th><?=$total?></th>
            </tr>
        </thead>
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
/*$('#data-table').dataTable( {
      "aoColumnDefs": [
          { 'bSortable': false, 'aTargets': [0]}
       ]
});*/
$('#data-table').dataTable(
{
"bSort" : false
} );
</script>