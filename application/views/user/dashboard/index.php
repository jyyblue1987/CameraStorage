<?php
//$stores= $this->comman_model->get_by('users_support',array('user_id'=>$user_details->parent_id),false,false,true);
if(!empty($user_details->flash_notes)){
?>
<div class="alert alert-block alert-danger fade in ">
	<?=$user_details->flash_notes?>
</div>
<?php
}
$flashs =  $this->comman_model->get_by('admin_flash',array('id'=>1,'enabled'=>1),false,false,true);
if($flashs){	
?>
<div class="alert alert-block alert-danger fade in">
	<?=$flashs->desc?>
</div>
<?php
}
?>

<div class="row">
	<div class="col-md-12">
        <!-- begin panel -->
        <div data-sortable-id="form-stuff-1" class="panel panel-inverse">
            <div class="panel-heading">                
                <h4 class="panel-title"><?='Live Camera View'?></h4>
            </div>
            <div class="panel-body">
<div class="portlet-body">    
<ul class="nav nav-tabs">
    <li class="active">
        <a href="<?=$_user_link.'/account'?>">All</a>
    </li>
<?php
$all_data = $this->comman_model->get_by('groups',array('user_id'=>$user_details->id),false,false,false);
if($all_data){
	foreach($all_data as $set_g){
?>
    <li class="">
        <a href="<?=$_user_link.'/group/v/'.$set_g->id?>" ><?=$set_g->name?></a>
    </li>
<?php
	}
}
?>    
</ul>

<div class="row camera-list" style="margin-top:20px">
<?php
if($user_details->play_w_pay==0){
	$this->db->order_by('order','asc');
	$all_data = $this->comman_model->get_by('camera',array('user_id'=>$user_details->id,'is_expire'=>0,'payment_id !='=>0),false,false,false);
	if($all_data){
		foreach($all_data  as $view_data){
?>
<div class="col-md-4 " style="margin-bottom:10px;">
<iframe id="video-iframe-<?=$view_data->id?>" frameborder="0" scrolling="no" src="<?=site_url($lang_code.'/member/account/iframe/'.$view_data->id)?>" style="height:340px;width:100%" ></iframe>
<?php
if ($this->agent->is_browser('Safari')) {
?>
<button onclick="makeFullScreen2('video-iframe-<?=$view_data->id?>'); return false" class="btn btn-primary btn-block">Fullscreen</button>
<?php
}
else{
?>
<button onclick="makeFullScreen('video-iframe-<?=$view_data->id?>'); return false" class="btn btn-primary btn-block">Fullscreen</button>
<?php
}
?>
</div>
<?php
		}
	}
}
else{
	$this->db->order_by('order','asc');
	$all_data = $this->comman_model->get_by('camera',array('user_id'=>$user_details->id,'payment_id !='=>0,'is_expire'=>0),false,false,false);
	if($all_data){
		foreach($all_data  as $view_data){
?>
<div class="col-md-4 " style="margin-bottom:10px;">
<iframe id="video-iframe-<?=$view_data->id?>" frameborder="0" scrolling="no" src="<?=site_url($lang_code.'/member/account/iframe/'.$view_data->id)?>" style="height:340px;width:100%" ></iframe>
<?php
if ($this->agent->is_browser('Safari')) {
?>
<button onclick="makeFullScreen2('video-iframe-<?=$view_data->id?>'); return false" class="btn btn-primary btn-block">Fullscreen</button>
<?php
}
else{
?>
<button onclick="makeFullScreen('video-iframe-<?=$view_data->id?>'); return false" class="btn btn-primary btn-block">Fullscreen</button>
<?php
}
?>
</div>
<?php
		}
	}
}
?>
 
</div>
</div>


            </div>
        </div>
        <!-- end panel -->
    </div>   
</div>


<script>
function reload_page(url) {
	window.location = url;
}
function goFullscreen(id) {
    var element = document.getElementById(id);

    if (element.mozRequestFullScreen) {
      element.mozRequestFullScreen();
    } else if (element.webkitRequestFullScreen) {
      element.webkitRequestFullScreen();
   }
}
  
  
function requestFullScreen(element) {
    // Supports most browsers and their versions.
    var requestMethod = element.requestFullScreen || element.webkitRequestFullScreen || element.mozRequestFullScreen || element.msRequestFullscreen;

    if (requestMethod) { // Native full screen.
        requestMethod.call(element);
    } else if (typeof window.ActiveXObject !== "undefined") { // Older IE.
        var wscript = new ActiveXObject("WScript.Shell");
        if (wscript !== null) {
            wscript.SendKeys("{F11}");
        }
    }
}

function makeFullScreen(id) {
//    document.getElementsByTagName("iframe")[0].className = "fullScreen";
    var elem = document.getElementById(id);
    requestFullScreen(elem);
}
</script>



<script>
function makeFullScreen2(id) {
//    document.getElementsByTagName("iframe")[0].className = "fullScreen";
    var e = document.getElementById(id);

	if (RunPrefixMethod(document, "FullScreen") || RunPrefixMethod(document, "IsFullScreen")) {
		RunPrefixMethod(document, "CancelFullScreen");
	}
	else {
		RunPrefixMethod(e, "RequestFullScreen");
	}

}

var pfx = ["webkit", "moz", "ms", "o", ""];
function RunPrefixMethod(obj, method) {
	
	var p = 0, m, t;
	while (p < pfx.length && !obj[m]) {
		m = method;
		if (pfx[p] == "") {
			m = m.substr(0,1).toLowerCase() + m.substr(1);
		}
		m = pfx[p] + m;
		t = typeof obj[m];
		if (t != "undefined") {
			pfx = [pfx[p]];
			return (t == "function" ? obj[m]() : obj[m]);
		}
		p++;
	}

}

</script>


<script>
function openWizardModal(){
 $('#firstModal').modal({
            show: true,
            keyboard: false,
            backdrop: 'static'
        });
}
function set_accept()	{
	$.ajax({
		type: 'GET',
		url : "<?php echo $_user_link.'/ajax_condition/ajaxSetCookie'?>",
		data:{id:<?=time()?>},
		dataType:'json',
		success: function(response){
			if(response.status=='ok')
				$('#firstModal').modal('hide');
		}
	});	
}

</script>
<?php
$condition = $this->comman_model->get_by('users_support',array('user_id'=>$user_details->parent_id),false,false,true);
if($user_details->accept_condition==0&&$condition){
?>
<script>
$(function () {
   openWizardModal();
});
</script>
<style>
#firstModal p{
	margin-bottom:0px;
	
}
</style>
<div class="modal" id="firstModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <!-- Modal body -->
      <div class="modal-body " style="position:relative" >

<div class="row">
<div class="col-md-12">
<?php echo $condition->term_desc;?>        
</div>
<div class="col-md-12 " style="margin-top:20px">
<button class="btn btn-sm btn-primary u-btn-primary " onClick="set_accept()">Accept</button>
<button class="btn btn-sm btn-warning" onClick="window.location= '<?=site_url($_user_link.'/account/logout')?>'">Decline</button>
</div>
<div >
</div>
</div>
</div>

</div>

      </div>
</div>
<?php
}
?>


