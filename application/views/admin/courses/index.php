<div class="row">
    <div class="col-md-12">
        <!-- begin panel -->
        <div  class="panel panel-inverse">
            <div class="panel-heading">                                
                <h4 class="panel-title"><?=$name?></h4>
            </div>

<div class="panel-body">
<!--<div class="row">
	    <div class="col-md-6">
    		<div class="btn-group">
			    <a href="<?=$_edit?>" class="btn btn-primary m-r-5 m-b-5"><?=show_static_text($adminLangSession['lang_id'],233);?> <i class="fa fa-plus"></i></a>
		    </div>
	    </div>
    	
	    </div>-->
    <div class="table-responsive" style="padding-top:10px">
        <table id="data-table" class="table table-striped table-bordered">
                <thead>
                <tr>
	                <th><?=show_static_text($adminLangSession['lang_id'],244);?></th>
	                <th><?=show_static_text($adminLangSession['lang_id'],1600);?>Title</th>
	                <th><?=show_static_text($adminLangSession['lang_id'],1600);?>Username</th>
	                <th><?=show_static_text($adminLangSession['lang_id'],1600);?>Category</th>
	                <th><?=show_static_text($adminLangSession['lang_id'],1600);?>Type</th>
	                <th><?=show_static_text($adminLangSession['lang_id'],1600);?>Price</th>
<!--	                <th><?=show_static_text($adminLangSession['lang_id'],1600);?>Description</th>-->
	                <th width="180"><?=show_static_text($adminLangSession['lang_id'],258);?></th>
                </tr>
                </thead>
                <tbody>

<?php
if(count($all_data)){
	foreach($all_data as $set_data){
		$storeName ='-';
		if($set_data->user_id!=0){
			$storeData = $this->comman_model->get_by('users',array('id'=>$set_data->user_id),false,false,true);
			if($storeData){
				$storeName = $storeData->first_name.' '.$storeData->last_name;
			}
		}

		if(isset($set_data->image)){
			$image = base_url('assets/uploads/products/thumbnails').'/'.$set_data->image; 
		}
		else{
			$image = "assets/uploads/no-image.gif";
		}

		if($set_data->category_id!=0){
			$category = $this->comman_model->get_lang('categories',$content_language_id,NULL,array('id'=>$set_data->category_id),'category_id',true);
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
    <tr>
        <td><?php echo $set_data->id; ?></td>
        <td><img src="<?=$image?>" class="img-rounded" style="width:30px;height:30px"> <?=$set_data->name;?>
        </td>
        <td><?=$storeName;?></td>
        <td><?=$categoryName;?></td>
        <td><?=$set_data->type;?></td>
        <td>$<?=$set_data->price;?></td>
        <!--<td>
<?php
$html = strip_tags($set_data->desc);
$html = html_entity_decode($html, ENT_QUOTES, 'UTF-8');    
echo (strlen($html)>=400)?substr($html, 0 ,400).'...':$html;

?>                            
        
		</td>-->
        <td>
<!--<a class="btn btn-icon-only btn-info" href="<?=$_edit?>/<?php echo $set_data->id;?>" >
        <i class="fa fa-edit"></i></a>-->
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
			"order": [[ 0, "desc" ]],
			"lengthMenu": [[100, 150,200, 300, 400,500,600], [100,150, 200, 300, 400,500,600]],
			"iDisplayLength": 150
			
	    });
    }

});
</script>
