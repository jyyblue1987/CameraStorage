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
					<input type="hidden" name="<?=$this->security->get_csrf_token_name(); ?>" value="<?=$this->security->get_csrf_hash();?>" />
                <div class="form-body">
                    <div class="form-group">
                        <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],245);?></label>
                        <div class="col-lg-4">
                           <?=form_input('admin_link', set_value('admin_link', isset($settings['admin_link'])?$settings['admin_link']:''), 'class="form-control"  placeholder="Admin Link" required')?>
                        </div>
                    </div>
                </div>
                    
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-2 col-md-9">
                            <button type="submit" class="btn btn-primary btn-label-left"><?=show_static_text($adminLangSession['lang_id'],56);?></button>
                        </div>
                    </div>
				</div>

<div class="alert alert-block alert-warning fade in" style="margin-top:20px">
<b>Note:</b>
<br>Please close all tab of admin link.
</div>
                                    
            </form>
            </div>
        </div>
        <!-- end panel -->
    </div>
</div>

