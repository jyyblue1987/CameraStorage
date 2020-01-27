
<div class="row">
    <div class="col-md-12">
        <!-- begin panel -->
        <div data-sortable-id="form-stuff-1" class="panel panel-inverse">
            <div class="panel-heading">                				
                <h4 class="panel-title"><?=$name?></h4>
            </div>
            <div class="panel-body">
    	        <?php echo validation_errors();?>
				<?=form_open(NULL, array('class' => 'form-horizontal', 'role'=>'form', 'enctype'=>"multipart/form-data",'data-parsley-validate'=>"true"))?>                              
                    <div class="form-body">                                                	
                        <div class="form-group" >
                            <label class="col-lg-2 control-label"><?=lang('')?>Name</label>
                            <div class="col-lg-10">
                               <?=form_input('name', set_value('name', $categories->name), 'class="form-control " id="" placeholder="" required' )?>
                            </div>
                        </div>
                        <div class="form-group" >
                            <label class="col-lg-2 control-label">Description</label>
                            <div class="col-lg-10">
                               <?=form_textarea('desc', set_value('desc', $categories->desc), 'placeholder="" rows="3" class="form-control"')?>
                            </div>
                        </div>                    
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-2 col-md-9">
                                <?=form_submit('submit', lang('Save'), 'class="btn btn-success"')?>
                                <a href="<?=$_cancel?>" class="btn btn-default" type="button"><?=lang('Cancel')?></a>
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


<link href="assets/admin_temp/plugins/parsley/src/parsley.css" rel="stylesheet" />
<script src="assets/admin_temp/plugins/parsley/dist/parsley.js"></script>
<script>		
$('#form').parsley();
</script>