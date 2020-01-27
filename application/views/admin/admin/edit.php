<?php $this->load->view('admin/includes/address'); ?>
<div class="row">
    <div class="col-xs-12 col-sm-12">
        <div class="box">
            <div class="box-header">
                <div class="box-name">
                    <i class="fa fa-search"></i>
                    <span><?php echo $name;?></span>
                </div>               
                <div class="no-move"></div>
            </div>
            <div class="box-content">
                
                <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">
                	<input type="hidden" name="operation" value="set" />
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-4">
							<input type="text" name="name" value="<?php echo $edit_data->name; ?>" class="form-control"  />
                            <span style="color:#F00;"><?php echo form_error('name'); ?></span>
                        </div>
                    </div>
                    
                    
                    
                                        
                    <?php /*?><div class="form-group">
                        <label class="col-sm-2 control-label">Image</label>
                        <div class="col-sm-4">
<?php
if(!empty($edit_data->image)){
	$image='assets/uploads/categories/small/'.$edit_data->image;
  	echo '<img alt="'.$edit_data->name.'" src="'.$image.'" class="img-rounded">';
}
?>
							<input type='file' name="photo" />                            
                        </div>
                    </div><?php */?>                    

                    
                    
                    <div class="clearfix"></div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-2">
                            <button type="submit" class="btn btn-primary btn-label-left">
                            <span><i class="fa fa-clock-o"></i></span>
                                Submit
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="assets/admin/js/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
tinymce.init({
    selector: "textarea",
    menubar : false
 });
</script>

