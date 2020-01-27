<link href="assets/plugins/jqvmap/jqvmap.css" media="screen" rel="stylesheet" type="text/css" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
<script src="assets/plugins/jqvmap/jquery.vmap.js" type="text/javascript"></script>
<script src="assets/plugins/jqvmap/maps/jquery.vmap.world.js" type="text/javascript"></script>
<script src="assets/plugins/jqvmap/data/jquery.vmap.sampledata.js" type="text/javascript"></script>
<script type="text/javascript">
jQuery(document).ready(function() {
  	function view_charts(){
		user_id = 1;
		//alert(user_id);
	    var ret = new Array();
		$.ajax({
		  async: false,
		  url: "ajax/ajax_map",
		  type:'POST',
		  data:{id:user_id},
	      dataType:"json",
		  success: function(data) {
			   $.each( data, function( key, val ) {
					ret.push(key);
				});
		  }
		});
		return ret;
	}

	var sample_data = view_charts();
	jQuery('#vmap').vectorMap({
		map: 'world_en',
		backgroundColor: null,
		color: '#52B6EC',
		hoverOpacity: 0.7,
		selectedColor: '#7EB441',
		scaleColors: ['#7BB441'],
		enableZoom: false,
	    showTooltip: true,
		//selectedRegions:['au'],
		selectedRegions:sample_data,
		normalizeFunction: 'polynomial',
		onRegionClick: function(element, code, region){
			var str = 'country='+region;
			window.location.href = "admin/users/map?"+str;
		},
		onRegionOver: function (event, code, region){
			//alert(code);
		}
				
	});
});
</script>

<?php $this->load->view('admin/includes/address'); ?>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <div class="box-name">
                    <i class="fa fa-usd"></i>
                    <span><?php echo $name;?></span>
                </div>
				<!--<div class="box-icons">
                	<a style="background:none" href="admin/add_user"><button class="btn btn-default" style="float:right">Add</button></a>
                </div>-->
                <div class="no-move"></div>
            </div>
            <div class="box-content no-padding">
	            <div id="vmap" style="width: 100%; height: 300px;"></div>
                <table class="table table-bordered table-striped table-hover table-heading table-datatable" id="datatable-1">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Country</th>
                            <th>Date</th>
                            <th>Status</th>
                                                        
                        </tr>
                    </thead>
                    <tbody>
                    <!-- Start: list_row -->
<?php
if(count($all_data)){
   foreach($all_data as $set_data){
?>
                        <tr>
                            <td><?php echo $set_data->id;?></td>
                            <td><?php echo $set_data->username;?></td>
                            <td><?php echo $set_data->email;?></td>
                            <td><?php echo $set_data->country;?></td>
                            <td><?php echo date('d-m-Y',$set_data->create_date);?></td>
							<td>
<?php
if($set_data->confirm=='confirm'){
	echo 'Confirm';
}
else{
	echo 'Not Confirm';
}
?>                            
                            <?php /*?><select onchange="get_status('user',<?php echo $set_data->id;?>,this.value)" name="martial_id">
<?php 
if($set_data->status==1){
	echo '<option selected="selected" value="1">'.$this->lang->line('active').'</option>';
	echo '<option value="0">'.$this->lang->line('inactive').'</option>';
}
else{
	echo '<option value="1">'.$this->lang->line('active').'</option>';
	echo '<option selected="selected" value="0">'.$this->lang->line('inactive').'</option>';
}
?>
								</select><?php */?>
							</td>
							<?php /*?><td>
                            <select onchange="get_verified('user',<?php echo $set_data['id'];?>,this.value)" name="martial_id">
<?php 
if($set_data['user_verified']==1){
	echo '<option selected="selected" value="1">Verified</option>';
	echo '<option value="0">Not Verified</option>';
}
else{
	echo '<option value="1">Verified</option>';
	echo '<option selected="selected" value="0">Not Verified</option>';
}
?>
								</select>
							</td><?php */?>
                            
                        </tr>

<?php             
   }
}
?>                        
                    <!-- End: list_row -->
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Date</th>
                            <th>Status</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>


<script>
$(document).ready(function() {
    $('#datatable-1').dataTable();
});
</script>
<script>
function confirm_box(){
    var answer = confirm ("Are you sure?");
    if (!answer)
     return false;
}

function get_verified(name,id,value){

	//alert(name+' '+id+' '+value);
    $.ajax({
       type: "POST",
       url: "admin/update_verified", /* The country id will be sent to this file */
       data: "table_name="+name+"&id="+id+"&verified="+value,
       beforeSend: function () {
      $("#show_class").html("Loading ...");
        },
       success: function(msg){
		 //alert(msg);
         $("#show_class").html(msg);
       }
       });
}

function get_status(name,id,value){
	//alert(name+' '+id+' '+value);
    $.ajax({
       type: "POST",
       url: "admin/update_status", /* The country id will be sent to this file */
       data: "table_name="+name+"&id="+id+"&status="+value,
       beforeSend: function () {
      $("#show_class").html("Loading ...");
        },
       success: function(msg){
		 //alert(msg);
         $("#show_class").html(msg);
       }
       });
} 
</script>