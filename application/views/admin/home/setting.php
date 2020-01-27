<div class="row">
    <div class="col-md-12">
        <!-- begin panel -->
        <div data-sortable-id="form-stuff-1" class="panel panel-inverse">
            <div class="panel-heading">                
                <h4 class="panel-title"><?=$name?></h4>
            </div>
            <div class="panel-body">
            <!-- BEGIN FORM-->
            <?php echo validation_errors();?>
			<?=form_open(NULL, array('class' => 'form-horizontal', 'role'=>'form','enctype'=>"multipart/form-data"))?>                              
            	<input type="hidden" name="operation" value="set" />
                <div class="form-body">                    
                    <div class="form-group">
                      <label class="col-lg-2 control-label">Home background</label>
                      <div class="col-lg-10">
                        <?=form_dropdown('type', $types, $this->input->post('type') ? $this->input->post('type') : $page->type, 'class="form-control"')?>
                      </div>
                    </div>
                   
                </div>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-2 col-md-9">
                            <?=form_submit('submit', 'Save', 'class="btn btn-primary"')?>
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
