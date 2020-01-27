<style>
.table th{
	vertical-align:top !important;
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

<ul class="nav nav-tabs">
        <li class="active">
            <a href="#tab1" data-toggle="tab">Benchmark Workouts</a>
        </li>
        <li class="">
            <a href="#tab2" data-toggle="tab">GYM Workouts</a>
        </li>
</ul>

<div class="tab-content tab-content2" style="border:none;padding:10px 0px">
    <div class="tab-pane fade in active " id="tab1">
        <div class="row">
            <div class="col-md-6">
                <div class="btn-group">
                    <a href="<?=$_edit?>" class="btn btn-primary m-r-5 m-b-5"><?=show_static_text($adminLangSession['lang_id'],233);?> <i class="fa fa-plus"></i></a>
                </div>
            </div>    	
            </div>
    
        <div class="table-responsive">
            <table id="data-table" class="table table-striped table-bordered">
            <thead>
                  <tr>
                    <th><?=show_static_text($adminLangSession['lang_id'],244);?></th>								
                    <th><?=show_static_text($adminLangSession['lang_id'],2306);?>Name</th>
                    <th><?=show_static_text($adminLangSession['lang_id'],2306);?>Description</th>
                    <th width="180"><?=show_static_text($adminLangSession['lang_id'],1670);?>Options</th>
                </tr>
            </thead>
            <tbody>
    
    <?php
    if(count($all_data)){
        $i=0;
        foreach($all_data as $set_data){
            $i++;
            $tagName ='-';
    ?>
    <tr>
        <td><?=$set_data->id;?></td>
        <td><!--<img src="<?=$image?>" class="img-rounded" style="width:30px;height:30px">--> <?=$set_data->name; ?></td>
        <td>
    <?php
    $html = strip_tags($set_data->description);
    $html = html_entity_decode($html, ENT_QUOTES, 'UTF-8');    
    echo (strlen($html)>=100)?substr($html, 0 ,100).'...':$html;
    
    ?>                            
    
        </td>
        <td>
		<a class="btn btn-icon-only btn-info" data-toggle="tooltip" data-placement="top"  title="View" href="<?=$_cancel.'/view/'.$set_data->id;?>" >
            <i class="fa fa-eye"></i></a>

	    <a class="btn btn-icon-only btn-info" data-toggle="tooltip" data-placement="top"  title="Edit" href="<?=$_cancel.'/edit/'.$set_data->id;?>" >
                <i class="fa fa-edit"></i></a>
        <a class="btn btn-icon-only btn-danger" data-toggle="tooltip" data-placement="top" title="Delete" href="<?=$_delete.'/'.$set_data->id;?>"  onclick="return confirm_box();">
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

	<div class="tab-pane fade " id="tab2">
    <div class="table-responsive">
        <table id="data-table1" class="table table-striped table-bordered">
        <thead>
              <tr>
                <th><?=show_static_text($adminLangSession['lang_id'],244);?></th>								
                <th><?=show_static_text($adminLangSession['lang_id'],2306);?>Username</th>
                <th><?=show_static_text($adminLangSession['lang_id'],2306);?>Name</th>
                <th><?=show_static_text($adminLangSession['lang_id'],2306);?>Description</th>
                <th><?=show_static_text($adminLangSession['lang_id'],1670);?>Options</th>
            </tr>
        </thead>
		<tbody>

<?php
if(count($all_g_data)){
	$i=0;
	foreach($all_g_data as $set_data){
		$i++;
		$tagName ='-';
?>
<tr>
    <td><?=$set_data->id;?></td>
    <td><?=print_value('users',array('id'=>$set_data->user_id),'username'); ?></td>
    <td><?=$set_data->name; ?></td>
    <td>
<?php
$html = strip_tags($set_data->description);
$html = html_entity_decode($html, ENT_QUOTES, 'UTF-8');    
echo (strlen($html)>=100)?substr($html, 0 ,100).'...':$html;

?>                            

    </td>
	<td>
<a class="btn btn-icon-only btn-info" data-toggle="tooltip" data-placement="top"  title="View" href="<?=$_cancel.'/view/'.$set_data->id;?>" >
            <i class="fa fa-eye"></i></a>
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
<script>

$('#data-table1').DataTable({
	aoColumnDefs: [
	{
	 bSortable: false,
	 aTargets: [1]
	}]
});

</script>
