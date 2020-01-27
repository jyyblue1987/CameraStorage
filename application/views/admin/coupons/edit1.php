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

                 	<div class="col-md-12">                        
                        <div class="form-group" >
                            <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],39);?></label>
                            <div class="col-lg-10">
                                <?=form_input('code', set_value('code', $products->{'code'}), 'class="form-control " id="" placeholder="Code"')?>
                            </div>
                        </div>
				                
                        <div class="form-group" >
                            <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],287);?></label>
                            <div class="col-lg-10">
                                <?=form_input('reduction_amount', set_value('reduction_amount', $products->{'reduction_amount'}), 'class="form-control " id="" placeholder="Reduction Amount"')?>
                            </div>
                        </div>

	            <div class="form-group" >
                        <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],232);?></label>
                        <div class="col-lg-10">
                           <?=form_input('end_date', set_value('end_date', $products->{'end_date'}), 'placeholder="Expire date" data-date-format="yyyy-mm-dd" class="form-control date-picker" data-date-start-date="+0d" readonly="" id="set_date"')?>
                        </div>
                 </div>                      

			</div>
            
               <div style="clear:both"></div>
						</div>
	                 <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-2 col-md-9">
                                    <?=form_submit('submit',show_static_text($adminLangSession['lang_id'],235), 'class="btn btn-primary"')?>
                                    <a href="<?=$_cancel?>" class="btn btn-default" type="button"><?=show_static_text($adminLangSession['lang_id'],22);?></a>
                                </div>
                            </div>
                        </div>
                 <?=form_close()?>                                  
            </div>
        </div>
        <!-- end panel -->
    </div>
    <!--end col-md-12-->
</div>
<link href="assets/global/plugins/bootstrap-datepicker/css/datepicker.css" type="text/css">
<script type="text/javascript" src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script>
jQuery(document).ready(function() {       
	$('.date-picker').datepicker({
		orientation: "left",
		autoclose: true
	});
});   
</script>
