<?php
if($settings['chat_option']==1){
?>

<div class="sns-toolbar" id="sns_toolbar">
	<ul>
		<li class="" style=""> 
			<span class="btn button" title="Online Chat" id="top_tab"><i class="fa fa-comments-o"></i> </span> 
        </li>		
	</ul>
</div>

<style>
#sns_toolbar {
  bottom: 38px;
  color: #fff;
  position: fixed;
  right: 57px;
  z-index: 50;
}
#sns_toolbar ul {
  list-style: outside none none;
  margin: 0;
  padding: 0;
}
#sns_toolbar ul li {
  background: #FF871C;
  border-radius: 10%;

  display: block;
  float: left;
  height: 33px;
  padding: 0 !important;
  text-align: center;
  transition: all 0.15s ease 0s;
  width: 35px;
}
#sns_toolbar .button {
  border: medium none;
/*  border-radius: 50%;*/
  opacity: 1;
  padding: 0;
  text-transform: none;
}
#sns_toolbar ul li i {
  background: #FF871C;
  border-radius:none;
  color: #FFF;
  display: block;
  font-size: 20px;
  height: 36px;
  line-height: 33px;
  margin: 0;
  width: 36px;
}
</style>


<!--chat-content-->
<link rel="stylesheet" href="assets/plugins/chat/new_chat.css" type="text/css" />
<script type="text/javascript">
interval =null;

$(document).ready(function(){
/*	$("#btn-input").keyup(function(e) {	 
    	var code = e.keyCode || e.which;
      	if(code == 13) { //Enter keycode
			$("#submitForm").trigger("submit");
      	}     
	});		*/
});

function read_it(){ 
	$.post("guest_chat/read_it"); // Sends request to update.php 
}

function getMgse(){ 
	girl_id = $('#user_id').val();
	$('.refresh').load('guest_chat/views/'+girl_id);
	$("section").animate({ scrollTop: $('.refresh').height() }, 1000);
}

$.ajaxSetup({
	cache: false	
});
	
$(function() {	
	$('#submitForm').submit(function(){
		var user_id = $('#chatUserID').val();
		var username = $('#chatUserName').val();
		var message = $.trim($('#btn-input').val());
	//	$('.fa-comments-o').css('background-color','#e74c3c');
/*		var recipient_id = $('#user_id').val();
		var recipient = $('#user_name').val();*/
		if (message == "" || message == "Say something"||message==null) {
			$('#btn-input').val('');
			return false;
		}
		//var dataString = 'user_id=' + user_id + '&user_name=' + username + '&message=' + message + '&recipient_id=' + recipient_id + '&recipient=' + recipient;
		var dataString = 'user_id=' + user_id + '&user_name=' + username + '&message=' + message;
		
		$.ajax({
			type: "POST",
			url: "guest_chat/send_chat",
			data: {user_id:user_id,user_name:username,message:message,<?=$this->security->get_csrf_token_name();?>:'<?=$this->security->get_csrf_hash();?>'},
			success: function() {
				$('#btn-input').val('');
				//document.newMessage.btn-input.value = "";
			}
		});
		return false;
	});
});

function show_data1(name){
	$.ajax({
	   type: "POST",
	   url: "<?=$lang_code?>/guest_chat/"+name,  
	   beforeSend: function () {
		  $(".listBox").html("Loading ...");
		},
	   success: function(msg){
			$(".listBox").html(msg);
	   }
	});
}


</script>

<?php
if(isset($user_chat)){
?>
<script>
$( document ).ready(function() {
	interval = setInterval(getMgse,2000);
});
</script>
<?php
}
?>
<script>
$( document ).ready(function() {
	$( "#chat_forms" ).submit(function() {
		var fname = $('#chat_name').val();
/*		var email = $('#chat_email').val();*/
		$.ajax({
				type:"POST",
				dataType: "json",
				url:"guest_chat/chat_login",
				//data:{email:email,name:fname,operation:'set'},
				data:{name:fname,operation:'set',<?=$this->security->get_csrf_token_name();?>:'<?=$this->security->get_csrf_hash();?>'},
				success:function(data){
					if(data['result']=='success'){
						interval = setInterval(getMgse,2000);
						$('.chat_login_form').hide();
						$('.panel-footer').show();
					}
				}
		});
	return false;	
	});
});
function logout(){
		$.ajax({
			type: "GET",
			url: "guest_chat/logout",
			success: function() {
				clearInterval(interval); // stop the interval	
				$('#chat_window_1 .refresh').html('');
				$('.panel-footer').hide();
				$('#chat_forms').show();
				
				console.log('asda');

				//document.newMessage.btn-input.value = "";
			}
		});

}

</script>


<script>
$(document).on('click', '.panel-heading span.icon_minim', function (e) {
    var $this = $(this);
    if (!$this.hasClass('panel-collapsed')) {
        $this.parents('.panel').find('.panel-body').slideUp();
        $this.addClass('panel-collapsed');
        $this.removeClass('glyphicon-minus').addClass('glyphicon-plus');
    } else {
        $this.parents('.panel').find('.panel-body').slideDown();
        $this.removeClass('panel-collapsed');
        $this.removeClass('glyphicon-plus').addClass('glyphicon-minus');
    }
	
});
$(document).on('focus', '.panel-footer input.chat_input', function (e) {
    var $this = $(this);
    if ($('#minim_chat_window').hasClass('panel-collapsed')) {
        $this.parents('.panel').find('.panel-body').slideDown();
        $('#minim_chat_window').removeClass('panel-collapsed');
        $('#minim_chat_window').removeClass('glyphicon-plus').addClass('glyphicon-minus');
    }
});
$(document).on('click', '#new_chat', function (e) {
    var size = $( ".chat-window:last-child" ).css("margin-left");
     size_total = parseInt(size) + 400;
    alert(size_total);
    var clone = $( "#chat_window_1" ).clone().appendTo( ".container" );
    clone.css("margin-left", size_total);
});
/*$(document).on('click', '.icon_close', function (e) {
    //$(this).parent().parent().parent().parent().remove();
    $( "#chat_window_1" ).remove();
});*/

</script>

<script>
//Function show and hide download.
$(function(){
  var $tab = $('#top_tab'),$tab_close = $('#tab_close'),
	  $panel1 =$('#chat_window_1').hide();
	  //$panel1 =$('#chat_window_1');
  var toggle = true;
  $tab.on('click', function() {
        if (toggle) {
            $tab.stop().animate({},500, function (){});
            $panel1
                .stop()
                .animate({
                    opacity: 1
                }, 500, function(){
                    $panel1.slideDown('slow');
                });    
        } else {
            $panel1.slideUp('slow', function() {
                $panel1
                    .stop()
                    .animate({
                        opacity: 0
                    },500);    
            });
        }
        toggle = !toggle;
  });
  
  $tab_close.on('click', function() {
        if (!toggle) {
            $panel1.slideUp('slow', function() {
                $panel1
                    .stop()
                    .animate({
                        opacity: 0
                    },500);    
            });
        }
        toggle = !toggle;
  });

});
</script>

<style>
.chat-window {
	right: 84px;
	z-index:10;
}
</style>
<style>
.chat-window{
	z-index:10;
}
.panel-default > .panel-heading {
  background-color: #FF871C;
  border-color: #FF871C;
  color: #333;
}
.panel-title,#minim_chat_window{
	color:#FFF;
}
#chat_window_1 .panel-heading  {
/*  background: #3498DB;*/
  color: white;
  overflow: hidden;
  padding: 10px;
  position: relative;
}
</style>
<div class="" style="">
    <div class="row chat-window col-xs-10 col-md-3" id="chat_window_1"  style="display:none">
        <div class="col-xs-12 col-md-12">
        	<div class="panel panel-default">
                <div class="panel-heading ">
                    <div class="col-md-8 col-xs-8">
                        <h3 class="panel-title"><span class="fa fa-comment" style=""></span> Chat  - <span id="admin_onilne" style="color:#71CD64;font-weight:bold">Online</span></h3>
                    </div>
                    <div class="col-md-4 col-xs-4" style="text-align: right;">
                    
                        <a href="javascript:void(0)"><span id="minim_chat_window" class="fa fa-minus icon_minim"></span></a>
                    </div>
                </div>
                
                <div class="panel-body msg_container_base" style="" >
                    <div class="refresh"></div> 
<?php
if(!isset($user_chat)){
	$chat_form ='display:none';
}
else{
	$chat_form ='';
}
?>
<form role="form" action="" method="post"  id="chat_forms" class="chat_login_form" style=" <?=isset($user_chat)?'display: none':''?>">
                	<input type="hidden" name="operation" value="set">
                    <div class="col-lg-12">
                  
                    <div class="form-group">
                        <label for="InputName">Name</label>
                        <div class="">
                            <input type="text" class="form-control" name="name" id="chat_name" placeholder="Name" required>
                        </div>
                    </div>                    
                                          
                  <input type="submit" name="submit" id="submit" value="Enter" class="btn btn-gold pull-right">
                </div>
			  </form>
                </div>
                <div class="panel-footer" style=" <?=$chat_form?>" >
                    <form action="#" class="m-b-none" id="submitForm" method="post" onSubmit="return false">
                        <input name="chatUserID" type="hidden" id="chatUserID" value="<?=isset($user_chat)?$user_chat['id']:'';?>"/>
                        <input name="chatUserName" type="hidden" id="chatUserName" value="<?=isset($user_chat)?$user_chat['name']:'';?>"/>
	                    <div class="input-group">
                        <input id="btn-input" type="text" class="form-control input-sm chat_input" placeholder="Write your message here..." style="height:37px" />
                        <span class="input-group-btn">
                        <button class="btn btn-red btn-sm" id="btn-chat">Send</button>
                        </span>
                    </div>
                    </form>
                </div>
    		</div>
        </div>
    </div>
        
</div>

<?php
}
?>

