<style>
.price-list	h4.text-center{
	color:#FFF;
}
.price-list	.lead{
	margin-bottom:0px;
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
?>
<div class="col-md-4">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h4 class="text-center"><?=$set_data->name?></h4>
                </div>
                <div class="panel-body text-center">
                    <p class="lead">
                        <strong><?=$set_data->price?> Peso / <?=$set_data->month?>month</strong>
                    </p>
                </div>
                <ul class="list-group list-group-flush text-center">
                    <li class="list-group-item">
                        <strong>1 Coach : </strong>  <?=$set_data->coach?>
                        <span class="glyphicon glyphicon-ok pull-right"></span>
	                </li>
                    <li class="list-group-item">
                        <strong>1 Athlete : </strong>  <?=$set_data->member?>
                        <span class="glyphicon glyphicon-ok pull-right"></span>
                    </li>
                    <li class="list-group-item">
                        <strong>1 Staff : </strong>  <?=$set_data->staff?>
                        <span class="glyphicon glyphicon-ok pull-right"></span>
                    </li>                    
                    <li class="list-group-item">
                        <strong>1 Competition : </strong>  <?=$set_data->competition?>
                        <span class="glyphicon glyphicon-ok pull-right"></span>
                    </li>                    

                    <li class="list-group-item">
                        <strong>1 Photographer : </strong>  <?=$set_data->photographer?>
                        <span class="glyphicon glyphicon-ok pull-right"></span>
                    </li>                    

                    <li class="list-group-item">
                        <strong>1 Sport Nutritionist : </strong>  <?=$set_data->nutritionist?>
                        <span class="glyphicon glyphicon-ok pull-right"></span>
                    </li>                    

                    <li class="list-group-item">
                        <strong>1 Affiliate Business : </strong>  <?=$set_data->business?>
                        <span class="glyphicon glyphicon-ok pull-right"></span>
                    </li>                    

                    <li class="list-group-item">
                        <strong>1 Tournament : </strong>  <?=$set_data->tournament?>
                        <span class="glyphicon glyphicon-ok pull-right"></span>
                    </li>                    
                </ul>
                <div class ="panel-footer">
<div>
<?=$set_data->desc?>
</div>                
                </div>

                <div class ="panel-footer">
<?php
if($set_data->id==$user_details->plan_id){
?>
<button id="follow-<?=$set_data->id?>" class="btn <?=$user_details->plan_status=='Confirm'?'btn-success':'btn-primary'?> btn-block ">Active</button>
<?php
}
else{
?>
<button onclick="window.location='<?=$_cancel.'/view/'.$set_data->id?>'" class="btn btn-primary btn-block gir-list-btn">View</button>
<?php
}
?>
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

<script>
function add_mem(id){
	var answer = confirm ("Are you want to this membership?");
	if (!answer)
		 return false;

	$('#follow-'+id).attr('disabled','disabled');
	$.ajax({
		type:"POST",
		url:"<?=site_url($_cancel.'/get_membership')?>",
		data:{id:id,<?=$this->security->get_csrf_token_name();?>:'<?=$this->security->get_csrf_hash();?>'},
		dataType: 'json',
		success: function(json) {	
			$('#follow-'+id).removeAttr('disabled');
			if(json.status=='ok'){
/*				$('#follow-'+id).attr("onclick","add_to_following("+id+",'remove')");
				$('#follow-'+id).remove();
				$('.gir-list-btn').revmove();*/

				$('#follow-'+id).removeClass('btn-primary');
				$('#follow-'+id).removeClass('gir-list-btn');
				$('#follow-'+id).addClass('btn-success');
				$('#follow-'+id).html('Pending');
				$('.gir-list-btn').remove();
			}
			if(json.status=='error'){
				alert(json.msge);
			}
		}
	});
}
</script>