<style>
/*.form-horizontal .control-label{
	padding-top:0px;
	text-align:left;
	min-width:50px !important;
}*/

</style>

<div class="col-md-12">
<!-- begin panel -->
    <div class="portlet light">        
        <div class="portlet-body form" style="min-height:360px">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#tab_1_0" data-toggle="tab"><?=show_static_text($adminLangSession['lang_id'],6);?></a>
                    </li>
                    <li class="">
                        <a href="#tab_1_1" data-toggle="tab"><?=show_static_text($adminLangSession['lang_id'],152);?></a>
                    </li>
                </ul>
                <div class="tab-content">
                    <!--tab0-->
                    <div class="tab-pane fade active in" id="tab_1_0">
<table class="table table-striped table-bordered table-hover" id="sample_6">
    <thead>
        <tr>
            <th><?=show_static_text($adminLangSession['lang_id'],16);?></th>
            <th><?=show_static_text($adminLangSession['lang_id'],41);?></th>
            <th><?=show_static_text($adminLangSession['lang_id'],104);?></th>
            <th><?=show_static_text($adminLangSession['lang_id'],43);?></th>
        </tr>
    </thead>
    <tbody>
<?php

if(isset($view_data)&&!empty($view_data)){
	$total =0;
	$totalShipping = 0;
	foreach($view_data as $set_data){
		if(!empty($set_data->shipping_cost)){
			$totalShipping = $totalShipping+$set_data->shipping_cost;
		}
		
		$options = unserialize($set_data->order_content);
		$product = $this->comman_model->get_lang('products',$content_language_id,NULL,array('id'=>$set_data->product_id),'product_id',true);
		$total = $total +($set_data->price*$set_data->quantity);

		$store_data=$this->comman_model->get_by('stores',array('id'=>$set_data->store_id),false,false,true);
		if($store_data){
			$storeName = $store_data->name	;
		}

?>
						<tr>
<td>
<?php
if($product){
	echo $product->title;
}
else{
	echo $options['productName'];
}
echo '<br>'.$storeName;
?>
<?php
if(isset($options['product_free_items'])){
	$freeOption = explode(', ',$options['product_free_items']);
	if($freeOption){
?>
<ul class="list-unstyled">
<?php
foreach($freeOption as $setFree){
	echo '<li>'.$setFree.'</li>';
}
?>
</ul>
<?php
	}
}
?>

<?php
if(isset($options['extra_option'])){
	$extraOption = unserialize($options['extra_option']);
	if($extraOption){
/*		echo '<pre>';
		print_r($extraOption);
		echo '</pre>';*/
?>
<ul class="list-unstyled">
<?php
foreach($extraOption as $setFree){
	echo '<li>+<b>'.$setFree['qty'].'X</b> '.$setFree['name'].'&nbsp;&nbsp;&nbsp;&pound;'.($setFree['price']*$setFree['qty']).'</li>';
}
?>
</ul>
<?php
	}
}
?>


</td>
							<td>
<?php
	echo '&pound;'.$set_data->price;
?>
							</td>
							<td><?php echo $set_data->quantity;?></td>                           
							<td>
<?php
	echo '&pound;'.($set_data->price*$set_data->quantity);
?>
                            
                            </td>
						</tr>
<?php		
	}
}
?>                    
						
						
						<tr>
							<td colspan="3" align="right"><strong><?=show_static_text($adminLangSession['lang_id'],117);?></strong></td>
							<td><strong>
<?php
	echo '&pound;'.numberFormat($total);
?>

                            </strong></td>
						</tr>
						
						<tr>
							<td colspan="3" align="right" class="text-right" >Delivery Fee<?=show_static_text($adminLangSession['lang_id'],999);?></td>
							<td><?='&pound;'.numberFormat($order_details->shipping_cost);?></td>
						</tr>
						
						<tr>
							<td colspan="3" align="right" class="text-right" ><?=show_static_text($adminLangSession['lang_id'],121);?></td>
							<td>- <?='&pound;'.numberFormat($order_details->coupon_cost);?></td>
						</tr>
						
						<tr>
							<td colspan="3" align="right"><strong><?=show_static_text($adminLangSession['lang_id'],43);?></strong></td>
							<td><strong>

<?php
	echo '&pound;'.numberFormat(($total+$order_details->shipping_cost)-$order_details->coupon_cost);
?>
							</strong></td>
						</tr>
<?php
if($order_details->comment){
?>
    <tr>
        <td colspan="6" align="center"><strong><?=show_static_text($adminLangSession['lang_id'],122);?></strong></td>
    </tr>
    <tr>
        <td colspan="6" align="left"><strong><?=$order_details->comment;?></strong></td>
    </tr>
<?php
}
?>		
                        
					</tbody>
                </table>    
                    </div>
                    <!--end tab-->

                    <!--tab1-->
                    <div class="tab-pane fade" id="tab_1_1">
                                <table class="table table-striped table-bordered table-hover" id="sample_6">
                                    <thead>
                                    <tr>
                                        <th><?=show_static_text($adminLangSession['lang_id'],153);?></th>
                                        <th><?=show_static_text($adminLangSession['lang_id'],157);?></th>
                                        <th><?=show_static_text($adminLangSession['lang_id'],158);?></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                    <?php
                    if(isset($order_histroy_data)&&!empty($order_histroy_data)){
                        foreach($order_histroy_data as $set_data){
                    ?>
                                            <tr>
                                                <td><?=date('d-m-Y',strtotime($set_data->date_added)); ?></td>
                                                <td><?=$set_data->comment;?></td>
                                                <td><?=$set_data->order_status;?></td>
                                            </tr>
                    <?php		
                        }
                    }
                    ?>                    
                                            
                                        </tbody>
                                    </table>								
                                
                                <div class="portlet light bordered">
                                                                    <div class="portlet-title">
                                                                        <div class="caption">
                                                                            
                                                                            <span class="caption-subject font-red-sunglo bold uppercase"><?=show_static_text($adminLangSession['lang_id'],280);?></span>
                                                                            
                                                                        </div>
                                                                        
                                                                    </div>
                                                                    <div class="portlet-body form">
                                
                                <div class="alert alert-block alert-success fade in ajax-error" style="display:none">
                                </div>
                                                                        <!-- BEGIN FORM-->
                                                <?=form_open(NULL, array('class' => 'form-horizontal', 'role'=>'form','enctype'=>"multipart/form-data",'id'=>'contact_form'))?>
                                                    <input type="hidden" name="operation" value="set" />
                                                    <input type="hidden" name="order_id" value="<?=$order_id?>"  id="order_id"/>
                                                     <div class="form-body">                    
                                                        <div class="col-md-12">
                                                    
                                                
                                
                                                <div class="form-group" >
                                                  <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],158);?></label>
                                                  <div class="col-lg-10">
                                                        <select class="form-control" id="order_status" name="order_status">
                                                            <option value="Canceled">Canceled</option>
                                                            <option value="Complete">Complete</option>
                                                            <option value="Failed">Failed</option>
                                                            <option value="Pending">Pending</option>
                                                            <option selected="selected" value="Processed">Processed</option>
                                                            <option value="Processing">Processing</option>
                                                            <option value="Shipped">Shipped</option>
                                                            <option value="Voided">Voided</option>
                                                        </select>
                                                  </div>
                                                </div>
                                                <div class="form-group" >
                                                  <label class="col-lg-2 control-label"><?=lang('')?><?=show_static_text($adminLangSession['lang_id'],281);?></label>
                                                  <div class="col-lg-1" style="padding-top:10px;">
                                                        <input type="checkbox" class="" id="notify" name="notify" value="1" />
                                                  </div>
                                                </div>
                                                <div class="form-group" >
                                                  <label class="col-lg-2 control-label"><?=lang('')?><?=show_static_text($adminLangSession['lang_id'],157);?></label>
                                                  <div class="col-lg-10">
                                                    <?=form_textarea('comment', set_value('comment'), 'placeholder="Comment" rows="3" class="form-control" id="comments"')?>
                                                  </div>
                                                </div>
                                            </div>
                                            
                                               <div style="clear:both"></div>
                                                        </div>
                                                     <div class="form-actions">
                                                            <div class="row">
                                                                <div class="col-md-offset-2 col-md-9">
                                                                    <?=form_submit('submit', show_static_text($adminLangSession['lang_id'],235), 'class="btn btn-primary"')?>
                                                                    <!--<button type="button" class="btn default">Cancl</button>-->
                                                                </div>
                                                            </div>
                                                        </div>
                                                 <?=form_close()?>
                                                                        <!-- END FORM-->
                                                                    </div>
                                                                </div>             
    
                    </div>
                    <!--end tab1-->
                </div>
        </div>
    </div>
<!-- end panel -->
</div>

<script>

$( document ).ready(function() {
	$( "#contact_form" ).submit(function() {
		$('.ajax-error').html('saving...');
		$('.ajax-error').show();
		var comment = $('#comments').val();
		var order_id = $('#order_id').val();
		var notify = $('#notify').val();
		var order_status= $('#order_status').val();
		$.ajax({
				type:"POST",
				url:"<?=$_cancel?>/save_order_status",
				data:{comment:comment,order_id:order_id,order_status:order_status,notify:notify,<?=$this->security->get_csrf_token_name();?>:'<?=$this->security->get_csrf_hash();?>'},
				success:function(data){
					$('.ajax-error').html(data);
					setTimeout(function(){
					$('.ajax-error').hide();
					}, 2000);
				}
		});
	return false;	
	});
});
</script>