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
			    <a href="<?=$_edit;?>" class="btn btn-primary m-r-5 m-b-5"><?=show_static_text($adminLangSession['lang_id'],233);?> <i class="fa fa-plus"></i></a>
		    </div>
	    </div>
	    </div>

    <div class="table-responsive">
        <table id="data-table" class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th><?=show_static_text($adminLangSession['lang_id'],244);?></th>								
                    <th><?=show_static_text($adminLangSession['lang_id'],25500);?>Name</th>
                    <th><?=show_static_text($adminLangSession['lang_id'],5500);?>Country</th>
                    <th><?=show_static_text($adminLangSession['lang_id'],258);?></th>
                </tr>
                </thead>
                <tbody>

<?php
if(count($all_data)){
	foreach($all_data as $set_data){
		$tagName ='-';
		if($set_data->country!=0){
			$storeData = $this->comman_model->get_by('countries',array('id'=>$set_data->country),false,false,true);
			if($storeData){
				$tagName = $storeData->name;
			}
		}
?>
                        <tr>
							<td><?php echo $set_data->id; ?></td>
							<td><?php echo $set_data->name; ?></td>
							<td><?php echo $tagName; ?></td>
							<td>
<a class="btn btn-icon-only btn-success " href="<?=$_edit?>/<?=$set_data->id;?>" ><i class="fa fa-edit"></i></a>
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
</script>
<link href="assets/admin_temp/plugins/DataTables/css/data-table.css" rel="stylesheet" />
<script src="assets/admin_temp/plugins/DataTables/js/jquery.dataTables.js"></script>

<script>
$(document).ready(function() {
    if ($('#data-table').length !== 0) {
        $('#data-table').DataTable({
			"order": [[ 2, "asc" ]]
	    });
    }
});

</script>
