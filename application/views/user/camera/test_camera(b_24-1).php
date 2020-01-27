<style>
.edit-data,.upgrade-data{
	display:none;
}
.progress-bar-striped{
	background-image: -webkit-linear-gradient(45deg,rgba(255,255,255,.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,.15) 50%,rgba(255,255,255,.15) 75%,transparent 75%,transparent);
    background-image: -o-linear-gradient(45deg,rgba(255,255,255,.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,.15) 50%,rgba(255,255,255,.15) 75%,transparent 75%,transparent);
    background-image: linear-gradient(45deg,rgba(255,255,255,.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,.15) 50%,rgba(255,255,255,.15) 75%,transparent 75%,transparent);
    -webkit-background-size: 40px 40px;
    background-size: 40px 40px;
}
</style>
<script>/*<![CDATA[*/
get_start_v();

function check_file_generate(){
	$.ajax({
		type:"GET",
		url:"<?=$_user_link.'/ajax_camera/check_file'?>",
		data:{id:<?=$view_data->id?>},
		dataType: 'json',
		success: function(response){
			if(response.status=='error'){
				$('.error-messages').html(response.msge);
				$('.edit-data').show();
				$('.progress').hide();
			}
			if(response.status=='ok'){
				setTimeout(function(){
					$('.progress').hide();
					$('.upgrade-data').show();
					$('.error-messages').html('Your camera worked. Please upgrade your camera.');
				}, 1000*15);
			}
		}
	});
}
function get_start_v(){
	$.ajax({
		type:"GET",
		url:"<?=$_user_link.'/ajax_camera/get_start_camera'?>",
		data:{id:<?=$view_data->id?>},
		dataType: 'json',
		success: function(response){
			if(response.status=='error'){
				$('.error-messages').html(response.msge);
				$('.edit-data').show();
//				alert(response.msge);
			}
			if(response.status=='ok'){
				setTimeout(function(){
					check_file_generate();
				}, 1000*15);
			}
		}
	});
}
/*]]>*/
</script>

<div class="row">
	<div class="col-md-12">
        <!-- begin panel -->
        <div data-sortable-id="form-stuff-1" class="panel panel-inverse">
            <div class="panel-heading">                
                <h4 class="panel-title"><?=$name?></h4>
            </div>
            <div class="panel-body">

<div class="progress">
  <div class="progress-bar progress-bar-striped active" role="progressbar"
  aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:100%"></div>
</div>
<h5 class="error-messages">Processing... Pleaes wait, may take upto 20 seconds</h5>
<div>
<a href="<?=$_cancel.'/edit/'.$view_data->id;?>" class="btn btn-icon-only btn-info edit-data" data-toggle="tooltip" data-placement="top"  title="Edit"  target="_blank" ><i class="fa fa-edit"></i></a>

<?php
$Pbtn =false;
if($view_data->is_free_camera==1){
}
else if($view_data->payment_id!=0){
	if($view_data->is_expire==1){
		$Pbtn= true;
	}
}
else{
	$Pbtn= true;
}
if($Pbtn){
?>
		<a class="btn btn-icon-only btn-warning upgrade-data" data-toggle="tooltip" data-placement="top"  title="payment accept confirmation screen" href="<?=$_user_link.'/c_upgrade/l/'.$view_data->id;?>" >Upgrade Now</a>
<?php
}
else{
?>
<a class="btn btn-icon-only btn-warning upgrade-data" href="<?=$_user_link.'/camera/v/'.$view_data->id;?>" >View Camera</a>
<?php
}
?>            
		<a class="btn btn-icon-only btn-danger edit-data" data-toggle="tooltip" data-placement="top"  title="Delete" href="<?=$_cancel.'/delete/'.$view_data->id;?>" onclick="return confirm_box();" ><i class="fa fa-trash"></i></a>

</div>
            </div>
        </div>
        <!-- end panel -->
    </div>   
</div>

<script>
function confirm_box(){
    var answer = confirm ("All recorded video/audio will be deleted immediately with no recovery option. If the camera was added more than three days ago then no refund will be issued for this camera for the reminder of the month. Do you still want to delete this camera?");
    if (!answer)
     return false;
}
</script>