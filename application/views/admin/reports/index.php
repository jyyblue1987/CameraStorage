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

<!--<script>
$(document).ready(function() {
	$('[data-click=sidebar-minify]').trigger("click");
});
</script>
-->
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

<div class="form-body">                    
	<div class="col-md-12">						                        
        <div class="form-group">
          <label class="col-lg-2 control-label">Hotel</label>
          <div class="col-lg-6">

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
          <div class="col-md-2">
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
    <li class="active"><a href="javascript:void(0);">Report 1</a></li>
    <li class=""><a href="<?=$_cancel.'?hotel_id='.$this->input->get('hotel_id').'&type=report2';?>">Report 2</a></li>
    <li class=""><a href="<?=$_cancel.'?hotel_id='.$this->input->get('hotel_id').'&type=report3';?>">Report 3</a></li>
</ul>	    

<div class="tab-content" style="padding:10px 0">
    <div id="step-1" class="tab-pane fade active in">
    <div class="row">
	    <div class="col-md-6">
    		<div class="btn-group">
			    <a href="<?=$_cancel.'/export1/'.$s_hotel_data->id;?>" class="btn btn-primary m-r-5 m-b-5">Export</a>
		    </div>
	    </div>
	    </div>
        <div class="table-responsive">
<table id="myTable" class="table table-striped table-bordered table-responsive ">
<thead>
<tr>
    <th>GG</th>
    <th style="text-align:center">Room Totali</th>
    <th style="text-align:center">Anno Passato</th>
    <th style="text-align:center">Anno Corrente</th>
    <th style="text-align:center">Delta Room</th>
    <th style="text-align:center">No Sell</th>
    <th style="text-align:center">No Sell Passato</th>
    <th style="text-align:center">Prod Passata</th>
    <th style="text-align:center">Prod Corrente</th>
    <th style="text-align:center">Delta Price</th>
    <th style="text-align:center">Delta  Forcasting</th>

</tr>

</thead>
<tbody>
<?php
$allDate  = getallDate('2016');
if($allDate){
	$ATotalRoom =0;

	$ToTotalRoom =0;
	$ToTotalPrice =0;
	$PTotalRoom =0;
	$PTotalPrice =0;
	foreach($allDate as $setD){
		$expDate = explode('-',$setD);

if($expDate[1]==1){
	$ATotalRoom =$ATotalRoom+$totalRoom;
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

if(!empty($getData)&&isset($getData[1])){
	$PTempRoom = $getData[1]->room;
	$PTempPrice = $getData[1]->price;

	$PTotalRoom = $PTotalRoom+$getData[1]->room;
	$PTotalPrice = $PTotalPrice+$getData[1]->price;

}
?>
<tr>
<td ><?=date("d-m-Y", strtotime($setD))?></td>
<td><?=$totalRoom;?></td>
<td><?=$PTempRoom;?></td>
<td><?=$ToTempRoom;?></td>
<td style=" <?=($ToTempRoom-$PTempRoom)>=0?'color:#090;':'color:#F00;'?>"><?=$ToTempRoom-$PTempRoom;?></td>
<td ><?=$totalRoom-$ToTempRoom;?></td>
<td ><?=$totalRoom-$PTempRoom;?></td>
<td>&euro; <?=round($PTempPrice,2);?></td>
<td>&euro; <?=round($ToTempPrice,2);?></td>
<td style=" <?=round($ToTempPrice-$PTempPrice)>=0?'color:#090;':'color:#F00;'?>">&euro; <?=round($ToTempPrice-$PTempPrice,2);?></td>
<td>&euro; <?=round($ToTempPrice,2);?></td>
</tr>

<?php
		}
	}
?>
<tr>
<td >Total</td>
<td><?=$ATotalRoom;?></td>
<td><?=$PTotalRoom;?></td>
<td><?=$ToTotalRoom;?></td>
<td style=" <?=($ToTotalRoom-$PTotalRoom)>=0?'color:#090;':'color:#F00;'?>"><?=$ToTotalRoom-$PTotalRoom;?></td>
<td ><?=$ATotalRoom-$ToTotalRoom;?></td>
<td ><?=$ATotalRoom-$PTotalRoom;?></td>
<td>&euro; <?=round($PTotalPrice,2);?></td>
<td>&euro; <?=round($ToTotalPrice,2);?></td>
<td style=" <?=round($ToTotalPrice-$PTotalPrice)>=0?'color:#090;':'color:#F00;'?>">&euro; <?=round($ToTotalPrice-$PTotalPrice,2);?></td>
<td>&euro; <?=round($ToTotalPrice,2);?></td>
</tr>
<?php
}
?>


</tbody>
</table>

</div><!--//jan//-->
        <div class="table-responsive">
<table id="myTable" class="table table-striped table-bordered table-responsive ">
<thead>
<tr>
    <th>GG</th>
    <th style="text-align:center">Room Totali</th>
    <th style="text-align:center">Anno Passato</th>
    <th style="text-align:center">Anno Corrente</th>
    <th style="text-align:center">Delta Room</th>
    <th style="text-align:center">No Sell</th>
    <th style="text-align:center">No Sell Passato</th>
    <th style="text-align:center">Prod Passata</th>
    <th style="text-align:center">Prod Corrente</th>
    <th style="text-align:center">Delta Price</th>
    <th style="text-align:center">Delta  Forcasting</th>

</tr>

</thead>
<tbody>
<?php
$allDate  = getallDate('2016');
if($allDate){
	$ATotalRoom =0;

	$ToTotalRoom =0;
	$ToTotalPrice =0;
	$PTotalRoom =0;
	$PTotalPrice =0;
	foreach($allDate as $setD){
		$expDate = explode('-',$setD);

if($expDate[1]==2){
	$ATotalRoom =$ATotalRoom+$totalRoom;
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

if(!empty($getData)&&isset($getData[1])){
	$PTempRoom = $getData[1]->room;
	$PTempPrice = $getData[1]->price;

	$PTotalRoom = $PTotalRoom+$getData[1]->room;
	$PTotalPrice = $PTotalPrice+$getData[1]->price;

}
?>
<tr>
<td ><?=date("d-m-Y", strtotime($setD))?></td>
<td><?=$totalRoom;?></td>
<td><?=$PTempRoom;?></td>
<td><?=$ToTempRoom;?></td>
<td style=" <?=($ToTempRoom-$PTempRoom)>=0?'color:#090;':'color:#F00;'?>"><?=$ToTempRoom-$PTempRoom;?></td>
<td ><?=$totalRoom-$ToTempRoom;?></td>
<td ><?=$totalRoom-$PTempRoom;?></td>
<td>&euro; <?=round($PTempPrice,2);?></td>
<td>&euro; <?=round($ToTempPrice,2);?></td>
<td style=" <?=round($ToTempPrice-$PTempPrice)>=0?'color:#090;':'color:#F00;'?>">&euro; <?=round($ToTempPrice-$PTempPrice,2);?></td>
<td>&euro; <?=round($ToTempPrice,2);?></td>
</tr>

<?php
		}
	}
?>
<?php
}
?>


</tbody>
</table>

</div><!--//feb//-->
        <div class="table-responsive">
<table id="myTable" class="table table-striped table-bordered table-responsive ">
<thead>
<tr>
    <th>GG</th>
    <th style="text-align:center">Room Totali</th>
    <th style="text-align:center">Anno Passato</th>
    <th style="text-align:center">Anno Corrente</th>
    <th style="text-align:center">Delta Room</th>
    <th style="text-align:center">No Sell</th>
    <th style="text-align:center">No Sell Passato</th>
    <th style="text-align:center">Prod Passata</th>
    <th style="text-align:center">Prod Corrente</th>
    <th style="text-align:center">Delta Price</th>
    <th style="text-align:center">Delta  Forcasting</th>

</tr>

</thead>
<tbody>
<?php
$allDate  = getallDate('2016');
if($allDate){
	$ATotalRoom =0;

	$ToTotalRoom =0;
	$ToTotalPrice =0;
	$PTotalRoom =0;
	$PTotalPrice =0;
	foreach($allDate as $setD){
		$expDate = explode('-',$setD);

if($expDate[1]==3){
	$ATotalRoom =$ATotalRoom+$totalRoom;
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

if(!empty($getData)&&isset($getData[1])){
	$PTempRoom = $getData[1]->room;
	$PTempPrice = $getData[1]->price;

	$PTotalRoom = $PTotalRoom+$getData[1]->room;
	$PTotalPrice = $PTotalPrice+$getData[1]->price;

}
?>
<tr>
<td ><?=date("d-m-Y", strtotime($setD))?></td>
<td><?=$totalRoom;?></td>
<td><?=$PTempRoom;?></td>
<td><?=$ToTempRoom;?></td>
<td style=" <?=($ToTempRoom-$PTempRoom)>=0?'color:#090;':'color:#F00;'?>"><?=$ToTempRoom-$PTempRoom;?></td>
<td ><?=$totalRoom-$ToTempRoom;?></td>
<td ><?=$totalRoom-$PTempRoom;?></td>
<td>&euro; <?=round($PTempPrice,2);?></td>
<td>&euro; <?=round($ToTempPrice,2);?></td>
<td style=" <?=round($ToTempPrice-$PTempPrice)>=0?'color:#090;':'color:#F00;'?>">&euro; <?=round($ToTempPrice-$PTempPrice,2);?></td>
<td>&euro; <?=round($ToTempPrice,2);?></td>
</tr>

<?php
		}
	}
?>
<?php
}
?>


</tbody>
</table>

</div><!--//mar//-->
        <div class="table-responsive">
<table id="myTable" class="table table-striped table-bordered table-responsive ">
<thead>
<tr>
    <th>GG</th>
    <th style="text-align:center">Room Totali</th>
    <th style="text-align:center">Anno Passato</th>
    <th style="text-align:center">Anno Corrente</th>
    <th style="text-align:center">Delta Room</th>
    <th style="text-align:center">No Sell</th>
    <th style="text-align:center">No Sell Passato</th>
    <th style="text-align:center">Prod Passata</th>
    <th style="text-align:center">Prod Corrente</th>
    <th style="text-align:center">Delta Price</th>
    <th style="text-align:center">Delta  Forcasting</th>

</tr>

</thead>
<tbody>
<?php
$allDate  = getallDate('2016');
if($allDate){
	$ATotalRoom =0;

	$ToTotalRoom =0;
	$ToTotalPrice =0;
	$PTotalRoom =0;
	$PTotalPrice =0;
	foreach($allDate as $setD){
		$expDate = explode('-',$setD);

if($expDate[1]==4){
	$ATotalRoom =$ATotalRoom+$totalRoom;
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

if(!empty($getData)&&isset($getData[1])){
	$PTempRoom = $getData[1]->room;
	$PTempPrice = $getData[1]->price;

	$PTotalRoom = $PTotalRoom+$getData[1]->room;
	$PTotalPrice = $PTotalPrice+$getData[1]->price;

}
?>
<tr>
<td ><?=date("d-m-Y", strtotime($setD))?></td>
<td><?=$totalRoom;?></td>
<td><?=$PTempRoom;?></td>
<td><?=$ToTempRoom;?></td>
<td style=" <?=($ToTempRoom-$PTempRoom)>=0?'color:#090;':'color:#F00;'?>"><?=$ToTempRoom-$PTempRoom;?></td>
<td ><?=$totalRoom-$ToTempRoom;?></td>
<td ><?=$totalRoom-$PTempRoom;?></td>
<td>&euro; <?=round($PTempPrice,2);?></td>
<td>&euro; <?=round($ToTempPrice,2);?></td>
<td style=" <?=round($ToTempPrice-$PTempPrice)>=0?'color:#090;':'color:#F00;'?>">&euro; <?=round($ToTempPrice-$PTempPrice,2);?></td>
<td>&euro; <?=round($ToTempPrice,2);?></td>
</tr>

<?php
		}
	}
?>
<?php
}
?>


</tbody>
</table>

</div><!--//apr//-->
        <div class="table-responsive">
<table id="myTable" class="table table-striped table-bordered table-responsive ">
<thead>
<tr>
    <th>GG</th>
    <th style="text-align:center">Room Totali</th>
    <th style="text-align:center">Anno Passato</th>
    <th style="text-align:center">Anno Corrente</th>
    <th style="text-align:center">Delta Room</th>
    <th style="text-align:center">No Sell</th>
    <th style="text-align:center">No Sell Passato</th>
    <th style="text-align:center">Prod Passata</th>
    <th style="text-align:center">Prod Corrente</th>
    <th style="text-align:center">Delta Price</th>
    <th style="text-align:center">Delta  Forcasting</th>

</tr>

</thead>
<tbody>
<?php
$allDate  = getallDate('2016');
if($allDate){
	$ATotalRoom =0;

	$ToTotalRoom =0;
	$ToTotalPrice =0;
	$PTotalRoom =0;
	$PTotalPrice =0;
	foreach($allDate as $setD){
		$expDate = explode('-',$setD);

if($expDate[1]==5){
	$ATotalRoom =$ATotalRoom+$totalRoom;
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

if(!empty($getData)&&isset($getData[1])){
	$PTempRoom = $getData[1]->room;
	$PTempPrice = $getData[1]->price;

	$PTotalRoom = $PTotalRoom+$getData[1]->room;
	$PTotalPrice = $PTotalPrice+$getData[1]->price;

}
?>
<tr>
<td ><?=date("d-m-Y", strtotime($setD))?></td>
<td><?=$totalRoom;?></td>
<td><?=$PTempRoom;?></td>
<td><?=$ToTempRoom;?></td>
<td style=" <?=($ToTempRoom-$PTempRoom)>=0?'color:#090;':'color:#F00;'?>"><?=$ToTempRoom-$PTempRoom;?></td>
<td ><?=$totalRoom-$ToTempRoom;?></td>
<td ><?=$totalRoom-$PTempRoom;?></td>
<td>&euro; <?=round($PTempPrice,2);?></td>
<td>&euro; <?=round($ToTempPrice,2);?></td>
<td style=" <?=round($ToTempPrice-$PTempPrice)>=0?'color:#090;':'color:#F00;'?>">&euro; <?=round($ToTempPrice-$PTempPrice,2);?></td>
<td>&euro; <?=round($ToTempPrice,2);?></td>
</tr>

<?php
		}
	}
?>
<?php
}
?>


</tbody>
</table>

</div><!--//may//-->
        <div class="table-responsive">
<table id="myTable" class="table table-striped table-bordered table-responsive ">
<thead>
<tr>
    <th>GG</th>
    <th style="text-align:center">Room Totali</th>
    <th style="text-align:center">Anno Passato</th>
    <th style="text-align:center">Anno Corrente</th>
    <th style="text-align:center">Delta Room</th>
    <th style="text-align:center">No Sell</th>
    <th style="text-align:center">No Sell Passato</th>
    <th style="text-align:center">Prod Passata</th>
    <th style="text-align:center">Prod Corrente</th>
    <th style="text-align:center">Delta Price</th>
    <th style="text-align:center">Delta  Forcasting</th>

</tr>

</thead>
<tbody>
<?php
$allDate  = getallDate('2016');
if($allDate){
	$ATotalRoom =0;

	$ToTotalRoom =0;
	$ToTotalPrice =0;
	$PTotalRoom =0;
	$PTotalPrice =0;
	foreach($allDate as $setD){
		$expDate = explode('-',$setD);

if($expDate[1]==6){
	$ATotalRoom =$ATotalRoom+$totalRoom;
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

if(!empty($getData)&&isset($getData[1])){
	$PTempRoom = $getData[1]->room;
	$PTempPrice = $getData[1]->price;

	$PTotalRoom = $PTotalRoom+$getData[1]->room;
	$PTotalPrice = $PTotalPrice+$getData[1]->price;

}
?>
<tr>
<td ><?=date("d-m-Y", strtotime($setD))?></td>
<td><?=$totalRoom;?></td>
<td><?=$PTempRoom;?></td>
<td><?=$ToTempRoom;?></td>
<td style=" <?=($ToTempRoom-$PTempRoom)>=0?'color:#090;':'color:#F00;'?>"><?=$ToTempRoom-$PTempRoom;?></td>
<td ><?=$totalRoom-$ToTempRoom;?></td>
<td ><?=$totalRoom-$PTempRoom;?></td>
<td>&euro; <?=round($PTempPrice,2);?></td>
<td>&euro; <?=round($ToTempPrice,2);?></td>
<td style=" <?=round($ToTempPrice-$PTempPrice)>=0?'color:#090;':'color:#F00;'?>">&euro; <?=round($ToTempPrice-$PTempPrice,2);?></td>
<td>&euro; <?=round($ToTempPrice,2);?></td>
</tr>

<?php
		}
	}
?>
<?php
}
?>


</tbody>
</table>

</div><!--//jun//-->
        <div class="table-responsive">
<table id="myTable" class="table table-striped table-bordered table-responsive ">
<thead>
<tr>
    <th>GG</th>
    <th style="text-align:center">Room Totali</th>
    <th style="text-align:center">Anno Passato</th>
    <th style="text-align:center">Anno Corrente</th>
    <th style="text-align:center">Delta Room</th>
    <th style="text-align:center">No Sell</th>
    <th style="text-align:center">No Sell Passato</th>
    <th style="text-align:center">Prod Passata</th>
    <th style="text-align:center">Prod Corrente</th>
    <th style="text-align:center">Delta Price</th>
    <th style="text-align:center">Delta  Forcasting</th>

</tr>

</thead>
<tbody>
<?php
$allDate  = getallDate('2016');
if($allDate){
	$ATotalRoom =0;

	$ToTotalRoom =0;
	$ToTotalPrice =0;
	$PTotalRoom =0;
	$PTotalPrice =0;
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

if(!empty($getData)&&isset($getData[1])){
	$PTempRoom = $getData[1]->room;
	$PTempPrice = $getData[1]->price;

	$PTotalRoom = $PTotalRoom+$getData[1]->room;
	$PTotalPrice = $PTotalPrice+$getData[1]->price;

}
?>
<tr>
<td ><?=date("d-m-Y", strtotime($setD))?></td>
<td><?=$totalRoom;?></td>
<td><?=$PTempRoom;?></td>
<td><?=$ToTempRoom;?></td>
<td style=" <?=($ToTempRoom-$PTempRoom)>=0?'color:#090;':'color:#F00;'?>"><?=$ToTempRoom-$PTempRoom;?></td>
<td ><?=$totalRoom-$ToTempRoom;?></td>
<td ><?=$totalRoom-$PTempRoom;?></td>
<td>&euro; <?=round($PTempPrice,2);?></td>
<td>&euro; <?=round($ToTempPrice,2);?></td>
<td style=" <?=round($ToTempPrice-$PTempPrice)>=0?'color:#090;':'color:#F00;'?>"><?=round($ToTempPrice-$PTempPrice,2);?></td>
<td>&euro; <?=round($ToTempPrice,2);?></td>
</tr>

<?php
		}
	}
?>
<?php
}
?>


</tbody>
</table>

</div><!--//jul//-->
        <div class="table-responsive">
<table id="myTable" class="table table-striped table-bordered table-responsive ">
<thead>
<tr>
    <th>GG</th>
    <th style="text-align:center">Room Totali</th>
    <th style="text-align:center">Anno Passato</th>
    <th style="text-align:center">Anno Corrente</th>
    <th style="text-align:center">Delta Room</th>
    <th style="text-align:center">No Sell</th>
    <th style="text-align:center">No Sell Passato</th>
    <th style="text-align:center">Prod Passata</th>
    <th style="text-align:center">Prod Corrente</th>
    <th style="text-align:center">Delta Price</th>
    <th style="text-align:center">Delta  Forcasting</th>

</tr>

</thead>
<tbody>
<?php
$allDate  = getallDate('2016');
if($allDate){
	$ATotalRoom =0;

	$ToTotalRoom =0;
	$ToTotalPrice =0;
	$PTotalRoom =0;
	$PTotalPrice =0;
	foreach($allDate as $setD){
		$expDate = explode('-',$setD);

if($expDate[1]==8){
	$ATotalRoom =$ATotalRoom+$totalRoom;
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

if(!empty($getData)&&isset($getData[1])){
	$PTempRoom = $getData[1]->room;
	$PTempPrice = $getData[1]->price;

	$PTotalRoom = $PTotalRoom+$getData[1]->room;
	$PTotalPrice = $PTotalPrice+$getData[1]->price;

}
?>
<tr>
<td ><?=date("d-m-Y", strtotime($setD))?></td>
<td><?=$totalRoom;?></td>
<td><?=$PTempRoom;?></td>
<td><?=$ToTempRoom;?></td>
<td style=" <?=($ToTempRoom-$PTempRoom)>=0?'color:#090;':'color:#F00;'?>"><?=$ToTempRoom-$PTempRoom;?></td>
<td ><?=$totalRoom-$ToTempRoom;?></td>
<td ><?=$totalRoom-$PTempRoom;?></td>
<td>&euro; <?=round($PTempPrice,2);?></td>
<td>&euro; <?=round($ToTempPrice,2);?></td>
<td style=" <?=round($ToTempPrice-$PTempPrice)>=0?'color:#090;':'color:#F00;'?>">&euro; <?=round($ToTempPrice-$PTempPrice,2);?></td>
<td>&euro; <?=round($ToTempPrice,2);?></td>
</tr>

<?php
		}
	}
?>
<?php
}
?>


</tbody>
</table>

</div><!--//aug//-->
        <div class="table-responsive">
<table id="myTable" class="table table-striped table-bordered table-responsive ">
<thead>
<tr>
    <th>GG</th>
    <th style="text-align:center">Room Totali</th>
    <th style="text-align:center">Anno Passato</th>
    <th style="text-align:center">Anno Corrente</th>
    <th style="text-align:center">Delta Room</th>
    <th style="text-align:center">No Sell</th>
    <th style="text-align:center">No Sell Passato</th>
    <th style="text-align:center">Prod Passata</th>
    <th style="text-align:center">Prod Corrente</th>
    <th style="text-align:center">Delta Price</th>
    <th style="text-align:center">Delta  Forcasting</th>

</tr>

</thead>
<tbody>
<?php
$allDate  = getallDate('2016');
if($allDate){
	$ATotalRoom =0;

	$ToTotalRoom =0;
	$ToTotalPrice =0;
	$PTotalRoom =0;
	$PTotalPrice =0;
	foreach($allDate as $setD){
		$expDate = explode('-',$setD);

if($expDate[1]==9){
	$ATotalRoom =$ATotalRoom+$totalRoom;
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

if(!empty($getData)&&isset($getData[1])){
	$PTempRoom = $getData[1]->room;
	$PTempPrice = $getData[1]->price;

	$PTotalRoom = $PTotalRoom+$getData[1]->room;
	$PTotalPrice = $PTotalPrice+$getData[1]->price;

}
?>
<tr>
<td ><?=date("d-m-Y", strtotime($setD))?></td>
<td><?=$totalRoom;?></td>
<td><?=$PTempRoom;?></td>
<td><?=$ToTempRoom;?></td>
<td style=" <?=($ToTempRoom-$PTempRoom)>=0?'color:#090;':'color:#F00;'?>"><?=$ToTempRoom-$PTempRoom;?></td>
<td ><?=$totalRoom-$ToTempRoom;?></td>
<td ><?=$totalRoom-$PTempRoom;?></td>
<td>&euro; <?=round($PTempPrice,2);?></td>
<td>&euro; <?=round($ToTempPrice,2);?></td>
<td style=" <?=round($ToTempPrice-$PTempPrice)>=0?'color:#090;':'color:#F00;'?>">&euro; <?=round($ToTempPrice-$PTempPrice,2);?></td>
<td>&euro; <?=round($ToTempPrice,2);?></td>
</tr>

<?php
		}
	}
?>
<?php
}
?>


</tbody>
</table>

</div><!--//sep//-->
        <div class="table-responsive">
<table id="myTable" class="table table-striped table-bordered table-responsive ">
<thead>
<tr>
    <th>GG</th>
    <th style="text-align:center">Room Totali</th>
    <th style="text-align:center">Anno Passato</th>
    <th style="text-align:center">Anno Corrente</th>
    <th style="text-align:center">Delta Room</th>
    <th style="text-align:center">No Sell</th>
    <th style="text-align:center">No Sell Passato</th>
    <th style="text-align:center">Prod Passata</th>
    <th style="text-align:center">Prod Corrente</th>
    <th style="text-align:center">Delta Price</th>
    <th style="text-align:center">Delta  Forcasting</th>

</tr>

</thead>
<tbody>
<?php
$allDate  = getallDate('2016');
if($allDate){
	$ATotalRoom =0;

	$ToTotalRoom =0;
	$ToTotalPrice =0;
	$PTotalRoom =0;
	$PTotalPrice =0;
	foreach($allDate as $setD){
		$expDate = explode('-',$setD);

if($expDate[1]==10){
	$ATotalRoom =$ATotalRoom+$totalRoom;
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

if(!empty($getData)&&isset($getData[1])){
	$PTempRoom = $getData[1]->room;
	$PTempPrice = $getData[1]->price;

	$PTotalRoom = $PTotalRoom+$getData[1]->room;
	$PTotalPrice = $PTotalPrice+$getData[1]->price;

}
?>
<tr>
<td ><?=date("d-m-Y", strtotime($setD))?></td>
<td><?=$totalRoom;?></td>
<td><?=$PTempRoom;?></td>
<td><?=$ToTempRoom;?></td>
<td style=" <?=($ToTempRoom-$PTempRoom)>=0?'color:#090;':'color:#F00;'?>"><?=$ToTempRoom-$PTempRoom;?></td>
<td ><?=$totalRoom-$ToTempRoom;?></td>
<td ><?=$totalRoom-$PTempRoom;?></td>
<td>&euro; <?=round($PTempPrice,2);?></td>
<td>&euro; <?=round($ToTempPrice,2);?></td>
<td style=" <?=round($ToTempPrice-$PTempPrice)>=0?'color:#090;':'color:#F00;'?>">&euro; <?=round($ToTempPrice-$PTempPrice,2);?></td>
<td>&euro; <?=round($ToTempPrice,2);?></td>
</tr>

<?php
		}
	}
?>
<?php
}
?>


</tbody>
</table>

</div><!--//oct//-->
        <div class="table-responsive">
<table id="myTable" class="table table-striped table-bordered table-responsive ">
<thead>
<tr>
    <th>GG</th>
    <th style="text-align:center">Room Totali</th>
    <th style="text-align:center">Anno Passato</th>
    <th style="text-align:center">Anno Corrente</th>
    <th style="text-align:center">Delta Room</th>
    <th style="text-align:center">No Sell</th>
    <th style="text-align:center">No Sell Passato</th>
    <th style="text-align:center">Prod Passata</th>
    <th style="text-align:center">Prod Corrente</th>
    <th style="text-align:center">Delta Price</th>
    <th style="text-align:center">Delta  Forcasting</th>

</tr>

</thead>
<tbody>
<?php
$allDate  = getallDate('2016');
if($allDate){
	$ATotalRoom =0;

	$ToTotalRoom =0;
	$ToTotalPrice =0;
	$PTotalRoom =0;
	$PTotalPrice =0;
	foreach($allDate as $setD){
		$expDate = explode('-',$setD);

if($expDate[1]==11){
	$ATotalRoom =$ATotalRoom+$totalRoom;
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

if(!empty($getData)&&isset($getData[1])){
	$PTempRoom = $getData[1]->room;
	$PTempPrice = $getData[1]->price;

	$PTotalRoom = $PTotalRoom+$getData[1]->room;
	$PTotalPrice = $PTotalPrice+$getData[1]->price;

}
?>
<tr>
<td ><?=date("d-m-Y", strtotime($setD))?></td>
<td><?=$totalRoom;?></td>
<td><?=$PTempRoom;?></td>
<td><?=$ToTempRoom;?></td>
<td style=" <?=($ToTempRoom-$PTempRoom)>=0?'color:#090;':'color:#F00;'?>"><?=$ToTempRoom-$PTempRoom;?></td>
<td ><?=$totalRoom-$ToTempRoom;?></td>
<td ><?=$totalRoom-$PTempRoom;?></td>
<td>&euro; <?=round($PTempPrice,2);?></td>
<td>&euro; <?=round($ToTempPrice,2);?></td>
<td style=" <?=round($ToTempPrice-$PTempPrice)>=0?'color:#090;':'color:#F00;'?>">&euro; <?=round($ToTempPrice-$PTempPrice,2);?></td>
<td>&euro; <?=round($ToTempPrice,2);?></td>
</tr>

<?php
		}
	}
?>
<?php
}
?>


</tbody>
</table>

</div><!--//nov//-->
        <div class="table-responsive">
<table id="myTable" class="table table-striped table-bordered table-responsive ">
<thead>
<tr>
    <th>GG</th>
    <th style="text-align:center">Room Totali</th>
    <th style="text-align:center">Anno Passato</th>
    <th style="text-align:center">Anno Corrente</th>
    <th style="text-align:center">Delta Room</th>
    <th style="text-align:center">No Sell</th>
    <th style="text-align:center">No Sell Passato</th>
    <th style="text-align:center">Prod Passata</th>
    <th style="text-align:center">Prod Corrente</th>
    <th style="text-align:center">Delta Price</th>
    <th style="text-align:center">Delta  Forcasting</th>

</tr>

</thead>
<tbody>
<?php
$allDate  = getallDate('2016');
if($allDate){
	$ATotalRoom =0;

	$ToTotalRoom =0;
	$ToTotalPrice =0;
	$PTotalRoom =0;
	$PTotalPrice =0;
	foreach($allDate as $setD){
		$expDate = explode('-',$setD);

if($expDate[1]==12){
	$ATotalRoom =$ATotalRoom+$totalRoom;
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

if(!empty($getData)&&isset($getData[1])){
	$PTempRoom = $getData[1]->room;
	$PTempPrice = $getData[1]->price;

	$PTotalRoom = $PTotalRoom+$getData[1]->room;
	$PTotalPrice = $PTotalPrice+$getData[1]->price;

}
?>
<tr>
<td ><?=date("d-m-Y", strtotime($setD))?></td>
<td><?=$totalRoom;?></td>
<td><?=$PTempRoom;?></td>
<td><?=$ToTempRoom;?></td>
<td style=" <?=($ToTempRoom-$PTempRoom)>=0?'color:#090;':'color:#F00;'?>"><?=$ToTempRoom-$PTempRoom;?></td>
<td ><?=$totalRoom-$ToTempRoom;?></td>
<td ><?=$totalRoom-$PTempRoom;?></td>
<td>&euro; <?=round($PTempPrice,2);?></td>
<td>&euro; <?=round($ToTempPrice,2);?></td>
<td style=" <?=round($ToTempPrice-$PTempPrice)>=0?'color:#090;':'color:#F00;'?>">&euro; <?=round($ToTempPrice-$PTempPrice,2);?></td>
<td>&euro; <?=round($ToTempPrice,2);?></td>
</tr>

<?php
		}
	}
?>
<?php
}
?>


</tbody>
</table>

</div><!--//dec//-->
        
    </div><!--//step1//-->
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
