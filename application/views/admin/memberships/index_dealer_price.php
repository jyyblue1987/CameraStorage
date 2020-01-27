<div class="row">
    <div class="col-md-12">
        <!-- begin panel -->
        <div data-sortable-id="form-stuff-1" class="panel panel-inverse">
            <div class="panel-heading">                
                <h4 class="panel-title"><?=$name?></h4>
            </div>

<div class="panel-body">

<div class="row">	    
    	
	    </div>
            <!--<div class="row">
	    <div class="col-md-6">
    		<div class="btn-group">
			    <a href="admin/userlist/send_mail"class="btn btn-primary m-r-5 m-b-5">Send Mail <i class="fa fa-plus"></i></a>
		    </div>
	    </div>
    </div>-->                
    <div class="table-responsive">
        <table id="data-table" class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>ID</th>								
                    <th>Dealer</th>
                    <th>Default Price</th>
                    <th>Dealer Price</th>
                </tr>
                </thead>
                <tbody>

<?php
if(count($all_data)){
	foreach($all_data as $set_data){
?>
<tr>
    <td><?=$set_data->id; ?></td>
    <td><?=print_value('users',array('id'=>$set_data->owner_id),'username').' > '.print_value('users',array('id'=>$set_data->user_id),'username'); ?></td>
    <td>$<?=$view_data->price; ?></td>
    <td>$<?=$set_data->price; ?></td>
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
</script>