<?php
if($user_details->account_type=='A'){
	$stores= $this->comman_model->get_by('users_review',array('sender_id'=>$user_details->id,'user_id'=>$user_details->parent_id),false,false,false);
	if(empty($stores)){
?>
	<div class="alert alert-block alert-warning fade in">
		<button data-dismiss="alert" class="close" type="button"></button>
	Please Give your review to gym ownner! <a href="<?=$_user_link.'/account/review'?>">Click Here</a>
	</div>
<?php
	}
}
?>

<style>
.widget a{
	color:inherit;
}
.widget a:hover{
	text-decoration:none;
}
</style>
<!-- begin row -->
<div class="row">
<!-- begin col-4 -->
<div class="col-md-3">
    <div class="panel panel-inverse" data-sortable-id="index-7">
        <div class="panel-heading">            
            <h4 class="panel-title"><?=$user_details->username?></h4>
        </div>
        <div class="panel-body" style="text-align:center">
        	<img src="<?=!empty($user_details->image)?'assets/uploads/users/thumbnails/'.$user_details->image:'assets/uploads/profile.jpg'?>" class="" style="height:220px;width:90%;" />
        </div>
    </div>    
</div>
<!-- end col-4 -->

<!-- begin col-8 -->
<div class="col-md-9">
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
</div>



<div class="row">
<!-- begin col-3 -->
<div class="col-md-3 col-sm-6">
    <div class="widget widget-stats bg-blue">
        <div class="stats-icon stats-icon-lg"><i class="fa fa-check fa-fw"></i></div>
        <div class="stats-title">Skill Level</div>
        <div class="stats-number skill_level"><?=0?></div>
        <div class="stats-progress progress">
            <div class="progress-bar skill_level_css" style="width:<?=0?>%;"></div>
        </div>
		<div class="stats-desc" style="color:#FFF"></div>
    </div>
</div>

<div class="col-md-3 col-sm-6">
    <div class="widget widget-stats bg-green">
    	<a href="<?=$_user_link.'/fitness_level'?>">
            <div class="stats-icon stats-icon-lg"><i class="fa fa-check fa-fw"></i></div>
            <div class="stats-title">Fitness Level</div>
            <div class="stats-number"><?=$fitness_per?></div>
            <div class="stats-progress progress">
                <div class="progress-bar" style="width:<?=$fitness_per?>%;"></div>
            </div>
        </a>
    </div>
</div>

<div class="col-md-3 col-sm-6">
    <div class="widget widget-stats bg-blue">
        <div class="stats-icon stats-icon-lg"><i class="fa fa-check fa-fw"></i></div>
        <div class="stats-title">Compromise Level</div>
        <div class="stats-number compromise_level"><?=0?></div>
        <div class="stats-progress progress">
            <div class="progress-bar compromise_level_css" style="width:<?=0?>%;"></div>
        </div>
		<div class="stats-desc" style="color:#FFF"></div>
    </div>
</div>
<!-- end col-3 -->
<!-- begin col-3 -->

<!-- end col-3 -->
<!-- begin col-3 -->
<div class="col-md-3 col-sm-6">
    <div class="widget widget-stats bg-purple">
    	<a href="<?=$_user_link.'/performance'?>">
        <div class="stats-icon stats-icon-lg"><i class="fa fa-check fa-fw"></i></div>
        <div class="stats-title">Performance</div>
        <div class="stats-number"><?=!empty($fitness_per1)?$fitness_per1:0;?></div>
        <div class="stats-progress progress">
            <div class="progress-bar" style="width:<?=!empty($fitness_per1)?$fitness_per1:0;?>%;"></div>
        </div>
		<div class="stats-desc" style="color:#FFF">
        </div>
    	</a>
    </div>
</div>
<!-- end col-3 -->

<!-- end col-3 -->
</div>


<div class="row workouts hidden" >
    <div class="col-md-12">
<div data-sortable-id="form-stuff-1" class="panel panel-inverse">
            <div class="panel-heading">                
                <h4 class="panel-title"><?=show_static_text($lang_id,118);?></h4>
            </div>

<div class="panel-body">
<div class="table-responsive">
        <table id="data-table" class="table table-striped table-bordered">
        <thead>
              <tr>
                <th><?=show_static_text($lang_id,16);?></th>
                <th><?=show_static_text($lang_id,238);?></th>
                <th><?=show_static_text($lang_id,258);?></th>
            </tr>
        </thead>
		<tbody id="workouts_entry"></tbody>							
        </table>
    </div>
    </div>
</div>
        <!-- begin panel -->
    

        <!-- end panel -->
    </div>
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
	get_workout();
	setInterval("get_workout()", 5*60000); // Get users-online every 5 min
//setInterval("get_workout()", 3000); // Get users-online every 1 min

get_data();

function view_charts(){
	user_id = 1;
	//alert(user_id);
	var ret = [];
	$.ajax({
	  async: false,
	  url: "<?=$_user_link.'/fitness_level/ajax_chart'?>",
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
	  url: "<?=$_user_link.'/fitness_level/ajax_chart'?>",
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

function get_data(){
	$.ajax({
	  url: "<?=$_user_link.'/account/get_dashboard'?>",
	  type:'POST',
	  data:{<?=$this->security->get_csrf_token_name();?>:'<?=$this->security->get_csrf_hash();?>'},
	  dataType:"json",
	  success: function(data) {
		  if(data.status=='ok'){
			  if(data.skill_level>0){
				  $('.skill_level').html(data.skill_level);
				  $('.skill_level_css').css('width',data.skill_level+'%');
			  }
			  if(data.compromise_level>0){
				  $('.compromise_level').html(data.compromise_level);
				  $('.compromise_level_css').css('width',data.compromise_level+'%');
			  }
		  }
	  }
	});
}

function get_workout(){
	$.ajax({
		url: "<?=$_user_link.'/account/get_t_workout'?>",
		type:'POST',
		data:{<?=$this->security->get_csrf_token_name();?>:'<?=$this->security->get_csrf_hash();?>'},
		dataType:"json",
		success: function(data) {
			if(data.status=='ok'){
				$('#workouts_entry').html('');
				if(data.workout){
					console.log('asda');
					$('.workouts').removeClass('hidden');
					$('#workouts_entry').html(data.workout);
				}
				else{
					if($('.workouts').hasClass('hidden')){
					}
					else{
						$('.workouts').addClass('hidden');
					}
				}				
			}
		}
	});
}
</script>



