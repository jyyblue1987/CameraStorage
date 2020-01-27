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
				<input type="hidden" name="chat_set" value="set" />
                <div class="form-body">
                    <div class="form-group">
                        <label class="col-lg-2 control-label" style="padding:0px;">Enable</label>
                        <div class="col-lg-4">
                        	<input type="checkbox" name="email_option" value="1" <?=isset($settings['email_option'])&&$settings['email_option']==1?'checked="checked"':''?>  />
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
            </form>
            </div>
        </div>
        <!-- end panel -->
    </div>
</div>

