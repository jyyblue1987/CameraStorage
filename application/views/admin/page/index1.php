<div class="page-head">
    <!-- Page heading -->
      <h2 class="pull-left"><?=lang('Pages')?>
      <!-- page meta -->
      <span class="page-meta"><?=lang('View all pages')?></span>
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
                <?=anchor('admin/page/edit', '<i class="icon-plus"></i>&nbsp;&nbsp;'.lang('Add a page'), 'class="btn btn-primary"')?>
            </div>
        </div>

          <div class="row">

            <div class="col-md-12">
                <div class="widget wblue">
                <div class="widget-head">
                  <div class="pull-left"><?=lang('Pages')?>: <?php echo lang('pages:top_menu') ?></div>
                  <div class="widget-icons pull-right">
                    <a class="wminimize" href="#"><i class="icon-chevron-up"></i></a> 
                  </div>
                  <div class="clearfix"></div>
                </div>
                  <div class="widget-content">
                    <?php if($this->session->flashdata('error')):?>
                    <p class="label label-important validation"><?=$this->session->flashdata('error')?></p>
                    <?php endif;?>
                  
                    <!-- Nested Sortable -->
                    <div id="orderResult">
                     
                    <?=get_ol_pages($pages_top_nested)?>
                    </div>
                  </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="widget wblue">
                <div class="widget-head">
                  <div class="pull-left"><?=lang('Pages')?>: <?php echo lang('pages:footer_menu') ?></div>
                  <div class="widget-icons pull-right">
                    <a class="wminimize" href="#"><i class="icon-chevron-up"></i></a> 
                  </div>
                  <div class="clearfix"></div>
                </div>
                  <div class="widget-content" style="display: none;">
                    <?php if($this->session->flashdata('error')):?>
                    <p class="label label-important validation"><?=$this->session->flashdata('error')?></p>
                    <?php endif;?>
                  
                    <!-- Nested Sortable -->
                    <div id="orderResult">
                    <?=get_ol_pages2($pages_footer_nested)?>
                    </div>
                  </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="widget wblue">
                <div class="widget-head">
                  <div class="pull-left"><?=lang('Pages')?>: <?php echo lang('pages:both_meu') ?></div>
                  <div class="widget-icons pull-right">
                    <a class="wminimize" href="#"><i class="icon-chevron-up"></i></a> 
                  </div>
                  <div class="clearfix"></div>
                </div>
                  <div class="widget-content" style="display: none;">
                    <?php if($this->session->flashdata('error')):?>
                    <p class="label label-important validation"><?=$this->session->flashdata('error')?></p>
                    <?php endif;?>
                    <!-- Nested Sortable -->
                    <div id="orderResult">
                    <?=get_ol_pages($pages_both_nested)?>
                    </div>
                  </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="widget wblue">
                <div class="widget-head">
                  <div class="pull-left"><?=lang('Pages')?>: <?php echo lang('pages:display_all') ?></div>
                  <div class="widget-icons pull-right">
                    <a class="wminimize" href="#"><i class="icon-chevron-up"></i></a> 
                  </div>
                  <div class="clearfix"></div>
                </div>
                  <div class="widget-content" style="display: none;">
                    <?php if($this->session->flashdata('error')):?>
                    <p class="label label-important validation"><?=$this->session->flashdata('error')?></p>
                    <?php endif;?>
                  
                    <!-- Nested Sortable -->
                    <div id="orderResult">
                    <?=get_ol_pages3($pages_none_nested)?>
                    </div>
                  </div>
                </div>
            </div>

        </div>
</div>
    
    
    
    
    
</section>