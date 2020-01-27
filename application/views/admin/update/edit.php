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
                 	<input type="hidden" name="operation" value="set" />
                               
                        <div class="form-body">                    
	                        <div class="form-group" >
                  			<label class="col-lg-4 control-label">Data will be update by default lang data.</label>
                            
                        </div>                        	
						</div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-2 col-md-9">
                                    <?=form_submit('submit', 'Update', 'class="btn btn-primary"')?>
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


