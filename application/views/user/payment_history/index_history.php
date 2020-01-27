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
                <th><?=show_static_text($lang_id,244);?></th>								
                <th><?=show_static_text($lang_id,2402);?>Name</th>
                <th><?=show_static_text($lang_id,41);?></th>
                <th><?=show_static_text($lang_id,6400);?>Days</th>
                <th><?=show_static_text($lang_id,94);?></th>
                <th><?=show_static_text($lang_id,15);?></th>
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
    <td><?=print_value('camera',array('id'=>$set_data->product_id),'name')?></td>
    <td><?=$set_data->amount?></td>
    <td><?=array_key_exists($set_data->month,$month_data)?$month_data[$set_data->month]:$set_data->month?></td>
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

$('#data-table1').DataTable({
	aoColumnDefs: [
	{
	 bSortable: false,
	 aTargets: [1]
	}]
});

</script>


