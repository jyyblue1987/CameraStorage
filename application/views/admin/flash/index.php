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
                    <th><?=show_static_text($adminLangSession['lang_id'],244);?></th>								
                    <th><?=show_static_text($adminLangSession['lang_id'],181);?></th>
                    <th><?=show_static_text($adminLangSession['lang_id'],1001);?>Show</th>
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
							<td><?php echo $set_data->name; ?></td>
<td>
<input id="remember" name="remember" type="checkbox" onclick="get_active('enabled',<?php echo $set_data->id;?>,this.value)" <?=$set_data->enabled==1?'checked="checked"':''?>   />
							</td>
<?php /*?>							<td><?php echo substr($set_data->body, 0 ,100);; ?></td><?php */?>
							<td>
<a class="btn btn-icon-only btn-success" href="<?=$_edit.'/'.$set_data->id;?>" ><i class="fa fa-edit"></i></a>
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


function get_active(name,id,value){
    $.ajax({
       type: "POST",
       url: "<?=$_cancel?>/get_active", /* The country id will be sent to this file */
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

</script>