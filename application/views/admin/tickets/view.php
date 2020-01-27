<style>
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

<div class="form-horizontal">
	<div class="form-body">
        <div class="form-group">
            <label class="col-lg-2 col-md-2 control-label">Allot</label>
            <div class="col-lg-8 col-md-8">	        
            	<select onchange="get_resign(<?php echo $view_data->id;?>,this.value)" name="martial_id">
    <option value="">Select</option>
<?php
if(isset($employee_data)&&!empty($employee_data)){
	foreach($employee_data as $set_employee){
?>
	<option value="<?=$set_employee->id?>" <?=$view_data->admin_id==$set_employee->id?'selected="selected"':'';?>  ><?=$set_employee->username?></option>
<?php
	}
}
?>
</select>

			</div>
        </div>
        <div class="form-group">
            <label class="col-lg-2 col-md-2 control-label"><?=show_static_text($adminLangSession['lang_id'],158);?></label>
            <div class="col-lg-8 col-md-8">	        
			<select onchange="get_status(<?php echo $view_data->id;?>,this.value)" name="martial_id">
	                <option value="">Select</option>
	                <option value="open" <?=$view_data->status=='open'?'selected="selected"':''?> >Open</option>
	                <option value="work in progress" <?=$view_data->status=='work in progress'?'selected="selected"':''?> >Work in progress</option>
	                <option value="completed" <?=$view_data->status=='completed'?'selected="selected"':''?> >Completed</option>
	                <option value="on hold" <?=$view_data->status=='on hold'?'selected="selected"':''?> > On Hold</option>
            </select>            	

			</div>
        </div>
        <div class="form-group">
            <label class="col-lg-2 col-md-2 control-label"><?=show_static_text($adminLangSession['lang_id'],16);?></label>
            <div class="col-lg-8 col-md-8"><?=$view_data->name;?></div>
        </div>
<?php
if(!empty($view_data->files)){
?>        <div class="form-group">
            <label class="col-lg-2 col-md-2 control-label"><?=show_static_text($adminLangSession['lang_id'],150);?></label>
            <div class="col-lg-8 col-md-8"><a href="assets/uploads/tickets/<?=$view_data->files;?>" target="_blank"><?=show_static_text($adminLangSession['lang_id'],125);?></a></div>
        </div>
<?php
}
?>
        <div class="form-group">
            <label class="col-lg-2 col-md-2 control-label"><?=show_static_text($adminLangSession['lang_id'],38);?></label>
            <div class="col-lg-8 col-md-8"><?=$view_data->desc;?></div>
        </div>
	</div>							
<h4 class="m-t-20" style="border-bottom:solid 1px #CCC;padding-bottom:10px"><?=show_static_text($adminLangSession['lang_id'],55);?></h4>
<div class="height-sm" data-scrollbar="true">
<ul class="media-list media-list-with-divider media-messaging">
<?php
if(isset($answer_data)&&!empty($answer_data)){
	foreach($answer_data as $set_answer){
		if($set_answer->user_id!=0){
			$userName = 'No name';
			$image = 'assets/uploads/profile.jpg';
			$userAnswer = $this->comman_model->get_by('users',array('id'=>$set_answer->user_id),false,false,true);
			if($userAnswer){
				$userName = $userAnswer->first_name.' '.$userAnswer->last_name;
				if(!empty($userAnswer->image)){
					$image = 'assets/uploads/users/small/'.$userAnswer->image;
				}
				else{
					$image = 'assets/uploads/profile.jpg';
				}
			}

		}
		else{
			$userName = 'Admin';
			$image = 'assets/uploads/profile.jpg';
		}
?>
<li class="media media-sm">
    <a href="javascript:void(0);" class="pull-left">
        <img src="<?=$image?>" alt="" class="media-object rounded-corner" />
    </a>
    <div class="media-body">
        <h5 class="media-heading"><?=$userName?></h5>
        <p><?=$set_answer->desc;?></p>
    </div>
</li>
<?php		
	}
}
?>
    
</ul>
</div>
</div>
<?php
if($view_data->admin_id==$admin_details->id||$view_data->admin_id==0){
?>
<h4 class="m-t-20" style="border-bottom:solid 1px #CCC;padding-bottom:10px"><?=show_static_text($adminLangSession['lang_id'],327);?></h4>

<?=form_open(NULL, array('class' => 'form-horizontal', 'role'=>'form', 'enctype'=>"multipart/form-data",'data-parsley-validate'=>"true"))?>                              
	<input type="hidden" name="operation" value="set"  />
	<div class="form-body">
		<div class="form-group" >
			<div class="col-lg-12">
			   <?=form_textarea('desc', set_value('desc'), 'placeholder="Answer" rows="3" class="form-control textarea" required')?>
			</div>
		</div>                    
	</div>
	<div class="form-actions">
		<div class="row">
			<div class="col-md-9">
				<?=form_submit('submit',show_static_text($adminLangSession['lang_id'],230), 'class="btn btn-success"')?>
				<a href="<?=$_cancel?>" class="btn btn-default" type="button"><?=show_static_text($adminLangSession['lang_id'],22);?></a>
				<!--<button type="button" class="btn default">Cancl</button>-->
			</div>
		</div>
	</div>
<?=form_close()?>

<?php
}

?>

            </div>
        </div>
        <!-- end panel -->
    </div>
</div>




<style>
.form-horizontal .control-label{
	padding-top:0px;
	text-align:left;
	min-width:50px !important;
}
textarea.form-control {
  height:65px;
}
.media.media-sm .media-object {
  width: 64px;
  height: 64px;
}

</style>


<script>
function get_status(id,value){
	//alert(name+' '+id+' '+value);
    $.ajax({
       type: "POST",
       url: "<?=$_cancel?>/ajax_status", /* The country id will be sent to this file */
       data: {id:id,status:value,<?=$this->security->get_csrf_token_name();?>:'<?=$this->security->get_csrf_hash();?>'},
       beforeSend: function () {
	      $("#show_class").html("Loading ...");
        },
       success: function(msg){
		 //alert(msg);
		//location.reload();
    	$("#show_class").html(msg);
       }
       });
} 

function get_resign(id,value){
	//alert(name+' '+id+' '+value);
    $.ajax({
       type: "POST",
       url: "<?=$_cancel?>/ajaxResign",
       data: {id:id,admin_id:value,<?=$this->security->get_csrf_token_name();?>:'<?=$this->security->get_csrf_hash();?>'},
 		dataType: 'json',
 		success:function(data){
			if(data.status=='ok'){
				window.location = '<?=$_cancel?>';
			}			
		}
	});
} 

</script>