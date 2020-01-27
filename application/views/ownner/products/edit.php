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
<div class="form-group">
  <label class="col-lg-2 control-label"><?=show_static_text($lang_id,167);?></label>
  <div class="col-lg-10">

    <select class="form-control" name="category_id" id="select_category" onChange=""  required>
        <option value="" >Select</option>
<?php
if(isset($categories_data)&&!empty($categories_data)){
foreach($categories_data as $setCategory){
?>
<option value="<?=$setCategory->id;?>"  <?=($setCategory->id==$products->category_id)?'selected="selected"':'';?> ><?=$setCategory->name;?></option>
<?php
}
}
?>

    </select>
  </div>
</div>

<div class="form-group">
  <label class="col-lg-2 control-label"><?=show_static_text($lang_id,196);?></label>
  <div class="col-lg-10">

    <select class="form-control" name="supplier" id="select_category" onChange=""  required>
        <option value="" >Select</option>
<?php
if(isset($supplier_data)&&!empty($supplier_data)){
foreach($supplier_data as $setCategory){
?>
<option value="<?=$setCategory->id;?>"  <?=($setCategory->id==$products->supplier)?'selected="selected"':'';?> ><?=$setCategory->name;?></option>
<?php
}
}
?>

    </select>
  </div>
</div>
                        
        <div class="form-group" >
          <label class="col-lg-2 control-label"><?=show_static_text($lang_id,41);?></label>
          <div class="col-lg-10">
            <?=form_input('price', set_value('price', $products->{'price'}), 'class="form-control " id="" placeholder=""')?>
          </div>
        </div>
    
        <div class="form-group" >
          <label class="col-lg-2 control-label"><?=show_static_text($lang_id,274);?></label>
          <div class="col-lg-10">
            <?=form_input('code', set_value('code', $products->{'code'}), 'class="form-control " id="" placeholder=""')?>
          </div>
        </div>

        <div class="form-group" >
          <label class="col-lg-2 control-label"><?=show_static_text($lang_id,4100);?>Reorder Point</label>
          <div class="col-lg-10">
            <?=form_input('reorder_point', set_value('reorder_point', $products->{'reorder_point'}), 'class="form-control " id="" placeholder=""')?>
          </div>
        </div>
    
        <div class="form-group" >
          <label class="col-lg-2 control-label"><?=show_static_text($lang_id,4100);?>Minimum Order</label>
          <div class="col-lg-10">
            <?=form_input('minimum_order', set_value('minimum_order', $products->{'minimum_order'}), 'class="form-control " id="" placeholder=""')?>
          </div>
        </div>

                      <div class="form-group ">
      <label class="col-lg-2 control-label"><?=show_static_text($lang_id,263);?></label>
      <div class="col-lg-5">
        <div class="fileinput fileinput-new" data-provides="fileinput">
            <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
                <?php echo !isset($products->image) ? '<img src="assets/uploads/no-image.gif">' :'<img src="'.base_url('assets/uploads/products/thumbnails').'/'.$products->image.'" >'; ?>
            </div>
            <div>
            <span class="btn btn-default btn-file"><span class="fileinput-new"><?=show_static_text($lang_id,159);?></span><span class="fileinput-exists"><?=show_static_text($lang_id,160);?></span>
            <input type="file" name="logo" id="logo"></span>
            <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput"><?=show_static_text($lang_id,109);?></a>
        </div>
        </div>
            <!--<input type="file" name="logo" id="logo" />-->
      </div>
                  
    </div>
                    

				<!--<div class="form-group" >
                  <label class="col-lg-2 control-label"><?=show_static_text($lang_id,271);?></label>
                  <div class="col-lg-10">
                    <?=form_input('discount_price', set_value('discount_price', $products->{'discount_price'}), 'class="form-control " id="" placeholder=""')?>
                  </div>
                </div>-->
                                                                                    
			</div>
            
               <div style="clear:both"></div>

                   <h5><?=show_static_text($lang_id,268);?></h5>
                   <div style="margin-bottom: 0px;" class="tabbable">
                      <ul class="nav nav-tabs">
                        <?php $i=0;
                      //   debugger($this->page_m->languages_icon);
                      //  foreach($this->page_m->languages as $key_lang=>$val_lang):
                        foreach($this->product_model->languages_icon as $key_lang=>$val_lang):

                          $i++;?>
                        <li class="<?=$i==1?'active':''?>">
                          <a data-toggle="tab" href="#<?=$key_lang?>"><img src="<?php echo base_url('assets/uploads/language').'/'.$val_lang; ?>" height="15" width="20" ></a></li>
                        <?php endforeach;?>
                      </ul>
                      <div style="padding-top: 9px; border-bottom: 1px solid #ddd;" class="tab-content">
                        <?php $i=0;foreach($this->product_model->languages as $key_lang=>$val_lang):$i++;?>
                        <div id="<?=$key_lang?>" class="tab-pane <?=$i==1?'active':''?>">
                            <div class="form-group">
                              <label class="col-lg-2 control-label"><?=show_static_text($lang_id,16);?></label>
                              <div class="col-lg-10">
                                <?=form_input('title_'.$key_lang, set_value('title_'.$key_lang, $products->{'title_'.$key_lang}), 'class="form-control copy_to_next" id="inputTitle'.$key_lang.'" placeholder="Name"')?>
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-lg-2 control-label"><?=show_static_text($lang_id,276);?></label>
                              <div class="col-lg-10">
                                <?=form_textarea('body_'.$key_lang, html_entity_decode(set_value('body_'.$key_lang, $products->{'body_'.$key_lang})), 'placeholder="Body" rows="3" class="cleditor2 form-control"')?>
                              </div>
                            </div>                            

                        </div>
                        <?php endforeach;?>
                      </div>
                    </div>

						</div>
	                 <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-2 col-md-9">
                                    <?=form_submit('submit', show_static_text($lang_id,235), 'class="btn btn-primary"')?>
                                    <a href="<?=$_cancel;?>" class="btn btn-default" type="button"><?=show_static_text($lang_id,22);?></a>
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
