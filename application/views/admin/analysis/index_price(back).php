<?php
$getUrlData = parse_url($_SERVER['REQUEST_URI']);
?>
<script>
$(document).ready(function() {
	$('[data-click=sidebar-minify]').trigger("click");
});
</script>
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
    <li class=""><a href="<?=$_cancel.'?hotel_id='.$this->input->get('hotel_id').'&type=';?>">Year Analysis</a></li>
    <li class="active"><a href="javascript:void(0);">Price Room Analysis</a></li>
</ul>	    

<div class="tab-content" style="padding:10px 0">
    <div id="step-2" class="tab-pane fade active in">
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
