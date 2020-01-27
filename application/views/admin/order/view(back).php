<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet box grey-cascade">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-globe"></i><?php echo $name;?>
                </div>
                <!--<div class="tools">
                    <a href="javascript:;" class="collapse">
                    </a>
                    <a href="#portlet-config" data-toggle="modal" class="config">
                    </a>
                    <a href="javascript:;" class="reload">
                    </a>
                    <a href="javascript:;" class="remove">
                    </a>
                </div>-->
            </div>
            <div class="portlet-body">
                <div class="table-toolbar">
                    <div class="row">
                        
                    </div>
                </div>
                <div class="tabbable tabbable-custom boxless tabbable-reversed">
						<ul class="nav nav-tabs">
							<li class="active">
								<a href="#tab_0" data-toggle="tab">Product</a>
							</li>
							<!--<li>
								<a href="#tab_1" data-toggle="tab">Product</a>
							</li>-->
							<li>
								<a href="#tab_2" data-toggle="tab">Histroy</a>
							</li>
						</ul>
						<div class="tab-content">
							<div class="tab-pane active" id="tab_0">
								<table class="table table-striped table-bordered table-hover" id="sample_6">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Shipping Cost</th>
                    <th>View</th>
                    <th>Total</th>
                </tr>
                </thead>
                <tbody>
<?php
if(isset($view_data)&&!empty($view_data)){
	$total =0;
	foreach($view_data as $set_data){
		$options = unserialize($set_data->order_content);
		$product = $this->comman_model->get_lang('products',$content_language_id,NULL,array('id'=>$set_data->product_id),'product_id',true);
			$total = $total +($set_data->price*$set_data->quantity)+$set_data->shipping_cost;
?>
						<tr>
<td>
<?php
if($product){
?>    
<img src="<?= !empty($product->image)?'assets/uploads/products/'.$product->image:'assets/uploads/no-image.gif';?>" alt="<?=$product->title;?>" style="height:50px;width:50px">
<?=$product->title;?>&nbsp;<span class="label label-sm label-success"><?=$product->type;?></span>
<?php
}
else{
	echo $options['productName'].'&nbsp;<span class="label label-sm label-success">'.$options['product_type'].'</span>';
}
?>

</td>
							<td>
<?php
if($order_details->currency=='points'){
	echo $set_data->price.' Points';
}
else{
	echo $order_details->currency.$set_data->price;
}
?>
							</td>
							<td><?php echo $set_data->quantity;?></td>
                            <td>
<?php
if($order_details->currency=='points'){
	echo 'No Shipping';
}
else{
	echo $order_details->currency.$set_data->shipping_cost;
}
?>

                            </td>
                            <td>
<?php
if($options['product_type']=='service'){
?>
	<a href="admin/order_history/view_coupon/<?=$set_data->id?>">View Coupon</a>
<?php    
}
?>
                            </td>
							<td>
<?php
if($order_details->currency=='points'){
	echo $set_data->price*$set_data->quantity.' Points';
}
else{
	if(!empty($set_data->shipping_cost)){
		echo $order_details->currency.($set_data->shipping_cost+($set_data->price*$set_data->quantity));
	}
	else{
		echo $order_details->currency.($set_data->price*$set_data->quantity);
	}
}
?>
                            
                            </td>
						</tr>
<?php		
	}
}
?>                    
						
						
						<tr>
							<td colspan="5" align="right"><strong>Total Product</strong></td>
							<td><strong>
<?php
if($order_details->currency=='points'){
	echo $total.' Points';
}
else{
	echo $order_details->currency.$total;
}
?>

                            </strong></td>
						</tr>
<?php
if($order_details->currency!='points'){
?>
						<tr>
							<td colspan="5" align="right"><strong>Donation</strong></td>
							<td><strong><?=$order_details->currency.$order_details->donation_cost;?></strong></td>
						</tr>
						<tr>
							<td colspan="5" align="right"><strong>Coupon</strong></td>
							<td><strong>-<?=$order_details->currency.$order_details->coupon_cost;?></strong></td>
						</tr>
<?php
}
?>						
						<tr>
							<td colspan="5" align="right"><strong><?php echo $this->lang->line('total');?></strong></td>
							<td><strong>

<?php
if($order_details->currency=='points'){
	echo ($total-$order_details->coupon_cost).' Points';
}
else{
	echo $order_details->currency.($total-$order_details->coupon_cost);
}
?>
							</strong></td>
						</tr>
<?php
if($order_details->comment){
?>
    <tr>
        <td colspan="6" align="center"><strong>Remark</strong></td>
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
							<div class="tab-pane" id="tab_2">
                                <table class="table table-striped table-bordered table-hover" id="sample_6">
                                    <thead>
                                    <tr>
                                        <th>Date Added</th>
                                        <th>Comment</th>
                                        <th>Status</th>
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
                                                                            
                                                                            <span class="caption-subject font-red-sunglo bold uppercase">Add Order History</span>
                                                                            
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
                                                  <label class="col-lg-2 control-label"><?=lang('')?>Status</label>
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
                                                  <label class="col-lg-2 control-label"><?=lang('')?>Notify</label>
                                                  <div class="col-lg-10" style="padding-top:10px;">
                                                        <input type="checkbox" class="form-control" id="notify" name="notify" value="1" />
                                                  </div>
                                                </div>
                                                <div class="form-group" >
                                                  <label class="col-lg-2 control-label"><?=lang('')?>Comment</label>
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
                                                                    <?=form_submit('submit', lang('Save'), 'class="btn btn-primary"')?>
                                                                    <!--<button type="button" class="btn default">Cancl</button>-->
                                                                </div>
                                                            </div>
                                                        </div>
                                                 <?=form_close()?>
                                                                        <!-- END FORM-->
                                                                    </div>
                                                                </div>             
								
								
							</div>
							
						</div>
					</div>
                
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
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
				url:"admin/order_history/save_order_status",
				data:{comment:comment,order_id:order_id,order_status:order_status,notify:notify},
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