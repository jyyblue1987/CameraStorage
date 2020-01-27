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
        		<table id="data-table1" class="table table-striped table-hover">
        <thead>
              <tr>
                <th>S. No.</th>								
                <th>Amount</th>
                <th>Payment Type</th>
                <th>Date</th>
            </tr>
        </thead>
		<tbody>

<?php
if(count($all_data)){
	$i = 0;
	foreach($all_data as $set_data){
		$i++;
?>
<tr>
    <td><?=$i; ?></td>
    <td><?=$set_data->amt?></td>
    <td><?=$set_data->payment_type?></td>
    <td><?=date('m/d/Y',$set_data->created)?></td>							
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



<style>
.table th{
	vertical-align:top !important;
}
</style>


<link href="assets/admin_temp/plugins/DataTables/css/data-table.css" rel="stylesheet" />
<script src="assets/admin_temp/plugins/DataTables/js/jquery.dataTables.js"></script>
<script>
$('#data-table1').DataTable( {
	"bSort": false,
} );

</script>
