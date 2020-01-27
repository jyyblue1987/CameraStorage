<!-- BEGIN DASHBOARD STATS -->
<?php
$ausers = $this->comman_model->get_by('users',array('account_type'=>'A','parent_id'=>$user_details->parent_id),false,false,false);
$totalCamera = 0;
if($ausers){
	foreach($ausers as $set_c){
		$totalCamera =$totalCamera+print_count('camera',array('user_id'=>$set_c->id)); 
	}
}
?>
<div class="row admin-dashboard">

<div class="col-md-3 col-sm-6">
    <a href="<?=$_user_link.'/'?>">
        <div class="widget widget-stats bg-purple">
        <div class="stats-icon"><i class="fa fa-users"></i></div>
        <div class="stats-info">
            <h4><?=show_static_text($lang_id,1402);?>Clients</h4>
            <p><?=count($ausers)?></p>	
        </div>
        
    </div>
    </a>
</div>

<div class="col-md-3 col-sm-6">
        <a href="<?=$_user_link.'/'?>">
        <div class="widget widget-stats " style="background:#F59C1A">
            <div class="stats-icon"><i class="fa fa-video-camera"></i></div>
            <div class="stats-info">
                <h4><?=show_static_text($lang_id,1402);?>Total Cameras</h4>
                <p><?=$totalCamera?></p>	
            </div>
            
        </div>
        </a>
    </div>
				<!-- end col-3 -->
</div>

<div class="row ">
<?php
//$stores= $this->comman_model->get_by('users_support',array('user_id'=>$user_details->parent_id),false,false,true);
if(!empty($user_details->flash_notes)){
?>
<div class="alert alert-block alert-danger fade in">
	<?=$user_details->flash_notes?>
</div>
<?php
}
$flashs =  $this->comman_model->get_by('admin_flash',array('id'=>2,'enabled'=>1),false,false,true);
if($flashs){	
?>
<div class="alert alert-block alert-danger fade in">
	<?=$flashs->desc?>
</div>
<?php
}
?>

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