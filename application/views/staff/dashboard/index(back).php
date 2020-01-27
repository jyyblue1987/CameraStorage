<?php
$totalIncome =$totalExpense = 0;
$payment_p  = $payment_c = $payment_b= $sell= $salary = 0;

$query = "SELECT SUM(price) as price FROM products_sell WHERE user_id =".$user_details->id;
$result= $this->comman_model->get_query($query,true);
if($result){
	$sell = round($result->price>0?$result->price:0,2);
	$totalIncome = round($totalIncome+$sell,2);
}

$query = "SELECT SUM(price) as price FROM users_expense WHERE gym_id =".$user_details->id;
$result= $this->comman_model->get_query($query,true);
if($result){
	$salary = round($result->price>0?$result->price:0,2);
	$totalExpense = round($totalExpense+$salary,2);
}
$query = "SELECT SUM(price) as price FROM users_salary WHERE gym_id =".$user_details->id;
$result= $this->comman_model->get_query($query,true);
if($result){
	$salary = round($result->price>0?$result->price:0,2);
	$totalExpense = round($totalExpense+$salary,2);
}


$query = "SELECT SUM(amount) as price FROM user_membership_history WHERE ownner_id =".$user_details->id." and payment_type='Cash' and status ='confirm'";
$result= $this->comman_model->get_query($query,true);
if($result){
	$payment_c = round($result->price>0?$result->price:0,2);
	$totalIncome= round($totalIncome+$payment_c,2);
}

$query = "SELECT SUM(amount) as price FROM user_membership_history WHERE ownner_id =".$user_details->id." and payment_type='Paypal' and status ='confirm'";
$result= $this->comman_model->get_query($query,true);
if($result){
	$payment_p = round($result->price>0?$result->price:0,2);
	$totalIncome= round($totalIncome+$payment_p,2);
}

$query = "SELECT SUM(amount) as price FROM user_membership_history WHERE ownner_id =".$user_details->id." and payment_type='Cheque' and status ='confirm'";
$result= $this->comman_model->get_query($query,true);
if($result){
	$payment_b = round($result->price>0?$result->price:0,2);
	$totalIncome= round($totalIncome+$payment_b,2);
}

if($user_details->plan_id==0){
?>
<div class="alert alert-block alert-success fade in">
<button data-dismiss="alert" class="close" type="button"></button>
<?=show_static_text($lang_id,44);?> <a href="<?=$lang_code.'/membership'?>"><?=show_static_text($lang_id,320);?></a>
</div>
<?php
}
?>

<?php
$stores= $this->comman_model->get_by('stores',array('user_id'=>$user_details->id),false,false,false);
if(empty($stores)){
?>
<!--<div class="alert alert-block alert-warning fade in">
    <button data-dismiss="alert" class="close" type="button"></button>
Please Add your gym ! <a href="<?=$_user_link.'/gym'?>">Click Here</a>
</div>-->
<?php
}
?>

<?php
if($user_details->api_username==''||$user_details->api_signature==''||$user_details->api_password==''){
?>
<!--<div class="alert alert-block alert-danger fade in">
<button data-dismiss="alert" class="close" type="button"></button>
	Please update account Info!! <a href="<?=$_user_link.'/account/account_info'?>">Click Here</a>
</div>-->
<?php
}

?>
<!-- BEGIN DASHBOARD STATS -->
<?php
$users = $this->comman_model->get_by('users',array('account_type'=>'E','parent_id'=>$user_details->id,'status'=>0),false,false,false);
$users2 = $this->comman_model->get_by('users',array('account_type'=>'A','parent_id'=>$user_details->id,'status'=>0),false,false,false);
$users3 = $this->comman_model->get_by('users',array('account_type'=>'C','parent_id'=>$user_details->id,'status'=>0),false,false,false);

$ausers = $this->comman_model->get_by('users',array('account_type'=>'E','parent_id'=>$user_details->id),false,false,false);
$ausers2 = $this->comman_model->get_by('users',array('account_type'=>'A','parent_id'=>$user_details->id),false,false,false);
$ausers3 = $this->comman_model->get_by('users',array('account_type'=>'C','parent_id'=>$user_details->id),false,false,false);
?>
<div class="row admin-dashboard">
<div class="col-md-3 col-sm-6">
        <a href="<?=$_user_link.'/staff'?>">
            <div class="widget widget-stats bg-purple">
            <div class="stats-icon"><i class="fa fa-users"></i></div>
            <div class="stats-info">
                <h4><?=show_static_text($lang_id,142);?></h4>
                <p><?=count($ausers)?> / <?=count($users)?></p>	
            </div>
            
        </div>
        </a>
    </div>

<div class="col-md-3 col-sm-6">
    <a href="<?=$_user_link.'/coach'?>">
    <div class="widget widget-stats bg-blue">
        <div class="stats-icon"><i class="fa fa-users"></i></div>
        <div class="stats-info">
            <h4><?=show_static_text($lang_id,139);?></h4>
            <p><?=count($ausers3)?> / <?=count($users3)?></p>	
        </div>
    </div>
	</a>
</div>

<div class="col-md-3 col-sm-6">
    <a href="<?=$_user_link.'/athletes'?>">
    <div class="widget widget-stats bg-green">
        <div class="stats-icon"><i class="fa fa-users"></i></div>
        <div class="stats-info">
            <h4><?=show_static_text($lang_id,141);?></h4>
            <p><?=count($ausers2)?> / <?=count($users2)?></p>	
        </div>        
    </div>
    </a>
</div>

<div class="col-md-3 col-sm-6">
    <a href="<?=$_user_link.'/transfers/income'?>">
    <div class="widget widget-stats bg-purple">
        <div class="stats-icon"><i class="fa fa-usd"></i></div>
        <div class="stats-info">
            <h4><?=show_static_text($lang_id,107);?></h4>
            <p><?=$totalIncome?></p>	
        </div>        
    </div>
    </a>
</div>

<div class="col-md-3 col-sm-6">
    <a href="<?=$_user_link.'/transfers/expense'?>">
    <div class="widget widget-stats " style="background:#FF8C00">
        <div class="stats-icon"><i class="fa fa-usd"></i></div>
        <div class="stats-info">
            <h4><?=show_static_text($lang_id,40);?></h4>
            <p><?=$totalExpense?></p>	
        </div>        
    </div>
    </a>
</div>

<div class="col-md-3 col-sm-6">
    <a href="<?=$_user_link.'/history/cash'?>">
    <div class="widget widget-stats " style="background:#9400D3">
        <div class="stats-icon"><i class="fa fa-usd"></i></div>
        <div class="stats-info">
            <h4><?=show_static_text($lang_id,129);?></h4>
            <p><?=$payment_c?></p>	
        </div>        
    </div>
    </a>
</div>
<div class="col-md-3 col-sm-6">
    <a href="<?=$_user_link.'/history/paypal'?>">
    <div class="widget widget-stats " style="background:#FF1493">
        <div class="stats-icon"><i class="fa fa-usd"></i></div>
        <div class="stats-info">
            <h4><?=show_static_text($lang_id,1420);?>Paypal</h4>
            <p><?=$payment_p?></p>	
        </div>        
    </div>
    </a>
</div>

<div class="col-md-3 col-sm-6">
    <a href="<?=$_user_link.'/history/cheque'?>">
    <div class="widget widget-stats " style="background:#DAA520">
        <div class="stats-icon"><i class="fa fa-usd"></i></div>
        <div class="stats-info">
            <h4><?=show_static_text($lang_id,331);?></h4>
            <p><?=$payment_b?></p>	
        </div>        
    </div>
    </a>
</div>

<div class="col-md-3 col-sm-6">
    <a href="<?=$_user_link.'/sell_manage'?>">
    <div class="widget widget-stats " style="background:#4B0082">
        <div class="stats-icon"><i class="fa fa-usd"></i></div>
        <div class="stats-info">
            <h4><?=show_static_text($lang_id,318);?></h4>
            <p><?=$sell?></p>	
        </div>        
    </div>
    </a>
</div>

<div class="col-md-3 col-sm-6">
    <a href="<?=$_user_link.'/salary'?>">
    <div class="widget widget-stats bg-purple">
        <div class="stats-icon"><i class="fa fa-usd"></i></div>
        <div class="stats-info">
            <h4><?=show_static_text($lang_id,128);?></h4>
            <p><?=$salary?></p>	
        </div>        
    </div>
    </a>
</div>

				<!-- end col-3 -->
			</div>
<div class="row ">
<div class="panel panel-inverse" style="">
    <div class="panel-heading">
<!--        <h4 class="panel-title" style="float:left;margin-right:20px"><i class="fa fa-globe"></i> Chart</h4>-->
        <div class="panel-heading-btn " style="float:left">
			<div class="btn-group pull-right">
                <a href="javascript:void(0);" onclick="get_chart('day');" class="btn btn-primary m-r-5 m-b-5"><?=show_static_text($lang_id,25);?></a>
                <a href="javascript:void(0);" onclick="get_chart('month');" class="btn btn-primary m-r-5 m-b-5"><?=show_static_text($lang_id,61);?></a>
                <a href="javascript:void(0);" onclick="get_chart('year');" class="btn btn-primary m-r-5 m-b-5"><?=show_static_text($lang_id,42);?></a>
            </div>
        </div>        
        <!--<div class="row dashboard-box">    

            <button class="btn bg-purple  m-r-5 m-b-5" type="button">Company <?=count($users)?></button>
            <button class="btn bg-green  m-r-5 m-b-5" type="button">Customer <?=count($users2)?></button>
            <button class="btn m-r-5 m-b-5" style="background:#EAA228" type="button">Ticket On Time <?=count($OntimeTicket)?></button>
            <button class="btn m-r-5 m-b-5" style="background:#953579" type="button">Ticket On Delay <?=count($DelayTicket)?></button>    
	    </div>-->

        <div style="clear:both"></div>
    </div>
    <div class="panel-body">
        <div>
<!--<div class="chart_clicks">User</div>-->
<div id="chart1" class="example-chart"  style="height:300px;width:100%;float:left"></div>
<div style="clear:both"></div>
<!--<div style="font-size:18px;margin-left:600px">Country</div>-->
<br>
</div>
    </div>
</div>
</div>
 
<link class="include" rel="stylesheet" type="text/css" href="assets/plugins/charts/jquery.jqplot.min.css" />
<script class="include" type="text/javascript" src="assets/plugins/charts/jquery.jqplot.min.js"></script>
<script type="text/javascript" src="assets/plugins/charts/jqplot.pointLabels.min.js"></script>
<script language="javascript" type="text/javascript" src="assets/plugins/charts/jqplot.categoryAxisRenderer.min.js"></script>
<script language="javascript" type="text/javascript" src="assets/plugins/charts/jqplot.barRenderer.min.js"></script>

<script type="text/javascript" src="assets/plugins/charts/jqplot.logAxisRenderer.min.js"></script>
<script type="text/javascript" src="assets/plugins/charts/jqplot.canvasTextRenderer.min.js"></script>
<script type="text/javascript" src="assets/plugins/charts/jqplot.canvasAxisLabelRenderer.min.js"></script>
<script type="text/javascript" src="assets/plugins/charts/jqplot.canvasAxisTickRenderer.min.js"></script>
<script type="text/javascript" src="assets/plugins/charts/jqplot.dateAxisRenderer.min.js"></script>

<script type="text/javascript" class="code">
$(document).ready(function(){
 $(window).load(function(){ 
function view_charts(){
	user_id = 1;
	//alert(user_id);
	var ret = [];
	$.ajax({
	  async: false,
	  url: "<?=$_user_link.'/account/ajaxChart'?>",
	  type:'POST',
	  data:{type:'day',<?=$this->security->get_csrf_token_name();?>:'<?=$this->security->get_csrf_hash();?>'},
	  dataType:"json",
	  success: function(data) {
		   $.each( data, function( key, val ) {
				ret.push([key, val]);
			});
	  }
	});
	return ret;
}


	var line1 = view_charts();
	//console.log(line1);

	$.jqplot.config.enablePlugins = true;
	 
	plot1 = $.jqplot('chart1', [line1], {
		// Only animate if we're not using excanvas (not in IE 7 or IE 8)..
		animate: !$.jqplot.use_excanvas,
		seriesDefaults:{
			renderer:$.jqplot.BarRenderer,
			rendererOptions: {
			// Set the varyBarColor option to true to use different colors for each bar.
			// The default series colors are used.
			varyBarColor: true
			},
			pointLabels: { show: true }
		},
		axes: {
			xaxis: {
				renderer: $.jqplot.CategoryAxisRenderer,
				//ticks: ticks
			},
/*			yaxis: {
				min: 0,  
				//tickInterval: 1, 
				tickOptions: { 
					formatString: '%d' 
				} 
			}*/
			
		},
		highlighter: { show: false }
	});
 
	$('#chart1').bind('jqplotDataClick', 
		function (ev, seriesIndex, pointIndex, data) {
			$('#info1').html('series: '+seriesIndex+', point: '+pointIndex+', data: '+data);
		}
	);

});
});
	
function get_chart(types){
	$('#chart1').html('');
	$(document).ready(function(){
	    var line1 = view_ajax_chart(types);
        $.jqplot.config.enablePlugins = true;
         
        plot1 = $.jqplot('chart1', [line1], {
            // Only animate if we're not using excanvas (not in IE 7 or IE 8)..
            animate: !$.jqplot.use_excanvas,
            seriesDefaults:{
                renderer:$.jqplot.BarRenderer,
				rendererOptions: {
                // Set the varyBarColor option to true to use different colors for each bar.
                // The default series colors are used.
                varyBarColor: true
	            },
                pointLabels: { show: true }
            },
            axes: {
                xaxis: {
                    renderer: $.jqplot.CategoryAxisRenderer,
                    //ticks: ticks
                },
/*				yaxis: {
					min: 0,  
					tickOptions: { 
						formatString: '%d' 
					} 
				}*/
				
            },
            highlighter: { show: false }
        });
     
        $('#chart1').bind('jqplotDataClick', 
            function (ev, seriesIndex, pointIndex, data) {
                $('#info1').html('series: '+seriesIndex+', point: '+pointIndex+', data: '+data);
            }
        );
    });
}
function view_ajax_chart(type){
	user_id = 1;
	//alert(user_id);
	var ret = [];
	$.ajax({
	  async: false,
	  url: "<?=$_user_link.'/account/ajaxChart'?>",
	  type:'POST',
	  data:{type:type,<?=$this->security->get_csrf_token_name();?>:'<?=$this->security->get_csrf_hash();?>'},
	  dataType:"json",
	  success: function(data) {
		   $.each( data, function( key, val ) {
				ret.push([key, val]);
			});
	  }
	});
	return ret;
}

</script>



<style>
.admin-dashboard a:hover{
	text-decoration:none;
}
</style>