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
			    <a href="admin/userlist/send_mail"class="btn btn-primary m-r-5 m-b-5">Send Mail <i class="fa fa-plus"></i></a>
		    </div>
	    </div>
    </div>-->

    <div class="table-responsive">
        <table id="data-table" class="table table-striped table-bordered">
            <thead>
            <tr>
                    <th class=""><?=show_static_text($adminLangSession['lang_id'],1600);?>S. No.</th>
                    <th class=""><?=show_static_text($adminLangSession['lang_id'],1600);?>Name</th>
                    <th class=""><?=show_static_text($adminLangSession['lang_id'],4001);?>Email</th>
                    <th class=""><?=show_static_text($adminLangSession['lang_id'],4001);?>Telphone</th>
                    <th class=""><?=show_static_text($adminLangSession['lang_id'],4001);?>Member</th>
                    <th class=""><?=show_static_text($adminLangSession['lang_id'],4001);?>Room</th>
                    <th class=""><?=show_static_text($adminLangSession['lang_id'],4001);?>Check In</th>
                    <th class=""><?=show_static_text($adminLangSession['lang_id'],4001);?>Check Out</th>
                    <th class=""><?=show_static_text($adminLangSession['lang_id'],4001);?>Options</th>
            </tr>
            </thead>
            <tbody>

<?php
if(count($all_data)){
	$i=0;
	foreach($all_data as $set_data){
		$i++;
?>
                  <tr id="tablerow">
                    <td class=""><?=$i;?></td>
                    <td class=""><?=$set_data->name;?></td>
                    <td class=""><?=$set_data->email?> </td>
                    <td class=""><?=$set_data->phone?> </td>
                    <td class=""><?=$set_data->member?> </td>
                    <td class=""><?=$set_data->room?> </td>
                    <td class=""><?=$set_data->check_in?> </td>
                    <td class=""><?=$set_data->check_out?> </td>
                    <td><a class="btn btn-icon-only btn-danger" href="<?=$_delete?>/<?=$set_data->id;?>"  onclick="return confirm_box();" title="Delete">
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