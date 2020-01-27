<div class="row">
    <div class="col-md-12">
        <!-- begin panel -->
        <div data-sortable-id="form-stuff-1" class="panel panel-inverse">
            <div class="panel-heading">                
                <h4 class="panel-title"><?=$name?></h4>
            </div>
            <div class="panel-body">
<?php //echo validation_errors();?>
<?=form_open(NULL, array('class' => 'form-horizontal', 'role'=>'form','enctype'=>"multipart/form-data"))?>
<input type="hidden" name="id" value="<?=$products->id?>" />
<div class="form-body">                    
	<div class="col-md-12">                                  

    <div class="form-group">
        <label class="col-lg-2 control-label" style="padding-top:0"><?=show_static_text($lang_id,1088);?>Device Name</label>
        <div class="col-lg-10">
<?=$products->name?>
        </div>
	</div>

    <div class="form-group">
	    <label class="col-lg-2 control-label" style="padding-top:0"><?=show_static_text($lang_id,1088);?>Price</label>
    	<div class="col-lg-10">$<?=$products->price?>

	    </div>
    </div>
    
	</div>

<div style="clear:both"></div>

        </div>

         <div class="form-actions">
                <div class="row">
                    <div class="col-md-offset-2 col-md-9">
                        <?=form_submit('submit', 'upgrade Now', 'class="btn btn-primary"')?>
                        <a href="<?=$_cancel.'/l/'.$client_data->id;?>" class="btn btn-default" type="button"><?=show_static_text($lang_id,22);?></a>
                    </div>
                </div>
            </div>
     <?=form_close()?>
            </div>
        </div>
        <!-- end panel -->
    </div>
</div>
