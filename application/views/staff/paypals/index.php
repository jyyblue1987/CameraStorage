<style>
.table th{
	vertical-align:top !important;
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
	    <div class="col-md-6">
    		<div class="btn-group">
			    <a href="<?=$_edit?>" class="btn btn-primary m-r-5 m-b-5"><?=show_static_text($lang_id,233);?> <i class="fa fa-plus"></i></a>
<!--			    <a href="<?=$_cancel?>/export"class="btn btn-primary m-r-5 m-b-5">Export</a>-->
		    </div>
	    </div>    	
	    </div>

    <div class="table-responsive">
        <table id="data-table" class="table table-striped table-hover">
        <thead>
              <tr>
                <th><?=show_static_text($lang_id,150);?></th>								
                <th><?=show_static_text($lang_id,242);?></th>
                <th><?=show_static_text($lang_id,20);?></th>
                <th><?=show_static_text($lang_id,20000);?>Account</th>
                <th><?=show_static_text($lang_id,20000);?>Default</th>
                <th><?=show_static_text($lang_id,258);?></th>
            </tr>
        </thead>
		<tbody>

<?php
if(count($all_data)){
	$i=0;
	foreach($all_data as $set_data){
		$i++;

?>
        <tr>
            <td><?=$i; ?></td>
            <td><?=$set_data->username?></td>
            <td><?=$set_data->password?></td>
<!--            <td><?=$set_data->signature?></td>-->
            <td><?=$set_data->account?></td>
            <td><?=($set_data->is_default == 1)?'<i class="fa fa-check"></i>':''?></td>
            <td>
                <a class="btn btn-icon-only btn-info " data-toggle="tooltip" data-placement="top" title="Edit" href="<?=$_edit.'/'.$set_data->id;?>" ><i class="fa fa-edit"></i></a>
            </td>							
        </tr>

<?php             
   }
}
?>                        

</tbody>							
        </table>
    </div>    
    </div>
</div>

        <!-- end panel -->
    </div>
</div>

<script>
function get_active(name,id,value){
    $.ajax({
       type: "POST",
       url: "<?=$_cancel?>/product/get_active", /* The country id will be sent to this file */
       data: {id:id,type:name,value:value,<?=$this->security->get_csrf_token_name();?>:'<?=$this->security->get_csrf_hash();?>'},
       beforeSend: function () {
	      $("#show_class").html("Loading ...");
        },
       success: function(msg){
		 //alert(msg);
		//location.reload();
    	$("#show_class").html(msg);
       }
       });
}
function get_status(type,id,value){
	//alert(name+' '+id+' '+value);
    $.ajax({
       type: "POST",
       url: "<?=$_cancel?>/product/set_value", /* The country id will be sent to this file */
       data: {id:id,type:type,value:value,<?=$this->security->get_csrf_token_name();?>:'<?=$this->security->get_csrf_hash();?>'},
       beforeSend: function () {
	      $("#show_class").html("Loading ...");
        },
       success: function(msg){
		 //alert(msg);
		//location.reload();
    	$("#show_class").html(msg);
       }
       });
} 

function confirm_box(){
    var answer = confirm ("<?=show_static_text($lang_id,265);?>");
    if (!answer)
     return false;
}
</script>

<script>
$('#data-table').DataTable( {
	"bSort": false,
} );

</script>
