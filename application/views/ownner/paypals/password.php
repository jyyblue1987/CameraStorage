<div class="row">
<div class="col-md-12">
<!-- begin panel -->
<div data-sortable-id="form-stuff-1" class="panel panel-inverse">
    <div class="panel-heading">                
        <h4 class="panel-title"><?=$name?></h4>
    </div>
    <div class="panel-body">
        <?php echo validation_errors(); ?>
        <form class="form-horizontal" role="form" method="post">
            <input type="hidden" name="<?=$this->security->get_csrf_token_name(); ?>" value="<?=$this->security->get_csrf_hash();?>" />
            <div class="form-body">
                <div class="form-group">
                    <label class="col-sm-2 control-label">Password</label>
                    <div class="col-sm-4">
                        <input type="password" name="password" class="form-control"  required="required" >
                    </div>
                </div>
            </div>                    
            
            <div class="form-actions">
            <div class="row">
                <div class="col-md-offset-2 col-md-9">
                    <button type="submit" class="btn btn-primary btn-label-left">Submit</button>
                    <a href="<?=$_cancel;?>" class="btn btn-default" type="button"><?=show_static_text($lang_id,22);?></a>
                </div>
            </div>
        </div>
        </form>
    </div>
</div>
<!-- end panel -->
</div>
</div>
