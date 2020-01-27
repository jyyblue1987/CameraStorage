<?php $this->load->view('templates/includes/header'); ?>
<style>
#aa-property-header{
	background:url('assets/frontend/img/girl_bg1.jpg');
	background-repeat:no-repeat;
	background-attachment: fixed;
	background-position: center center;
	background-size: cover;
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
<?php
$membership = $this->comman_model->get('memberships',false);
if($membership){
	foreach($membership as $set_membership){
?>
<div class="col-md-4">
            <div class="panel panel-red">
                <div class="panel-heading">
                    <h4 class="text-center"><?=$set_membership->name?></h4>
                </div>
                <div class="panel-body text-center">
                    <p class="lead">
                        <strong>$<?=$set_membership->price?> / <?=$set_membership->month?>month</strong>
                    </p>
                </div>
                <ul class="list-group list-group-flush text-center">
                    <li class="list-group-item">
                        <strong>1 Coach : </strong>  $<?=$set_membership->coach?>
                        <span class="glyphicon glyphicon-ok pull-right"></span>
	                </li>
                    <li class="list-group-item">
                        <strong>1 Athlete : </strong>  $<?=$set_membership->member?>
                        <span class="glyphicon glyphicon-ok pull-right"></span>
                    </li>
                    <li class="list-group-item">
                        <strong>1 Staff : </strong>  $<?=$set_membership->staff?>
                        <span class="glyphicon glyphicon-ok pull-right"></span>
                    </li>                    
                </ul>
                <div class ="panel-footer">
<div>
<?=$set_membership->desc?>
</div>                
                </div>
            </div>
        </div>
<?php
	}
}
?>
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

