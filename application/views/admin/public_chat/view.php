<style>
    .conversation-wrap
    {
        box-shadow: -2px 0 3px #ddd;
        padding:0;
        max-height: 400px;
        overflow: auto;
    }
    .conversation
    {
        padding:5px;
        border-bottom:1px solid #ddd;
        margin:0;

    }

    .message-wrap
    {
        box-shadow: 0 0 3px #ddd;
        padding:0;

    }
    .msg
    {
        padding:5px;
        /*border-bottom:1px solid #ddd;*/
        margin:0;
    }
    .msg-wrap
    {
        padding:10px;
        max-height: 400px;
        overflow: auto;

    }

    .time
    {
        color:#bfbfbf;
    }

    .send-wrap
    {
        border-top: 1px solid #eee;
        border-bottom: 1px solid #eee;
        padding:10px;
        /*background: #f8f8f8;*/
    }

    .send-message
    {
        resize: none;
    }

    .highlight
    {
        background-color: #f7f7f9;
        border: 1px solid #e1e1e8;
    }

    .send-message-btn
    {
        border-top-left-radius: 0;
        border-top-right-radius: 0;
        border-bottom-left-radius: 0;

        border-bottom-right-radius: 0;
    }
    .btn-panel
    {
        background: #f7f7f9;
    }

    .btn-panel .btn
    {
        color:#b8b8b8;

        transition: 0.2s all ease-in-out;
    }

    .btn-panel .btn:hover
    {
        color:#666;
        background: #f8f8f8;
    }
    .btn-panel .btn:active
    {
        background: #f8f8f8;
        box-shadow: 0 0 1px #ddd;
    }

    .btn-panel-conversation .btn,.btn-panel-msg .btn
    {

        background: #f8f8f8;
    }
    .btn-panel-conversation .btn:first-child
    {
        border-right: 1px solid #ddd;
    }

    .msg-wrap .media-heading
    {
        color:#003bb3;
        font-weight: 700;
    }


    .msg-date
    {
        background: none;
        text-align: center;
        color:#aaa;
        border:none;
        box-shadow: none;
        border-bottom: 1px solid #ddd;
    }


    body::-webkit-scrollbar {
        width: 12px;
    }
 
    
    /* Let's get this party started */
    ::-webkit-scrollbar {
        width: 6px;
    }

    /* Track */
    ::-webkit-scrollbar-track {
        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3); 
/*        -webkit-border-radius: 10px;
        border-radius: 10px;*/
    }

    /* Handle */
    ::-webkit-scrollbar-thumb {
/*        -webkit-border-radius: 10px;
        border-radius: 10px;*/
        background:#ddd; 
        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.5); 
    }
    ::-webkit-scrollbar-thumb:window-inactive {
        background: #ddd; 
    }

</style>
<div class="row">
    <div class="col-md-12">
        <!-- begin panel -->
        <div data-sortable-id="form-stuff-1" class="panel panel-inverse">
            <div class="panel-heading">                
                <h4 class="panel-title"><?=$name?></h4>
            </div>

	<div class="panel-body">
    <div class="row">

        <div class="conversation-wrap col-lg-3">
			<div class="historyBox"></div>
        </div>



        <div class="message-wrap col-lg-9">
            <div class="msg-wrap" style="min-height:400px" >
                        	<div class="refresh"></div> 

            </div>

            <div class="send-wrap ">

<form action="#" class="m-b-none" id="submitForm" method="post" onSubmit="return false">
					<input name="user_id" type="hidden" id="user_id" value="<?=$user_chat_data->id;?>"/>					
					<input name="user_name" type="hidden" id="user_name" value="<?=$user_chat_data->user_name;?>"/>					
                <div class="input-group">
                <input type="text" id="textb" name="textb" placeholder="Say something" class="form-control" style="margin:10px" >
                <span class="input-group-btn"> 
                <button class="btn btn-primary" style="font-size:15px" type="submit">SEND</button> </span> </div> </form>
            </div>
            
        </div>
    </div>
    </div>
</div>

        <!-- end panel -->
    </div>
</div>

<script type="text/javascript">
//$(document).ready(function(){});

function getMgse(){ 
	user_id = $('#user_id').val();
	$('.refresh').load('<?=$admin_link?>/public_chat/views/'+user_id);
	$("section").animate({ scrollTop: $('.refresh').height() }, 1000);
	
}

$.ajaxSetup ({
	cache: false	
});
getMgse();
$(setInterval("getMgse()", 3000));
	
$(function() {	
	$('#submitForm').submit(function(){
		var user_id = $('#user_id').val();
		var username = $('#user_name').val();
		var message = $.trim($('#textb').val());
/*		var recipient_id = $('#user_id').val();
		var recipient = $('#user_name').val();*/
		if (message == "" || message == "Say something"||message==null) {
			$('#textb').val('');
			return false;
		}
		//var dataString = 'user_id=' + user_id + '&user_name=' + username + '&message=' + message + '&recipient_id=' + recipient_id + '&recipient=' + recipient;
		
		$.ajax({
			type: "POST",
			url: "<?=$admin_link?>/public_chat/send_chat",
			data: {user_id:user_id,user_name:username,message:message,<?=$this->security->get_csrf_token_name();?>:'<?=$this->security->get_csrf_hash();?>'},
			success: function() {
				getMgse();
				$('#textb').val('');
				//document.newMessage.textb.value = "";
			}
		});
		return false;
	});
});
</script>




        



<script>
$(document).ready(function(){
	getList();
});
	
//get public chat view

//getMgse();
//setInterval("getMgse()", 5000); // Get users-online every 5 seconds 
setInterval("getList()", 5000); // Get users-online every 5 seconds 
function getList(){
//	alert($(".historyBox:first-child").attr("id"));
	show_data = $('.historyBox').children('div').attr('id');
	$.post("<?=$admin_link?>/public_chat/get_all_list", function(list){ 
		$(".historyBox").html(list);
	}); 
} 	

function show_data1(name){
	$.ajax({
	   type: "POST",
	   url: "<?=$admin_link?>/public_chat/"+name,  
	   beforeSend: function () {
		  $(".historyBox").html("Loading ...");
		},
	   success: function(msg){
			$(".historyBox").html(msg);
	   }
	});
}


</script>

