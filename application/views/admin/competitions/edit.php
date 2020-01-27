<link href="assets/global/css/bootstrap-nav-wizard.css" rel="stylesheet" />
<style>
.nav-wizard > li > a {
  padding: 11.2px 10px 14px 31px !important;
}
.nav-wizard > li:first-child > a{
  padding-left: 10px !important;
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
<ul class="nav nav-wizard">
    <li class="active"><a href="javascript:void(0)">Competition Details</a></li>
    <li><a href="javascript:void(0)">Category</a></li>
    <li><a href="javascript:void(0)">Events</a></li>
  </ul>
  <br>
                <?php echo validation_errors();?>
                 <?=form_open(NULL, array('class' => 'form-horizontal', 'role'=>'form','enctype'=>"multipart/form-data"))?>
	                <input type="hidden" value="<?=set_value('gps', $products->gps)?>" id="inputGps" name="gps">
                     <div class="form-body">                    
                      <div id="more_pic" style="display:none"></div>
                    <div class="col-md-8">						                                                

<div class="form-group" >
	<label class="col-lg-2 control-label">Name</label>
	<div class="col-lg-10">
		<?=form_input('name', set_value('name', $products->{'name'}), 'class="form-control " id="" placeholder=""')?>
    	<span class="error-span"><?php echo form_error('name'); ?></span>
	</div>
</div>

<div class="form-group" >
	<label class="col-lg-2 control-label">Date Range</label>

	<div class="col-lg-5">
    <input class="form-control input-date" type="text" id="" name="s_date" value="<?=h_dateFormat(set_value('s_date', $products->{'s_date'}),'d-m-Y')?>" data-date-format="dd-mm-yyyy" data-date-start-date="+0d"  required   />
    <span class="error-span"><?php echo form_error('s_date'); ?></span>
	</div>

    <div class="col-lg-5">
    <input class="form-control input-date" type="text" id="" name="e_date" value="<?=h_dateFormat(set_value('e_date', $products->{'e_date'}),'d-m-Y')?>" data-date-format="dd-mm-yyyy" data-date-start-date="+0d"  required   />
    <span class="error-span"><?php echo form_error('e_date'); ?></span>
	</div>
</div>

<div class="form-group">
  <label class="col-lg-2 control-label">Category</label>
  <div class="col-lg-10">

    <select class="form-control" name="category" id="select_category" required>
        <option value="" >Select</option>
<?php
if(isset($categories_data)&&!empty($categories_data)){
foreach($categories_data as $setCategory){
?>
<option value="<?=$setCategory->id;?>"  <?=($setCategory->id==$products->category)?'selected="selected"':'';?> ><?=$setCategory->title;?></option>
<?php
}
}
?>

    </select>
  </div>
</div>

<div class="form-group" >
	<label class="col-lg-2 control-label">Price</label>
	<div class="col-lg-10">
		<?=form_input('price', set_value('price', $products->{'price'}), 'class="form-control " id="" placeholder=""')?>
    	<span class="error-span"><?php echo form_error('price'); ?></span>
	</div>
</div>

<div class="form-group" >
	<label class="col-lg-2 control-label">Place</label>
	<div class="col-lg-10">
		<?=form_input('place', set_value('place', $products->{'place'}), 'class="form-control " id="" placeholder=""')?>
    	<span class="error-span"><?php echo form_error('place'); ?></span>
	</div>
</div>

<div class="form-group" >
	<label class="col-lg-2 control-label">Street</label>
	<div class="col-lg-10">
		<?=form_input('street', set_value('street', $products->{'street'}), 'class="form-control " id="" placeholder=""')?>
    	<span class="error-span"><?php echo form_error('street'); ?></span>
	</div>
</div>

<div class="form-group" >
	<label class="col-lg-2 control-label">City</label>
	<div class="col-lg-10">
		<?=form_input('city', set_value('city', $products->{'city'}), 'class="form-control " id="" placeholder=""')?>
    	<span class="error-span"><?php echo form_error('city'); ?></span>
	</div>
</div>

<div class="form-group" >
	<label class="col-lg-2 control-label">Country</label>
	<div class="col-lg-10">
		<?=form_input('country', set_value('country', $products->{'country'}), 'class="form-control " id="" placeholder=""')?>
    	<span class="error-span"><?php echo form_error('country'); ?></span>
	</div>
</div>



<div class="form-group" >
	<label class="col-lg-2 control-label">On line Regisstration</label>

	<div class="col-lg-5">
    <input class="form-control input-date" type="text" id="" name="s_r_date" value="<?=h_dateFormat(set_value('s_r_date', $products->{'s_r_date'}),'d-m-Y')?>" data-date-format="dd-mm-yyyy" data-date-start-date="+0d"  required   />
    <span class="error-span"><?php echo form_error('s_r_date'); ?></span>
	</div>

    <div class="col-lg-5">
    <input class="form-control input-date" type="text" id="" name="e_r_date" value="<?=h_dateFormat(set_value('e_r_date', $products->{'e_r_date'}),'d-m-Y')?>" data-date-format="dd-mm-yyyy" data-date-start-date="+0d"  required   />
    <span class="error-span"><?php echo form_error('e_r_date'); ?></span>
	</div>
</div>

<!--<div class="form-group">
  <label class="col-lg-2 control-label">Workout</label>
  <div class="col-lg-10">

<select class="form-control" name="workout" id="" required>
<option value="">Select</option>
<?php
if(isset($workout_data)&&!empty($workout_data)){
	foreach($workout_data as $set_sub){
?>
<option value="<?=$set_sub->id; ?>" <?=$products->workout==$set_sub->id?'selected="selected"':''?> ><?=$set_sub->name; ?></option>
<?php
	}
}
?>

    </select>
    <span class="error-span"><?php echo form_error('workout'); ?></span>
  </div>
</div>-->


    
			<div class="form-group">
              <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],27006);?>Restriction</label>
              <div class="col-lg-10">
                <?=form_textarea('description', html_entity_decode(set_value('description', $products->{'description'})), 'placeholder="" rows="3" class="cleditor2 form-control"')?>
              </div>
            </div>
			</div>
            		<div class="col-md-4">
                      <div class="gmap" id="mapsAddress" style="width:100%;height:300px"></div>
                    </div>
            
               <div style="clear:both"></div>

						</div>
	                 <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-2 col-md-9">
                                    <?=form_submit('submit', 'Next', 'class="btn btn-primary"')?>
                                    <a href="<?=$_cancel;?>" class="btn btn-default" type="button"><?=show_static_text($adminLangSession['lang_id'],22);?></a>
                                </div>
                            </div>
                        </div>
                 <?=form_close()?>
            </div>
        </div>
        <!-- end panel -->
    </div>

	<!--col-md-12-->

    <!--end col-md-12-->
</div>

<link href="assets/plugins/jasny-bootstrap/css/jasny-bootstrap.min.css" rel="stylesheet" type="text/css"/>
<script src="assets/plugins/jasny-bootstrap/js/jasny-bootstrap.min.js" type="text/javascript" language="javascript"></script> 

<script src="assets/plugins/ckeditor/ckeditor.js" type="text/javascript" language="javascript"></script> 
<script src="assets/plugins/ckeditor/adapters/jquery.js" type="text/javascript" language="javascript"></script>
<script>
/* CL Editor */
$(document).ready(function(){
    $('.cleditor2').ckeditor();
});
</script>


<link href="assets/global/plugins/bootstrap-datepicker/css/datepicker.css"  rel='stylesheet' type='text/css' >
<script type="text/javascript" src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script>
$(document).ready(function(){
	//$('&nbsp;').appendTo('div.dataTables_filter');
	//$('div.dataTables_filter').appendTo('<button id="refresh">Refresh</button>');
	$('.input-date').datepicker({ dateFormat: 'mm-dd-yy', altField: '#input-date_alt', altFormat: 'yy-mm-dd' }).on('changeDate', function(e){
    $(this).datepicker('hide');});

});
</script>

<script src="http://maps.googleapis.com/maps/api/js?sensor=false" type="text/javascript"></script>
<script src="assets/plugins/gmap/gmap3.min.js"></script>
<script type="text/javascript">
var timerMap;
var firstSet = false;
var savedGpsData;

$(function () {

$('.zoom-button').click(function()
{
	var myLinks = new Array();
	var current = $(this).attr('href');
	var curIndex = 0;
	
	$('.files-list .zoom-button').each(function (i) {
		var img_href = $(this).attr('href');
		myLinks[i] = img_href;
		if(current == img_href)
			curIndex = i;
	});

	options = {index: curIndex}

	blueimp.Gallery(myLinks, options);
	
	return false;
});

// If alredy selected
if($('#inputGps').length && $('#inputGps').val() != '')
{
	savedGpsData = $('#inputGps').val().split(", ");
	
	$("#mapsAddress").gmap3({
		map:{
		  options:{
			center: [parseFloat(savedGpsData[0]), parseFloat(savedGpsData[1])],
			zoom: 14
		  }
		},
		marker:{
		values:[
		  {latLng:[parseFloat(savedGpsData[0]), parseFloat(savedGpsData[1])]},
		],
		options:{
		  draggable: true
		},
		events:{
			dragend: function(marker){
			  $('#inputGps').val(marker.getPosition().lat()+', '+marker.getPosition().lng());
			}
	  }}});
	
	firstSet = true;
}
else
{
	$("#mapsAddress").gmap3({
		map:{
		  options:{
			center: [<?php echo isset($products->gps)?$products->gps:'45.81, 15.98'?>],
			zoom: 12
		  },
		}
	  });
}

$('#autocomplete').keyup(function (e) {
	clearTimeout(timerMap);
	timerMap = setTimeout(function () {		
		$("#mapsAddress").gmap3({
		  getlatlng:{
			address:  $('#autocomplete').val(),
			callback: function(results){
			  if ( !results ){
				alert('Bad address!');
				return;
			  } 
			  
				if(firstSet){
					$(this).gmap3({
						clear: {
						  name:["marker"],
						  last: true
						}
					});
				}
			  
			  // Add marker
			  $(this).gmap3({
				marker:{
				  latLng:results[0].geometry.location,
				   options: {
					  id:'searchMarker',
					  draggable: true
				  },
				  events: {
					dragend: function(marker){
						  $('#inputGps').val(marker.getPosition().lat()+', '+marker.getPosition().lng());
					}
				  }
				}
			  });
			  
			  // Center map
			  $(this).gmap3('get').setCenter( results[0].geometry.location );
			  
			  $('#inputGps').val(results[0].geometry.location.lat()+', '+results[0].geometry.location.lng());
			  
			  firstSet = true;

			}
		  }
		});
	}, 2000);
	
});

});
</script>
