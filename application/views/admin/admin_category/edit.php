<div class="row">
    <div class="col-md-12">
        <!-- begin panel -->
        <div data-sortable-id="form-stuff-1" class="panel panel-inverse">
            <div class="panel-heading">                
				<div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
<!--                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>-->
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                <h4 class="panel-title"><?=$name?></h4>
            </div>
            <div class="panel-body">
            <!-- BEGIN FORM-->
            <?php echo validation_errors();?>
            <form class="form-horizontal"  method="post" enctype="multipart/form-data" data-parsley-validate="true">
					<input type="hidden" name="<?=$this->security->get_csrf_token_name(); ?>" value="<?=$this->security->get_csrf_hash();?>" />
                	<input type="hidden" name="operation" value="set" />
                    <div class="form-body">
                        <div class="form-group" >
                            <label class="col-lg-2 control-label" >Name</label>
                            <div class="col-lg-10">
                                <?=form_input('name', set_value('name', $categories->{'name'}), 'class="form-control " id="" placeholder="Name" required')?>
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
               </form>
            </div>
        </div>
        <!-- end panel -->
    </div>
</div>





<link href="assets/admin_temp/plugins/parsley/src/parsley.css" rel="stylesheet" />
<script src="assets/admin_temp/plugins/parsley/dist/parsley.js"></script>
<script>		
//$('form[name="name"]').parsley();
$('#form').parsley();
</script>
