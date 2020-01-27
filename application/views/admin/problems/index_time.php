<div class="row">
    <div class="col-md-12">
        <!-- begin panel -->
        <div data-sortable-id="form-stuff-1" class="panel panel-inverse">
            <div class="panel-heading">                                
                <h4 class="panel-title"><?=$name?></h4>
            </div>

<div class="panel-body">
<ul class="nav nav-tabs">
    <li class=""><a href="<?=$_cancel;?>">All Ticket</a></li>
    <li class="active"><a href="javascript:void(0);">Urgent</a></li>
</ul>

    <div class="table-responsive" style="padding-top:10px">
        <table id="data-table" class="table table-striped table-bordered">
                <thead>
                <tr>
	                <th><?=show_static_text($adminLangSession['lang_id'],244);?></th>
	                <th><?=show_static_text($adminLangSession['lang_id'],1600);?>Username</th>
	                <th><?=show_static_text($adminLangSession['lang_id'],1600);?>Company Name</th>
	                <th><?=show_static_text($adminLangSession['lang_id'],1580);?>Ticket</th>
	                <th><?=show_static_text($adminLangSession['lang_id'],1006);?>Description</th>
	                <th><?=show_static_text($adminLangSession['lang_id'],1007);?>Date</th>
	                <th><?=show_static_text($adminLangSession['lang_id'],1006);?>Response Time</th>
	                <th><?=show_static_text($adminLangSession['lang_id'],1006);?>User Time</th>
	                <th><?=show_static_text($adminLangSession['lang_id'],1007);?>Status</th>
	                <th width="180"><?=show_static_text($adminLangSession['lang_id'],258);?></th>
                </tr>
                </thead>
                <tbody>

<?php
if(count($all_data)){
	foreach($all_data as $set_data){
		$storeName ='-';
		$statusName ='-';
		$statusClass = '';
		if($set_data->ticket_id!=0){
			$storeData = $this->comman_model->get_by('tickets',array('id'=>$set_data->ticket_id),false,false,true);
			if($storeData){
				$storeName = $storeData->name;
			}
		}
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
/*		$this->db->order_by('id','desc');
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
        <td><?=$set_data->user_name;?></td>
        <td><?=$set_data->company_name;?></td>
        <td><?=$storeName;?></td>
        <td><?php //echo $set_data->name; ?>
<?php
$html = strip_tags($set_data->desc);
$html = html_entity_decode($html, ENT_QUOTES, 'UTF-8');    
echo (strlen($html)>=100)?substr($html, 0 ,100).'...':$html;
?>
        
        </td>
       <td><?=$set_data->date.' '.$set_data->time;?></td>
       <td><?=$set_data->solve_time;?> Hrs</td>
       <td><?=$set_data->solve_user_time;?> Hrs</td>
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
        <!-- end panel -->
    </div>
</div>


<script>
function confirm_box(){
    var answer = confirm ("Are you sure?");
    if (!answer)
     return false;
}

$('#data-table').DataTable( {
	"bSort": false,
/*	"order": [[ 7, "asc" ]]*/
} );
</script>