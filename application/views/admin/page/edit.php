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
                                
                    
                    <div class="form-group">
                      <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],288);?></label>
                      <div class="col-lg-10">
                        <?php echo form_dropdown('template', $templates_page, $this->input->post('template') ? $this->input->post('template') : $page->template, 'class="form-control"'); ?>
                      </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label"><?=show_static_text($adminLangSession['lang_id'],289);?></label>
                        <div class="col-md-10">
                            <div class="checkbox">
                                <label>
                        <?=form_checkbox('top_menu', '1', set_value('top_menu', $page->top_menu), 'id="inputDefault" class=""')?>
                                </label>
                            </div>                                        
                        </div>
                    </div>

                    <!--<div class="form-group">
                        <label class="col-md-2 control-label"><?=show_static_text($adminLangSession['lang_id'],2890);?>Middle Menu</label>
                        <div class="col-md-10">
                            <div class="checkbox">
                                <label>
                        <?=form_checkbox('middle_menu', '1', set_value('middle_menu', $page->middle_menu), 'id="inputDefault" class=""')?>
                                </label>
                            </div>                                        
                        </div>
                    </div>-->
                                


                    <div class="form-group">
                        <label class="col-md-2 control-label"><?=show_static_text($adminLangSession['lang_id'],290);?></label>
                        <div class="col-md-10">
                            <div class="checkbox">
                                <label>
                            <?=form_checkbox('bottom_menu', '1', set_value('bottom_menu', $page->bottom_menu), 'id="inputDefault" class=""')?>
                                </label>
                            </div>                                        
                        </div>
                    </div>
                                        

					<div class="form-group" >
                  			<label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],267);?></label>
                            <div class="col-lg-10">
                               <?=form_input('slug', set_value('slug', $page->{'slug'}), 'class="form-control " id="" placeholder="Slug"')?>
                            </div>
                        </div>                      
    
					<div class="form-group">
                      <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],2808);?>Display as</label>
                      <div class="col-lg-10">
                        <?php echo form_dropdown('display', $display, $this->input->post('display') ? $this->input->post('display') : $page->display, 'class="form-control"'); ?>
                      </div>
                    </div>
    
                     <hr />
                    <div class="form-group">
                      <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],263);?></label>
                      <div class="col-lg-10">
				      	<div class="fileinput fileinput-new" data-provides="fileinput">
							<div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
                                <?php echo !isset($page->image) ? '<img src="assets/uploads/no-image.gif">' :'<img src="'.base_url('assets/uploads/pages').'/'.$page->image.'" >'; ?>
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
    
                    <hr />
                    <h5><?=show_static_text($adminLangSession['lang_id'],268);?></h5>
                   <div style="margin-bottom: 0px;" class="tabbable">
                      <ul class="nav nav-tabs">
                        <?php $i=0;
                      //   debugger($this->pages_model->languages_icon);
                      //  foreach($this->pages_model->languages as $key_lang=>$val_lang):
                      /*echo '<pre>';
                      print_r($this->pages_model->languages);
                      die;*/
                        foreach($this->pages_model->languages_icon as $key_lang=>$val_lang):
    
                          $i++;?>
                        <li class="<?=$i==1?'active':''?>">
                          <a data-toggle="tab" href="#<?=$key_lang?>"><img src="<?php echo base_url('assets/uploads/language').'/'.$val_lang; ?>" height="15" width="20" ></a></li>
                        <?php endforeach;?>
                      </ul>
                      <div style="padding-top: 9px; border-bottom: 1px solid #ddd;" class="tab-content">
                        <?php $i=0;foreach($this->pages_model->languages as $key_lang=>$val_lang):$i++;?>
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
                            
                            <div class="form-group">
                              <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],27);?></label>
                              <div class="col-lg-10">
                                <?=form_input('keywords_'.$key_lang, set_value('keywords_'.$key_lang, $page->{'keywords_'.$key_lang}), 'class="form-control" id="inputKeywords'.$key_lang.'" placeholder="Keywords"')?>
                              </div>
                            </div>
                            
                            <div class="form-group">
                              <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],248);?></label>
                              <div class="col-lg-10">
                                <?=form_textarea('short_description_'.$key_lang, set_value('short_description_'.$key_lang, $page->{'short_description_'.$key_lang}), 'placeholder="Meta  Description" rows="3" class="form-control"')?>
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
                        </div>
                    </div>
                </div>
            <?=form_close()?>
            </div>
        </div>
        <!-- end panel -->
    </div>
</div>



<link href="assets/plugins/jasny-bootstrap/css/jasny-bootstrap.min.css" rel="stylesheet" type="text/css"/>
<script src="assets/plugins/jasny-bootstrap/js/jasny-bootstrap.min.js" type="text/javascript" language="javascript"></script> 
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

