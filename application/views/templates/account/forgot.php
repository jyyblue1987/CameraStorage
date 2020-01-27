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
	padding:14% 0 13%;
}
@media (max-width: 991px) {
	#aa-property-header{
		padding:142px 0 0%;
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
            <form method="post" action="" id="customer_login" accept-charset="UTF-8">
                <input type="hidden" name="<?=$this->security->get_csrf_token_name(); ?>" value="<?=$this->security->get_csrf_hash();?>" />
                <input type="hidden" name="operation" value="set"  /> 
                      <div class="form-group">
						<div class="col-md-12 form-field" style="margin-bottom:10px;">
                          <label for="username" class="control-label"><?=show_static_text($lang_id,111);?></label>
                          <input type="text" class="form-control" id="username" name="email" value="" required="" >
			              <span style="color:#F00;"><?php echo form_error('email'); ?></span>
                          </div>
                      </div>
                    <div  style="clear:both"></div>		
					<div class="col-md-4 form-field"  style="margin-bottom:10px;">
<?php echo $widget;?>
<span class="error-span"><?php echo form_error('code'); ?></span>
<?php echo $script;?>
</div>
                    <div  style="clear:both"></div>		
					<div class="col-md-12">
                                                                              
                      <button type="submit" class="btn btn-red btn-block"><?=show_static_text($lang_id,56);?></button>
					</div>                      
                      <div style="margin-top:10px">
					  	<a class="forgot" href="<?=$lang_code.'/secure/login'?>" ><?=show_static_text($lang_id,2);?></a>
<!--					  	<a class="forgot" href="<?=$lang_code.'/secure/register'?>" ><?=show_static_text($lang_id,1);?></a>-->
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

  </body>
</html>
