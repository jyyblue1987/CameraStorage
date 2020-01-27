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
			    <a href="<?=$_cancel?>/set_xml"class="btn btn-primary m-r-5 m-b-5"><?=show_static_text($adminLangSession['lang_id'],279);?> </a>
		    </div>
	    </div>
    	
	    </div>

    <div class="table-responsive">
        <table id="data-table" class="table table-striped table-bordered">
            <thead>
            <tr>
                <th><?=show_static_text($adminLangSession['lang_id'],244);?></th>
                <th><?=show_static_text($adminLangSession['lang_id'],54);?></th>
                <th><?=show_static_text($adminLangSession['lang_id'],1054);?>Store name</th>
                <th><?=show_static_text($adminLangSession['lang_id'],242);?></th>
                <th><?=show_static_text($adminLangSession['lang_id'],84);?></th>
                <th><?=show_static_text($adminLangSession['lang_id'],155);?></th>
                <th>Payment Type</th>
                <th><?=show_static_text($adminLangSession['lang_id'],243);?></th>
                <th><?=show_static_text($adminLangSession['lang_id'],258);?></th>
            </tr>
            </thead>
            <tbody>

<?php
if(count($all_data)){
foreach($all_data as $set_data){
    $checkReview  = $this->comman_model->get_by('stores_rating',array('order_id'=>$set_data->id),false,false,true);
	$storeName = '-';
	$storeOrder = $this->comman_model->get_by('stores',array('id'=>$set_data->store_id),false,false,true);
	if($storeOrder){
		$storeName = $storeOrder->name;
	}
	$user = $this->comman_model->get_by('user_order_shipping_add',array('order_id'=>$set_data->id),false,false,true);
	$payment='-';

	if($set_data->order_type=='collection'){
		if($set_data->payment_type=='paypal'){
			$payment ='paypal collection';	  
		}
		else if($set_data->payment_type=='cash'){				
			$payment ='Cash On Collection';	  
		}
	}
	else if($set_data->order_type=='delivery'){
		if($set_data->payment_type=='paypal'){
			$payment ='Paypal Delivery';	  
		}
		else if($set_data->payment_type=='cash'){
			$payment ='Cash On Delivery';	  
		}
	}
?>
                    <tr>
                        <td><?=$set_data->id;?></td>                            
                        <td><?=$set_data->order_number;?></td>
                        <td><?=$storeName;?></td>
                        <td><?=$user->first_name.' '.$user->last_name;?><br>( <?=$user->email;?> )</td>
                        <td><?=$user->city;?></td>
                        <td>
<?php
echo '&pound;'.numberFormat($set_data->total);
?>
                        </td>
                        <td><?=$payment;?></td>
                        <td><?php echo date('d/m/Y h:i A',$set_data->created);?></td>
                        <td width="180">
<?php /*?><?php
if($set_data->status=='Pending'){
?>
                        <a href="admin/get_order/<?=$set_data->id;?>">Complete</a>&nbsp;&nbsp;
<?php
}
?><?php */?>                            
                      
<a class="btn btn-icon-only btn-info " href="<?=$_cancel?>/send_mail/<?=$set_data->id;?>" >
                                    <i class="fa fa-share "></i></a>
<a class="btn btn-icon-only btn-success " href="<?=$_edit?>/<?=$set_data->id;?>" >
                                    <i class="fa fa-edit"></i></a>
<a class="btn btn-icon-only btn-info " href="<?=$_view?>/<?=$set_data->id;?>" >
                                    <i class="fa fa-eye"></i></a>
<a class="btn btn-icon-only btn-danger" href="<?=$_delete?>/<?=$set_data->id;?>"  onclick="return confirm_box();" title="Delete">
    <i class="fa fa-trash-o"></i></a>
<?php
if($checkReview){
?>
                  <a  href="<?=$_cancel?>/order_review/<?=$set_data->id?>" >Review</a>
<?php
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

        <!-- end panel -->
    </div>
</div>


<link href="assets/admin_temp/plugins/DataTables/css/data-table.css" rel="stylesheet" />
<script src="assets/admin_temp/plugins/DataTables/js/jquery.dataTables.js"></script>

<script>
$(document).ready(function() {
        $('#data-table').DataTable({
			"order": [[ 0, "desc" ]]
	    });
});
</script>


<script>
function confirm_box(){
    var answer = confirm ("<?=show_static_text($adminLangSession['lang_id'],265);?>");
    if (!answer)
     return false;
}
</script>