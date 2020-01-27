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

					<div class="form-group">
                      <label class="col-lg-2 control-label">User Name</label>
                      <div class="col-lg-10">
                        <?=form_input('user_name', set_value('user_name', $products->{'user_name'}), 'class="form-control " id="" placeholder="User Name"')?>
                      </div>
                	        
	                    </div>                        
                <div class="form-group" >
                  <label class="col-lg-2 control-label"><?=lang('')?>Company Name</label>
                  <div class="col-lg-10">
                    <?=form_input('company_name', set_value('company_name', $products->{'company_name'}), 'class="form-control " id="" placeholder="Company Name"')?>
                  </div>
                </div>
                
                <div class="form-group" >
                  <label class="col-lg-2 control-label"><?=lang('')?>Title</label>
                  <div class="col-lg-10">
                    <?=form_input('title', set_value('title', $products->{'title'}), 'class="form-control " id="" placeholder="title"')?>
                  </div>
                </div>
                
                <div class="form-group" >
                  <label class="col-lg-2 control-label"><?=lang('')?>Message</label>
                  <div class="col-lg-10">
					<?=form_textarea('description', set_value('description', $products->{'description'}), 'placeholder="description" rows="3" class="cleditor2 form-control"')?>
                  </div>
                </div>
                <div class="form-group">
                      <label class="col-lg-2 control-label">Image</label>
                      <div class="col-lg-10">
				      	<div class="fileinput fileinput-new" data-provides="fileinput">
							<div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
                                <?php echo !isset($products->image) ? '<img src="assets/uploads/no-image.gif">' :'<img src="'.base_url('assets/uploads/feedback').'/'.$products->image.'" >'; ?>
                            </div>
							<div>
						    <span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span>
    	    	            <input type="file" name="logo" id="logo"></span>
						    <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                     	</div>
                   		</div>
                            <!--<input type="file" name="logo" id="logo" />-->
                      </div>
                </div>

			</div>
            	<div style="clear:both"></div>

						</div>
                
				<div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-2 col-md-9">
                      <input type="hidden" name="id" value="<?='as'?>" />
                        <button class="btn btn-primary" type="submit">Save</button>
                        </div>
                    </div>
                </div>
		<?=form_close()?>
                
				
		<?=form_close()?>
            <!-- END FORM-->
            </div>
        </div>
        <!-- end panel -->
    </div>
</div>


  
<link href="assets/plugins/jasny-bootstrap/css/jasny-bootstrap.min.css" rel="stylesheet" type="text/css"/>
<script src="assets/plugins/jasny-bootstrap/js/jasny-bootstrap.min.js" type="text/javascript" language="javascript"></script> 
