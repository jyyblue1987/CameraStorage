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
    <div class="row" style="margin-bottom:10px">
	    <div class="col-md-6">
    		<div class="btn-group">
			    <a href="<?=$_edit?>" class="btn btn-primary m-r-5 m-b-5"><?=show_static_text($adminLangSession['lang_id'],233);?> <i class="fa fa-plus"></i></a>
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
                <th><?=show_static_text($adminLangSession['lang_id'],1607);?>Type</th>
                <th><?=show_static_text($adminLangSession['lang_id'],1607);?>Category</th>
                <th><?=show_static_text($adminLangSession['lang_id'],1067);?>Created by</th>
                <th><?=show_static_text($adminLangSession['lang_id'],1067);?>Feature</th>
                <th><?=show_static_text($adminLangSession['lang_id'],1067);?>Confirm</th>
                <th><?=show_static_text($adminLangSession['lang_id'],258);?></th>
            </tr>
        </thead>
		<tbody>

<?php
if(count($all_data)){
	foreach($all_data as $set_data){
		$userName ='Admin';
		if($set_data->user_id!=0){
			$storeData = $this->comman_model->get_by('users',array('id'=>$set_data->user_id),false,false,true);
			if($storeData){
				$userName = $storeData->username;
			}
		}

		$tagName ='-';
		if($set_data->category_id!=0){
			$storeData = $this->comman_model->get_lang('categories',$this->data['content_language_id'],NULL,array('id'=>$set_data->category_id),'category_id',true);
			if($storeData){
				$tagName = $storeData->title;
			}
		}

		if(isset($set_data->image)){
			$image = base_url('assets/uploads/products/small').'/'.$set_data->image; 
		}
		else{
			$image = "assets/uploads/no-image.gif";
		}
?>
<tr>
    <td><?php echo $set_data->id; ?></td>
    <td><img src="<?=$image?>" class="img-rounded" style="width:30px;height:30px"> <?=$set_data->title; ?></td>
    <td> <?=$set_data->type?></td>
    <td> <?=$tagName?></td>
    <td> <?=$userName?></td>
<td>
<input id="remember" name="remember" type="checkbox" onclick="get_active('feature',<?php echo $set_data->id;?>,this.value)" <?=$set_data->is_feature==1?'checked="checked"':''?>   />
							</td>
<td>
<input id="remember" name="remember" type="checkbox" onclick="get_active('enabled',<?php echo $set_data->id;?>,this.value)" <?=$set_data->enabled==1?'checked="checked"':''?>   />
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
function confirm_box(){
    var answer = confirm ("<?=show_static_text($adminLangSession['lang_id'],265);?>");
    if (!answer)
     return false;
}
function get_active(name,id,value){
    $.ajax({
       type: "POST",
       url: "<?=$_cancel?>/get_active", /* The country id will be sent to this file */
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

</script>