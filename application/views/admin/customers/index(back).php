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
                    <th width="180"><?=show_static_text($adminLangSession['lang_id'],16);?></th>
                    <th width="180"><?=show_static_text($adminLangSession['lang_id'],88);?></th>
                    <th><?=show_static_text($adminLangSession['lang_id'],242);?></th>
                    <th><?=show_static_text($adminLangSession['lang_id'],310);?></th>
                    <th><?=show_static_text($adminLangSession['lang_id'],311);?></th>
                    <th><?=show_static_text($adminLangSession['lang_id'],273);?></th>
                    <th><?=show_static_text($adminLangSession['lang_id'],41);?></th>
                    <th><?=show_static_text($adminLangSession['lang_id'],61);?></th>
                    <th width="200"><?=show_static_text($adminLangSession['lang_id'],258);?></th>
                </tr>
                </thead>
                <tbody>

<?php
if(count($all_data)){
	foreach($all_data as $set_data){
		$userName = '-';
		$userEmail = '-';
		if($set_data->user_id!=0){
			$userData = $this->comman_model->get_by('users',array('id'=>$set_data->user_id),false,false,true);
			if($userData){
				$userName = $userData->first_name.' '.$userData->last_name;
				$userEmail = $userData->email;
			}
		}
		$adminName = '-';
		if($admin_details->id==$set_data->admin_id){
			$adminName = 'Me'; 
		}
		else{
			$adminData = $this->comman_model->get_by('admin',array('id'=>$set_data->admin_id),false,false,true);
			if($adminData){
				$adminName = $adminData->username;
			}
		}
		if(isset($set_data->image)){
			$image = base_url('assets/uploads/stores/small').'/'.$set_data->image; 
		}
		else{
			$image = "assets/uploads/no-image.gif";
		}
		
		if($set_data->{'default'}==1){			
			$totalRoom =$set_data->total_room;
		}
		else{
			$store_manage = $this->comman_model->get_by('stores_manage',array('store_id'=>$set_data->id),false,false,false);
			$totalRoom  = count($store_manage);
		}
	//category
	$CategoryName = '';
	if(!empty($set_data->department_id)){
		$arr = explode(',',$set_data->department_id);
		$this->db->where_in('id',$arr);
		$store_category = $this->comman_model->get_lang('departments',$adminLangSession['lang_id'],NULL,array('enabled'=>1),'department_id',false);
		if($store_category){
			foreach($store_category as $set_scat){
				$CategoryName .= $set_scat->title.', ';
			}
		}
		$CategoryName = rtrim($CategoryName,', ');
	}

?>
                        <tr>
							<td><?=$set_data->id; ?></td>
							<td><img src="<?=$image?>" class="img-rounded" style="width:30px;height:30px"> <?=$set_data->name; ?></td>
							<td><?=$CategoryName;?></td>
							<td><?=$userName; ?><br>(<?=$userEmail; ?>)<br>
<?php
         
if(isset($userData)&&!empty($userData)){
	if($userData->confirm=='confirm'){}
	else{
		echo 'Not Confirm<br>';
?>
	<a href="<?=$_cancel?>/get_confirm/<?=$userData->id?>">Set As User</a>
<?php
}
}
?>
                            </td>
							<td><?=$totalRoom; ?></td>
							<td><?=0; ?></td>
							<td><?=$totalRoom; ?></td>
							<td><?=0; ?></td>
                            <td><input id="remember" name="remember" type="checkbox" onclick="get_status('feature',<?php echo $set_data->id;?>,this.value)" <?=$set_data->is_feature==1?'checked="checked"':''?>   /></td>

							<td>


<a class="btn btn-icon-only btn-warning " href="<?=$admin_link?>/remark/calander/<?=$set_data->id?>" ><i class="fa fa-calendar"></i></a>
<a class="btn btn-icon-only btn-primary" href="<?=$admin_link?>/store_manage/manage/<?=$set_data->id;?>" ><i class="fa fa-list"></i></a>
<a class="btn btn-icon-only btn-warning " href="<?=$admin_link?>/store_excel/excel/<?=$set_data->id?>" ><i class="fa fa-file-excel-o"></i></a>
<a class="btn btn-icon-only btn-success " href="<?=$_edit?>/<?=$set_data->id;?>" ><i class="fa fa-edit"></i></a>
<a class="btn btn-icon-only btn-info " href="<?=$_cancel.'/send_mail/'.$set_data->id;?>" title="Send Mail" ><i class="fa fa-share"></i></a>
<a class="btn btn-icon-only btn-danger" href="<?=$_delete?>/<?=$set_data->id;?>"  onclick="return confirm_box();" ><i class="fa fa-trash-o"></i></a>

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
    var answer = confirm ("<?=show_static_text($adminLangSession['lang_id'],265);?>");
    if (!answer)
     return false;
}
function get_status(type,id,value){
	//alert(name+' '+id+' '+value);
    $.ajax({
       type: "POST",
       url: "<?=$_cancel?>/set_value", /* The country id will be sent to this file */
       data: {id:id,type:type,value:value,<?=$this->security->get_csrf_token_name();?>:'<?=$this->security->get_csrf_hash();?>'},
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
<style>
table td{
	padding:10px 3px !important;
}
</style>