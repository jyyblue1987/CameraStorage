<?php
$todayMonth = date('M');

?>
<?php
$year_amount = $month_amount =0;
$string = "SELECT SUM(amount) as amount FROM camera_payment WHERE payment = 1 and is_refund=0 and owner_id =".$this->data['user_details']->id." AND MONTH(on_date) = '".date('m')."' AND YEAR(on_date)='".date('Y')."' GROUP BY YEAR(on_date) AND MONTH(on_date);";
$month_result = $this->comman_model->get_query($string,true);
if($month_result){
	$month_amount = round($month_result->amount,2);
}

$string = "SELECT SUM(amount) as amount FROM camera_payment WHERE payment = 1 and is_refund=0 and owner_id =".$this->data['user_details']->id." AND  YEAR(on_date)='".date('Y')."' GROUP BY YEAR(on_date)";
$month_result = $this->comman_model->get_query($string,true);
if($month_result){
	$year_amount = round($month_result->amount,2);
}
?>
<style>
.panel-body p{
	font-size:16px;
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
        <div class="col-md-12">
<p>You must make your payment to iLink Professionals, Inc. for this service on the 1st of each month. Failure to pay by the 5th of each month will suspend your service without any notifications and a $50 reactivation fee will be required. It is the dealer’s responsibility to keep the account current.</p>
<br>
<p>Total payment received from your client(s) for $<?=$month_amount?> (<?=date('M')?>) / $<?=$year_amount?> (<?=date('Y')?>)</p>

<p>Total payment due to iLink Professionals, Inc. for $<?=$this->data['user_details']->debt_point?> (<?=date('M', strtotime('last month'))?>) <button type="button" class="btn btn-primary" onclick="window.location='<?=$_cancel.'/get_update'?>'">Make Payment</button></p>

<br>
<p>Failure to reactivate your suspended account by 15th of the month may result in complete termination of your account without any notification and all your clients as well as the videos from all the cameras may be permanently deleted without any recovery option.
<br>
<br>Even though it is a dealer’s responsibility to keep the account current, we may try to send a warning email from the email address “No-Reply@MyOnlineCameras.com”, so please add this email address to your email white list to avoid emails going into junk mail.  iLink Professionals, Inc. is not responsible for sending warning emails or contacting for any outstanding balance

</p>

	
            </div>
        </div>
        <!-- end panel -->
    </div>
</div>

