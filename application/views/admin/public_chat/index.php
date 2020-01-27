<div class="row">
    <div class="col-md-12">
        <!-- begin panel -->
        <div data-sortable-id="form-stuff-1" class="panel panel-inverse">
            <div class="panel-heading">                
                <h4 class="panel-title"><?=$name?></h4>
            </div>

	<div class="panel-body">
<!--    <div class="row">
        <div class="col-lg-3">
            <div class="btn-panel btn-panel-conversation">
                <a href="" class="btn  col-lg-6 send-message-btn " role="button"><i class="fa fa-search"></i> Search</a>
                <a href="" class="btn  col-lg-6  send-message-btn pull-right" role="button"><i class="fa fa-plus"></i> New Message</a>
            </div>
        </div>

        <div class="col-lg-offset-1 col-lg-7">
            <div class="btn-panel btn-panel-msg">

                <a href="" class="btn  col-lg-3  send-message-btn pull-right" role="button"><i class="fa fa-gears"></i> Settings</a>
            </div>
        </div>
    </div>
-->
    <div class="row">

        <div class="conversation-wrap col-lg-3">
			<div class="historyBox">

                </div>
        </div>



        <div class="message-wrap col-lg-9">
            <div class="msg-wrap" style="min-height:450px">
            </div>

            <div class="send-wrap ">

                <textarea class="form-control send-message" rows="3" placeholder="Write a reply..."></textarea>


            </div>
            
        </div>
    </div>
    </div>
</div>

        <!-- end panel -->
    </div>
</div>



        

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

<script>
$(document).ready(function(){
	getList();
});
	
//get public chat view
function getMgse(){ 
	$('.refresh').load('<?=$admin_link?>/public_chat/all_views/');
	$("section").animate({ scrollTop: $('.refresh').height() }, 1000);
	
}

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
<script type="text/javascript">
$(document).ready(function(){
	$("#textb").keyup(function(e) {	 
    	var code = e.keyCode || e.which;
      	if(code == 13) { //Enter keycode
			$("#submitForm").trigger("submit");
      	}     
	});		
});


$.ajaxSetup ({
	cache: false	
});

//$(setInterval("getMgse()", 30000));
	
$(function() {	
	$('#submitForm').submit(function(){
		var user_id = $('#texta').val();
		var username = $('#girl_name').val();
		var message = $.trim($('#textb').val());
/*		var recipient_id = $('#user_id').val();
		var recipient = $('#user_name').val();*/
		if (message == "" || message == "Say something"||message==null) {
			$('#textb').val('');
			return false;
		}
		//var dataString = 'user_id=' + user_id + '&user_name=' + username + '&message=' + message + '&recipient_id=' + recipient_id + '&recipient=' + recipient;
		var dataString = 'user_id=' + user_id + '&user_name=' + username + '&message=' + message+ '&recipient_id=-1';
		
		$.ajax({
			type: "POST",
			url: "<?=$admin_link?>/public_chat/send_chat",
			data: dataString,
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
