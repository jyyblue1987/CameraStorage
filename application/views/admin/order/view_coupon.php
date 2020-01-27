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
						<table class="table table-striped table-bordered table-hover" id="sample_6">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Code</th>
                    <th>Used</th>
                </tr>
                </thead>
                <tbody>
<?php
if(isset($coupon_data)&&!empty($coupon_data)&&$view_data){
		$options = unserialize($view_data->order_content);
		$product = $this->comman_model->get_lang('products',$content_language_id,NULL,array('id'=>$view_data->product_id),'product_id',true);
		foreach($coupon_data as $set_data){
?>
						<tr>
<td>
<?php
if($product){
?>    
<img src="<?= !empty($product->image)?'assets/uploads/products/'.$product->image:'assets/uploads/no-image.gif';?>" alt="<?=$product->title;?>" style="height:50px;width:50px">
<?=$product->title;?>
<?php
}
else{
	echo $options['productName'];
}
?>

</td>
							<td><?php echo $set_data->coupon_code;?></td>
                            
                            <td>
<?php
if($set_data->status=='done'){
	echo '<span class="label label-sm label-success">'.$set_data->status.'</span>';
}
else{
	echo '<span class="label label-sm label-warning">'.$view_data->status.'</span>';
}
?>
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
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>

