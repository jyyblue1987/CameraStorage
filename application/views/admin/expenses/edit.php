<div class="row">
    <div class="col-md-12">
        <!-- begin panel -->
        <div class="panel panel-inverse">
            <div class="panel-heading">                
                <h4 class="panel-title"><?=$name?></h4>
            </div>
            <div class="panel-body">

<?php echo validation_errors();?>
<?=form_open(NULL, array('class' => 'form-horizontal', 'role'=>'form','enctype'=>"multipart/form-data"))?>
<input type="hidden" name="product_id" id="input-type"  value="Product" />
<input type="hidden" name="order" value="set"  />
<div class="form-body">                    
    <div class="col-md-12">						                                                                        
        <div class="form-group">
    <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],16);?></label>
    <div class="col-lg-8">
	        <input class="form-control" type="text" name="name" value="<?=set_value('name')?>" required  />
	        <span class="error-span"><?php echo form_error('name'); ?></span>
    
    </div>    
    </div>

	<div class="form-group ">
      <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],263);?></label>
      <div class="col-lg-5">
        <div class="fileinput fileinput-new" data-provides="fileinput">
            <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
                <?php echo !isset($products->image) ? '<img src="assets/uploads/no-image.gif">' :'<img src="'.base_url('assets/uploads/expenses').'/'.$products->image.'" >'; ?>
            </div>
            <div>
            <span class="btn btn-default btn-file"><span class="fileinput-new"><?=show_static_text($adminLangSession['lang_id'],159);?></span><span class="fileinput-exists"><?=show_static_text($adminLangSession['lang_id'],160);?></span>
            <input type="file" name="logo" id="logo"></span>
            <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput"><?=show_static_text($adminLangSession['lang_id'],109);?></a>
        </div>
        </div>
            <!--<input type="file" name="logo" id="logo" />-->
      </div>
                  
    </div>	
    
    <div class="form-group" >
        <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],229);?></label>
        <div class="col-lg-8">
	        <input class="form-control" type="text" name="price" value="<?=set_value('price')?>" required  />
	        <span class="error-span"><?php echo form_error('price'); ?></span>
        </div>
    </div>

        <div class="form-group" >
	<label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],153);?></label>
	<div class="col-lg-8">
    <input class="form-control" type="text" id="input-date" name="dates" value="<?=h_dateFormat(set_value('dates',date('d-m-Y')),'d-m-Y')?>" data-date-format="dd-mm-yyyy" required  />
    <span class="error-span"><?php echo form_error('dates'); ?></span>
	</div>
</div>

		<div class="form-group" >
	<label class="col-lg-2 control-label">Description</label>
	<div class="col-lg-8">
	<?=form_textarea('description',set_value('description', $this->input->post('description')), 'placeholder="" rows="3" class="cleditor2 form-control"')?>	
	</div>
</div>
                
    </div>

	<div style="clear:both"></div>

</div>
<div class="form-actions">
	<div class="row">
		<div class="col-md-offset-2 col-md-9">
<?=form_submit('submit', show_static_text($adminLangSession['lang_id'],235), 'class="btn btn-primary" ')?> 
<a href="<?=$_cancel;?>" class="btn btn-default" type="button"><?=show_static_text($adminLangSession['lang_id'],22);?></a>
		</div>
	</div>
</div>
<?=form_close()?>

            </div>
        </div>        
        <!-- end panel -->
    </div>
</div>


<link href="assets/global/plugins/bootstrap-datepicker/css/datepicker.css"  rel='stylesheet' type='text/css' >
<script type="text/javascript" src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script>
$(document).ready(function(){
	//$('&nbsp;').appendTo('div.dataTables_filter');
	//$('div.dataTables_filter').appendTo('<button id="refresh">Refresh</button>');
	$('#input-date').datepicker({ dateFormat: 'mm-dd-yy', altField: '#input-date_alt', altFormat: 'yy-mm-dd' }).on('changeDate', function(e){
		
    $(this).datepicker('hide');});

});
</script>

<link href="assets/plugins/jasny-bootstrap/css/jasny-bootstrap.min.css" rel="stylesheet" type="text/css"/>
<script src="assets/plugins/jasny-bootstrap/js/jasny-bootstrap.min.js" type="text/javascript" language="javascript"></script> 

