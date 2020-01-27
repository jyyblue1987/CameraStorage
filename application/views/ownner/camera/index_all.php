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
                <th><?=show_static_text($lang_id,16);?></th>
                <th><?=show_static_text($lang_id,18);?></th>
                <th><?=show_static_text($lang_id,2806);?>Camera</th>
                <th width="140"><?=show_static_text($lang_id,258);?></th>
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
    <td><?=$set_data->first_name.' '.$set_data->last_name; ?></td>
    <td><?=$set_data->email?></td>
    <td><?=print_count('camera',array('user_id'=>$set_data->id));?></td>
	<td>

<a class="btn btn-icon-only btn-info" data-toggle="tooltip" data-placement="top"  title="View Camera" href="<?=$_cancel.'/l/'.$set_data->id;?>" >
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
$('#data-table').DataTable( {
	"bSort": false,
} );

</script>
