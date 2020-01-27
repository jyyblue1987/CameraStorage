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
			    <a href="<?=$_cancel.'/c/'.$user_data->parent_id;?>" class="btn btn-primary m-r-5 m-b-5">Back</a>
		    </div>
	    </div>
    </div>

    <div class="table-responsive">
        <table id="data-table" class="table table-striped table-bordered">
            <thead>
            <tr>
                <th><?=show_static_text($adminLangSession['lang_id'],244);?></th>
                <th><?=show_static_text($adminLangSession['lang_id'],242);?></th>
                <th><?=show_static_text($adminLangSession['lang_id'],1530);?>Camera</th>
                <th><?=show_static_text($adminLangSession['lang_id'],1530);?>Path</th>
                <th><?=show_static_text($adminLangSession['lang_id'],1530);?>Options</th>
            </tr>
            </thead>
            <tbody>

<?php
if(count($all_data)){
	foreach($all_data as $set_data){
?>
                    <tr>
                        <td><?=$set_data->id;?></td>
                        <td><?=$user_data->username;?></td>
                        <td><?=$set_data->name;?></td>
                        <td><?='var/www/html/data/'.$set_data->camera_path.'/camera '.$set_data->id;?></td>
        <td>
<a class="btn btn-icon-only btn-info" href="<?=$_cancel.'/view/'.$set_data->id;?>" data-toggle="tooltip" data-placement="top" title="View"><i class="fa fa-eye"></i></a>
<a class="btn btn-icon-only btn-primary" href="<?=$_cancel.'/v/'.$set_data->id;?>" data-toggle="tooltip" data-placement="top" title="View Camera"><i class="fa fa-video-camera"></i></a>
        </td>
<!--						<td><?='var/www/html/data/'.$set_data->camera_path.'/camera '.$set_data->id?></td>-->
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
       url: "<?=$_cancel?>/get_status", /* The country id will be sent to this file */
       data: {id:id,status:value,<?=$this->security->get_csrf_token_name();?>:'<?=$this->security->get_csrf_hash();?>'},
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