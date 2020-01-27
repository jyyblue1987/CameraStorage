<div class="row">
    <div class="col-md-12">
        <!-- begin panel -->
        <div data-sortable-id="form-stuff-1" class="panel panel-inverse">
            <div class="panel-heading">                
				<div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
<!--                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>-->
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                <h4 class="panel-title"><?=$name?></h4>
            </div>

<div class="panel-body">
<!--<div class="row">
    <div class="col-md-6">
        <div class="btn-group">	        
            <a href="admin/userlist/send_mail" class="btn btn-primary m-r-5 m-b-5">
            Send Mail  <i class="fa fa-plus"></i>
            </a>
        </div>
    </div>
</div>-->
    <div class="table-responsive">
        <table id="data-table" class="table table-striped table-bordered">
            
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Option</th>                            
                </tr>
                </thead>
                <tbody>

<?php
if(count($all_data)){
	foreach($all_data as $set_data){
?>
                <tr>
                    <td><?=$set_data->id;?></td>
                    <td><?=$set_data->name;?></td>
                    <td>
                    <a class="btn btn-icon-only blue" href="<?=$_edit.'/'.$set_data->id;?>"  title="Edit">
                            <i class="fa fa-edit"></i></a>
                    <a class="btn btn-icon-only red" href="<?=$_delete.'/'.$set_data->id;?>"  onclick="return confirm_box();" title="Delete">
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


<script>
function confirm_box(){
    var answer = confirm ("Are you sure?");
    if (!answer)
     return false;
}

$(document).ready(function(){
	$('&nbsp;<a href="<?=$_add?>" class="btn btn-success m-r-5 m-b-5">Add New <i class="fa fa-plus"></i></a>').appendTo('div.dataTables_filter');
	//$('div.dataTables_filter').appendTo('<button id="refresh">Refresh</button>');
});

</script>