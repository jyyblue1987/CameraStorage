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
            <a href="<?=$_edit?>" class="btn btn-primary m-r-5 m-b-5">
            <?=show_static_text($adminLangSession['lang_id'],233);?> <i class="fa fa-plus"></i>
            </a>
        </div>
    </div>
</div>
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th><?=show_static_text($adminLangSession['lang_id'],244);?></th>								
                    <th><?=show_static_text($adminLangSession['lang_id'],16);?></th>
                    <th><?=show_static_text($adminLangSession['lang_id'],259);?></th>
                    <th><?=show_static_text($adminLangSession['lang_id'],39);?></th>
                    <th><?=show_static_text($adminLangSession['lang_id'],260);?></th>
                    <th><?=show_static_text($adminLangSession['lang_id'],258);?></th>
                </tr>
            </thead>

<tbody>

<?php
if(count($all_data)){
	foreach($all_data as $set_data){
?>
                        <tr>
							<td><?php echo $set_data->id; ?></td>
<?php /*?>							<th><img alt="<?php echo $set_data->name;?>" src="assets/uploads/categories/small/<?php echo $set_data->image;?>" class="img-rounded"></th><?php */?>
							<td><?php echo $set_data->language;?></td>
							<td><?php 
							if(!empty($set_data->image)){
								echo '<img alt="'.$set_data->language.'" src="assets/uploads/language/'.$set_data->image.'" class="img-rounded" style="height:20px;width:20px"> ';
							} ?></td>
							
							<td><?php echo $set_data->code;?></td>
                            <td><?=($set_data->default == 1)?'<i class="fa fa-check"></i>':''?></td>
							<td>
<a class="btn btn-icon-only btn-info" href="<?=$_edit?>/<?php echo $set_data->id;?>"><i class="fa fa-edit"></i></a>
<a class="btn btn-icon-only btn-danger" href="<?=$_delete?>/<?php echo $set_data->id;?>"  onclick="return confirm_box();"><i class="fa fa-trash"></i></a>
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
    var answer = confirm ("Are you sure?");
    if (!answer)
     return false;
}

function get_status(name,id,value){
	//alert(name+' '+id+' '+value);
    $.ajax({
       type: "POST",
       url: "admin/language/get_status", /* The country id will be sent to this file */
       data: "id="+id+"&enable="+value,
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