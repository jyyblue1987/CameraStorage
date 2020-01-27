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
                 <input type="hidden" name="operation" value="set"  />
                     <div class="form-body">                                          
                    <div class="col-md-12">

							<div class="form-group">
                          <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],167);?></label>
                          <div class="col-lg-10">

							<select class="form-control" name="category_id" id="select_category" required>
                            	<option value="" >Select</option>
<?php
if(isset($categories_data)&&!empty($categories_data)){
	foreach($categories_data as $setCategory){
?>
		<option value="<?=$setCategory->id;?>"  <?=($setCategory->id==$product->category_id)?'selected="selected"':'';?> ><?=$setCategory->title;?></option>
<?php
	}
}
?>
            
							</select>
                          </div>
                        </div>                                                                    
							
                    <div class="form-group">
              <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],2630);?>image</label>
              <div class="col-lg-10">
                <div class="fileinput fileinput-new" data-provides="fileinput">
                    <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
                        <?php echo !isset($product->image) ? '<img src="assets/uploads/no-image.gif">' :'<img src="'.base_url('assets/uploads/products/thumbnails').'/'.$product->image.'" >'; ?>
                    </div>
                    <div>
                    <span class="btn btn-default btn-file"><span class="fileinput-new"><?=show_static_text($adminLangSession['lang_id'],159);?></span><span class="fileinput-exists"><?=show_static_text($adminLangSession['lang_id'],160);?></span>
                    <input type="file" name="logo" id="logo"></span>
                    <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput"><?=show_static_text($adminLangSession['lang_id'],109);?></a>
                </div>
                </div>
                    <!--<input type="file" name="logo" id="logo" />-->
              </div>
            </div>
	
					    <div class="form-group" >
                  			<label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],2607);?>Name</label>
                            <div class="col-lg-10">
                               <?=form_input('name', set_value('name', $product->{'name'}), 'class="form-control " id="" placeholder=""')?>
                            </div>
                        </div>
                          
                
				
						<div class="form-group">
                        <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],2706);?>Description</label>
                        <div class="col-lg-10">
                        <?=form_textarea('desc', set_value('desc', $product->{'desc'}), 'placeholder="Body" rows="3" class="cleditor2 form-control"')?>
                        </div>
                        </div>
                

                			</div>



						</div>
	                 <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-2 col-md-9">
                                    <?=form_submit('submit', show_static_text($adminLangSession['lang_id'],235), 'class="btn btn-primary"')?>
                                    <a href="<?=$_cancel;?>" class="btn btn-default" type="button"><?=show_static_text($adminLangSession['lang_id'],22);?></a>
                                </div>
                            </div>
                        </div>
                 <?=form_close()?>
            </div>
        </div>
        <!-- end panel -->
    </div>

	<!--col-md-12-->
    <!--end col-md-12-->
</div>
<link href="assets/plugins/jasny-bootstrap/css/jasny-bootstrap.min.css" rel="stylesheet" type="text/css"/>
<script src="assets/plugins/jasny-bootstrap/js/jasny-bootstrap.min.js" type="text/javascript" language="javascript"></script> 
<script src="assets/plugins/ckeditor/ckeditor.js" type="text/javascript" language="javascript"></script> 
<script src="assets/plugins/ckeditor/adapters/jquery.js" type="text/javascript" language="javascript"></script> 
<script>
/* CL Editor */
$(document).ready(function(){
    $('.cleditor2').ckeditor({
	    filebrowserUploadUrl : '<?=site_url("ajax/upload_editor_image")?>'	
	});
});

</script>
