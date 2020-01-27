<section id="aa-slider">
    <div class="aa-slider-area"> 
      <!-- Top slider -->
      <div class="aa-top-slider">
<?php
$this->db->order_by('order','asc');
$sliders = $this->comman_model->get('sliders',false);
/*echo '<pre>';
print_r($sliders);*/
if($sliders){
	foreach($sliders as $set_slide){
?>
        <!-- Top slider single slide -->
        <div class="aa-top-slider-single">
          <img src="assets/uploads/sliders/full/<?=$set_slide->image?>" alt="img">
          <!-- Top slider content -->
          <div class="aa-top-slider-content">
            <span class="aa-top-slider-catg"><?=$set_slide->name?></span>
            <p class="aa-top-slider-location"><?=$set_slide->desc?></p>
          </div>
          <!-- / Top slider content -->
        </div>
        <!-- / Top slider single slide -->
<?php
	}
}
?>
<!-- 
   <div class="aa-top-slider-single">
      <img src="assets/frontend/img/slider/6.jpg" alt="img">
      <div class="aa-top-slider-content">
        <span class="aa-top-slider-catg">Duplex</span>
        <h2 class="aa-top-slider-title">1560 Square Feet</h2>
        <p class="aa-top-slider-location"><i class="fa fa-map-marker"></i>South Beach, Miami (USA)</p>
        <span class="aa-top-slider-off">30% OFF</span>
        <p class="aa-top-slider-price">$460,000</p>
        <a href="#" class="aa-top-slider-btn">Read More <span class="fa fa-angle-double-right"></span></a>
      </div>
    </div>
-->
  </div>
</div>
</section>