<div class="row">
    <div class="col-md-12">
        <!-- begin panel -->
        <div data-sortable-id="form-stuff-1" class="panel panel-inverse">
            <div class="panel-heading">                
                <h4 class="panel-title"><?=$name?></h4>
            </div>
            <div class="panel-body">
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover">
        <thead>
              <tr>
                    <th class=""><?=show_static_text($lang_id,16);?></th>
                    <th class=""><?=show_static_text($lang_id,41);?></th>
                    <th class=""><?=show_static_text($lang_id,104);?></th>
                    <th class=""><?=show_static_text($lang_id,43);?></th>
            </tr>
        </thead>
<tbody>
<?php
$checkform 		= false;
if(isset($view_data)&&!empty($view_data)){
	$total =0;
	$totalShipping = 0;
	foreach($view_data as $set_data){		
		$options = unserialize($set_data->order_content);		

		$product_data = $this->comman_model->get_lang('products',$lang_id,NULL,array('id'=>$set_data->product_id),'product_id',true);
		$total = $total +($set_data->price*$set_data->quantity);
		
?>
  <tr id="tablerow_<?=$set_data->id?>">
    <td class="">
<?php
if($product_data){
	echo $product_data->title;
}
else{
	echo $options['productName'];
}
//echo '<br>'.$storeName;
?>

<?php
if($set_data->type=='Service'){
$checkform 		= true;
?>
<ul class="list-unstyled">
<?php
	echo '<li>'.h_dateFormat($set_data->a_date,'d-m-Y').' '.$set_data->a_time.'</li>';
?>
</ul>
<?php
}
?>


    </td>
    
    <td class="">
      
<?php
	echo '$'.numberFormat($set_data->price);
?>
	  
    </td>
    <td class="">
      <?=$set_data->quantity?>
    </td>
    <td class="">
    
<?php
echo '$'.numberFormat($set_data->price*$set_data->quantity);
?>
    
 
      
    </td>
  </tr>

<?php	
	}
?>
						
						<tr>
							<td colspan="3" align="right" class="text-right" ><?=show_static_text($lang_id,43);?></td>
							<td>
<?php
	echo '$'.numberFormat($total);
?>

                            </td>
						</tr>

<?php
}
else{
?>
<tr class="tr_orange">
<td align="center" class="alt_thumb" colspan="5">There is no data.</td>                                
</tr>
<?php
}
?>


</tbody>							
        </table>

    </div>
<?php
if($checkform){
?>
<h3>History</h3>
<hr>
<div class="panel-body">
     <?=form_open(NULL, array('class' => 'form-horizontal', 'role'=>'form','enctype'=>"multipart/form-data"))?>
		<input type="hidden" name="history" value="set"  />
    <div class="form-body">                    
    <div class="col-md-12">    
    <div class="form-group">
    <label class="col-lg-1 control-label"><?=show_static_text($lang_id,2760);?>Decsription</label>
    <div class="col-lg-10">
    <?=form_textarea('description', html_entity_decode(set_value('description')), 'placeholder="" rows="3" class="cleditor2 form-control"')?>
    </div>
    </div>                                                         
</div>

   <div style="clear:both"></div>

            </div>
         <div class="form-actions">
                <div class="row">
                    <div class="col-md-offset-1 col-md-9">
                        <?=form_submit('submit', show_static_text($lang_id,235), 'class="btn btn-primary"')?>
                        <a href="<?=$_cancel;?>" class="btn btn-default" type="button"><?=show_static_text($lang_id,22);?></a>

                    </div>
                </div>
            </div>
     <?=form_close()?>
</div>
<?php
}
?>

            </div>
        </div>
        <!-- end panel -->
    </div>

</div>
<script>
function get_resign(id,value){
	//alert(name+' '+id+' '+value);
    $.ajax({
       type: "POST",
       url: "<?=$_cancel?>/ajax_resign",
       data: {id:id,staff_id:value,<?=$this->security->get_csrf_token_name();?>:'<?=$this->security->get_csrf_hash();?>'},
       beforeSend: function () {
	      $("#show_class").html("Loading ...");
        },
       success: function(msg){
		   if(msg.status=='error'){
			   alert('Sorry!! There is some problem.');
		   }
		 //alert(msg);
		//location.reload();
    	$("#show_class").html(msg);
       }
       });
} 

</script>
<script src="assets/plugins/ckeditor/ckeditor.js" type="text/javascript" language="javascript"></script> 
<script src="assets/plugins/ckeditor/adapters/jquery.js" type="text/javascript" language="javascript"></script>
<script>
/* CL Editor */
$(document).ready(function(){
    $('.cleditor2').ckeditor();
});
</script>
