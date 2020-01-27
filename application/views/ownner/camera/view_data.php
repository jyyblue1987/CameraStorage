<?php
$get_membership = $this->comman_model->get_by('memberships',array('plan_id'=>$view_data->m_id),false,false,true);
?>
<style>
.static-info {
  margin-bottom: 10px;
}
.static-info .name {
  font-size: 14px;
  font-weight: 600;
}
.static-info .value {
  font-size: 14px;
}
.black-btn {
	position:absolute;
	right:0;
	top:6px;
	z-index:1;
}

</style>

<div class="row">
	<div class="col-md-12">
        <!-- begin panel -->
        <div data-sortable-id="form-stuff-1" class="panel panel-inverse">
            <div class="panel-heading">                
                <h4 class="panel-title"><?=$name?></h4>
            </div>
            <div class="panel-body" style="position:relative">
            <div class="btn-group black-btn">
                <a href="<?=$_cancel.'/l/'.$view_data->user_id?>" class="btn btn-primary m-r-5 m-b-5">Back</a>
            </div>
<div class="portlet-body">
    <div class="row static-info">
        <div class="col-md-3 name"><b>Name Your Device</b></div>
        <div class="col-md-9 value"><?=$view_data->name;?></div>
    </div>    
  
    <div class="row static-info">
        <div class="col-md-3 name"><b>Model</b></div>
        <div class="col-md-9 value"><?=print_value('devices',array('id'=>$view_data->model),'name',$view_data->model);?></div>
    </div>
<?php
if($view_data->model=='Custom RTSP Device'){
?>
    <div class="row static-info">
        <div class="col-md-3 name"><b>Url</b></div>
        <div class="col-md-9 value"><?=$view_data->url;?></div>
    </div>

<?php
}
else{
?>
    <div class="row static-info">
        <div class="col-md-3 name"><b>IP Address or FQDN</b></div>
        <div class="col-md-9 value"><?=$view_data->ip_address;?></div>
    </div>


    <div class="row static-info">
        <div class="col-md-3 name"><b>Port</b></div>
        <div class="col-md-9 value"><?=$view_data->port;?></div>
    </div>

    <div class="row static-info">
        <div class="col-md-3 name"><b>User</b></div>
        <div class="col-md-9 value"><?=$view_data->username;?></div>
    </div>

    <div class="row static-info">
        <div class="col-md-3 name"><b>Password</b></div>
        <div class="col-md-9 value"><?=$view_data->password;?></div>
    </div>

    <div class="row static-info">
        <div class="col-md-3 name"><b>Camera Number</b></div>
        <div class="col-md-9 value"><?=$view_data->camera_num;?></div>
    </div>


    <div class="row static-info">
        <div class="col-md-3 name"><b>Stream</b></div>
        <div class="col-md-9 value"><?=$view_data->stream;?></div>
    </div>

<?php
}
?>
    <div class="row static-info">
        <div class="col-md-3 name"><b>Motion</b></div>
        <div class="col-md-9 value"><?=$view_data->motion;?></div>
    </div>

    <div class="row static-info">
        <div class="col-md-3 name"><b>Resolution</b></div>
        <div class="col-md-9 value"><?=$view_data->resolution;?></div>
    </div>

    <div class="row static-info">
        <div class="col-md-3 name"><b>Plan</b></div>
        <div class="col-md-9 value"><?=$get_membership?$get_membership->name:''?> / $<?=$view_data->price.' months ('.$view_data->m_day.' days)'?></div>
    </div>


    <div class="row static-info">
        <div class="col-md-3 name"><b>Date Created</b></div>
        <div class="col-md-9 value"><?=date('m/d/Y',$view_data->created);?></div>
    </div>
    <div class="row static-info">
        <div class="col-md-3 name"><b>Timezone</b></div>
        <div class="col-md-9 value"><?=array_key_exists($view_data->timeszone,$timeszone_list)?$timeszone_list[$view_data->timeszone]:$view_data->timeszone?></div>
    </div>
    

    <div class="row static-info">
        <div class="col-md-9 value">
			<?=$view_data->is_mail==1?'<i class="fa fa-check"></i>':'';?>
			<span style="font-size:15px;">Do you want a notification email if the connection is lost and restored for this device?</span>
		</div>
    </div>	

</div>
            </div>
        </div>
        <!-- end panel -->
    </div>   
</div>

