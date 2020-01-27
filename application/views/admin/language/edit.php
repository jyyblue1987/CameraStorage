<div class="row">
    <div class="col-md-12">
        <!-- begin panel -->
        <div data-sortable-id="form-stuff-1" class="panel panel-inverse">
            <div class="panel-heading">                
                <h4 class="panel-title"><?=$name?></h4>
            </div>
            <div class="panel-body">
                <?php echo validation_errors();?>
				<?=form_open(NULL, array('class' => 'form-horizontal', 'role'=>'form', 'enctype'=>"multipart/form-data"))?>                              
                    <div class="form-body">
                            <div class="form-group">
                              <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],16);?></label>
                              <div class="col-lg-10">
                                <?=form_input('language', set_value('language', $language->language), 'class="form-control" id="inputLanguage" placeholder="Language"')?>
                              </div>
                            </div>

                            <div class="form-group">
                              <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],39);?></label>
                              <div class="col-lg-10">
                                <?=form_input('code', set_value('code', $language->code), 'class="form-control" id="inputCode" placeholder="Code"')?>
                              </div>
                            </div>

                
                            <div class="form-group">
                              <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],261);?></label>
                              <div class="col-lg-10">
                                <?=form_input('currency', set_value('currency', $language->currency), 'class="form-control" id="inputCode" placeholder="Currency"')?>
                              </div>
                            </div>

                            <div class="form-group">
                              <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],262);?></label>
                              <div class="col-lg-10">
                                <?=form_input('unit', set_value('unit', $language->unit), 'class="form-control" id="inputCode" placeholder="Unit"')?>
                              </div>
                           </div>

                            
                            <div class="form-group">
                              <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],260);?></label>
                              <div class="col-lg-10">
                                <?=form_checkbox('default', '1', set_value('default', $language->default), 'id="inputDefault"')?>
                              </div>
                            </div>

                
                            <div class="form-group">
                              <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],263);?></label>
                              <div class="col-lg-10">
                                <input type="file" name="logo" id="logo" />
                              </div>
                            </div>
                    </div>                                

                    <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-2 col-md-9">
                                <?=form_submit('submit',show_static_text($adminLangSession['lang_id'],235), 'class="btn btn-primary"')?>
                                <a href="<?=$_cancel?>" class="btn btn-default" type="button"><?=show_static_text($adminLangSession['lang_id'],22);?></a>
                                </div>
                            </div>
                        </div>
                <?=form_close()?>
            <!-- END FORM-->
            </div>
        </div>
        <!-- end panel -->
    </div>
</div>
