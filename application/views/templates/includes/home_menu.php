<?php
if(isset($_COOKIE['email'])&&!empty($_COOKIE['email'])){
	$checkCo = $this->comman_model->get_by('users',array('email'=>$_COOKIE['email']),false,false,true);
	if($checkCo){
		$cookie['email']= $checkCo->email;
		$cookie['password']= $checkCo->password;
	}
}
?>
<style>
#ajax-login-form {
	margin-bottom:0px;
	padding-bottom:2px;
}
#ajax-login-form .form-group{
	vertical-align:top;
}
#ajax-login-form .form-control{
	width:210px;
	display:block;
}
#search-form .form-control{
	width:325px;
}

#search-form{
	margin-left:40px;
	padding:10px 0;
}

@media (max-width:768px) {
	#search-form{
		margin-left:0;
	}
	#search-form .form-control{
		width:100%;
	}

}


</style>
<a class="scrollToTop" href="#">
  <i class="fa fa-angle-up"></i>      
</a>

<!-- Start menu -->
<section id="mu-menu">
<nav class="navbar navbar-default" role="navigation">  
  <div class="container">
    <div class="navbar-header">
      <!-- FOR MOBILE VIEW COLLAPSED BUTTON -->
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <!-- LOGO -->              
      <!-- TEXT BASED LOGO -->
        <a class="brand logo" href="<?=$lang_code?>">
	        <img src="assets/uploads/sites/<?=$settings['logo']?>" alt="<?=$settings['site_name']?>" style="width:100%;height:80px" />
        </a>
        
      <!-- IMG BASED LOGO  -->
      <!-- <a class="navbar-brand" href="index.html"><img src="assets/img/logo.png" alt="logo"></a> -->
    </div>

    <div id="navbar" class="navbar-collapse collapse">
		<form class="navbar-left" role="search" id="search-form" action="<?=$lang_code.'/search'?>">
<div class="form-group">
    <div class="icon-addon addon-md">
        <input type="text" placeholder="Search" class="form-control" id="" name="q" value="<?=$this->input->get('q')?>">
        <label for="email" class="glyphicon glyphicon-search" rel="tooltip" title="Search"></label>
    </div>
</div></form>
		<form class="navbar-form navbar-right" role="search" id="ajax-login-form" action="<?=site_url($lang_code.'/secure/ajax_login');?>">
                <input type="hidden" name="<?=$this->security->get_csrf_token_name(); ?>" value="<?=$this->security->get_csrf_hash();?>" />
                    <div class="form-group">
                        <input type="email" class="form-control" name="email" placeholder="Email" value="<?php echo isset($cookie)?$cookie['email']:'';?>" required>
                        <a href="<?=$lang_code.'/secure/forgot'?>">Forgot your Password</a>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password" placeholder="Password" value="<?php echo isset($cookie)?$cookie['password']:'';?>" required>
                        <input type="checkbox" name="remember" value="1" /> <span style="">Remember Me</span>
                    </div>
                    <button type="submit" class="btn btn-primary " style="">Login</button>
                </form>                           
    </div><!--/.nav-collapse -->        
  </div>     
</nav>
</section>
<!-- End menu -->

<script type="text/javascript">
jQuery(document).ready(function(){

  jQuery('#ajax-login-form').submit(function(e){
/*	if (form.agree.checked) {
		return true;
	}
	else {
		$('.agree-error').html('<?=show_static_text($lang_id,219)?>');
	}
	return false;*/

    e.preventDefault();
    var loadUrl = jQuery('#ajax-login-form').attr('action');
    var data = jQuery('#ajax-login-form').serialize();
    jQuery.post(
        loadUrl,
        data,
        function(result){          
			if(result.status=='ok'){
				window.location= '<?=$lang_code.'/user'?>';
			}
			else{
				alert(result.error);
			}
        },
        'json'
    );

  });
	return false;
});

</script>