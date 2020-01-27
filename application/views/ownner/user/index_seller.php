<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet box grey-cascade">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-globe"></i><?php echo $name;?>
                </div>
                <!--<div class="tools">
                    <a href="javascript:;" class="collapse">
                    </a>
                    <a href="#portlet-config" data-toggle="modal" class="config">
                    </a>
                    <a href="javascript:;" class="reload">
                    </a>
                    <a href="javascript:;" class="remove">
                    </a>
                </div>-->
            </div>
            <div class="portlet-body">
                <div class="table-toolbar">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="btn-group">
                                <a href="admin/userlist/send_mail"class="btn green">
                                Send Mail <i class="fa fa-plus"></i>
                                </a>
                            </div>
                            <div class="btn-group">
                                <a href="admin/userlist/edit"class="btn green">
                                Add New <i class="fa fa-plus"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table table-striped table-bordered table-hover" id="sample_6">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Created</th>
                    <th>Confirm</th>
                    <th>Status</th>
                    <th>Option</th>                            
                </tr>
                </thead>
                <tbody>

<?php
if(count($all_data)){
	foreach($all_data as $set_data){
?>
                        <tr>
                            <td><?php echo $set_data->id;?></td>
                            <td><?php echo $set_data->first_name.' '.$set_data->last_name;?></td>
                            <td><?php echo $set_data->email;?></td>
                            <td><?php echo date('d-m-Y',$set_data->created);?></td>
							<td>
<?php
if($set_data->confirm=='confirm'){
	echo 'Confirm';
}
else{
	echo 'Not Confirm';
}
?>
							</td>
                            <td>
                            <select onchange="get_status('users',<?php echo $set_data->id;?>,this.value)" name="martial_id">
<?php 
if($set_data->status==1){
	echo '<option selected="selected" value="1">Active</option>';
	echo '<option value="0">Inactive</option>';
	//echo '<option selected="selected" value="1">'.$this->lang->line('active').'</option>';
	//echo '<option value="0">'.$this->lang->line('inactive').'</option>';
}
else{
	echo '<option value="1">Active</option>';
	echo '<option selected="selected" value="0">Inactive</option>';
	//echo '<option value="1">'.$this->lang->line('active').'</option>';
	//echo '<option selected="selected" value="0">'.$this->lang->line('inactive').'</option>';
}
?>
								</select>
							</td>
							<?php /*?><td>
                            <select onchange="get_verified('user',<?php echo $set_data['id'];?>,this.value)" name="martial_id">
<?php 
if($set_data['user_verified']==1){
	echo '<option selected="selected" value="1">Verified</option>';
	echo '<option value="0">Not Verified</option>';
}
else{
	echo '<option value="1">Verified</option>';
	echo '<option selected="selected" value="0">Not Verified</option>';
}
?>
								</select>
							</td><?php */?>

                            <td>
<?php
if($set_data->admin_confirm==0){
?>
                            	<a href="admin/userlist/get_comfirm/<?php echo $set_data->id;?>">Get Confirm</a>&nbsp;&nbsp;&nbsp;
<?php	
}
?>
                            	<a href="admin/userlist/delete/<?php echo $set_data->id;?>"  onclick="return confirm_box();">Delete</a>

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
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>
<script>
function confirm_box(){
    var answer = confirm ("Are you sure?");
    if (!answer)
     return false;
}

function get_verified(name,id,value){

	//alert(name+' '+id+' '+value);
    $.ajax({
       type: "POST",
       url: "admin/update_verified", /* The country id will be sent to this file */
       data: "table_name="+name+"&id="+id+"&verified="+value,
       beforeSend: function () {
      $("#show_class").html("Loading ...");
        },
       success: function(msg){
		 //alert(msg);
         $("#show_class").html(msg);
       }
       });
}

function get_status(name,id,value){
	//alert(name+' '+id+' '+value);
    $.ajax({
       type: "POST",
       url: "admin/userlist/get_status", /* The country id will be sent to this file */
       data: "id="+id+"&status="+value,
       beforeSend: function () {
	      $("#show_class").html("Loading ...");
        },
       success: function(msg){
		 //alert(msg);
		//location.reload();
    	$("#show_class").html(msg);
       }
       });
} 
</script>