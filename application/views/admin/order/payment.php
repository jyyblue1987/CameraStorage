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
                    <th><?=show_static_text($adminLangSession['lang_id'],11000);?>ID</th>
                    <th><?=show_static_text($adminLangSession['lang_id'],5410);?>Type</th>
                    <th><?=show_static_text($adminLangSession['lang_id'],5004);?>Order Number</th>
                    <th><?=show_static_text($adminLangSession['lang_id'],283);?></th>
                    <th><?=show_static_text($adminLangSession['lang_id'],242);?></th>
                    <th><?=show_static_text($adminLangSession['lang_id'],18);?></th>
                    <th><?=show_static_text($adminLangSession['lang_id'],229);?></th>
                    <th><?=show_static_text($adminLangSession['lang_id'],22900);?>Date</th>
	                <th><?=show_static_text($adminLangSession['lang_id'],258);?></th>
                    
                </tr>
                </thead>
                <tbody>

<?php
if(count($all_data)){
   foreach($all_data as $set_data){
	   $order_data ='';
	   $user = $this->comman_model->get_by('users',array('id'=>$set_data->user_id),false,false,true);
	   if($set_data->order_id!=0){
		   $order_data = $this->comman_model->get_by('user_orders',array('id'=>$set_data->order_id),false,false,true);
	   }
?>
                        <tr>
                            <td><?=$set_data->id;?></td>                            
                            <td><?=$set_data->subscribe_type;?></td>
                            <td><?=!empty($order_data)?$order_data->order_number:'-';?></td>
                            <td><?=$set_data->token;?></td>
                            <td><?=$user->first_name.' '.$user->last_name;?></td>
                            <td><?=$user->email;?></td>
                            <td><?='$'.$set_data->amt;?></td>
                            <td><?=h_dateFormat($set_data->on_date,'m/d/Y');?></td>

<td>
<a class="btn btn-icon-only btn-danger" href="<?=$_delete.'/'.$set_data->id;?>"  onclick="return confirm_box();" title="Delete">
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
</script>