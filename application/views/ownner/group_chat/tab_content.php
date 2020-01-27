<?php echo smiley_js();?>
<script type="text/javascript">
var g_base = "<?=base_url().$_user_link.'/group_chat/';?>";
var g_base_url = "<?=base_url().$_user_link.'/group_chat/';?>";
var g_group_id = "<?=$view_data->id?>";
var csrfTokenName = '<?=$this->security->get_csrf_token_name();?>';
var csrfTokenValue = '<?=$this->security->get_csrf_hash();?>';
</script>

<script type="text/javascript" src="assets/plugins/group_chat/private.js"></script>	
<link type="text/css" rel="stylesheet" media="all" href="assets/plugins/group_chat/private.css">
<style>
#usersListWrapper, #usersListWrapper2 {
  height: 312px;
}
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

<div class="portlet-body" style="background-color:#FFF;padding:0px 20px 20px;">
<h3>Chat</h3>
<div class="" id="inbox" style="">
<div class="">
    <div class="col-sm-4">
<?php $this->load->view('dancer/group_chat/left_content'); ?>
    </div><!--//col-md-3//-->

    <div class="col-sm-8" id="userMessageWrapper">
        <div class="col-sm-12">
            <h4 class="display-name"></h4>
        </div> 
           
        <hr>
         <div class="Msg_chat_container">
            <div class="Msg_chat-content">
			    <input type="hidden" name="file_name" id="file-name" value="" />
                <input name="Msg_chat_buddy_id" id="Msg_chat_buddy_id" type="hidden">
                <ul class="Msg_chat-box-body"></ul>
            </div>
         </div>
          <hr>
          
          <div class="Msg_chat-textarea" style="">
                <!--<div class="">
                <input class="form-control" placeholder="Type your message here.." id="textb">       
		        </div>-->
                <div class="input-group ">
                <input class="form-control" placeholder="Type your message here.." id="textb">
       <div class="input-group-btn">
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><i class="fa fa-smile-o"></i></button>
            <div class="dropdown-menu smile-icons">
                <?=$smiley_table?>
            </div>
      </div>
        </div>
    
        <div class="" style="margin-left:-10px;margin-top:10px;">
            <div id="fileuploader" class="fileuploader" style="background-color:#268abe"><i class="fa fa-plus"></i> <?=show_static_text($lang_id,278);?></div>
            <span id="filesUpload" class="filesUpload"></span>
            <div id="status"></div>        		            
            <div style="clear:both"></div>                    
            <table class="" style="margin-top:10px;margin-left:10px">
                <tbody class="files" id="product_files_content">
                </tbody>
            </table>
	    </div>        
          </div><!--//Msg_chat-textarea//-->
          
    </div>
                  </div>
                  <div style="clear:both"></div>

          </div>    
</div>

<link href="assets/plugins/uploader/css/uploadfile.css" rel="stylesheet">
<script src="assets/plugins/uploader/js/jquery.uploadfile.min.js"></script>
<script>
$(document).ready(function(){
	$(".fileuploader").uploadFile({
		url:"<?=$lang_code.'/ajax_user/ajax_upload'?>",
		fileName:"myfile",
		showStatusAfterSuccess:false,
		uploadButtonClass:"ajax-file-upload-blue",
		allowedTypes:"jpeg,jpg,png,gif",
		multiple: false,
		onSuccess:function(files,data,xhr){
			var obj = jQuery.parseJSON(data);
			if(obj.result=='error'){
				$('.ajax-file-upload-statusbar').hide();
				$("#status").html("<font color='red'>"+obj.msg+"</font>");
			}
			else if(obj.result=='success'){
				//$("#status").html("<font color='red'>image is uploaded. </font>");
				//var pic_id = '<input type="hidden" name="more_pic[]" value="'+obj.msg+'" />';
				$('#file-name').val(obj.msg);
				refresh_image(obj.msg);
				//window.location.href = "front/videos/"+$("#video_id").val();
			}
			
		},
		onError: function(files,status,errMsg){		
			$("#status").html("<font color='red'>There is some problem</font>");
		}

	});
});

function refresh_image(id){
	$.ajax({
		type:"POST",
		url:"<?=$lang_code.'/ajax_user/refresh'?>",
		data:{id:id,<?=$this->security->get_csrf_token_name();?>:'<?=$this->security->get_csrf_hash();?>'},
		success:function(data){
			$('#product_files_content').html(data);
		}
	});

}
function delete_files(id){
	$('#'+id).remove();
	$('#file-name').val('');
}

</script>
<script>
jQuery(document).ready(function() {
	jQuery(window).load(function() { 
		$('.Msg_chat-textarea').hide();
	});
});

</script>