<div class="row">
    <div class="col-md-12">
        <!-- begin panel -->
        <div data-sortable-id="form-stuff-1" class="panel panel-inverse">
            <div class="panel-heading">                
                <h4 class="panel-title"><?=$name?></h4>
            </div>
            <div class="panel-body">
            <!-- BEGIN FORM-->
            <?php echo validation_errors();?>
                    <?=form_open(NULL, array('class' => 'form-horizontal', 'role'=>'form','enctype'=>"multipart/form-data"))?>                                                             
                        <div class="form-body">

<div class="form-group">
  <label class="col-lg-2 control-label">Plan</label>
  <div class="col-lg-10">

    <select class="form-control" name="plan_id" id="select_category" onChange=""  required>
        <option value="" >Select</option>
<?php
if(isset($categories_data)&&!empty($categories_data)){
foreach($categories_data as $setCategory){
?>
<option value="<?=$setCategory->id;?>"  <?=($setCategory->id==$categories->plan_id)?'selected="selected"':'';?> ><?=$setCategory->name;?></option>
<?php
}
}
?>

    </select>
  </div>
</div>	                                                   	
	                    <div class="form-group" >
                  			<label class="col-lg-2 control-label">Title</label>
                            <div class="col-lg-10">
                               <?=form_input('name', set_value('name', $categories->name), 'class="form-control " id="" placeholder=""')?>
                            </div>
                        </div>

                        <div class="form-group" >
                  			<label class="col-lg-2 control-label">User Price</label>
                            <div class="col-lg-10">
                               <?=form_input('price', set_value('price', $categories->price), 'class="form-control " id="" placeholder="price"')?>
                            </div>
                        </div>

                        <div class="form-group" >
                  			<label class="col-lg-2 control-label">Dealer Price</label>
                            <div class="col-lg-10">
                               <?=form_input('price2', set_value('price2', $categories->price2), 'class="form-control " id="" placeholder="price"')?>
                            </div>
                        </div>

						<div class="form-group" >
                  			<label class="col-lg-2 control-label">Month</label>
                            <div class="col-lg-10">
<!--                               <?=form_input('month', set_value('month', $categories->month), 'class="form-control " id="" placeholder=""')?>-->
                        <?php echo form_dropdown('month', $month, $this->input->post('month') ? $this->input->post('month') : $categories->month, 'class="form-control"'); ?>
                            </div>
                        </div>                        

            <div class="form-group">
              <label class="col-lg-2 control-label">Description</label>
              <div class="col-lg-10">
                <?=form_textarea('desc', set_value('desc', $categories->desc), 'placeholder="" rows="3" class="cleditor2 form-control"')?>
              </div>
            </div>
                        
                           
						</div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-2 col-md-9">
                                    <?=form_submit('submit', lang('Save'), 'class="btn btn-primary"')?>
                                    <a href="<?=$_cancel?>" class="btn btn-default" type="button"><?=lang('Cancel')?></a>
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


<!--<script src="assets/plugins/ckeditor/ckeditor.js" type="text/javascript" language="javascript"></script> 
<script src="assets/plugins/ckeditor/adapters/jquery.js" type="text/javascript" language="javascript"></script> 
<script>
/* CL Editor */
$(document).ready(function(){
    $('.cleditor2').ckeditor({});
});
</script>
-->