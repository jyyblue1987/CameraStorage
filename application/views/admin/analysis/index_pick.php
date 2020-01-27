<?php
$nowTime =time();

?>
<style>
.sidebar {
  left: -250px;
  top:54px;
  padding-top: 0;
  position: absolute;
  z-index: 1030;
}
.sidebar-bg {
  left: -250px;
  top:54px;
  z-index: 1020;
}

.navbar-toggle{
	display:block;
}
.page-sidebar-toggled .sidebar-bg {
  animation: 0.2s ease 0s normal none 1 running sidebarSlideInLeft;
  background: #2d353c none repeat scroll 0 0;
  left: 0;
  position: fixed;
}
.page-sidebar-toggled .sidebar {
  animation: 0.2s ease 0s normal none 1 running sidebarSlideInLeft;
  left: 0;
}
.content{
	margin-left:0px;
}

</style>
<?php
$getUrlData = parse_url($_SERVER['REQUEST_URI']);
?>
<!--<script>
$(document).ready(function() {
	$('[data-click=sidebar-minify]').trigger("click");
});
</script>-->
<style>
table tr th,table tr td{
	padding:2px !important; 
	text-align:center;
}
.panel-body{
	padding:10px 3px;
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
	<div class="panel-body" style="padding:0px">
<?php echo validation_errors();?>
<form class="form-horizontal"  mothed="get" action="">
<input type="hidden" name="type" value="pickup" />
<div class="form-body">                    
	<div class="col-md-12">						                        
        <div class="form-group">
          <label class="col-lg-2 control-label">Hotel</label>
          <div class="col-lg-3">

            <select class="form-control" name="hotel_id" id="select_category"   required>
                <option value="" >Select</option>
<?php

$getStore = $this->input->get('hotel_id');
if(isset($hotel_data)&&!empty($hotel_data)){
foreach($hotel_data as $setCategory){
?>
<option value="<?=$setCategory->id;?>" <?=(!empty($getStore)&&$getStore==$setCategory->id)?'selected="selected"':'' ;?>   ><?=$setCategory->name;?></option>
<?php
}
}
?>

            </select>
          </div>
<!--          <label class="col-lg-1 control-label">Year</label>
          <div class="col-lg-1">
            <select class="form-control" name="year" id="select_category"   required>
                <option value="" >Select</option>
<?php
$getYear = $this->input->get('year');

for($setY = date('Y',strtotime('-1 year', $nowTime));$setY>=date('Y',strtotime('-5 year', $nowTime));$setY--){
?>
<option value="<?=$setY;?>" <?=(!empty($getYear)&&$getYear==$setY)?'selected="selected"':'' ;?>   ><?=$setY;?></option>
<?php

}
?>

            </select>
          </div>-->
          <label class="col-lg-1 control-label">Date</label>
          <div class="col-lg-3">
            <!--<select class="form-control" name="gDate" id="select_category"   required>
                <option value="" >Select</option>
<?php
$getDate = $this->input->get('gDate');
for($setY =1;$setY<=31;$setY++){
?>
<option value="<?=$setY;?>" <?=(!empty($getDate)&&$getDate==$setY)?'selected="selected"':'' ;?>   ><?=$setY;?></option>
<?php

}
?>

            </select>-->
            <input class="form-control" type="text" id="best_sellers_start" placeholder="Date" name="gDate"  data-date-format="dd-mm-yyyy" value="<?=$this->input->get('gDate');?>" />
          </div>
          <div class="col-md-1">
			  <?=form_submit('submit', 'Enter', 'class="btn btn-primary"')?>
          </div>
        </div>
</div>
</div>	                 
</form>
            </div>
<?php
if(isset($s_hotel_data)&&!empty($s_hotel_data)){
?>
<ul class="nav nav-tabs">
    <li class=""><a href="<?=$_cancel.'?hotel_id='.$this->input->get('hotel_id').'&type=';?>">Year Analysis</a></li>
    <li class=""><a href="<?=$_cancel.'?hotel_id='.$this->input->get('hotel_id').'&type=price_analysis';?>">Price Room Analysis</a></li>
    <li class=""><a href="<?=$_cancel.'?hotel_id='.$this->input->get('hotel_id').'&type=comparison_engine';?>">Comparison Engine</a></li>
    <li class="active"><a href="javascript:void(0);">Pick2016</a></li>
</ul>	    

<div class="tab-content" style="padding:10px 0">
    <div id="step-2" class="tab-pane fade active in">
	    <div class="table-responsive">
<?php
//echo $query = "SELECT date, DAY(DATE)AS d, MONTH(DATE) AS m,YEAR(DATE) AS Y  FROM stores_booking where store_id= ".$s_hotel_data->id." AND YEAR(DATE)='".date('Y')."' GROUP BY Y,m,d ORDER BY  date ,Y,m,d asc";
$query = "SELECT date, DAY(DATE)AS d, MONTH(DATE) AS m,YEAR(DATE) AS Y  FROM stores_booking where store_id= ".$s_hotel_data->id." AND YEAR(DATE)='".date('Y')."' GROUP BY Y,m,d ORDER BY  date ,Y,m,d asc";
$getuploadsdate = $this->comman_model->get_query($query);

//die;
?>
<table id="myTable" class="table table-striped table-bordered table-responsive ">
<thead>
<tr>
  <th colspan="7" style="text-align:center">January</th>
</tr>
<tr>
    <th colspan="" style="text-align:center">Date</th>
   <th colspan="" style="text-align:center">Room On Date</th>
   <th colspan="" style="text-align:center">Price On Date</th>
   <th colspan="" style="text-align:center">Room On ToDay</th>
   <th colspan="" style="text-align:center">Price On ToDay</th>
   <th colspan="" style="text-align:center">Price Difference</th>
   <th colspan="" style="text-align:center">Room Difference</th>
</tr>

</thead>
<tbody>
<?php
$allDate  = getallDate('2016');
if($allDate){
	$ToTotalRoom =0;
	$ToTotalPrice =0;
	$PTotalRoom =0;
	$PTtotalPrice =0;
	foreach($allDate as $setD){
		$expDate = explode('-',$setD);

if($expDate[1]==1){
		$PTempRoom =0;
		$PTempPrice =0;
		$ToTempRoom =0;
		$ToTempPrice =0;
$query = "SELECT `price` ,`room` FROM (`stores_booking`) WHERE store_id= ".$s_hotel_data->id."  AND DAY(`on_date`) = '".$expDate[2]."' AND YEAR(`on_date`) = '".date('Y')."' AND  MONTH(`on_date`) = '".$expDate[1]."' AND YEAR(DATE)='".date('Y')."' order by date desc";
$getData = $this->comman_model->get_query($query);
if(!empty($getData)&&isset($getData[0])){
	$ToTempRoom = $getData[0]->room;
	$ToTempPrice = $getData[0]->price;

	$ToTotalRoom = $ToTotalRoom+$getData[0]->room;
	$ToTotalPrice = $ToTotalPrice+$getData[0]->price;

}

if(isset($date_file_data)&&!empty($date_file_data)){
	$query = "SELECT `price` ,`room`, YEAR(on_date) AS Y  FROM (`stores_booking`) WHERE store_id= ".$s_hotel_data->id."  AND DAY(`on_date`) = '".$expDate[2]."' AND YEAR(`on_date`) = '".date('Y')."' AND  MONTH(`on_date`) = '".$expDate[1]."' AND date='".date('Y-m-d',strtotime($this->input->get('gDate')))."' AND  YEAR(on_date) ='".date('Y')."'  GROUP BY Y";
	$getData = $this->comman_model->get_query($query);
	if(!empty($getData)&&isset($getData[0])){
		$PTempRoom = $getData[0]->room;
		$PTempPrice = $getData[0]->price;

		$PTotalRoom = $PTotalRoom+$getData[0]->room;
		$PTotalPrice = $PTotalPrice+$getData[0]->price;
	}
}
?>
<tr>
<td ><?=date("d-m-Y", strtotime($setD))?></td>
<td><?=$PTempRoom;?></td>
<td><?=round($PTempPrice,2);?></td>
<td><?=$ToTempRoom;?></td>
<td><?=round($ToTempPrice,2);?></td>
<td><?=round($ToTempPrice-$PTempPrice,2);?></td>
<td style=" <?=($ToTempRoom-$PTempRoom)>=0?'color:#090;':'color:#F00;'?>"><?=$ToTempRoom-$PTempRoom;?></td>
</tr>

<?php
		}
	}
?>
<tr>
<td >TOTALE</td>
<td><?=$PTotalRoom;?></td>
<td><?=round($PTotalPrice,2);?></td>
<td><?=$ToTotalRoom;?></td>
<td><?=round($ToTotalPrice,2);?></td>
<td><?=round($PTotalPrice-$PTotalPrice,2);?></td>
<td style=" <?=($ToTotalRoom-$PTotalRoom)>=0?'color:#090;':'color:#F00;'?>"><?=$ToTotalRoom-$PTotalRoom;?></td>
</tr>

<?php
}
?>





</tbody>
</table>

</div>
<div class="table-responsive">
<table id="myTable" class="table table-striped table-bordered table-responsive ">
<thead>
<tr>
  <th colspan="7" style="text-align:center">February</th>
</tr>
<tr>
    <th colspan="" style="text-align:center">Date</th>
   <th colspan="" style="text-align:center">Room On Date</th>
   <th colspan="" style="text-align:center">Price On Date</th>
   <th colspan="" style="text-align:center">Room On ToDay</th>
   <th colspan="" style="text-align:center">Price On ToDay</th>
   <th colspan="" style="text-align:center">Price Difference</th>
   <th colspan="" style="text-align:center">Room Difference</th>
</tr>

</thead>
<tbody>
<?php
$allDate  = getallDate('2016');
if($allDate){
	$ToTotalRoom =0;
	$ToTotalPrice =0;
	$PTotalRoom =0;
	$PTtotalPrice =0;
foreach($allDate as $setD){
		$expDate = explode('-',$setD);
		if($expDate[1]==2){
		$PTempRoom =0;
		$PTempPrice =0;
		$ToTempRoom =0;
		$ToTempPrice =0;
$query = "SELECT `price` ,`room` FROM (`stores_booking`) WHERE store_id= ".$s_hotel_data->id."  AND DAY(`on_date`) = '".$expDate[2]."' AND YEAR(`on_date`) = '".date('Y')."' AND  MONTH(`on_date`) = '".$expDate[1]."' AND YEAR(DATE)='".date('Y')."' order by date desc";
$getData = $this->comman_model->get_query($query);
if(!empty($getData)&&isset($getData[0])){
	$ToTempRoom = $getData[0]->room;
	$ToTempPrice = $getData[0]->price;

	$ToTotalRoom = $ToTotalRoom+$getData[0]->room;
	$ToTotalPrice = $ToTotalPrice+$getData[0]->price;

}

if(isset($date_file_data)&&!empty($date_file_data)){
	$query = "SELECT `price` ,`room`, YEAR(on_date) AS Y  FROM (`stores_booking`) WHERE store_id= ".$s_hotel_data->id."  AND DAY(`on_date`) = '".$expDate[2]."' AND YEAR(`on_date`) = '".date('Y')."' AND  MONTH(`on_date`) = '".$expDate[1]."' AND date='".date('Y-m-d',strtotime($this->input->get('gDate')))."' AND  YEAR(on_date) ='".date('Y')."'  GROUP BY Y";
	$getData = $this->comman_model->get_query($query);
	if(!empty($getData)&&isset($getData[0])){
		$PTempRoom = $getData[0]->room;
		$PTempPrice = $getData[0]->price;

		$PTotalRoom = $PTotalRoom+$getData[0]->room;
		$PTotalPrice = $PTotalPrice+$getData[0]->price;
	}
}
?>
<tr>
<td ><?=date("d-m-Y", strtotime($setD))?></td>
<td><?=$PTempRoom;?></td>
<td><?=round($PTempPrice,2);?></td>
<td><?=$ToTempRoom;?></td>
<td><?=round($ToTempPrice,2);?></td>
<td><?=round($ToTempPrice-$PTempPrice,2);?></td>
<td style=" <?=($ToTempRoom-$PTempRoom)>=0?'color:#090;':'color:#F00;'?>"><?=$ToTempRoom-$PTempRoom;?></td>
</tr>

<?php
		}
	}
}
?>





</tbody>
</table>

</div>
<div class="table-responsive">
<?php
$query = "SELECT date, DAY(DATE)AS d, MONTH(DATE) AS m,YEAR(DATE) AS Y  FROM stores_booking where store_id= ".$s_hotel_data->id." GROUP BY Y,m,d ORDER BY  Y,m,d asc";
$getuploadsdate = $this->comman_model->get_query($query);
?>
<table id="myTable" class="table table-striped table-bordered table-responsive ">
<thead>
<tr>
  <th colspan="7" style="text-align:center">March</th>
</tr>
<tr>
    <th colspan="" style="text-align:center">Date</th>
   <th colspan="" style="text-align:center">Room On Date</th>
   <th colspan="" style="text-align:center">Price On Date</th>
   <th colspan="" style="text-align:center">Room On ToDay</th>
   <th colspan="" style="text-align:center">Price On ToDay</th>
   <th colspan="" style="text-align:center">Price Difference</th>
   <th colspan="" style="text-align:center">Room Difference</th>
</tr>

</thead>
<tbody>
<?php
$allDate  = getallDate('2016');
if($allDate){
	$ToTotalRoom =0;
	$ToTotalPrice =0;
	$PTotalRoom =0;
	$PTtotalPrice =0;
	foreach($allDate as $setD){
		$expDate = explode('-',$setD);
		if($expDate[1]==3){
		$PTempRoom =0;
		$PTempPrice =0;
		$ToTempRoom =0;
		$ToTempPrice =0;
$query = "SELECT `price` ,`room` FROM (`stores_booking`) WHERE store_id= ".$s_hotel_data->id."  AND DAY(`on_date`) = '".$expDate[2]."' AND YEAR(`on_date`) = '".date('Y')."' AND  MONTH(`on_date`) = '".$expDate[1]."' AND YEAR(DATE)='".date('Y')."' order by date desc";
$getData = $this->comman_model->get_query($query);
if(!empty($getData)&&isset($getData[0])){
	$ToTempRoom = $getData[0]->room;
	$ToTempPrice = $getData[0]->price;

	$ToTotalRoom = $ToTotalRoom+$getData[0]->room;
	$ToTotalPrice = $ToTotalPrice+$getData[0]->price;

}

if(isset($date_file_data)&&!empty($date_file_data)){
	$query = "SELECT `price` ,`room`, YEAR(on_date) AS Y  FROM (`stores_booking`) WHERE store_id= ".$s_hotel_data->id."  AND DAY(`on_date`) = '".$expDate[2]."' AND YEAR(`on_date`) = '".date('Y')."' AND  MONTH(`on_date`) = '".$expDate[1]."' AND date='".date('Y-m-d',strtotime($this->input->get('gDate')))."' AND  YEAR(on_date) ='".date('Y')."'  GROUP BY Y";
	$getData = $this->comman_model->get_query($query);
	if(!empty($getData)&&isset($getData[0])){
		$PTempRoom = $getData[0]->room;
		$PTempPrice = $getData[0]->price;

		$PTotalRoom = $PTotalRoom+$getData[0]->room;
		$PTotalPrice = $PTotalPrice+$getData[0]->price;
	}
}
?>
<tr>
<td ><?=date("d-m-Y", strtotime($setD))?></td>
<td><?=$PTempRoom;?></td>
<td><?=round($PTempPrice,2);?></td>
<td><?=$ToTempRoom;?></td>
<td><?=round($ToTempPrice,2);?></td>
<td><?=round($ToTempPrice-$PTempPrice,2);?></td>
<td style=" <?=($ToTempRoom-$PTempRoom)>=0?'color:#090;':'color:#F00;'?>"><?=$ToTempRoom-$PTempRoom;?></td>
</tr>

<?php
		}
	}
}
?>





</tbody>
</table>

</div>
<div class="table-responsive">
<?php
$query = "SELECT date, DAY(DATE)AS d, MONTH(DATE) AS m,YEAR(DATE) AS Y  FROM stores_booking where store_id= ".$s_hotel_data->id." GROUP BY Y,m,d ORDER BY  Y,m,d asc";
$getuploadsdate = $this->comman_model->get_query($query);
?>
<table id="myTable" class="table table-striped table-bordered table-responsive ">
<thead>
<tr>
  <th colspan="7" style="text-align:center">April</th>
</tr>
<tr>
    <th colspan="" style="text-align:center">Date</th>
   <th colspan="" style="text-align:center">Room On Date</th>
   <th colspan="" style="text-align:center">Price On Date</th>
   <th colspan="" style="text-align:center">Room On ToDay</th>
   <th colspan="" style="text-align:center">Price On ToDay</th>
   <th colspan="" style="text-align:center">Price Difference</th>
   <th colspan="" style="text-align:center">Room Difference</th>
</tr>

</thead>
<tbody>
<?php
$allDate  = getallDate('2016');
if($allDate){
	$ToTotalRoom =0;
	$ToTotalPrice =0;
	$PTotalRoom =0;
	$PTtotalPrice =0;
foreach($allDate as $setD){
		$expDate = explode('-',$setD);
		if($expDate[1]==4){
		$PTempRoom =0;
		$PTempPrice =0;
		$ToTempRoom =0;
		$ToTempPrice =0;
$query = "SELECT `price` ,`room` FROM (`stores_booking`) WHERE store_id= ".$s_hotel_data->id."  AND DAY(`on_date`) = '".$expDate[2]."' AND YEAR(`on_date`) = '".date('Y')."' AND  MONTH(`on_date`) = '".$expDate[1]."' AND YEAR(DATE)='".date('Y')."' order by date desc";
$getData = $this->comman_model->get_query($query);
if(!empty($getData)&&isset($getData[0])){
	$ToTempRoom = $getData[0]->room;
	$ToTempPrice = $getData[0]->price;

	$ToTotalRoom = $ToTotalRoom+$getData[0]->room;
	$ToTotalPrice = $ToTotalPrice+$getData[0]->price;

}

if(isset($date_file_data)&&!empty($date_file_data)){
	$query = "SELECT `price` ,`room`, YEAR(on_date) AS Y  FROM (`stores_booking`) WHERE store_id= ".$s_hotel_data->id."  AND DAY(`on_date`) = '".$expDate[2]."' AND YEAR(`on_date`) = '".date('Y')."' AND  MONTH(`on_date`) = '".$expDate[1]."' AND date='".date('Y-m-d',strtotime($this->input->get('gDate')))."' AND  YEAR(on_date) ='".date('Y')."'  GROUP BY Y";
	$getData = $this->comman_model->get_query($query);
	if(!empty($getData)&&isset($getData[0])){
		$PTempRoom = $getData[0]->room;
		$PTempPrice = $getData[0]->price;

		$PTotalRoom = $PTotalRoom+$getData[0]->room;
		$PTotalPrice = $PTotalPrice+$getData[0]->price;
	}
}
?>
<tr>
<td ><?=date("d-m-Y", strtotime($setD))?></td>
<td><?=$PTempRoom;?></td>
<td><?=round($PTempPrice,2);?></td>
<td><?=$ToTempRoom;?></td>
<td><?=round($ToTempPrice,2);?></td>
<td><?=round($ToTempPrice-$PTempPrice,2);?></td>
<td style=" <?=($ToTempRoom-$PTempRoom)>=0?'color:#090;':'color:#F00;'?>"><?=$ToTempRoom-$PTempRoom;?></td>
</tr>

<?php
		}
	}
}
?>





</tbody>
</table>

</div>
<div class="table-responsive">
<?php
$query = "SELECT date, DAY(DATE)AS d, MONTH(DATE) AS m,YEAR(DATE) AS Y  FROM stores_booking where store_id= ".$s_hotel_data->id." GROUP BY Y,m,d ORDER BY  Y,m,d asc";
$getuploadsdate = $this->comman_model->get_query($query);
?>
<table id="myTable" class="table table-striped table-bordered table-responsive ">
<thead>
<tr>
  <th colspan="7" style="text-align:center">May</th>
</tr>
<tr>
    <th colspan="" style="text-align:center">Date</th>
   <th colspan="" style="text-align:center">Room On Date</th>
   <th colspan="" style="text-align:center">Price On Date</th>
   <th colspan="" style="text-align:center">Room On ToDay</th>
   <th colspan="" style="text-align:center">Price On ToDay</th>
   <th colspan="" style="text-align:center">Price Difference</th>
   <th colspan="" style="text-align:center">Room Difference</th>
</tr>

</thead>
<tbody>
<?php
$allDate  = getallDate('2016');
if($allDate){
	$ToTotalRoom =0;
	$ToTotalPrice =0;
	$PTotalRoom =0;
	$PTtotalPrice =0;

	foreach($allDate as $setD){
		$expDate = explode('-',$setD);
		if($expDate[1]==5){
		$PTempRoom =0;
		$PTempPrice =0;
		$ToTempRoom =0;
		$ToTempPrice =0;
$query = "SELECT `price` ,`room` FROM (`stores_booking`) WHERE store_id= ".$s_hotel_data->id."  AND DAY(`on_date`) = '".$expDate[2]."' AND YEAR(`on_date`) = '".date('Y')."' AND  MONTH(`on_date`) = '".$expDate[1]."' AND YEAR(DATE)='".date('Y')."' order by date desc";
$getData = $this->comman_model->get_query($query);
if(!empty($getData)&&isset($getData[0])){
	$ToTempRoom = $getData[0]->room;
	$ToTempPrice = $getData[0]->price;

	$ToTotalRoom = $ToTotalRoom+$getData[0]->room;
	$ToTotalPrice = $ToTotalPrice+$getData[0]->price;

}

if(isset($date_file_data)&&!empty($date_file_data)){
	$query = "SELECT `price` ,`room`, YEAR(on_date) AS Y  FROM (`stores_booking`) WHERE store_id= ".$s_hotel_data->id."  AND DAY(`on_date`) = '".$expDate[2]."' AND YEAR(`on_date`) = '".date('Y')."' AND  MONTH(`on_date`) = '".$expDate[1]."' AND date='".date('Y-m-d',strtotime($this->input->get('gDate')))."' AND  YEAR(on_date) ='".date('Y')."'  GROUP BY Y";
	$getData = $this->comman_model->get_query($query);
	if(!empty($getData)&&isset($getData[0])){
		$PTempRoom = $getData[0]->room;
		$PTempPrice = $getData[0]->price;

		$PTotalRoom = $PTotalRoom+$getData[0]->room;
		$PTotalPrice = $PTotalPrice+$getData[0]->price;
	}
}
?>
<tr>
<td ><?=date("d-m-Y", strtotime($setD))?></td>
<td><?=$PTempRoom;?></td>
<td><?=round($PTempPrice,2);?></td>
<td><?=$ToTempRoom;?></td>
<td><?=round($ToTempPrice,2);?></td>
<td><?=round($ToTempPrice-$PTempPrice,2);?></td>
<td style=" <?=($ToTempRoom-$PTempRoom)>=0?'color:#090;':'color:#F00;'?>"><?=$ToTempRoom-$PTempRoom;?></td>
</tr>

<?php
		}
	}
}
?>





</tbody>
</table>

</div>
<div class="table-responsive">
<?php
$query = "SELECT date, DAY(DATE)AS d, MONTH(DATE) AS m,YEAR(DATE) AS Y  FROM stores_booking where store_id= ".$s_hotel_data->id." GROUP BY Y,m,d ORDER BY  Y,m,d asc";
$getuploadsdate = $this->comman_model->get_query($query);
?>
<table id="myTable" class="table table-striped table-bordered table-responsive ">
<thead>
<tr>
  <th colspan="7" style="text-align:center">June</th>
</tr>
<tr>
    <th colspan="" style="text-align:center">Date</th>
   <th colspan="" style="text-align:center">Room On Date</th>
   <th colspan="" style="text-align:center">Price On Date</th>
   <th colspan="" style="text-align:center">Room On ToDay</th>
   <th colspan="" style="text-align:center">Price On ToDay</th>
   <th colspan="" style="text-align:center">Price Difference</th>
   <th colspan="" style="text-align:center">Room Difference</th>
</tr>

</thead>
<tbody>
<?php
$allDate  = getallDate('2016');
if($allDate){
	$ToTotalRoom =0;
	$ToTotalPrice =0;
	$PTotalRoom =0;
	$PTtotalPrice =0;

	foreach($allDate as $setD){
		$expDate = explode('-',$setD);
		if($expDate[1]==6){
		$PTempRoom =0;
		$PTempPrice =0;
		$ToTempRoom =0;
		$ToTempPrice =0;
$query = "SELECT `price` ,`room` FROM (`stores_booking`) WHERE store_id= ".$s_hotel_data->id."  AND DAY(`on_date`) = '".$expDate[2]."' AND YEAR(`on_date`) = '".date('Y')."' AND  MONTH(`on_date`) = '".$expDate[1]."' AND YEAR(DATE)='".date('Y')."' order by date desc";
$getData = $this->comman_model->get_query($query);
if(!empty($getData)&&isset($getData[0])){
	$ToTempRoom = $getData[0]->room;
	$ToTempPrice = $getData[0]->price;

	$ToTotalRoom = $ToTotalRoom+$getData[0]->room;
	$ToTotalPrice = $ToTotalPrice+$getData[0]->price;

}

if(isset($date_file_data)&&!empty($date_file_data)){
	$query = "SELECT `price` ,`room`, YEAR(on_date) AS Y  FROM (`stores_booking`) WHERE store_id= ".$s_hotel_data->id."  AND DAY(`on_date`) = '".$expDate[2]."' AND YEAR(`on_date`) = '".date('Y')."' AND  MONTH(`on_date`) = '".$expDate[1]."' AND date='".date('Y-m-d',strtotime($this->input->get('gDate')))."' AND  YEAR(on_date) ='".date('Y')."'  GROUP BY Y";
	$getData = $this->comman_model->get_query($query);
	if(!empty($getData)&&isset($getData[0])){
		$PTempRoom = $getData[0]->room;
		$PTempPrice = $getData[0]->price;

		$PTotalRoom = $PTotalRoom+$getData[0]->room;
		$PTotalPrice = $PTotalPrice+$getData[0]->price;
	}
}
?>
<tr>
<td ><?=date("d-m-Y", strtotime($setD))?></td>
<td><?=$PTempRoom;?></td>
<td><?=round($PTempPrice,2);?></td>
<td><?=$ToTempRoom;?></td>
<td><?=round($ToTempPrice,2);?></td>
<td><?=round($ToTempPrice-$PTempPrice,2);?></td>
<td style=" <?=($ToTempRoom-$PTempRoom)>=0?'color:#090;':'color:#F00;'?>"><?=$ToTempRoom-$PTempRoom;?></td>
</tr>

<?php
		}
	}
}
?>





</tbody>
</table>

</div>
<div class="table-responsive">
<table id="myTable" class="table table-striped table-bordered table-responsive ">
<thead>
<tr>
  <th colspan="7" style="text-align:center">July</th>
</tr>
<tr>
    <th colspan="" style="text-align:center">Date</th>
   <th colspan="" style="text-align:center">Room On Date</th>
   <th colspan="" style="text-align:center">Price On Date</th>
   <th colspan="" style="text-align:center">Room On ToDay</th>
   <th colspan="" style="text-align:center">Price On ToDay</th>
   <th colspan="" style="text-align:center">Price Difference</th>
   <th colspan="" style="text-align:center">Room Difference</th>
</tr>

</thead>
<tbody>
<?php
$allDate  = getallDate('2016');
if($allDate){
	$ToTotalRoom =0;
	$ToTotalPrice =0;
	$PTotalRoom =0;
	$PTtotalPrice =0;

	foreach($allDate as $setD){
		$expDate = explode('-',$setD);
		if($expDate[1]==7){
		$PTempRoom =0;
		$PTempPrice =0;
		$ToTempRoom =0;
		$ToTempPrice =0;
$query = "SELECT `price` ,`room` FROM (`stores_booking`) WHERE store_id= ".$s_hotel_data->id."  AND DAY(`on_date`) = '".$expDate[2]."' AND YEAR(`on_date`) = '".date('Y')."' AND  MONTH(`on_date`) = '".$expDate[1]."' AND YEAR(DATE)='".date('Y')."' order by date desc";
$getData = $this->comman_model->get_query($query);
if(!empty($getData)&&isset($getData[0])){
	$ToTempRoom = $getData[0]->room;
	$ToTempPrice = $getData[0]->price;

	$ToTotalRoom = $ToTotalRoom+$getData[0]->room;
	$ToTotalPrice = $ToTotalPrice+$getData[0]->price;

}

if(isset($date_file_data)&&!empty($date_file_data)){
	$query = "SELECT `price` ,`room`, YEAR(on_date) AS Y  FROM (`stores_booking`) WHERE store_id= ".$s_hotel_data->id."  AND DAY(`on_date`) = '".$expDate[2]."' AND YEAR(`on_date`) = '".date('Y')."' AND  MONTH(`on_date`) = '".$expDate[1]."' AND date='".date('Y-m-d',strtotime($this->input->get('gDate')))."' AND  YEAR(on_date) ='".date('Y')."'  GROUP BY Y";
	$getData = $this->comman_model->get_query($query);
	if(!empty($getData)&&isset($getData[0])){
		$PTempRoom = $getData[0]->room;
		$PTempPrice = $getData[0]->price;

		$PTotalRoom = $PTotalRoom+$getData[0]->room;
		$PTotalPrice = $PTotalPrice+$getData[0]->price;
	}
}
?>
<tr>
<td ><?=date("d-m-Y", strtotime($setD))?></td>
<td><?=$PTempRoom;?></td>
<td><?=round($PTempPrice,2);?></td>
<td><?=$ToTempRoom;?></td>
<td><?=round($ToTempPrice,2);?></td>
<td><?=round($ToTempPrice-$PTempPrice,2);?></td>
<td style=" <?=($ToTempRoom-$PTempRoom)>=0?'color:#090;':'color:#F00;'?>"><?=$ToTempRoom-$PTempRoom;?></td>
</tr>

<?php
		}
	}
}
?>





</tbody>
</table>

</div>
<div class="table-responsive">
<table id="myTable" class="table table-striped table-bordered table-responsive ">
<thead>
<tr>
  <th colspan="7" style="text-align:center">August</th>
</tr>
<tr>
    <th colspan="" style="text-align:center">Date</th>
   <th colspan="" style="text-align:center">Room On Date</th>
   <th colspan="" style="text-align:center">Price On Date</th>
   <th colspan="" style="text-align:center">Room On ToDay</th>
   <th colspan="" style="text-align:center">Price On ToDay</th>
   <th colspan="" style="text-align:center">Price Difference</th>
   <th colspan="" style="text-align:center">Room Difference</th>
</tr>

</thead>
<tbody>
<?php
$allDate  = getallDate('2016');
if($allDate){
	$ToTotalRoom =0;
	$ToTotalPrice =0;
	$PTotalRoom =0;
	$PTtotalPrice =0;

	foreach($allDate as $setD){
		$expDate = explode('-',$setD);
		if($expDate[1]==8){
		$PTempRoom =0;
		$PTempPrice =0;
		$ToTempRoom =0;
		$ToTempPrice =0;
$query = "SELECT `price` ,`room` FROM (`stores_booking`) WHERE store_id= ".$s_hotel_data->id."  AND DAY(`on_date`) = '".$expDate[2]."' AND YEAR(`on_date`) = '".date('Y')."' AND  MONTH(`on_date`) = '".$expDate[1]."' AND YEAR(DATE)='".date('Y')."' order by date desc";
$getData = $this->comman_model->get_query($query);
if(!empty($getData)&&isset($getData[0])){
	$ToTempRoom = $getData[0]->room;
	$ToTempPrice = $getData[0]->price;

	$ToTotalRoom = $ToTotalRoom+$getData[0]->room;
	$ToTotalPrice = $ToTotalPrice+$getData[0]->price;

}

if(isset($date_file_data)&&!empty($date_file_data)){
	$query = "SELECT `price` ,`room`, YEAR(on_date) AS Y  FROM (`stores_booking`) WHERE store_id= ".$s_hotel_data->id."  AND DAY(`on_date`) = '".$expDate[2]."' AND YEAR(`on_date`) = '".date('Y')."' AND  MONTH(`on_date`) = '".$expDate[1]."' AND date='".date('Y-m-d',strtotime($this->input->get('gDate')))."' AND  YEAR(on_date) ='".date('Y')."'  GROUP BY Y";
	$getData = $this->comman_model->get_query($query);
	if(!empty($getData)&&isset($getData[0])){
		$PTempRoom = $getData[0]->room;
		$PTempPrice = $getData[0]->price;

		$PTotalRoom = $PTotalRoom+$getData[0]->room;
		$PTotalPrice = $PTotalPrice+$getData[0]->price;
	}
}
?>
<tr>
<td ><?=date("d-m-Y", strtotime($setD))?></td>
<td><?=$PTempRoom;?></td>
<td><?=round($PTempPrice,2);?></td>
<td><?=$ToTempRoom;?></td>
<td><?=round($ToTempPrice,2);?></td>
<td><?=round($ToTempPrice-$PTempPrice,2);?></td>
<td style=" <?=($ToTempRoom-$PTempRoom)>=0?'color:#090;':'color:#F00;'?>"><?=$ToTempRoom-$PTempRoom;?></td>
</tr>

<?php
		}
	}
}
?>





</tbody>
</table>

</div>
<div class="table-responsive">
<?php
$query = "SELECT date, DAY(DATE)AS d, MONTH(DATE) AS m,YEAR(DATE) AS Y  FROM stores_booking where store_id= ".$s_hotel_data->id." GROUP BY Y,m,d ORDER BY  Y,m,d asc";
$getuploadsdate = $this->comman_model->get_query($query);
?>
<table id="myTable" class="table table-striped table-bordered table-responsive ">
<thead>
<tr>
  <th colspan="7" style="text-align:center">September</th>
</tr>
<tr>
    <th colspan="" style="text-align:center">Date</th>
   <th colspan="" style="text-align:center">Room On Date</th>
   <th colspan="" style="text-align:center">Price On Date</th>
   <th colspan="" style="text-align:center">Room On ToDay</th>
   <th colspan="" style="text-align:center">Price On ToDay</th>
   <th colspan="" style="text-align:center">Price Difference</th>
   <th colspan="" style="text-align:center">Room Difference</th>
</tr>

</thead>
<tbody>
<?php
$allDate  = getallDate('2016');
if($allDate){
	$ToTotalRoom =0;
	$ToTotalPrice =0;
	$PTotalRoom =0;
	$PTtotalPrice =0;

	foreach($allDate as $setD){
		$expDate = explode('-',$setD);
		if($expDate[1]==9){
		$PTempRoom =0;
		$PTempPrice =0;
		$ToTempRoom =0;
		$ToTempPrice =0;
$query = "SELECT `price` ,`room` FROM (`stores_booking`) WHERE store_id= ".$s_hotel_data->id."  AND DAY(`on_date`) = '".$expDate[2]."' AND YEAR(`on_date`) = '".date('Y')."' AND  MONTH(`on_date`) = '".$expDate[1]."' AND YEAR(DATE)='".date('Y')."' order by date desc";
$getData = $this->comman_model->get_query($query);
if(!empty($getData)&&isset($getData[0])){
	$ToTempRoom = $getData[0]->room;
	$ToTempPrice = $getData[0]->price;

	$ToTotalRoom = $ToTotalRoom+$getData[0]->room;
	$ToTotalPrice = $ToTotalPrice+$getData[0]->price;

}

if(isset($date_file_data)&&!empty($date_file_data)){
	$query = "SELECT `price` ,`room`, YEAR(on_date) AS Y  FROM (`stores_booking`) WHERE store_id= ".$s_hotel_data->id."  AND DAY(`on_date`) = '".$expDate[2]."' AND YEAR(`on_date`) = '".date('Y')."' AND  MONTH(`on_date`) = '".$expDate[1]."' AND date='".date('Y-m-d',strtotime($this->input->get('gDate')))."' AND  YEAR(on_date) ='".date('Y')."'  GROUP BY Y";
	$getData = $this->comman_model->get_query($query);
	if(!empty($getData)&&isset($getData[0])){
		$PTempRoom = $getData[0]->room;
		$PTempPrice = $getData[0]->price;

		$PTotalRoom = $PTotalRoom+$getData[0]->room;
		$PTotalPrice = $PTotalPrice+$getData[0]->price;
	}
}
?>
<tr>
<td ><?=date("d-m-Y", strtotime($setD))?></td>
<td><?=$PTempRoom;?></td>
<td><?=round($PTempPrice,2);?></td>
<td><?=$ToTempRoom;?></td>
<td><?=round($ToTempPrice,2);?></td>
<td><?=round($ToTempPrice-$PTempPrice,2);?></td>
<td style=" <?=($ToTempRoom-$PTempRoom)>=0?'color:#090;':'color:#F00;'?>"><?=$ToTempRoom-$PTempRoom;?></td>
</tr>

<?php
		}
	}
}
?>





</tbody>
</table>

</div>
<div class="table-responsive">
<?php
$query = "SELECT date, DAY(DATE)AS d, MONTH(DATE) AS m,YEAR(DATE) AS Y  FROM stores_booking where store_id= ".$s_hotel_data->id." GROUP BY Y,m,d ORDER BY  Y,m,d asc";
$getuploadsdate = $this->comman_model->get_query($query);
?>
<table id="myTable" class="table table-striped table-bordered table-responsive ">
<thead>
<tr>
  <th colspan="7" style="text-align:center">October</th>
</tr>
<tr>
    <th colspan="" style="text-align:center">Date</th>
   <th colspan="" style="text-align:center">Room On Date</th>
   <th colspan="" style="text-align:center">Price On Date</th>
   <th colspan="" style="text-align:center">Room On ToDay</th>
   <th colspan="" style="text-align:center">Price On ToDay</th>
   <th colspan="" style="text-align:center">Price Difference</th>
   <th colspan="" style="text-align:center">Room Difference</th>
</tr>

</thead>
<tbody>
<?php
$allDate  = getallDate('2016');
if($allDate){
	$ToTotalRoom =0;
	$ToTotalPrice =0;
	$PTotalRoom =0;
	$PTtotalPrice =0;

	foreach($allDate as $setD){
		$expDate = explode('-',$setD);
		if($expDate[1]==10){
		$PTempRoom =0;
		$PTempPrice =0;
		$ToTempRoom =0;
		$ToTempPrice =0;
$query = "SELECT `price` ,`room` FROM (`stores_booking`) WHERE store_id= ".$s_hotel_data->id."  AND DAY(`on_date`) = '".$expDate[2]."' AND YEAR(`on_date`) = '".date('Y')."' AND  MONTH(`on_date`) = '".$expDate[1]."' AND YEAR(DATE)='".date('Y')."' order by date desc";
$getData = $this->comman_model->get_query($query);
if(!empty($getData)&&isset($getData[0])){
	$ToTempRoom = $getData[0]->room;
	$ToTempPrice = $getData[0]->price;

	$ToTotalRoom = $ToTotalRoom+$getData[0]->room;
	$ToTotalPrice = $ToTotalPrice+$getData[0]->price;

}

if(isset($date_file_data)&&!empty($date_file_data)){
	$query = "SELECT `price` ,`room`, YEAR(on_date) AS Y  FROM (`stores_booking`) WHERE store_id= ".$s_hotel_data->id."  AND DAY(`on_date`) = '".$expDate[2]."' AND YEAR(`on_date`) = '".date('Y')."' AND  MONTH(`on_date`) = '".$expDate[1]."' AND date='".date('Y-m-d',strtotime($this->input->get('gDate')))."' AND  YEAR(on_date) ='".date('Y')."'  GROUP BY Y";
	$getData = $this->comman_model->get_query($query);
	if(!empty($getData)&&isset($getData[0])){
		$PTempRoom = $getData[0]->room;
		$PTempPrice = $getData[0]->price;

		$PTotalRoom = $PTotalRoom+$getData[0]->room;
		$PTotalPrice = $PTotalPrice+$getData[0]->price;
	}
}
?>
<tr>
<td ><?=date("d-m-Y", strtotime($setD))?></td>
<td><?=$PTempRoom;?></td>
<td><?=round($PTempPrice,2);?></td>
<td><?=$ToTempRoom;?></td>
<td><?=round($ToTempPrice,2);?></td>
<td><?=round($ToTempPrice-$PTempPrice,2);?></td>
<td style=" <?=($ToTempRoom-$PTempRoom)>=0?'color:#090;':'color:#F00;'?>"><?=$ToTempRoom-$PTempRoom;?></td>
</tr>

<?php
		}
	}
}
?>





</tbody>
</table>

</div>
<div class="table-responsive">
<?php
$query = "SELECT date, DAY(DATE)AS d, MONTH(DATE) AS m,YEAR(DATE) AS Y  FROM stores_booking where store_id= ".$s_hotel_data->id." GROUP BY Y,m,d ORDER BY  Y,m,d asc";
$getuploadsdate = $this->comman_model->get_query($query);
?>
<table id="myTable" class="table table-striped table-bordered table-responsive ">
<thead>
<tr>
  <th colspan="7" style="text-align:center">November</th>
</tr>
<tr>
    <th colspan="" style="text-align:center">Date</th>
   <th colspan="" style="text-align:center">Room On Date</th>
   <th colspan="" style="text-align:center">Price On Date</th>
   <th colspan="" style="text-align:center">Room On ToDay</th>
   <th colspan="" style="text-align:center">Price On ToDay</th>
   <th colspan="" style="text-align:center">Price Difference</th>
   <th colspan="" style="text-align:center">Room Difference</th>
</tr>

</thead>
<tbody>
<?php
$allDate  = getallDate('2016');
if($allDate){
	$ToTotalRoom =0;
	$ToTotalPrice =0;
	$PTotalRoom =0;
	$PTtotalPrice =0;

	foreach($allDate as $setD){
		$expDate = explode('-',$setD);
		if($expDate[1]==11){
		$PTempRoom =0;
		$PTempPrice =0;
		$ToTempRoom =0;
		$ToTempPrice =0;
$query = "SELECT `price` ,`room` FROM (`stores_booking`) WHERE store_id= ".$s_hotel_data->id."  AND DAY(`on_date`) = '".$expDate[2]."' AND YEAR(`on_date`) = '".date('Y')."' AND  MONTH(`on_date`) = '".$expDate[1]."' AND YEAR(DATE)='".date('Y')."' order by date desc";
$getData = $this->comman_model->get_query($query);
if(!empty($getData)&&isset($getData[0])){
	$ToTempRoom = $getData[0]->room;
	$ToTempPrice = $getData[0]->price;

	$ToTotalRoom = $ToTotalRoom+$getData[0]->room;
	$ToTotalPrice = $ToTotalPrice+$getData[0]->price;

}

if(isset($date_file_data)&&!empty($date_file_data)){
	$query = "SELECT `price` ,`room`, YEAR(on_date) AS Y  FROM (`stores_booking`) WHERE store_id= ".$s_hotel_data->id."  AND DAY(`on_date`) = '".$expDate[2]."' AND YEAR(`on_date`) = '".date('Y')."' AND  MONTH(`on_date`) = '".$expDate[1]."' AND date='".date('Y-m-d',strtotime($this->input->get('gDate')))."' AND  YEAR(on_date) ='".date('Y')."'  GROUP BY Y";
	$getData = $this->comman_model->get_query($query);
	if(!empty($getData)&&isset($getData[0])){
		$PTempRoom = $getData[0]->room;
		$PTempPrice = $getData[0]->price;

		$PTotalRoom = $PTotalRoom+$getData[0]->room;
		$PTotalPrice = $PTotalPrice+$getData[0]->price;
	}
}
?>
<tr>
<td ><?=date("d-m-Y", strtotime($setD))?></td>
<td><?=$PTempRoom;?></td>
<td><?=round($PTempPrice,2);?></td>
<td><?=$ToTempRoom;?></td>
<td><?=round($ToTempPrice,2);?></td>
<td><?=round($ToTempPrice-$PTempPrice,2);?></td>
<td style=" <?=($ToTempRoom-$PTempRoom)>=0?'color:#090;':'color:#F00;'?>"><?=$ToTempRoom-$PTempRoom;?></td>
</tr>

<?php
		}
	}
}
?>





</tbody>
</table>

</div>
<div class="table-responsive">
<?php
$query = "SELECT date, DAY(DATE)AS d, MONTH(DATE) AS m,YEAR(DATE) AS Y  FROM stores_booking where store_id= ".$s_hotel_data->id." GROUP BY Y,m,d ORDER BY  Y,m,d asc";
$getuploadsdate = $this->comman_model->get_query($query);
?>
<table id="myTable" class="table table-striped table-bordered table-responsive ">
<thead>
<tr>
  <th colspan="7" style="text-align:center">December</th>
</tr>
<tr>
    <th colspan="" style="text-align:center">Date</th>
   <th colspan="" style="text-align:center">Room On Date</th>
   <th colspan="" style="text-align:center">Price On Date</th>
   <th colspan="" style="text-align:center">Room On ToDay</th>
   <th colspan="" style="text-align:center">Price On ToDay</th>
   <th colspan="" style="text-align:center">Price Difference</th>
   <th colspan="" style="text-align:center">Room Difference</th>
</tr>

</thead>
<tbody>
<?php
$allDate  = getallDate('2016');
if($allDate){
	$ToTotalRoom =0;
	$ToTotalPrice =0;
	$PTotalRoom =0;
	$PTtotalPrice =0;

	foreach($allDate as $setD){
		$expDate = explode('-',$setD);
		if($expDate[1]==12){
		$PTempRoom =0;
		$PTempPrice =0;
		$ToTempRoom =0;
		$ToTempPrice =0;
$query = "SELECT `price` ,`room` FROM (`stores_booking`) WHERE store_id= ".$s_hotel_data->id."  AND DAY(`on_date`) = '".$expDate[2]."' AND YEAR(`on_date`) = '".date('Y')."' AND  MONTH(`on_date`) = '".$expDate[1]."' AND YEAR(DATE)='".date('Y')."' order by date desc";
$getData = $this->comman_model->get_query($query);
if(!empty($getData)&&isset($getData[0])){
	$ToTempRoom = $getData[0]->room;
	$ToTempPrice = $getData[0]->price;

	$ToTotalRoom = $ToTotalRoom+$getData[0]->room;
	$ToTotalPrice = $ToTotalPrice+$getData[0]->price;

}

if(isset($date_file_data)&&!empty($date_file_data)){
	$query = "SELECT `price` ,`room`, YEAR(on_date) AS Y  FROM (`stores_booking`) WHERE store_id= ".$s_hotel_data->id."  AND DAY(`on_date`) = '".$expDate[2]."' AND YEAR(`on_date`) = '".date('Y')."' AND  MONTH(`on_date`) = '".$expDate[1]."' AND date='".date('Y-m-d',strtotime($this->input->get('gDate')))."' AND  YEAR(on_date) ='".date('Y')."'  GROUP BY Y";
	$getData = $this->comman_model->get_query($query);
	if(!empty($getData)&&isset($getData[0])){
		$PTempRoom = $getData[0]->room;
		$PTempPrice = $getData[0]->price;

		$PTotalRoom = $PTotalRoom+$getData[0]->room;
		$PTotalPrice = $PTotalPrice+$getData[0]->price;
	}
}
?>
<tr>
<td ><?=date("d-m-Y", strtotime($setD))?></td>
<td><?=$PTempRoom;?></td>
<td><?=round($PTempPrice,2);?></td>
<td><?=$ToTempRoom;?></td>
<td><?=round($ToTempPrice,2);?></td>
<td><?=round($ToTempPrice-$PTempPrice,2);?></td>
<td style=" <?=($ToTempRoom-$PTempRoom)>=0?'color:#090;':'color:#F00;'?>"><?=$ToTempRoom-$PTempRoom;?></td>
</tr>

<?php
		}
	}
}
?>





</tbody>
</table>

</div>
    </div>
    
</div>
<?php
}
?>
        <!-- end panel -->
    </div>
</div>








<script>
function confirm_box(){
    var answer = confirm ("<?=show_static_text($adminLangSession['lang_id'],265);?>");
    if (!answer)
     return false;
}
function get_status(type,id,value){
	//alert(name+' '+id+' '+value);
    $.ajax({
       type: "POST",
       url: "<?=$_cancel?>/set_value", /* The country id will be sent to this file */
       data: {id:id,type:type,value:value,<?=$this->security->get_csrf_token_name();?>:'<?=$this->security->get_csrf_hash();?>'},
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
$('.page-header').hide();
</script>
<style>
table td{
	padding:10px 3px !important;
}
</style>

<link href="assets/global/plugins/bootstrap-datepicker/css/datepicker.css"  rel='stylesheet' type='text/css' >
<script type="text/javascript" src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script>
$(document).ready(function(){
	//$('&nbsp;').appendTo('div.dataTables_filter');
	//$('div.dataTables_filter').appendTo('<button id="refresh">Refresh</button>');
	$('#best_sellers_start').datepicker({ dateFormat: 'mm-dd-yy', altField: '#best_sellers_start_alt', altFormat: 'yy-mm-dd' });

});
</script>

