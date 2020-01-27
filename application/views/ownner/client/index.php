<!--<div class="alert alert-block alert-danger fade in">Deleting this client will delete all the client information, camera(s) information and video/audio storage without any recovery option. No refund will be issued for any cameras that have been created for more than three days to you as a dealer and to your client for this month.
</div>-->
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
			    <a href="<?=$_add?>" class="btn btn-primary m-r-5 m-b-5"><?=show_static_text($lang_id,233);?> <i class="fa fa-plus"></i></a>
		    </div>
	    </div>    	
	    </div>

    <div class="table-responsive">
        <table id="data-table" class="table table-striped table-hover">
        <thead>
              <tr>
                <th><?=show_static_text($lang_id,150);?></th>								
                <th><?=show_static_text($lang_id,16);?></th>
                <th><?=show_static_text($lang_id,18);?></th>
                <th><?=show_static_text($lang_id,2806);?>Camera</th>
                <th><?=show_static_text($lang_id,286);?></th>
                <th><?=show_static_text($lang_id,28600);?>Created By</th>
                <th><?=show_static_text($lang_id,2806);?>Free Camera</th>
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
    <td><a href="<?=$_user_link.'/c_camera/l/'.$set_data->id?>"><?=print_count('camera',array('user_id'=>$set_data->id,'payment_id !='=>0));?></a></td>
<td>
<input id="remember" name="remember" type="checkbox" onclick="get_active('status',<?php echo $set_data->id;?>,this.value)" <?=$set_data->status==1?'checked="checked"':''?>   />
</td>
<td><?=$set_data->created_by=='user'?'User':'Dealer'?></td>
<td>
<?php
if($user_details->c_num>0){
	if($set_data->free_camera==0){
?>
<a class="btn btn-sm btn-info " href="<?=$_cancel.'/free_camera_form/'.$set_data->id?>">Free Camera</a>
<?php
	}
	else{
		echo $set_data->free_camera;
	}
}
?>
</td>
	<td>

<a class="btn btn-sm btn-info" data-toggle="tooltip" data-placement="top"  title="Edit" href="<?=$_cancel.'/edit/'.$set_data->id;?>" >
            <i class="fa fa-edit"></i></a>
    <a class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Delete" href="<?=$_delete.'/'.$set_data->id;?>"  onclick="return confirm_box();">
            <i class="fa fa-trash-o"></i></a>
<?php
if($set_data->confirm!='confirm'){
?>
<div style="margin-top:5px">
<a class="btn btn-sm btn-primary " href="<?=$_cancel.'/set_confirm/'.$set_data->id?>">Verify</a>
</div>
<?php
}
?>

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
    var answer = confirm ('Deleting this client will delete all the client information, camera(s) information and video/audio storage without any recovery option. No refund will be issued for any cameras that have been created for more than three days to you as a dealer and to your client for this month. Do you still want to delete this client?');
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
function set_free_camera(id){
	var answer = confirm ("Are you want to sure?");
	if (!answer)
		 return false;
	$('#camera-'+id).prop( "disabled", true );
	$.ajax({
		type:"POST",
		url:"<?=site_url($_cancel.'/set_free_camera')?>",
		data:{id:id,<?=$this->security->get_csrf_token_name();?>:'<?=$this->security->get_csrf_hash();?>'},
		dataType: 'json',
		success: function(json) {	
			$('#camera-'+id).prop( "disabled", false );
			if(json.status=='ok'){
				$('#camera-'+id).remove();
			}
			if(json.status=='error'){
				alert(json.msg);
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
