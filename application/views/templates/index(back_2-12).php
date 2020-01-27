<?php $this->load->view('templates/includes/header'); ?>  
<style>
#aa-about-us:before {
  background-color: rgba(0, 0, 0, 0.6);
  content: '';
  position: absolute;
  left: 0;
  top: 0;
  right: 0;
  bottom: 0;
}

#aa-about-us{
  background-image: url("<?='assets/uploads/sites/'.$settings['background'];?>");
  background-attachment: fixed;
  background-position: center center;
  background-size: cover;
  display: inline;
  float: left;
  width: 100%;
  padding: 100px 0;
  position: relative;
  color:#FFF;
}


#aa-promo-banner {
  background-image: url("<?='assets/uploads/sites/'.$settings['background2'];?>");
  background-attachment: fixed;
  background-position: center center;
  background-size: cover;
  display: inline;
  float: left;
  width: 100%;
  padding: 100px 0;
  position: relative;
}

#aa-client-testimonial {
  background-attachment: fixed;
  background-image: url("<?='assets/uploads/sites/'.$settings['b_background'];?>");
  background-position: center center;
  background-repeat: no-repeat;
  background-size: cover;
  display: inline;
  float: left;
  padding: 100px 0;
  width: 100%;
  position: relative;
}

</style>

<body class="aa-price-range">  
  <!-- Pre Loader -->
<?php $this->load->view('templates/includes/menu'); ?>  

<?php $this->load->view('templates/includes/slider'); ?>  
  <!-- Advance Search -->
  <!-- / Advance Search -->

  <!-- About us -->
  <section id="aa-about-us">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-about-us-area">
            <div class="row">              

<?php
//$this->db->order_by('id','desc');
$hContent= $this->comman_model->get_lang('content',$lang_id,NULL,array('id'=>1),'content_id',true);
if($hContent){
	$fullcont = true;
	if($hContent->video){
		$fullcont = false;
?>
<div class="col-md-5">
                <div class="aa-about-us-left">
<video width="400" poster=""  controls>
<source src="assets/uploads/contents/<?=$hContent->video?>"  type="video/mp4">
Your browser does not support HTML5 video.
</video>

                </div>
              </div>
<?php		
	}
	elseif($hContent->link){
		$fullcont = false;
?>
<div class="col-md-5">
                <div class="aa-about-us-left">
<?php
    echo preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i","<iframe src=\"//www.youtube.com/embed/$1\" frameborder=\"0\" style='width:100%;height:250px' allowfullscreen></iframe>",$hContent->link);
?>
                </div>
              </div>
<?php				
	}
?>

  <div class="<?=$fullcont?'col-md-12':'col-md-7'?>">
    <div class="aa-about-us-right">
<!--
      <div class="aa-title">
        <h2>About Us</h2>
        <span></span>
      </div>-->
<div><?=$hContent->body;?></div>                                                      
    </div>
  </div>

<?php	
}
?>

              
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- / About us -->

  <!-- Latest ownner-->
<?php $this->load->view('templates/includes/home_ownner'); ?>  

  <!--//Latest ownner//-->

  <!-- Service section -->
  <section id="aa-service">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-service-area">
            <div class="aa-title">
              <h2><?=show_static_text($lang_id,273);?></h2>
              <span></span>
              <!--<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum sit ea nobis quae vero voluptatibus.</p>-->
            </div>
            <!-- service content -->
            <div class="aa-service-content">
              <div class="row">
                <div class="col-md-4">
                  <div class="aa-single-service">
                    <div class="aa-service-icon">
                      <span class="fa fa-briefcase"></span>
                    </div>
                    <div class="aa-single-service-content">
                      <h4><a href="#"><?=show_static_text($lang_id,29);?></a></h4>
                      <p><?=show_static_text($lang_id,37);?></p>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="aa-single-service">
                    <div class="aa-service-icon">
                      <span class="fa fa-check"></span>
                    </div>
                    <div class="aa-single-service-content">
                      <h4><a href="#"><?=show_static_text($lang_id,30);?></a></h4>
                      <p><?=show_static_text($lang_id,34);?></p>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="aa-single-service">
                    <div class="aa-service-icon">
                      <span class="fa fa-bar-chart-o"></span>
                    </div>
                    <div class="aa-single-service-content">
                      <h4><a href="#"><?=show_static_text($lang_id,31);?></a></h4>
                      <p><?=show_static_text($lang_id,35);?></p>
                    </div>
                  </div>
                </div>                
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- / Service section -->



  <!-- Client Testimonial -->
<?php $this->load->view('templates/includes/home_testimonial'); ?>    
  <!-- Client Testimonial -->

  <!-- Client brand -->
  <!--<section id="aa-client-brand">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-client-brand-area">
            <ul class="aa-client-brand-slider">
              <li>
                <div class="aa-client-single-brand">
                  <img src="assets/frontend/img/client-brand-1.png" alt="brand image">
                </div>
              </li>
              <li>
                <div class="aa-client-single-brand">
                  <img src="assets/frontend/img/client-brand-2.png" alt="brand image">
                </div>
              </li>
              <li>
                <div class="aa-client-single-brand">
                  <img src="assets/frontend/img/client-brand-3.png" alt="brand image">
                </div>
              </li>
              <li>
                <div class="aa-client-single-brand">
                  <img src="assets/frontend/img/client-brand-5.png" alt="brand image">
                </div>
              </li>
              <li>
                <div class="aa-client-single-brand">
                  <img src="assets/frontend/img/client-brand-4.png" alt="brand image">
                </div>
              </li>
               <li>
                <div class="aa-client-single-brand">
                  <img src="assets/frontend/img/client-brand-1.png" alt="brand image">
                </div>
              </li>
              <li>
                <div class="aa-client-single-brand">
                  <img src="assets/frontend/img/client-brand-2.png" alt="brand image">
                </div>
              </li>
              <li>
                <div class="aa-client-single-brand">
                  <img src="assets/frontend/img/client-brand-3.png" alt="brand image">
                </div>
              </li>
              <li>
                <div class="aa-client-single-brand">
                  <img src="assets/frontend/img/client-brand-5.png" alt="brand image">
                </div>
              </li>
              <li>
                <div class="aa-client-single-brand">
                  <img src="assets/frontend/img/client-brand-4.png" alt="brand image">
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>-->
  <!-- / Client brand -->


  <!-- Footer -->
<?php $this->load->view('templates/includes/footer'); ?>  
  <!-- / Footer -->
<!--<script>
jQuery(function(){

      if(jQuery('body').is('.aa-price-range')){

        var skipSlider2 = document.getElementById('aa-price-range');
        noUiSlider.create(skipSlider2, {
            range: {
                'min': 0,
                '10%': 100,
                '20%': 200,
                '30%': 300,
                '40%': 400,
                '50%': 500,
                '60%': 600,
                '70%': 700,
                '80%': 800,
                '90%': 900,
                'max': 1000
            },
            snap: true,
            connect: true,
            start: [200, 700]
        });
        // for value print
        var skipValues2 = [
          document.getElementById('skip-value-lower2'),
          document.getElementById('skip-value-upper2')
        ];

        skipSlider2.noUiSlider.on('update', function( values, handle ) {
			console.log(values[handle]);
			console.log(values);
			if(handle==0){
				$('#min-price').val(values[0]);
			}
			else{
				$('#max-price').val(values[1]);
			}
          skipValues2[handle].innerHTML = values[handle];
        });
      }
});
</script>-->

<script>
function get_region(id){	
	$.ajax({
		type:"POST",
		url:"ajax_product/getRegion",
		data:{id:id,<?=$this->security->get_csrf_token_name();?>:'<?=$this->security->get_csrf_hash();?>'},
		dataType: 'json',
		success: function(json) {	
			if(json.status=='ok'){
				$('#input-region').html(json.msge);
			}
			if(json.status=='error'){
				$('#input-region').html('<option value="">Select</option>');
			}
		}
	});
}

function get_city(id){	
	$.ajax({
		type:"POST",
		url:"ajax_product/getCities",
		data:{id:id,<?=$this->security->get_csrf_token_name();?>:'<?=$this->security->get_csrf_hash();?>'},
		dataType: 'json',
		success: function(json) {	
			if(json.status=='ok'){
				$('#input-city').html(json.msge);
			}
			if(json.status=='error'){
				$('#input-city').html('<option value="">Select</option>');
			}
		}
	});
}
function get_address(id){	
	$.ajax({
		type:"POST",
		url:"ajax_product/getAddress",
		data:{id:id,<?=$this->security->get_csrf_token_name();?>:'<?=$this->security->get_csrf_hash();?>'},
		dataType: 'json',
		success: function(json) {	
			if(json.status=='ok'){
				$('#input-address').html(json.msge);
			}
			if(json.status=='error'){
				$('#input-address').html('<option value="">Select</option>');
			}
		}
	});
}
</script>


  </body>
</html>