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
                 	<input name="operation" type="hidden" value="set" />
                     <div class="form-body">                                          
	                    <div class="col-md-12">						                        
                        <div class="form-group">
                              <label class="col-lg-2 control-label">Upload Csv Files</label>
                              <div class="col-lg-3">
                                <input type="file" name="userfile" id="logo" requried>
                                    <!--<input type="file" name="logo" id="logo" />-->
                              </div>
  
							</div>
						</div>
                        

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

