<div class="row">
    <div class="col-md-12">
        <!-- begin panel -->
        <div data-sortable-id="form-stuff-1" class="panel panel-inverse">
            <div class="panel-heading">                
                <h4 class="panel-title"><?=$name?></h4>
            </div>
            <div class="panel-body">
    	        <?php echo validation_errors();?>
                <?=form_open(NULL, array('class' => 'form-horizontal', 'role'=>'form','enctype'=>"multipart/form-data"))?>                                                             
                        <div class="form-body">    
<div class="form-group">
  <label class="col-lg-2 control-label">Attribute</label>
  <div class="col-lg-10">

<select class="tag_field" name="type2[]" id="" multiple="multiple" style="width:100%"  required>
<?php
$temp_subC = '';
if(!empty($tags->type2)){
	$temp_subC = explode(',',$tags->type2);
}
if(isset($type_data2)&&!empty($type_data2)){
	foreach($type_data2 as $set_sub){
		if(!empty($temp_subC)&&in_array($set_sub,$temp_subC)){
?>
<option value="<?=$set_sub; ?>" selected="selected"><?=$set_sub; ?></option>
<?php
		}
		else{
?>
<option value="<?=$set_sub; ?>"><?=$set_sub; ?></option>
<?php
		}
	}
}
?>

    </select>
    <span class="error-span"><?php echo form_error('gym_id'); ?></span>
  </div>
</div>

	                        <div class="form-group">
                            <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],2070);?>Type</label>
                            <div class="col-lg-10">
                                <?php echo form_dropdown('type', $type_data, $this->input->post('type') ? $this->input->post('type') : $tags->type, 'class="form-control"'); ?>
                            </div>
                        </div>

	                        <!--<div class="form-group">
                            <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],2070);?>Attribute</label>
                            <div class="col-lg-10">
                                <?php echo form_dropdown('type2', $type_data2, $this->input->post('type2') ? $this->input->post('type2') : $tags->type2, 'class="form-control"'); ?>
                            </div>
                        </div>-->


<div class="form-group">
  <label class="col-lg-2 control-label">Body Part</label>
  <div class="col-lg-10">

<select class="tag_field" name="part_id[]" id="" multiple="multiple" style="width:100%"  required>
<?php
$temp_subC = '';
if(!empty($tags->part_id)){
	$temp_subC = explode(',',$tags->part_id);
}
if(isset($part_data)&&!empty($part_data)){
	foreach($part_data as $set_sub){
		if(!empty($temp_subC)&&in_array($set_sub->id,$temp_subC)){
?>
<option value="<?=$set_sub->id; ?>" selected="selected"><?=$set_sub->title; ?></option>
<?php
		}
		else{
?>
<option value="<?=$set_sub->id; ?>"><?=$set_sub->title; ?></option>
<?php
		}
	}
}
?>

    </select>
    <span class="error-span"><?php echo form_error('gym_id'); ?></span>
  </div>
</div>

<div class="form-group">
  <label class="col-lg-2 control-label">Machine</label>
  <div class="col-lg-10">

<select class="tag_field" name="machine_id[]" id="" multiple="multiple" style="width:100%"  required>
<?php
$temp_subC = '';
if(!empty($tags->machine_id)){
	$temp_subC = explode(',',$tags->machine_id);
}
if(isset($machine_data)&&!empty($machine_data)){
	foreach($machine_data as $set_sub){
		if(!empty($temp_subC)&&in_array($set_sub->id,$temp_subC)){
?>
<option value="<?=$set_sub->id; ?>" selected="selected"><?=$set_sub->title; ?></option>
<?php
		}
		else{
?>
<option value="<?=$set_sub->id; ?>"><?=$set_sub->title; ?></option>
<?php
		}
	}
}
?>

    </select>
    <span class="error-span"><?php echo form_error('gym_id'); ?></span>
  </div>
</div>

<div class="form-group">
  <label class="col-lg-2 control-label">Skill</label>
  <div class="col-lg-10">

<select class="tag_field" name="skill[]" id="" multiple="multiple" style="width:100%" >
<?php
$temp_subC = '';
if(!empty($tags->skill)){
	$temp_subC = explode(',',$tags->skill);
}
if(isset($workout_data)&&!empty($workout_data)){
	foreach($workout_data as $set_sub){
		if(!empty($temp_subC)&&in_array($set_sub->id,$temp_subC)){
?>
<option value="<?=$set_sub->id; ?>" selected="selected"><?=$set_sub->name; ?></option>
<?php
		}
		else{
?>
<option value="<?=$set_sub->id; ?>"><?=$set_sub->name; ?></option>
<?php
		}
	}
}
?>

    </select>
    <span class="error-span"><?php echo form_error('gym_id'); ?></span>
  </div>
</div>

<div class="form-group" >
                  <label class="col-lg-2 control-label">Difficult Score</label>
                  <div class="col-lg-10">
<select class="form-control" name="d_score" >
<?php
for($timeCount=1;$timeCount<=100;$timeCount++){
	?>
    <option value="<?=$timeCount?>" <?=$tags->d_score==$timeCount?'selected="selected"':''?> ><?=$timeCount?></option>
<?php
}
?>
	</select>
                      </div>
                </div>

<div class="form-group" >
    <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],10267);?>Link</label>
    <div class="col-lg-10">
       <?=form_input('link', set_value('link', $tags->{'link'}), 'class="form-control " id="" placeholder=""')?>
    </div>
</div>                      

<div class="form-group">
  <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],263);?></label>
  <div class="col-lg-10">
    <div class="fileinput fileinput-new" data-provides="fileinput">
        <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
            <?php echo !isset($tags->image) ? '<img src="assets/uploads/no-image.gif">' :'<img src="'.base_url('assets/uploads/excercises/thumbnails').'/'.$tags->image.'" >'; ?>
        </div>
        <div>
        <span class="btn btn-default btn-file"><span class="fileinput-new"><?=show_static_text($adminLangSession['lang_id'],159);?></span><span class="fileinput-exists"><?=show_static_text($adminLangSession['lang_id'],160);?></span>
        <input type="file" name="logo" id="logo"></span>
        <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput"><?=show_static_text($adminLangSession['lang_id'],109);?></a>
    </div>
    </div>
        <!--<input type="file" name="logo" id="logo" />-->
  </div>
</div>                


                            <h5><?=show_static_text($adminLangSession['lang_id'],268);?></h5>
                           <div style="margin-bottom: 0px;" class="tabbable">
                              <ul class="nav nav-tabs">
                                <?php $i=0;
                              //   debugger($this->page_m->languages_icon);
                              //  foreach($this->page_m->languages as $key_lang=>$val_lang):
                                foreach($this->excercise_model->languages_icon as $key_lang=>$val_lang):

                                  $i++;?>
                                <li class="<?=$i==1?'active':''?>">
                                  <a data-toggle="tab" href="#<?=$key_lang?>"><img src="<?php echo base_url('assets/uploads/language').'/'.$val_lang; ?>" height="15" width="20" ></a></li>
                                <?php endforeach;?>
                              </ul>
                              <div style="padding-top: 9px; border-bottom: 1px solid #ddd;" class="tab-content">
                                <?php $i=0;foreach($this->excercise_model->languages as $key_lang=>$val_lang):$i++;?>
                                <div id="<?=$key_lang?>" class="tab-pane <?=$i==1?'active':''?>">
                                    <div class="form-group">
                                      <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],236);?></label>
                                      <div class="col-lg-10">
                                        <?=form_input('title_'.$key_lang, set_value('title_'.$key_lang, $tags->{'title_'.$key_lang}), 'class="form-control copy_to_next" id="inputTitle'.$key_lang.'" placeholder="'.lang('Title').'"')?>
                                      </div>
                                    </div>
                                </div>
                                <?php endforeach;?>
                              </div>
                            </div>
						</div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-2 col-md-9">
                                    <?=form_submit('submit',show_static_text($adminLangSession['lang_id'],235), 'class="btn btn-primary"')?>
                                    <a href="<?=$_cancel?>" class="btn btn-default" type="button"><?=show_static_text($adminLangSession['lang_id'],22);?></a>
                                    <!--<button type="button" class="btn default">Cancl</button>-->
                                </div>
                            </div>
                        </div>
                <?=form_close()?>

            </div>
        </div>
        <!-- end panel -->
    </div>
</div>

<link href="assets/plugins/select2/select2.css" rel="stylesheet"/>
<script type="text/javascript" src="assets/plugins/select2/select2.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$('.tag_field').select2({placeholder: "Select"});
});

</script>
<link href="assets/plugins/jasny-bootstrap/css/jasny-bootstrap.min.css" rel="stylesheet" type="text/css"/>
<script src="assets/plugins/jasny-bootstrap/js/jasny-bootstrap.min.js" type="text/javascript" language="javascript"></script> 

