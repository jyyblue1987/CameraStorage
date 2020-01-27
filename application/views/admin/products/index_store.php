<style>
.table th{
	vertical-align:top !important;
}
</style>
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
			    <a href="<?=$_cancel?>" class="btn btn-primary m-r-5 m-b-5"><?=show_static_text($adminLangSession['lang_id'],2033);?>Back</a>
		    </div>
	    </div>
	    
    	<div class="pull-right col-lg-6" style="">
            <form class="form-horizontal " role="form" action="" method="get" style="float:right">
                <input type="hidden" name="<?=$this->security->get_csrf_token_name(); ?>" value="<?=$this->security->get_csrf_hash();?>" />
	            <input type="text" class="form-control" name="q"  value="<?=isset($search)?$search:''?>" style="float:left;width:335px" placeholder="">
    	        <button type="submit" name="submit" class="btn btn-primary"><?=show_static_text($adminLangSession['lang_id'],3);?></button>
            </form>
	    </div>
	    </div>

    <div class="table-responsive">
        <table id="data-table" class="table table-striped table-bordered">
        <thead>
              <tr>
                <th><?=show_static_text($adminLangSession['lang_id'],244);?></th>								
                <th><?=show_static_text($adminLangSession['lang_id'],236);?></th>
                <th><?=show_static_text($adminLangSession['lang_id'],536);?>Store Name</th>
                <th><?=show_static_text($adminLangSession['lang_id'],167);?></th>
                <th><?=show_static_text($adminLangSession['lang_id'],269);?></th>
                <th><?=show_static_text($adminLangSession['lang_id'],256);?></th>
                <th><?=show_static_text($adminLangSession['lang_id'],258);?></th>
            </tr>
        </thead>
		<tbody>

<?php
if(count($all_data)){
	foreach($all_data as $set_data){
		$storeName ='-';
		if($set_data->store_id!=0){
			$storeData = $this->comman_model->get_by('stores',array('id'=>$set_data->store_id),false,false,true);
			if($storeData){
				$storeName = $storeData->name;
			}
		}
		if(isset($set_data->image)){
			$image = base_url('assets/uploads/products').'/'.$set_data->image; 
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
		
		if($set_data->sub_category_id!=0){
			$subcategory = $this->comman_model->get_lang('categories',$content_language_id,NULL,array('id'=>$set_data->sub_category_id),'category_id',true);
			if($subcategory){
				$subSategoryName = $subcategory->title;				
			}
			else{
				$subSategoryName = '-';
			}
		}
		else{
			$subSategoryName = '-';
		}



?>
                        <tr>
							<td><?php echo $set_data->id; ?></td>
							<td><img src="<?=$image?>" class="img-rounded" style="width:30px;height:30px"> <?=$set_data->title; ?></td>
							<td> <?=$storeName?></td>
							<td> <?=$categoryName?></td>
							<td> <?=$subSategoryName?></td>
                            
							<td>
                            	<input id="remember" name="remember" type="checkbox" onclick="get_active('status',<?php echo $set_data->id;?>,this.value)" <?=$set_data->status==1?'checked="checked"':''?>   />
							</td>
							
							
							
							<td>
                            <a class="btn btn-icon-only btn-info" href="<?=$_edit?>/<?php echo $set_data->id;?>" >
										<i class="fa fa-edit"></i></a>
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
<div class="row">
        <div class="col-md-5 col-sm-12">
            <div class="dataTables_info" id="sample_6_info" role="status" aria-live="polite">&nbsp;</div>
        </div>
        <div class="col-md-7 col-sm-12">
            <div class="dataTables_paginate paging_simple_numbers" id="sample_6_paginate">
            <?php 
                if($pagination):
                     echo $pagination;
                endif;
            ?>
            </div>
        </div>
    </div>    
    </div>
</div>

        <!-- end panel -->
    </div>
</div>

<script>
function get_active(name,id,value){
    $.ajax({
       type: "POST",
       url: "<?=$_cancel?>/product/get_active", /* The country id will be sent to this file */
       data: {id:id,type:name,value:value,<?=$this->security->get_csrf_token_name();?>:'<?=$this->security->get_csrf_hash();?>'},
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
function get_status(type,id,value){
	//alert(name+' '+id+' '+value);
    $.ajax({
       type: "POST",
       url: "<?=$_cancel?>/product/set_value", /* The country id will be sent to this file */
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

function confirm_box(){
    var answer = confirm ("<?=show_static_text($adminLangSession['lang_id'],265);?>");
    if (!answer)
     return false;
}
</script>