<div class="row">
    <div class="col-md-12">
        <!-- begin panel -->
        <div data-sortable-id="form-stuff-1" class="panel panel-inverse">
            <div class="panel-heading">                
				
                <h4 class="panel-title"><?=$name?></h4>
            </div>

<div class="panel-body">
<!--<div class="row">
    <div class="col-md-6">
        <div class="btn-group">	        
            <a href="admin/userlist/send_mail" class="btn btn-primary m-r-5 m-b-5">
            Send Mail  <i class="fa fa-plus"></i>
            </a>
        </div>
    </div>
</div>-->
    <div class="table-responsive">
        <table id="data-table" class="table table-striped table-bordered">
            
                <thead>
                <tr>
			        <th><?=show_static_text($adminLangSession['lang_id'],244);?></th>
			        <th><?=show_static_text($adminLangSession['lang_id'],242);?></th>
			        <th><?=show_static_text($adminLangSession['lang_id'],18);?></th>
			        <th><?=show_static_text($adminLangSession['lang_id'],258);?></th>
                </tr>
                </thead>
                <tbody>

<?php
if(count($all_data)){
	foreach($all_data as $set_data){
?>
                        <tr>
                            <td><?=$set_data->id;?></td>
                            <td><?=$set_data->username;?></td>
                            <td><?=$set_data->email;?></td>
                            <td>

<a class="btn btn-icon-only btn-success " href="<?=$_edit?>/<?=$set_data->id;?>" ><i class="fa fa-edit"></i></a>

<a class="btn btn-icon-only btn-danger" href="<?=$_delete?>/<?=$set_data->id;?>"  onclick="return confirm_box();" title=""><i class="fa fa-trash-o"></i></a>

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

$(document).ready(function(){
	$('&nbsp;<a href="<?=$_add?>" class="btn btn-success m-r-5 m-b-5">Add New <i class="fa fa-plus"></i></a>').appendTo('div.dataTables_filter');
	//$('div.dataTables_filter').appendTo('<button id="refresh">Refresh</button>');
});

</script>