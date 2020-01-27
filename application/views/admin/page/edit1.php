<div class="page-head">
    <!-- Page heading -->
      <h2 class="pull-left"><?=lang('Page')?>
          <!-- page meta -->
          <span class="page-meta"><?=empty($page->id) ? lang('Add a page') : lang('Edit page').' "' . $page->title_1.'"'?></span>
        </h2>
    
    
    <!-- Breadcrumb -->
    <div class="bread-crumb pull-right">
      <a href="<?=site_url('admin')?>"><i class="icon-home"></i> <?=lang('Home')?></a> 
      <!-- Divider -->
      <span class="divider">/</span> 
      <a class="bread-current" href="<?=site_url('admin/page')?>"><?=lang('Pages')?></a>
    </div>
    
    <div class="clearfix"></div>

</div>

<div class="matter">
        <div class="container">

          <div class="row">

            <div class="col-md-12">


              <div class="widget wblue">
                
                <div class="widget-head">
                  <div class="pull-left"><?=lang('Page data')?></div>
                  <div class="widget-icons pull-right">
                    <a class="wminimize" href="#"><i class="icon-chevron-up"></i></a> 
                  </div>
                  <div class="clearfix"></div>
                </div>

                <div class="widget-content">
                  <div class="padd">
                    <?=validation_errors()?>
                    <?php if($this->session->flashdata('error')):?>
                    <p class="label label-important validation"><?=$this->session->flashdata('error')?></p>
                    <?php endif;?>
                    <hr />
                    <!-- Form starts.  -->
                    <?=form_open(NULL, array('class' => 'form-horizontal', 'role'=>'form','enctype'=>"multipart/form-data"))?>                              
                                <div class="form-group">
                                  <label class="col-lg-2 control-label"><?=lang('Parent')?></label>
                                  <div class="col-lg-10">
                                    <?=form_dropdown('parent_id', $pages_no_parents, $this->input->post('parent_id') ? $this->input->post('parent_id') : $page->parent_id, 'class="form-control"')?>
                                  </div>
                                </div>
                                
                                <div class="form-group">
                                  <label class="col-lg-2 control-label"><?=lang('Template')?></label>
                                  <div class="col-lg-10">
                                    <?php echo form_dropdown('template', $templates_page, $this->input->post('template') ? $this->input->post('template') : $page->template, 'class="form-control"'); ?>
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label class="col-lg-2 control-label"><?=lang('menu_location')?></label>
                                  <div class="col-lg-10">
                                      <?php
                                      $menu_location = array('top_menu'=>'Top Menu','footer_menu'=>'Footer Menu','both_menu'=>'Top and Footer Menu','no_display'=>'No Display');
                                      ?>
                                    <?php echo form_dropdown('menu_location', $menu_location, $this->input->post('menu_location') ? $this->input->post('menu_location') : $page->menu_location, 'class="form-control"'); ?>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-lg-2 control-label">Display as Banner</label>
                                  <div class="col-lg-10">
                                      <?php
                                      $banner = array('0'=>'No','1'=>'Yes');
                                      ?>
                                    <?php echo form_dropdown('is_banner', $banner, $this->input->post('is_banner') ? $this->input->post('is_banner') : $page->is_banner, 'class="form-control"'); ?>
                                  </div>
                                </div>


                                 <hr />
                                <div class="form-group">
                                  <label class="col-lg-2 control-label"><?=lang('icon')?></label>
                                  <div class="col-lg-10">
                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                      <div class="fileupload-new thumbnail" ><?php echo !isset($page->icon) ? '<img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image">' :'<img src="'.base_url('uploads').'/'.$page->icon.'" >'; ?></div>
                                      <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                      <div>
                                        <input type="file" name="logo" id="logo" />
                                        <a href="#" class="btn fileupload-exists gray" data-dismiss="fileupload">Remove</a>
                                      </div>
                                    </div>
                                  </div>
                                </div>

                                <hr />
                                <h5><?=lang('Translation data')?></h5>
                               <div style="margin-bottom: 0px;" class="tabbable">
                                  <ul class="nav nav-tabs">
                                    <?php $i=0;
                                  //   debugger($this->page_m->languages_icon);
                                  //  foreach($this->page_m->languages as $key_lang=>$val_lang):
								  /*echo '<pre>';
								  print_r($this->page_m->languages);
								  die;*/
                                    foreach($this->page_m->languages_icon as $key_lang=>$val_lang):

                                      $i++;?>
                                    <li class="<?=$i==1?'active':''?>">
                                      <a data-toggle="tab" href="#<?=$key_lang?>"><img src="<?php echo base_url('uploads').'/'.$val_lang; ?>" ></a></li>
                                    <?php endforeach;?>
                                  </ul>
                                  <div style="padding-top: 9px; border-bottom: 1px solid #ddd;" class="tab-content">
                                    <?php $i=0;foreach($this->page_m->languages as $key_lang=>$val_lang):$i++;?>
                                    <div id="<?=$key_lang?>" class="tab-pane <?=$i==1?'active':''?>">
                                        <div class="form-group" >
                                          <label class="col-lg-2 control-label"><?=lang('Title')?></label>
                                          <div class="col-lg-10">
                                            <?=form_input('title_'.$key_lang, set_value('title_'.$key_lang, $page->{'title_'.$key_lang}), 'class="form-control copy_to_next" id="inputTitle'.$key_lang.'" placeholder="'.lang('Title').'"')?>
                                          </div>
                                        </div>
                                        
                                        <div class="form-group" style="display:none;">
                                          <label class="col-lg-2 control-label"><?=lang('Navigation title')?></label>
                                          <div class="col-lg-10">
                                            <?=form_input('navigation_title_'.$key_lang, set_value('navigation_title_'.$key_lang, $page->{'navigation_title_'.$key_lang}), 'class="form-control" id="inputNavigationTitle'.$key_lang.'" placeholder="'.lang('Navigation title').'"')?>
                                          </div>
                                        </div>
                                        
                                       <!-- <div class="form-group">
                                          <label class="col-lg-2 control-label"><?=lang('Keywords')?></label>
                                          <div class="col-lg-10">
                                            <?=form_input('keywords_'.$key_lang, set_value('keywords_'.$key_lang, $page->{'keywords_'.$key_lang}), 'class="form-control" id="inputKeywords'.$key_lang.'" placeholder="'.lang('Keywords').'"')?>
                                          </div>
                                        </div>
                                        
                                        <div class="form-group">
                                          <label class="col-lg-2 control-label"><?=lang('Description')?></label>
                                          <div class="col-lg-10">
                                            <?=form_textarea('description_'.$key_lang, set_value('description_'.$key_lang, $page->{'description_'.$key_lang}), 'placeholder="'.lang('Description').'" rows="3" class="form-control"')?>
                                          </div>
                                        </div> -->
                                        
                                        <div class="form-group">
                                          <label class="col-lg-2 control-label"><?=lang('Body')?></label>
                                          <div class="col-lg-10">
                                            <?=form_textarea('body_'.$key_lang, html_entity_decode(set_value('body_'.$key_lang, $page->{'body_'.$key_lang})), 'placeholder="'.lang('Body').'" rows="3" class="cleditor2 form-control"')?>
                                          </div>
                                        </div>  
                                    </div>
                                    <?php endforeach;?>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <div class="col-lg-offset-2 col-lg-10">
                                    <?=form_submit('submit', lang('Save'), 'class="btn btn-primary"')?>
                                    <a href="<?=site_url('admin/page')?>" class="btn btn-default" type="button"><?=lang('Cancel')?></a>
                                  </div>
                                </div>
                       <?=form_close()?>
                  </div>
                </div>
                  <div class="widget-foot">
                    <!-- Footer goes here -->
                  </div>
              </div>  

            </div>
            
        <div class="col-md-12" style="display:none;">

              <div class="widget wlightblue">

                <div class="widget-head">
                  <div class="pull-left"><?=lang('Files')?></div>
                  <div class="widget-icons pull-right">
                    <a class="wminimize" href="#"><i class="icon-chevron-up"></i></a> 
                  </div>
                  <div class="clearfix"></div>
                </div>

                <div class="widget-content">
                  <div class="padd">

<?php if(!isset($page->id)):?>
<span class="label label-danger"><?=lang('After saving, you can add files and images');?></span>
<?php else:?>
<div id="page-files-<?=$page->id?>" rel="page_m">
    <!-- The file upload form used as target for the file upload widget -->
    <form class="fileupload" action="<?=site_url('files/upload/'.$page->id);?>" method="POST" enctype="multipart/form-data">
        <!-- Redirect browsers with JavaScript disabled to the origin page -->
        <noscript><input type="hidden" name="redirect" value="<?=site_url('admin/page/edit/'.$page->id);?>"></noscript>
        <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
        <div class="fileupload-buttonbar">
            <div class="span7 col-md-7">
                <!-- The fileinput-button span is used to style the file input field as button -->
                <span class="btn btn-success fileinput-button">
                    <i class="icon-plus icon-white"></i>
                    <span><?=lang('add_files...')?></span>
                    <input type="file" name="files[]" multiple>
                </span>
                <button type="reset" class="btn btn-warning cancel">
                    <i class="icon-ban-circle icon-white"></i>
                    <span><?=lang('cancel_upload')?></span>
                </button>
                <button type="button" class="btn btn-danger delete">
                    <i class="icon-trash icon-white"></i>
                    <span><?=lang('delete_selected')?></span>
                </button>
                <input type="checkbox" class="toggle" />
            </div>
            <!-- The global progress information -->
            <div class="span5 col-md-5 fileupload-progress fade">
                <!-- The global progress bar -->
                <div class="progress progress-success progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                    <div class="bar" style="width:0%;"></div>
                </div>
                <!-- The extended global progress information -->
                <div class="progress-extended">&nbsp;</div>
            </div>
        </div>
        <!-- The loading indicator is shown during file processing -->
        <div class="fileupload-loading"></div>
        <br />
        <!-- The table listing the files available for upload/download -->
        <!--<table role="presentation" class="table table-striped">
        <tbody class="files" data-toggle="modal-gallery" data-target="#modal-gallery">-->

          <div role="presentation" class="fieldset-content">
            <ul class="files files-list" data-toggle="modal-gallery" data-target="#modal-gallery">      
<?php if(isset($files[$page->repository_id]))foreach($files[$page->repository_id] as $file ):?>
            <li class="img-rounded template-download fade in">
                <div class="preview">
                    <img class="img-rounded" alt="<?=$file->filename?>" data-src="<?=$file->thumbnail_url?>" src="<?=$file->thumbnail_url?>">
                </div>
                <div class="filename">
                    <code><?=character_hard_limiter($file->filename, 20)?></code>
                </div>
                <div class="options-container">
                    <?php if($file->zoom_enabled):?>
                    <a data-gallery="gallery" href="<?=$file->download_url?>" title="<?=$file->filename?>" download="<?=$file->filename?>" class="zoom-button btn btn-xs btn-success"><i class="icon-search icon-white"></i></a>                  
                    <?php else:?>
                    <a target="_blank" href="<?=$file->download_url?>" title="<?=$file->filename?>" download="<?=$file->filename?>" class="btn btn-xs btn-success"><i class="icon-search icon-white"></i></a>
                    <?php endif;?>
                    <span class="delete">
                        <button class="btn btn-xs btn-danger" data-type="DELETE" data-url="<?=$file->delete_url?>"><i class="icon-trash icon-white"></i></button>
                        <input type="checkbox" value="1" name="delete">
                    </span>
                </div>
            </li>
<?php endforeach;?>
            </ul>
            <br style="clear:both;"/>
          </div>
    </form>

</div>
<?php endif;?>

                  </div>
                </div>
                  <div class="widget-foot">
                    <!-- Footer goes here -->
                  </div>
              </div>  
              
            </div>

          </div>

        </div>
		  </div>
<script src="<?php echo base_url('admin-assets/js/bootstrap/bootstrap-fileupload.min.js'); ?>" type="text/javascript" language="javascript"></script>  
<script src="<?php echo base_url('admin-assets/js/bootstrap/bootstrap-modal.js'); ?>" type="text/javascript" language="javascript"></script> 
<script src="<?php echo base_url('admin-assets/js/ckeditor/ckeditor.js'); ?>" type="text/javascript" language="javascript"></script> 
<script src="<?php echo base_url('admin-assets/js/ckeditor/adapters/jquery.js'); ?>" type="text/javascript" language="javascript"></script> 
<script>

/* CL Editor */
$(document).ready(function(){
    
    /*$(".cleditor2").cleditor({
        width: "auto",
        height: "auto",
        docCSSFile: "<?=$template_css?>",
        baseHref: 'http://localhost/property-point/templates/deta-prut/'
    }); */
    $('.cleditor2').ckeditor();
});




</script>