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

@media (max-width: 768px) {
	.page-header-fixed {
	  padding-top: 102px;
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
					<a href="<?=$_user_link.'/account'?>" class="navbar-brand"><?=$settings['site_name']?><br><span style="">Client Control Panel</span></a>
					<button type="button" class="navbar-toggle" data-click="sidebar-toggled">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>

<?php
$memU = $this->comman_model->get_by('users',array('id'=>$user_details->parent_id),false,false,true);
if($memU){
	$DD = $this->comman_model->get_by('users',array('id'=>$memU->parent_id),false,false,true);
	$dSupport = $this->comman_model->get_by('users_support',array('user_id'=>$memU->parent_id),false,false,true);
	$wLink = 'javascript:';
	if(empty($Dimage)||$Dimage=='-'){
	}
	else{
		$wLink = $wLinkD;
	}

if($DD){
	if(!empty($DD->logo)){
?>
<a href="<?=$dSupport?$dSupport->website:'javascript:'?>"  target="_blank"><img src="<?='assets/uploads/users/thumbnails/'.$DD->logo?>" style="width:100px;height:53px" /></a>
<?php
	}

	}
}
?>
				</div>


				<!-- end mobile sidebar expand / collapse button -->
				
				<!-- begin header navigation right -->
				<ul class="nav navbar-nav navbar-right">
					
					<li class="hidden-xs">
						<a href="<?=$_user_link.'/support'?>" class="">
							<span class="">Support Information</span>
						</a>
					</li>

                    <li class="dropdown language_section">
<a href="javascript:;" data-toggle="dropdown" class="dropdown-toggle f-s-14 current_lang">

</a>
						<ul class="dropdown-menu media-list pull-right animated fadeInDown" style="max-width: 116px;min-width: 100px;">
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
<li class="<?=$set_lang['code']==$lang_code?'active':''?>"> 
    <a href="javascript:void(0);" onclick="setLang(<?=$set_lang['id']?>,'<?=$uri?>');" title="<?=$set_lang['language'];?>"><img src="assets/uploads/language/<?php echo $set_lang['image']?>" alt="<?php echo $set_lang['language'];?>" title="<?php echo $set_lang['language'];?>" style="height:15px;width:20px;"  /> <?=$set_lang['code'];?></a>
</li>        	
<?php		
	}
}
?>
                            
						</ul>
					</li>

					<li class="dropdown navbar-user">
						<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
							<img src="<?=!empty($user_details->image)?'assets/uploads/users/thumbnails/'.$user_details->image:'assets/uploads/profile.jpg'?>" alt="" /> 
							<span class="hidden-xs"><?=$user_details->first_name.' '.$user_details->last_name;?>
</span> <b class="caret"></b>
						</a>
						<ul class="dropdown-menu animated fadeInLeft">
							<li><a href="<?=$_user_link.'/account/edit_profile'?>"><?=show_static_text($lang_id,59);?></a></li>
							<li><a href="<?=$_user_link.'/account/change_password'?>"><?=show_static_text($lang_id,50);?></a></li>
							<li class="arrow"></li>
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