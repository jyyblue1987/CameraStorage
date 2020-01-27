<?php
//$this->db->limit(4);
$this->db->order_by('id','desc');
$home_book  = $this->comman_model->get_by('users',array('confirm'=>'confirm','account_type'=>'C'),false,false,false);
if($home_book){
?>
<section id="aa-agents">
	<div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-agents-area">
            <div class="aa-title">
              <h2><?=show_static_text($lang_id,143);?></h2>
              <span></span>
              <!--<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum sit ea nobis quae vero voluptatibus.</p>-->
            </div>
            <!-- agents content -->
            <div class="aa-agents-content">
              <ul class="aa-agents-slider">
<?php
foreach($home_book as $set_book){	
?>
<li>
  <div class="aa-single-agents">
    <div class="aa-agents-img">
      <img src="<?= !empty($set_book->image)?'assets/uploads/users/thumbnails/'.$set_book->image:$default_image;?>" alt="<?=$set_book->username;?>"  style="" />
    </div>
    <div class="aa-agetns-info">
      <h4><a href="#"><?=$set_book->username?></a></h4>
      <span>Coach</span>
      <!--<div class="aa-agent-social">
        <a href="#"><i class="fa fa-facebook"></i></a>
        <a href="#"><i class="fa fa-twitter"></i></a>
        <a href="#"><i class="fa fa-linkedin"></i></a>
        <a href="#"><i class="fa fa-google-plus"></i></a>
      </div>-->
    </div>
  </div>
</li>
<?php
}
?>
                                                                                 
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
<?php
}
?>
