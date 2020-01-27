<?php $this->load->view('templates/includes/header.php'); ?>
<style>
#aa-property-header{
	background-image: url("<?='assets/uploads/sites/'.$settings['background'];?>");
/*	background:url('assets/frontend/img/account_bg3.jpg');*/
	background-repeat:no-repeat;
	background-attachment: fixed;
	background-position: center center;
	background-size: cover;
}
#aa-property-header{
	padding:14% 0 7%;
}
@media (max-width: 991px) {
	#aa-property-header{
		padding:57px 0 0%;
	}
}

</style>
<body class="">
<?php $this->load->view('templates/includes/menu.php'); ?>
<section id="aa-property-header" style="">
<div class="container">
    <div class="row" >
     <div class="col-md-12" >
<?php
if($this->session->flashdata('success')) {
$msg = $this->session->flashdata('success');
?>
<div class="alert alert-success"><?php echo $msg;?></div>
<?php	
}
if($this->session->flashdata('error')) {
$msg = $this->session->flashdata('error');
?>
<div class="alert alert-danger"><?php echo $msg;?></div>
<?php
}   
?>
<div class="row">    
    <div class="col-md-offset-3 col-md-6 col-xs-12">
        <div class="well">
    <?php //echo validation_errors();?>   
            <form method="post" action="<?=$lang_code.'/secure/login'?>" id="customer_login" accept-charset="UTF-8">
            <input type="hidden" name="<?=$this->security->get_csrf_token_name(); ?>" value="<?=$this->security->get_csrf_hash();?>" />
            <input type="hidden" name="operation" value="set"  /> 
                  <div class="form-group">
                      <label for="username" class="control-label"><?=show_static_text($lang_id,111);?></label>
                      <input type="text" class="form-control" id="username" name="email" value="<?=isset($c_email)?$c_email:''?>" required="" autofocus>
                      <span style="color:#F00;"><?php echo form_error('email'); ?></span>
                  </div>
                  <div class="form-group">
                      <label for="password" class="control-label"><?=show_static_text($lang_id,20);?></label>
                      <input type="password" class="form-control passwords" id="password" name="password" value="<?=isset($c_pass)?$c_pass:''?>" required="">
                      <span style="color:#F00;"><?php echo form_error('password'); ?></span>
                  </div>                      
                      <div class="form-group">
                          <input type="checkbox" name="remember_me" value="1"> Remember Me
                      </div>                      
                                                                          
                  <button type="submit" class="btn btn-red btn-block"><?=show_static_text($lang_id,2);?></button>
                  <div style="margin-top:10px">
                    <a class="forgot" href="<?=$lang_code.'/secure/forgot'?>" ><?=show_static_text($lang_id,24);?></a>
                  </div>
              </form>
          </div><!--//well//-->
      </div><!--///col-xs-6/-->
</div><!--//row//-->    
    </div>    
    </div><!--row-->
   </div>
 </section>
 
<?php $this->load->view('templates/includes/footer.php'); ?>
<script>
ajaxSendMail();
function ajaxSendMail(){
	$.ajax({
		type: 'GET',
		url : "<?='ajax_send/ajax32'?>",
		cache : false,
		dataType:'json',
		success: function(data){
			console.log('ok');
		}
	});
}

</script>

<script src="assets/plugins/bootstrap-show-password/bootstrap-show-password.js"></script>

<script>
    $(function() {
      $('#password').password()
      .password('focus')
      .on('show.bs.password', function(e) {
      }).on('hide.bs.password', function(e) {
      });
      $('#methods').click(function() {
        $('#password').password('toggle');
      });
    });
  </script>

  </body>
</html>