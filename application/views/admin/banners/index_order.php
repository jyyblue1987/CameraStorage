<div class="row">
    <div class="col-md-12">
        <!-- begin panel -->
        <div data-sortable-id="form-stuff-1" class="panel panel-inverse">
            <div class="panel-heading">                
                <h4 class="panel-title"><?=$name?></h4>
            </div>

<div class="panel-body">
<div class="row">
    <div class="col-md-6">
        <div class="btn-group">	        
            <a href="<?=$_edit;?>" class="btn btn-primary m-r-5 m-b-5">
            Add New <i class="fa fa-plus"></i>
            </a>
            <input type="button" id="save" value="Save" class="btn btn-success" />

        </div>
    </div>
</div>

    <p class="alert alert-info">Drag to page and then click 'Save'</p>
    <div id="orderResult" style=""></div>
    
</div>

        </div>
        <!-- end panel -->
    </div>
</div>




<script>
function confirm_box(){
    var answer = confirm ("Are you sure?");
    if (!answer)
     return false;
}


</script>



<!--<link href="assets/plugins/nestedsortable/css/bootstrap.min.css" rel="stylesheet">-->
<link href="assets/plugins/nestedsortable/css/admin.css" rel="stylesheet">
<script src="assets/plugins/nestedsortable/jquery.mjs.nestedSortable.js"></script>

<script>
$(function(){
    $.post('<?=site_url($_cancel.'/order_ajax')?>', {}, function(data){
        $('#orderResult').html(data); 
    });    

	$('#save').click(function(){
		oSortable = $('.sortable').nestedSortable('toArray');

		$('#orderResult').slideUp(function(){
			$.post('<?php echo site_url($_cancel.'/order_ajax'); ?>', { sortable: oSortable,<?=$this->security->get_csrf_token_name();?>:'<?=$this->security->get_csrf_hash();?>' }, function(data){
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
	height:45px;
}
</style>
