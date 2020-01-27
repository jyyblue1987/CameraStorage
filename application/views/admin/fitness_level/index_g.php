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
                <th>S. No.</th>								
                <th>Username</th>
                <th>Options</th>
            </tr>
        </thead>
		<tbody>

<?php
if($all_data){
	$i=0;
	foreach($all_data as $set_use){
		$i++;
?>
<tr>
    <td><?=$i; ?></td>
    <td><?=$set_use->username?></td>
    <td><a href="<?=$_cancel1.'/gym/'.$set_use->id?>" class="btn btn-primary">View</a></td>
</tr>

<?php             
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

