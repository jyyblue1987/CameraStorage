<h3 style="color:#666666;border-bottom:1px solid #e7e7e7"><?=$name;?></h3>
<?php echo smiley_js();?>

<script type="text/javascript" src="assets/plugins/chats/private.js"></script>	
<script type="text/javascript">
var base = "<?=base_url().'private_chat/';?>";
var base_url = "<?=base_url().'private_chat/';?>";
var csrfTokenName = '<?=$this->security->get_csrf_token_name();?>';
var csrfTokenValue = '<?=$this->security->get_csrf_hash();?>';
load_message_section(<?=$chat_user->id?>);

</script>

<link type="text/css" rel="stylesheet" media="all" href="assets/plugins/chats/private.css">
<style>
.smile-icons table td{
	padding:2px;
}
.smile-icons{
  box-shadow: 0 6px 12px rgba(0, 0, 0, 0.176);
  display: none;
  float: left;
  font-size: 14px;
  right: 0;
  list-style: outside none none;
  margin: 2px 0 0;
  min-width: 160px;
  padding: 5px 0;
  position: absolute;
  text-align: left;
  bottom: 100%;
  top:auto;
  left:auto;
  z-index: 1000;
}
</style>
<?php
$menuCData = $this->comman_model->get_by('theme_settings',array('id'=>7),false,false,true);
if($menuCData){
?>
<style>
#inbox{
	background-color: #<?=$menuCData->background?>;
}
#inbox .chat-body{
	color: #<?=$menuCData->color?>;
	font-size: <?=$menuCData->size.'px'?>;
	font-family:<?=$menuCData->font?>;
}
</style>
<?php
}
?>

<div class="portlet-body" style="margin-top:10px">
<div class="" id="inbox">

<div class="row">
    <div class="col-sm-3">
<?php $this->load->view('user/chat/left_content'); ?>
    </div>
    <div class="col-sm-9" id="userMessageWrapper">
        <div class="col-sm-12">
            <h4 class="display-name"><?=$chat_user->username?></h4>
        </div> 
           
        <hr>
         <div class="Msg_chat_container">
            <div class="Msg_chat-content">
                <input name="Msg_chat_buddy_id" id="Msg_chat_buddy_id" value="<?=$chat_user->id?>" type="hidden">
                <ul class="Msg_chat-box-body"></ul>
            </div>
         </div>
          <hr>
          
          <div class="Msg_chat-textarea">
                <div class="input-group ">
                <input class="form-control" placeholder="Type your message here.." id="textb">
       <div class="input-group-btn">
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><i class="fa fa-smile-o"></i></button>
            <div class="dropdown-menu smile-icons">
                <?=$smiley_table?>
            </div>
      </div><!-- /btn-group -->
        </div>
          </div>

    </div>
              </div>
      </div>    
</div>
