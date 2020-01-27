<script src="assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<?php
$paypalBtn = false;
$userDealer = $this->comman_model->get_by('users',array('id'=>$this->data['user_details']->parent_id,),false,false,true);
if($userDealer&&$userDealer->use_paypal==1){
	$checkUserApi = $this->comman_model->get_by('users_paypal',array('user_id'=>$userDealer->id),false,false,true);
	if($checkUserApi){
		$paypalBtn = true;
	}
}
?>
<style>
.table th{
	vertical-align:top !important;
}
</style>
<!--<div class="alert alert-block alert-danger fade in">All recorded video/audio will be deleted immediately with no recovery option. If the camera was added more than three days ago then no refund will be issued for this camera for the current month to you as a dealer and to your client.</div>-->

<div class="row">
    <div class="col-md-12">
        <!-- begin panel -->
        <div data-sortable-id="form-stuff-1" class="panel panel-inverse">
            <div class="panel-heading">                
                <h4 class="panel-title"><?=$name?></h4>
            </div>

<div class="panel-body">
<ul class="nav nav-tabs">
        <li class="active">
            <a href="#tab1" data-toggle="tab">All <?=$all_c_data>0?'&nbsp;&nbsp;&nbsp;<span class="badge ">'.$all_c_data.'</span>':''?></a>
        </li>
       
        <li class="">
            <a href="#tab3" data-toggle="tab">Custom RTSP Device <?=$all_c_data3>0?'&nbsp;&nbsp;&nbsp;<span class="badge ">'.$all_c_data3.'</span>':''?></a>
        </li>


    </ul>	
    
    
<div class="tab-content tab-content2" style="border:none;padding:10px 0px">
<div class="row" style="margin-top:10px;">
	    <div class="col-md-6">
    		<div class="btn-group">
			    <a href="<?=$_add?>" class="btn btn-primary m-r-5 m-b-5"><?=show_static_text($lang_id,20033);?>Add New Device <i class="fa fa-plus"></i></a>
			    <a href="<?=$_cancel.'/c_order'?>" class="btn btn-primary m-r-5 m-b-5"><?=show_static_text($lang_id,20033);?>Set Order <i class="fa fa-sort"></i></a>
		    </div>
	    </div>

	    </div>        
<div class="tab-pane fade in active " id="tab1">
    <div class="table-responsive">
        <table id="data-table" class="table table-striped table-hover">
        <thead>
              <tr>
                <th><?=show_static_text($lang_id,150);?></th>								
                <th><?=show_static_text($lang_id,1600);?>Device Name</th>
                <th><?=show_static_text($lang_id,1600);?>Device Model</th>
                <th><?=show_static_text($lang_id,3800);?>Plan</th>
                <th><?=show_static_text($lang_id,3800);?>Status</th>
                <th width="240"><?=show_static_text($lang_id,1670);?>Options</th>
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
    <td><?=$set_data->name;?></td>
    <td><?=print_value('devices',array('id'=>$set_data->model),'name',$set_data->model);?></td>
    <td><?=print_value('plans',array('id'=>$set_data->plan_id),'name');?><br>(<?=print_value('memberships',array('id'=>$set_data->m_id),'name');?>)
<?php
if($set_data->is_free_camera==1){
	echo '<br><span class="label label-sm label-primary">Free</span>';
}
?>    
    </td>
    <td>
<?php
//echo $set_data->sys_file.' - '.$set_data->is_connect;
if($set_data->sys_file==0&&$set_data->is_connect==0){
?>
<span class="label label-sm label-warning">Connection Lost</span>
<?php
}
else{
?>
<span class="label label-sm label-primary">Connected</span>
<?php
}
?>        
    </td>
    
	<td>
		<a class="btn btn-primary" data-toggle="tooltip" data-placement="top"  title="View Settings" href="<?=$_cancel.'/view/'.$set_data->id;?>" >
            <i class="fa fa-eye"></i></a>
		<a class="btn btn-info" data-toggle="tooltip" data-placement="top"  title="Edit" href="<?=$_cancel.'/edit/'.$set_data->id;?>" >
            <i class="fa fa-edit"></i></a>

<?php
if($set_data->is_free_camera==1){
?>
		<a class="btn btn-primary" data-toggle="tooltip" data-placement="top"  title="View Camera" href="<?=$_cancel.'/v/'.$set_data->id;?>" >
            <i class="fa fa-video-camera"></i></a>
<?php
}
else if($set_data->payment_id!=0){
	if($set_data->is_expire==0){
?>
		<a class="btn btn-primary" data-toggle="tooltip" data-placement="top"  title="View Camera" href="<?=$_cancel.'/v/'.$set_data->id;?>" >
            <i class="fa fa-video-camera"></i></a>
<?php
	}
}
?>
<?php
$Pbtn =false;
if($set_data->is_free_camera==1){
}
else if($set_data->payment_id!=0){
	if($set_data->is_expire==1){
		$Pbtn= true;
	}
}
else{
	$Pbtn= true;
}
if($Pbtn){
	if($paypalBtn){
?>
<a class="btn btn-warning" data-toggle="tooltip" data-placement="top"  title="payment accept confirmation screen" href="<?=$_user_link.'/c_upgrade/l/'.$set_data->id;?>" ><i class="fa fa-server"></i></a>
<?php
	}
	else{
?>
<a class="btn btn-warning" data-toggle="tooltip" data-placement="top"  title="payment accept confirmation screen" href="<?=$_user_link.'/c_upgrade/m/'.$set_data->id;?>" onclick="return confirm_message();" ><i class="fa fa-server"></i></a>
<?php
	}
}
?>            
		<a class="btn btn-danger" data-toggle="tooltip" data-placement="top"  title="Delete" href="javascript:;" onclick="delete_camera(<?=$set_data->id;?>)"><i class="fa fa-trash"></i></a>
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

<div class="tab-pane fade in " id="tab3">
    <div class="table-responsive">
        <table id="data-table2" class="table table-striped table-hover">
        <thead>
              <tr>
                <th><?=show_static_text($lang_id,150);?></th>								
                <th><?=show_static_text($lang_id,1600);?>Device Name</th>
                <th><?=show_static_text($lang_id,1600);?>Device Model</th>
                <th><?=show_static_text($lang_id,38000);?>Plan</th>
                <th><?=show_static_text($lang_id,3800);?>Status</th>
                <th style="width:250px"><?=show_static_text($lang_id,1670);?>Options</th>
            </tr>
        </thead>
		<tbody>

<?php
if(count($all_data3)){
	$i=0;
	foreach($all_data3 as $set_data){
		$i++;
?>
<tr>
<td><?=$i;?></td>
<td><?=$set_data->name;?></td>
<td><?=print_value('devices',array('id'=>$set_data->model),'name',$set_data->model);?></td>
<td><?=print_value('plans',array('id'=>$set_data->plan_id),'name');?><br>(<?=print_value('memberships',array('id'=>$set_data->m_id),'name');?>)
<?php
if($set_data->is_free_camera==1){
echo '<br><span class="label label-sm label-primary">Free</span>';
}
?>    
</td>
<td>
<?php
if($set_data->sys_file==0&&$set_data->is_connect==0){
?>
<span class="label label-sm label-warning">Connection Lost</span>
<?php
}
else{
?>
<span class="label label-sm label-primary">Connected</span>
<?php
}
?>        
    </td>
        
	<td>
		<a class="btn btn-primary" data-toggle="tooltip" data-placement="top"  title="View Settings" href="<?=$_cancel.'/view/'.$set_data->id;?>" >
            <i class="fa fa-eye"></i></a>

		<a class="btn btn-info" data-toggle="tooltip" data-placement="top"  title="Edit" href="<?=$_cancel.'/edit/'.$set_data->id;?>" >
            <i class="fa fa-edit"></i></a>
            
<?php
if($set_data->is_free_camera==1){
?>
		<a class="btn btn-primary" data-toggle="tooltip" data-placement="top"  title="View Camera" href="<?=$_cancel.'/v/'.$set_data->id;?>" >
            <i class="fa fa-video-camera"></i></a>
<?php
}
else if($set_data->payment_id!=0){
	if($set_data->is_expire==0){
?>
		<a class="btn btn-primary" data-toggle="tooltip" data-placement="top"  title="View Camera" href="<?=$_cancel.'/v/'.$set_data->id;?>" >
            <i class="fa fa-video-camera"></i></a>
<?php
	}
}
?>

<?php
$Pbtn =false;
if($set_data->is_free_camera==1){
}
else if($set_data->payment_id!=0){
	if($set_data->is_expire==1){
		$Pbtn= true;
	}
}
else{
	$Pbtn= true;
}
if($Pbtn){
	if($paypalBtn){
?>
<a class="btn btn-warning" data-toggle="tooltip" data-placement="top"  title="payment accept confirmation screen" href="<?=$_user_link.'/c_upgrade/l/'.$set_data->id;?>" ><i class="fa fa-server"></i></a>
<?php
	}
	else{
?>
<a class="btn btn-warning" data-toggle="tooltip" data-placement="top"  title="payment accept confirmation screen" href="<?=$_user_link.'/c_upgrade/m/'.$set_data->id;?>" onclick="return confirm_message();" ><i class="fa fa-server"></i></a>
<?php
	}
}
?>
		<a class="btn btn-danger" data-toggle="tooltip" data-placement="top"  title="Delete" href="javascript:;" onclick="delete_camera(<?=$set_data->id;?>)"><i class="fa fa-trash"></i></a>
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
    </div>
</div>

        <!-- end panel -->
    </div>
</div>

<link href="assets/admin_temp/plugins/DataTables/css/data-table.css" rel="stylesheet" />
<script src="assets/admin_temp/plugins/DataTables/js/jquery.dataTables.js"></script>
<script>
$('#data-table').DataTable({
	"bSort": false,
});

$('#data-table1').DataTable({
	"bSort": false,
});

$('#data-table2').DataTable({
	"bSort": false,
});

</script>


<script>
function delete_camera(id){
    var answer = confirm ("All recorded video/audio will be deleted immediately with no recovery option. If the camera was added more than three days ago then no refund will be issued for this camera for the reminder of the month. Do you still want to delete this camera?");
    if (answer){
		$.blockUI({ message: '<img src="assets/uploads/loading1.gif" style="width:100px;height:100px;" />' ,
		css: { width: '30%', border:'0px solid #FFFFFF', background:'none',cursor:'wait'},
		  overlayCSS:  { cursor:'wait'} 
		});
		$(window).bind('beforeunload', function(){
		  return 'Are you want to leave?';
		});
		
		$.ajax({
				type: 'GET',
				url : "<?php echo $_cancel.'/ajax_delete'?>",
				data:{id:id},
				dataType:'json',
				success: function(response){
					$.unblockUI();
					$(window).off("beforeunload");
					if(response.status=='ok'){
						location.reload();
					}
					else{
						alert(response.message);
					}
				}
			});		
	}
}

function confirm_message(){
    var answer = confirm ("Please confirm that you are accepting charges.  Please delete your camera if you are not 100% satisfied within 3 days (weekends count) and also notify us immediately.");
    if (!answer)
     return false;
}
</script>