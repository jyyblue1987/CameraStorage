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
                <table class="table table-striped table-bordered table-hover" id="sample_6">
                <thead>
                <tr>
                    <th>Picture</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>
                </thead>
                <tbody>
<?php
if(isset($view_data)&&!empty($view_data)){
	$total =0;
	foreach($view_data as $set_data){
		$product = $this->comman_model->get_lang('products',$content_language_id,NULL,array('id'=>$set_data->product_id),'product_id',true);
		$total = $total +($set_data->price*$set_data->quantity);
?>
						<tr>
							<td><img src="assets/uploads/products/<?php echo $product->image;?>" width="100" height="50" class="img-rounded" ></td>
							<td><?php echo $product->title; ?></td>
							<td><?php echo '$'.$set_data->price;?></td>
							<td><?php echo $set_data->quantity;?></td>
							<td><?php echo '$'.($set_data->price*$set_data->quantity);?></td>
						</tr>
<?php		
	}
}
?>                    
						
						
						
						<tr>
							<td><strong><?php echo $this->lang->line('total');?></strong></td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td><strong><?php echo '$'.$total;?></strong></td>
						</tr>
					</tbody>
                </table>
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>

