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
            <a href="<?=$_edit?>" class="btn btn-primary m-r-5 m-b-5">
            Add New  <i class="fa fa-plus"></i>
            </a>
        </div>
    </div>
</div>
    <div class="table-responsive">
        <table id="data-table" class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>Question</th>
                    <th>Quiz</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>

<?php
if(count($all_data)){
	foreach($all_data as $set_data){
		if($set_data->quiz_id!=0){
			$category = $this->comman_model->get_lang('quizs',$content_language_id,NULL,array('id'=>$set_data->quiz_id),'quiz_id',true);
			if($category){
				$categoryName = $category->title;				
			}
			else{
				$categoryName = '-';
			}
		}
		else{
			$categoryName = '-';
		}
?>
<tr class="tr_grey" >
    <td ><?=$set_data->description?></td>
    <td ><?=$categoryName;?> </td>
    <td><?=date('d-m-Y',$set_data->created)?></td>                    
    <td class="">
        <a href="<?=$_edit?>/<?=$set_data->id?>" class="btn btn-icon-only green tooltips" title="Edit" data-original-title="Edit" data-placement="top">
                        <i class="fa fa-edit"></i></a>	

        <a href="<?=$_delete?>/<?=$set_data->id?>" onclick="return confirm_box();"  class="btn btn-icon-only red" title="Delete">
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
</script>
