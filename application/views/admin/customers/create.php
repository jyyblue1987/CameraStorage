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
        <input type="hidden" value="<?=set_value('gps', $stores->{'gps'})?>" id="inputGps" name="gps">

                      <div id="more_pic" style="display:none"></div>
<div class="form-body">                    
	<div class="col-md-12">						                        
    	
        <div class="form-group" >
            <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],8007);?>Company name</label>
            <div class="col-lg-10">
    	        <?=form_input('company_name', set_value('company_name', $stores->{'company_name'}), 'class="form-control " id="" placeholder=""')?>
            </div>
		</div>

		<div class="form-group" >
            <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],8007);?>Website Link</label>
            <div class="col-lg-10">
    	        <?=form_input('website', set_value('website', $stores->{'website'}), 'class="form-control " id="" placeholder=""')?>
            </div>
		</div>
        
  


    <div class="form-group" >
        <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],16);?></label>
        <div class="col-lg-10">
            <?=form_input('first_name', set_value('first_name', $stores->{'first_name'}), 'class="form-control " id="" placeholder=""')?>
        </div>
    </div>
	<div class="form-group" >
        <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],17);?></label>
        <div class="col-lg-10">
            <?=form_input('last_name', set_value('last_name', $stores->{'last_name'}), 'class="form-control " id="" placeholder=""')?>
        </div>
    </div>

<!--	<div class="form-group" >
        <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],18);?></label>
        <div class="col-lg-10">
            <?=form_input('email', set_value('email', $stores->{'email'}), 'class="form-control " id="" placeholder=""')?>
        </div>
    </div>

	<div class="form-group" >
        <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],20);?></label>
        <div class="col-lg-10">
            <?=form_input('password', set_value('password', $stores->{'password'}), 'class="form-control " id="" placeholder=""')?>
        </div>
    </div>-->
   
                          
    <div class="form-group" >
        <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],4001);?>Phone</label>
        <div class="col-lg-10">
            <?=form_input('phone', set_value('phone', $stores->{'phone'}), 'class="form-control " id="" placeholder=""')?>
        </div>
    </div>








<!--<div class="form-group">
  <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],322);?></label>
  <div class="col-lg-3">
    <div class="fileinput fileinput-new" data-provides="fileinput">
        <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
            <?php echo (isset($stores->image)&&!empty($stores->image)) ? '<img src="'.base_url('assets/uploads/stores/thumbnails').'/'.$stores->image.'" >':'<img src="assets/uploads/no-image.gif">'; ?>
        </div>
        <div>
        <span class="btn btn-default btn-file"><span class="fileinput-new"><?=show_static_text($adminLangSession['lang_id'],159);?></span><span class="fileinput-exists"><?=show_static_text($adminLangSession['lang_id'],160);?></span>
        <input type="file" name="image" id="logo"></span>
        <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
    <?php echo !isset($stores->image) ? '' :'<a href="'.$_cancel.'/remove_file/image/'.$stores->id.'" class="btn btn-default" >Remove Image</a>'; ?>
    </div>
    </div>
        
  </div>
  
</div>

<div class="form-group">
  <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],253);?></label>
  <div class="col-lg-10">
    <div class="fileinput fileinput-new" data-provides="fileinput">
        <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
            <?php echo (isset($stores->image)&&!empty($stores->image)) ? '<img src="'.base_url('assets/uploads/stores/thumbnails').'/'.$stores->image.'" >':'<img src="assets/uploads/no-image.gif">'; ?>
        </div>
        <div>
        <span class="btn btn-default btn-file"><span class="fileinput-new"><?=show_static_text($adminLangSession['lang_id'],159);?></span><span class="fileinput-exists"><?=show_static_text($adminLangSession['lang_id'],160);?></span>
        <input type="file" name="logo" id="logo"></span>
        <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
    <?php echo !isset($stores->image) ? '' :'<a href="'.$_cancel.'/remove_file/image/'.$stores->id.'" class="btn btn-default" >Remove Image</a>'; ?>
    </div>
    </div>
       
  </div>
</div>-->
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

