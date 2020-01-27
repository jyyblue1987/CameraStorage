<button  class="pull-right btn btn-system" onclick="window.location='<?=$lang_code.'/group/l/'.$group_data->id?>'">Status</button>

<h1 style="margin-bottom:20px;"><?=$name?></h1>
<?php echo smiley_js();?>

<!--<script type="text/javascript">
var g_base = "<?=base_url().$_user_link.'/user/group_chat/';?>";
var g_base_url = "<?=base_url().$_user_link.'/user/group_chat/';?>";
var g_group_id = "<?=$view_data->id?>";
var csrfTokenName = '<?=$this->security->get_csrf_token_name();?>';
var csrfTokenValue = '<?=$this->security->get_csrf_hash();?>';
</script>-->

<script type="text/javascript" src="assets/plugins/group_chat/private.js"></script>	
<link type="text/css" rel="stylesheet" media="all" href="assets/plugins/group_chat/private.css">
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

<div class="portlet-body" style="margin-top:10px">
<div class="" id="inbox">
<div class="row">
    <div class="col-sm-4">
<?php $this->load->view('user/group_chat/left_content'); ?>
    </div><!--//col-md-3//-->

    <div class="col-sm-8" id="userMessageWrapper">
        <div class="col-sm-12">
            <h4 class="display-name"></h4>
        </div> 
           
        <hr>
         <div class="Msg_chat_container">
            <div class="Msg_chat-content">
                <input name="Msg_chat_buddy_id" id="Msg_chat_buddy_id" type="hidden">
                <ul class="Msg_chat-box-body"></ul>
            </div>
         </div>
          <hr>
          
          <div class="Msg_chat-textarea" style="display:none">
                <div class="">
                <input class="form-control" placeholder="Type your message here.." id="textb">       
		        </div>
                <!--<div class="input-group ">
                <input class="form-control" placeholder="Type your message here.." id="textb">
       <div class="input-group-btn">
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><i class="fa fa-smile-o"></i></button>
            <div class="dropdown-menu smile-icons">
                <?=$smiley_table?>
            </div>
      </div>
        </div>-->
          </div>
    </div>
                  </div>
          </div>    
</div>
