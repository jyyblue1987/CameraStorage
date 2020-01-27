<link href="assets/global/css/star.css" rel="stylesheet" />

<style>
.dl-horizontal dt, .dl-horizontal dd {
  margin-bottom:5px;
}
.dl-horizontal dt {
  width: 80px;
}
.dl-horizontal dd {
  margin-left: 112px;
}
@media (max-width: 979px) {
	.dl-horizontal dd {
	  margin-left: 0px;
	}
}

.view-data .control-label {
  text-align: left;
  margin-left:10px;
}
/*label.radio-inline.checked, label.checkbox-inline.checked, label.radio.checked, label.checkbox.checked {
  background-color: #266c8e;
  color: #fff !important;
}*/
</style>
<div class="row">
    <div class="col-md-12">
        <!-- begin panel -->
        <div data-sortable-id="form-stuff-1" class="panel panel-inverse">
            <div class="panel-heading">                
                <h4 class="panel-title"><?=$name?></h4>
            </div>
            <div class="panel-body">
<dl class="dl-horizontal">
    <dt><?=show_static_text($adminLangSession['lang_id'],167);?></dt>
    <dd><?=isset($course_cat)?$course_cat->title:'-'?></dd>
<?php
if(!empty($trainer)){
?>
    <dt>Trainer</dt>
    <dd class="show-status"><?=$trainer->first_name.' '.$trainer->last_name?></dd>
<?php
}
?>

<?php
if(!empty($user_data)){
?>
    <dt>UserNnme</dt>
    <dd class="show-status"><?=$user_data->first_name.' '.$user_data->last_name?></dd>
<?php
}
?>

    <dt>Type</dt>
    <dd class="show-status"><?=$view_data->type?></dd>

    <dt>Price</dt>
    <dd class="show-status"><?=$view_data->price?></dd>

    <dt>Date</dt>
    <dd class="show-status"><?=$view_data->{'date'}.' '.$view_data->{'time'};?></dd>
<?php
if($view_data->type=='Hourly'){
?>
    <dt>Hour</dt>
    <dd class="show-status"><?=$view_data->hour_time?></dd>
<?php
}
?>
    <dt>Name</dt>
    <dd class="show-status"><?=$view_data->name?></dd>

    <dt>Description</dt>
    <dd class="show-status"><?=$course->desc?></dd>

<?php
if(!empty($rating_data)){
?>
    <dt>Rating</dt>
    <dd class="show-status">
<div class="item-rating store" >
    <div class="star_content clearfix">
        <div class="star <?=$rating_data->rate>=1?'star_on':''?>"></div>
        <div class="star <?=$rating_data->rate>=2?'star_on':''?>"></div>
        <div class="star <?=$rating_data->rate>=3?'star_on':''?>"></div>
        <div class="star <?=$rating_data->rate>=4?'star_on':''?>"></div>
        <div class="star <?=$rating_data->rate>=5?'star_on':''?>" style="margin-right:5px;"></div>
    </div> 
</div>	
	</dd>
    <dt>Comment</dt>
    <dd class="show-status"><?=$rating_data->comment;?>	</dd>
<?php
}
?>
</dl>

            </div>
        </div>
        <!-- end panel -->
    </div>

	<!--col-md-12-->
    <!--end col-md-12-->
</div>

