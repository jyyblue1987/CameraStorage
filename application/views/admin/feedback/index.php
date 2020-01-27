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
            <a href="<?=$_edit?>" class="btn btn-primary m-r-5 m-b-5">
            Add New  <i class="fa fa-plus"></i>
            </a>
        </div>
</div>
</div>
    <div class="table-responsive">
        <table id="data-table" class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>ID</th>								
                <th>Company Name</th>
                <th>Name</th>                    
                <th>Title</th>
                <th>Description</th>
                <th >Active</th>
                <th >Options</th>
            </tr>
            </thead>
            <tbody>

<?php
if(count($all_data)){
foreach($all_data as $set_data){
    $user_data = $this->comman_model->get_by('users',array('id'=>$set_data->user_id),false,false,true);
    //$view_data = $this->comman_model->get_by('blog_visit',array('blog_id'=>$set_data->id),false,false,false);
?>
                    <tr>
                        <td><?=$set_data->id; ?></td>
                        <td><?=$set_data->company_name; ?>	</td>
                        <td><?=($set_data->user_id==0)?$set_data->user_name:$set_data->first_name.' '.$set_data->last_name; ?></td>
                        <td><?=$set_data->title; ?>	</td>
                        <td><?=$set_data->description; ?></td>                            
                        <td>

                        <select onchange="get_status('status',<?=$set_data->id;?>,this.value)" name="" >
                        <?php 
                        if($set_data->status==1){
                            echo '<option selected="selected" value="1">Active</option>';
                            echo '<option value="0">Inactive</option>';
                        }
                        else{
                            echo '<option value="1">Active</option>';
                            echo '<option selected="selected" value="0">Inactive</option>';
                        }
                        ?>
                            </select>
                        </td>
                        <td>
        <a class="btn btn-icon-only btn-success" href="<?=$_edit?>/<?php echo $set_data->id;?>" title="Edit" data-original-title="Edit" data-placement="top">
                    <i class="fa fa-edit"></i></a>
    <a class="btn btn-icon-only btn-danger" href="<?=$_delete?>/<?php echo $set_data->id;?>"  onclick="return confirm_box();">
            <i class="fa fa-trash-o"></i></a>

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


<div class="row">
    
</div>





<script>
function confirm_box(){
    var answer = confirm ("Are you sure?");
    if (!answer)
     return false;
}

function get_status(type,id,value){
	//alert(name+' '+id+' '+value);
    $.ajax({
       type: "POST",
       url: "admin/feedback/set_value", /* The country id will be sent to this file */
       data: {id:id,type:type,value:value},
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