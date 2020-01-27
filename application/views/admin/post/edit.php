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
							
                            <div class="form-group" >
                  			<label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],267);?></label>
                            <div class="col-lg-10">
                               <?=form_input('slug', set_value('slug', $product->{'slug'}), 'class="form-control " id="" placeholder="Slug"')?>
                            </div>
                        </div>                        
                    <div class="form-group">
              <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],2630);?>Main image</label>
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
                    <div class="form-group">
                      <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],2630);?>Post image</label>
                      <div class="col-lg-10">
				      	<div class="fileinput fileinput-new" data-provides="fileinput">
							<div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
                                <?php echo !isset($product->image_1) ? '<img src="assets/uploads/no-image.gif">' :'<img src="'.base_url('assets/uploads/products').'/'.$product->image_1.'" >'; ?>
                            </div>
							<div>
						    <span class="btn btn-default btn-file"><span class="fileinput-new"><?=show_static_text($adminLangSession['lang_id'],159);?></span><span class="fileinput-exists"><?=show_static_text($adminLangSession['lang_id'],160);?></span>
    	    	            <input type="file" name="image1" id="logo"></span>
						    <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput"><?=show_static_text($adminLangSession['lang_id'],109);?></a>
                     	</div>
                        Image Size: 540 X 225
                   		</div>
                            <!--<input type="file" name="logo" id="logo" />-->
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],2603);?>Share image 1</label>
                      <div class="col-lg-4">
				      	<div class="fileinput fileinput-new" data-provides="fileinput">
							<div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
                                <?php echo !isset($product->share_image_1) ? '<img src="assets/uploads/no-image.gif">' :'<img src="'.base_url('assets/uploads/products/').'/'.$product->share_image_1.'" >'; ?>
                            </div>
							<div>
						    <span class="btn btn-default btn-file"><span class="fileinput-new"><?=show_static_text($adminLangSession['lang_id'],159);?></span><span class="fileinput-exists"><?=show_static_text($adminLangSession['lang_id'],160);?></span>
    	    	            <input type="file" name="share_image1" id="logo"></span>
						    <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput"><?=show_static_text($adminLangSession['lang_id'],109);?></a>
                     	</div>
                        Image Size: 540 X 225
                   		</div>
                            <!--<input type="file" name="logo" id="logo" />-->
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group" >
                  			<label class="col-lg-3 control-label"><?=show_static_text($adminLangSession['lang_id'],2670);?>Image Position X </label>
                            <div class="col-lg-9">
                               <?=form_input('image_pos_x_1', set_value('image_pos_x_1', $product->{'image_pos_x_1'}), 'class="form-control " id="i_x_1" placeholder="Slug"')?>
                            </div>
                        </div>
    
                        <div class="form-group" >
                  			<label class="col-lg-3 control-label"><?=show_static_text($adminLangSession['lang_id'],2670);?>Image Position Y</label>
                            <div class="col-lg-9">
                               <?=form_input('image_pos_y_1', set_value('image_pos_y_1', $product->{'image_pos_y_1'}), 'class="form-control " id="i_y_1" placeholder="Slug"')?>
                            </div>
                        </div>
    
                        <div class="form-group" >
                  			<label class="col-lg-3 control-label"><?=show_static_text($adminLangSession['lang_id'],2607);?> Text Position X</label>
                            <div class="col-lg-9">
                               <?=form_input('text_x_1', set_value('text_x_', $product->{'text_x_1'}), 'class="form-control " id="t_x_1" placeholder="Slug"')?>
                            </div>
                        </div>
                        <div class="form-group" >
                  			<label class="col-lg-3 control-label"><?=show_static_text($adminLangSession['lang_id'],2607);?>Text Position Y</label>
                            <div class="col-lg-9">
                               <?=form_input('text_y_1', set_value('text_y_1', $product->{'text_y_1'}), 'class="form-control " id="t_y_1" placeholder="Slug"')?>
<?php  
if(!isset($product->share_image_1)){
}
else{
?>
	<a href="javascript:void(0);" onclick="show_preview(1);" >Preview</a>
<?php
}
?>
                            </div>
                        </div>
                      </div>
                    </div><!--//share image1//-->
                    <div class="form-group">
                      <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],2603);?>Share image 2</label>
                      <div class="col-lg-4">
				      	<div class="fileinput fileinput-new" data-provides="fileinput">
							<div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
                                <?php echo !isset($product->share_image_2) ? '<img src="assets/uploads/no-image.gif">' :'<img src="'.base_url('assets/uploads/products/').'/'.$product->share_image_2.'" >'; ?>
                            </div>
							<div>
						    <span class="btn btn-default btn-file"><span class="fileinput-new"><?=show_static_text($adminLangSession['lang_id'],159);?></span><span class="fileinput-exists"><?=show_static_text($adminLangSession['lang_id'],160);?></span>
    	    	            <input type="file" name="share_image2" id="logo"></span>
						    <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput"><?=show_static_text($adminLangSession['lang_id'],109);?></a>
                     	</div>
                        Image Size: 540 X 225
                   		</div>
                            <!--<input type="file" name="logo" id="logo" />-->
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group" >
                  			<label class="col-lg-3 control-label"><?=show_static_text($adminLangSession['lang_id'],2670);?>Image Position X </label>
                            <div class="col-lg-9">
                               <?=form_input('image_pos_x_2', set_value('image_pos_x_2', $product->{'image_pos_x_2'}), 'class="form-control " id="i_x_2" placeholder="Slug"')?>
                            </div>
                        </div>
    
                        <div class="form-group" >
                  			<label class="col-lg-3 control-label"><?=show_static_text($adminLangSession['lang_id'],2670);?>Image Position Y</label>
                            <div class="col-lg-9">
                               <?=form_input('image_pos_y_2', set_value('image_pos_y_2', $product->{'image_pos_y_2'}), 'class="form-control " id="i_y_2" placeholder="Slug"')?>
                            </div>
                        </div>
    
                        <div class="form-group" >
                  			<label class="col-lg-3 control-label"><?=show_static_text($adminLangSession['lang_id'],2607);?> Text Position X</label>
                            <div class="col-lg-9">
                               <?=form_input('text_x_2', set_value('text_x_2', $product->{'text_x_2'}), 'class="form-control " id="t_x_2" placeholder="Slug"')?>
                            </div>
                        </div>
                        <div class="form-group" >
                  			<label class="col-lg-3 control-label"><?=show_static_text($adminLangSession['lang_id'],2607);?>Text Position Y</label>
                            <div class="col-lg-9">
                               <?=form_input('text_y_2', set_value('text_y_2', $product->{'text_y_2'}), 'class="form-control " id="t_y_2" placeholder="Slug"')?>
<?php  
if(!isset($product->share_image_2)){
}
else{
?>
	<a href="javascript:void(0);" onclick="show_preview(2);" >Preview</a>
<?php
}
?>

                            </div>
                        </div>
                      </div>
                    </div><!--//share image2//-->
                    <div class="form-group">
                      <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],2603);?>Share image 3</label>
                      <div class="col-lg-4">
				      	<div class="fileinput fileinput-new" data-provides="fileinput">
							<div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
                                <?php echo !isset($product->share_image_3) ? '<img src="assets/uploads/no-image.gif">' :'<img src="'.base_url('assets/uploads/products/').'/'.$product->share_image_3.'" >'; ?>
                            </div>
							<div>
						    <span class="btn btn-default btn-file"><span class="fileinput-new"><?=show_static_text($adminLangSession['lang_id'],159);?></span><span class="fileinput-exists"><?=show_static_text($adminLangSession['lang_id'],160);?></span>
    	    	            <input type="file" name="share_image3" id="logo"></span>
						    <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput"><?=show_static_text($adminLangSession['lang_id'],109);?></a>
                     	</div>
                        Image Size: 540 X 225
                   		</div>
                            <!--<input type="file" name="logo" id="logo" />-->
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group" >
                  			<label class="col-lg-3 control-label"><?=show_static_text($adminLangSession['lang_id'],2670);?>Image Position X </label>
                            <div class="col-lg-9">
                               <?=form_input('image_pos_x_3', set_value('image_pos_x_3', $product->{'image_pos_x_3'}), 'class="form-control " id="i_x_3" placeholder="Slug"')?>
                            </div>
                        </div>
    
                        <div class="form-group" >
                  			<label class="col-lg-3 control-label"><?=show_static_text($adminLangSession['lang_id'],2670);?>Image Position Y</label>
                            <div class="col-lg-9">
                               <?=form_input('image_pos_y_3', set_value('image_pos_y_3', $product->{'image_pos_y_3'}), 'class="form-control " id="i_y_3" placeholder="Slug"')?>
                            </div>
                        </div>
    
                        <div class="form-group" >
                  			<label class="col-lg-3 control-label"><?=show_static_text($adminLangSession['lang_id'],2607);?> Text Position X</label>
                            <div class="col-lg-9">
                               <?=form_input('text_x_3', set_value('text_x_3', $product->{'text_x_3'}), 'class="form-control " id="t_x_3" placeholder="Slug"')?>
                            </div>
                        </div>
                        <div class="form-group" >
                  			<label class="col-lg-3 control-label"><?=show_static_text($adminLangSession['lang_id'],2607);?>Text Position Y</label>
                            <div class="col-lg-9">
                               <?=form_input('text_y_3', set_value('text_y_3', $product->{'text_y_3'}), 'class="form-control " id="t_y_3" placeholder="Slug"')?>
<?php  
if(!isset($product->share_image_3)){
}
else{
?>
	<a href="javascript:void(0);" onclick="show_preview(3);" >Preview</a>
<?php
}
?>
                            </div>
                        </div>
                      </div>
                    </div><!--//share image3//-->
                    <div class="form-group">
                      <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],2603);?>Share image 4</label>
                      <div class="col-lg-4">
				      	<div class="fileinput fileinput-new" data-provides="fileinput">
							<div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
                                <?php echo !isset($product->share_image_4) ? '<img src="assets/uploads/no-image.gif">' :'<img src="'.base_url('assets/uploads/products/').'/'.$product->share_image_4.'" >'; ?>
                            </div>
							<div>
						    <span class="btn btn-default btn-file"><span class="fileinput-new"><?=show_static_text($adminLangSession['lang_id'],159);?></span><span class="fileinput-exists"><?=show_static_text($adminLangSession['lang_id'],160);?></span>
    	    	            <input type="file" name="share_image4" id="logo"></span>
						    <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput"><?=show_static_text($adminLangSession['lang_id'],109);?></a>
                     	</div>
                        Image Size: 540 X 225
                   		</div>
                            <!--<input type="file" name="logo" id="logo" />-->
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group" >
                  			<label class="col-lg-3 control-label"><?=show_static_text($adminLangSession['lang_id'],2670);?>Image Position X </label>
                            <div class="col-lg-9">
                               <?=form_input('image_pos_x_4', set_value('image_pos_x_4', $product->{'image_pos_x_4'}), 'class="form-control " id="i_x_4" placeholder="Slug"')?>
                            </div>
                        </div>
    
                        <div class="form-group" >
                  			<label class="col-lg-3 control-label"><?=show_static_text($adminLangSession['lang_id'],2670);?>Image Position Y</label>
                            <div class="col-lg-9">
                               <?=form_input('image_pos_y_4', set_value('image_pos_y_4', $product->{'image_pos_y_4'}), 'class="form-control " id="i_y_4" placeholder="Slug"')?>
                            </div>
                        </div>
    
                        <div class="form-group" >
                  			<label class="col-lg-3 control-label"><?=show_static_text($adminLangSession['lang_id'],2607);?> Text Position X</label>
                            <div class="col-lg-9">
                               <?=form_input('text_x_4', set_value('text_x_4', $product->{'text_x_4'}), 'class="form-control " id="t_x_4" placeholder="Slug"')?>
                            </div>
                        </div>
                        <div class="form-group" >
                  			<label class="col-lg-3 control-label"><?=show_static_text($adminLangSession['lang_id'],2607);?>Text Position Y</label>
                            <div class="col-lg-9">
                               <?=form_input('text_y_4', set_value('text_y_4', $product->{'text_y_4'}), 'class="form-control " id="t_y_4" placeholder="Slug"')?>
<?php  
if(!isset($product->share_image_4)){
}
else{
?>
	<a href="javascript:void(0);" onclick="show_preview(4);" >Preview</a>
<?php
}
?>
                            </div>
                        </div>
                      </div>
                    </div><!--//share image4//-->
                    <div class="form-group">
                      <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],2603);?>Share image 5</label>
                      <div class="col-lg-4">
				      	<div class="fileinput fileinput-new" data-provides="fileinput">
							<div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
                                <?php echo !isset($product->share_image_5) ? '<img src="assets/uploads/no-image.gif">' :'<img src="'.base_url('assets/uploads/products/').'/'.$product->share_image_5.'" >'; ?>
                            </div>
							<div>
						    <span class="btn btn-default btn-file"><span class="fileinput-new"><?=show_static_text($adminLangSession['lang_id'],159);?></span><span class="fileinput-exists"><?=show_static_text($adminLangSession['lang_id'],160);?></span>
    	    	            <input type="file" name="share_image5" id="logo"></span>
						    <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput"><?=show_static_text($adminLangSession['lang_id'],109);?></a>
                     	</div>
                        Image Size: 540 X 225
                   		</div>
                            <!--<input type="file" name="logo" id="logo" />-->
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group" >
                  			<label class="col-lg-3 control-label"><?=show_static_text($adminLangSession['lang_id'],2670);?>Image Position X </label>
                            <div class="col-lg-9">
                               <?=form_input('image_pos_x_5', set_value('image_pos_x_5', $product->{'image_pos_x_5'}), 'class="form-control " id="i_x_5" placeholder="Slug"')?>
                            </div>
                        </div>
    
                        <div class="form-group" >
                  			<label class="col-lg-3 control-label"><?=show_static_text($adminLangSession['lang_id'],2670);?>Image Position Y</label>
                            <div class="col-lg-9">
                               <?=form_input('image_pos_y_5', set_value('image_pos_y_5', $product->{'image_pos_y_5'}), 'class="form-control " id="i_y_5" placeholder="Slug"')?>
                            </div>
                        </div>
    
                        <div class="form-group" >
                  			<label class="col-lg-3 control-label"><?=show_static_text($adminLangSession['lang_id'],2607);?> Text Position X</label>
                            <div class="col-lg-9">
                               <?=form_input('text_x_5', set_value('text_x_5', $product->{'text_x_5'}), 'class="form-control " id="t_x_5" placeholder="Slug"')?>
                            </div>
                        </div>
                        <div class="form-group" >
                  			<label class="col-lg-3 control-label"><?=show_static_text($adminLangSession['lang_id'],2607);?>Text Position Y</label>
                            <div class="col-lg-9">
                               <?=form_input('text_y_5', set_value('text_y_5', $product->{'text_y_5'}), 'class="form-control " id="t_y_5" placeholder="Slug"')?>
<?php  
if(!isset($product->share_image_5)){
}
else{
?>
	<a href="javascript:void(0);" onclick="show_preview(5);" >Preview</a>
<?php
}
?>
                            </div>
                        </div>
                      </div>
                    </div><!--//share image5//-->
                    <div class="form-group">
                      <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],2603);?>Share image 6</label>
                      <div class="col-lg-4">
				      	<div class="fileinput fileinput-new" data-provides="fileinput">
							<div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
                                <?php echo !isset($product->share_image_6) ? '<img src="assets/uploads/no-image.gif">' :'<img src="'.base_url('assets/uploads/products/').'/'.$product->share_image_6.'" >'; ?>
                            </div>
							<div>
						    <span class="btn btn-default btn-file"><span class="fileinput-new"><?=show_static_text($adminLangSession['lang_id'],159);?></span><span class="fileinput-exists"><?=show_static_text($adminLangSession['lang_id'],160);?></span>
    	    	            <input type="file" name="share_image6" id="logo"></span>
						    <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput"><?=show_static_text($adminLangSession['lang_id'],109);?></a>
                     	</div>
                        Image Size: 540 X 225
                   		</div>
                            <!--<input type="file" name="logo" id="logo" />-->
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group" >
                  			<label class="col-lg-3 control-label"><?=show_static_text($adminLangSession['lang_id'],2670);?>Image Position X </label>
                            <div class="col-lg-9">
                               <?=form_input('image_pos_x_6', set_value('image_pos_x_6', $product->{'image_pos_x_6'}), 'class="form-control " id="i_x_6" placeholder="Slug"')?>
                            </div>
                        </div>
    
                        <div class="form-group" >
                  			<label class="col-lg-3 control-label"><?=show_static_text($adminLangSession['lang_id'],2670);?>Image Position Y</label>
                            <div class="col-lg-9">
                               <?=form_input('image_pos_y_6', set_value('image_pos_y_6', $product->{'image_pos_y_6'}), 'class="form-control " id="i_y_6" placeholder="Slug"')?>
                            </div>
                        </div>
    
                        <div class="form-group" >
                  			<label class="col-lg-3 control-label"><?=show_static_text($adminLangSession['lang_id'],2607);?> Text Position X</label>
                            <div class="col-lg-9">
                               <?=form_input('text_x_6', set_value('text_x_6', $product->{'text_x_6'}), 'class="form-control " id="t_x_6" placeholder="Slug"')?>
                            </div>
                        </div>
                        <div class="form-group" >
                  			<label class="col-lg-3 control-label"><?=show_static_text($adminLangSession['lang_id'],2607);?>Text Position Y</label>
                            <div class="col-lg-9">
                               <?=form_input('text_y_6', set_value('text_y_6', $product->{'text_y_6'}), 'class="form-control " id="t_y_6" placeholder="Slug"')?>
<?php  
if(!isset($product->share_image_6)){
}
else{
?>
	<a href="javascript:void(0);" onclick="show_preview(6);" >Preview</a>
<?php
}
?>
                            </div>
                        </div>
                      </div>
                    </div><!--//share image6//-->
                    <div class="form-group">
                      <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],2603);?>Share image 7</label>
                      <div class="col-lg-4">
				      	<div class="fileinput fileinput-new" data-provides="fileinput">
							<div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
                                <?php echo !isset($product->share_image_7) ? '<img src="assets/uploads/no-image.gif">' :'<img src="'.base_url('assets/uploads/products/').'/'.$product->share_image_7.'" >'; ?>
                            </div>
							<div>
						    <span class="btn btn-default btn-file"><span class="fileinput-new"><?=show_static_text($adminLangSession['lang_id'],159);?></span><span class="fileinput-exists"><?=show_static_text($adminLangSession['lang_id'],160);?></span>
    	    	            <input type="file" name="share_image7" id="logo"></span>
						    <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput"><?=show_static_text($adminLangSession['lang_id'],109);?></a>
                     	</div>
                        Image Size: 540 X 225
                   		</div>
                            <!--<input type="file" name="logo" id="logo" />-->
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group" >
                  			<label class="col-lg-3 control-label"><?=show_static_text($adminLangSession['lang_id'],2670);?>Image Position X </label>
                            <div class="col-lg-9">
                               <?=form_input('image_pos_x_7', set_value('image_pos_x_7', $product->{'image_pos_x_7'}), 'class="form-control " id="i_x_7" placeholder="Slug"')?>
                            </div>
                        </div>
    
                        <div class="form-group" >
                  			<label class="col-lg-3 control-label"><?=show_static_text($adminLangSession['lang_id'],2670);?>Image Position Y</label>
                            <div class="col-lg-9">
                               <?=form_input('image_pos_y_7', set_value('image_pos_y_7', $product->{'image_pos_y_7'}), 'class="form-control " id="i_y_7" placeholder="Slug"')?>
                            </div>
                        </div>
    
                        <div class="form-group" >
                  			<label class="col-lg-3 control-label"><?=show_static_text($adminLangSession['lang_id'],2607);?> Text Position X</label>
                            <div class="col-lg-9">
                               <?=form_input('text_x_7', set_value('text_x_7', $product->{'text_x_7'}), 'class="form-control " id="t_x_7" placeholder="Slug"')?>
                            </div>
                        </div>
                        <div class="form-group" >
                  			<label class="col-lg-3 control-label"><?=show_static_text($adminLangSession['lang_id'],2607);?>Text Position Y</label>
                            <div class="col-lg-9">
                               <?=form_input('text_y_7', set_value('text_y_7', $product->{'text_y_7'}), 'class="form-control " id="t_y_7" placeholder="Slug"')?>
<?php  
if(!isset($product->share_image_7)){
}
else{
?>
	<a href="javascript:void(0);" onclick="show_preview(7);" >Preview</a>
<?php
}
?>
                            </div>
                        </div>
                      </div>
                    </div><!--//share image7//-->
                    <div class="form-group">
                      <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],2603);?>Share image 8</label>
                      <div class="col-lg-4">
				      	<div class="fileinput fileinput-new" data-provides="fileinput">
							<div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
                                <?php echo !isset($product->share_image_8) ? '<img src="assets/uploads/no-image.gif">' :'<img src="'.base_url('assets/uploads/products/').'/'.$product->share_image_8.'" >'; ?>
                            </div>
							<div>
						    <span class="btn btn-default btn-file"><span class="fileinput-new"><?=show_static_text($adminLangSession['lang_id'],159);?></span><span class="fileinput-exists"><?=show_static_text($adminLangSession['lang_id'],160);?></span>
    	    	            <input type="file" name="share_image8" id="logo"></span>
						    <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput"><?=show_static_text($adminLangSession['lang_id'],109);?></a>
                     	</div>
                        Image Size: 540 X 225
                   		</div>
                            <!--<input type="file" name="logo" id="logo" />-->
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group" >
                  			<label class="col-lg-3 control-label"><?=show_static_text($adminLangSession['lang_id'],2670);?>Image Position X </label>
                            <div class="col-lg-9">
                               <?=form_input('image_pos_x_8', set_value('image_pos_x_8', $product->{'image_pos_x_8'}), 'class="form-control " id="i_x_8" placeholder="Slug"')?>
                            </div>
                        </div>
    
                        <div class="form-group" >
                  			<label class="col-lg-3 control-label"><?=show_static_text($adminLangSession['lang_id'],2670);?>Image Position Y</label>
                            <div class="col-lg-9">
                               <?=form_input('image_pos_y_8', set_value('image_pos_y_8', $product->{'image_pos_y_8'}), 'class="form-control " id="i_y_8" placeholder="Slug"')?>
                            </div>
                        </div>
    
                        <div class="form-group" >
                  			<label class="col-lg-3 control-label"><?=show_static_text($adminLangSession['lang_id'],2607);?> Text Position X</label>
                            <div class="col-lg-9">
                               <?=form_input('text_x_8', set_value('text_x_8', $product->{'text_x_8'}), 'class="form-control " id="t_x_8" placeholder="Slug"')?>
                            </div>
                        </div>
                        <div class="form-group" >
                  			<label class="col-lg-3 control-label"><?=show_static_text($adminLangSession['lang_id'],2607);?>Text Position Y</label>
                            <div class="col-lg-9">
                               <?=form_input('text_y_8', set_value('text_y_8', $product->{'text_y_8'}), 'class="form-control " id="t_y_8" placeholder="Slug"')?>
<?php  
if(!isset($product->share_image_8)){
}
else{
?>
	<a href="javascript:void(0);" onclick="show_preview(8);" >Preview</a>
<?php
}
?>
                            </div>
                        </div>
                      </div>
                    </div><!--//share image8//-->
                    <div class="form-group">
                      <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],2603);?>Share image 9</label>
                      <div class="col-lg-4">
				      	<div class="fileinput fileinput-new" data-provides="fileinput">
							<div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
                                <?php echo !isset($product->share_image_9) ? '<img src="assets/uploads/no-image.gif">' :'<img src="'.base_url('assets/uploads/products/').'/'.$product->share_image_9.'" >'; ?>
                            </div>
							<div>
						    <span class="btn btn-default btn-file"><span class="fileinput-new"><?=show_static_text($adminLangSession['lang_id'],159);?></span><span class="fileinput-exists"><?=show_static_text($adminLangSession['lang_id'],160);?></span>
    	    	            <input type="file" name="share_image9" id="logo"></span>
						    <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput"><?=show_static_text($adminLangSession['lang_id'],109);?></a>
                     	</div>
                        Image Size: 540 X 225
                   		</div>
                            <!--<input type="file" name="logo" id="logo" />-->
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group" >
                  			<label class="col-lg-3 control-label"><?=show_static_text($adminLangSession['lang_id'],2670);?>Image Position X </label>
                            <div class="col-lg-9">
                               <?=form_input('image_pos_x_9', set_value('image_pos_x_9', $product->{'image_pos_x_9'}), 'class="form-control " id="i_x_9" placeholder="Slug"')?>
                            </div>
                        </div>
    
                        <div class="form-group" >
                  			<label class="col-lg-3 control-label"><?=show_static_text($adminLangSession['lang_id'],2670);?>Image Position Y</label>
                            <div class="col-lg-9">
                               <?=form_input('image_pos_y_9', set_value('image_pos_y_9', $product->{'image_pos_y_9'}), 'class="form-control " id="i_y_9" placeholder="Slug"')?>
                            </div>
                        </div>
    
                        <div class="form-group" >
                  			<label class="col-lg-3 control-label"><?=show_static_text($adminLangSession['lang_id'],2607);?> Text Position X</label>
                            <div class="col-lg-9">
                               <?=form_input('text_x_9', set_value('text_x_9', $product->{'text_x_9'}), 'class="form-control " id="t_x_9" placeholder="Slug"')?>
                            </div>
                        </div>
                        <div class="form-group" >
                  			<label class="col-lg-3 control-label"><?=show_static_text($adminLangSession['lang_id'],2607);?>Text Position Y</label>
                            <div class="col-lg-9">
                               <?=form_input('text_y_9', set_value('text_y_9', $product->{'text_y_9'}), 'class="form-control " id="t_y_9" placeholder="Slug"')?>
<?php  
if(!isset($product->share_image_9)){
}
else{
?>
	<a href="javascript:void(0);" onclick="show_preview(9);" >Preview</a>
<?php
}
?>
                            </div>
                        </div>
                      </div>
                    </div><!--//share image9//-->
                    <div class="form-group">
                      <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],2603);?>Share image 10</label>
                      <div class="col-lg-4">
				      	<div class="fileinput fileinput-new" data-provides="fileinput">
							<div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
                                <?php echo !isset($product->share_image_10) ? '<img src="assets/uploads/no-image.gif">' :'<img src="'.base_url('assets/uploads/products/').'/'.$product->share_image_10.'" >'; ?>
                            </div>
							<div>
						    <span class="btn btn-default btn-file"><span class="fileinput-new"><?=show_static_text($adminLangSession['lang_id'],159);?></span><span class="fileinput-exists"><?=show_static_text($adminLangSession['lang_id'],160);?></span>
    	    	            <input type="file" name="share_image10" id="logo"></span>
						    <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput"><?=show_static_text($adminLangSession['lang_id'],109);?></a>
                     	</div>
                        Image Size: 540 X 225
                   		</div>
                            <!--<input type="file" name="logo" id="logo" />-->
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group" >
                  			<label class="col-lg-3 control-label"><?=show_static_text($adminLangSession['lang_id'],2670);?>Image Position X </label>
                            <div class="col-lg-9">
                               <?=form_input('image_pos_x_10', set_value('image_pos_x_10', $product->{'image_pos_x_10'}), 'class="form-control " id="i_x_10" placeholder="Slug"')?>
                            </div>
                        </div>
    
                        <div class="form-group" >
                  			<label class="col-lg-3 control-label"><?=show_static_text($adminLangSession['lang_id'],2670);?>Image Position Y</label>
                            <div class="col-lg-9">
                               <?=form_input('image_pos_y_10', set_value('image_pos_y_10_', $product->{'image_pos_y_10'}), 'class="form-control " id="i_y_10" placeholder="Slug"')?>
                            </div>
                        </div>
    
                        <div class="form-group" >
                  			<label class="col-lg-3 control-label"><?=show_static_text($adminLangSession['lang_id'],2607);?> Text Position X</label>
                            <div class="col-lg-9">
                               <?=form_input('text_x_10', set_value('text_x_10', $product->{'text_x_10'}), 'class="form-control " id="t_x_10" placeholder="Slug"')?>
                            </div>
                        </div>
                        <div class="form-group" >
                  			<label class="col-lg-3 control-label"><?=show_static_text($adminLangSession['lang_id'],2607);?>Text Position Y</label>
                            <div class="col-lg-9">
                               <?=form_input('text_y_10', set_value('text_y_10', $product->{'text_y_10'}), 'class="form-control " id="t_y_10" placeholder="Slug"')?>
<?php  
if(!isset($product->share_image_10)){
}
else{
?>
	<a href="javascript:void(0);" onclick="show_preview(10);" >Preview</a>
<?php
}
?>
                            </div>
                        </div>
                      </div>
                    </div><!--//share image10//-->
	
                          
                
				
                        <h5><?=show_static_text($adminLangSession['lang_id'],268);?></h5>
                        <div style="margin-bottom: 0px;" class="tabbable">
                        <ul class="nav nav-tabs">
                        <?php $i=0;
                        //   debugger($this->post_model->languages_icon);
                        //  foreach($this->post_model->languages as $key_lang=>$val_lang):
                        /*echo '<pre>';
                        print_r($this->post_model->languages);
                        die;*/
                        foreach($this->post_model->languages_icon as $key_lang=>$val_lang):
                        
                        $i++;?>
                        <li class="<?=$i==1?'active':''?>">
                        <a data-toggle="tab" href="#<?=$key_lang?>"><img src="<?php echo base_url('assets/uploads/language').'/'.$val_lang; ?>" height="15" width="20" ></a></li>
                        <?php endforeach;?>
                        </ul>
                        <div style="padding-top: 9px; border-bottom: 1px solid #ddd;" class="tab-content">
                        <?php $i=0;foreach($this->post_model->languages as $key_lang=>$val_lang):$i++;?>
                        <div id="<?=$key_lang?>" class="tab-pane <?=$i==1?'active':''?>">
                        <div class="form-group" >
                        <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],236);?></label>
                        <div class="col-lg-10">
                        <?=form_input('title_'.$key_lang, set_value('title_'.$key_lang, $product->{'title_'.$key_lang}), 'class="form-control copy_to_next" id="inputTitle'.$key_lang.'" placeholder="Title"')?>
                        </div>
                        </div>
                        
                        <div class="form-group">
                        <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],276);?></label>
                        <div class="col-lg-10">
                        <?=form_textarea('body_'.$key_lang, set_value('body_'.$key_lang, $product->{'body_'.$key_lang}), 'placeholder="Body" rows="3" class="cleditor2 form-control"')?>
                        </div>
                        </div>
                        
                          
                        </div>
                        <?php endforeach;?>
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

function show_preview(set_image){
	$image_x = $('#i_x_'+set_image).val();
	$image_y = $('#i_y_'+set_image).val();
	$text_x = $('#t_x_'+set_image).val();
	$text_y = $('#t_y_'+set_image).val();
	window.open('canvas/preview.php?id=<?=$product->id?>&name=text here&set_image='+set_image+'&text_x='+$text_x+'&text_y='+$text_y+'&image_x='+$image_x+'&image_y='+$image_y, '_bank'); 
	
}
</script>
