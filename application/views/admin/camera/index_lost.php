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
                <th><?=show_static_text($adminLangSession['lang_id'],244);?></th>
                <th>Camera</th>
                <th>User</th>
                <th width="190">Options</th>
            </tr>
            </thead>
            <tbody>

<?php
if(count($all_data)){
	foreach($all_data as $set_data){
?>
    <tr>
        <td><?=$set_data->id;?></td>
        <td><?=$set_data->name?></td>
        <td><?=print_value('users',array('id'=>$set_data->user_id),'username','No User');?></td>
        <td>
<a class="btn btn-icon-only btn-info" href="<?=$_cancel.'/send_mail/'.$set_data->id;?>" data-toggle="tooltip" data-placement="top" title="Send Mail"><i class="fa fa-share"></i></a>
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