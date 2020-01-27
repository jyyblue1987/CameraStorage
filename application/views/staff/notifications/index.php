<div class="row">
    <div class="col-md-12">
        <!-- begin panel -->
        <div data-sortable-id="form-stuff-1" class="panel panel-inverse">
            <div class="panel-heading">                
                <h4 class="panel-title"><?=$name?></h4>
            </div>

<div class="panel-body">

    <div class="table-responsive">
        <table id="data-table" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th><?=show_static_text($lang_id,244);?></th>
                    <th><?=show_static_text($lang_id,16);?></th>
                    <th><?=show_static_text($lang_id,255);?></th>
                    <th><?=show_static_text($lang_id,156);?></th>
                </tr>
            </thead>
            <tbody>
            <!-- Start: list_row -->
<?php
if(count($all_data)){
foreach($all_data as $set_data){
?>
                <tr>
                    <td><?php echo $set_data->id;?></td>
                    <td><?php echo $set_data->name;?></td>
                    <td><?php echo $set_data->subject;?></td>
                    <td>
<a class="btn btn-icon-only btn-info" href="<?=$_cancel.'/edit/'.$set_data->id;?>"><i class="fa fa-edit"></i></a>

                    </td>
                </tr>

<?php             
}
}
?>                        
            <!-- End: list_row -->
            </tbody>
        </table>
    </div>
</div>

        </div>
        <!-- end panel -->
    </div>
</div>
