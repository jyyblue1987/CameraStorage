<div class="row">
    <div class="col-md-12">
        <!-- begin panel -->
        <div data-sortable-id="form-stuff-1" class="panel panel-inverse">
            <div class="panel-heading">                
                <h4 class="panel-title"><?=$name?></h4>
            </div>
            <div class="panel-body">
				<?php echo validation_errors(); ?>
	            <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">                    
                <div class="form-body">
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Donation</label>
                        <div class="col-lg-4">
                           <?=form_input('donation', set_value('donation', isset($settings['donation'])?$settings['donation']:''), 'class="form-control"  placeholder=""')?>
                        </div>
                        
                    </div>
                    
                    
                </div>
                    
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-2 col-md-9">
                            <button type="submit" class="btn btn-primary btn-label-left">
                            <?php echo 'Update';?></button>
                        </div>
                    </div>
				</div>                    
            </form>
            </div>
        </div>
        <!-- end panel -->
    </div>
</div>

