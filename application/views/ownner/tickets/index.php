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
			    <a href="<?=$_edit;?>" class="btn btn-primary m-r-5 m-b-5"><?=show_static_text($lang_id,233);?> <i class="fa fa-plus"></i></a>
		    </div>
	    </div>
	    </div>
    <div class="table-responsive" style="margin-top:20px">
        <table id="data-table" class="table table-striped table-hover">
                <thead>
                <tr>
	                <th><?=show_static_text($lang_id,244);?></th>
	                <th><?=show_static_text($lang_id,1580);?>Ticket</th>
	                <th><?=show_static_text($lang_id,1600);?>Information</th>
	                <th><?=show_static_text($lang_id,1007);?>Date</th>
	                <th><?=show_static_text($lang_id,1007);?>Status</th>
	                <th width="180"><?=show_static_text($lang_id,258);?></th>
                </tr>
                </thead>
                <tbody>

<?php
if(count($all_data)){
	foreach($all_data as $set_data){
		$storeName ='-';
		$statusName ='-';
		$statusClass ='';

/*		$this->db->order_by('id','desc');
		$cheekStatus = $this->comman_model->get_by('problems_status',array('problem_id'=>$set_data->id),false,false,true);
		if($cheekStatus){
			$statusName = $cheekStatus->status;
		}*/
		if(!empty($set_data->status)){
			if($set_data->status=='Completed'){
				$statusClass = 'label label-sm label-success';
			}
			else{
				$statusClass = 'label label-sm label-danger';
			}
			$statusName = $set_data->status;
		}

?>
    <tr>
        <td><?php echo $set_data->id; ?></td>
        <td><?=$set_data->name;?></td>
        <td>
		<?php //echo $set_data->name; ?>
<?php
$html = strip_tags($set_data->desc);
$html = html_entity_decode($html, ENT_QUOTES, 'UTF-8');    
echo (strlen($html)>=100)?substr($html, 0 ,100).'...':$html;
?>
        </td>
       <td><?=date('d-m-Y',$set_data->created);?></td>
       <td><span class="<?=$statusClass?>"><?=$statusName;?></span></td>

        <td>
<!--<a class="btn btn-icon-only btn-info" href="<?=$_edit?>/<?php echo $set_data->id;?>" >
        <i class="fa fa-edit"></i></a>-->
<a class="btn btn-icon-only btn-success" href="<?=$_view?>/<?php echo $set_data->id;?>" >
        <i class="fa fa-eye"></i></a>
<!--<a class="btn btn-icon-only btn-danger" href="<?=$_delete?>/<?php echo $set_data->id;?>"  onclick="return confirm_box();">
        <i class="fa fa-trash-o"></i></a>-->

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

		</div><!-- end panel -->
    </div>
</div>



<link href="assets/admin_temp/plugins/DataTables/css/data-table.css" rel="stylesheet" />
<script src="assets/admin_temp/plugins/DataTables/js/jquery.dataTables.js"></script>

<script>
function confirm_box(){
    var answer = confirm ("Are you sure?");
    if (!answer)
     return false;
}

$('#data-table').DataTable( {
	"order": [[ 4, "desc" ],[ 0, "desc" ]]
} );

</script>