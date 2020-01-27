<div class="row">
    <div class="col-md-12">
        <!-- begin panel -->
        <div data-sortable-id="form-stuff-1" class="panel panel-inverse">
            <div class="panel-heading">                
                <h4 class="panel-title"><?=$name?></h4>
            </div>

<div class="panel-body">    
    <div class="table-responsive">
        <table id="data-table" class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th><?=show_static_text($adminLangSession['lang_id'],18);?></th>
                    <th><?=show_static_text($adminLangSession['lang_id'],153);?></th>
                    <th><?=show_static_text($adminLangSession['lang_id'],258);?></th>
                </tr>
                </thead>
                <tbody>

<?php
if(count($all_data)){
	foreach($all_data as $set_data){
?>
                        <tr>
                            <td><?php echo $set_data->email;?></td>
	                        <td><?php echo date('d/m/Y',$set_data->created);?></td>
							
                            <td>
<a class="btn btn-icon-only btn-danger" href="<?=$_cancel?>/delete_user/<?=$set_data->id;?>"  onclick="return confirm_box();">
    <i class="fa fa-trash-o"></i></a>

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
function confirm_box(){
    var answer = confirm ("<?=show_static_text($adminLangSession['lang_id'],265);?>");
    if (!answer)
     return false;
}

function get_verified(name,id,value){

	//alert(name+' '+id+' '+value);
    $.ajax({
       type: "POST",
       url: "admin/update_verified", /* The country id will be sent to this file */
       data: "table_name="+name+"&id="+id+"&verified="+value,
       beforeSend: function () {
      $("#show_class").html("Loading ...");
        },
       success: function(msg){
		 //alert(msg);
         $("#show_class").html(msg);
       }
       });
}

function get_status(name,id,value){
	//alert(name+' '+id+' '+value);
    $.ajax({
       type: "POST",
       url: "admin/userlist/get_status", /* The country id will be sent to this file */
       data: "id="+id+"&status="+value,
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
</script>