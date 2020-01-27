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
              	<input type="hidden" name="operation" value="set" />                      
					<div class="form-body">

                    <div class="col-md-12">						                        
				<div class="form-group" >
                  <label class="col-lg-2 control-label">Question</label>
                  <div class="col-lg-10">
					<?=form_textarea('description', set_value('description', $products->description), 'placeholder="Question" rows="3" class="cleditor2 form-control"')?>
                  </div>
                </div>

				<!--<div class="form-group" >
                  <label class="col-lg-2 control-label">Type</label>
                  <div class="col-lg-10">
					<?php echo form_dropdown('type', array('objective'=>'Objective','subjective'=>'Subjective'), $this->input->post('type') ? $this->input->post('type') : $products->type,'class="form-control" onChange="user_type(this.value);"  '); ?>
                  </div>
                </div>-->

				<div class="" id="show_address" style=" <?=$products->type=='objective'?'display:block':'display:none'?>">
                    <div class="form-group" >
                        <label class="col-lg-2 control-label">Option A</label>
                        <div class="col-lg-10">
                            <?=form_input('option_a', set_value('option_a', $products->{'option_a'}), 'class="form-control " id="" placeholder=""')?>
                        </div>
                    </div>
    
                    <div class="form-group" >
                        <label class="col-lg-2 control-label">Option B</label>
                        <div class="col-lg-10">
                            <?=form_input('option_b', set_value('option_b', $products->{'option_b'}), 'class="form-control " id="" placeholder=""')?>
                        </div>
                    </div>
    
                    <div class="form-group" >
                        <label class="col-lg-2 control-label">Option C</label>
                        <div class="col-lg-10">
                            <?=form_input('option_c', set_value('option_c', $products->{'option_c'}), 'class="form-control " id="" placeholder=""')?>
                        </div>
                    </div>
                    <div class="form-group" >
                        <label class="col-lg-2 control-label">Option D</label>
                        <div class="col-lg-10">
                            <?=form_input('option_d', set_value('option_d', $products->{'option_d'}), 'class="form-control " id="" placeholder=""')?>
                        </div>
                    </div>
                    
                    <div class="form-group" >
                	<label class="col-lg-2 control-label">Answer</label>
                	<div class="col-lg-10">
						<?php echo form_dropdown('answer', array('a'=>'A','b' => 'B', 'c'=>'C','d'=>'D'), $this->input->post('answer') ? $this->input->post('answer') : $products->answer,'class="form-control" '); ?>
                	</div>
                </div>
                </div>
                


				
			</div>
            
               <div style="clear:both"></div>


						</div>	                
                
				<div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-2 col-md-9">
                        <button class="btn btn-primary" type="submit">Save</button>
                        </div>
                    </div>
                </div>
		<?=form_close()?>
            <!-- END FORM-->
            </div>
        </div>
        <!-- end panel -->
    </div>
</div>



<!--<script src="assets/plugins/ckeditor/ckeditor.js" type="text/javascript" language="javascript"></script> 
<script src="assets/plugins/ckeditor/adapters/jquery.js" type="text/javascript" language="javascript"></script>
<script>
/* CL Editor */
$(document).ready(function(){
    $('.cleditor2').ckeditor();
});
</script>
-->
<script>
function user_type(value) {
	if(value=='objective'){
		$('#show_address').show();
	}
	else{
		$('#show_address').hide();
	}
}
</script>
