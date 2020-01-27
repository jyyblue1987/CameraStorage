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
				<div class="tabbable tabbable-custom boxless tabbable-reversed">
						<ul class="nav nav-tabs">
							<li class="active">
								<a href="#tab_0" data-toggle="tab">Product</a>
							</li>
							<!--<li>
								<a href="#tab_1" data-toggle="tab">Product</a>
							</li>-->
							<li>
								<a href="#tab_2" data-toggle="tab">Histroy</a>
							</li>
						</ul>
						<div class="tab-content">
							<div class="tab-pane active" id="tab_0">
                                <div class="table-toolbar">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="btn-group">
                                                <a href="admin/product/edit"class="btn green">
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
                                    <th>Title</th>
                                    <th>status</th>
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
                                            <td><?php echo $set_data->first_name.' '.$set_data->last_name; ?></td>
                                            <td><?php echo $set_data->email; ?></td>
                                            <td><?php echo $set_data->title; ?>
                                            <?php echo !isset($set_data->image) ? '<img src="assets/uploads/no-image.gif" class="img-rounded" style="width:30px;height:30px">' :'<img src="'.base_url('assets/uploads/products/small').'/'.$set_data->image.'" class="img-rounded" style="width:30px;height:30px" >'; ?></td>
                                            <td>
                                            <select onchange="get_status('users',<?php echo $set_data->id;?>,this.value)" name="martial_id">
                <?php 
                if($set_data->enabled==1){
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
                                            
                                            <td>
                                                <a href="admin/product/edit/<?php echo $set_data->id;?>"><?php echo $this->lang->line('');?>Edit</a>&nbsp;&nbsp;&nbsp;
                                                <a href="admin/product/delete/<?php echo $set_data->id;?>"  onclick="return confirm_box();"><?php echo $this->lang->line('delete');?></a>
                
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
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>

<script>
function get_status(name,id,value){
	//alert(name+' '+id+' '+value);
    $.ajax({
       type: "POST",
       url: "admin/product/get_status", /* The country id will be sent to this file */
       data: "id="+id+"&enabled="+value,
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

function confirm_box(){
    var answer = confirm ("Are you sure?");
    if (!answer)
     return false;
}
</script>