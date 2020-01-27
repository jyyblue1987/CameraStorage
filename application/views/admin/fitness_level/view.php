<!-- begin row -->
<div class="row">
<!-- begin col-8 -->
<div class="col-md-8">
    <div class="panel panel-inverse" data-sortable-id="index-1">
        <div class="panel-heading">            
            <h4 class="panel-title">Graph</h4>
        </div>
<div class="panel-body">
        <div>
<!--<div class="chart_clicks">User</div>-->
<div id="chart1" class="example-chart"  style="height:205px;width:100%;"></div>
<div style="clear:both"></div>
<!--<div style="font-size:18px;margin-left:600px">Country</div>-->
<br>
</div>
    </div>
    </div>
</div>
<!-- end col-8 -->
<!-- begin col-4 -->
<div class="col-md-4">
    <!--<div class="panel panel-inverse" data-sortable-id="index-6">
        <div class="panel-heading">
            <div class="panel-heading-btn">
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
            </div>
            <h4 class="panel-title">Analytics Details</h4>
        </div>
        <div class="panel-body p-t-0">
            <table class="table table-valign-middle m-b-0">
                <thead>
                    <tr>	
                        <th>Source</th>
                        <th>Total</th>
                        <th>Trend</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><label class="label label-danger">Unique Visitor</label></td>
                        <td>13,203 <span class="text-success"><i class="fa fa-arrow-up"></i></span></td>
                        <td><div id="sparkline-unique-visitor"></div></td>
                    </tr>
                    <tr>
                        <td><label class="label label-warning">Bounce Rate</label></td>
                        <td>28.2%</td>
                        <td><div id="sparkline-bounce-rate"></div></td>
                    </tr>
                    <tr>
                        <td><label class="label label-success">Total Page Views</label></td>
                        <td>1,230,030</td>
                        <td><div id="sparkline-total-page-views"></div></td>
                    </tr>
                    <tr>
                        <td><label class="label label-primary">Avg Time On Site</label></td>
                        <td>00:03:45</td>
                        <td><div id="sparkline-avg-time-on-site"></div></td>
                    </tr>
                    <tr>
                        <td><label class="label label-default">% New Visits</label></td>
                        <td>40.5%</td>
                        <td><div id="sparkline-new-visits"></div></td>
                    </tr>
                    <tr>
                        <td><label class="label label-inverse">Return Visitors</label></td>
                        <td>73.4%</td>
                        <td><div id="sparkline-return-visitors"></div></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>-->
    
    <div class="panel panel-inverse" data-sortable-id="index-7">
        <div class="panel-heading">            
            <h4 class="panel-title">FITNESS LEVEL</h4>
        </div>
        <div class="panel-body" style="min-height:250px;">
	        <div class="row static-info">
                <div class="col-md-12 value" style="font-size:25px;text-align:center"><?=$view_data->username;?></div>
            </div>
            <h2 style="text-align:center;font-size:50px;padding-top:30px"><?=!empty($fitness_per)?$fitness_per:0;?></h2>
        </div>
    </div>    
</div>
<!-- end col-4 -->
</div>



<div class="row">
<!-- begin col-3 -->
<div class="col-md-3 col-sm-6">
    <div class="widget widget-stats bg-green">
        <div class="stats-icon stats-icon-lg"><i class="fa fa-check fa-fw"></i></div>
        <div class="stats-title">Power Lifts</div>
        <div class="stats-number"><?=$b1?></div>
        <div class="stats-progress progress">
            <div class="progress-bar" style="width:<?=$b1?>%;"></div>
        </div>
<!--        <div class="stats-desc">Better than last week (70.1%)</div>-->
    </div>
</div>
<!-- end col-3 -->
<!-- begin col-3 -->
<div class="col-md-3 col-sm-6">
    <div class="widget widget-stats bg-blue">
        <div class="stats-icon stats-icon-lg"><i class="fa fa-check fa-fw"></i></div>
        <div class="stats-title">Olympic Lift</div>
        <div class="stats-number"><?=$b2?></div>
        <div class="stats-progress progress">
            <div class="progress-bar" style="width:<?=$b2?>%;"></div>
        </div>
    </div>
</div>
<!-- end col-3 -->
<!-- begin col-3 -->
<div class="col-md-3 col-sm-6">
    <div class="widget widget-stats bg-purple">
        <div class="stats-icon stats-icon-lg"><i class="fa fa-check fa-fw"></i></div>
        <div class="stats-title">Speed</div>
        <div class="stats-number"><?=$b3?></div>
        <div class="stats-progress progress">
            <div class="progress-bar" style="width:<?=$b3?>%;"></div>
        </div>
<!--        <div class="stats-desc">Better than last week (76.3%)</div>-->
    </div>
</div>
<!-- end col-3 -->
<!-- begin col-3 -->
<div class="col-md-3 col-sm-6">
    <div class="widget widget-stats bg-blue">
        <div class="stats-icon stats-icon-lg"><i class="fa fa-check fa-fw"></i></div>
        <div class="stats-title">Endurance</div>
        <div class="stats-number"><?=$b4?></div>
        <div class="stats-progress progress">
            <div class="progress-bar" style="width:<?=$b4?>%;"></div>
        </div>
    </div>
</div>

<div class="col-md-3 col-sm-6">
    <div class="widget widget-stats " style="background:#CC4946">
        <div class="stats-icon stats-icon-lg"><i class="fa fa-check fa-fw"></i></div>
        <div class="stats-title">Bodyweight</div>
        <div class="stats-number"><?=$b5?></div>
        <div class="stats-progress progress">
            <div class="progress-bar" style="width:<?=$b5?>%;"></div>
        </div>
    </div>
</div>
<div class="col-md-3 col-sm-6">
    <div class="widget widget-stats bg-blue">
        <div class="stats-icon stats-icon-lg"><i class="fa fa-check fa-fw"></i></div>
        <div class="stats-title">Heavy</div>
        <div class="stats-number"><?=$b6?></div>
        <div class="stats-progress progress">
            <div class="progress-bar" style="width:<?=$b6?>%;"></div>
        </div>
    </div>
</div>

<div class="col-md-3 col-sm-6">
    <div class="widget widget-stats bg-blue">
        <div class="stats-icon stats-icon-lg"><i class="fa fa-check fa-fw"></i></div>
        <div class="stats-title">Light</div>
        <div class="stats-number"><?=$b7?></div>
        <div class="stats-progress progress">
            <div class="progress-bar" style="width:<?=$b7?>%;"></div>
        </div>
    </div>
</div>


<div class="col-md-3 col-sm-6">
    <div class="widget widget-stats " style="background:#CC4946">
        <div class="stats-icon stats-icon-lg"><i class="fa fa-checkfa-fw"></i></div><!--fa-exclamation-triangle -->
        <div class="stats-title">Long</div>
        <div class="stats-number"><?=$b8?></div>
        <div class="stats-progress progress">
            <div class="progress-bar" style="width:<?=$b8?>%;"></div>
        </div>
    </div>
</div>



<!-- end col-3 -->
</div>
<style>
.widget-stats .stats-title {
  color: rgba(255, 255, 255, 1);
  font-size:18px;
}
</style>

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
	  url: "<?=$_cancel1.'/ajax_chart'?>",
	  type:'POST',
	  data:{type:'day',user_id:<?=$view_data->id?>,<?=$this->security->get_csrf_token_name();?>:'<?=$this->security->get_csrf_hash();?>'},
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
	  url: "<?=$_cancel1.'/ajax_chart'?>",
	  type:'POST',
	  data:{type:type,user_id:<?=$view_data->id?>,<?=$this->security->get_csrf_token_name();?>:'<?=$this->security->get_csrf_hash();?>'},
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



