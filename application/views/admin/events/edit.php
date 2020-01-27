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
            
					<div class="form-group" >
                  			<label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],267);?></label>
                            <div class="col-lg-10">
                               <?=form_input('slug', set_value('slug', $page->{'slug'}), 'class="form-control " id="" placeholder=""')?>
                            </div>
                        </div>                      
					<div class="form-group" >
                  			<label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],284);?></label>
                            <div class="col-lg-10">
                               <?=form_input('place', set_value('place', $page->{'place'}), 'class="form-control " id="" placeholder=""')?>
                            </div>
                        </div>                      
					<div class="form-group" >
                  			<label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],153);?></label>
                            <div class="col-lg-10">
                               <?=form_input('publish', set_value('publish', $page->{'publish'}), 'class="form-control  datetimepicker1" id="" placeholder=""')?>
                            </div>
                        </div>                      
    
    
                    <hr />
                    <h5><?=show_static_text($adminLangSession['lang_id'],268);?></h5>
                   <div style="margin-bottom: 0px;" class="tabbable">
                      <ul class="nav nav-tabs">
                        <?php $i=0;
                      //   debugger($this->event_model->languages_icon);
                      //  foreach($this->event_model->languages as $key_lang=>$val_lang):
                      /*echo '<pre>';
                      print_r($this->event_model->languages);
                      die;*/
                        foreach($this->event_model->languages_icon as $key_lang=>$val_lang):
    
                          $i++;?>
                        <li class="<?=$i==1?'active':''?>">
                          <a data-toggle="tab" href="#<?=$key_lang?>"><img src="<?php echo base_url('assets/uploads/language').'/'.$val_lang; ?>" height="15" width="20" ></a></li>
                        <?php endforeach;?>
                      </ul>
                      <div style="padding-top: 9px; border-bottom: 1px solid #ddd;" class="tab-content">
                        <?php $i=0;foreach($this->event_model->languages as $key_lang=>$val_lang):$i++;?>
                        <div id="<?=$key_lang?>" class="tab-pane <?=$i==1?'active':''?>">
                            <div class="form-group" >
                              <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],236);?></label>
                              <div class="col-lg-10">
                                <?=form_input('title_'.$key_lang, set_value('title_'.$key_lang, $page->{'title_'.$key_lang}), 'class="form-control copy_to_next" id="inputTitle'.$key_lang.'" placeholder="Title"')?>
                              </div>
                            </div>
                                                        
                            <div class="form-group">
                              <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],276);?></label>
                              <div class="col-lg-10">
                                <?=form_textarea('body_'.$key_lang, set_value('body_'.$key_lang, $page->{'body_'.$key_lang}), 'placeholder="Body" rows="3" class="cleditor2 form-control"')?>
                              </div>
                            </div>
                              
                        </div>
                        <?php endforeach;?>
                      </div>
                    </div>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-2 col-md-9">
                            <?=form_submit('submit', show_static_text($adminLangSession['lang_id'],235), 'class="btn btn-primary"')?>
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


<script src="assets/plugins/ckeditor/ckeditor.js" type="text/javascript" language="javascript"></script> 
<script src="assets/plugins/ckeditor/adapters/jquery.js" type="text/javascript" language="javascript"></script> 
<script>
/* CL Editor */
$(document).ready(function(){
    $('.cleditor2').ckeditor({
	    filebrowserUploadUrl : '<?=site_url("ajax/upload_editor_image")?>'	
	});
});
</script>


<link href="assets/admin_temp/plugins/bootstrap-eonasdan-datetimepicker/build/css/bootstrap-datetimepicker.min.css" rel="stylesheet" />
<script src="assets/admin_temp/plugins/bootstrap-daterangepicker/moment.js"></script>
<script src="assets/admin_temp/plugins/bootstrap-eonasdan-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript">
$(function () {
	$('.datetimepicker1').datetimepicker({
		format: 'DD-MM-YYYY HH:mm'
	});
});
</script>

