<?php $this->load->view('admin/includes/address'); ?>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <div class="box-name">
                    <i class="fa fa-usd"></i>
                    <span><?php echo $name;?></span>
                </div>
				<div class="box-icons">
                	<!--<a style="background:none" href="admin/users/add"><button class="btn btn-default" style="float:right">Add User</button></a>-->
                </div>
                <div class="no-move"></div>
            </div>
            <div class="box-content no-padding">
                <table class="table table-bordered table-striped table-hover table-heading table-datatable" id="datatable-1">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Credits</th>
                            <th>Username</th>
                            <th>User's Credits</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Option</th>                            
                        </tr>
                    </thead>
                    <tbody>
                    <!-- Start: list_row -->
<?php
if(count($all_data)){
   foreach($all_data as $set_data){
	   $user_data = $this->comman_model->get_by('user',array('id'=>$set_data->user_id),false,false,true);
?>
                        <tr>
                            <td><?php echo $set_data->id;?></td>
							<th>
<?php
if(!empty($set_data->image))
	echo '<img alt="'.$set_data->title.'" src="assets/uploads/prizes/small/'.$set_data->image.'" class="img-rounded">';
?>                            
							<?php echo $set_data->title;?></td>
                            <td><?php echo $set_data->credits;?></td>
                            <td><?php echo $user_data->username;?></td>
                            <td><?php echo $user_data->credits;?></td>
                            <td><?php echo date('d-m-Y',$set_data->created);?></td>
                            <td><?php echo $set_data->status;?></td>
                            <td>
<?php
if($set_data->status=='Pending'){
?>
                            	<a href="admin/users/get_prize/<?php echo $set_data->id;?>">Get Confirm</a>
<?php
}
?>                            
                            </td>
                        </tr>

<?php             
   }
}
?>                        
                    <!-- End: list_row -->
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Credits</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Option</th>                            
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>


<script>
$(document).ready(function() {
    $('#datatable-1').dataTable();
});
</script>
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
       url: "admin/update_status", /* The country id will be sent to this file */
       data: "table_name="+name+"&id="+id+"&status="+value,
       beforeSend: function () {
      $("#show_class").html("Loading ...");
        },
       success: function(msg){
		 //alert(msg);
         $("#show_class").html(msg);
       }
       });
} 
</script>