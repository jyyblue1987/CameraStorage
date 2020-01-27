<div class="row">
    <div class="col-md-12">
        <!-- begin panel -->
        <div data-sortable-id="form-stuff-1" class="panel panel-inverse">
            <div class="panel-heading">                
                <h4 class="panel-title"><?=$name?></h4>
            </div>

<div class="panel-body">
    <!--<div class="row">
	    <div class="col-md-6">
    		<div class="btn-group">
			    <a href="<?=$_add;?>" class="btn btn-primary m-r-5 m-b-5"><?=show_static_text($adminLangSession['lang_id'],233);?> <i class="fa fa-plus"></i></a>
		    </div>
	    </div>
	    </div>-->

    <div class="table-responsive">
        <table id="data-table" class="table table-striped table-bordered">
            <thead>
            <tr>
                <th><?=show_static_text($adminLangSession['lang_id'],244);?></th>
                <th><?=show_static_text($adminLangSession['lang_id'],242);?></th>
<!--                <th><?=show_static_text($adminLangSession['lang_id'],1242);?>Company Name</th>-->
                <th><?=show_static_text($adminLangSession['lang_id'],1530);?>Confirm</th>
                <th><?=show_static_text($adminLangSession['lang_id'],258);?></th>
            </tr>
            </thead>
            <tbody>

<?php
if(count($all_data)){
	foreach($all_data as $set_data){
		$companyName = '-';
/*		if($set_data->parent_id!=0){
			$company_data = $this->comman_model->get_by('users',array('id'=>$set_data->parent_id),false,false,true);
			if($company_data){
				$companyName = $company_data->company_name;
			}
		}*/

?>
                    <tr>
                        <td><?=$set_data->id;?></td>
                        <td><?=$set_data->first_name.' '.$set_data->last_name;?><br><?=$set_data->email;?></td>
<td>
                        <?php
                        if($set_data->confirm=='confirm'){
                        echo 'Confirm';
                        }
                        else{
                        echo 'Not Confirm<br>';
                        ?>
                        <a href="<?=$_cancel.'/set_user/'.$type.'/'.$set_data->id?>">Set As User</a>
                        <?php
                        }
                        ?>
                                                </td>

                        <td>
<a class="btn btn-icon-only btn-info " href="<?=$_cancel.'/send_mail/'.$type.'/'.$set_data->id;?>" title="Send Mail" ><i class="fa fa-share"></i></a>
<a class="btn btn-icon-only btn-danger" href="<?=$_delete.'/'.$type.'/'.$set_data->id;?>"  onclick="return confirm_box();"><i class="fa fa-trash-o"></i></a>

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