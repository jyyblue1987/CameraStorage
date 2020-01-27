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
                      <div id="more_pic" style="display:none"></div>
                    <div class="col-md-12">						                                                

<div class="form-group" >
	<label class="col-lg-2 control-label">Workout Name</label>
	<div class="col-lg-10">
		<?=form_input('name', set_value('name', $products->{'name'}), 'class="form-control " id="autocomplete" placeholder=""')?>
    	<span class="error-span"><?php echo form_error('name'); ?></span>
	</div>
</div>

<div class="form-group">
  <label class="col-lg-2 control-label">Workout</label>
  <div class="col-lg-10">
    <?php echo form_dropdown('workout', array('Single Movement'=>'Single Movement','Multiple Movement'=>'Multiple Movement'), $this->input->post('workout') ? $this->input->post('workout') : $products->workout, 'class="form-control" onchange="changeOption(this.value)"'); ?>
  </div>
</div>

<div class="form-group">
  <label class="col-lg-2 control-label">Type</label>
  <div class="col-lg-10">
    <?php echo form_dropdown('w_type', array('Individual'=>'Individual','Group'=>'Group'), $this->input->post('w_type') ? $this->input->post('w_type') : $products->w_type, 'class="form-control" id="input-type" onchange="changeOption2(this.value)" '); ?>
  </div>
</div>

<div class="form-group  hide-data2" style=" <?=$products->w_type=='Individual'?'display:none':''?>" >
  <label class="col-lg-2 control-label">Male</label>
  <div class="col-lg-10">
<select name="c_male"  class="form-control required-field2">
<option value="">Select</option>
<option value="all" <?=$products->c_male=='all'?'selected="selected"':''?>>All</option>
<?php
for($timeCount=1;$timeCount<=100;$timeCount++){
	?>
    <option value="<?=$timeCount?>" <?=$timeCount==$products->c_male?'selected="selected"':''?> ><?=$timeCount?></option>
<?php
}
?>

</select>
  </div>
</div>

<div class="form-group hide-data2" style=" <?=$products->w_type=='Individual'?'display:none':''?>">
  <label class="col-lg-2 control-label">Female</label>
  <div class="col-lg-10">
<select name="c_female"  class="form-control required-field2">
<option value="">Select</option>
<option value="all" <?=$products->c_female=='all'?'selected="selected"':''?>>All</option>
<?php
for($timeCount=1;$timeCount<=100;$timeCount++){
	?>
    <option value="<?=$timeCount?>" <?=$timeCount==$products->c_female?'selected="selected"':''?> ><?=$timeCount?></option>
<?php
}
?>

</select>
  </div>
</div>


<div class="form-group">
  <label class="col-lg-2 control-label">Scoring</label>
  <div class="col-lg-10">
    <?php echo form_dropdown('d_score',$scoring_data, $this->input->post('d_score') ? $this->input->post('d_score') : $products->d_score, 'class="form-control" '); ?>
  </div>
</div>


<div class="form-group ">
      <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],263);?></label>
      <div class="col-lg-5">
        <div class="fileinput fileinput-new" data-provides="fileinput">
            <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
                <?php echo !isset($products->image) ? '<img src="assets/uploads/no-image.gif">' :'<img src="'.base_url('assets/uploads/workouts/thumbnails').'/'.$products->image.'" >'; ?>
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

				<!--<div class="form-group" >
                  <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],2710);?>Difficult Score</label>
                  <div class="col-lg-10">
<select class="form-control" name="d_score" >
<?php
for($timeCount=0;$timeCount<=100;$timeCount++){
	?>
    <option value="<?=$timeCount?>" <?=$products->d_score==$timeCount?'selected="selected"':''?> ><?=$timeCount?></option>
<?php
}
?>
	</select>
                      </div>
                </div>-->
                                                                                    

<div class="form-group">
  <label class="col-lg-2 control-label">&nbsp;</label>
  <div class="col-lg-3">
<select class="form-control" name="style_type" id="input-style" onchange="add_style(this.value);">	
	<option value="" >Add Styles</option>
<?php
if(isset($styles_data)&&!empty($styles_data)){
	foreach($styles_data as $set_sub){
?>
<option value="<?=$set_sub->id; ?>"><?=$set_sub->title; ?></option>
<?php
	}
}
?>

    </select>
    <span class="error-span error_op error_style"><?php echo form_error('class_id'); ?></span>
  </div>
  <div class="col-lg-3">
	<select class="form-control" name="tool" id="input-tool"   onchange="add_tool(this.value);">	
		<option value="" >Add Tools</option>
<?php
if(isset($tools_data)&&!empty($tools_data)){
	foreach($tools_data as $set_colr){
?>
    	<option value="<?=$set_colr->id?>" ><?=$set_colr->title?></option>
<?php		
	}
}
?>
    </select>
    <span class="error-span error_op error_tool"><?php echo form_error('class_id'); ?></span>

  </div>
  <div class="col-lg-3">
	<select class="form-control" name="excercise" id="input-excercise"  onchange="add_excercise(this.value);" >
        	<option value="" >Add Excercises</option>
<?php
if(isset($excercises_data)&&!empty($excercises_data)){
	foreach($excercises_data as $set_colr){
?>
    	<option value="<?=$set_colr->id?>" ><?=$set_colr->title?></option>
<?php		
	}
}
?>
        </select>
    <span class="error-span error_op error_exce"><?php echo form_error('class_id'); ?></span>
  </div>
</div>

<div class="form-group">
      <div class="col-lg-12" style="">
        <div id="product-options" style="background-color:#CCC;min-height:450px;padding-bottom:10px">
        <div class="input_fields_wrap" >

<?php
$j=0;
if(isset($products->workout_options)&&!empty($products->workout_options)){
	$OptionArr = unserialize($products->workout_options);
	if($OptionArr){
		$setRound =1;
		foreach($OptionArr as $set_option){
?>
<?php
if(isset($set_option['style'])&&!empty($set_option['style'])){
?>
<div class="form-group w_option_<?=$j?>" style="margin-top:10px;">
	<label class="col-lg-2 control-label" style="padding-top:10px;">Styles</label>
	<div class="col-md-3" style="padding-top:10px">
    	<input type="hidden" name="options[<?=$j?>][style]" value="<?=$set_option['style']?>" >
		<?=print_lang_value('styles',$adminLangSession['lang_id'],array('id'=>$set_option['style']),'style_id','title')?>
	</div>
	<a href="javascript:void(0)" class="btn default" onclick="delete_style('style','<?=$j?>')"><i class="fa fa-times"></i></a>
</div>
<?php
}
if(isset($set_option['tool'])&&!empty($set_option['tool'])){	
	$tool_type = $set_option['type'];
	$tool_id = $set_option['tool'];
	$sCount = isset($set_option['count'])&&!empty($set_option['count'])?$set_option['count']:'';
	$html = '';
	$html .='<div class="form-group w_option_'.$j.'" style="margin-top:10px;"><input type="hidden" name="options['.$j.'][tool]" value="'.$tool_id.'" >';
	$html .= '<label class="col-lg-2 control-label" style="">'.print_lang_value('tools',$adminLangSession['lang_id'],array('id'=>$tool_id),'tool_id','title').'</label>';
//			$html .= '<div class="col-md-3">';

	if($tool_type=='timer'){
		$html .='<div class="col-md-3"><input type="hidden" name="options['.$j.'][type]"  value="timer"/>&nbsp;</div>';
	}
	elseif($tool_type=='count down timer'){
		$toolTypeHidden = '<input type="hidden" name="options['.$j.'][type]" value="count down timer" >';
		$optionTime ='<option value="">Time</option>';
		for($timeCount=10;$timeCount<=3595;$timeCount+=5){
			$Stime = $timeCount>60?gmdate("i", $timeCount).' m '.gmdate("s", $timeCount).'sec':$timeCount.' s';
			$selected = ($sCount==$timeCount)?'selected':'';
			$optionTime .= '<option value="'.$timeCount.'" '.$selected.' >'.$Stime.'</option>';
		}
		$html .='<div class="col-md-3">'.$toolTypeHidden.'<select class="form-control" name="options['.$j.'][count]" required>'.$optionTime.'</select></div>';

	}
	elseif($tool_type=='take count'){
		$html .='<div class="col-md-3"><input type="hidden" name="options['.$j.'][type]"  value="take count"/>&nbsp;</div>';
	}
	elseif($tool_type=='round counter'){
		$html .='<div class="col-md-3"><input type="hidden" name="options['.$j.'][type]"  value="round counter"/>&nbsp;</div>';
	}
	elseif($tool_type=='rep counter'){
		$html .='<div class="col-md-3"><input type="hidden" name="options['.$j.'][type]"  value="rep counter"/>&nbsp;</div>';
	}

	elseif($tool_type=='take time'){
		$html .='<div class="col-md-3"><input type="hidden" name="options['.$j.'][type]"  value="take time"/>&nbsp;</div>';
/*		$toolTypeHidden = '<input type="hidden" name="options['.$j.'][type]" value="take time" >';
		$optionTime ='<option value="">Add Time</option>';
		for($timeCount=10;$timeCount<=300;$timeCount+=5){
			$Stime = $timeCount>60?gmdate("i", $timeCount).' m '.gmdate("s", $timeCount).'sec':$timeCount.' s';
			$selected = ($sCount==$timeCount)?'selected':'';
			$optionTime .= '<option value="'.$timeCount.'" '.$selected.'>'.$Stime.'</option>';
		}
		$html .='<div class="col-lg-3">'.$toolTypeHidden.'<select class="form-control" name="options['.$j.'][count]" required>'.$optionTime.'</select></div>';*/
		
	}
	elseif($tool_type=='remaining break'){
		$html .='<div class="col-md-3"><input type="hidden" name="options['.$j.'][type]"  value="remaining break"/>&nbsp;</div>';
	}
	elseif($tool_type=='break'){				
		$toolTypeHidden = '<input type="hidden" name="options['.$j.'][type]" value="break" >';
		//for count
		$optionTime ='<option value="">Time</option>';
		for($timeCount=10;$timeCount<=300;$timeCount+=5){
			$Stime = $timeCount>60?gmdate("i", $timeCount).' m '.gmdate("s", $timeCount).'sec':$timeCount.' s';
			$selected = ($sCount==$timeCount)?'selected':'';
			$optionTime .= '<option value="'.$timeCount.'" '.$selected.' >'.$Stime.'</option>';
		}
		$html .='<div class="col-lg-3">'.$toolTypeHidden.'<select class="form-control" name="options['.$j.'][count]" required>'.$optionTime.'</select></div>';
		
	}
	elseif($tool_type=='related break'){				
		$toolTypeHidden = '<input type="hidden" name="options['.$j.'][type]" value="related break" >';
		//for count
		$optionTime ='<option value="">Break</option>';
		for($timeCount=1;$timeCount<=3;$timeCount++){
			for($r_i=1;$r_i<=10;$r_i++){
				$selected = ($sCount==$timeCount.':'.$r_i)?'selected':'';
				$optionTime .= '<option value="'.$timeCount.':'.$r_i.'" '.$selected.' >'.$timeCount.':'.$r_i.'</option>';
			}
		}
		$html .='<div class="col-lg-3">'.$toolTypeHidden.'<select class="form-control" name="options['.$j.'][count]" required>'.$optionTime.'</select></div>';
		
	}
	elseif($tool_type=='rounds'){
		$setRound = $sCount;
		$toolTypeHidden = '<input type="hidden" name="options['.$j.'][type]" value="rounds" >';
		$optionTime ='';
		for($timeCount=1;$timeCount<=50;$timeCount++){
			$selected = ($sCount==$timeCount)?'selected':'';
			if($selected)
				$optionTime .= '<option value="'.$timeCount.'"  '.$selected.' >Round '.$timeCount.'</option>';
		}
		$html .='<div class="col-lg-3 ">'.$toolTypeHidden.'<select class="form-control round" name="options['.$j.'][count]" required>'.$optionTime.'</select></div>';

	}
	elseif($tool_type=='time extend'){				
		$toolTypeHidden = '<input type="hidden" name="options['.$j.'][type]" value="time extend" >';
		$html .= '<div class="col-lg-9"><div class="col-lg-2 height-min" style="">'.$toolTypeHidden.'<div>If reps</div>
		<input type="number" name="options['.$j.'][if_con]" value="'.$set_option['if_con'].'" min="1"  style="width:100%"/></div>';
		$html .= '<div class="col-lg-2 height-min" style=""><div>Time</div>
		<input type="number" name="options['.$j.'][done]" value="'.$set_option['done'].'" min="1"  style="width:100%"/></div>';

		$html .= '<div class="col-lg-2 height-min" style=""><div>Increase</div>
		<input type="number" name="options['.$j.'][increase]" value="'.$set_option['increase'].'" min="1"  style="width:100%"/></div>';
		//for count
		$html .='</div>';				
	}
	elseif($tool_type=='rep extend'){				
		$toolTypeHidden = '<input type="hidden" name="options['.$j.'][type]" value="rep extend" >';
		$html .= '<div class="col-lg-9"><div class="col-lg-2 height-min" style="">'.$toolTypeHidden.'<div>If time</div>
		<input type="number" name="options['.$j.'][if_con]" value="'.$set_option['if_con'].'" min="1"  style="width:100%"/></div>';
		$html .= '<div class="col-lg-2 height-min" style=""><div>reps</div>
		<input type="number" name="options['.$j.'][done]" value="'.$set_option['done'].'" min="1"  style="width:100%"/></div>';

		$html .= '<div class="col-lg-2 height-min" style=""><div>Increase</div>
		<input type="number" name="options['.$j.'][increase]" value="'.$set_option['increase'].'" min="1"  style="width:100%"/></div>';
		//for count
		$html .='</div>';				
	}
	elseif($tool_type=='weight extend'){				
		$toolTypeHidden = '<input type="hidden" name="options['.$j.'][type]" value="weight extend" >';
		$html .= '<div class="col-lg-9"><div class="col-lg-2 height-min" style="">'.$toolTypeHidden.'<div>If reps</div>
		<input type="number" name="options['.$j.'][if_con]" value="'.$set_option['if_con'].'" min="1"  style="width:100%"/></div>';
		$html .= '<div class="col-lg-2 height-min" style=""><div>time</div>
		<input type="number" name="options['.$j.'][done]" value="'.$set_option['done'].'" min="1"  style="width:100%"/></div>';

		$html .= '<div class="col-lg-2 height-min" style=""><div>Increase</div>
		<input type="number" name="options['.$j.'][increase]" value="'.$set_option['increase'].'" min="1"  style="width:100%"/></div>';
		//for count
		$html .='</div>';				
	}
	elseif($tool_type=='height extend'){	
		$toolTypeHidden = '<input type="hidden" name="options['.$j.'][type]" value="height extend" >';
		$html .= '<div class="col-lg-9"><div class="col-lg-2 height-min" style="">'.$toolTypeHidden.'<div>If reps</div>
		<input type="number" name="options['.$j.'][if_con]" value="'.$set_option['if_con'].'" min="1"  style="width:100%"/></div>';
		$html .= '<div class="col-lg-2 height-min" style=""><div>time</div>
		<input type="number" name="options['.$j.'][done]" value="'.$set_option['done'].'" min="1"  style="width:100%"/></div>';

		$html .= '<div class="col-lg-2 height-min" style=""><div>Increase</div>
		<input type="number" name="options['.$j.'][increase]" value="'.$set_option['increase'].'" min="1"  style="width:100%"/></div>';
		//for count
		$html .='</div>';				
	}
	elseif($tool_type=='distance extend'){				
		$toolTypeHidden = '<input type="hidden" name="options['.$j.'][type]" value="distance extend" >';
		$html .= '<div class="col-lg-9"><div class="col-lg-2 height-min" style="">'.$toolTypeHidden.'<div>If reps</div>
		<input type="number" name="options['.$j.'][if_con]" value="'.$set_option['if_con'].'" min="1"  style="width:100%"/></div>';
		$html .= '<div class="col-lg-2 height-min" style=""><div>time</div>
		<input type="number" name="options['.$j.'][done]" value="'.$set_option['done'].'" min="1"  style="width:100%"/></div>';

		$html .= '<div class="col-lg-2 height-min" style=""><div>Increase</div>
		<input type="number" name="options['.$j.'][increase]" value="'.$set_option['increase'].'" min="1"  style="width:100%"/></div>';
		//for count
		$html .='</div>';				
	}
	else{}

	$deleteBtn = "'tool','".$j."'";

	$html .='<a href="javascript:void(0)" class="btn default" onclick="delete_style('.$deleteBtn.')"><i class="fa fa-times"></i></a></div>';
	echo $html;
}
if(isset($set_option['exce'])&&!empty($set_option['exce'])){
	$savedtExces = $set_option['exce']['round'];
		$checkExcData = $this->comman_model->get_lang('excercises',$adminLangSession['lang_id'],NULL,array('enabled'=>1,'id'=>$set_option['exce']['id']),'excercise_id',true);
		if($checkExcData){

$html = '';
$html .='<div class="form-group w_option_'.$j.'" style="margin-top:10px;"><input type="hidden" name="options['.$j.'][exce][id]" value="'.$set_option['exce']['id'].'" >';

$r_i =0;
$html .= '<label class="col-lg-2 control-label" style="">'.print_lang_value('excercises',$adminLangSession['lang_id'],array('id'=>$set_option['exce']['id']),'excercise_id','title').'</label>';
		$html .= '<div class="col-lg-9">';
		foreach($savedtExces as $setExc){
/*			echo '<pre>';
			print_r($setExc);
			echo '</pre>';*/
			$r_i++;
			if($setRound>0){
				$msge['status']= 'ok';
				//echo 'ko'.$setRound;
				if($checkExcData->type2){
					$excAttr  = explode(',',$checkExcData->type2);
					$html .= '<div class="col-md-12" style="margin-bottom:10px" ><div>Round '.$r_i.'</div>';
					if($products->w_type=='Group'){
						if(in_array('Repeats',$excAttr)){
							$getResp = isset($setExc['Repeats']['count'])?$setExc['Repeats']['count']:'';
							$selectOP ='<option value="0" >ME</option>';
							for($I=1;$I<=100;$I++){
								if($getResp==$I){
									$selectOP .='<option value="'.$I.'" selected="selected">'.$I.'</option>';
								}
								else{
									$selectOP .='<option value="'.$I.'" >'.$I.'</option>';
								}
							}
							$html .= '<div class="col-lg-2 height-min" style=""><div>Repeats</div>
							<select name="options['.$j.'][exce][round]['.$r_i.'][Repeats][count]" style="width:100%">'.$selectOP.'</select>
							</div>';
						}								
						if(in_array('Weight',$excAttr)){						
							$getWC = isset($setExc['Weight']['count'])?$setExc['Weight']['count']:'';
							$getWU = isset($setExc['Weight']['unit'])?$setExc['Weight']['unit']:'';
							$selectOP ='<option value="0" >ME</option>';
							for($I=1;$I<=1000;$I++){
								if($getWC==$I){
									$selectOP .='<option value="'.$I.'" selected="selected">'.$I.'</option>';
								}
								else{
									$selectOP .='<option value="'.$I.'" >'.$I.'</option>';
								}
							}
							$html .= '<div class="col-lg-2 height-min " style=""><div>Weight</div>
							<select name="options['.$j.'][exce][round]['.$r_i.'][Weight][count]" style="width:100%">'.$selectOP.'</select>
							</div>';
							
	
							$html .= '<div class="col-lg-2 height-min" style=""><div>Unit</div>';
							$optionTime ='<option value="">Select</option>';
							if($weight_unit){
								foreach($weight_unit as $set_unit){
									$selected = ($getWU==$set_unit)?'selected':'';
									$optionTime .= '<option value="'.$set_unit.'" '.$selected.' >'.$set_unit.'</option>';
								}
							}
	
							$html .='<select class="" name="options['.$j.'][exce][round]['.$r_i.'][Weight][unit]"  style="width:100%">'.$optionTime.'</select></div>';
							
						}								
						if(in_array('Height',$excAttr)){
							$getHC = isset($setExc['Height']['count'])?$setExc['Height']['count']:'';
							$getHU = isset($setExc['Height']['unit'])?$setExc['Height']['unit']:'';

							$selectOP ='<option value="0" >ME</option>';
							for($I=1;$I<=1000;$I++){
								if($getHC==$I){
									$selectOP .='<option value="'.$I.'" selected="selected">'.$I.'</option>';
								}
								else{
									$selectOP .='<option value="'.$I.'" >'.$I.'</option>';
								}
							}
							$html .= '<div class="col-lg-2 height-min " style=""><div>Height</div>
							<select name="options['.$j.'][exce][round]['.$r_i.'][Height][count]" style="width:100%">'.$selectOP.'</select>
							</div>';

//							$html .= '<div class="col-lg-2 height-min" style=""><div>Height</div><input type="number" name="options['.$j.'][exce][round]['.$r_i.'][Height][count]" value="'.$setExc['Height']['count'].'" min="1"  style="width:100%"/></div>';
	
							$html .= '<div class="col-lg-2 height-min" style=""><div>Unit</div>';
							$optionTime ='<option value="">Select</option>';
							if($height_unit){
								foreach($height_unit as $set_unit){
									$selected = ($getHU==$set_unit)?'selected':'';
									$optionTime .= '<option value="'.$set_unit.'" '.$selected.' >'.$set_unit.'</option>';
								}
							}
	
							$html .='<select class="" name="options['.$j.'][exce][round]['.$r_i.'][Height][unit]"  style="width:100%">'.$optionTime.'</select></div>';
							
						}								
						if(in_array('Distance',$excAttr)){
							$getDC = isset($setExc['Distance']['count'])?$setExc['Distance']['count']:1;
							$getDU = isset($setExc['Distance']['unit'])?$setExc['Distance']['unit']:'';

							$html .= '<div class="col-lg-2 height-min" style=""><div>Distance</div>
							<input type="number" name="options['.$j.'][exce][round]['.$r_i.'][Distance][count]" value="'.$getDC.'" min="1" style="width:100%" /></div>';
	
							$html .= '<div class="col-lg-2 height-min" style=""><div>Unit</div>';
							$optionTime ='<option value="">Select</option>';
							if($distance_unit){
								foreach($distance_unit as $set_unit){
									$selected = ($getDU==$set_unit)?'selected':'';
									$optionTime .= '<option value="'.$set_unit.'" '.$selected.' >'.$set_unit.'</option>';
								}
							}
	
							$html .='<select class="" name="options['.$j.'][exce][round]['.$r_i.'][Distance][unit]" style="width:100%">'.$optionTime.'</select></div>';
							
						}								
						if(in_array('Time',$excAttr)){
							$getTC = isset($setExc['Time']['count'])?$setExc['Time']['count']:1;
							$getTU = isset($setExc['Time']['unit'])?$setExc['Time']['unit']:'';

							$html .= '<div class="col-lg-2 height-min" style=""><div>Time</div>
							<input type="number" name="options['.$j.'][exce][round]['.$r_i.'][Time][count]" value="'.$getTC.'" min="1" style="width:100%" /></div>';
	
							$html .= '<div class="col-lg-2 height-min " style=""><div>Unit</div>';
							$optionTime ='<option value="">Select</option>';
							if($time_unit){
								foreach($time_unit as $set_unit){
									$selected = ($getTU==$set_unit)?'selected':'';
									$optionTime .= '<option value="'.$set_unit.'" '.$selected.' >'.$set_unit.'</option>';
								}
							}
							$html .='<select class="" name="options['.$j.'][exce][round]['.$r_i.'][Time][unit]" style="width:100%">'.$optionTime.'</select></div>';							
						}								
						if(in_array('Cal',$excAttr)){						
							$getCC = isset($setExc['Cal']['count'])?$setExc['Cal']['count']:1;

							$selectOP ='<option value="0" >ME</option>';
							for($I=1;$I<=1000;$I++){
								if($getCC==$I){
									$selectOP .='<option value="'.$I.'" selected="selected">'.$I.'</option>';
								}
								else{
									$selectOP .='<option value="'.$I.'" >'.$I.'</option>';
								}
							}
							$html .= '<div class="col-lg-2 height-min " style=""><div>Calories</div>
							<select name="options['.$j.'][exce][round]['.$r_i.'][Cal][count]" style="width:100%">'.$selectOP.'</select>
							</div>';
						}								

					}
					else{//not group
						$html .= '<div class="row" style="margin-bottom:5px" ><div style="margin-left:10px;">Male</div>';
						//for male						
						if(in_array('Repeats',$excAttr)){
							$getResp = isset($setExc['Repeats']['count'])?$setExc['Repeats']['count']:'';
							$selectOP ='<option value="0" selected="selected">ME</option>';
							for($I=1;$I<=100;$I++){
								if($getResp==$I){
									$selectOP .='<option value="'.$I.'" selected="selected">'.$I.'</option>';
								}
								else{
									$selectOP .='<option value="'.$I.'" >'.$I.'</option>';
								}
							}
							$html .= '<div class="col-lg-2 height-min" style=""><div>Repeats</div>
							<select name="options['.$j.'][exce][round]['.$r_i.'][Repeats][count]" style="width:100%">'.$selectOP.'
							</select>
							</div>';
						}								
						if(in_array('Weight',$excAttr)){							
							$getWC = isset($setExc['Weight']['count'])?$setExc['Weight']['count']:'';
							$getWU = isset($setExc['Weight']['unit'])?$setExc['Weight']['unit']:'';
							$selectOP ='<option value="0" >ME</option>';
							for($I=1;$I<=1000;$I++){
								if($getWC==$I){
									$selectOP .='<option value="'.$I.'" selected="selected">'.$I.'</option>';
								}
								else{
									$selectOP .='<option value="'.$I.'" >'.$I.'</option>';
								}
							}
							$html .= '<div class="col-lg-2 height-min " style=""><div>Weight</div>
							<select name="options['.$j.'][exce][round]['.$r_i.'][Weight][count]" style="width:100%">'.$selectOP.'</select>
							</div>';
							
//							$html .= '<div class="col-lg-2 height-min " style=""><div>Weight</div><input type="number" name="options['.$j.'][exce][round]['.$r_i.'][Weight][count]" value="'.$setExc['Weight']['count'].'" min="1" style="width:100%" /></div>';
	
							$html .= '<div class="col-lg-2 height-min" style=""><div>Unit</div>';
							$optionTime ='<option value="">Select</option>';
							if($weight_unit){
								foreach($weight_unit as $set_unit){
									$selected = ($getWU==$set_unit)?'selected':'';
									$optionTime .= '<option value="'.$set_unit.'" '.$selected.' >'.$set_unit.'</option>';
								}
							}
	
							$html .='<select class="" name="options['.$j.'][exce][round]['.$r_i.'][Weight][unit]"  style="width:100%">'.$optionTime.'</select></div>';
							
						}								
						if(in_array('Height',$excAttr)){
							$getHC = isset($setExc['Height']['count'])?$setExc['Height']['count']:'';
							$getHU = isset($setExc['Height']['unit'])?$setExc['Height']['unit']:'';
							$selectOP ='<option value="0" >ME</option>';
							for($I=1;$I<=1000;$I++){
								if($getHC==$I){
									$selectOP .='<option value="'.$I.'" selected="selected">'.$I.'</option>';
								}
								else{
									$selectOP .='<option value="'.$I.'" >'.$I.'</option>';
								}
							}
							$html .= '<div class="col-lg-2 height-min " style=""><div>Height</div>
							<select name="options['.$j.'][exce][round]['.$r_i.'][Height][count]" style="width:100%">'.$selectOP.'</select>
							</div>';

//							$html .= '<div class="col-lg-2 height-min" style=""><div>Height</div><input type="number" name="options['.$j.'][exce][round]['.$r_i.'][Height][count]" value="'.$setExc['Height']['count'].'" min="1"  style="width:100%"/></div>';
	
							$html .= '<div class="col-lg-2 height-min" style=""><div>Unit</div>';
							$optionTime ='<option value="">Select</option>';
							if($height_unit){
								foreach($height_unit as $set_unit){
									$selected = ($getHU==$set_unit)?'selected':'';
									$optionTime .= '<option value="'.$set_unit.'" '.$selected.' >'.$set_unit.'</option>';
								}
							}
	
							$html .='<select class="" name="options['.$j.'][exce][round]['.$r_i.'][Height][unit]"  style="width:100%">'.$optionTime.'</select></div>';
							
						}								
						if(in_array('Distance',$excAttr)){
							$getDC = isset($setExc['Distance']['count'])?$setExc['Distance']['count']:1;
							$getDU = isset($setExc['Distance']['unit'])?$setExc['Distance']['unit']:'';
							$html .= '<div class="col-lg-2 height-min" style=""><div>Distance</div>
							<input type="number" name="options['.$j.'][exce][round]['.$r_i.'][Distance][count]" value="'.$getDC.'" min="1" style="width:100%" /></div>';
	
							$html .= '<div class="col-lg-2 height-min" style=""><div>Unit</div>';
							$optionTime ='<option value="">Select</option>';
							if($distance_unit){
								foreach($distance_unit as $set_unit){
									$selected = ($getDU==$set_unit)?'selected':'';
									$optionTime .= '<option value="'.$set_unit.'" '.$selected.' >'.$set_unit.'</option>';
								}
							}
	
							$html .='<select class="" name="options['.$j.'][exce][round]['.$r_i.'][Distance][unit]" style="width:100%">'.$optionTime.'</select></div>';
							
						}								
						if(in_array('Time',$excAttr)){
							$getTC = isset($setExc['Time']['count'])?$setExc['Time']['count']:1;
							$getTU = isset($setExc['Time']['unit'])?$setExc['Time']['unit']:'';
							$html .= '<div class="col-lg-2 height-min" style=""><div>Time</div>
							<input type="number" name="options['.$j.'][exce][round]['.$r_i.'][Time][count]" value="'.$getTC.'" min="1" style="width:100%" /></div>';
	
							$html .= '<div class="col-lg-2 height-min " style=""><div>Unit</div>';
							$optionTime ='<option value="">Select</option>';
							if($time_unit){
								foreach($time_unit as $set_unit){
									$selected = ($getTU==$set_unit)?'selected':'';
									$optionTime .= '<option value="'.$set_unit.'" '.$selected.' >'.$set_unit.'</option>';
								}
							}
							$html .='<select class="" name="options['.$j.'][exce][round]['.$r_i.'][Time][unit]" style="width:100%">'.$optionTime.'</select></div>';
							
						}								

						if(in_array('Cal',$excAttr)){						
							$getCC = isset($setExc['Cal']['count'])?$setExc['Cal']['count']:'';
							$selectOP ='<option value="0" >ME</option>';
							for($I=1;$I<=1000;$I++){
								if($getCC==$I){
									$selectOP .='<option value="'.$I.'" selected="selected">'.$I.'</option>';
								}
								else{
									$selectOP .='<option value="'.$I.'" >'.$I.'</option>';
								}
							}
							$html .= '<div class="col-lg-2 height-min " style=""><div>Calories</div>
							<select name="options['.$j.'][exce][round]['.$r_i.'][Cal][count]" style="width:100%">'.$selectOP.'</select>
							</div>';
						}								

						$html .= '</div><!--//for male//-->';

						//for female
						$html .= '<div class="row" ><div style="margin-left:10px;">Female</div>';
						$getFemalecount = isset($setExc['Repeats']['count_f'])?$setExc['Repeats']['count_f']:0;
						if(in_array('Repeats',$excAttr)){
							$selectOP ='<option value="0">ME</option>';
							for($I=1;$I<=100;$I++){
								if($getFemalecount==$I){
									$selectOP .='<option value="'.$I.'" selected="selected">'.$I.'</option>';
								}
								else{
									$selectOP .='<option value="'.$I.'" >'.$I.'</option>';
								}
							}
							$html .= '<div class="col-lg-2 height-min" style=""><div>Repeats</div>
							<select name="options['.$j.'][exce][round]['.$r_i.'][Repeats][count_f]" style="width:100%">'.$selectOP.'
							</select>
							</div>';
						}								

						$getFemaleWcount = isset($setExc['Weight']['count_f'])?$setExc['Weight']['count_f']:0;
						$getFemaleWUnit = isset($setExc['Weight']['unit_f'])?$setExc['Weight']['unit_f']:'';
						if(in_array('Weight',$excAttr)){							

							$selectOP ='<option value="0" >ME</option>';
							for($I=1;$I<=1000;$I++){
								if($getFemaleWcount==$I){
									$selectOP .='<option value="'.$I.'" selected="selected">'.$I.'</option>';
								}
								else{
									$selectOP .='<option value="'.$I.'" >'.$I.'</option>';
								}
							}
							$html .= '<div class="col-lg-2 height-min " style=""><div>Weight</div>
							<select name="options['.$j.'][exce][round]['.$r_i.'][Weight][count_f]" style="width:100%">'.$selectOP.'</select>
							</div>';
							
							//$html .= '<div class="col-lg-2 height-min " style=""><div>Weight</div><input type="number" name="options['.$j.'][exce][round]['.$r_i.'][Weight][count_f]" value="'.$getFemaleWcount.'" min="1" style="width:100%" /></div>';
	
							$html .= '<div class="col-lg-2 height-min" style=""><div>Unit</div>';
							$optionTime ='<option value="">Select</option>';
							if($weight_unit){
								foreach($weight_unit as $set_unit){
									$selected = ($getFemaleWUnit==$set_unit)?'selected':'';
									$optionTime .= '<option value="'.$set_unit.'" '.$selected.' >'.$set_unit.'</option>';
								}
							}
	
							$html .='<select class="" name="options['.$j.'][exce][round]['.$r_i.'][Weight][unit_f]"  style="width:100%">'.$optionTime.'</select></div>';
							
						}								

						$getFemaleHCount	= isset($setExc['Height']['count_f'])?$setExc['Height']['count_f']:0;
						$getFemaleHUnit		= isset($setExc['Height']['unit_f'])?$setExc['Height']['unit_f']:'';
						if(in_array('Height',$excAttr)){

							$selectOP ='<option value="0" >ME</option>';
							for($I=1;$I<=1000;$I++){
								if($getFemaleHCount==$I){
									$selectOP .='<option value="'.$I.'" selected="selected">'.$I.'</option>';
								}
								else{
									$selectOP .='<option value="'.$I.'" >'.$I.'</option>';
								}
							}
							$html .= '<div class="col-lg-2 height-min " style=""><div>Height</div>
							<select name="options['.$j.'][exce][round]['.$r_i.'][Height][count_f]" style="width:100%">'.$selectOP.'</select>
							</div>';

						//	$html .= '<div class="col-lg-2 height-min" style=""><div>Height</div><input type="number" name="options['.$j.'][exce][round]['.$r_i.'][Height][count_f]" value="'.$getFemaleHCount.'" min="1"  style="width:100%"/></div>';
	
							$html .= '<div class="col-lg-2 height-min" style=""><div>Unit</div>';
							$optionTime ='<option value="">Select</option>';
							if($height_unit){
								foreach($height_unit as $set_unit){
									$selected = ($getFemaleHUnit==$set_unit)?'selected':'';
									$optionTime .= '<option value="'.$set_unit.'" '.$selected.' >'.$set_unit.'</option>';
								}
							}
	
							$html .='<select class="" name="options['.$j.'][exce][round]['.$r_i.'][Height][unit_f]"  style="width:100%">'.$optionTime.'</select></div>';
							
						}								

						$getFemaleDCount	= isset($setExc['Distance']['count_f'])?$setExc['Distance']['count_f']:0;
						$getFemaleDUnit		= isset($setExc['Distance']['unit_f'])?$setExc['Distance']['unit_f']:'';
						if(in_array('Distance',$excAttr)){
							$html .= '<div class="col-lg-2 height-min" style=""><div>Distance</div>
							<input type="number" name="options['.$j.'][exce][round]['.$r_i.'][Distance][count_f]" value="'.$getFemaleDCount.'" min="1" style="width:100%" /></div>';
	
							$html .= '<div class="col-lg-2 height-min" style=""><div>Unit</div>';
							$optionTime ='<option value="">Select</option>';
							if($distance_unit){
								foreach($distance_unit as $set_unit){
									$selected = ($getFemaleDUnit==$set_unit)?'selected':'';
									$optionTime .= '<option value="'.$set_unit.'" '.$selected.' >'.$set_unit.'</option>';
								}
							}
	
							$html .='<select class="" name="options['.$j.'][exce][round]['.$r_i.'][Distance][unit_f]" style="width:100%">'.$optionTime.'</select></div>';
							
						}								

						$getFemaleTCount	= isset($setExc['Time']['count_f'])?$setExc['Time']['count_f']:0;
						$getFemaleTUnit		= isset($setExc['Time']['unit_f'])?$setExc['Time']['unit_f']:'';
						if(in_array('Time',$excAttr)){
							$html .= '<div class="col-lg-2 height-min" style=""><div>Time</div>
							<input type="number" name="options['.$j.'][exce][round]['.$r_i.'][Time][count_f]" value="'.$getFemaleTCount.'" min="1" style="width:100%" /></div>';
	
							$html .= '<div class="col-lg-2 height-min " style=""><div>Unit</div>';
							$optionTime ='<option value="">Select</option>';
							if($time_unit){
								foreach($time_unit as $set_unit){
									$selected = ($getFemaleTUnit==$set_unit)?'selected':'';
									$optionTime .= '<option value="'.$set_unit.'" '.$selected.' >'.$set_unit.'</option>';
								}
							}
							$html .='<select class="" name="options['.$j.'][exce][round]['.$r_i.'][Time][unit_f]" style="width:100%">'.$optionTime.'</select></div>';
							
						}								

						$getFCalCount		= isset($setExc['Cal']['count_f'])?$setExc['Cal']['count_f']:'';
						if(in_array('Cal',$excAttr)){						
							$selectOP ='<option value="0" >ME</option>';
							for($I=1;$I<=1000;$I++){
								if($getFCalCount==$I){
									$selectOP .='<option value="'.$I.'" selected="selected">'.$I.'</option>';
								}
								else{
									$selectOP .='<option value="'.$I.'" >'.$I.'</option>';
								}
							}
							$html .= '<div class="col-lg-2 height-min " style=""><div>Calories</div>
							<select name="options['.$j.'][exce][round]['.$r_i.'][Cal][count_f]" style="width:100%">'.$selectOP.'</select>
							</div>';
						}								

						$html .= '</div><!--//for female//-->';

					}
					//for type 
					if($products->w_type=='Group'){
					//	echo '<pre>';
						//print_r($setExc['female']);
						//print_r($setExc['male']);
					//	echo '</pre>';
//&&in_array($mI,$setExc['male'];						
						$html .= '<div class="col-lg-2 height-min " style=""><div>Male</div>';
						$NoSelect = (isset($setExc['male'])&&!empty($setExc['male'])&&in_array('0',$setExc['male']))?'selected':'';
						$optionTime ='<option value="0" '.$NoSelect.'>No Male</option>';

						$allSelect = (isset($setExc['male'])&&!empty($setExc['male'])&&in_array('all',$setExc['male']))?'selected':'';
						$optionTime .='<option value="all" '.$allSelect.'>All</option>';
						if($products->c_male==''){
							for($mI=1;$mI<100;$mI++){
								$selected = (isset($setExc['male'])&&!empty($setExc['male'])&&in_array($mI,$setExc['male']))?'selected':'';
								$optionTime .= '<option value="'.$mI.'" '.$selected.' >'.$mI.'</option>';
							}
						}
						else{
							for($mI=1;$mI<=$products->c_male;$mI++){
								$selected = (isset($setExc['male'])&&!empty($setExc['male'])&&in_array($mI,$setExc['male']))?'selected':'';
								$optionTime .= '<option value="'.$mI.'" '.$selected.' >'.$mI.'</option>';
							}
						}
						$html .='<select class="tag_field" name="options['.$j.'][exce][round]['.$r_i.'][male][]" multiple="multiple" style="width:100%" required>'.$optionTime.'</select></div>';

						$html .= '<div class="col-lg-2 height-min" style=""><div>Female</div>';
						$NoSelect = (isset($setExc['female'])&&!empty($setExc['female'])&&in_array('0',$setExc['female']))?'selected':'';
						$optionTime1 ='<option value="0" '.$NoSelect.'>No Female</option>';

						$allSelect = (isset($setExc['female'])&&!empty($setExc['female'])&&in_array('all',$setExc['female']))?'selected':'';
						$optionTime1 .='<option value="all" '.$allSelect.'>All</option>';
						if($products->c_female==''){
							for($mI=1;$mI<100;$mI++){							
								$selected = (isset($setExc['female'])&&!empty($setExc['female'])&&in_array($mI,$setExc['female']))?'selected':'';
	//							$selected = (isset($setExc['female'])&&$setExc['female']==$mI)?'selected':'';
								$optionTime1 .= '<option value="'.$mI.'" '.$selected.' >'.$mI.'</option>';
							}
						}
						else{
							for($mI=1;$mI<=$products->c_female;$mI++){							
								$selected = (isset($setExc['female'])&&!empty($setExc['female'])&&in_array($mI,$setExc['female']))?'selected':'';
								$optionTime1 .= '<option value="'.$mI.'" '.$selected.' >'.$mI.'</option>';
							}
						}

						$html .='<select class="tag_field" name="options['.$j.'][exce][round]['.$r_i.'][female][]"  multiple="multiple" style="width:100%" required>'.$optionTime1.'</select></div>';
						
					}								

					$html .= '</div><!--//col-md-12//-->';
				}							
			}
		}
		$html .= '</div><!--//col-lg-9//-->';
		$deleteBtn = "'tool','".$j."'";
		$html .='<a href="javascript:void(0)" class="btn default" onclick="delete_style('.$deleteBtn.')"><i class="fa fa-times"></i></a></div><!--//form-group aajit//--> ';
		echo $html;	
	}
}
?>
<?php
		$j++;
	}
/*	echo '<pre>';
	print_r($OptionArr);
	echo '</pre>';*/
	}
}
else{
?>
<!--<div style="margin-bottom:10px;">
<div class="form-group">
    <div class="col-md-1">
    	<label class="control-label"><?=show_static_text($adminLangSession['lang_id'],2710);?>Excercise</label>    
    </div>
    <div class="col-md-1">
    	<label class="control-label"><?=show_static_text($adminLangSession['lang_id'],2710);?>Style</label>    
    </div>
    <div class="col-md-1">
    	<label class="control-label"><?=show_static_text($adminLangSession['lang_id'],2710);?>Tool</label>    
    </div>
	<div class="col-md-1">
        <label class="control-label"><?=show_static_text($adminLangSession['lang_id'],2710);?>Body Part</label>    	
    </div>
    <div class="col-md-1">
	    <label class="control-label"><?=show_static_text($adminLangSession['lang_id'],2710);?>Machine</label>    
    </div>
    <div class="col-lg-1">
	    <label class="control-label"><?=show_static_text($adminLangSession['lang_id'],2710);?>Order</label>    
    </div>

    <div class="col-lg-1">
	    <label class="control-label"><?=show_static_text($adminLangSession['lang_id'],2710);?>Count (Round 1)</label>    
    </div>

    <div class="col-lg-1">
	    <label class="control-label"><?=show_static_text($adminLangSession['lang_id'],2710);?>Count (Round 2)</label>    
    </div>

    <div class="col-lg-1">
	    <label class="control-label"><?=show_static_text($adminLangSession['lang_id'],2710);?>Count (Round 3)</label>    
    </div>

	<div class="col-lg-1">
	    <label class="control-label"><?=show_static_text($adminLangSession['lang_id'],2710);?>Distance</label>    
    </div>    
    
    <div class="col-lg-1">
	    <label class="control-label"><?=show_static_text($adminLangSession['lang_id'],2710);?>Unit</label>    
    </div>
    
    </div>
 </div>-->
<?php
}
?>      

            </div>            
        </div><!--//product-options//-->
      </div>
    </div><!--tools option-->
    

    
			<div class="form-group">
              <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],27006);?>Description</label>
              <div class="col-lg-10">
                <?=form_textarea('description', html_entity_decode(set_value('description', $products->{'description'})), 'placeholder="" rows="3" class="cleditor2 form-control"')?>
              </div>
            </div>
			</div>
            
               <div style="clear:both"></div>

						</div>
	                 <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-2 col-md-9">
                                    <?=form_submit('submit', show_static_text($adminLangSession['lang_id'],235), 'class="btn btn-primary"')?>
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


<script>
var j =parseInt('<?=$j+1;?>');
var wrapper         = $(".input_fields_wrap"); //Fields wrapper
function add_style(id){
	$('.error_op').html('');
	if(id==''){
//		$('.error_style').html('Please select first');
		return false;
	}
	$.ajax({
		type:"POST",
		url:"<?=$_cancel?>/ajaxStyles",
		data:{j:j,style_id:id,<?=$this->security->get_csrf_token_name();?>:'<?=$this->security->get_csrf_hash();?>'},
		dataType: 'json',
		success: function(json) {	
			if(json.status=='ok'){
				//console.log(j);
				$(wrapper).append(json.html); 
				//console.log('as: '+j);
				j++;
			}
			if(json.status=='error'){
			}
		}
	});
}

function add_tool(id){
	$('.error_op').html('');
	if(id==''){
//		$('.error_style').html('Please select first');
		return false;
	}
	$.ajax({
		type:"POST",
		url:"<?=$_cancel?>/ajaxAddTools",
		data:{j:j,tool_id:id,<?=$this->security->get_csrf_token_name();?>:'<?=$this->security->get_csrf_hash();?>'},
		dataType: 'json',
		success: function(json) {	
			if(json.status=='ok'){
				//console.log(j);
				$(wrapper).append(json.html); 
				//console.log('as: '+j);
				j++;
			}
			if(json.status=='error'){
			}
		}
	});
}

function add_excercise(id){
	$('.error_op').html('');
	if(id==''){
//		$('.error_style').html('Please select first');
		return false;
	}
	rounds = 1;
	if($('.round').length>0){
		rounds = $('.round').val();
	}

	g_type = $('#input-type').val();
	$.ajax({
		type:"POST",
		url:"<?=$_cancel?>/ajaxaAddExcercise",
		data:{j:j,exce_id:id,rounds:rounds,g_type:g_type,<?=$this->security->get_csrf_token_name();?>:'<?=$this->security->get_csrf_hash();?>'},
		dataType: 'json',
		success: function(json) {	
			if(json.status=='ok'){
				//console.log(j);
				$(wrapper).append(json.html); 
				if(g_type){
					$('.tag_field'+j).select2({placeholder: "Select"});
				}
				//console.log('as: '+j);
				j++;
			}
			if(json.status=='error'){
			}
		}
	});
}

function delete_style(type,id){
	$('.w_option_'+id).remove();
}

function delete_option(p_id,o_id){
	$.ajax({
		type:"POST",
		url:"<?=$_cancel;?>/delete_options",
		data:{p_id:p_id,o_id:o_id,<?=$this->security->get_csrf_token_name();?>:'<?=$this->security->get_csrf_hash();?>'},
		dataType: 'json',
		success: function(json) {	
			if(json.status=='ok'){
				$('#options_'+o_id).remove();
			}
			if(json.status=='error'){
				alert('Sorry!! you can not delete.');
			}
		}
	});
}

function changeOption(type){
/*	if(type=='Single Movement'){
		$('.tmp_options').remove();
		$('.add_field_button2').hide();
	}
	else{
		$('.add_field_button2').show();
	}*/
}

function changeOption2(type){
	if(type=='Group'){
		//$('.required-field2').attr('required',true);
		$('.hide-data2').show();
	}
	else{
		$('.hide-data2').hide();
		$('.required-field2').attr('required',false);
	}
}

</script><!--options-->

<script>
function get_tool(id){	
	$.ajax({
		type:"POST",
		url:"<?=$_cancel.'/getTools'?>",
		data:{id:id,<?=$this->security->get_csrf_token_name();?>:'<?=$this->security->get_csrf_hash();?>'},
		dataType: 'json',
		success: function(json) {	
			if(json.status=='ok'){
				$('#input-tool').html(json.msge);
			}
			if(json.status=='error'){
				$('#input-tool').html('<option value="">Add Tools</option>');
			}
		}
		
	});
}

</script>

<style>
#product-options .col-md-1{
	padding:0px 5px;
}

#product-options .col-lg-1{
	width:7.49%;
}
#product-options .col-lg-2, #product-options .col-lg-1{
	padding:0px 5px;
}
#product-options .control-label{
	min-height:40px;
}
</style>

<link href="assets/plugins/select2/select2.css" rel="stylesheet"/>
<script type="text/javascript" src="assets/plugins/select2/select2.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$('.tag_field').select2({placeholder: "Select"});
});

</script>


<link href="assets/global/plugins/bootstrap-datepicker/css/datepicker.css"  rel='stylesheet' type='text/css' >
<script type="text/javascript" src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script>
$(document).ready(function(){
	//$('&nbsp;').appendTo('div.dataTables_filter');
	//$('div.dataTables_filter').appendTo('<button id="refresh">Refresh</button>');
	$('#input-date').datepicker({ dateFormat: 'mm-dd-yy', altField: '#input-date_alt', altFormat: 'yy-mm-dd' }).on('changeDate', function(e){
    $(this).datepicker('hide');});

});
</script>

<style>
.height-min{
	min-height:44px;
}
</style>