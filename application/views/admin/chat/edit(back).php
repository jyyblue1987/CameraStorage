<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet box grey-cascade">            
            <div class="portlet-body">
<aside class="right-side">
                <!-- Content Header (Page header) -->                

                <!-- Main content -->
                <section class="content" style="background-color:#ECECEC">
	                <div class="row">
                        <div class="col-md-12">
<!-- start content -->
<div id="content" style="padding:3px 0 30px;max-width:1025px">
<div>
    <div class="chat" style="width:175px;">
        <div class="chat_menu">
        		<div style="float:left">User</div>                
                <div class="clear" style="clear:both"></div></div>
            <div class="chat_list">        
	            <div class="listBox">
    	        	<div id="all_user_data">
        	        </div>
            	</div>
			</div>
        </div>
    <div class="chat_right" style="width:845px;float:left">
        <section class="panel" > 
            <header class="panel-heading" ><?=$user_chat_data->user_name;?></header> 
            <section class="panel-body chat-list"> 
            	<div class="refresh"></div> 
            </section> 
                <article class="chat-item" id="chat-form" style="padding:0px 4px"> 
        <a class="pull-left thumb-small avatar" style="margin-top:20px">
			<img src="assets/uploads/profile.jpg" style="height:35px;width:45px" class="img-circle">
</a> 

              <section class="" style="padding:3px 0px;"> 
            <form action="#" class="m-b-none" id="submitForm" method="post" onSubmit="return false">
					<input name="user_id" type="hidden" id="user_id" value="<?=$user_chat_data->id;?>"/>					
					<input name="user_name" type="hidden" id="user_name" value="<?=$user_chat_data->user_name;?>"/>					
                <div class="input-group">
                <textarea id="textb" name="textb" placeholder="Say something" class="form-control" style="height:50px;margin:10px"></textarea>
                <span class="input-group-btn"> 
                <button class="btn btn-primary" style="font-size:15px" type="submit">SEND</button> </span> </div> </form> </section> </article>
        </section>
    </div>
    
    <div style="clear:both" class="clear"></div>
</div>
</div>
                        </div>
			
                    </div>
                </section><!-- /.content -->
            </aside>                
                
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>

<link rel="stylesheet" href="assets/plugins/chat/chat.css" type="text/css" />
<script>
$(document).ready(function(){
	getList();
});
	

setInterval("getList()", 5000); // Get users-online every 5 seconds 
function getList(){
//	alert($(".listBox:first-child").attr("id"));
	show_data = $('.listBox').children('div').attr('id');
	$.post("<?=$admin_link?>/chat/get_all_list", function(list){ 
		$(".listBox").html(list);
	}); 
} 	

function show_data1(name){
	$.ajax({
	   type: "POST",
	   url: "<?=$admin_link?>/chat/"+name,  
	   beforeSend: function () {
		  $(".listBox").html("Loading ...");
		},
	   success: function(msg){
			$(".listBox").html(msg);
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

function getMgse(){ 
	user_id = $('#user_id').val();
	$('.refresh').load('<?=$admin_link?>/chat/views/'+user_id);
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
		var dataString = 'user_id=' + user_id + '&user_name=' + username + '&message=' + message;
		
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
