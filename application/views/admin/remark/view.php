<style>
.control-label{
	padding:0x;
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

<?php echo validation_errors();?>
<?=form_open(NULL, array('class' => 'form-horizontal', 'role'=>'form','enctype'=>"multipart/form-data"))?>

<div class="form-body">
                    <div class="form-group" >
                    <label class="col-lg-2 control-label">Title</label>
                    <div class="col-lg-8 col-md-8">
<?=$remarks->name;?>
                    </div>
                </div>
                
                
                
			<div class="form-group" >
                    <label class="col-md-2 control-label">Attachment</label>                	
                    <div class="col-md-8">

<?php
if(isset($remarks->files)&&!empty($remarks->files)){
	echo $remarks->files;
	echo '<br><a class="btn " href="'.$_cancel.'/download/'.$stores->id.'/'.$remarks->files.'" onclick="" >Download</a>';
}
?>
                    </div>                    
                </div>                

	<div class="form-group">
<label class="col-md-2 control-label">Date</label>
<div class="col-md-8 ">
<?=set_value('dates', $remarks->dates);?>
</div>
</div>                

                <div class="form-group" >
                    <label class="col-lg-2 control-label">Description</label>
                    <div class="col-lg-8 col-md-8">
<?=$remarks->desc?>
                    </div>
                </div>
                        
                </div>
<?php
if($remarks->created_by=='admin'){
?>
	                 <div class="form-actions">
                            <div class="row">
                                <div class="col-md-9">
                                    <a href="<?=$_cancel.'/calander/'.$stores->id;?>" class="btn btn-default" type="button"><?=show_static_text($adminLangSession['lang_id'],2200);?>Back</a>
                                    <a href="<?=$_cancel.'/edit/'.$stores->id.'/'.$remarks->id;?>" class="btn btn-primary" type="button"><?=show_static_text($adminLangSession['lang_id'],2200);?>Edit</a>
                                    <a href="<?=$_cancel.'/delete/'.$stores->id.'/'.$remarks->id;?>" class="btn btn-warning" type="button" onclick="return confirm_box();" ><?=show_static_text($adminLangSession['lang_id'],2200);?>Delete</a>
                                </div>
                            </div>
                        </div>
<?php
}
?>
                 <?=form_close()?>
            </div>
        </div>
        <!-- end panel -->
    </div>

	<!--col-md-12-->

    
    
    

    
    <!--end col-md-12-->
</div>

<script>
function confirm_box(){
    var answer = confirm ("<?=show_static_text($adminLangSession['lang_id'],265);?>");
    if (!answer)
     return false;
}
</script>

