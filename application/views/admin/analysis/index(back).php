<style>
table tr th,table tr td{
	padding:2px !important; 
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
	<div class="panel-body">

<?php echo validation_errors();?>
<form class="form-horizontal"  mothed="get" action="">

<div class="form-body">                    
	<div class="col-md-12">						                        
        <div class="form-group">
          <label class="col-lg-2 control-label">Hotel</label>
          <div class="col-lg-8">

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
        </div>
</div>






</div>
	                 <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-2 col-md-9">
                                    <?=form_submit('submit', 'Enter', 'class="btn btn-primary"')?>
                                </div>
                            </div>
                        </div>
</form>
            </div>

	    <ul class="nav nav-tabs">
						<li class="active"><a href="#step-1" data-toggle="tab">StatisticheMese</a></li>
						<li class=""><a href="#step-2" data-toggle="tab">entry Rooms</a></li>
						<li class=""><a href="#step-3" data-toggle="tab">Entry Prod</a></li>
					</ul>

				<div class="tab-content">
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

                </tr>
                <tr>
                	<th>&nbsp;</th>
                    <th>2015</th>
                    <th>2016</th>
                    <th>2015</th>
                    <th>2016</th>
                    <th>2015</th>
                    <th>2016</th>
                    <th>2015</th>
                    <th>2016</th>
                    <th>2015</th>
                    <th>2016</th>
                    <th>2015</th>
                    <th>2016</th>
                    <th>2015</th>
                    <th>2016</th>
                    <th>2015</th>
                    <th>2016</th>
                    <th>2015</th>
                    <th>2016</th>
                    <th>2015</th>
                    <th>2016</th>
                    <th>2015</th>
                    <th>2016</th>
                    <th>2015</th>
                    <th>2016</th>
                </tr>
                </thead>
                <tbody>
<?php
if(isset($s_hotel_data)&&!empty($s_hotel_data)){
$query = "SELECT YEAR(on_date) AS Y, MONTH(on_date) AS m , SUM(price) AS price FROM stores_booking WHERE MONTH(on_date) = 1 GROUP BY m, y	";
$jan = $this->comman_model->get_query($query);

$query = "SELECT YEAR(on_date) AS Y, MONTH(on_date) AS m , SUM(price) AS price FROM stores_booking WHERE MONTH(on_date) = 2 GROUP BY m, y	";
$fab = $this->comman_model->get_query($query);

$query = "SELECT YEAR(on_date) AS Y, MONTH(on_date) AS m , SUM(price) AS price FROM stores_booking WHERE MONTH(on_date) = 3 GROUP BY m, y	";
$mar = $this->comman_model->get_query($query);

$query = "SELECT YEAR(on_date) AS Y, MONTH(on_date) AS m , SUM(price) AS price FROM stores_booking WHERE MONTH(on_date) = 4 GROUP BY m, y	";
$apr = $this->comman_model->get_query($query);

$query = "SELECT YEAR(on_date) AS Y, MONTH(on_date) AS m , SUM(price) AS price FROM stores_booking WHERE MONTH(on_date) = 5 GROUP BY m, y	";
$may = $this->comman_model->get_query($query);

$query = "SELECT YEAR(on_date) AS Y, MONTH(on_date) AS m , SUM(price) AS price FROM stores_booking WHERE MONTH(on_date) = 6 GROUP BY m, y	";
$jun = $this->comman_model->get_query($query);

$query = "SELECT YEAR(on_date) AS Y, MONTH(on_date) AS m , SUM(price) AS price FROM stores_booking WHERE MONTH(on_date) = 7 GROUP BY m, y	";
$jul = $this->comman_model->get_query($query);

$query = "SELECT YEAR(on_date) AS Y, MONTH(on_date) AS m , SUM(price) AS price FROM stores_booking WHERE MONTH(on_date) = 8 GROUP BY m, y	";
$aus = $this->comman_model->get_query($query);

$query = "SELECT YEAR(on_date) AS Y, MONTH(on_date) AS m , SUM(price) AS price FROM stores_booking WHERE MONTH(on_date) = 9 GROUP BY m, y	";
$sep = $this->comman_model->get_query($query);
$query = "SELECT YEAR(on_date) AS Y, MONTH(on_date) AS m , SUM(price) AS price FROM stores_booking WHERE MONTH(on_date) = 10 GROUP BY m, y	";
$oct = $this->comman_model->get_query($query);
$query = "SELECT YEAR(on_date) AS Y, MONTH(on_date) AS m , SUM(price) AS price FROM stores_booking WHERE MONTH(on_date) = 11 GROUP BY m, y	";
$nov = $this->comman_model->get_query($query);
$query = "SELECT YEAR(on_date) AS Y, MONTH(on_date) AS m , SUM(price) AS price FROM stores_booking WHERE MONTH(on_date) = 12 GROUP BY m, y	";

$dec = $this->comman_model->get_query($query);


?>
<tr>
    <td>Room to be Sell</td>
    <td><?=($totalRoom*31);?></td>
    <td><?=($totalRoom*31)?></td>
    <td><?=($totalRoom*28)?></td>
    <td><?=($totalRoom*28)?></td>
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
</tr>
<tr> 
    <td>Room disponibili</td>
    <td><?=($totalRoom*31);?></td>
    <td><?=($totalRoom*31)?></td>
    <td><?=($totalRoom*28)?></td>
    <td><?=($totalRoom*28)?></td>
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
</tr>
<tr> 
    <td>Room Sell</td>
    <td>
<?php
if($jan[0]&&isset($jan[0]->Y)&&$jan[0]->Y=='2015'){
	echo $jan[0]->price;
}
?>
    </td>
    <td>
<?php
if($jan[1]&&isset($jan[1]->Y)&&$jan[1]->Y=='2016'){
	echo $jan[1]->price;
}
?>
    </td>
</tr>
<tr> 
    <td>Room on the Book</td>
</tr>
<tr> 
    <td>Produzione</td>
</tr>
<tr> 
    <td>RCM</td>
</tr>
<tr> 
    <td>RevPar</td>
</tr>
<tr> 
    <td>OCC</td>
</tr>

<?php
}
?>


                </tbody>
        </table>
        
    </div>
                        </div>
						<div id="step-2" class="tab-pane fade">
                        </div>
						<div id="step-3" class="tab-pane fade">
                        </div>
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
</script>
<style>
table td{
	padding:10px 3px !important;
}
</style>