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
        <div class="col-md-12">
            <div class="form-group" >
            	  <label class="col-lg-2 control-label"><?=lang('')?>Name</label>
        	      <div class="col-lg-10">
    	            <?=form_input('name', set_value('name', $products->{'name'}), 'class="form-control " id="" placeholder="Name"')?>
	              </div>
		    </div>
			
            <div class="form-group">
              <label class="col-lg-2 control-label">Cover <?=lang('image')?></label>
              <div class="col-lg-10">
                <div class="fileinput fileinput-new" data-provides="fileinput">
                    <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
                        <?php echo !isset($products->image) ? '<img src="assets/uploads/no-image.gif">' :'<img src="'.base_url('assets/uploads/home').'/'.$products->image.'" >'; ?>
                    </div>
                    <div>
                    <span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span>
                    <input type="file" name="logo" id="logo"></span>
                    <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
					<?php echo !isset($products->image) ? '' :'<a href="core2015/home/remove_video/image/'.$products->id.'" class="btn btn-default" >Remove Image</a>'; ?>
                </div>
                </div>
                    <!--<input type="file" name="logo" id="logo" />-->
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-lg-2 control-label">Video</label>
              <div class="col-lg-10">
					<?php echo !isset($products->video) ? '' :$products->video.'<a href="core2015/home/remove_video/video/'.$products->id.'" class="btn" >Remove</a>'; ?>
					<?php echo !isset($products->video) ? '<input type="file" name="logo1" id="logo1"><span>Please Upload webm file</span>' :''; ?>
	                
                    
              </div>
            </div>
            
            
            <!--<div class="form-group">
              <label class="col-lg-2 control-label">Default</label>
              <div class="col-lg-10" style="padding-top:10px">
                <?=form_checkbox('is_active', '1', set_value('is_active', $products->is_active), 'id="inputDefault" class="form-control "')?>
              </div>
	        </div>-->
                    
		</div>
        
    
       <div style="clear:both"></div>
     	
	</div>
     <div class="form-actions">
            <div class="row">
                <div class="col-md-offset-2 col-md-9">
                    <?=form_submit('submit', lang('Save'), 'class="btn btn-primary"')?>
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

