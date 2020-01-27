<?php
$this->db->limit(3);
$this->db->order_by('id','desc');
$home_book  = $this->comman_model->get_by('stores',array('enabled'=>1),false,false,false);
if($home_book){
?>
  <section id="aa-latest-property">
    <div class="container">
      <div class="aa-latest-property-area">
        <div class="aa-title">
          <h2><?=show_static_text($lang_id,308);?></h2>
          <span></span>
          <!--<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum sit ea nobis quae vero voluptatibus.</p>-->         
        </div>
        <div class="aa-latest-properties-content">
          <div class="row">
<?php
foreach($home_book as $set_book){	
	$query = "SELECT AVG(rate) AS rate FROM users_review where user_id='".$set_book->user_id."' GROUP BY user_id ORDER BY rate DESC;";
	$checkRate = $this->comman_model->get_query($query,true);
	if($checkRate){
		$userRatingCount = round($checkRate->rate,1);
	}
	else{
		$userRatingCount = 0;
	}
	$tComment =  count($this->comman_model->get_by('users_review',array('user_id'=>$set_book->user_id),false,false,false));

	$tCoach =  count($this->comman_model->get_by('users',array('parent_id'=>$set_book->user_id,'account_type'=>'C'),false,false,false));

?>
<div class="col-md-4">
  <article class="aa-properties-item">
    <a href="<?=$lang_code.'/gyms/'.$set_book->id?>" class="aa-properties-item-img">
      <img src="<?= !empty($set_book->image)?'assets/uploads/stores/thumbnails/'.$set_book->image:$default_image;?>" alt="<?=$set_book->name;?>" class="img-responsive" style="width:100%;height:200px" />
    </a>
    <!--<div class="aa-tag for-sale">
      For Sale
    </div>-->
    <div class="aa-properties-item-content">
      <div class="aa-properties-info">
        <span>
        <i class="fa <?=$userRatingCount>=1?'fa-star':'fa-star-o'?>" style="color:#CC2626"></i>
        <i class="fa <?=$userRatingCount>=2?'fa-star':'fa-star-o'?>" style="color:#CC2626"></i>
        <i class="fa <?=$userRatingCount>=3?'fa-star':'fa-star-o'?>" style="color:#CC2626"></i>
        <i class="fa <?=$userRatingCount>=4?'fa-star':'fa-star-o'?>" style="color:#CC2626"></i>
        <i class="fa <?=$userRatingCount>=5?'fa-star':'fa-star-o'?>" style="color:#CC2626"></i>
        <?=round($userRatingCount)?>
        </span>
        <span><i class="fa fa-comments" style="color:#CC2626"></i> <?=$tComment?></span>

        <span><i class="fa fa-users" style="color:#CC2626"></i> <?=$tCoach?></span>

      </div>
      <div class="aa-properties-about" style="min-height:80px">
        <h3><a href="<?=$lang_code.'/gyms/'.$set_book->id?>"><?=$set_book->name?></a></h3>
<p>
<?php
$html = strip_tags($set_book->description);
$html = html_entity_decode($html, ENT_QUOTES, 'UTF-8');    
echo (strlen($html)>=100)?substr($html, 0 ,100).'...':$html;
?> 
</p>                           
      </div>
      <div class="aa-properties-detial">
        <!--<span class="aa-price">
          $35000
        </span>-->
        <a href="<?=$lang_code.'/gyms/'.$set_book->id?>" class="aa-secondary-btn"><?=show_static_text($lang_id,28);?></a>
      </div>
    </div>
  </article>
</div>
<?php
}
?>
            
            
          </div>
        </div>
      </div>
    </div>
  </section>
<?php
}
?>
