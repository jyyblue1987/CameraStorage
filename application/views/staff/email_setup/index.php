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
<input type="hidden" value="create" name="formType">
<div class="form-body">                    
	<div class="col-md-12">						                        

	<div class="form-group" >
        <label class="col-lg-2 control-label"><?=show_static_text($lang_id,1000);?>SMTP Host</label>
        <div class="col-lg-10">
			<?=form_input('smtp_host', set_value('smtp_host',$support_data->smtp_host), 'class="form-control " id="" placeholder=""')?>
    	    <span class="error-span"><?php echo form_error('smtp_host'); ?></span>
        </div>
    </div>

	<div class="form-group" >
        <label class="col-lg-2 control-label"><?=show_static_text($lang_id,1000);?>SMTP Port</label>
        <div class="col-lg-10">
			<?=form_input('smtp_port', set_value('smtp_port',$support_data->smtp_port), 'class="form-control " id="" placeholder=""')?>
    	    <span class="error-span"><?php echo form_error('smtp_port'); ?></span>
        </div>
    </div>

    <div class="form-group" >
        <label class="col-lg-2 control-label"><?=show_static_text($lang_id,18);?></label>
        <div class="col-lg-10">
			<?=form_input('email', set_value('email',$support_data->email), 'class="form-control " id="" placeholder=""')?>
    	    <span class="error-span"><?php echo form_error('email'); ?></span>
        </div>
    </div>    

    <div class="form-group" >
        <label class="col-lg-2 control-label"><?=show_static_text($lang_id,1000);?>Password</label>
        <div class="col-lg-10">
			<?=form_input('password', set_value('password',$support_data->password), 'class="form-control " id="" placeholder=""')?>
    	    <span class="error-span"><?php echo form_error('password'); ?></span>
        </div>
    </div>    
    
    <div class="form-group" >
	<label class="col-lg-2 control-label">Default</label>
	<div class="col-lg-10">
	    <input type="checkbox" name="is_used" class="" value="1" <?=$support_data->is_used==1?'checked="checked"':''?> >
	</div>
</div>


<div class="form-group" >
	<div class="col-lg-12">
        <span class="label label-sm label-warning" style="display:block;white-space:normal;font-size:14px;line-height:20px;text-align:justify">
<?php
$condition = $this->comman_model->get_lang('content',$lang_id,NULL,array('id'=>4),'content_id',true);
if($condition){
	echo $condition->body;
}
?>        


</span>
	</div>
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
