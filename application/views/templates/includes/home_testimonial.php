<style>
.user-rating .fa-star{
	color:#CC2626;
}
</style>
<?php
///echo $query = "SELECT * FROM users_review GROUP BY user_id ORDER BY id, rate DESC;";

$query = "SELECT AVG(rate) AS rate, user_id FROM users_review GROUP BY user_id ORDER BY rate DESC;";
$checkRate = $this->comman_model->get_query($query,false);
if($checkRate){
?>
<section id="aa-client-testimonial">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-client-testimonial-area">
            <div class="aa-title">
              <h2><?=show_static_text($lang_id,120);?></h2>
              <span></span>
              <!--<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus eaque quas debitis animi ipsum, veritatis!</p>-->
            </div>
            <!-- testimonial content -->
            <div class="aa-testimonial-content">
              <!-- testimonial slider -->
              <ul class="aa-testimonial-slider">
<?php
foreach($checkRate as $set_rate){
	//$this->db->limit(4);
	$this->db->order_by('id','desc');
	$home_book  = $this->comman_model->get_by('users',array('id'=>$set_rate->user_id,'confirm'=>'confirm','account_type'=>'S'),false,false,false);
	if($home_book){
		foreach($home_book as $set_book){	
?>
<li>
  <div class="aa-testimonial-single">
    <div class="aa-testimonial-img">
      <img src="<?= !empty($set_book->image)?'assets/uploads/users/thumbnails/'.$set_book->image:$default_image;?>" alt="<?=$set_book->username;?>" />
    </div>
    <div class="aa-testimonial-info">
    <p class="user-rating">
<i class="fa <?=$set_rate->rate>=1?'fa-star':'fa-star-o'?>"" ></i>
<i class="fa <?=$set_rate->rate>=2?'fa-star':'fa-star-o'?>"" ></i>
<i class="fa <?=$set_rate->rate>=3?'fa-star':'fa-star-o'?>"" ></i>
<i class="fa <?=$set_rate->rate>=4?'fa-star':'fa-star-o'?>"" ></i>
<i class="fa <?=$set_rate->rate>=5?'fa-star':'fa-star-o'?>"" ></i>
</p>
    </div>
    <div class="aa-testimonial-bio">
      <p><?=$set_book->username?></p>
    </div>
  </div>
</li>
<?php
		}
	}
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


