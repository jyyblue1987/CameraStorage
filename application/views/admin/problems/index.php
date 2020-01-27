<div class="row">
    <div class="col-md-12">
        <!-- begin panel -->
        <div  class="panel panel-inverse">
            <div class="panel-heading">                                
                <h4 class="panel-title">Open tickets</h4>
            </div>

<div class="panel-body">
    <div class="table-responsive" style="padding-top:10px">
        <table id="data-table" class="table table-striped table-bordered">
                <thead>
                <tr>
	                <th><?=show_static_text($adminLangSession['lang_id'],244);?></th>
	                <th><?=show_static_text($adminLangSession['lang_id'],1600);?>Username</th>
	                <th><?=show_static_text($adminLangSession['lang_id'],1580);?>Ticket</th>
	                <th><?=show_static_text($adminLangSession['lang_id'],1006);?>Description</th>
	                <th><?=show_static_text($adminLangSession['lang_id'],1007);?>Ticket Created</th>
	                <th><?=show_static_text($adminLangSession['lang_id'],1007);?>Status</th>
	                <th width="180"><?=show_static_text($adminLangSession['lang_id'],258);?></th>
                </tr>
                </thead>
                <tbody>

<?php
if(count($all_data)){
	foreach($all_data as $set_data){
		$statusName ='-';
		$statusClass = '';
		$userName ='-';
		if($set_data->user_id!=0){
			$userData = $this->comman_model->get_by('users',array('id'=>$set_data->user_id),false,false,true);
			if($userData){
				$userName = $userData->first_name.' '.$userData->last_name;
			}
		}		
		if(!empty($set_data->status)){
			if($set_data->status=='Completed'){
				$statusClass = 'label label-sm label-success';
			}
			else{
				$statusClass = 'label label-sm label-danger';
			}
			$statusName = $set_data->status;
		}

		/*$this->db->order_by('id','desc');
		$cheekStatus = $this->comman_model->get_by('problems_status',array('problem_id'=>$set_data->id),false,false,true);
		if($cheekStatus){
			if($cheekStatus->status=='Complete'){
				$statusClass = 'label label-sm label-success';
			}
			else{
				$statusClass = 'label label-sm label-danger';
			}
			$statusName = $cheekStatus->status;
		}*/
?>
    <tr>
        <td><?php echo $set_data->id; ?></td>
        <td><?=$userName;?></td>
        <td><?=$set_data->name;?></td>
        <td><?php //echo $set_data->name; ?>
<?php
$html = strip_tags($set_data->desc);
$html = html_entity_decode($html, ENT_QUOTES, 'UTF-8');    
echo (strlen($html)>=100)?substr($html, 0 ,100).'...':$html;
?>
        
        </td>
       <td><?=date('m/d/Y',$set_data->created);?></td>
       <td><span class="<?=$statusClass?>"><?=$statusName;?></span></td>
        <td>
<!--<a class="btn btn-icon-only btn-info" href="<?=$_edit?>/<?php echo $set_data->id;?>" >
        <i class="fa fa-edit"></i></a>-->
<a class="btn btn-icon-only btn-success" href="<?=$_view?>/<?php echo $set_data->id;?>" >
        <i class="fa fa-eye"></i></a>
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
        <div  class="panel panel-inverse">
            <div class="panel-heading">                                
                <h4 class="panel-title">In process tickets</h4>
            </div>

<div class="panel-body">
    <div class="table-responsive" style="padding-top:10px">
        <table id="data-table2" class="table table-striped table-bordered">
                <thead>
                <tr>
	                <th><?=show_static_text($adminLangSession['lang_id'],244);?></th>
	                <th><?=show_static_text($adminLangSession['lang_id'],1600);?>Username</th>
	                <th><?=show_static_text($adminLangSession['lang_id'],1580);?>Ticket</th>
	                <th><?=show_static_text($adminLangSession['lang_id'],1006);?>Description</th>
	                <th><?=show_static_text($adminLangSession['lang_id'],1007);?>Ticket Created</th>
	                <th><?=show_static_text($adminLangSession['lang_id'],1007);?>Status</th>
	                <th width="180"><?=show_static_text($adminLangSession['lang_id'],258);?></th>
                </tr>
                </thead>
                <tbody>

<?php
if(count($all_data2)){
	foreach($all_data2 as $set_data){
		$statusName ='-';
		$statusClass = '';
		$userName ='-';
		if($set_data->user_id!=0){
			$userData = $this->comman_model->get_by('users',array('id'=>$set_data->user_id),false,false,true);
			if($userData){
				$userName = $userData->first_name.' '.$userData->last_name;
			}
		}		
		if(!empty($set_data->status)){
			if($set_data->status=='Completed'){
				$statusClass = 'label label-sm label-success';
			}
			else{
				$statusClass = 'label label-sm label-danger';
			}
			$statusName = $set_data->status;
		}
?>
    <tr>
        <td><?php echo $set_data->id; ?></td>
        <td><?=$userName;?></td>
        <td><?=$set_data->name;?></td>
        <td><?php //echo $set_data->name; ?>
<?php
$html = strip_tags($set_data->desc);
$html = html_entity_decode($html, ENT_QUOTES, 'UTF-8');    
echo (strlen($html)>=100)?substr($html, 0 ,100).'...':$html;
?>
        
        </td>
       <td><?=date('m/d/Y',$set_data->created);?></td>
       <td><span class="<?=$statusClass?>"><?=$statusName;?></span></td>
        <td>
<!--<a class="btn btn-icon-only btn-info" href="<?=$_edit?>/<?php echo $set_data->id;?>" >
        <i class="fa fa-edit"></i></a>-->
<a class="btn btn-icon-only btn-success" href="<?=$_view?>/<?php echo $set_data->id;?>" >
        <i class="fa fa-eye"></i></a>
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
        <div  class="panel panel-inverse">
            <div class="panel-heading">                                
                <h4 class="panel-title">Closed tickets</h4>
            </div>

<div class="panel-body">
    <div class="table-responsive" style="padding-top:10px">
        <table id="data-table3" class="table table-striped table-bordered">
                <thead>
                <tr>
	                <th><?=show_static_text($adminLangSession['lang_id'],244);?></th>
	                <th><?=show_static_text($adminLangSession['lang_id'],1600);?>Username</th>
<!--	                <th><?=show_static_text($adminLangSession['lang_id'],1600);?>Company Name</th>-->
	                <th><?=show_static_text($adminLangSession['lang_id'],1580);?>Ticket</th>
	                <th><?=show_static_text($adminLangSession['lang_id'],1006);?>Description</th>
	                <th><?=show_static_text($adminLangSession['lang_id'],1007);?>Ticket Created</th>
	                <th><?=show_static_text($adminLangSession['lang_id'],1007);?>Status</th>
	                <th width="180"><?=show_static_text($adminLangSession['lang_id'],258);?></th>
                </tr>
                </thead>
                <tbody>

<?php
if(count($all_data3)){
	foreach($all_data3 as $set_data){
		$statusName ='-';
		$statusClass = '';
		$userName ='-';
		if($set_data->user_id!=0){
			$userData = $this->comman_model->get_by('users',array('id'=>$set_data->user_id),false,false,true);
			if($userData){
				$userName = $userData->first_name.' '.$userData->last_name;
			}
		}		
		if(!empty($set_data->status)){
			if($set_data->status=='Completed'){
				$statusClass = 'label label-sm label-success';
			}
			else{
				$statusClass = 'label label-sm label-danger';
			}
			$statusName = $set_data->status;
		}
?>
    <tr>
        <td><?=$set_data->id; ?></td>
        <td><?=$userName;?></td>
        <td><?=$set_data->name;?></td>
        <td><?php //echo $set_data->name; ?>
<?php
$html = strip_tags($set_data->desc);
$html = html_entity_decode($html, ENT_QUOTES, 'UTF-8');    
echo (strlen($html)>=100)?substr($html, 0 ,100).'...':$html;
?>
        
        </td>
       <td><?=date('m/d/Y',$set_data->created);?></td>
       <td><span class="<?=$statusClass?>"><?=$statusName;?></span></td>
        <td>
<a class="btn btn-icon-only btn-success" href="<?=$_view?>/<?php echo $set_data->id;?>" >
        <i class="fa fa-eye"></i></a>
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

<link href="assets/admin_temp/plugins/DataTables/css/data-table.css" rel="stylesheet" />
<script src="assets/admin_temp/plugins/DataTables/js/jquery.dataTables.js"></script>

<script>
function confirm_box(){
    var answer = confirm ("Are you sure?");
    if (!answer)
     return false;
}

$(document).ready(function() {
    if ($('#data-table').length !== 0) {
        $('#data-table').DataTable({
			"order": [[ 0, "desc" ]]
	    });
    }
    if ($('#data-table2').length !== 0) {
        $('#data-table2').DataTable({
			"order": [[ 0, "desc" ]]
	    });
    }
    if ($('#data-table3').length !== 0) {
        $('#data-table3').DataTable({
			"order": [[ 0, "desc" ]]
	    });
    }

});

function get_resign(id,value){
	//alert(name+' '+id+' '+value);
    $.ajax({
       type: "POST",
       url: "<?=$_cancel?>/ajax_resign",
       data: {id:id,admin_id:value,<?=$this->security->get_csrf_token_name();?>:'<?=$this->security->get_csrf_hash();?>'},
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