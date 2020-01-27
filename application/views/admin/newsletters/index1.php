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
                                <a href="admin/merchant/add"class="btn green">
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
                    <th>Email</th>
                    <th>subject</th>
                    <th>message</th>
                    <th>Date</th>
                    <th>Option</th>                            
                </tr>
                </thead>
                <tbody>

<?php
if(count($all_data)){
   foreach($all_data as $set_data){
	   $email = unserialize($set_data->email);
	   $email = implode(', ' ,$email);
?>
                        <tr>
                            <td><?php echo $set_data->id;?></td>
                            <td><?php echo $email;?></td>
                            <td><?php echo $set_data->subject;?></td>
                            <td><?php echo $set_data->message;?></td>
							<td><?php echo date('d-m-Y',$set_data->modified)?></td>
                            <td>
                            	<a href="admin/newsletter/delete/<?php echo $set_data->id;?>"  onclick="return confirm_box();"><?php echo $this->lang->line('delete');?></a>
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
       url: "admin/merchant/get_status", /* The country id will be sent to this file */
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

