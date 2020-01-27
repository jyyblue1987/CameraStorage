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
                <th><?=show_static_text($adminLangSession['lang_id'],1054);?>Course</th>
                <th><?=show_static_text($adminLangSession['lang_id'],1054);?>Username</th>
                <th><?=show_static_text($adminLangSession['lang_id'],1054);?>Trainer</th>
                <th><?=show_static_text($adminLangSession['lang_id'],84);?></th>
                <th><?=show_static_text($adminLangSession['lang_id'],155);?></th>
                <th><?=show_static_text($adminLangSession['lang_id'],243);?></th>
                <th><?=show_static_text($adminLangSession['lang_id'],2403);?>Rating</th>
                <th><?=show_static_text($adminLangSession['lang_id'],258);?></th>
            </tr>
            </thead>
            <tbody>

<?php
if(count($all_data)){
	$i=0;
	foreach($all_data as $set_data){
		$trainerName = '-';
		if($set_data->user_id!=0){
			$user_data = $this->comman_model->get_by('users',array('id'=>$set_data->ownner_id),false,false,true);
			if($user_data){
				$trainerName = $user_data->first_name.' '.$user_data->last_name;
			}
		}
		$userName = '-';
		if($set_data->user_id!=0){
			$user_data = $this->comman_model->get_by('users',array('id'=>$set_data->user_id),false,false,true);
			if($user_data){
				$userName = $user_data->first_name.' '.$user_data->last_name;
			}
		}
		$rating_data = $this->comman_model->get_by('courses_review',array('book_id'=>$set_data->id),false,false,true);
		if($rating_data)
			$rating = $rating_data->rate;
		else
			$rating = '-';
		$i++;
?>
    <tr>
        <td><?php echo $i; ?></td>
        <td><?=$set_data->name;?></td>
        <td><?=$userName;?></td>
        <td><?=$trainerName;?></td>
        <td><?=$set_data->{'date'}.' '.$set_data->{'time'};?></td>
        <td>$<?=$set_data->{'price'};?></td>
        <td><?=$set_data->{'type'};?></td>
        <td><?=$rating;?></td>
        <td>	
        	<a class="btn btn-icon-only btn-success" href="<?=$_view.'/'.$set_data->id;?>" >
		        <i class="fa fa-eye"></i></a>

            <a class="btn btn-icon-only btn-danger" href="<?=$_delete?>/<?=$set_data->id;?>"  onclick="return confirm_box();" title="Delete">
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
$(document).ready(function() {
        $('#data-table').DataTable({
			"order": [[ 0, "desc" ]]
	    });
});
</script>


<script>
function confirm_box(){
    var answer = confirm ("<?=show_static_text($adminLangSession['lang_id'],265);?>");
    if (!answer)
     return false;
}
</script>