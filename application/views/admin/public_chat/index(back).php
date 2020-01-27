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
            <section class="panel-body chat-list"> 
            	<div class="refresh"></div> 
            </section> 

                <article class="chat-item " id="chat-form" style="padding:0px 4px;">
        <a class="pull-left thumb-small avatar" style="margin-top:20px">
			<img src="assets/uploads/profile.jpg" style="height:35px;width:45px" class="img-circle">
		</a> 
                	 
              <section class="" style="padding:3px 0px"> 
              <form action="#" class="m-b-none" id="submitForm" method="post" onSubmit="return false">
					<input name="girl_id" type="hidden" id="texta" value="-1"/>
					<input name="girl_name" type="hidden" id="girl_name" value="public"/>
        	        <div class="input-group">
		                <textarea id="textb" name="textb" placeholder="Say something" class="form-control" style="height:50px;margin:10px"></textarea>
                <span class="input-group-btn"> 
                    <div class="navigationMenu">
                      <img src="assets/plugins/chat/images/menu.png" width="30" height="30">
                      <span class="icons-table"><?php echo $smiley_table; ?></span>
                      <div class="clear"></div>
                    </div>
				<br>
                <button class="btn btn-primary" type="submit">Send</button> </span> 
                	 </div> 
               </form>
                        

                
                     </section> </article>
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
setInterval("getMgse()", 5000); // Get users-online every 5 seconds 
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
</style>