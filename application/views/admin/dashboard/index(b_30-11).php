<?php
$query = "SELECT SUM(amt) as amt FROM `user_history` WHERE subscribe_status='confirm' AND on_date ='".date('Y-m-d')."' GROUP BY on_date";
$toDayOrder = $this->comman_model->get_query($query,true);

$paidCameras = count($this->comman_model->get_by('camera',array('payment_id !='=>0,'payment_type'=>'paid'),false,false,false));
$totalCameras = count($this->comman_model->get('camera',false));

/*$query = "SELECT SUM(amt) as amt  FROM `user_history` WHERE subscribe_status='confirm' AND WEEKOFYEAR(on_date)=WEEKOFYEAR('".date('Y-m-d')."')";
$weekProblems = $this->comman_model->get_query($query);
*/
$query = "SELECT SUM(amt) as amt  FROM `user_history` WHERE subscribe_status='confirm' AND YEAR(on_date)='".date('Y')."' and MONTH(on_date) = '".date('m')."' GROUP BY YEAR(on_date) AND MONTH(on_date)";
$monthOrder = $this->comman_model->get_query($query,true);

$query = "SELECT SUM(amt) as amt  FROM `user_history` WHERE subscribe_status='confirm' AND YEAR(on_date)='".date('Y')."' GROUP BY YEAR(on_date)";
$yearOrder = $this->comman_model->get_query($query,true);


$p_seller = count($this->comman_model->get_by('users',array('account_type'=>'D'),false,false,false));
$e_admin = count($this->comman_model->get_by('admin',array('default'=>0),false,false,false));
?>
			

<!-- begin row -->
<div class="row admin-dashboard">
    <!-- begin col-3 -->
    <div class="col-md-3 col-sm-6">
    	<a href="<?=$admin_link.'/userlist'?>">
        <div class="widget widget-stats " style="background:#17517E">
            <div class="stats-icon"><i class="fa fa-users"></i></div>
            <div class="stats-info">
                <h4>Dealer</h4>
                <p><?=$p_seller?></p>	
            </div>
        </div>
          </a>
    </div>



<div class="col-md-3 col-sm-6">
    	<a href="<?=$admin_link.'/admin_user'?>">
        <div class="widget widget-stats " style="background:#C70039">
            <div class="stats-icon"><i class="fa fa-users"></i></div>
            <div class="stats-info">
                <h4>Employee</h4>
                <p><?=$e_admin?></p>	
            </div>
        </div>
          </a>
    </div>    
    
    <div class="col-md-3 col-sm-6">
        <div class="widget widget-stats bg-blue">
            <div class="stats-icon"><i class="fa fa-video-camera"></i></div>
            <div class="stats-info">
                <h4>Paid Camera/ Total Camera</h4>
                <p><?=$paidCameras.' / '.$totalCameras?></p>	
            </div>
        </div>
    </div>
    
        <!-- begin col-3 -->                
    <div class="col-md-3 col-sm-6">
        <a href="<?=$admin_link.'/payment_history'?>">
            <div class="widget widget-stats " style="background:#005512" >
                <div class="stats-icon"><i class="fa fa-dollar"></i></div>
                <div class="stats-info">
                    <h4><?=show_static_text($adminLangSession['lang_id'],2039);?>Today Earning</h4>
                    <p><?=($toDayOrder)?$toDayOrder->amt:0;?></p>	
                </div>                    
            </div>
        </a>
    </div>
    <!-- end col-3 -->

    <div class="col-md-3 col-sm-6">
        <a href="<?=$admin_link.'/payment_history'?>">
        <div class="widget widget-stats bg-purple" >
            <div class="stats-icon"><i class="fa fa-dollar"></i></div>
            <div class="stats-info">
                <h4><?=show_static_text($adminLangSession['lang_id'],2039);?>Month Earning</h4>
                <p><?=($monthOrder)?$monthOrder->amt:0?></p>	
            </div>
        </div>
        </a>
    </div>
    <div class="col-md-3 col-sm-6">
        <a href="<?=$admin_link.'/payment_history'?>">
        <div class="widget widget-stats  bg-orange" >
            <div class="stats-icon"><i class="fa fa-dollar"></i></div>
            <div class="stats-info">
                <h4><?=show_static_text($adminLangSession['lang_id'],2039);?>Year Earning</h4>
                <p><?=($yearOrder)?$yearOrder->amt:0?></p>	
            </div>
        </div>
        </a>
    </div>



    
    <!-- begin col-3 -->                
    
    

</div>

<!--<style>
.dashboard-box{
	float:right;
	margin-right:10px;
	margin-top:-5px;
}
.dashboard-box button{
	padding:5px 12px;
	margin-bottom:0px !important;
}
.dashboard-box .col-md-3{
	padding:0 20px;
}
.dashboard-box .widget {
  border-radius: 3px;
  color: #fff;
  margin-bottom: 20px;
  overflow: hidden;
  padding: 3px 15px;
}
</style>-->

<!-- BEGIN DASHBOARD STATS -->

<div class="row ">
<div class="panel panel-inverse" style="">
    <div class="panel-heading">
<!--        <h4 class="panel-title" style="float:left;margin-right:20px"><i class="fa fa-globe"></i> Chart</h4>-->
        <div class="panel-heading-btn " style="float:left">
			<div class="btn-group pull-right">
                <a href="javascript:void(0);" onclick="get_chart('day');" class="btn btn-primary m-r-5 m-b-5">Day</a>
                <a href="javascript:void(0);" onclick="get_chart('month');" class="btn btn-primary m-r-5 m-b-5">Month</a>
                <a href="javascript:void(0);" onclick="get_chart('year');" class="btn btn-primary m-r-5 m-b-5">Year</a>
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
	  url: "<?=$admin_link?>/ajax_admin/ajax_order_chart",
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
	  url: "<?=$admin_link?>/ajax_admin/ajax_order_chart",
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