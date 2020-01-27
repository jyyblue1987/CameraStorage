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
                                <a href="admin/admin/add"class="btn green">
                                Add New <i class="fa fa-plus"></i>
                                </a>
                            </div>
                        </div>
                        <!--<div class="col-md-6">
                            <div class="btn-group pull-right">
                                <button class="btn dropdown-toggle" data-toggle="dropdown">Tools <i class="fa fa-angle-down"></i>
                                </button>
                                <ul class="dropdown-menu pull-right">
                                    <li>
                                        <a href="#">
                                        Print </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                        Save as PDF </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                        Export to Excel </a>
                                    </li>
                                </ul>
                            </div>
                        </div>-->
                    </div>
                </div>
                <table class="table table-striped table-bordered table-hover" id="sample_6">
                <thead>
                <tr>
                    <th>ID</th>								
                    <th>Administrators</th>
                    <th>Created</th>
                    <th>Status</th>
                    <th>Options</th>
                </tr>
                </thead>
                <tbody>

<?php
if(count($all_data)){
foreach($all_data as $set_data){
?>
<tr>
<td><?php echo $set_data->AdminID; ?></td>
<td><?php echo $set_data->AdminEmail; ?></td>
<td><?php echo date("F j, Y", strtotime($set_data->DateAdded));?></td>
<td>
<?php 
    if($set_data->IsEnable==1){
        echo '<span class="label label-sm label-success">Active</span>';
    }
    else{
        echo '<span class="label label-sm label-warning">Inactive</span>';
    }
?>
</td>

<td>
    <a href="admin/category/edit/<?php echo $set_data->AdminID;?>"><?php echo $this->lang->line('');?>Edit</a>&nbsp;&nbsp;&nbsp;
    <a href="admin/category/delete/<?php echo $set_data->AdminID;?>"  onclick="return confirm_box();"><?php echo $this->lang->line('delete');?></a>

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
			location.reload();
        	$("#show_class").html(msg);
       }
       });
} 
</script>