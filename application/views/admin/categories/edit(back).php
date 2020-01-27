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
                      <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],266);?></label>
                      <div class="col-lg-10">
                        <?=form_dropdown('parent_id', $pages_no_parents, $this->input->post('parent_id') ? $this->input->post('parent_id') : $categories->parent_id, 'class="form-control"')?>
                      </div>
                    </div>	
	                        <div class="form-group" >
                  			<label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],267);?></label>
                            <div class="col-lg-10">
                               <?=form_input('slug', set_value('slug', $categories->slug), 'class="form-control " id="" placeholder="Slug"')?>
                            </div>
                        </div>
	                        <div class="form-group">
                      <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],263);?></label>
                      <div class="col-lg-10">
				      	<div class="fileinput fileinput-new" data-provides="fileinput">
							<div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
                                <?php echo !isset($categories->image) ? '<img src="assets/uploads/no-image.gif">' :'<img src="'.base_url('assets/uploads/categories/thumbnails').'/'.$categories->image.'" >'; ?>
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
                                foreach($this->category_model->languages_icon as $key_lang=>$val_lang):

                                  $i++;?>
                                <li class="<?=$i==1?'active':''?>">
                                  <a data-toggle="tab" href="#<?=$key_lang?>"><img src="<?php echo base_url('assets/uploads/language').'/'.$val_lang; ?>" height="15" width="20" ></a></li>
                                <?php endforeach;?>
                              </ul>
                              <div style="padding-top: 9px; border-bottom: 1px solid #ddd;" class="tab-content">
                                <?php $i=0;foreach($this->category_model->languages as $key_lang=>$val_lang):$i++;?>
                                <div id="<?=$key_lang?>" class="tab-pane <?=$i==1?'active':''?>">
                                    <div class="form-group">
                                      <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],236);?></label>
                                      <div class="col-lg-10">
                                        <?=form_input('title_'.$key_lang, set_value('title_'.$key_lang, $categories->{'title_'.$key_lang}), 'class="form-control copy_to_next" id="inputTitle'.$key_lang.'" placeholder="'.lang('Title').'"')?>
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
                                    <a href="<?=$_cancel;?>" class="btn btn-default" type="button"><?=show_static_text($adminLangSession['lang_id'],22);?></a>
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


<link href="assets/plugins/jasny-bootstrap/css/jasny-bootstrap.min.css" rel="stylesheet" type="text/css"/>
<script src="assets/plugins/jasny-bootstrap/js/jasny-bootstrap.min.js" type="text/javascript" language="javascript"></script> 

