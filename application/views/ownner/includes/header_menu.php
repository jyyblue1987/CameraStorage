<?php
$year_amount = $month_amount =0;
$string = "SELECT SUM(amount) as amount FROM camera_payment WHERE payment = 1 and is_refund=0 and owner_id =".$this->data['user_details']->id." AND MONTH(on_date) = '".date('m')."' AND YEAR(on_date)='".date('Y')."' GROUP BY YEAR(on_date) AND MONTH(on_date);";
$month_result = $this->comman_model->get_query($string,true);
if($month_result){
	$month_amount = round($month_result->amount,2);
}

$string = "SELECT SUM(amount) as amount FROM camera_payment WHERE payment = 1 and is_refund=0 and owner_id =".$this->data['user_details']->id." AND  YEAR(on_date)='".date('Y')."' GROUP BY YEAR(on_date)";
$month_result = $this->comman_model->get_query($string,true);
if($month_result){
	$year_amount = round($month_result->amount,2);
}
?>

<style>
.navbar-default .navbar-brand{
	background:#454E57;
	color:#FFF;
	font-size:17px;
	font-weight:600;
}
.navbar-default .navbar-brand:hover{
	background:#454E57;
	color:#FFF;
}
@media (max-width: 468px) {
	.hidden-ss{
		display:none;
	}
}
.navbar-brand {
  line-height: 27px;
  padding: 0 20px;
  text-align:center;
}

.navbar-brand  span{
  font-size:15px;
  color:#FF871C;
}

</style>
		<!-- begin #header -->
		<div id="header" class="header navbar navbar-default navbar-fixed-top">
			<!-- begin container-fluid -->
			<div class="container-fluid">
				<!-- begin mobile sidebar expand / collapse button -->
				<div class="navbar-header">
					<a href="<?=$_user_link.'/account'?>" class="navbar-brand"><?=$settings['site_name']?><br><span style="">Dealer Control Panel</span></a>
					<button type="button" class="navbar-toggle" data-click="sidebar-toggled">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
<?php
if(empty($user_details->logo)){
?>
<a href="http://www.ilinkpro.com" target="_blank" class="hidden-ss" ><img src="<?='assets/uploads/sites/'.$settings['logo']?>" style="width:100px;height:53px" /></a><!--user for hide hidden-ss-->
<?php
}
else{
?>
<a href="http://www.ilinkpro.com" target="_blank"  class="hidden-ss" ><img src="<?='assets/uploads/users/thumbnails/'.$user_details->logo?>" style="width:100px;height:53px" /></a><!--user for hide hidden-ss-->
<?php
}
?>
				</div>
				<!-- end mobile sidebar expand / collapse button -->

<?php
if(empty($user_details->logo)){
}
else{
?>
<a href="javascript:" class="hidden-md  hidden-lg" ><img src="<?='assets/uploads/users/thumbnails/'.$user_details->logo?>" style="width:100px;height:53px" /></a><!--user for hide hidden-ss-->
<?php
}
?>
				
				<!-- begin header navigation right -->
				<ul class="nav navbar-nav navbar-right">
                    
<!--					<li class="hidden-xs">
						<a href="<?=$_user_link.'/condition'?>" class="">
							<span class="">Terms and Conditions</span>
						</a>
					</li>-->
					<li class="hidden-xs">
						<a href="<?=$_user_link.'/supports'?>" class="">
							<span class="">Support</span>
						</a>
					</li>
            <!--<li class="hidden-xs">
                <a href="javascript:void(0);" data-toggle="modal" data-target="#referralModal" ><span class="title"><?=show_static_text($lang_id,1050);?>Referrals</span></a>
            </li>-->

<li class="hidden-xs" style="" >
						<a href="javascript:;" style="padding-left:0;padding-right:0">
<?php
if($user_details->c_num!=0){
	$total_camera = 0;
	$use_camera = count($this->comman_model->get_by('users',array('parent_id'=>$this->data['user_details']->id,'account_type'=>'A','is_f_c'=>1),false,false,false));
	if($use_camera>0){
		if($user_details->c_num>$use_camera){
			$total_camera = $user_details->c_num-$use_camera;
		}
	}
	if($total_camera){
?>
<strong>Free Camera</strong> : <?=$user_details->c_num.' camera' ?> &nbsp;
<?php
if($user_details->c_days!=0){
	if($user_details->c_days==-1){
?>
	<strong>For Days</strong> : <?='For Life' ?> &nbsp;
<?php
	}
	else{
?>
	<strong>For Days</strong> : <?=$user_details->c_days.' days' ?> &nbsp;
<?php
	}
}
	}
}
?>
<strong><?=show_static_text($lang_id,1300);?>Outstanding Amount</strong> : $<?=($user_details->total_point)?> (<?=date('M')?>)&nbsp;&nbsp;
<strong><?=show_static_text($lang_id,2050);?>Your Income</strong> : $<?=$month_amount?> (<?=date('M')?>) / $<?=$year_amount?> (<?=date('Y')?>)&nbsp;&nbsp;&nbsp;
</a>
					</li>					
					
                    <li class="dropdown navbar-user">
						<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
							<img src="<?=!empty($user_details->image)?'assets/uploads/users/thumbnails/'.$user_details->image:'assets/uploads/profile.jpg'?>" alt="" /> 
							<span class="hidden-xs"><?=$user_details->username;?>
</span> <b class="caret"></b>
						</a>
						<ul class="dropdown-menu animated fadeInLeft">
							<li class="arrow"></li>
							<li><a href="<?=$_user_link.'/account/edit_profile'?>"><?=show_static_text($lang_id,59);?></a></li>
							<li><a href="<?=$_user_link.'/account/change_password'?>"><?=show_static_text($lang_id,50);?></a></li>
							<li class="divider"></li>
							<li><a href="<?=$_user_link.'/account/logout'?>"><?=show_static_text($lang_id,57);?></a></li>
						</ul>
					</li>
<!--      <li>				
		<a href="#menu-toggle" id="menu-toggle"><i class="fa fa-comments"></i></a>
	  </li>-->

				</ul>
				<!-- end header navigation right -->
			</div>
			<!-- end container-fluid -->
		</div>
		<!-- end #header -->



<script>
function load_current_lang(){
	var currlang = $('.language_section').find('li.active').text();
	$('language_section').find('li.active').hide();
	$('.current_lang').html(currlang+'<i class="caret"></i>');
}
load_current_lang();

</script>

<script>
function setLang(id,links){
	$.ajax({
		type:"POST",
		url:"<?=site_url($_user_link.'/account/setLang')?>",
		data:{id:id,<?=$this->security->get_csrf_token_name();?>:'<?=$this->security->get_csrf_hash();?>'},
		dataType: 'json',
		success: function(json) {	
			if(json.status=='ok'){
				window.location = links;
			}
			else{
				window.location = links;
			}
		}
	});
}
</script>