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
                        <div class="form-body">	                        	
						<div class="form-group">
                                  <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],2036);?>Name</label>
                                  <div class="col-lg-10">
                                    <?=form_input('name', set_value('name', $categories->{'name'}), 'class="form-control copy_to_next" id="inputTitle'.'" placeholder=""')?>
                                  </div>
                                </div>

	                        <div class="form-group">
                                  <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],2036);?>Country</label>
                                  <div class="col-lg-10">
                        <select class="form-control" name="country" id="" style="" required>
<option value="">Select</option>
<?php

if($country_data){
	foreach($country_data as $setCate){
		if($setCate==$categories->country){
?>
	<option value="<?=$setCate; ?>" selected="selected" ><?=$setCate; ?></option>
<?php
		}
		else{
?>
	<option value="<?=$setCate; ?>" ><?=$setCate; ?></option>
<?php
		}
	}
}
?>
</select>                    

                                  </div>
                                </div>
						</div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-2 col-md-9">
                                    <?=form_submit('submit',show_static_text($adminLangSession['lang_id'],235), 'class="btn btn-primary"')?>
                                    <a href="<?=$_cancel;?>" class="btn btn-default" type="button"><?=show_static_text($adminLangSession['lang_id'],22);?></a>
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


<link href="assets/plugins/jasny-bootstrap/css/jasny-bootstrap.min.css" rel="stylesheet" type="text/css"/>
<script src="assets/plugins/jasny-bootstrap/js/jasny-bootstrap.min.js" type="text/javascript" language="javascript"></script> 

<script src="assets/plugins/ckeditor/ckeditor.js" type="text/javascript" language="javascript"></script> 
<script src="assets/plugins/ckeditor/adapters/jquery.js" type="text/javascript" language="javascript"></script>
<script>
/* CL Editor */
$(document).ready(function(){
    $('.cleditor2').ckeditor();
});
</script>
