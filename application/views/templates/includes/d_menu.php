<!-- SCROLL TOP BUTTON -->
<a class="scrollToTop" href="#"><i class="fa fa-angle-double-up"></i></a>
<!-- END SCROLL TOP BUTTON -->

<!-- Start header section -->
<header id="aa-header">  
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="aa-header-area">
        <div class="row">
          <div class="col-md-6 col-sm-6 col-xs-6">
            <div class="aa-header-left">
<!--              <div class="aa-telephone-no">
                <span class="fa fa-phone"></span>
                1-900-523-3564
              </div>
              <div class="aa-email hidden-xs">
                <span class="fa fa-envelope-o"></span> info@markups.com
              </div>-->

<div class="">
<ul class="list-inline">
<?php
if(isset($print_lang_menu)&&!empty($print_lang_menu)){
	foreach($print_lang_menu as $set_lang){
		$uri = $this->uri->uri_string();
		$exploded = explode('/', $uri);
		$exploded[0] = $set_lang['code'];
		$uri = implode('/',$exploded);
		$getData = parse_url($_SERVER['REQUEST_URI']);
		if(isset($getData['query'])){
			$uri = $uri.'?'.$getData['query'];
		}
?>
<li><a href="<?php echo $uri;?>" title="<?=$set_lang['language'];?>"> 
<img src="assets/uploads/language/<?php echo $set_lang['image']?>" alt="<?php echo $set_lang['language'];?>" title="<?php echo $set_lang['language'];?>" style="height:17px;width:25px;"  />
</a></li>
<?php		
	}
}
?>
</ul>

            </div>              
            </div>              
          </div>
          <div class="col-md-6 col-sm-6 col-xs-6">
            <div class="aa-header-right">
<?php
if(isset($user_details)){
	if($user_details->account_type=='D'){
?>
<a href="<?=$lang_code.'/dealer'?>" class="aa-register"><?=show_static_text($lang_id,14);?></a>
<a href="<?=$lang_code.'/dealer/account/logout'?>" class="aa-login"><?=show_static_text($lang_id,57);?></a>
<?php
	}
	else if($user_details->account_type=='A'||$user_details->account_type=='C'){
?>
<a href="<?=$lang_code?>/member" class="aa-register"><?=show_static_text($lang_id,14);?></a>
<a href="<?=$lang_code?>/member/account/logout" class="aa-login"><?=show_static_text($lang_id,57);?></a>
<?php
	}
	else if($user_details->account_type=='E'){
?>
<a href="<?=$lang_code?>/staff" class="aa-register"><?=show_static_text($lang_id,14);?></a>
<a href="<?=$lang_code?>/staff/account/logout" class="aa-login"><?=show_static_text($lang_id,57);?></a>
<?php
	}
	else if($user_details->account_type=='P'||$user_details->account_type=='B'||$user_details->account_type=='N'){
?>
<a href="<?=$lang_code?>/user" class="aa-register"><?=show_static_text($lang_id,14);?></a>
<a href="<?=$lang_code?>/user/account/logout" class="aa-login"><?=show_static_text($lang_id,57);?></a>
<?php
	}
	else{
?>                    
<!--  <a href="<?=site_url($lang_code.'/secure/register');?>" class="aa-register"><?=show_static_text($lang_id,1);?></a>
  <a href="<?=site_url($lang_code.'/secure/login');?>" class="aa-login"><?=show_static_text($lang_id,2);?></a>-->
<?php
}
}
else{
?>                    
<!--  <a href="<?=site_url($lang_code.'/secure/register');?>" class="aa-register"><?=show_static_text($lang_id,1);?></a>
  <a href="<?=site_url($lang_code.'/secure/login');?>" class="aa-login"><?=show_static_text($lang_id,2);?></a>-->
<?php
}
?>                    
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</header>
<!-- End header section -->

<section id="aa-menu-area">
    <nav class="navbar navbar-default main-navbar" role="navigation">  
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
          <!-- Text based logo -->
<?php
if(!empty($dealer_profile->logo)){
	$checkWebsiteLink = print_value('users_support',array('user_id'=>$dealer_profile->id),'website','no');
	if(!empty($checkWebsiteLink)&&$checkWebsiteLink!='no'){
		$Wlink = $checkWebsiteLink;
	}
	else{
		$Wlink = $lang_code;
	}
?>
<a class="navbar-brand aa-logo-img" href="<?=$Wlink?>"><img src="<?='assets/uploads/users/thumbnails/'.$dealer_profile->logo?>" style="width:100px;height:53px" /></a>
<?php
}
?>        
           <!-- Image based logo -->
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul id="top-menu" class="nav navbar-nav navbar-right aa-main-nav">
            <li class=""><a href="<?=site_url($lang_code.'/l/'.url_title($dealer_profile->company_name, 'dash', true).'/'.$dealer_profile->id)?>"><?=show_static_text($lang_id,10);?></a></li>
        <li ><a href="<?=$lang_code.'/l/'.url_title($dealer_profile->company_name, 'dash', true).'/'.$dealer_profile->id.'?contact=view';?>" title="">Contact Us</a></li>

             
          </ul>                            
        </div><!--/.nav-collapse -->       
      </div>          
    </nav> 
  </section>