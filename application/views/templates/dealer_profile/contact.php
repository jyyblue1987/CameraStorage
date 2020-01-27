<?php $this->load->view('templates/includes/header'); ?>
<style>
.static-info {
  margin-bottom: 10px;
}
.static-info .name {
  font-size: 14px;
  font-weight: 600;
}
.static-info .value {
  font-size: 14px;
}
</style>

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
            <li class="active">Contact Us</li>
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
      <div class="row">
	<div class="col-md-12">
        <!-- begin panel -->
        <div class="portlet-body">
<?php
if(!empty($view_data->company_name)){
?>
    <div class="row static-info">
        <div class="col-md-3 name"><b><?=show_static_text($lang_id,10000);?>Company Name</b></div>
        <div class="col-md-9 value"><?=$view_data->company_name;?></div>
    </div>    
<?php
}
if(!empty($view_data->contact_name)){
?>

    <div class="row static-info">
        <div class="col-md-3 name"><b><?=show_static_text($lang_id,10000);?>Contact Name</b></div>
        <div class="col-md-9 value"><?=$view_data->contact_name;?></div>
    </div>    
<?php
}
if(!empty($view_data->website)){
?>

    <div class="row static-info">
        <div class="col-md-3 name"><b><?=show_static_text($lang_id,10000);?>Website</b></div>
        <div class="col-md-9 value"><?=$view_data->website;?></div>
    </div>    
<?php
}
if(!empty($view_data->email)){
?>

    <div class="row static-info">
        <div class="col-md-3 name"><b><?=show_static_text($lang_id,10000);?>Email Address</b></div>
        <div class="col-md-9 value"><?=$view_data->email;?></div>
    </div>    
<?php
}
if(!empty($view_data->support_num)){
?>

    <div class="row static-info">
        <div class="col-md-3 name"><b><?=show_static_text($lang_id,10000);?>Support Number</b></div>
        <div class="col-md-9 value"><?=$view_data->support_num;?></div>
    </div>    
<?php
}
if(!empty($view_data->support_hour)){
?>
    <div class="row static-info">
        <div class="col-md-3 name"><b><?=show_static_text($lang_id,10000);?>Support Hour</b></div>
        <div class="col-md-9 value"><?=$view_data->support_hour;?></div>
    </div>    
<?php
}
if(!empty($view_data->business_hour)){
?>
    <div class="row static-info">
        <div class="col-md-3 name"><b><?=show_static_text($lang_id,10000);?>Business Hour</b></div>
        <div class="col-md-9 value"><?=$view_data->business_hour;?></div>
    </div>    
<?php
}
if(!empty($view_data->sales_num)){
?>

    <div class="row static-info">
        <div class="col-md-3 name"><b><?=show_static_text($lang_id,10000);?>Sales Number</b></div>
        <div class="col-md-9 value"><?=$view_data->sales_num;?></div>
    </div>    
<?php
}
if(!empty($view_data->notes)){
?>

    <div class="row static-info">
        <div class="col-md-3 name"><b><?=show_static_text($lang_id,10000);?>Additional Notes</b></div>
        <div class="col-md-9 value"><?=$view_data->notes;?></div>
    </div>    
<?php
}
?>

</div>
        <!-- end panel -->
    </div>   
</div>
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