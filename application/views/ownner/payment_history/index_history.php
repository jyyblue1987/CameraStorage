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
                <th><?=show_static_text($lang_id,244);?></th>								
                <th><?=show_static_text($lang_id,242);?></th>
                <th><?=show_static_text($lang_id,112);?></th>
                <th><?=show_static_text($lang_id,41);?></th>
                <th><?=show_static_text($lang_id,6400);?>Days</th>
                <th><?=show_static_text($lang_id,1500);?>Recurring</th>
                <th><?=show_static_text($lang_id,15);?></th>
                <th><?=show_static_text($lang_id,94);?></th>
            </tr>
        </thead>
		<tbody>

<?php
if(count($all_data)){
	$i = 0;
	foreach($all_data as $set_data){
		$i++;
		$userName = '-';
		$userStatus = '-';
		$className = '';
?>
<tr>
    <td><?=$set_data->id; ?></td>
    <td><?=print_value('users',array('id'=>$set_data->user_id),'username')?></td>
    <td><?=$set_data->name?></td>
<!--    <td><?=$className;?></td>-->
    <td><?=$set_data->amount?></td>
    <td><?=array_key_exists($set_data->month,$month_data)?$month_data[$set_data->month]:$set_data->month?></td>
    <td><?=!empty($set_data->profile_id)?$set_data->profile_id:''?></td>
    <td><?=$set_data->payment_type?><?=$set_data->is_refund==1?' <label class="label label-primary">Refund</label>':''?></td>
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
