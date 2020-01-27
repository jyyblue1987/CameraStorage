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
			    <a href="<?=$_edit;?>" class="btn btn-primary m-r-5 m-b-5"><?=show_static_text($adminLangSession['lang_id'],233);?> <i class="fa fa-plus"></i></a>
		    </div>
	    </div>
	    </div>
    <div class="table-responsive">
        <table id="data-table" class="table table-striped table-bordered">
                <thead>
                <tr>
	                <th><?=show_static_text($adminLangSession['lang_id'],244);?></th>
	                <th><?=show_static_text($adminLangSession['lang_id'],16);?></th>
	                <th><?=show_static_text($adminLangSession['lang_id'],1058);?>Response Time</th>
	                <th><?=show_static_text($adminLangSession['lang_id'],258);?></th>
                </tr>
                </thead>
                <tbody>

<?php
if(count($all_data)){
	foreach($all_data as $set_data){
		if($set_data->admin_id!=0){
			$adminData = $this->comman_model->get_by('admin',array('id'=>$set_data->admin_id),false,false,true);
			if($adminData){
				$adminName = $adminData->username;
			}
		}
		else{
			$adminName = '-';
		}
?>
    <tr>
        <td><?php echo $set_data->id; ?></td>
        <td><?php echo $set_data->name; ?></td>
		<td><?php echo $set_data->solve_time; ?> Hrs</td>
		<td>
        <a class="btn btn-icon-only btn-info" href="<?=$_edit?>/<?php echo $set_data->id;?>" >
                    <i class="fa fa-edit"></i></a>
            <a class="btn btn-icon-only btn-danger" href="<?=$_delete?>/<?php echo $set_data->id;?>"  onclick="return confirm_box();">
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
    var answer = confirm ("Are you sure?");
    if (!answer)
     return false;
}

function get_resign(id,value){
	//alert(name+' '+id+' '+value);
    $.ajax({
       type: "POST",
       url: "<?=$_cancel?>/ajax_resign",
       data: {id:id,admin_id:value,<?=$this->security->get_csrf_token_name();?>:'<?=$this->security->get_csrf_hash();?>'},
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