<?php $this->load->view('templates/includes/header'); ?>
<style>
#aa-property-header{
	background:url('<?=!empty($page->image)?'assets/uploads/pages/'.$page->image:'assets/frontend/img/girl_bg1.jpg'?>');
	background-repeat:no-repeat;
	background-attachment: fixed;
/*	background-position: center center;*/
	background-size: 100% 100%;
}
</style>
<body>
<?php $this->load->view('templates/includes/menu'); ?>
  <section id="aa-property-header">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-property-header-inner">
            <h2><?=$page->title?></h2>
            <ol class="breadcrumb">
            <li><a href=""><?=show_static_text($lang_id,10)?></a></li>            
            <li class="active"><?=$page->title?></li>
          </ol>
          </div>
        </div>
      </div>
    </div>
  </section> 
  <!-- End Proerty header  -->

  <!-- Start Blog  -->
  <section id="aa-blog">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-blog-area">
            <div class="row">
              <div class="col-md-12">
                <div class="aa-blog-content">
                  <div class="row">
                    <div class="col-md-12">
                      <article class="aa-blog-single aa-blog-details">
                        
                        <div class="aa-blog-single-content">
<!--                          <h2>Lorem ipsum dolor sit amet, consectetur.</h2>-->
                          <div>
<?=$page->body?>
                          
                          </div>
                          
                        </div>                   
                      </article>
                    </div>
                    <!-- Post tags -->
                    
                  </div>                                   
                </div>
              </div>
              <!-- Start blog sidebar -->              
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- / Blog  -->

  <!-- Footer -->
<?php $this->load->view('templates/includes/footer'); ?>
  
  <!-- / Footer -->
  
  </body>
</html>

