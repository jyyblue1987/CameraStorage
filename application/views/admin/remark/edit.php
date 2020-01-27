<div class="row">
    <div class="col-md-12">
        <!-- begin panel -->
        <div data-sortable-id="form-stuff-1" class="panel panel-inverse">
            <div class="panel-heading">                
                <h4 class="panel-title"><?=$name?></h4>
            </div>
            <div class="panel-body">

<?php echo validation_errors();?>
<?=form_open(NULL, array('class' => 'form-horizontal', 'role'=>'form','enctype'=>"multipart/form-data"))?>

<div class="form-body">
                    <div class="form-group" >
                    <label class="col-lg-2 control-label">Title</label>
                    <div class="col-lg-8 col-md-8">
                       <?=form_input('name', set_value('name', $remarks->name), 'class="form-control " id="" placeholder="" required')?>
                    </div>
                </div>
                
                
                
			<div class="form-group" >
                    <label class="col-md-2 control-label">Attachment</label>                	
                    <div class="col-md-8">
						<input type="file" name="logo" id="logo">

<?php
if(isset($remarks->files)&&!empty($remarks->files)){
	echo $remarks->files;
	echo '<a class="btn " href="'.$_cancel.'/remove_file/'.$remarks->id.'" onclick="" >Remove</a>';
}
?>
                    </div>                    
                </div>                

	<div class="form-group">
<label class="col-md-2 control-label">Date</label>
<div class="col-md-8 ">
<input class="form-control" type="text" id="best_sellers_start" placeholder="Date" name="dates"  data-date-format="dd-mm-yyyy" value="<?=set_value('dates', $remarks->dates);?>" />
</div>
</div>                

                <div class="form-group" >
                    <label class="col-lg-2 control-label">Description</label>
                    <div class="col-lg-8 col-md-8">
                       <?=form_textarea('desc', set_value('desc', $remarks->desc), 'placeholder="" rows="3" style="height:80px" class="form-control" required')?>
                    </div>
                </div>
                        
                </div>
	                 <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-2 col-md-9">
                                    <?=form_submit('submit', show_static_text($adminLangSession['lang_id'],235), 'class="btn btn-primary"')?>
                                    <a href="<?=$_cancel;?>" class="btn btn-default" type="button"><?=show_static_text($adminLangSession['lang_id'],22);?></a>
                                </div>
                            </div>
                        </div>
                 <?=form_close()?>
            </div>
        </div>
        <!-- end panel -->
    </div>

	<!--col-md-12-->

    
    
    

    
    <!--end col-md-12-->
</div>

<link href="assets/global/plugins/bootstrap-datepicker/css/datepicker.css"  rel='stylesheet' type='text/css' >
<script type="text/javascript" src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script>
$(document).ready(function(){
	//$('&nbsp;').appendTo('div.dataTables_filter');
	//$('div.dataTables_filter').appendTo('<button id="refresh">Refresh</button>');
	$('#best_sellers_start').datepicker({ dateFormat: 'mm-dd-yy', altField: '#best_sellers_start_alt', altFormat: 'yy-mm-dd' });

});
</script>

