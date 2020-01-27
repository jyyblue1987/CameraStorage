<div class="row">
	<div class="col-md-12">
	    <div class="portlet box blue-hoki">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-gift"></i><?php echo $name;?>
            </div>
            <!--<div class="tools">
                <a href="javascript:;" class="collapse">
                </a>
                <a href="#portlet-config" data-toggle="modal" class="config">
                </a>
                <a href="javascript:;" class="reload">
                </a>
                <a href="javascript:;" class="remove">
                </a>
            </div>-->
        </div>
        <div class="portlet-body form">
			<?php echo validation_errors(); ?>
            <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">                    
                <div class="form-body">
                    <div class="form-group">
                        <label class="col-lg-2 control-label"><?=lang('site_name');?></label>
                        <div class="col-lg-4">
                           <?=form_input('site_name', set_value('site_name', isset($settings['site_name'])?$settings['site_name']:''), 'class="form-control"  placeholder="Site Name"')?>
                        </div>
                        <label class="col-sm-2 control-label"><?php echo $this->lang->line('site_email');?></label>
                        <div class="col-sm-4">
                            <input type="email" name="site_email" class="form-control" placeholder="Site Email" value="<?php echo set_value('site_email', isset($settings['site_email'])?$settings['site_email']:'');?>" >
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?php echo $this->lang->line('meta_title');?></label>
                        <div class="col-sm-4">
                            <input type="text" name="meta_title" class="form-control" placeholder="Mate Title Name" value="<?php echo set_value('meta_title', isset($settings['meta_title'])?$settings['meta_title']:'');?>" >
                        </div>
                        <label class="col-sm-2 control-label"><?php echo $this->lang->line('');?>Keywords</label>
                        <div class="col-sm-4">
                            <input type="text" name="keywords" class="form-control" placeholder="Keywords" value="<?php echo set_value('keywords', isset($settings['keywords'])?$settings['keywords']:'');?>" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?php echo $this->lang->line('meta_description');?></label>
                        <div class="col-sm-10">
                            <textarea name="meta_description" class="form-control"><?php echo set_value('meta_description', isset($settings['meta_description'])?$settings['meta_description']:'');?></textarea>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Home Title</label>
                        <div class="col-lg-4">
                           <?=form_input('home_title', set_value('home_title', isset($settings['home_title'])?$settings['home_title']:''), 'class="form-control" id="facebook_url" placeholder="Home Title"')?>
                        </div>
                        <label class="col-sm-2 control-label">Footer Text</label>
                        <div class="col-sm-4">
                            <input type="text" name="footer_text" class="form-control" placeholder="Footer text" value="<?php echo set_value('footer_text', isset($settings['footer_text'])?$settings['footer_text']:'');?>" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Phone</label>
                        <div class="col-lg-4">
                           <?=form_input('phone', set_value('phone', isset($settings['phone'])?$settings['phone']:''), 'class="form-control" id="Phone" placeholder="Phone"')?>
                        </div>
                        <label class="col-sm-2 control-label">Address</label>
                        <div class="col-sm-4">
                            <input type="text" name="address" class="form-control" placeholder="Address" value="<?php echo set_value('address', isset($settings['address'])?$settings['address']:'');?>" >
                        </div>
                    </div>

                    <hr>
                    <div class="form-group">
                      <label class="col-lg-2 control-label">Logo</label>
                      <div class="col-lg-10">
				      	<div class="fileinput fileinput-new" data-provides="fileinput">
							<div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
                                <?php echo !isset($settings['logo']) ? '<img src="assets/uploads/no-image.gif">' :'<img src="'.base_url('assets/uploads/sites').'/'.$settings['logo'].'" >'; ?>
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
                    <div class="form-group">
                      <label class="col-lg-2 control-label"><?=lang('')?>Home Image</label>
                      <div class="col-lg-10">
				      	<div class="fileinput fileinput-new" data-provides="fileinput">
							<div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
                                <?php echo !isset($settings['image']) ? '<img src="assets/uploads/no-image.gif">' :'<img src="'.base_url('assets/uploads/sites').'/'.$settings['image'].'" >'; ?>
                            </div>
							<div>
						    <span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span>
    	    	            <input type="file" name="image" id="image"></span>
						    <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                     	</div>
                   		</div>
                            <!--<input type="file" name="logo" id="logo" />-->
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-lg-2 control-label"><?=lang('')?>Menu Image</label>
                      <div class="col-lg-10">
				      	<div class="fileinput fileinput-new" data-provides="fileinput">
							<div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
                                <?php echo !isset($settings['menu_image']) ? '<img src="assets/uploads/no-image.gif">' :'<img src="'.base_url('assets/uploads/sites').'/'.$settings['menu_image'].'" >'; ?>
                            </div>
							<div>
						    <span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span>
    	    	            <input type="file" name="menu_image" id="menu_image"></span>
						    <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                     	</div>
                   		</div>
                            <!--<input type="file" name="logo" id="logo" />-->
                      </div>
                    </div>
                    <?php /*?><div class="form-group">
                        <div class="form-group">
                        <label class="col-sm-2 control-label">Image</label>
                        <div class="col-sm-4">
<?php
if(!empty($setting[7]->value)){
	$image='assets/uploads/coupons/small/'.$edit_data->image;
  	echo '<img alt="'.$edit_data->coupon_title.'" src="'.$image.'" class="img-rounded">';
}
?>
							<input type='file' name="photo" />                            
                        </div>
                    </div>
                    </div><?php */?>
                </div>
                    
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-2 col-md-9">
                            <button type="submit" class="btn btn-primary btn-label-left">
                            <?php echo $this->lang->line('submit');?></button>
                        </div>
                    </div>
				</div>                    
            </form>
        </div>
    </div>
    </div>
</div>

<link href="assets/plugins/jasny-bootstrap/css/jasny-bootstrap.min.css" rel="stylesheet" type="text/css"/>
<script src="assets/plugins/jasny-bootstrap/js/jasny-bootstrap.min.js" type="text/javascript" language="javascript"></script> 
