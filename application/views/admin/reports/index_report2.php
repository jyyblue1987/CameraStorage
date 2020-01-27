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
<input type="hidden" name="type" value="report2" />

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
    <li class=""><a href="<?=$_cancel.'?hotel_id='.$this->input->get('hotel_id').'&type=';?>">Report 1</a></li>
    <li class="active"><a href="javascript:void(0);">Report 2</a></li>
    <li class=""><a href="<?=$_cancel.'?hotel_id='.$this->input->get('hotel_id').'&type=report3';?>">Report 3</a></li>
</ul>	    

<div class="tab-content" style="padding:10px 0">
    <div id="step-1" class="tab-pane fade active in">
 <div >
 <form class="form-horizontal"  mothed="get" action="">
<input type="hidden" name="type" value="report2" />
<input type="hidden" name="hotel_id" value="<?=$this->input->get('hotel_id')?>" />

<div class="form-body">                    
	<div class="col-md-12">						                        
        <div class="form-group">
          <label class="col-lg-1 control-label">Date</label>
          <div class="col-lg-2">
            <input class="form-control" type="text" id="best_sellers_start" placeholder="Date" name="gDate"  data-date-format="dd-mm-yyyy" value="<?=$this->input->get('gDate');?>" />
          </div>

          <label class="col-lg-1 control-label">Data</label>
          <div class="col-lg-2">
            <select class="form-control" name="show_data" id=""   required>
<?php

$getshowdata = $this->input->get('show_data');

?>
<option value="next" <?=(!empty($getshowdata)&&$getshowdata=='next')?'selected="selected"':'' ;?>   >Next</option>
<option value="previous" <?=(!empty($getshowdata)&&$getshowdata=='previous')?'selected="selected"':'' ;?>   >Previous</option>

            </select>
          </div>
          <label class="col-lg-1 control-label">Weeks</label>
          <div class="col-lg-2">
            <select class="form-control" name="weeks" id=""   required>
<?php
$getweeks = $this->input->get('weeks');
?>
<option value="1" <?=(!empty($getweeks)&&$getweeks=='1')?'selected="selected"':'' ;?>   >1 Week</option>
<option value="2" <?=(!empty($getweeks)&&$getweeks=='2')?'selected="selected"':'' ;?>   >2 Week</option>
<option value="3" <?=(!empty($getweeks)&&$getweeks=='3')?'selected="selected"':'' ;?>   >3 Week</option>

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
  <div style="clear:both"></div>  
        <div class="table-responsive">
<?php
if(isset($date_file_data)&&!empty($date_file_data)){
?>
<div class="row">
	    <div class="col-md-6">
    		<div class="btn-group">
			    <a href="<?=$_cancel.'/export2?hotel_id='.$s_hotel_data->id.'&gDate='.$this->input->get('gDate').'&show_data='.$this->input->get('show_data').'&weeks='.$this->input->get('weeks').'';?>" class="btn btn-primary m-r-5 m-b-5">Export</a>
		    </div>
	    </div>
	    </div>
<table id="myTable" class="table table-striped table-bordered table-responsive ">
<thead>
<tr>
    <th>Date</th>
<?php
if(isset($date_file_data)&&!empty($date_file_data)){
	foreach($date_file_data as $setD){
?>
<th colspan="2" style="text-align:center"><?=date("d-m-Y", strtotime($setD->{'date'}));?></th>
<?php		
	}
}
?>

</tr>
<tr>
    <th colspan="" style="text-align:center">&nbsp;</th>
<?php
if(isset($date_file_data)&&!empty($date_file_data)){
	foreach($date_file_data as $setD){
?>
<th  style="text-align:center">Price</th>
<th  style="text-align:center">Room</th>
<?php		
	}
}
?>
</tr>
</thead>
<tbody>
<?php
$getdate = $this->input->get('gDate');
$celYear = date('Y');
if(!empty($getdate)){
$celYear = date('Y',strtotime($getdate));
}
$allDate  = getallDate($celYear);
if($allDate){
	$ToTotalRoom =0;
	$ToTotalPrice =0;
	$PTotalRoom =0;
	$PTotalPrice =0;
	foreach($allDate as $setD){
		$expDate = explode('-',$setD);
?>
<tr>
<td ><?=date("d-m-Y", strtotime($setD))?></td>
<?php
if(isset($date_file_data)&&!empty($date_file_data)){
	foreach($date_file_data as $setDs){
		$PTempRoom =0;
		$PTempPrice =0;
		$query = "SELECT `price` ,`room` FROM (`stores_booking`) WHERE store_id= ".$s_hotel_data->id." AND `date` = '".$setDs->{'date'}."' AND DAY(`on_date`) = '".$expDate[2]."' AND  MONTH(`on_date`) = '".$expDate[1]."' ";
		$getData = $this->comman_model->get_query($query);		
		//echo '<br>'.$setDs->Y.'-'.$setD;
		//echo $this->db->last_query();
		if(!empty($getData)&&isset($getData[0])){
			$PTempRoom = $getData[0]->room;
			$PTempPrice = $getData[0]->price;
		}
?>
<td>&euro;<?=round($PTempPrice,2);?></td>
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

<?php
}
?>
</div><!--//jan//-->
        
    </div><!--//step1//-->
</div>
<?php
}
?>
        <!-- end panel -->
    </div>
</div>









<link href="assets/global/plugins/bootstrap-datepicker/css/datepicker.css"  rel='stylesheet' type='text/css' >
<script type="text/javascript" src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script>
$(document).ready(function(){
	//$('&nbsp;').appendTo('div.dataTables_filter');
	//$('div.dataTables_filter').appendTo('<button id="refresh">Refresh</button>');
	$('#best_sellers_start').datepicker({ dateFormat: 'mm-dd-yy', altField: '#best_sellers_start_alt', altFormat: 'yy-mm-dd' });

});
</script>
<script>

$('.page-header').hide();
</script>
<style>
table td{
	padding:10px 3px !important;
}
</style>
