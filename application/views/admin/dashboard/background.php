<div class="row">
    <div class="col-md-12">
        <!-- begin panel -->
        <div data-sortable-id="form-stuff-1" class="panel panel-inverse">
            <div class="panel-heading">                
                <h4 class="panel-title"><?=$name?></h4>
            </div>
            <div class="panel-body">
			<?php echo validation_errors(); ?>
            <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">                    
					<input type="hidden" name="<?=$this->security->get_csrf_token_name(); ?>" value="<?=$this->security->get_csrf_hash();?>" />
                <input type="hidden" value="set" id="inputGps" name="operation">
                <div class="form-body">
					
                    <div class="form-group">
                      <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],2053);?>Home Image</label>
                      <div class="col-lg-3">
				      	<div class="fileinput fileinput-new" data-provides="fileinput">
							<div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
                                <?php echo !isset($settings['background']) ? '<img src="assets/uploads/no-image.gif">' :'<img src="'.base_url('assets/uploads/sites').'/'.$settings['background'].'" >'; ?>
                            </div>
							<div>
						    <span class="btn btn-default btn-file"><span class="fileinput-new"><?=show_static_text($adminLangSession['lang_id'],159);?></span><span class="fileinput-exists"><?=show_static_text($adminLangSession['lang_id'],160);?></span>
    	    	            <input type="file" name="logo" id="logo"></span>
						    <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput"><?=show_static_text($adminLangSession['lang_id'],109);?></a>
                     	</div>
                   		</div>
                        <br>Width:1900px, min-height: 423px
                            <!--<input type="file" name="logo" id="logo" />-->
                      </div>                      
                      
                    </div>

                    <div class="form-group">
                      <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],2053);?>Home Image 2</label>
                      <div class="col-lg-3">
				      	<div class="fileinput fileinput-new" data-provides="fileinput">
							<div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
                                <?php echo !isset($settings['background2']) ? '<img src="assets/uploads/no-image.gif">' :'<img src="'.base_url('assets/uploads/sites').'/'.$settings['background2'].'" >'; ?>
                            </div>
							<div>
						    <span class="btn btn-default btn-file"><span class="fileinput-new"><?=show_static_text($adminLangSession['lang_id'],159);?></span><span class="fileinput-exists"><?=show_static_text($adminLangSession['lang_id'],160);?></span>
    	    	            <input type="file" name="logo1" id="logo"></span>
						    <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput"><?=show_static_text($adminLangSession['lang_id'],109);?></a>
                     	</div>
                   		</div>
                        <br>Width:1900px, min-height: 423px
                            <!--<input type="file" name="logo" id="logo" />-->
                      </div>                      
                      
                    </div>

                    <div class="form-group">
                      <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],2053);?>Home Image 3</label>
                      <div class="col-lg-3">
				      	<div class="fileinput fileinput-new" data-provides="fileinput">
							<div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
                                <?php echo !isset($settings['b_background']) ? '<img src="assets/uploads/no-image.gif">' :'<img src="'.base_url('assets/uploads/sites').'/'.$settings['b_background'].'" >'; ?>
                            </div>
							<div>
						    <span class="btn btn-default btn-file"><span class="fileinput-new"><?=show_static_text($adminLangSession['lang_id'],159);?></span><span class="fileinput-exists"><?=show_static_text($adminLangSession['lang_id'],160);?></span>
    	    	            <input type="file" name="logo2" id="logo"></span>
						    <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput"><?=show_static_text($adminLangSession['lang_id'],109);?></a>
                     	</div>
                   		</div>
                        <br>Width:1900px, min-height: 423px
                            <!--<input type="file" name="logo" id="logo" />-->
                      </div>                      
                      
                    </div>

                    <div class="form-group">
                      <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],2053);?>Login Image</label>
                      <div class="col-lg-3">
				      	<div class="fileinput fileinput-new" data-provides="fileinput">
							<div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
                                <?php echo !isset($settings['l_background']) ? '<img src="assets/uploads/no-image.gif">' :'<img src="'.base_url('assets/uploads/sites').'/'.$settings['l_background'].'" >'; ?>
                            </div>
							<div>
						    <span class="btn btn-default btn-file"><span class="fileinput-new"><?=show_static_text($adminLangSession['lang_id'],159);?></span><span class="fileinput-exists"><?=show_static_text($adminLangSession['lang_id'],160);?></span>
    	    	            <input type="file" name="logo3" id="logo"></span>
						    <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput"><?=show_static_text($adminLangSession['lang_id'],109);?></a>
                     	</div>
                   		</div>
                        <br>Width:1900px, min-height: 423px
                            <!--<input type="file" name="logo" id="logo" />-->
                      </div>                      
                      
                    </div>

                    <div class="form-group">
                      <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],2053);?>Register Image</label>
                      <div class="col-lg-3">
				      	<div class="fileinput fileinput-new" data-provides="fileinput">
							<div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
                                <?php echo !isset($settings['r_background']) ? '<img src="assets/uploads/no-image.gif">' :'<img src="'.base_url('assets/uploads/sites').'/'.$settings['r_background'].'" >'; ?>
                            </div>
							<div>
						    <span class="btn btn-default btn-file"><span class="fileinput-new"><?=show_static_text($adminLangSession['lang_id'],159);?></span><span class="fileinput-exists"><?=show_static_text($adminLangSession['lang_id'],160);?></span>
    	    	            <input type="file" name="logo4" id="logo"></span>
						    <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput"><?=show_static_text($adminLangSession['lang_id'],109);?></a>
                     	</div>
                   		</div>
                        <br>Width:1900px, min-height: 423px
                            <!--<input type="file" name="logo" id="logo" />-->
                      </div>                      
                      
                    </div>
                    
                </div>
                    
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-2 col-md-9">
                            <button type="submit" class="btn btn-primary btn-label-left"><?=show_static_text($adminLangSession['lang_id'],56);?></button>
                        </div>
                    </div>
				</div>                    
            </form>
            </div>
        </div>
        <!-- end panel -->
    </div>
</div>

<link href="assets/plugins/jasny-bootstrap/css/jasny-bootstrap.min.css" rel="stylesheet" type="text/css"/>
<script src="assets/plugins/jasny-bootstrap/js/jasny-bootstrap.min.js" type="text/javascript" language="javascript"></script> 

