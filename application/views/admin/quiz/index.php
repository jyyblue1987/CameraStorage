<div class="row">
    <div class="col-md-12">
        <!-- begin panel -->
        <div  class="panel panel-inverse">
            <div class="panel-heading">                                
                <h4 class="panel-title"><?=$name?></h4>
            </div>

<div class="panel-body">
<div class="row">
	    <div class="col-md-6">
    		<div class="btn-group">
			    <a href="<?=$_edit?>" class="btn btn-primary m-r-5 m-b-5"><?=show_static_text($adminLangSession['lang_id'],233);?> <i class="fa fa-plus"></i></a>
		    </div>
	    </div>
    	
	    </div>
    <div class="table-responsive" style="padding-top:10px">
        <table id="data-table" class="table table-striped table-bordered">
                <thead>
                <tr>
                      <tr>
                        <th>ID</th>								
                        <th>Name</th>
                        <th>Questions</th>
<!--                        <th>Confirm</th>-->
                        <th>Options</th>
                    </tr>
                </tr>
                </thead>
                <tbody>

<?php
if(count($all_data)){
	foreach($all_data as $set_data){
		if(isset($set_data->image)){
			$image = base_url('assets/uploads/quiz').'/'.$set_data->image; 
		}
		else{
			$image = "assets/uploads/no-image.gif";
		}
		$answer = $this->comman_model->get_by('quizs_ques',array('quiz_id'=>$set_data->id), FALSE, FALSE, false);

?>
                        <tr>
							<td><?php echo $set_data->id; ?></td>
							<td> <?=$set_data->title; ?></td>
                            
							<td><a href="<?=$admin_link?>/quiz_question/index/<?=$set_data->id?>"><?=count($answer); ?> Questions</a></td>
<!--							<td>
                            	<input id="remember" name="remember" type="checkbox" onclick="get_active('status',<?php echo $set_data->id;?>,this.value)" <?=$set_data->status==1?'checked="checked"':''?>   />
							</td>-->
							
							
							
							<td>
                            <a class="btn btn-icon-only green tooltips" href="<?=$_edit?>/<?php echo $set_data->id;?>" title="Edit" data-original-title="Edit" data-placement="top">
										<i class="fa fa-edit"></i></a>
                            <a class="btn btn-icon-only red" href="<?=$_delete?>/<?php echo $set_data->id;?>"  onclick="return confirm_box();" title="Delete">
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

});


</script>