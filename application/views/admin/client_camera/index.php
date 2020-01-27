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
                <th><?=show_static_text($adminLangSession['lang_id'],242);?></th>
<!--                <th><?=show_static_text($adminLangSession['lang_id'],1242);?>Company Name</th>-->
                <th><?=show_static_text($adminLangSession['lang_id'],1530);?>Client</th>
                <th><?=show_static_text($adminLangSession['lang_id'],1530);?>Camera</th>
                <th width="190"><?=show_static_text($adminLangSession['lang_id'],258);?></th>
            </tr>
            </thead>
            <tbody>

<?php
if(count($all_data)){
	foreach($all_data as $set_data){
	if($set_data->user_type=='paid'){
		$planName	= '<label class="label label-success">'.$set_data->plan_type.'</label>';
	}
	else{
		$planName = '<label class="label label-warning">Free user</label>';
	}
	$ClientCount = $this->comman_model->get_by('users',array('parent_id'=>$set_data->id,'account_type'=>'A'),false,false,false);
	$totalCamera = 0;
	if($ClientCount){
		foreach($ClientCount as $set_client){
			$totalCamera += print_count('camera',array('user_id'=>$set_client->id));
		}
	}
?>
                    <tr>
                        <td><?=$set_data->id;?></td>
                        <td><?=$set_data->first_name.' '.$set_data->last_name;?><br><?=$set_data->email;?>
                        <br>
<?=$planName?>
                        </td>

						<td><?=count($ClientCount)?></td>
						<td><?=$totalCamera?></td>
                        

                        <td>
<a class="btn btn-icon-only btn-info " href="<?=$_cancel.'/c/'.$set_data->id;?>" data-toggle="tooltip" data-placement="top"  title="View" ><i class="fa fa-eye"></i></a>
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