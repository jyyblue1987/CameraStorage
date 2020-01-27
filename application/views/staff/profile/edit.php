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
<div class="form-body">                    
	<div class="form-group" >
	<label class="col-lg-2 control-label" style="padding-top:0"><?=show_static_text($lang_id,18);?></label>
    <div class="col-md-10">
	    <?=$user_details->{'email'}?>
    </div>
</div>
    <div class="form-group" >
	<label class="col-lg-2 control-label"><?=show_static_text($lang_id,16);?></label>
    <div class="col-md-10">
	    <?=form_input('first_name', set_value('first_name', $user_details->{'first_name'}), 'class="form-control " id="" placeholder=""')?>
    	<span class="error-span"><?php echo form_error('first_name'); ?></span>
    </div>
</div>
	
    
    <div class="form-group" >
        <label class="col-lg-2 control-label"><?=show_static_text($lang_id,82);?></label>
	    <div class="col-lg-10">
    	    <?=form_input('phone', set_value('phone', $user_details->{'phone'}), 'class="form-control " id="" placeholder=""')?>
        	<span class="error-span"><?php echo form_error('phone'); ?></span>
        </div>
    </div>


    <div class="form-group" >
        <label class="col-lg-2 control-label"><?=show_static_text($lang_id,46);?></label>
	    <div class="col-lg-10">
    	    <?=form_input('address', set_value('address', $user_details->{'address'}), 'class="form-control " id="" placeholder=""')?>
        	<span class="error-span"><?php echo form_error('address'); ?></span>
        </div>
    </div>

    <div class="form-group">
      <label class="col-lg-2 control-label"><?=show_static_text($lang_id,263);?></label>
        <div class="col-md-10">
        <div class="fileinput fileinput-new" data-provides="fileinput">
            <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
                <?php echo (isset($user_details->image)&&!empty($user_details->image)) ? '<img src="'.base_url('assets/uploads/users/thumbnails').'/'.$user_details->image.'" >':'<img src="assets/uploads/no-image.gif">'; ?>
            </div>
            <div>
            <span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span>
            <input type="file" name="image" id="logo"></span>
            <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
        </div>
        </div>
            <!--<input type="file" name="logo" id="logo" />-->
      </div>
      </div>
</div>
         <div class="form-actions">
                <div class="row">
                    <div class="col-md-offset-2 col-md-9">
                        <?=form_submit('submit', show_static_text($lang_id,235), 'class="btn btn-primary"')?>
	                    <a href="<?=$_user_link.'/account';?>" class="btn btn-default" type="button"><?=show_static_text($lang_id,22);?></a>
                    </div>
                </div>
            </div>
     <?=form_close()?>
            </div>
        </div>
        <!-- end panel -->
    </div>
</div>

<link href="assets/plugins/jasny-bootstrap/css/jasny-bootstrap.min.css" rel="stylesheet" type="text/css"/>
<script src="assets/plugins/jasny-bootstrap/js/jasny-bootstrap.min.js" type="text/javascript" language="javascript"></script> 

