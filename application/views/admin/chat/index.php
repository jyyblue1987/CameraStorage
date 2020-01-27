<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet box grey-cascade">            
            <div class="portlet-body form">
			<div style="" class="chat-content">
    <div class="chat col-md-3" style="">
        <div class="chat_menu">Chat</div>
            <div class="chat_list">        
            	<div class="historyBox">
                </div>
            </div>
        </div>
    <div class="chat_right col-md-9" >
        <section class="panel" > 
            <header class="panel-heading" style="padding:6px 10px" >
            Public Chat
            </header> 
            <section class="panel-body chat-list" style="min-height:455px;"> 
            	<div class="refresh"></div>                 
            </section> 

                <article class="chat-item " id="chat-form" style="padding:0px 4px;">
               </article>
        </section>
    </div>
    	
    
    <div class="clearfix"></div>
</div>
		</div>
            
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>
<?php echo smiley_js();?>

<link rel="stylesheet" href="assets/plugins/chat/chat.css" type="text/css" />
<script>
$(document).ready(function(){
	getList();
});
	
//get public chat view
function getMgse(){ 
	$('.refresh').load('<?=$admin_link?>/chat/all_views/');
	$("section").animate({ scrollTop: $('.refresh').height() }, 1000);
	
}

//getMgse();
//setInterval("getMgse()", 5000); // Get users-online every 5 seconds 
setInterval("getList()", 5000); // Get users-online every 5 seconds 
function getList(){
//	alert($(".historyBox:first-child").attr("id"));
	show_data = $('.historyBox').children('div').attr('id');
	$.post("<?=$admin_link?>/chat/get_all_list", function(list){ 
		$(".historyBox").html(list);
	}); 
} 	

function show_data1(name){
	$.ajax({
	   type: "POST",
	   url: "<?=$admin_link?>/chat/"+name,  
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
			url: "<?=$admin_link?>/chat/send_chat",
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
<style>
.chat_list{
height:452px;
}
.chat-list-new
{
    list-style: none;
    margin: 0;
    padding: 0;
}

.chat-list-new li
{
    margin-bottom: 10px;
    padding-bottom: 5px;
    border-bottom: 1px dotted #B3A9A9;
}

.chat-list-new li.left .chat-body
{
    margin-left: 60px;
}

.chat-list-new li.right .chat-body
{
    margin-right: 60px;
}

.chat-list-new .img-circle{
		width:50px;
		height:50px;

}


.chat-list-new li .chat-body p
{
    margin: 0;
    color: #777777;
}

.panel .slidedown .glyphicon, .chat-list-new .glyphicon
{
    margin-right: 5px;
}

::-webkit-scrollbar-track
{
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
    background-color: #F5F5F5;
}

::-webkit-scrollbar
{
    width: 12px;
    background-color: #F5F5F5;
}

::-webkit-scrollbar-thumb
{
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
    background-color: #555;
}

</style>