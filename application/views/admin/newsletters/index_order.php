<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet box grey-cascade">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-globe"></i><?php echo $name;?>
                </div>
                <!--<div class="tools">
                    <a href="javascript:;" class="collapse">
                    </a>
                    <a href="#portlet-config" data-toggle="modal" class="config">
                    </a>
                    <a href="javascript:;" class="reload">
                    </a>
                    <a href="javascript:;" class="remove">
                    </a>
                </div>-->
            </div>
            <div class="portlet-body">
                <div class="table-toolbar">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="btn-group">
                                <a href="admin/newsletter/edit"class="btn green">
                                Add New <i class="fa fa-plus"></i>
                                </a>
    <input type="button" id="save" value="Save" class="btn btn-primary" />

                            </div>
                        </div>
                    </div>
                </div>
    <p class="alert alert-info">Drag to newsletter and then click 'Save'</p>
	<div class="form-body alert alert-warning">
        <div class="col-md-5" style="padding:0px">
              	<input type="text" name="title" value="" placeholder="Search Title" class="form-control"  id="search_title" onkeypress="ajax_search()" onkeyup="ajax_search()" onkeydown="ajax_search()" style="height:30px;margin:0px"/>
        </div>
        <div style="clear:both"></div>
    </div>
    <div id="orderResult" style=""></div>


            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>





<script>
function confirm_box(){
    var answer = confirm ("Are you sure?");
    if (!answer)
     return false;
}
function ajax_search(title){
	$('#orderResult').html('<div style="text-align:center; margin-top:20px" ><img src="assets/templates/images/loader.gif"></div>');
	var edValue = document.getElementById("search_title");
    var id = edValue.value;
	$.ajax({
		type:"POST",
		url:"admin/newsletter/search_ajax",
		data:"title="+id,
		success:function(data){
			$('#orderResult').html(data);
		}
	});
	return false;		
}

</script>



<link href="assets/plugins/nestedsortable/css/bootstrap.min.css" rel="stylesheet">
<link href="assets/plugins/nestedsortable/css/admin.css" rel="stylesheet">
<script src="assets/plugins/nestedsortable/jquery.mjs.nestedSortable.js"></script>

<script>
$(function(){
    $.post('<?=site_url('admin/newsletter/order_ajax')?>', {}, function(data){
        $('#orderResult').html(data); 
    });    

	$('#save').click(function(){
		oSortable = $('.sortable').nestedSortable('toArray');

		$('#orderResult').slideUp(function(){
			$.post('<?php echo site_url('admin/newsletter/order_ajax'); ?>', { sortable: oSortable }, function(data){
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
