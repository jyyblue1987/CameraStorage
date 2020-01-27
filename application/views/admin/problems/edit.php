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
                 <input type="hidden" name="operation" value="set"  />
                     <div class="form-body">                    
                      
                    <div class="col-md-12">						                                                
                        
                      
                <div class="form-group" >
                      <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],158);?></label>
                      <div class="col-lg-10">
                            <select class="form-control" id="order_status" name="status">
                                <option value="Canceled">Canceled</option>
                                <option value="Complete">Complete</option>
                                <option value="Failed">Failed</option>
                                <option value="Pending" selected="selected">Pending</option>
                                <option value="Processed">Processed</option>
                                <option value="Processing">Processing</option>
                            </select>
                      </div>
                    </div>
				
                <div class="form-group">
                  <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],2706);?>Description</label>
                  <div class="col-lg-10">
                    <?=form_textarea('description', set_value('description'), 'placeholder="" rows="1" style="height:100px" class=" form-control" required')?>
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
