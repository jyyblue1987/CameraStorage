<div class="row">
    <div class="col-md-12">
        <!-- begin panel -->
        <div data-sortable-id="form-stuff-1" class="panel panel-inverse">
            <div class="panel-heading">                
                <h4 class="panel-title"><?=$name?></h4>
            </div>
			
            <!--panel-body-->
			<div class="panel-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="btn-group">
                            <a href="<?=$_cancel?>" class="btn btn-primary m-r-5 m-b-5">Back <i class="fa fa-reply"></i></a>
                            <a href="<?=$_add?>" class="btn btn-primary m-r-5 m-b-5">Add New Device <i class="fa fa-plus"></i></a>
                            <input type="button" id="save" value="Save" class="btn btn-success" />
            
            
                        </div>
                    </div>
                </div>
				<p class="alert alert-info">Drag and drop the device below to change the order and click on the "Save button"</p>
			    <div id="orderResult" style=""></div>
			</div>
            <!--end panel-body-->
        </div>
        <!-- end panel -->
    </div>
</div>




<script>

function ajax_search(title){
	//alert(title);
	$('#orderResult').html('<div style="text-align:center; margin-top:20px" ><img src="assets/uploads/loading.gif"></div>');

	var edValue = document.getElementById("search_title");
    var id = edValue.value;
	$.ajax({
		type:"POST",
		url:"<?=$_cancel?>/search_ajax",
		data:{title:id,<?=$this->security->get_csrf_token_name();?>:'<?=$this->security->get_csrf_hash();?>'},
		success:function(data){
			$('#orderResult').html(data);
		}
	});
	return false;		
}

</script>



<!--<link href="assets/plugins/nestedsortable/css/bootstrap.min.css" rel="stylesheet">-->
<link href="assets/plugins/nestedsortable/css/admin.css" rel="stylesheet">
<script type="text/javascript" src="assets/plugins/nestedsortable/jquery.ui.touch-punch.js"></script>
<script type="text/javascript" src="assets/plugins/nestedsortable/jquery.mjs.nestedSortable.js"></script>
<!--<script src="assets/plugins/nestedsortable/jquery.mjs.nestedSortable.js"></script>-->

<script>
$(function(){
    $.post('<?=site_url($_cancel.'/order_ajax')?>', {}, function(data){
        $('#orderResult').html(data); 
    });    

	$('#save').click(function(){
		oSortable = $('.sortable').nestedSortable('toArray');

		$('#orderResult').slideUp(function(){
			$.post('<?php echo site_url($_cancel.'/order_ajax'); ?>', { sortable: oSortable ,<?=$this->security->get_csrf_token_name();?>:'<?=$this->security->get_csrf_hash();?>'}, function(data){
				$('#orderResult').html(data);
				$('#orderResult').slideDown();
			});
		});
		
	});
})
</script>

<style>
.options {
  background: none !important;
  border: none !important;
  padding: 0px !important;
}

.sortable li div{
	height:38px;
}
</style>
