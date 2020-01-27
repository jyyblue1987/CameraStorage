<div class="row">
    <div class="col-md-12">
        <!-- begin panel -->
        <div data-sortable-id="form-stuff-1" class="panel panel-inverse">
            <div class="panel-heading">                
                <h4 class="panel-title"><?=$name?></h4>
            </div>

<div class="panel-body">
    <div class="table-responsive">

<table id="data-table" class="table table-striped table-bordered">
    <thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>email</th>
        <th>review</th>
        <th>Products</th>
        <th>Date</th>
        <th>Option</th>                            
    </tr>
    </thead>
    <tbody>

<?php
if(count($all_data)){
foreach($all_data as $set_data){
$products = $this->comman_model->get_lang('products',$content_language_id,NULL,array('id'=>$set_data->product_id),'product_id',true);
?>
            <tr>
                <td><?=$set_data->id;?></td>
                <td><?=$set_data->name;?></td>
                <td><?=$set_data->email;?></td>
                <td><?=$set_data->comment;?></td>
                <td><?=$products->title;?></td>
                <td><?=date('d-m-Y',$set_data->created);?></td>
<td>
                <select onchange="get_status('users',<?php echo $set_data->id;?>,this.value)" name="martial_id">
<?php 
if($set_data->enabled==1){
echo '<option selected="selected" value="1">Active</option>';
echo '<option value="0">Inactive</option>';
}
else{
echo '<option value="1">Active</option>';
echo '<option selected="selected" value="0">Inactive</option>';
}
?>
                    </select>
                    <a href="admin/review/delete/<?=$set_data->id;?>"  onclick="return confirm_box();">Delete</a>
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
    var answer = confirm ("Are you sure?");
    if (!answer)
     return false;
}


function get_status(name,id,value){
	//alert(name+' '+id+' '+value);
    $.ajax({
       type: "POST",
       url: "admin/review/get_status", /* The country id will be sent to this file */
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