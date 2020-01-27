<?php $this->load->view('templates/includes/header'); ?>
<body>
<?php $this->load->view('templates/includes/menu'); ?>
  
  <!-- End search box -->
 <!-- Page breadcrumb -->
 <section id="mu-page-breadcrumb">
   <div class="container">
     <div class="row">
       <div class="col-md-12">
         <div class="mu-page-breadcrumb-area">
           <h2><?=$page->title?></h2>
           <ol class="breadcrumb">
            <li><a href="<?=$lang_code?>">Home</a></li>            
            <li class="active"><?=$page->title?></li>
          </ol>
         </div>
       </div>
     </div>
   </div>
 </section>
 <!-- End breadcrumb -->

 <!-- Start contact  -->
 
 <!-- End contact  -->
 
<?php $this->load->view('templates/includes/footer'); ?>
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