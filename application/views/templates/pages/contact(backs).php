<?php $this->load->view('templates/includes/header.php'); ?>
  <body>
<?php $this->load->view('templates/includes/menu.php'); ?>
  <section id="single-page-header">
    <div class="overlay">
      <div class="container">
        <div class="row">
          <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="single-page-header-left">
              <h2><?=$page->title?></h2>
            </div>
          </div>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="single-page-header-right">
              <ol class="breadcrumb">
                <li><a href="<?=site_url($lang_code)?>"><?=show_static_text($lang_id,10);?></a></li>
                <li class="active"><?=$page->title?></li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section> 
  <!-- End Proerty header  -->

 <section id="mu-contact" style="padding-top:30px;padding-bottom:30px">
   <div class="container">
     <div class="row">
       <div class="col-md-12">
         <div class="mu-contact-area">
          <!-- start title -->
          <div class="mu-title">
            <h2><?=$page->title?></h2>
				<?=$page->body?>
          </div>
          <!-- end title -->
          <!-- start contact content -->
          <div class="mu-contact-content">           
            <div class="row">
              <div class="col-md-6">
                <div class="mu-contact-left">
                  <form class="contactform" id="contact_form" accept-charset="UTF-8"> 
                <input type="hidden" name="<?=$this->security->get_csrf_token_name(); ?>" value="<?=$this->security->get_csrf_hash();?>" />
                <input type="hidden" name="operation" value="set"  /> 
                      <div class="form-group">
                          <label for="username" class="control-label">Name <span class="required">*</span></label>
                          <input type="text" required="required" size="30" value="" name="author" id="input-name" class="form-control">
                      </div>
                      <div class="form-group">
                          <label for="username" class="control-label">Email <span class="required">*</span></label>
                          <input type="email" required="required" size="30" value="" name="author" id="input-email" class="form-control">
                      </div>

                      <div class="form-group">
                          <label for="username" class="control-label">Telphone <span class="required">*</span></label>
                          <input type="text" required="required" size="30" value="" name="author" id="input-phone" class="form-control">
                      </div>

                      <div class="form-group">
                          <label for="username" class="control-label">Subject <span class="required">*</span></label>
                          <input type="text" required="required" size="30" value="" name="author" id="input-subject" class="form-control">
                      </div>
                                            
                      <div class="form-group">
                          <label for="username" class="control-label">Message</label>
                          <textarea class="form-control" id="input-message" required></textarea>
                      </div>
                      <button type="submit" class="btn btn-success ">Submit</button>                      
                      
                  </form>                  
		            <div class="message ajax-error"></div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="mu-contact-right">
                      <div id="map_canvas" class="gmap"></div><!---/map-->

                </div>
              </div>
            </div>
          </div>
          <!-- end contact content -->
         </div>
       </div>
     </div>
   </div>
 </section>
<?php $this->load->view('templates/includes/footer.php'); ?>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places"></script>
<script type="text/javascript" src="assets/plugins/gmap/jquery.gmap.js"></script> 
<script type="text/javascript" src="assets/plugins/gmap/jquery.ui.map.js"></script>
<script type="text/javascript" charset="utf-8">
$(function(){
	var val = '<?=$settings['gps']?>';
	$('#map_canvas').gmap({ 'center': val,scrollwheel: false ,zoom:13}).bind('init', function(event, map) { 
			
		$('#map_canvas').gmap('addMarker', {
			'position': val, 
		'draggable': false,
		}).mouseover(function() {
			$('#map_canvas').gmap('openInfoWindow', { 'content': '<b><?=$settings['site_name']?></b><p><?=$settings['address']?><br><?=$settings['phone']?></p>' }, this);
        }).mouseout(function() {
            $('#map_canvas').gmap('closeInfoWindow');
        });
	});

	// Detect user location
});
</script>
<style>
.gmap{
    margin-bottom:10px;
    width:100%;
    height:250px;
	
}
</style>

<script>

$( document ).ready(function() {
	$( "#contact_form" ).submit(function() {
		var email = $('#input-email').val();
		var name = $('#input-name').val();
		var message = $('#input-message').val();
		var subject = $('#input-subject').val();
		var phone = $('#input-phone').val();
		$('.ajax-error').html('sending..');
		$.ajax({
				type:"POST",
				url:"ajax_contact/send_contact",
				data:{email:email,user_name:name,messege:message,subject:subject,phone:phone,lang_id:'<?=$lang_id?>',<?=$this->security->get_csrf_token_name();?>:'<?=$this->security->get_csrf_hash();?>'},
				dataType: 'json',
				success: function(json) {	
					if(json.status=='ok'){
						$('.ajax-error').html(json.msg);
						$("#input-email").val('');
						$("#input-name").val('');
						$("#input-subject").val('');
						$("#input-message").val('');
					}
					if(json.status=='error'){
						$('.ajax-error').html(json.msg);
					}
				}
		});
	return false;	
	});
});
</script>

  </body>
</html>
