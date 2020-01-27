<style>
table tr th,table tr td{
	padding:2px !important; 
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
if(isset($hotel_data)&&!empty($hotel_data)){
foreach($hotel_data as $setCategory){
?>
<option value="<?=$setCategory->id;?>"  ><?=$setCategory->name;?></option>
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
	$TtotalRoomSellP = 0;
	$PtotalRoomSellP = 0;
	$TtotalRoomSellR = 0;
	$PtotalRoomSellR = 0;
	$TtotalRTBS = 0;
	$PtotalRTBS = 0;
	$TtotalRCM =0;
	$PtotalRCM =0;
	$TtotalOCC = 0;
	$PtotalOCC = 0;

	$TtotalRevPar = 0;
	$PtotalRevPar = 0;
	
?>
<ul class="nav nav-tabs">
    <li class="active"><a href="#step-1" data-toggle="tab">Year Analysis</a></li>
    <li class=""><a href="#step-2" data-toggle="tab">Price Room analysis</a></li>
</ul>	    

<div class="tab-content" style="padding:10px 0">
    <div id="step-1" class="tab-pane fade active in">
        <div class="table-responsive">
<table id="myTable" class="table table-striped table-bordered table-responsive ">
<thead>
<tr>
    <th>&nbsp;</th>
    <th colspan="2">January</th>
    <th colspan="2">February</th>
    <th colspan="2">March</th>
    <th colspan="2">April</th>
    <th colspan="2">May</th>
    <th colspan="2">June</th>
    <th colspan="2">July</th>
    <th colspan="2">August</th>
    <th colspan="2">September</th>
    <th colspan="2">October</th>
    <th colspan="2">November</th>
    <th colspan="2">December</th>
    <th colspan="2">Total</th>

</tr>
<tr>
    <th>&nbsp;</th>
<?php
$nowTime =time();
$thisYear = date('Y',$nowTime);
$thisPYear = date('Y',strtotime('-1 year', $nowTime));
for($i=1;$i<=13;$i++){
	echo '<th>'.$thisPYear.'</th><th>'.$thisYear.'</th>';
}
?>
</tr>
</thead>
<tbody>
<?php
if(isset($s_hotel_data)&&!empty($s_hotel_data)){

?>
<tr>
<td>Room to be Sell</td>
<td><?=($totalRoom*31);?></td>
<td><?=($totalRoom*31)?></td>
<td><?=($totalRoom*date('t',strtotime('-1 year', $nowTime)))?></td>
<td><?=($totalRoom*date('t',$nowTime))?></td>
<td><?=($totalRoom*31);?></td>
<td><?=($totalRoom*31)?></td>
<td><?=$totalRoom*30?></td>
<td><?=$totalRoom*30?></td>
<td><?=$totalRoom*31?></td>
<td><?=$totalRoom*31?></td>
<td><?=$totalRoom*30?></td>
<td><?=$totalRoom*30?></td>
<td><?=$totalRoom*31?></td>
<td><?=$totalRoom*31?></td>
<td><?=$totalRoom*31?></td>
<td><?=$totalRoom*31?></td>
<td><?=$totalRoom*30?></td>
<td><?=$totalRoom*30?></td>
<td><?=$totalRoom*31?></td>
<td><?=$totalRoom*31?></td>
<td><?=$totalRoom*30?></td>
<td><?=$totalRoom*30?></td>
<td><?=$totalRoom*31?></td>
<td><?=$totalRoom*31?></td>
<td><?=$totalRoom*((31*7)+(30*4)+date('t',strtotime('-1 year', $nowTime)))?></td>
<td><?=$totalRoom*((31*7)+(30*4)+date('t',$nowTime))?></td>
</tr>
<tr> 
<td>Room Out Order</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr> 
<td>Room disponibili</td>
<td><?=($totalRoom*31);?></td>
<td><?=($totalRoom*31)?></td>
<td><?=($totalRoom*date('t',strtotime('-1 year', $nowTime)))?></td>
<td><?=($totalRoom*date('t',$nowTime))?></td>
<td><?=($totalRoom*31);?></td>
<td><?=($totalRoom*31)?></td>
<td><?=$totalRoom*30?></td>
<td><?=$totalRoom*30?></td>
<td><?=$totalRoom*31?></td>
<td><?=$totalRoom*31?></td>
<td><?=$totalRoom*30?></td>
<td><?=$totalRoom*30?></td>
<td><?=$totalRoom*31?></td>
<td><?=$totalRoom*31?></td>
<td><?=$totalRoom*31?></td>
<td><?=$totalRoom*31?></td>
<td><?=$totalRoom*30?></td>
<td><?=$totalRoom*30?></td>
<td><?=$totalRoom*31?></td>
<td><?=$totalRoom*31?></td>
<td><?=$totalRoom*30?></td>
<td><?=$totalRoom*30?></td>
<td><?=$totalRoom*31?></td>
<td><?=$totalRoom*31?></td>
<td><?=$totalRoom*((31*7)+(30*4)+date('t',strtotime('-1 year', $nowTime)))?></td>
<td><?=$totalRoom*((31*7)+(30*4)+date('t',$nowTime))?></td>
</tr>
<tr> 
<td>Room Sell</td>
<?php
for($i=1;$i<=12;$i++){
	$query = "SELECT YEAR(on_date) AS Y, MONTH(on_date) AS m , SUM(room) AS room FROM stores_booking WHERE YEAR(on_date) = ".$thisPYear." AND MONTH(on_date)= ".$i." AND store_id= ".$s_hotel_data->id."  GROUP BY y,m";
	$PYearData = $this->comman_model->get_query($query);
	//echo $this->db->last_query();
	if($PYearData){
		$PtotalRoomSellR = round($PYearData[0]->room,2)+$PtotalRoomSellR;
		echo '<td>'.round($PYearData[0]->room,2).'</td>';
	}
	else{
		echo '<td>0</td>';
	}

	$query = "SELECT YEAR(on_date) AS Y, MONTH(on_date) AS m , SUM(room) AS room FROM stores_booking WHERE YEAR(on_date) = ".$thisYear." AND MONTH(on_date)= ".$i." AND store_id= ".$s_hotel_data->id." GROUP BY y,m";
	$thisYearData = $this->comman_model->get_query($query);	
	if(!empty($thisYearData)){
		$TtotalRoomSellR = round($PYearData[0]->room,2)+$TtotalRoomSellR;
		echo '<td>'.round($thisYearData[0]->room,2).'</td>';
	}
	else{
		echo '<td>0</td>';
	}
}
?>
<td><?=$PtotalRoomSellR?></td>
<td><?=$TtotalRoomSellR?></td>
</tr>
<tr> 
<td>Room on the Book</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr> 
<td>Produzione</td>
<?php
for($i=1;$i<=12;$i++){
	$query = "SELECT YEAR(on_date) AS Y, MONTH(on_date) AS m , SUM(price) AS price FROM stores_booking WHERE YEAR(on_date) = ".$thisPYear." AND MONTH(on_date)= ".$i." AND store_id= ".$s_hotel_data->id." GROUP BY y,m";
	$PYearData = $this->comman_model->get_query($query);
	//echo $this->db->last_query();
	if($PYearData){
		$PtotalRoomSellP = round($PYearData[0]->price,2)+$PtotalRoomSellP;
		echo '<td>'.round($PYearData[0]->price,2).'</td>';
	}
	else{
		echo '<td>0</td>';
	}

	$query = "SELECT YEAR(on_date) AS Y, MONTH(on_date) AS m , SUM(price) AS price FROM stores_booking WHERE YEAR(on_date) = ".$thisYear." AND MONTH(on_date)= ".$i." AND store_id= ".$s_hotel_data->id." GROUP BY y,m";
	$thisYearData = $this->comman_model->get_query($query);	
	if(!empty($thisYearData)){
		$TtotalRoomSellP = round($PYearData[0]->price,2)+$TtotalRoomSellP;
		echo '<td>'.round($thisYearData[0]->price,2).'</td>';
	}
	else{
		echo '<td>0</td>';
	}
}
?>
<td><?=$PtotalRoomSellP?></td>
<td><?=$TtotalRoomSellP?></td>
</tr>
<tr> 
<td>RCM</td>
<?php
for($i=1;$i<=12;$i++){
	$query = "SELECT YEAR(on_date) AS Y, MONTH(on_date) AS m , SUM(room) AS room FROM stores_booking WHERE YEAR(on_date) = ".$thisPYear." AND MONTH(on_date)= ".$i." AND store_id= ".$s_hotel_data->id." GROUP BY y,m";
	$PYearData1 = $this->comman_model->get_query($query);
	$query = "SELECT YEAR(on_date) AS Y, MONTH(on_date) AS m , SUM(price) AS price FROM stores_booking WHERE store_id= ".$s_hotel_data->id." AND YEAR(on_date) = ".$thisPYear." AND MONTH(on_date)= ".$i." GROUP BY y,m";
	$PYearData2 = $this->comman_model->get_query($query);
	//echo $this->db->last_query();
	if($PYearData1&&$PYearData2){
		$PtotalRCM = round(($PYearData2[0]->price/$PYearData1[0]->room),0)+$PtotalRCM;
		echo '<td>'.round(($PYearData2[0]->price/$PYearData1[0]->room),0).'</td>';
	}
	else{
		echo '<td>0</td>';
	}

	$query = "SELECT YEAR(on_date) AS Y, MONTH(on_date) AS m , SUM(room) AS room FROM stores_booking WHERE store_id= ".$s_hotel_data->id." AND YEAR(on_date) = ".$thisYear." AND MONTH(on_date)= ".$i." GROUP BY y,m";
	$thisYearData1 = $this->comman_model->get_query($query);	
	$query = "SELECT YEAR(on_date) AS Y, MONTH(on_date) AS m , SUM(price) AS price FROM stores_booking WHERE store_id= ".$s_hotel_data->id." AND YEAR(on_date) = ".$thisYear." AND MONTH(on_date)= ".$i." GROUP BY y,m";
	$thisYearData2 = $this->comman_model->get_query($query);	
	if($thisYearData1&&$thisYearData){
		$TtotalRCM = round(($thisYearData2[0]->price/$thisYearData1[0]->room),0)+$TtotalRCM;
		echo '<td>'.round(($thisYearData2[0]->price/$thisYearData1[0]->room),0).'</td>';
	}
	else{
		echo '<td>0</td>';
	}

}
?>
<td><?=round(($PtotalRCM/12),0);?></td>
<td><?=round(($TtotalRCM/12),0);?></td>

</tr>
<tr> 
<td>RevPar</td>
<?php
for($i=1;$i<=12;$i++){
	$query = "SELECT YEAR(on_date) AS Y, MONTH(on_date) AS m , SUM(price) AS price FROM stores_booking WHERE store_id= ".$s_hotel_data->id." AND YEAR(on_date) = ".$thisPYear." AND MONTH(on_date)= ".$i." GROUP BY y,m";
	$PYearData = $this->comman_model->get_query($query);
	//echo $this->db->last_query();
	if($PYearData){
		$totalMP = 0;
		if($i==1||$i==3||$i==5||$i==7||$i==8||$i==10||$i==12){
			$totalMP =$totalRoom*31;
		}
		elseif($i==4||$i==6||$i==9||$i==11){
			$totalMP =$totalRoom*30;
		}
		elseif($i==2){
			$totalMP =$totalRoom*date('t',strtotime('-1 year', $nowTime));
		}
		$PtotalRevPar= round(($PYearData[0]->price/$totalMP),0)+$PtotalRevPar;
		echo '<td>'.round(($PYearData[0]->price/$totalMP),0).'</td>';
		//echo '<td>'.$totalMP.'</td>';
	}
	else{
		echo '<td>0</td>';
	}

	$query = "SELECT YEAR(on_date) AS Y, MONTH(on_date) AS m , SUM(price) AS price FROM stores_booking WHERE store_id= ".$s_hotel_data->id." AND YEAR(on_date) = ".$thisYear." AND MONTH(on_date)= ".$i." GROUP BY y,m";
	$thisYearData = $this->comman_model->get_query($query);	
	if(!empty($thisYearData)){
		$totalMP = 0;
		if($i==1||$i==3||$i==5||$i==7||$i==8||$i==10||$i==12){
			$totalMP =$totalRoom*31;
		}
		elseif($i==4||$i==6||$i==9||$i==11){
			$totalMP =$totalRoom*30;
		}
		elseif($i==2){
			$totalMP =$totalRoom*date('t',$nowTime);
		}
		//echo '<td>'.$totalMP.'</td>';
		$TtotalRevPar= round(($thisYearData[0]->price/$totalMP),0)+$TtotalRevPar;
		echo '<td>'.round(($thisYearData[0]->price/$totalMP),0).'</td>';
	}
	else{
		echo '<td>0</td>';
	}
}
?>
<td><?=round(($PtotalRevPar/12),0);?></td>
<td><?=round(($TtotalRevPar/12),0);?></td>
</tr>
<tr> 
<td>OCC</td>
<?php
for($i=1;$i<=12;$i++){
	$query = "SELECT YEAR(on_date) AS Y, MONTH(on_date) AS m , SUM(room) AS room FROM stores_booking WHERE store_id= ".$s_hotel_data->id." AND YEAR(on_date) = ".$thisPYear." AND MONTH(on_date)= ".$i." GROUP BY y,m";
	$PYearData = $this->comman_model->get_query($query);
	//echo $this->db->last_query();
	if($PYearData){
		$totalMP = 0;
		if($i==1||$i==3||$i==5||$i==7||$i==8||$i==10||$i==12){
			$totalMP =$totalRoom*31;
		}
		elseif($i==4||$i==6||$i==9||$i==11){
			$totalMP =$totalRoom*30;
		}
		elseif($i==2){
			$totalMP =$totalRoom*date('t',strtotime('-1 year', $nowTime));
		}
		$PtotalOCC= round((($PYearData[0]->room/$totalMP)*100),0)+$PtotalOCC;
		echo '<td>'.round((($PYearData[0]->room/$totalMP)*100),0).'%</td>';
		//echo '<td>'.$totalMP.'</td>';
	}
	else{
		echo '<td>0%</td>';
	}

	$query = "SELECT YEAR(on_date) AS Y, MONTH(on_date) AS m , SUM(room) AS room FROM stores_booking WHERE store_id= ".$s_hotel_data->id." AND YEAR(on_date) = ".$thisYear." AND MONTH(on_date)= ".$i." GROUP BY y,m";
	$thisYearData = $this->comman_model->get_query($query);	
	if(!empty($thisYearData)){
		$totalMP = 0;
		if($i==1||$i==3||$i==5||$i==7||$i==8||$i==10||$i==12){
			$totalMP =$totalRoom*31;
		}
		elseif($i==4||$i==6||$i==9||$i==11){
			$totalMP =$totalRoom*30;
		}
		elseif($i==2){
			$totalMP =$totalRoom*date('t',$nowTime);
		}
		//echo '<td>'.$totalMP.'</td>';
		$TtotalOCC= round((($thisYearData[0]->room/$totalMP)*100),0)+$TtotalOCC;
		echo '<td>'.round((($thisYearData[0]->room/$totalMP)*100),0).'%</td>';
	}
	else{
		echo '<td>0%</td>';
	}
}
?>
<td><?=round(($PtotalOCC/12),0);?>%</td>
<td><?=round(($TtotalOCC/12),0);?>%</td>
</tr>

<?php
}
?>


</tbody>
</table>

</div>
        <div class="table-responsive" style="margin-top:10px;">
<table id="myTable" class="table table-striped table-bordered table-responsive ">
<thead>
<tr>
    <th>CONFRONTO</th>
    <th colspan="">January</th>
    <th >February</th>
    <th >March</th>
    <th >April</th>
    <th >May</th>
    <th >June</th>
    <th >July</th>
    <th >August</th>
    <th >September</th>
    <th >October</th>
    <th >November</th>
    <th >December</th>
    <th >Total</th>
</tr>                
</thead>
<tbody>
<?php
$TRoomSell =0;
$TProduzione =0;
$TRCM =0;
$TRevPar =0;
?>
<tr>
<td>Room Sell</td>
<?php
for($i=1;$i<=12;$i++){
	$query = "SELECT YEAR(on_date) AS Y, MONTH(on_date) AS m , SUM(room) AS room FROM stores_booking WHERE store_id= ".$s_hotel_data->id." AND YEAR(on_date) = ".$thisPYear." AND MONTH(on_date)= ".$i." GROUP BY y,m";
	$PYearData = $this->comman_model->get_query($query);
	//echo $this->db->last_query();
	$query = "SELECT YEAR(on_date) AS Y, MONTH(on_date) AS m , SUM(room) AS room FROM stores_booking WHERE store_id= ".$s_hotel_data->id." AND YEAR(on_date) = ".$thisYear." AND MONTH(on_date)= ".$i." GROUP BY y,m";
	$thisYearData = $this->comman_model->get_query($query);	
	if(!empty($thisYearData)&&!empty($PYearData)){
		$checkAm = $thisYearData[0]->room-$PYearData[0]->room;
		if($checkAm>=0){
			$color = 'color:#090;';
		}
		else{
			$color= 'color:#F00';
		}
		$TRoomSell = $checkAm+$TRoomSell;
		echo '<td style="'.$color.'">'.$checkAm.'</td>';
	}
	else{
		echo '<td>0</td>';
	}
}
?>
<td><?=$TRoomSell?></td>

</tr>
<tr> 
<td>Produzione</td>
<?php
for($i=1;$i<=12;$i++){
	$query = "SELECT YEAR(on_date) AS Y, MONTH(on_date) AS m , SUM(price) AS price FROM stores_booking WHERE store_id= ".$s_hotel_data->id." AND YEAR(on_date) = ".$thisPYear." AND MONTH(on_date)= ".$i." GROUP BY y,m";
	$PYearData = $this->comman_model->get_query($query);
	//echo $this->db->last_query();

	$query = "SELECT YEAR(on_date) AS Y, MONTH(on_date) AS m , SUM(price) AS price FROM stores_booking WHERE store_id= ".$s_hotel_data->id." AND YEAR(on_date) = ".$thisYear." AND MONTH(on_date)= ".$i." GROUP BY y,m";
	$thisYearData = $this->comman_model->get_query($query);	
	if(!empty($thisYearData)&&!empty($PYearData)){
		$checkAm = $thisYearData[0]->price-$PYearData[0]->price;
		if($checkAm>=0){
			$color = 'color:#090;';
		}
		else{
			$color= 'color:#F00';
		}
		$TProduzione = $checkAm+$TProduzione;
		echo '<td style="'.$color.'">'.$checkAm.'</td>';
	}
	else{
		echo '<td>0</td>';
	}
}
?>
<td style=" <?=$TProduzione>=0?'color:#090;':'color:#F00;'?>"><?=$TProduzione?></td>
</tr>
<tr> 
<td>RCM</td>
<?php
for($i=1;$i<=12;$i++){
	$tempPtotalRCM =0;
	$tempTtotalRCM =0;
	$query = "SELECT YEAR(on_date) AS Y, MONTH(on_date) AS m , SUM(room) AS room FROM stores_booking WHERE store_id= ".$s_hotel_data->id." AND YEAR(on_date) = ".$thisPYear." AND MONTH(on_date)= ".$i." GROUP BY y,m";
	$PYearData1 = $this->comman_model->get_query($query);
	$query = "SELECT YEAR(on_date) AS Y, MONTH(on_date) AS m , SUM(price) AS price FROM stores_booking WHERE store_id= ".$s_hotel_data->id." AND YEAR(on_date) = ".$thisPYear." AND MONTH(on_date)= ".$i." GROUP BY y,m";
	$PYearData2 = $this->comman_model->get_query($query);
	//echo $this->db->last_query();
	if($PYearData1&&$PYearData2){
		$tempPtotalRCM = round(($PYearData2[0]->price/$PYearData1[0]->room),0);
	}

	$query = "SELECT YEAR(on_date) AS Y, MONTH(on_date) AS m , SUM(room) AS room FROM stores_booking WHERE store_id= ".$s_hotel_data->id." AND YEAR(on_date) = ".$thisYear." AND MONTH(on_date)= ".$i." GROUP BY y,m";
	$thisYearData1 = $this->comman_model->get_query($query);	
	$query = "SELECT YEAR(on_date) AS Y, MONTH(on_date) AS m , SUM(price) AS price FROM stores_booking WHERE store_id= ".$s_hotel_data->id." AND YEAR(on_date) = ".$thisYear." AND MONTH(on_date)= ".$i." GROUP BY y,m";
	$thisYearData2 = $this->comman_model->get_query($query);	
	if($thisYearData1&&$thisYearData){
		$tempTtotalRCM = round(($thisYearData2[0]->price/$thisYearData1[0]->room),0);
	}

	$checkAm = $tempTtotalRCM-$tempPtotalRCM;
	if($checkAm>=0){
		$color = 'color:#090;';
	}
	else{
		$color= 'color:#F00';
	}
	$TRCM = $checkAm+$TRCM;
	echo '<td style="'.$color.'">'.$checkAm.'</td>';

}
?>
<td style=" <?=$TRCM>=0?'color:#090;':'color:#F00;'?>"><?=round($TRCM/12,0)?></td>
</tr>
<tr> 
<td>RevPar</td>
<?php
for($i=1;$i<=12;$i++){
	$tempPRevPar =0;
	$tempTRevPar =0;
	$query = "SELECT YEAR(on_date) AS Y, MONTH(on_date) AS m , SUM(price) AS price FROM stores_booking WHERE store_id= ".$s_hotel_data->id." AND YEAR(on_date) = ".$thisPYear." AND MONTH(on_date)= ".$i." GROUP BY y,m";
	$PYearData = $this->comman_model->get_query($query);
	//echo $this->db->last_query();
	if($PYearData){
		$totalMP = 0;
		if($i==1||$i==3||$i==5||$i==7||$i==8||$i==10||$i==12){
			$totalMP =$totalRoom*31;
		}
		elseif($i==4||$i==6||$i==9||$i==11){
			$totalMP =$totalRoom*30;
		}
		elseif($i==2){
			$totalMP =$totalRoom*date('t',strtotime('-1 year', $nowTime));
		}
		$tempPRevPar= round(($PYearData[0]->price/$totalMP),0);
		//echo '<td>'.$totalMP.'</td>';
	}

	$query = "SELECT YEAR(on_date) AS Y, MONTH(on_date) AS m , SUM(price) AS price FROM stores_booking WHERE store_id= ".$s_hotel_data->id." AND YEAR(on_date) = ".$thisYear." AND MONTH(on_date)= ".$i." GROUP BY y,m";
	$thisYearData = $this->comman_model->get_query($query);	
	if(!empty($thisYearData)){
		$totalMP = 0;
		if($i==1||$i==3||$i==5||$i==7||$i==8||$i==10||$i==12){
			$totalMP =$totalRoom*31;
		}
		elseif($i==4||$i==6||$i==9||$i==11){
			$totalMP =$totalRoom*30;
		}
		elseif($i==2){
			$totalMP =$totalRoom*date('t',$nowTime);
		}
		//echo '<td>'.$totalMP.'</td>';
		$tempTRevPar = round(($thisYearData[0]->price/$totalMP),0);
	}
	$checkAm = $tempTRevPar-$tempPRevPar;
	if($checkAm>=0){
		$color = 'color:#090;';
	}
	else{
		$color= 'color:#F00';
	}
	$TRevPar = $checkAm+$TRevPar;
	echo '<td style="'.$color.'">'.$checkAm.'</td>';
	
}
?>
<td style=" <?=$TRevPar>=0?'color:#090;':'color:#F00;'?>"><?=round($TRevPar/12,0)?></td>
</tr>
<tr> 
<td>OCC%</td>
<?php
$TOCC = 0;
for($i=1;$i<=12;$i++){
	$tempPOCC =0;
	$tempTOCC =0;
	$query = "SELECT YEAR(on_date) AS Y, MONTH(on_date) AS m , SUM(room) AS room FROM stores_booking WHERE store_id= ".$s_hotel_data->id." AND YEAR(on_date) = ".$thisPYear." AND MONTH(on_date)= ".$i." GROUP BY y,m";
	$PYearData = $this->comman_model->get_query($query);
	//echo $this->db->last_query();
	if($PYearData){
		$totalMP = 0;
		if($i==1||$i==3||$i==5||$i==7||$i==8||$i==10||$i==12){
			$totalMP =$totalRoom*31;
		}
		elseif($i==4||$i==6||$i==9||$i==11){
			$totalMP =$totalRoom*30;
		}
		elseif($i==2){
			$totalMP =$totalRoom*date('t',strtotime('-1 year', $nowTime));
		}
		$tempPOCC= round((($PYearData[0]->room/$totalMP)*100),0);
		//echo '<td>'.$totalMP.'</td>';
	}

	$query = "SELECT YEAR(on_date) AS Y, MONTH(on_date) AS m , SUM(room) AS room FROM stores_booking WHERE store_id= ".$s_hotel_data->id." AND YEAR(on_date) = ".$thisYear." AND MONTH(on_date)= ".$i." GROUP BY y,m";
	$thisYearData = $this->comman_model->get_query($query);	
	if(!empty($thisYearData)){
		$totalMP = 0;
		if($i==1||$i==3||$i==5||$i==7||$i==8||$i==10||$i==12){
			$totalMP =$totalRoom*31;
		}
		elseif($i==4||$i==6||$i==9||$i==11){
			$totalMP =$totalRoom*30;
		}
		elseif($i==2){
			$totalMP =$totalRoom*date('t',$nowTime);
		}
		//echo '<td>'.$totalMP.'</td>';
		$tempTOCC= round((($thisYearData[0]->room/$totalMP)*100),0);
	}
	$checkAm = $tempTOCC-$tempPOCC;
	if($checkAm>=0){
		$color = 'color:#090;';
	}
	else{
		$color= 'color:#F00';
	}
	$TOCC = $checkAm+$TOCC;
	echo '<td style="'.$color.'">'.$checkAm.'%</td>';
}
?>
<td style=" <?=$TOCC>=0?'color:#090;':'color:#F00;'?>"><?=round($TOCC/12,0)?>%</td>
</tr>
<tr><td colspan="14" style="">&nbsp;</td>
</tr>

<tr>
<td>Room Sell</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr> 
<td>Produzione</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr> 
<td>RCM</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr> 
<td>RevPar</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>

</tr>
<tr> 
<td>OCC%</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>


</tbody>
</table>

</div>
    </div><!--//step1//-->
    <div id="step-2" class="tab-pane fade ">
	    <div class="table-responsive">
<?php
$query = "SELECT date, DAY(DATE)AS d, MONTH(DATE) AS m,YEAR(DATE) AS Y  FROM stores_booking where store_id= ".$s_hotel_data->id." GROUP BY Y,m,d ORDER BY  Y,m,d asc";
$getuploadsdate = $this->comman_model->get_query($query);
?>
<table id="myTable" class="table table-striped table-bordered table-responsive ">
<thead>
<tr>
    <th colspan="2">Osservazione</th>
<?php
if($getuploadsdate){
	foreach($getuploadsdate as $setD){
?>
<th><?=date("d-m-Y", strtotime($setD->{'date'}));?></th>
<?php		
	}
}
?>
</tr>

</thead>
<tbody>
<?php
$allDate  = getallDate('2016');
if($allDate){
	foreach($allDate as $setD){
?>
<tr>
<td rowspan="2"><?=date("d-m-Y", strtotime($setD))?></td>
<td >Price</td>
<?php
if($getuploadsdate){
	foreach($getuploadsdate as $setDs){
		$PTempPrice =0;
		$query = "SELECT `price` FROM (`stores_booking`) WHERE store_id= ".$s_hotel_data->id." AND `date` = '".$setDs->{'date'}."' AND DATE(`on_date`) = '".$setD."'";
		$getData = $this->comman_model->get_query($query);		
		if($getData[0]){
			$PTempPrice = $getData[0]->price;
		}
?>
<td><?=$PTempPrice;?>&euro;</td>
<?php		
	}
}
?>
</tr>
<tr>
<td >Room</td>
<?php
if($getuploadsdate){
	foreach($getuploadsdate as $setDs){
		$PTempRoom =0;
		$query = "SELECT `room` FROM (`stores_booking`) WHERE store_id= ".$s_hotel_data->id."  AND `date` = '".$setDs->{'date'}."' AND DATE(`on_date`) = '".$setD."'";
		$getData = $this->comman_model->get_query($query);		
		if($getData[0]){
			$PTempRoom = $getData[0]->room;
		}
?>
<td><?=$PTempRoom;?></td>
<?php		
	}
}
?>
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
