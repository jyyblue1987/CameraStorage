var blinkOrder = 0;
var originalTitle;
var windowFocus = true;

var msgID = 0;




/*
|-------------------------------------------------------------------------
| Funtion to trigger the refresh event
|-------------------------------------------------------------------------
*/
shChat();

/*----------------------------------------------------------------------
| Function to display individual chatbox
------------------------------------------------------------------------*/





/*----------------------------------------------------------------------
| Function to send message via inbox section
------------------------------------------------------------------------*/

$(document).on('click', '[data-toggle="inboxMsgs"]', function(){  
         userID = $(this).find('input[name="Msguser_id"]').val();
         load_message_section(userID);
});






/*----------------------------------------------------------------------
| Function to send message from inbox section
------------------------------------------------------------------------*/
$(document).ready(function(){

$(".text_message").keyup(function(e) {	 
	var code = e.keyCode || e.which;
	if(code == 13) { //Enter keycode
		//$("#submitForm").trigger("submit");
	}     
});		

$('#submitForm').submit(function(){
	var message = $('.text_message').val();
//	var message = txtarea.val();
	if(message !== ""){
//		txtarea.val('');
		// save the message 
		$.ajax({ 
		type: "POST", 
		url: p_base  + "send_pmessage", 
		data: {message: message,csrf_test_name:csrfTokenValue},
		dataType:'json',
		cache: false,
			success: function(response){
				//console.log('calle');
				$('.text_message').val('');
				//console.log(response.message);
				if(response.success){
					msg = response.message;
					msgID = msg.id;
					li = '<li class="left clearfix">\
					<div class="chat-body clearfix">\
						<div class="">\
							<strong class="primary-font">\
							<img src="'+msg.avatar+'" alt="user" class="img-responvise" style="width:25px;height:25px" /> '+msg.name+'</strong> \
						</div>\
						<p>'+msg.body+'</p>\
					</div></li>';
							$('#chat ul.chat').append(li);
							$('#chat .panel-body').animate({scrollTop: $('#chat .panel-body').prop("scrollHeight")}, 500);
				}
				else{
					login();
				}
			}
		});
	}
});
});







/*----------------------------------------------------------------------------------------------------
| Function to load messages
-------------------------------------------------------------------------------------------------------*/
function hide_data(id){
    $.ajax({
		type: "POST", 
		url: p_base  + "hide_message", 
		data: {message: id,csrf_test_name:csrfTokenValue},
		dataType:'json',
		cache: false,
			success: function(response){
				if(response.success){
					if(response.type=='hide'){
						$('#hide-data-'+id).html('Show');
					}
					else{
						$('#hide-data-'+id).html('Hide');
					}
				}
			}
	});		
}
function shChat()
{
    refresh = setInterval(function()
    {
 
    $.ajax(
        {
            type: 'GET',
            url : p_base + "chat/",
            async : true,
            cache : false,
			data: {msg:msgID},
			dataType:'json',
            success: function(data){
                if(data.success){
//					console.log(data);
					if(data.messages){
	                     thread = data.messages;
						 if(data.msg_id>msgID){
		                     msgID = data.msg_id;
							 $.each(thread, function() {
								if(this.is_public==1){
									set_p_b = '<a id="hide-data-'+this.msg+'" href="javascript:void(0);" onclick="hide_data('+this.msg+');">Hide</a>';
								}
								else{
									set_p_b = '<a id="hide-data-'+this.msg+'" href="javascript:void(0);" onclick="hide_data('+this.msg+');">Show</a>';
								}
								 li = '<li class="left clearfix">\
							<div class="chat-body clearfix">\
								<div class="">\
									<strong class="primary-font">\
									<img src="'+this.avatar+'" alt="user" class="img-responvise" style="height:25px;width:25px" /> '+this.name+'</strong> '+set_p_b+'\
									<small class="pull-right time"><i class="fa fa-clock-o"></i> '+this.time+'</small>\
								</div>\
								<p>'+this.body+'</p>\
							</div></li>';
								$('#chat ul.chat').append(li);
									//Mark this message as read
							 });
							$('#chat .panel-body').animate({scrollTop: $('#chat .panel-body').prop("scrollHeight")}, 500);
						 }
					}
                    //var audio = new Audio('http://localhost/codeigniter/application/assets/notify/notify.mp3').play();
                }
				//check online
				if(data.user_online){
//					console.log('asd');
					onlineStatus =data.user_online;
					$.each(onlineStatus, function(){		
						if(this.status==1){
							$(".chat-group").find('span[online-data="'+this.user_id+'"]').removeClass('is-online');
							$(".chat-group").find('span[online-data="'+this.user_id+'"]').removeClass('is-offline');
							$(".chat-group").find('span[online-data="'+this.user_id+'"]').addClass('is-online');
						}
						else{
							$(".chat-group").find('span[online-data="'+this.user_id+'"]').removeClass('is-online');
							$(".chat-group").find('span[online-data="'+this.user_id+'"]').removeClass('is-offline');
							$(".chat-group").find('span[online-data="'+this.user_id+'"]').addClass('is-offline');
						}
					});
				}
            },
                error : function(XMLHttpRequest, textstatus, error) { 
                            console.log(error); 
                }
        }
    );

       }, 5000);
}

/*----------------------------------------------------------------------
| Function to load threaded messages or user conversation
------------------------------------------------------------------------*/
var limit = 1;
function load_thread(user, limit){
        //send an ajax request to get the user conversation 
       $.ajax({ type: "POST", url: p_base  + "load_messages", data: {user : user, limit:limit,csrf_test_name:csrfTokenValue },cache: false,dataType:'json',            async : true,

        success: function(response){
        if(response.success){
            buddy = response.buddy;
            status = buddy.status == 1 ? 'Online' : 'Offline';
            statusClass = buddy.status == 1 ? 'user-status is-online' : 'user-status is-offline';
//alert(user);
            $('div#chat-box-'+user+' .chat-container input#chat_buddy_id').val(buddy.id);
			
			//$('div#chat-box-'+user+' .chat-container input#chat_buddy_id').css('border','red');
			
            $('div#chat-box-'+user+' .chat-box-header span.display-name').html(buddy.name);
            $('div#chat-box-'+user+' .chat-box-header > small').html(status);
            $('div#chat-box-'+user+' .chat-box-header > span.user-status').removeClass().addClass(statusClass);
//console.log($('div#chat-box-'+user));
            $('ul#chat_box_body_id-'+user).html('');
			//return false;
            if(buddy.more){
             $('ul#chat_box_body_id-'+user).append('<li id="load-more-wrap" style="text-align:center"><a onclick="javascript: load_thread(\''+buddy.id+'\', \''+buddy.limit+'\')" class="btn btn-xs btn-info" style="width:100%">View older messsages('+buddy.remaining+')</a></li>');
            }
 
				if(response.thread){
					thread = response.thread;
					//console.log(response.thread);
					//return false;
					$.each(thread, function() {
					  li = '<li class="'+ this.type +'">\
					  <img src="'+this.avatar+'" class="avt img-responsive">\
						<div class="message">\
						<a href="javascript:void(0)" class="chat-name">'+this.name+'</a>&nbsp;\
						<span class="chat-datetime">at '+this.time+'</span>\
						<span class="chat-body">'+this.body+'</span></div></li>';
	
						$('ul#chat_box_body_id-'+user).append(li);
					});
				}
                if(buddy.scroll){
                    $('div#chat_box_body_id-'+user).animate({
						scrollTop: $('ul#chat_box_body_id-'+user).prop("scrollHeight")
					}, 500);
                }
                
            }
        }});
}





/*----------------------------------------------------------------------
| Function to message inbox section
------------------------------------------------------------------------*/
var limit_msg = 1;
function load_message_section(userID, limit_msg){
	
	$('input.checkbx, #deletemsgbtns').hide();
	
        //send an ajax request to get the user conversation 
       $.ajax({ type: "POST", url: p_base  + "load_messages", data: {user : userID, limit:limit_msg,csrf_test_name:csrfTokenValue },cache: false,
        success: function(response){
        if(response.success){
            user = response.buddy;
            status = user.status == 1 ? 'Online' : 'Offline';
            statusClass = user.status == 1 ? 'user-status is-online' : 'user-status is-offline';

            $('#Msg_chat_buddy_id').val(user.id);
            $('h4.display-name').html(user.name+' ('+status+')');
            //$('.chat-box > .chat-box-header > small').html(status);
            //$('.chat-box > .chat-box-header > span.user-status').removeClass().addClass(statusClass);

            $('ul.Msg_chat-box-body').html('');
            if(user.more){
             $('ul.Msg_chat-box-body').append('<li id="load-more-wrap" style="text-align:center"><a onclick="javascript: load_message_section(\''+user.id+'\', \''+user.limit+'\')" class="btn btn-xs btn-info" style="width:100%">View older messsages('+user.remaining+')</a></li>');
            }
 

                thread = response.thread;
                $.each(thread, function() {
                  li = '<li class="'+ this.type +'" id="msg_'+ this.msg +'">\
				  <input type="checkbox" value="'+ this.msg +'" class="checkbx" name="deleteMsg"/>\
				  <img src="'+p_base_url+'application/uploads/users/'+this.avatar+'" class="avt img-responsive">\
                    <div class="message">\
                    <a class="chat-name">'+this.name+'</a>&nbsp;\
                    <span class="chat-datetime">at '+this.time+'</span>\
					<div class="clr"></div>\
                    <span class="chat-body">'+this.body+'</span></div></li>';

                    $('ul.Msg_chat-box-body').append(li);
                });
                if(user.scroll){
                    $('ul.Msg_chat-box-body').animate({scrollTop: $('ul.Msg_chat-box-body').prop("scrollHeight")}, 500);
                }
                
            }
        }});
}

