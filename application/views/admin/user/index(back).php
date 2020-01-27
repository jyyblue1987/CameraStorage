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
			    <a href="<?=$_add;?>" class="btn btn-primary m-r-5 m-b-5"><?=show_static_text($adminLangSession['lang_id'],233);?> <i class="fa fa-plus"></i></a>
		    </div>
	    </div>
	    </div>

    <div class="table-responsive">
        <table id="data-table" class="table table-striped table-bordered">
            <thead>
            <tr>
                <th><?=show_static_text($adminLangSession['lang_id'],244);?></th>
                <th><?=show_static_text($adminLangSession['lang_id'],242);?></th>
                <th><?=show_static_text($adminLangSession['lang_id'],18);?></th>
                <th><?=show_static_text($adminLangSession['lang_id'],153);?></th>
                <th><?=show_static_text($adminLangSession['lang_id'],256);?></th>
                <th><?=show_static_text($adminLangSession['lang_id'],113);?></th>
                <th><?=show_static_text($adminLangSession['lang_id'],158);?></th>
                <th><?=show_static_text($adminLangSession['lang_id'],258);?></th>
            </tr>
            </thead>
            <tbody>

<?php
if(count($all_data)){
foreach($all_data as $set_data){
?>
                    <tr>
                        <td><?php echo $set_data->id;?></td>
                        <td><?php echo $set_data->first_name.' '.$set_data->last_name;?></td>
                        <td><?php echo $set_data->email;?></td>
                        <td><?php echo date('d/m/Y',$set_data->created);?></td>
                        <td>
<?php
if($set_data->confirm=='confirm'){
echo 'Confirm';
}
else{
echo 'Not Confirm';
}
?>
                        </td>
                        <td>
<?php
if($set_data->account_type=='G'){
?>
<a href="<?=$_cancel?>/set_user/<?=$set_data->id?>">Set As User</a>

<?php
}
else{
echo 'User';
}
?>                            
                        </td>                            
                        <td>
                        <select onchange="get_status('users',<?php echo $set_data->id;?>,this.value)" name="martial_id">
<?php 
if($set_data->status==1){
echo '<option selected="selected" value="1">Active</option>';
echo '<option value="0">Inactive</option>';
//echo '<option selected="selected" value="1">'.$this->lang->line('active').'</option>';
//echo '<option value="0">'.$this->lang->line('inactive').'</option>';
}
else{
echo '<option value="1">Active</option>';
echo '<option selected="selected" value="0">Inactive</option>';
//echo '<option value="1">'.$this->lang->line('active').'</option>';
//echo '<option selected="selected" value="0">'.$this->lang->line('inactive').'</option>';
}
?>
                            </select>
                        </td>

                        <td>
                    <a class="btn btn-icon-only btn-danger" href="<?=$_delete?>/<?=$set_data->id;?>"  onclick="return confirm_box();">
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


function get_status(name,id,value){
	//alert(name+' '+id+' '+value);
    $.ajax({
       type: "POST",
       url: "<?=$_cancel?>/get_status", /* The country id will be sent to this file */
       data: {id:id,status:value,<?=$this->security->get_csrf_token_name();?>:'<?=$this->security->get_csrf_hash();?>'},
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