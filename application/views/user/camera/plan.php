<style>
.price-list	h4.text-center{
	color:#FFF;
}
}
</style>
<div class="row">
    <div class="col-md-12">
        <h3 class=""><?=$name?></h3>

<div class="row price-list">

<?php
if($all_data){
	foreach($all_data as $set_data){
/*		$this->db->order_by('id','desc');
		$array = array('product_id'=>$set_data->id,'ownner_id'=>$user_details->parent_id,'user_id'=>$user_details->id);
		$checkPrevPayment = $this->comman_model->get_by('user_membership_history',$array,false,false,true);*/
		$this->db->limit(4);
		$get_membership = $this->comman_model->get_by('memberships',array('plan_id'=>$set_data->id),false,false,false);
?>
<div class="col-md-4">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h4 class="text-center"><?=$set_data->name?></h4>
                </div>                
                <ul class="list-group list-group-flush text-center">
<?php
if($get_membership){
	foreach($get_membership as $set_get_m){
		$setPrice = $set_get_m->price;
		$checkUsePrice = $this->comman_model->get_by('plans_c',array('user_id'=>$user_details->id,'plan_id'=>$set_get_m->id,'is_set'=>1),false,false,true);
		if($checkUsePrice){
			$setPrice = $checkUsePrice->price;
		}
?>
<li class="list-group-item">
	<strong><?=$set_get_m->name?> : </strong>$<?=$setPrice?> /mo USD
	<span class="glyphicon glyphicon-ok pull-right"></span>
</li>
<?php
	}
}
?>
                                                            
                </ul>
                <div class ="panel-footer">
<div>
<?=$set_data->description?>
</div>                
                </div>

                <div class ="panel-footer">
					<button onclick="window.location='<?=$_cancel.'/plan/'.$set_data->id?>'" class="btn btn-primary btn-block gir-list-btn">More</button>
                </div>
            </div>
        </div>
<?php
	}
}
?>
</div><!--//row//-->


</div>

        <!-- end panel -->
    </div>
</div>

