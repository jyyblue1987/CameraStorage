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
                      <div id="more_pic" style="display:none"></div>
                    <div class="col-md-12">						                                                
                        
                      
                
				<div class="form-group" >
                  <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],1600);?>Title</label>
                  <div class="col-lg-10">
                    <?=form_input('name', set_value('name', $products->{'name'}), 'class="form-control " id="" placeholder=""')?>
                  </div>
                </div>
                
				<div class="form-group" >
                  <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],2071);?>Response Time</label>
                  <div class="col-lg-10">
                    <?=form_input('solve_time', set_value('solve_time', $products->{'solve_time'}), 'class="form-control " id="" placeholder=""')?>
                  </div>
                </div>

<div class="form-group">
<label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],2076);?>Guide</label>
<div class="col-lg-10">
<?=form_textarea('desc',set_value('desc', $products->{'desc'}), 'placeholder="" rows="3" class="cleditor2 form-control"')?>
</div>
</div>

<div class="form-group">
	<label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],2076);?>Content Guide</label>
	<div class="col-lg-10">
<?=form_textarea('desc2', set_value('desc2', $products->{'desc2'}), 'placeholder="" rows="3" class="cleditor2 form-control"')?>
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

<!--<link href="assets/plugins/jasny-bootstrap/css/jasny-bootstrap.min.css" rel="stylesheet" type="text/css"/>
<script src="assets/plugins/jasny-bootstrap/js/jasny-bootstrap.min.js" type="text/javascript" language="javascript"></script> -->

<!--<script src="assets/plugins/ckeditor/ckeditor.js" type="text/javascript" language="javascript"></script> 
<script src="assets/plugins/ckeditor/adapters/jquery.js" type="text/javascript" language="javascript"></script>
<script>
$(document).ready(function(){
    $('.cleditor2').ckeditor();
});
</script>
-->