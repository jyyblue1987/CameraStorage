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
                                <a href="admin/banner/edit"class="btn green">
                                Add New <i class="fa fa-plus"></i>
                                </a>
                                <!--<a href="admin/banner/order"class="btn green">
                                Order banner<i class="fa fa-plus"></i>
                                </a>-->
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table table-striped table-bordered table-hover" id="sample_6">
                <thead>
                <tr>
                    <th>ID</th>								
                    <th>Location</th>
                    <th>Banner Name</th>
                    <th>Options</th>
                </tr>
                </thead>
                <tbody>

<?php
if(count($all_data)){
	foreach($all_data as $set_data){
?>
                        <tr>
							<td><?php echo $set_data->id; ?></td>
							<td><?php echo $set_data->name; ?></td>
							<td><?php echo $templates_page[$set_data->template]; ?></td>
							<td>
                            	<a href="admin/banner/edit/<?php echo $set_data->id;?>"><?php echo $this->lang->line('');?>Edit</a>&nbsp;&nbsp;&nbsp;
                            	<a href="admin/banner/delete/<?php echo $set_data->id;?>"  onclick="return confirm_box();"><?php echo $this->lang->line('delete');?></a>

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
</script>