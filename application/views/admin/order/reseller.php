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
                
                <table class="table table-striped table-bordered table-hover" id="sample_6">
                <thead>
                <tr>
                    <th>Order Number</th>
                    <th>Coupon Code</th>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Shipping</th>
                    <th>Total</th>
                    <th>Username</th>
                    <th>Partner</th>
                    <th>Payment Type</th>
                    <th>Status</th>
                    <th>Ordered On</th>
                </tr>
                </thead>
                <tbody>

<?php
if(count($all_data)){
	foreach($all_data as $set_data){
		$options = unserialize($set_data->order_content);
		$product = $this->comman_model->get_lang('products',$content_language_id,NULL,array('id'=>$set_data->product_id),'product_id',true);
		$order = $this->comman_model->get_by('user_orders',array('id'=>$set_data->order_id),false,false,true);
		$user = $this->comman_model->get_by('users',array('id'=>$order->user_id),false,false,true);
		$ownner  = $this->comman_model->get_by('users',array('id'=>$set_data->ownner_id),false,false,true);
?>
            <tr>
                <td><?=$order->order_number;?></td>
                <td><?=$set_data->coupon_code;?></td>
                <td>
<?php
if($product){
?>    
<img src="<?= !empty($product->image)?'assets/uploads/products/'.$product->image:'assets/uploads/no-image.gif';?>" alt="<?=$product->title;?>" style="height:30px;width:30px">
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
if($order->currency=='points'){
	echo $set_data->price.' Points';
}
else{
	echo $order->currency.$set_data->price;
}
?>
                </td>
                <td><?=$set_data->quantity?></td>
                <td>
<?php
if($order->currency=='points'){
	echo ' No Shipping';
}
else{
	echo $order->currency.$set_data->shipping_cost;
}
?>
                </td>
                <td>
<?php
if($order->currency=='points'){
	echo ($set_data->shipping_cost+($set_data->quantity*$set_data->price)).' Points';
}
else{
	echo $order->currency.($set_data->shipping_cost+($set_data->quantity*$set_data->price));
}
?>
				</td>
                <td><?=$user->first_name.' '.$user->last_name;?></td>
                <td><?=$ownner->first_name.' '.$ownner->last_name;?></td>
                <td><?=$order->payment_type;?></td>
			<td>
<?php
if($set_data->status=='pending'){
	echo '<span class="label label-sm label-info">'.$set_data->status.'</span>';
}
else{
	echo '<span class="label label-sm label-success">'.$set_data->status.'</span>';
}
?>
                            </td>
                <td><?=date('d-m-Y',$set_data->created);?></td>
            </tr>

<?php             
   }
}
?>                        

                </tbody>
                </table>
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>
