<style>
.table th{
	vertical-align:top !important;
}
</style>
<div class="row">
    <div class="col-md-12">
        <h2><?=$name?></h2>

<ul class="nav nav-tabs">
    <li class="active"><a href="#tab1" data-toggle="tab">All</a></li>
    <li class=""><a href="#tab2" data-toggle="tab">Pending <?=count($all_pnd_data)>0?'('.count($all_pnd_data).')':''?></a></li>
    <li class=""><a href="#tab3" data-toggle="tab">Confirm</a></li>
    <li class=""><a href="#tab4" data-toggle="tab">Cancel</a></li>
</ul>

<div class="tab-content tab-content2" style="padding:10px 20px">
        <div class="tab-pane fade  in active" id="tab1">
<div class="row" style="margin-bottom:10px">
	    <div class="col-md-3">
    		<div class="btn-group">
			    <a href="<?=$_cancel.'/payment'?>" class="btn btn-primary m-r-5 m-b-5"><?=show_static_text($lang_id,7);?> <i class="fa fa-plus"></i></a>
		    </div>
	    </div>
		<div class="col-md-9">
	<table style="width: 67%;" border="0" cellpadding="3" cellspacing="0" class="pull-right">
        <tbody>
            <tr id="filter_col1" data-column="0">
                <td align="right" style="padding:0 5px"><input class="column_filter datetimepicker1" data-date-format="dd-mm-yyyy"   data-id="7" id="col7_filter" type="text" placeholder="Date"></td>
            </tr>
        </tbody>
    </table>
</div>            	
	    </div>
		    <div class="table-responsive">
        		<table id="data-table1" class="table table-striped table-bordered">
        <thead>
              <tr>
                <th><?=show_static_text($lang_id,244);?></th>								
                <th><?=show_static_text($lang_id,242);?></th>
                <th><?=show_static_text($lang_id,112);?></th>
                <th><?=show_static_text($lang_id,41);?></th>
                <th><?=show_static_text($lang_id,64);?></th>
                <th><?=show_static_text($lang_id,316);?></th>
                <th><?=show_static_text($lang_id,116);?></th>
                <th><?=show_static_text($lang_id,94);?></th>
                <th><?=show_static_text($lang_id,153);?></th>
                <th><?=show_static_text($lang_id,15);?></th>
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
		$className = '';
		if($set_data->user_id!=0){
			$user_data = $this->comman_model->get_by('users',array('parent_id'=>$user_details->id,'id'=>$set_data->user_id,'account_type'=>'A'),false,false,true);
			if($user_data){
				if($set_data->classes){
					$temp = explode(',',$set_data->classes);
					$this->db->where_in('id',$temp);
						$classD = $this->comman_model->get_by('classes',array('user_id'=>$user_details->id),false,false,false);
						if($classD){
							foreach($classD as $setClass){
								$className .=$setClass->name.', ';
							}
						}
				}

		if($className){
			$className = trim($setClass->name,', ');
		}
		else{
			$className = '-';
		}

?>

<tr>
    <td><?=$i; ?></td>
    <td><?=$user_data->first_name.' '.$user_data->last_name?></td>
    <td><?=$set_data->name?></td>
<!--    <td><?=$className;?></td>-->
    <td><?=$set_data->amount?></td>
    <td><?=array_key_exists($set_data->month,$month_data)?$month_data[$set_data->month]:$set_data->month?></td>
    <td><?=$set_data->class_count?></td>
    <td><?=$set_data->payment_type?></td>
    <td><?=h_dateFormat($set_data->s_date,'d-m-Y')?></td>
    <td><?=h_dateFormat($set_data->on_date,'d-m-Y')?></td>
    <td><?=$set_data->created_by=='gym'?"GYM Ownner":'User'?></td>	    
    <td>
<?php
if($set_data->status=='Pending'&&$set_data->payment_type!='Paypal'){
?>
<a class="btn btn-xs  btn-info options-<?=$set_data->id?>" href="javascript:void(0)" onclick="confirm_box(<?=$set_data->id?>,'confirm');">Get Confrim</a>

<a class="btn btn-xs  btn-warning aftr-btn-<?=$set_data->id?> options-<?=$set_data->id?>" href="javascript:void(0)" onclick="confirm_box(<?=$set_data->id?>,'cancel');">Get Cancel</a>
<?php
}
else{
	if($set_data->status=='Confirm'){
		$userStatus	= '<label class="label label-success">'.$set_data->status.'</label>';
	}
	else{
		$userStatus	= '<label class="label label-warning">'.$set_data->status.'</label>';
	}
	echo $userStatus;
}
?>
    </td>							
</tr>
<?php             
			}
		}
   }
}
?>                        

</tbody>							
        </table>
		    </div>    
    	</div>
        <div class="tab-pane fade " id="tab2">
		    <div class="table-responsive">
	        	<table id="data-table2" class="table table-striped table-bordered">
        <thead>
              <tr>
                <th><?=show_static_text($lang_id,244);?></th>								
                <th><?=show_static_text($lang_id,242);?></th>
                <th><?=show_static_text($lang_id,112);?></th>
                <th><?=show_static_text($lang_id,41);?></th>
                <th><?=show_static_text($lang_id,64);?></th>
                <th><?=show_static_text($lang_id,316);?></th>
                <th><?=show_static_text($lang_id,94);?></th>
                <th><?=show_static_text($lang_id,116);?></th>
                <th><?=show_static_text($lang_id,153);?></th>
                <th><?=show_static_text($lang_id,15);?></th>
                <th><?=show_static_text($lang_id,258);?></th>
            </tr>
        </thead>
		<tbody>

<?php
if(count($all_pnd_data)){
	$i = 0;
	foreach($all_pnd_data as $set_data){
		$i++;
		$userName = '-';
		$userStatus = '-';
		$className = '';
		if($set_data->user_id!=0){
			$user_data = $this->comman_model->get_by('users',array('parent_id'=>$user_details->id,'id'=>$set_data->user_id,'account_type'=>'A'),false,false,true);
			if($user_data){
				if($set_data->classes){
					$temp = explode(',',$set_data->classes);
					$this->db->where_in('id',$temp);
						$classD = $this->comman_model->get_by('classes',array('user_id'=>$user_details->id),false,false,false);
						if($classD){
							foreach($classD as $setClass){
								$className .=$setClass->name.', ';
							}
						}
				}

		if($className){
			$className = trim($setClass->name,', ');
		}
		else{
			$className = '-';
		}

?>

<tr>
    <td><?=$i; ?></td>
    <td><?=$user_data->first_name.' '.$user_data->last_name?></td>
    <td><?=$set_data->name?></td>
    <td><?=$set_data->amount?></td>
    <td><?=array_key_exists($set_data->month,$month_data)?$month_data[$set_data->month]:$set_data->month?></td>
    <td><?=$set_data->class_count?></td>
    <td><?=$set_data->payment_type?></td>
    <td><?=h_dateFormat($set_data->s_date,'d-m-Y')?></td>
    <td><?=h_dateFormat($set_data->on_date,'d-m-Y')?></td>
    <td><?=$set_data->created_by=='gym'?"GYM Ownner":'User'?></td>	    
	
    
    <td>
<?php
if($set_data->status=='Pending'){
?>
<a class="btn btn-xs  btn-info options-<?=$set_data->id?>" href="javascript:void(0)" onclick="confirm_box(<?=$set_data->id?>,'confirm');">Get Confrim</a>

<a class="btn btn-xs  btn-warning aftr-btn-<?=$set_data->id?> options-<?=$set_data->id?>" href="javascript:void(0)" onclick="confirm_box(<?=$set_data->id?>,'cancel');">Get Cancel</a>
<?php
}
else{
	if($set_data->status=='Confirm'){
		$userStatus	= '<label class="label label-success">'.$set_data->status.'</label>';
	}
	else{
		$userStatus	= '<label class="label label-warning">'.$set_data->status.'</label>';
	}
	echo $userStatus;
}
?>
    </td>							
</tr>
<?php             
			}
		}
   }
}
?>                        

</tbody>							
        </table>
		    </div>    
    	</div><!--//tab2//-->
        <div class="tab-pane fade" id="tab3">
		    <div class="table-responsive">
        		<table id="data-table3" class="table table-striped table-bordered">
        <thead>
              <tr>
                <th><?=show_static_text($lang_id,244);?></th>								
                <th><?=show_static_text($lang_id,242);?></th>
                <th><?=show_static_text($lang_id,112);?></th>
                <th><?=show_static_text($lang_id,41);?></th>
                <th><?=show_static_text($lang_id,64);?></th>
                <th><?=show_static_text($lang_id,153);?></th>
                <th><?=show_static_text($lang_id,116);?></th>
                <th><?=show_static_text($lang_id,15);?></th>
                <th><?=show_static_text($lang_id,258);?></th>
            </tr>
        </thead>
		<tbody>

<?php
if(count($all_cfrm_data)){
	$i = 0;
	foreach($all_cfrm_data as $set_data){
		$i++;
		$userName = '-';
		$userStatus = '-';
		$className = '';
		if($set_data->user_id!=0){
			$user_data = $this->comman_model->get_by('users',array('parent_id'=>$user_details->id,'id'=>$set_data->user_id,'account_type'=>'A'),false,false,true);
			if($user_data){
				if($set_data->classes){
					$temp = explode(',',$set_data->classes);
					$this->db->where_in('id',$temp);
						$classD = $this->comman_model->get_by('classes',array('user_id'=>$user_details->id),false,false,false);
						if($classD){
							foreach($classD as $setClass){
								$className .=$setClass->name.', ';
							}
						}
				}

		if($className){
			$className = trim($setClass->name,', ');
		}
		else{
			$className = '-';
		}

?>

<tr>
    <td><?=$i; ?></td>
    <td><?=$user_data->first_name.' '.$user_data->last_name?></td>
    <td><?=$set_data->name?></td>
    <td><?=$set_data->amount?></td>
    <td><?=array_key_exists($set_data->month,$month_data)?$month_data[$set_data->month]:$set_data->month?></td>
    <td><?=h_dateFormat($set_data->on_date,'d-m-Y')?></td>
    <td><?=$set_data->payment_type?></td>
    <td><?=$set_data->created_by=='gym'?"GYM Ownner":'User'?></td>
    <td>
<?php
if($set_data->status=='Pending'){
?>
<a class="btn btn-xs  btn-info options-<?=$set_data->id?>" href="javascript:void(0)" onclick="confirm_box(<?=$set_data->id?>,'confirm');">Get Confrim</a>

<a class="btn btn-xs  btn-warning aftr-btn-<?=$set_data->id?> options-<?=$set_data->id?>" href="javascript:void(0)" onclick="confirm_box(<?=$set_data->id?>,'cancel');">Get Cancel</a>
<?php
}
else{
	if($set_data->status=='Confirm'){
		$userStatus	= '<label class="label label-success">'.$set_data->status.'</label>';
	}
	else{
		$userStatus	= '<label class="label label-warning">'.$set_data->status.'</label>';
	}
	echo $userStatus;
}
?>
    </td>							
</tr>
<?php             
			}
		}
   }
}
?>                        

</tbody>							
        </table>
		    </div>    
    	</div><!--//tab3//-->
        <div class="tab-pane fade" id="tab4">
		    <div class="table-responsive">
                <table id="data-table4" class="table table-striped table-bordered">
        <thead>
              <tr>
                <th><?=show_static_text($lang_id,244);?></th>								
                <th><?=show_static_text($lang_id,242);?></th>
                <th><?=show_static_text($lang_id,112);?></th>
                <th><?=show_static_text($lang_id,41);?></th>
                <th><?=show_static_text($lang_id,64);?></th>
                <th><?=show_static_text($lang_id,153);?></th>
                <th><?=show_static_text($lang_id,116);?></th>
                <th><?=show_static_text($lang_id,15);?></th>
                <th><?=show_static_text($lang_id,258);?></th>
            </tr>
        </thead>
		<tbody>

<?php
if(count($all_cncel_data)){
	$i = 0;
	foreach($all_cncel_data as $set_data){
		$i++;
		$userName = '-';
		$userStatus = '-';
		$className = '';
		if($set_data->user_id!=0){
			$user_data = $this->comman_model->get_by('users',array('parent_id'=>$user_details->id,'id'=>$set_data->user_id,'account_type'=>'A'),false,false,true);
			if($user_data){
				if($set_data->classes){
					$temp = explode(',',$set_data->classes);
					$this->db->where_in('id',$temp);
						$classD = $this->comman_model->get_by('classes',array('user_id'=>$user_details->id),false,false,false);
						if($classD){
							foreach($classD as $setClass){
								$className .=$setClass->name.', ';
							}
						}
				}

		if($className){
			$className = trim($setClass->name,', ');
		}
		else{
			$className = '-';
		}

?>

<tr>
    <td><?=$i; ?></td>
    <td><?=$user_data->first_name.' '.$user_data->last_name?></td>
    <td><?=$set_data->name?></td>
    <td><?=$set_data->amount?></td>
    <td><?=array_key_exists($set_data->month,$month_data)?$month_data[$set_data->month]:$set_data->month?></td>
    <td><?=h_dateFormat($set_data->on_date,'d-m-Y')?></td>
    <td><?=$set_data->payment_type?></td>
    <td><?=$set_data->created_by=='gym'?"GYM Ownner":'User'?></td>    
    <td>
<?php
if($set_data->status=='Pending'){
?>
<a class="btn btn-xs btn-info options-<?=$set_data->id?>" href="javascript:void(0)" onclick="confirm_box(<?=$set_data->id?>,'confirm');">Get Confrim</a>

<a class="btn btn-xs btn-warning aftr-btn-<?=$set_data->id?> options-<?=$set_data->id?>" href="javascript:void(0)" onclick="confirm_box(<?=$set_data->id?>,'cancel');">Get Cancel</a>
<?php
}
else{
	if($set_data->status=='Confirm'){
		$userStatus	= '<label class="label label-success">'.$set_data->status.'</label>';
	}
	else{
		$userStatus	= '<label class="label label-warning">'.$set_data->status.'</label>';
	}
	echo $userStatus;
}
?>
    </td>							
</tr>
<?php             
			}
		}
   }
}
?>                        

</tbody>							
        </table>
		    </div>    
    	</div><!--//tab4//-->
</div><!--//tab-content//-->        

        <!-- end panel -->
    </div>
</div>

<link href="assets/admin_temp/plugins/DataTables/css/data-table.css" rel="stylesheet" />
<script src="assets/admin_temp/plugins/DataTables/js/jquery.dataTables.js"></script>
<script>

$('#data-table2').DataTable({
	aoColumnDefs: [
	{
	 bSortable: false,
	 aTargets: [1]
	}]
});

$('#data-table3').DataTable({
	aoColumnDefs: [
	{
	 bSortable: false,
	 aTargets: [1]
	}]
});

$('#data-table4').DataTable({
	aoColumnDefs: [
	{
	 bSortable: false,
	 aTargets: [1]
	}]
});
</script>

<script>
function confirm_box(id,type){
	if(type=='remove'){
		var answer = confirm ("Are you want to unfollow?");
		if (!answer)
			 return false;
	}
//	$('.options-'+id).attr('disabled','disabled');
	$.ajax({
		type:"POST",
		url:"<?=site_url($_cancel.'/getStatus')?>",
		data:{id:id,type:type,<?=$this->security->get_csrf_token_name();?>:'<?=$this->security->get_csrf_hash();?>'},
		dataType: 'json',
		success: function(json) {	
			$('.options-'+id).removeAttr('disabled');
			if(json.status=='ok'){
				$('.aftr-btn-'+id).after(json.msge);
				$('.options-'+id).remove();
			}
			if(json.status=='error'){
				alert(json.msge);
			}
		}
	});
}
</script>

<style>
.well{
	min-height:178px;
}
.tab-content2 {
  border: medium none;
  border-radius: 3px;
  box-shadow: 1px 2px 5px 3px #ccc;
}
</style>

<script>
function filterGlobal () {
    $('#data-table1').DataTable().search(
        $('#global_filter').val(),
        $('#global_regex').prop('checked'),
        $('#global_smart').prop('checked')
    ).draw();
}
 
function filterColumn (i){
    $('#data-table1').DataTable().column(i).search(
        $('#col'+i+'_filter').val(),
        $('#col'+i+'_regex').prop('checked'),
        $('#col'+i+'_smart').prop('checked')
    ).draw();
}
 
$(document).ready(function() {
//    $('#data-table1').DataTable();
 
$('#data-table1').DataTable({
	aoColumnDefs: [
	{
	 bSortable: false,
	 aTargets: [1]
	}]
});


    $('input.global_filter').on( 'keyup click', function () {
        filterGlobal();
    } );
 
    $('input.column_filter').on( 'keyup click', function () {
		//console.log($(this).attr('data-id'));
        filterColumn( $(this).attr('data-id'));
    } );
} );
</script>
<link href="assets/global/plugins/bootstrap-datepicker/css/datepicker.css"  rel='stylesheet' type='text/css' >
<script type="text/javascript" src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script>
$(document).ready(function(){
	//$('&nbsp;').appendTo('div.dataTables_filter');
	//$('div.dataTables_filter').appendTo('<button id="refresh">Refresh</button>');
	$('.datetimepicker1').datepicker({ dateFormat: 'mm-dd-yy', altField: '#input-date_alt', altFormat: 'yy-mm-dd' }).on('changeDate', function(e){
    $(this).datepicker('hide');
	filterColumn (7) ;
	});


});
</script>