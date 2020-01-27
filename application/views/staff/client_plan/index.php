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
    <div class="row">
	    <div class="col-md-6">
    		<div class="btn-group">
			    <a href="<?=$_edit?>" class="btn btn-primary m-r-5 m-b-5"><?=show_static_text($lang_id,233);?> <i class="fa fa-plus"></i></a>
		    </div>
	    </div>    	
	    </div>

    <div class="table-responsive">
        <table id="data-table" class="table table-striped table-hover">
        <thead>
              <tr>
                <th><?=show_static_text($lang_id,1500);?>No.</th>								
                <th><?=show_static_text($lang_id,16);?></th>
                <th><?=show_static_text($lang_id,1800);?>Plan</th>
                <th><?=show_static_text($lang_id,1800);?>Plan Price</th>
                <th><?=show_static_text($lang_id,1800);?>Price</th>
                <th><?=show_static_text($lang_id,1800);?>Default</th>
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
    <td><?=print_value('users',array('id'=>$set_data->user_id),'username');?></td>
    <td><?=print_value('memberships',array('id'=>$set_data->plan_id),'name');?></td>
    <td><?=print_value('memberships',array('id'=>$set_data->plan_id),'price');?></td>
    <td><?=$set_data->price?></td>
    <td>
<?=$set_data->is_set==1?'<i class="fa fa-check"></i>':'';?>
    </td>
	<td>
		<a class="btn btn-icon-only btn-info" data-toggle="tooltip" data-placement="top"  title="Edit" href="<?=$_cancel.'/edit/'.$set_data->id;?>" >
            <i class="fa fa-edit"></i></a>    
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
function confirm_box(){
    var answer = confirm ("<?=show_static_text($lang_id,265);?>");
    if (!answer)
     return false;
}
function get_active(name,id,value){
    $.ajax({
       	type: "POST",
       	url: "<?=$_cancel?>/get_active", /* The country id will be sent to this file */
      	data: {id:id,type:name,value:value,<?=$this->security->get_csrf_token_name();?>:'<?=$this->security->get_csrf_hash();?>'},
		dataType: 'json',
       	success: function(json){
			if(json.status=='ok'){
		  	}
		   	else{
				alert(json.msge);
			}
       }
	});
}

</script>

<script>
$('#data-table').DataTable( {
	"bSort": false,
} );

</script>
