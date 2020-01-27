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
<ul class="nav nav-tabs">
    <li class="active"><a href="javascript:void(0);">All</a></li>
    <li class=""><a href="<?=$_cancel;?>/index_rating">Rating</a></li>
</ul>

    <div class="table-responsive" style="margin-top:10px">
        <table id="data-table" class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th><?=show_static_text($adminLangSession['lang_id'],244);?></th>								
                    <th><?=show_static_text($adminLangSession['lang_id'],1006);?>Company Name</th>
                    <th><?=show_static_text($adminLangSession['lang_id'],16);?></th>
                    <th><?=show_static_text($adminLangSession['lang_id'],18);?></th>
                    <th><?=show_static_text($adminLangSession['lang_id'],1800);?>Total user</th>
                    <th><?=show_static_text($adminLangSession['lang_id'],1800);?>Rating</th>
                    <th><?=show_static_text($adminLangSession['lang_id'],1800);?>System Rating</th>
                    <th><?=show_static_text($adminLangSession['lang_id'],1600);?>Phone</th>
                    <th width="200"><?=show_static_text($adminLangSession['lang_id'],258);?></th>
                </tr>
                </thead>
                <tbody>

<?php
if(count($all_data)){
	foreach($all_data as $set_data){
		$total_rating  = 0;
		$total_rate = 0;

		$userCount = count($this->comman_model->get_by('users',array('parent_id'=>$set_data->id),false,false,false));

		//system rating
		$totalSysRate = 0;
		$sysRating = 0;
		$this->db->select('rate');
		$check_product = $this->comman_model->get_by('problems',array('customer_id'=>$set_data->id,'status'=>'Completed'),false,false,false);
		$problemArr = array();
		if($check_product){
			foreach($check_product as $set_pro){
				$totalSysRate = $totalSysRate+$set_pro->rate;
			}
			$sysRating = ($totalSysRate/count($check_product));
		}

		$this->db->select('id');
		$check_product = $this->comman_model->get_by('problems',array('customer_id'=>$set_data->id),false,false,false);
		$problemArr = array();
		if($check_product){
			foreach($check_product as $set_pro){
				$problemArr[] =$set_pro->id;
			}
		}
		if($problemArr){
			$this->db->where_in('problem_id',$problemArr);
			$rating_data = $this->comman_model->get('problems_rating',false);
			if($rating_data){
				$this->db->select_sum('rate');
				$this->db->where_in('problem_id',$problemArr);
				$total_rating = $this->comman_model->get('problems_rating',false);
				//echo $this->db->last_query();
				$rate_times = count($rating_data);
				//$rate_value = $total_rating/$rate_times;
				$total_rate = $total_rating[0]->rate/$rate_times;
				//$total_rate = (($rate_value)/5)*100;
			}
		}


?>
<tr>
    <td><?=$set_data->id; ?></td>
    <td><?=$set_data->company_name; ?></td>
    <td><?=$set_data->first_name.' '.$set_data->last_name; ?></td> 
    <td><?=$set_data->email; ?></td>
    <td><?=$userCount; ?></td>
    <td><?=round($total_rate,1); ?></td>
    <td><?=round($sysRating,1); ?></td>
    
    <td><?=$set_data->phone; ?></td>
    <td>
<a class="btn btn-icon-only btn-success " href="<?=$_edit?>/<?=$set_data->id;?>" ><i class="fa fa-edit"></i></a>
<a class="btn btn-icon-only btn-info " href="<?=$_cancel.'/send_mail/'.$set_data->id;?>" title="Send Mail" ><i class="fa fa-share"></i></a>
<a class="btn btn-icon-only btn-danger" href="<?=$_delete?>/<?=$set_data->id;?>"  onclick="return confirm_box();" ><i class="fa fa-trash-o"></i></a>

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
function get_status(type,id,value){
	//alert(name+' '+id+' '+value);
    $.ajax({
       type: "POST",
       url: "<?=$_cancel?>/set_value", /* The country id will be sent to this file */
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
</script>
<style>
table td{
	padding:10px 3px !important;
}
</style>