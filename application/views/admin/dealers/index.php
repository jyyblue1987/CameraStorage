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
			    <a href="<?=$_add;?>" class="btn btn-primary m-r-5 m-b-5"><?=show_static_text($adminLangSession['lang_id'],233);?> <i class="fa fa-plus"></i></a>
		    </div>
	    </div>
	    </div>

    <div class="table-responsive">
        <table id="data-table" class="table table-striped table-bordered">
            <thead>
            <tr>
                <th><?=show_static_text($adminLangSession['lang_id'],244);?></th>
                <th><?=show_static_text($adminLangSession['lang_id'],242);?></th>
                <th>Due Amount (<?=date('M', strtotime('last month'))?>) / (<?=date('M')?>)</th>
<!--                <th><?=show_static_text($adminLangSession['lang_id'],1242);?>Company Name</th>-->
                <th><?=show_static_text($adminLangSession['lang_id'],1530);?>Free Camera</th>
                <th><?=show_static_text($adminLangSession['lang_id'],1530);?>Confirm</th>
                <th><?=show_static_text($adminLangSession['lang_id'],158);?></th>
                <th width="190"><?=show_static_text($adminLangSession['lang_id'],258);?></th>
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

	if($set_data->user_type=='paid'){
		$planName	= '<label class="label label-success">'.$set_data->plan_type.'</label>';
	}
	else{
		$planName = '<label class="label label-warning">Free user</label>';
	}
	$ahtleteCount = count($this->comman_model->get_by('users',array('parent_id'=>$set_data->id,'account_type'=>'A'),false,false,false));
	$coachCount = count($this->comman_model->get_by('users',array('parent_id'=>$set_data->id,'account_type'=>'C'),false,false,false));
	$staffCount = count($this->comman_model->get_by('users',array('parent_id'=>$set_data->id,'account_type'=>'E'),false,false,false));
?>
<tr>
    <td><?=$set_data->id;?></td>
    <td><?=$set_data->first_name.' '.$set_data->last_name;?><br><?=$set_data->email;?><br><?=$planName?>
    </td>
    <td>$<?=$set_data->debt_point?> / $<?=abs($set_data->total_point);?></td>
    <td>
<?php
if($set_data->c_num==0){
echo 'None';
}
else{
echo $set_data->c_num.' camera';
/*	if($set_data->c_days==-1){
echo $set_data->c_num.' camera (For Life)' ;
}
else{
echo $set_data->c_num.' camera ('.$set_data->c_days.' days)';
}*/
}
?>
    </td>

<td>
    <?php
    if($set_data->confirm=='confirm'){
    echo 'Confirm';
    }
    else{
    echo 'Not Confirm<br>';
    ?>
    <a href="<?=$_cancel?>/set_user/<?=$set_data->id?>">Set As User</a>
    <?php
    }
    ?>
                            </td>
    <td>
    <select onchange="get_status('users',<?=$set_data->id;?>,this.value)" name="martial_id">
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

<a class="btn btn-sm btn-info " href="<?=$_cancel.'/update_balance/'.$set_data->id;?>" >Update Balance</a>

<a class="btn btn-sm btn-info " href="<?=$_cancel.'/edit/'.$set_data->id;?>" data-toggle="tooltip" data-placement="top"  title="Edit" ><i class="fa fa-edit"></i></a>
<a class="btn btn-sm btn-info" href="<?=$_cancel.'/send_mail/'.$set_data->id;?>" data-toggle="tooltip" data-placement="top" title="Send Mail"><i class="fa fa-share"></i></a>
<a class="btn btn-sm btn-danger" href="<?=$_delete?>/<?=$set_data->id;?>" data-toggle="tooltip" data-placement="top"  title="Delete"   onclick="return confirm_box();"><i class="fa fa-trash-o"></i></a>

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
       type: "GET",
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