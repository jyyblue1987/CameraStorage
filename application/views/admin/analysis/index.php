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
    <li class="active"><a href="javascript:void(0);">Year Analysis</a></li>
    <li class=""><a href="<?=$_cancel.'?hotel_id='.$this->input->get('hotel_id').'&type=price_analysis';?>">Price Room Analysis</a></li>
    <li class=""><a href="<?=$_cancel.'?hotel_id='.$this->input->get('hotel_id').'&type=comparison_engine';?>">Comparison Engine</a></li>
    <li class=""><a href="<?=$_cancel.'?hotel_id='.$this->input->get('hotel_id').'&type=pickup';?>">Pick2016</a></li>
</ul>	    

<div class="tab-content" style="padding:10px 0">
    <div id="step-1" class="tab-pane fade active in">
        <div class="table-responsive">
<table id="myTable" class="table table-striped table-bordered table-responsive ">
<thead>
<tr>
    <th>&nbsp;</th>
    <th colspan="2" style="text-align:center">January</th>
    <th colspan="2" style="text-align:center">February</th>
    <th colspan="2" style="text-align:center">March</th>
    <th colspan="2" style="text-align:center">April</th>
    <th colspan="2" style="text-align:center">May</th>
    <th colspan="2" style="text-align:center">June</th>
    <th colspan="2" style="text-align:center">July</th>
    <th colspan="2" style="text-align:center">August</th>
    <th colspan="2" style="text-align:center">September</th>
    <th colspan="2" style="text-align:center">October</th>
    <th colspan="2" style="text-align:center">November</th>
    <th colspan="2" style="text-align:center">December</th>
    <th colspan="2" style="text-align:center">Total</th>

</tr>
<tr>
    <th>&nbsp;</th>
<?php
$nowTime =time();
$thisYear = date('Y',$nowTime);
$thisPYear = date('Y',strtotime('-1 year', $nowTime));
for($i=1;$i<=13;$i++){
	echo '<th style="text-align:center">'.$thisPYear.'</th><th style="text-align:center">'.$thisYear.'</th>';
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
$ARS =array();
for($i=1;$i<=12;$i++){
	$query = "SELECT YEAR(on_date) AS Y, MONTH(on_date) AS m , SUM(room) AS room FROM stores_booking WHERE YEAR(on_date) = ".$thisPYear." AND MONTH(on_date)= ".$i." AND store_id= ".$s_hotel_data->id."  GROUP BY y,m";
	$PYearData = $this->comman_model->get_query($query);
	//echo $this->db->last_query();
	if($PYearData){
		$ARS[$i] = round($PYearData[0]->room,0);
		$PtotalRoomSellR = round($PYearData[0]->room,0)+$PtotalRoomSellR;
		echo '<td>'.round($PYearData[0]->room,0).'</td>';
	}
	else{
		$ARS[$i] = 0;
		echo '<td>0</td>';
	}

	$query = "SELECT YEAR(on_date) AS Y, MONTH(on_date) AS m , SUM(room) AS room FROM stores_booking WHERE YEAR(on_date) = ".$thisYear." AND MONTH(on_date)= ".$i." AND store_id= ".$s_hotel_data->id." GROUP BY y,m";
	$thisYearData = $this->comman_model->get_query($query);	
	if(!empty($thisYearData)){
		$TtotalRoomSellR = round($PYearData[0]->room,0)+$TtotalRoomSellR;
		echo '<td>'.round($thisYearData[0]->room,0).'</td>';
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
$proArr = array();
for($i=1;$i<=12;$i++){
	$query = "SELECT YEAR(on_date) AS Y, MONTH(on_date) AS m , SUM(price) AS price FROM stores_booking WHERE YEAR(on_date) = ".$thisPYear." AND MONTH(on_date)= ".$i." AND store_id= ".$s_hotel_data->id." GROUP BY y,m";
	$PYearData = $this->comman_model->get_query($query);
	//echo $this->db->last_query();
	if($PYearData){
		$PtotalRoomSellP = round($PYearData[0]->price,0)+$PtotalRoomSellP;
		$proArr[$i] = round($PYearData[0]->price,0);
		echo '<td>'.round($PYearData[0]->price,0).'</td>';
	}
	else{
		$proArr[$i] = 0;
		echo '<td>0</td>';
	}

	$query = "SELECT YEAR(on_date) AS Y, MONTH(on_date) AS m , SUM(price) AS price FROM stores_booking WHERE YEAR(on_date) = ".$thisYear." AND MONTH(on_date)= ".$i." AND store_id= ".$s_hotel_data->id." GROUP BY y,m";
	$thisYearData = $this->comman_model->get_query($query);	
	if(!empty($thisYearData)){
		$TtotalRoomSellP = round($PYearData[0]->price,0)+$TtotalRoomSellP;
		echo '<td>'.round($thisYearData[0]->price,0).'</td>';
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
$ARCMArr = array();
for($i=1;$i<=12;$i++){
	$query = "SELECT YEAR(on_date) AS Y, MONTH(on_date) AS m , SUM(room) AS room FROM stores_booking WHERE YEAR(on_date) = ".$thisPYear." AND MONTH(on_date)= ".$i." AND store_id= ".$s_hotel_data->id." GROUP BY y,m";
	$PYearData1 = $this->comman_model->get_query($query);
	$query = "SELECT YEAR(on_date) AS Y, MONTH(on_date) AS m , SUM(price) AS price FROM stores_booking WHERE store_id= ".$s_hotel_data->id." AND YEAR(on_date) = ".$thisPYear." AND MONTH(on_date)= ".$i." GROUP BY y,m";
	$PYearData2 = $this->comman_model->get_query($query);
	//echo $this->db->last_query();
	if(!empty($PYearData1)&&!empty($PYearData2)&&isset($PYearData1[0])&&isset($PYearData2[0])&&$PYearData2[0]->price>0&&$PYearData1[0]->room>0){
		//echo $PYearData2[0]->price.' '.$PYearData1[0]->room;
		$ARCMArr[$i] =round(($PYearData2[0]->price/$PYearData1[0]->room),0);
		$PtotalRCM = round(($PYearData2[0]->price/$PYearData1[0]->room),0)+$PtotalRCM;
		echo '<td>'.round(($PYearData2[0]->price/$PYearData1[0]->room),0).'</td>';
	}
	else{
		$ARCMArr[$i] = 0;
		echo '<td>0</td>';
	}
	//	echo '</td>';
	$query = "SELECT YEAR(on_date) AS Y, MONTH(on_date) AS m , SUM(room) AS room FROM stores_booking WHERE store_id= ".$s_hotel_data->id." AND YEAR(on_date) = ".$thisYear." AND MONTH(on_date)= ".$i." GROUP BY y,m";
	$thisYearData1 = $this->comman_model->get_query($query);	
	//echo $this->db->last_query();
	$query = "SELECT YEAR(on_date) AS Y, MONTH(on_date) AS m , SUM(price) AS price FROM stores_booking WHERE store_id= ".$s_hotel_data->id." AND YEAR(on_date) = ".$thisYear." AND MONTH(on_date)= ".$i." GROUP BY y,m";
	$thisYearData2 = $this->comman_model->get_query($query);	
	if(!empty($thisYearData1)&&!empty($thisYearData2)&&isset($thisYearData2[0])&&isset($thisYearData1[0])&&$thisYearData2[0]->price>0&&$thisYearData1[0]->room>0){
		//echo $thisYearData2[0]->price.'-'.$thisYearData1[0]->room.'<br>';
		$TtotalRCM = round(($thisYearData2[0]->price/$thisYearData1[0]->room),0)+$TtotalRCM;
		echo '<td>'.round(($thisYearData2[0]->price/$thisYearData1[0]->room),0).'</td>';
	}
	else{
		echo '<td>0</td>';
	}
}
?>
<td><?=($PtotalRCM>0)?round(($PtotalRCM/12),0):0;?></td>
<td><?=($TtotalRCM>0)?round(($TtotalRCM/12),0):0;?></td>

</tr>
<tr> 
<td>RevPar</td>
<?php
$ARevParArr =array();
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
		$ARevParArr[$i] = round(($PYearData[0]->price/$totalMP),0);
		echo '<td>'.round(($PYearData[0]->price/$totalMP),0).'</td>';
		//echo '<td>'.$totalMP.'</td>';
	}
	else{
		$ARevParArr[$i] = 0;
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
<td><?=($PtotalRevPar>0)?round(($PtotalRevPar/12),0):0;?></td>
<td><?=($TtotalRevPar>0)?round(($TtotalRevPar/12),0):0;?></td>
</tr>
<tr> 
<td>OCC</td>
<?php
$AOCCArr = array();
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
		$AOCCArr[$i] =round((($PYearData[0]->room/$totalMP)*100),0);
		echo '<td>'.round((($PYearData[0]->room/$totalMP)*100),0).'%</td>';
		//echo '<td>'.$totalMP.'</td>';
	}
	else{
		$AOCCArr[$i] =0;
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
    <th style="text-align:center">CONFRONTO</th>
    <th style="text-align:center">January</th>
    <th style="text-align:center" >February</th>
    <th style="text-align:center" >March</th>
    <th style="text-align:center" >April</th>
    <th style="text-align:center">May</th>
    <th style="text-align:center" >June</th>
    <th style="text-align:center">July</th>
    <th style="text-align:center">August</th>
    <th style="text-align:center">September</th>
    <th style="text-align:center">October</th>
    <th style="text-align:center">November</th>
    <th style="text-align:center">December</th>
    <th style="text-align:center">Total</th>
</tr>                
</thead>
<tbody>
<?php
$TRoomSell =0;
$TProduzione =0;
$TRCM =0;
$TRevPar = 0;
?>
<tr>
<td>Room Sell</td>
<?php
$DRS = array();
for($i=1;$i<=12;$i++){
	$query = "SELECT YEAR(on_date) AS Y, MONTH(on_date) AS m , SUM(room) AS room FROM stores_booking WHERE store_id= ".$s_hotel_data->id." AND YEAR(on_date) = ".$thisPYear." AND MONTH(on_date)= ".$i." GROUP BY y,m";
	$PYearData = $this->comman_model->get_query($query);
	//echo $this->db->last_query();
	$query = "SELECT YEAR(on_date) AS Y, MONTH(on_date) AS m , SUM(room) AS room FROM stores_booking WHERE store_id= ".$s_hotel_data->id." AND YEAR(on_date) = ".$thisYear." AND MONTH(on_date)= ".$i." GROUP BY y,m";
	$thisYearData = $this->comman_model->get_query($query);	
	if(!empty($thisYearData)&&!empty($PYearData)){
		$checkAm = $thisYearData[0]->room-$PYearData[0]->room;
		$DRS[$i]= $thisYearData[0]->room-$PYearData[0]->room;
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
		$DRS[$i] = 0;
		echo '<td>0</td>';
	}
}
?>
<td style=" <?=$TRoomSell>=0?'color:#090;':'color:#F00;'?>"><?=$TRoomSell?></td>

</tr>
<tr> 
<td>Produzione</td>
<?php
$DProdArr = array();
for($i=1;$i<=12;$i++){
	$query = "SELECT YEAR(on_date) AS Y, MONTH(on_date) AS m , SUM(price) AS price FROM stores_booking WHERE store_id= ".$s_hotel_data->id." AND YEAR(on_date) = ".$thisPYear." AND MONTH(on_date)= ".$i." GROUP BY y,m";
	$PYearData = $this->comman_model->get_query($query);
	//echo $this->db->last_query();

	$query = "SELECT YEAR(on_date) AS Y, MONTH(on_date) AS m , SUM(price) AS price FROM stores_booking WHERE store_id= ".$s_hotel_data->id." AND YEAR(on_date) = ".$thisYear." AND MONTH(on_date)= ".$i." GROUP BY y,m";
	$thisYearData = $this->comman_model->get_query($query);	
	if(!empty($thisYearData)&&!empty($PYearData)){
		$checkAm = round($thisYearData[0]->price-$PYearData[0]->price,0);
		$DProdArr[$i]= $checkAm;
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
		$DProdArr[$i]= 0;
		echo '<td>0</td>';
	}
}
?>

<td style=" <?=$TProduzione>=0?'color:#090;':'color:#F00;'?>"><?=$TProduzione?></td>
</tr>
<tr> 
<td>RCM</td>
<?php
$DRCMArr = array();
for($i=1;$i<=12;$i++){
	$tempPtotalRCM =0;
	$tempTtotalRCM =0;
	$query = "SELECT YEAR(on_date) AS Y, MONTH(on_date) AS m , SUM(room) AS room FROM stores_booking WHERE store_id= ".$s_hotel_data->id." AND YEAR(on_date) = ".$thisPYear." AND MONTH(on_date)= ".$i." GROUP BY y,m";
	$PYearData1 = $this->comman_model->get_query($query);
	
	$query = "SELECT YEAR(on_date) AS Y, MONTH(on_date) AS m , SUM(price) AS price FROM stores_booking WHERE store_id= ".$s_hotel_data->id." AND YEAR(on_date) = ".$thisPYear." AND MONTH(on_date)= ".$i." GROUP BY y,m";
	$PYearData2 = $this->comman_model->get_query($query);
	//echo $this->db->last_query();
	if($PYearData1&&$PYearData2&&$PYearData1[0]->room>0&&$PYearData2[0]->price>0){
		$tempPtotalRCM = round(($PYearData2[0]->price/$PYearData1[0]->room),0);
	}

	$query = "SELECT YEAR(on_date) AS Y, MONTH(on_date) AS m , SUM(room) AS room FROM stores_booking WHERE store_id= ".$s_hotel_data->id." AND YEAR(on_date) = ".$thisYear." AND MONTH(on_date)= ".$i." GROUP BY y,m";
	$thisYearData1 = $this->comman_model->get_query($query);	
	$query = "SELECT YEAR(on_date) AS Y, MONTH(on_date) AS m , SUM(price) AS price FROM stores_booking WHERE store_id= ".$s_hotel_data->id." AND YEAR(on_date) = ".$thisYear." AND MONTH(on_date)= ".$i." GROUP BY y,m";
	$thisYearData2 = $this->comman_model->get_query($query);	
	if($thisYearData1&&$thisYearData2&&$thisYearData1[0]->room>0&&$thisYearData2[0]->price>0){
		$tempTtotalRCM = round(($thisYearData2[0]->price/$thisYearData1[0]->room),0);
	}
	$checkAm = $tempTtotalRCM-$tempPtotalRCM;
	$DRCMArr[$i] = $checkAm;
	
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
$DRevParArr =array();
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
	$DRevParArr[$i] =$checkAm;
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
$DOCCArr = array();
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
	$DOCCArr[$i] = $checkAm;
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
<?php
$perRS =0;
for($i=1;$i<=12;$i++){
	if(isset($DRS[$i])&&isset($ARS[$i])&&$DRS[$i]!=0&&$ARS[$i]!=0){
	$dl =	round(($DRS[$i]/$ARS[$i])*100,0);
	$perRS =$perRS+$dl;
?>
<td style=" <?=$dl>=0?'color:#090;':'color:#F00;'?>"><?=$dl?>%</td>
<?php
	}
	else{
		echo '<td style="color:#090;">0%</td>';
	}
}
?>
<td style=" <?=round($perRS/12,0)>=0?'color:#090;':'color:#F00;'?>"><?=round($perRS/12,0)?>%</td>

</tr>
<tr> 
<td>Produzione</td>
<?php
$perProduz =0;
for($i=1;$i<=12;$i++){
	if(isset($proArr[$i])&&isset($DProdArr[$i])&&$DProdArr[$i]!=0&&$proArr[$i]!=0){
	$dl =	round(($DProdArr[$i]/$proArr[$i])*100,0);
	$perProduz =$perProduz+$dl;
/*	echo $DProdArr[$i].'/'.$proArr[$i];*/
?>
<td style=" <?=$dl>=0?'color:#090;':'color:#F00;'?>"><?=$dl?>%</td>
<?php
	}
	else{
		echo '<td style="color:#090;">0%</td>';
	}
}
?>
<td style=" <?=round($perProduz/12,0)>=0?'color:#090;':'color:#F00;'?>"><?=round($perProduz/12,0)?>%</td>
</tr>
<tr> 
<td>RCM</td>
<?php
$perRCM =0;
for($i=1;$i<=12;$i++){
	if(isset($ARCMArr[$i])&&isset($DRCMArr[$i])&&$ARCMArr[$i]!=0&&$DRCMArr[$i]!=0){
	$dl =	round(($DRCMArr[$i]/$ARCMArr[$i])*100,0);
	$perRCM =$perRCM+$dl;
/*	echo '<td>'.$DRCMArr[$i].'/'.$ARCMArr[$i].'</td>';*/
?>
<td style=" <?=$dl>=0?'color:#090;':'color:#F00;'?>"><?=$dl?>%</td>
<?php
	}
	else{
		echo '<td style="color:#090;">0%</td>';
	}
}
?>
<td style=" <?=round($perRCM/12,0)>=0?'color:#090;':'color:#F00;'?>"><?=round($perRCM/12,0)?>%</td>
</tr>
<tr> 
<td>RevPar</td>
<?php
$perRevPar =0;
for($i=1;$i<=12;$i++){
	if(isset($DRevParArr[$i])&&isset($ARevParArr[$i])&&$DRevParArr[$i]!=0&&$ARevParArr[$i]!=0){
	$dl =	round(($DRevParArr[$i]/$ARevParArr[$i])*100,0);
	$perRevPar =$perRevPar+$dl;
/*	echo '<td>'.$DRCMArr[$i].'/'.$ARCMArr[$i].'</td>';*/
?>
<td style=" <?=$dl>=0?'color:#090;':'color:#F00;'?>"><?=$dl?>%</td>
<?php
	}
	else{
		echo '<td style="color:#090;">0%</td>';
	}
}
?>
<td style=" <?=round($perRevPar/12,0)>=0?'color:#090;':'color:#F00;'?>"><?=round($perRevPar/12,0)?>%</td>
</tr>
<tr> 
<td>OCC%</td>
<?php
$perOCC =0;
for($i=1;$i<=12;$i++){
	if(isset($DOCCArr[$i])&&isset($AOCCArr[$i])&&$DOCCArr[$i]!=0&&$AOCCArr[$i]!=0){
	$dl =	round(($DOCCArr[$i]/$AOCCArr[$i])*100,0);
	$perOCC =$perOCC+$dl;
/*	echo '<td>'.$DRCMArr[$i].'/'.$ARCMArr[$i].'</td>';*/
?>
<td style=" <?=$dl>=0?'color:#090;':'color:#F00;'?>"><?=$dl?>%</td>
<?php
	}
	else{
		echo '<td style="color:#090;">0%</td>';
	}
}
?>
<td style=" <?=round($perOCC/12,0)>=0?'color:#090;':'color:#F00;'?>"><?=round($perOCC/12,0)?>%</td>
</tr>


</tbody>
</table>

</div>
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
