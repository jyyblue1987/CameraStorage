<?php $this->load->view('templates/includes/header'); ?>
<style>
#aa-property-header{
	background-image: url("<?='assets/uploads/sites/'.$settings['r_background'];?>");
/*	background:url('assets/frontend/img/account_bg3.jpg');*/
	background-repeat:no-repeat;
	background-attachment: fixed;
	background-position: center center;
	background-size: cover;
	min-height:auto;
}

#aa-property-header .aa-property-header-inner {
  padding: 128px 0 10px;
}
@media (max-width: 991px) {
	#aa-property-header{
		min-height:auto;		
	}
	#aa-property-header .aa-property-header-inner {
 		padding: 120px 0 30px;
	}
}

.d-title{
	margin-top:5px !important;
}
#aa-contact {
	padding:34px 0;
}
</style>
<body class="">
<?php $this->load->view('templates/includes/d_menu'); ?>
<section id="aa-property-header">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-property-header-inner">
            <h2 class="d-title"><?=$dealer_profile->company_name?></h2>
            <ol class="breadcrumb">
            <li><a href="<?=site_url($lang_code.'/l/'.url_title($dealer_profile->company_name, 'dash', true).'/'.$dealer_profile->id)?>"><?=show_static_text($lang_id,10)?></a></li>
            <li class="active"><?=show_static_text($lang_id,1)?></li>
          </ol>
          </div>
        </div>
      </div>
    </div>
  </section>
<div style="clear:both"></div>
<section id="aa-contact">
<div class="container">
    <div class="row">
	    <div class="col-md-12">
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
        
        <?php //echo validation_errors();?>   
      <form method="post" action="" id="customer_login" accept-charset="UTF-8" >
        <input type="hidden" name="<?=$this->security->get_csrf_token_name(); ?>" value="<?=$this->security->get_csrf_hash();?>" />
        <input type="hidden" name="operation" value="set"  /> 
        <div class="row" style="margin-top:10px">
            <div class="col-md-12">
            <div class="row">    	            
        <div class="col-md-4 form-field" >
            <label class="control-label"><?=show_static_text($lang_id,16);?> * </label>
            <div class="">
                <input type="text" class="form-control" title=""  id="lastname" name="first_name" value="<?=set_value('first_name'); ?>" required>
                <span class="error-span"><?php echo form_error('first_name'); ?></span>
            </div>
        </div>
        <div class="col-md-4 form-field" >
            <label class="control-label"><?=show_static_text($lang_id,1007);?>Company</label>
            <div class="">
                <input type="text" class="form-control" title=""  id="lastname" name="company_name" value="<?=set_value('company_name'); ?>" required>
                <span class="error-span"><?php echo form_error('company_name'); ?></span>
            </div>
        </div>                      
    
        <div class="col-md-4 form-field" >
            <label class="control-label"><?=show_static_text($lang_id,18);?> * </label>
            <div class="">
                <input type="email" class="form-control" title=""  id="lastname" name="email" value="<?=set_value('email'); ?>" required>
                <span class="error-span"><?php echo form_error('email'); ?></span>
            </div>
        </div>
    
        
        <div class="hide-data" style="">
            <div class="col-md-4 form-field" >
                <label class="control-label"><?=show_static_text($lang_id,82);?> * </label>
                <div class="">
        
                    <input type="text" class="form-control" title=""  id="lastname" name="phone" value="<?=set_value('phone'); ?>" required>
                    <span class="error-span"><?php echo form_error('phone'); ?></span>
                </div>
            </div>                      
        
            <div class="col-md-4 form-field" >
                <label class="control-label"><?=show_static_text($lang_id,46);?> * </label>
                <div class="">
                        <input type="text" class="form-control" title="" value="<?=set_value('address'); ?>" id="address" name="address" required>
                        <span class="error-span"><?php echo form_error('address'); ?></span>
                </div>
            </div>

            			                       
            <div class="col-md-4 form-field" >
                <label class="control-label"><?=show_static_text($lang_id,84);?> * </label>
                <div class="">
                    <input type="text" id="address" name="city" class="form-control" title="" value="<?=set_value('city'); ?>" required>                
						
                        <span class="error-span"><?php echo form_error('city'); ?></span>
                </div>
            </div>
            
            <div class="col-md-4 form-field" >
                <label class="control-label"><?=show_static_text($lang_id,140);?> * </label>
                <div class="">
                    <input type="text" id="address" name="zip" class="form-control" title="" value="<?=set_value('zip'); ?>" required>                
						
                        <span class="error-span"><?php echo form_error('zip'); ?></span>
                </div>
            </div>
            
            <div class="col-md-4 form-field" >
                <label class="control-label"><?=show_static_text($lang_id,85);?> * </label>
                <div class="">
                    <input type="text" id="address" name="country" class="form-control" title="" value="<?=set_value('country'); ?>" required>                
                    <span class="error-span"><?php echo form_error('country'); ?></span>
                </div>
            </div>


        </div>
        <div class="col-md-4 form-field" >
            <label class="control-label" for=""><?=show_static_text($lang_id,20);?> * </label>
            <div class="input-box">
                <input type="password" class="form-control" title="" id="password" name="password" value="<?=set_value('password'); ?>" required>
                  <span class="error-span"><?php echo form_error('password'); ?></span>
            </div>
        </div>
    
    
        <div class="col-md-4 form-field" >
            <label class="control-label" for=""><?=show_static_text($lang_id,21);?> * </label>
            <div class="input-box">
                <input type="password" class="form-control" id="confirmation" title="" name="confirm" value="<?=set_value('confirm'); ?>" required>
                <span class="error-span"><?php echo form_error('confirm'); ?></span>
            </div>
        </div>
        <div  style="clear:both"></div>		
		<div class="col-md-4 form-field" >
<?php echo $widget;?>
<span class="error-span"><?php echo form_error('code'); ?></span>
<?php echo $script;?>
</div>
        </div>
        
    
        </div>
        </div>
    
      <div class="action-btn">
        <p>
          <input type="submit" class="btn btn-red" value="<?=show_static_text($lang_id,1);?>">
        </p>
      </div>
      </form>
    </div>
    </div>
</div>
</section>
<footer id="aa-footer">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
        <div class="aa-footer-area">
          <div class="row">
            <div class="col-md-12">
              <div class="aa-footer-left text-center">
                <p>© All rights reserved <?=$dealer_profile->company_name;?></p>
              </div>
            </div>
          </div>
        </div>
      </div>
      </div>
    </div>
  </footer>

<style>
.form-field{
	min-height:100px;
}
.error-span p{
	margin-bottom:0px;
	color:#C00;
	font-size:13px;
}
</style>
  </body>
</html>