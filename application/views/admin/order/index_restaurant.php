<div class="row">
    <div class="col-md-12">
        <!-- begin panel -->
        <div data-sortable-id="form-stuff-1" class="panel panel-inverse">
            <div class="panel-heading">                
                <h4 class="panel-title"><?=$name?></h4>
            </div>

<div class="panel-body">
    <div class="row">
	<div class="col-md-12 " style="margin-bottom:10px;">        
        <a href="<?=$_cancel?>?type=daily" class="btn btn-warning m-r-5 m-b-5">Day</a>&nbsp;
		<a href="<?=$_cancel?>?type=monthly" class="btn btn-warning m-r-5 m-b-5">Monthly</a>&nbsp;
		<a href="<?=$_cancel?>" class="btn btn-warning m-r-5 m-b-5">All</a>&nbsp;
    </div>
</div>

    <div class="table-responsive">
        <table id="data-table" class="table table-striped table-bordered">
            <thead>
            <tr>
                <th><?=show_static_text($adminLangSession['lang_id'],5004);?>Store Name</th>
                <th><?=show_static_text($adminLangSession['lang_id'],242);?></th>
<!--                <th><?=show_static_text($adminLangSession['lang_id'],155);?></th>-->
                <th><?=show_static_text($adminLangSession['lang_id'],1550);?>Cash</th>
                <th><?=show_static_text($adminLangSession['lang_id'],1550);?>Paypal</th>
            </tr>
            </thead>
            <tbody>

<?php
if(count($all_data)){
foreach($all_data as $set_data){
	$userName = '-';
	$storeOwner = $this->comman_model->get_by('users',array('id'=>$set_data->user_id),false,false,true);
	if($storeOwner){
		$userName = $storeOwner->first_name.' '.$storeOwner->last_name;
	}
	$post_type = $this->input->get('type');
	if($post_type=='monthly'){
		$query1 = "SELECT SUM(`total`) AS Amount  FROM user_orders WHERE MONTH(ordered_on) = MONTH(NOW()) AND YEAR(ordered_on) = YEAR(NOW()) AND payment='1' AND store_id ='".$set_data->id."'";
		$total_earn = $this->comman_model->get_query($query1);

		$query1 = "SELECT SUM(`total`) AS Amount  FROM user_orders WHERE MONTH(ordered_on) = MONTH(NOW()) AND YEAR(ordered_on) = YEAR(NOW()) AND payment='1' and payment_type ='cash' AND store_id ='".$set_data->id."'";
		$total_cash_earn = $this->comman_model->get_query($query1);

		$query1 = "SELECT SUM(`total`) AS Amount  FROM user_orders WHERE MONTH(ordered_on) = MONTH(NOW()) AND YEAR(ordered_on) = YEAR(NOW()) AND payment='1' and payment_type ='paypal' AND store_id ='".$set_data->id."'";
		$total_paypal_earn = $this->comman_model->get_query($query1);
	}
	else if($post_type=='daily'){
		$query2 = "SELECT SUM(`total`) AS Amount  FROM user_orders WHERE DATE(ordered_on) = CURDATE() And payment='1' and payment_type ='cash' AND store_id ='".$set_data->id."' ";
		$total_cash_earn = $this->comman_model->get_query($query2);

		$query2 = "SELECT SUM(`total`) AS Amount  FROM user_orders WHERE DATE(ordered_on) = CURDATE() And payment='1' and payment_type ='paypal' AND store_id ='".$set_data->id."' ";
		$total_paypal_earn = $this->comman_model->get_query($query2);

		$query2 = "SELECT SUM(`total`) AS Amount  FROM user_orders WHERE DATE(ordered_on) = CURDATE() And payment='1' AND store_id ='".$set_data->id."' ";
		$total_earn = $this->comman_model->get_query($query2);
	}
	else{	
		$this->db->select_sum('total','Amount');
		$total_paypal_earn = $this->comman_model->get_by('user_orders',array('payment'=>1,'payment_type'=>'paypal','store_id'=>$set_data->id),false,false,false);

		$this->db->select_sum('total','Amount');
		$total_cash_earn = $this->comman_model->get_by('user_orders',array('payment'=>1,'payment_type'=>'cash','store_id'=>$set_data->id),false,false,false);

		$this->db->select_sum('total','Amount');
		$total_earn = $this->comman_model->get_by('user_orders',array('payment'=>1,'store_id'=>$set_data->id),false,false,false);
	}

	if($total_earn){
		$TotalAmount = numberFormat($total_earn[0]->Amount);
	}
	else{
		$TotalAmount = 0.00;
	}

	if($total_cash_earn){
		$TotalCash = numberFormat($total_cash_earn[0]->Amount);
	}
	else{
		$TotalCash = 0.00;
	}

	if($total_paypal_earn){
		$TotalPaypal = numberFormat($total_paypal_earn[0]->Amount);
	}
	else{
		$TotalPaypal = 0.00;
	}
?>
                    <tr>
                        <td><?=$set_data->name;?></td>
                        <td><?=$userName;?></td>
<!--                        <td><?='&pound;'.$TotalAmount?></td>-->
                        <td><?='&pound;'.$TotalCash?></td>
                        <td><?='&pound;'.$TotalPaypal?></td>
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


<script>
function confirm_box(){
    var answer = confirm ("<?=show_static_text($adminLangSession['lang_id'],265);?>");
    if (!answer)
     return false;
}
</script>