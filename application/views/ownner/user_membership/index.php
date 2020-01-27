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
<div class="row" style="margin-bottom:10px">
	    <div class="col-md-6">
    		<div class="btn-group">
			    <a href="<?=$_edit?>" class="btn btn-primary m-r-5 m-b-5"><?=show_static_text($lang_id,7);?> <i class="fa fa-plus"></i></a>
		    </div>
	    </div>    	
	    </div>
    <div class="table-responsive">
        <table id="data-table" class="table table-striped table-bordered">
        <thead>
              <tr>
                <th><?=show_static_text($lang_id,150);?></th>								
                <th><?=show_static_text($lang_id,16);?></th>
                <th><?=show_static_text($lang_id,116);?></th>
                <th><?=show_static_text($lang_id,41);?></th>
                <th><?=show_static_text($lang_id,64);?></th>
                <th><?=show_static_text($lang_id,316);?></th>
                <th><?=show_static_text($lang_id,140);?></th>
<!--                <th><?=show_static_text($lang_id,38);?></th>-->
                <th><?=show_static_text($lang_id,308);?></th>
<!--                <th><?=show_static_text($lang_id,1670);?>Date</th>-->
                <th><?=show_static_text($lang_id,258);?></th>
            </tr>
        </thead>
		<tbody>

<?php
if(count($all_data)){
	$i = 0;
	foreach($all_data as $set_data){
		$i++;
		$userName = '-';
		$userStatus = '-';
		$athleteCount = count($this->comman_model->get_by('users',array('parent_id'=>$user_details->id,'plan_id'=>$set_data->id),false,false,false));
?>
<tr>
    <td><?=$i; ?></td>
    <td><?=$set_data->name?></td>
    <td><?=$set_data->type?></td>
    <td><?=$set_data->price?></td>
    <td><?=array_key_exists($set_data->month,$month_data)?$month_data[$set_data->month]:$set_data->month?></td>
    <td><?=$set_data->member==100?'Unlimited':$set_data->member?></td>
    <td><?=$athleteCount?></td>
    <td><?=print_value('stores',array('user_id'=>$user_details->id,'id'=>$set_data->gym_id),'name')?></td>

<!--    <td><?=h_dateFormat($set_data->dates,'d-m-Y')?></td>-->
<!--	<td>
<?php
$html = strip_tags($set_data->desc);
$html = html_entity_decode($html, ENT_QUOTES, 'UTF-8');    
echo word_limiter($html,10);
?>                            

    </td>-->
    
    <td>
<a class="btn btn-icon-only btn-info" data-toggle="tooltip" data-placement="top"  title="Edit" href="<?=$_edit.'/'.$set_data->id;?>" >
            <i class="fa fa-edit"></i></a>
    <a class="btn btn-icon-only btn-danger" data-toggle="tooltip" data-placement="top" title="Delete" href="<?=$_delete.'/'.$set_data->id;?>"  onclick="return confirm_box();">
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

<link href="assets/admin_temp/plugins/DataTables/css/data-table.css" rel="stylesheet" />
<script src="assets/admin_temp/plugins/DataTables/js/jquery.dataTables.js"></script>
<script>
$('#data-table').DataTable({
aoColumnDefs: [
  {
     bSortable: false,
     aTargets: [1]
  }
]});

</script>
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