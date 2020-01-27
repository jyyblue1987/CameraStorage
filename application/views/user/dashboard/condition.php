<style>
.static-info {
  margin-bottom: 10px;
}
.static-info .name {
  font-size: 14px;
  font-weight: 600;
}
.static-info .value {
  font-size: 14px;
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
<div class="portlet-body">
<?php
$condition = $this->comman_model->get_by('users_support',array('user_id'=>$user_details->parent_id),false,false,true);
//printR($condition);
if($condition){
	echo $condition->term_desc;
}
?>        
</div>

            </div>
        </div>
        <!-- end panel -->
    </div>   
</div>

