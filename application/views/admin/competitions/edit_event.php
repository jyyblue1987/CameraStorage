<link href="assets/global/css/bootstrap-nav-wizard.css" rel="stylesheet" />
<style>
.nav-wizard .complete{
	
}
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
        <div class="panel panel-inverse">
            <div class="panel-heading">                
                <h4 class="panel-title"><?=$name?></h4>
            </div>
            <div class="panel-body">

<ul class="nav nav-wizard">
    <li class="complete"><a href="javascript:void(0)">Competition Details</a></li>
    <li class=""><a href="javascript:void(0)">Category</a></li>
    <li class="active"><a href="javascript:void(0)">Events</a></li>
  </ul>
  <br>
<?php echo validation_errors();?>
<?=form_open(NULL, array('class' => 'form-horizontal', 'role'=>'form','enctype'=>"multipart/form-data"))?>
<input type="hidden" name="product_id" id="input-type"  value="Product" />
<input type="hidden" name="order" value="set"  />
<div class="form-body">                    
    <div class="col-md-12">        	    
        <div class="form-group">
		    <label class="col-lg-1 control-label">&nbsp;</label>
            <div class="col-lg-4 ">
	            <button class="add_field_button2 btn btn-primary" type="button" style="margin-bottom:10px" >Add Event</button>
            </div>
	    </div>
	    <div class="order-item">
<?php
$i =0;
if(isset($products->event_text)&&!empty($products->event_text)){
	$temp = unserialize($products->event_text);
/*	echo '<pre>';
	print_r($temp);*/
	$workout_data =$this->comman_model->get_by('workouts',array('user_id'=>0,'type'=>'bench mark'),false,false,false);			

	if($temp){
		foreach($temp as $setTemp){
			$i++;
			$options= '<option value="">Select</option>';
			if($workout_data){			
				$output['status'] = 'ok';
				foreach($workout_data as $set){
					if($setTemp['workout']==$set->id){
						$options .= '<option value="'.$set->id.'" selected="selected">'.$set->name.'</option>';
					}
					else{
						$options .= '<option value="'.$set->id.'" >'.$set->name.'</option>';
					}
				}
			}
//			echo $options;
?>

<div class="col-md-12 item-<?=$i?>">
    <div class="well">
	    <a href="javascript:void(0)"  onclick="delete_item(<?=$i?>);" class="remove_field btn default pull-right"><i class="fa fa-times"></i></a>
    	<label class="col-lg-11 control-label" style="text-align:left">Event</label>
    	<div class="form-group">
	        <label class="col-lg-2 control-label">Workout</label>
		    <div class="col-lg-7">
			    <select class="form-control " name="sell[<?=$i?>][workout]" id="" required> <?=$options?></select>
    		</div>
	    </div><!--//form-group/-->      
    	<div class="form-group">
    	<label class="col-lg-2 control-label">Date</label>
            <div class="col-lg-7">
                <input type="text" name="sell[<?=$i?>][dates]" class="form-control input-date" value="<?=$setTemp['dates']?>" data-date-format="dd-mm-yyyy" data-date-start-date="+0d"  required  />
            </div>
	    </div><!--//form-group/-->      
    	<div class="form-group">
            <label class="col-lg-2 control-label">Heat capacity</label>
            <div class="col-lg-7">
				<input type="text" name="sell[<?=$i?>][capacity]" class="form-control" value="<?=$setTemp['capacity']?>" required  />
		   </div>
	    </div><!--//form-group/-->      
    </div>
</div>

<?php
		}
	}
}

?>
	

	    </div>
        
        		        
    </div>

	<div style="clear:both"></div>

</div>
<div class="form-actions">
	<div class="row">
		<div class="col-md-offset-1 col-md-9">
<?=form_submit('submit', show_static_text($adminLangSession['lang_id'],235), 'class="btn btn-primary" ')?> 
		</div>
	</div>
</div>
<?=form_close()?>

            </div>
        </div>        
        <!-- end panel -->


    </div>
</div>

<script>

var x = parseInt('<?=$i;?>')+1; //initlal text box count
$(document).ready(function() {
    var max_fields      = 40; //maximum input boxes allowed
    var wrapper         = $(".order-item"); //Fields wrapper
    var add_button      = $(".add_field_button2"); //Add button ID
   
    $(add_button).click(function(e){ //on add input button click
	    e.preventDefault();
		type = $('#select_category').val();
		//alert('asd');
        if(x < max_fields){ //max input box allowed
			$.ajax({
			type: "POST",
			url: "<?=$_cancel?>/get_event_content", /* The country id will be sent to this file */
			data: {id:type,count:x,<?=$this->security->get_csrf_token_name();?>:'<?=$this->security->get_csrf_hash();?>'},
			dataType:'json',
			beforeSend: function () {
			},
			success: function(msg){
			   if(msg.status=='ok'){
					x++; //text box increment
					$(".order-item").append(msg.html);
					$('.input-date').datepicker({ dateFormat: 'mm-dd-yy', altField: '#input-date_alt', altFormat: 'yy-mm-dd' }).on('changeDate', function(e){$(this).datepicker('hide');});
			   }
			}
		   });
		//$(wrapper).append('<div style="margin-bottom:10px;"><input type="email" name="email['+j+']" class="form-control" style="width:58.6%;float:left;margin-right:10px" placeholder="Email" required/><a href="javascript:void(0)" class="remove_field btn default"><i class="fa fa-times"></i></a></div>'); 
        }
    });
   
/*    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove();
		get_total();
    })*/
});

function delete_item(id){
	$('.item-'+id).remove();
}
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
