<style>
.table th{
	vertical-align:top !important;
}
</style>
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
            <div class="tabbable tabbable-custom boxless tabbable-reversed">
						<ul class="nav nav-tabs">
							<li class="active">
								<a href="#tab_0" data-toggle="tab">Vouchar</a>
							</li>
							<li class="">
								<a href="admin/voucher/public_voucher">Public Vouchar</a>
							</li>
							<li>
								<a href="admin/voucher/add_voucher/" >Gift</a>
							</li>
						</ul>
						<div class="tab-content">
							<div class="tab-pane active" id="tab_0">
                                <div class="table-toolbar">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="btn-group">
                                                <a href="admin/voucher/edit"class="btn green">
                                                Add New <i class="fa fa-plus"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

<div class="portlet-body">
    <div class="table-scrollable">
        <table class="table table-striped table-bordered table-hover">
        <thead>
              <tr>
                <th>Code</th>								
                <th>User</th>
                <th>Amount</th>
                <th>Remaining</th>
                <th>Used</th>
                <th>Expire Date</th>
                <th>Options</th>
            </tr>
        </thead>
<tbody>

<?php
if(count($all_data)){
	foreach($all_data as $set_data){
	   $user = $this->comman_model->get_by('users',array('id'=>$set_data->user_id),false,false,true);
		if(!empty($user)){
			$user_name = $user->first_name.' '.$user->last_name;
		}
		else{
			$user_name = 'No User';
		}
?>
                        <tr>
							<td><?=$set_data->code;?></td>
							<td><?=$user_name;?></td>
							<td><?=$set_data->reduction_amount;?></td>
							<td><?=$set_data->remaining;?></td>
							<td><?=($set_data->is_used==0)?'Not Used':'Used';?></td>
							<td><?=$set_data->end_date;?></td>
							
							<td>
                            <a class="btn btn-icon-only blue tooltips" href="admin/voucher/send_mail/<?php echo $set_data->id;?>/true" title="Send Mail" data-original-title="Send Mail" data-placement="top">
										<i class="fa fa-mail-forward"></i></a>
                            <a class="btn btn-icon-only green tooltips" href="admin/voucher/edit/<?php echo $set_data->id;?>" title="Edit" data-original-title="Edit" data-placement="top">
										<i class="fa fa-edit"></i></a>
                            	<a class="btn btn-icon-only red" href="admin/voucher/delete/<?php echo $set_data->id;?>"  onclick="return confirm_box();" title="Delete">
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
    <div class="row">
        <div class="col-md-5 col-sm-12">
            <div class="dataTables_info" id="sample_6_info" role="status" aria-live="polite">
<?php
/*$start = $this->pagination->cur_page * $this->pagination->per_page;
$end = $start + $this->pagination->per_page;
$total = $this->pagination->total_rows;
echo "Showing $start to $end of $total entries";*/
//echo $range;
?>
            
            </div>
        </div>
        <div class="col-md-7 col-sm-12">
            <div class="dataTables_paginate paging_simple_numbers" id="sample_6_paginate">
            <?php 
                if($pagination):
                     echo $pagination;
                endif;
            ?>

            <!--<ul class="pagination">
            <li class="paginate_button previous disabled">
            <a href="#"><i class="fa fa-angle-left"></i></a></li>
            <li class="paginate_button active"><a href="#">1</a></li>
            <li class="paginate_button "><a href="#">2</a></li>
            <li class="paginate_button " aria-controls="sample_6" tabindex="0"><a href="#">3</a></li><li class="paginate_button " aria-controls="sample_6" tabindex="0"><a href="#">4</a></li><li class="paginate_button " aria-controls="sample_6" tabindex="0"><a href="#">5</a></li><li class="paginate_button next" aria-controls="sample_6" tabindex="0" id="sample_6_next"><a href="#"><i class="fa fa-angle-right"></i></a></li></ul>-->
            </div>
        </div>
    </div>
</div>
							</div>
							
							
						</div>
					</div>
            </div>
                    
            
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>



<script>
function get_active(name,id,value){
    $.ajax({
       type: "POST",
       url: "admin/product/get_active", /* The country id will be sent to this file */
       data: {id:id,type:name,value:value},
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
function get_status(name,id,value){
	//alert(name+' '+id+' '+value);
    $.ajax({
       type: "POST",
       url: "admin/product/get_confirm", /* The country id will be sent to this file */
       data: "id="+id+"&confirm="+value,
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
    var answer = confirm ("Are you sure?");
    if (!answer)
     return false;
}
</script>