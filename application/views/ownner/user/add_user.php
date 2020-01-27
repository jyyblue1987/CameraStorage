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
                        <label class="col-sm-2 control-label">Username</label>
                        <div class="col-sm-4">
							<input type="text" name="username" value="<?php echo set_value('username'); ?>" class="form-control"  />
                            <span style="color:#F00;"><?php echo form_error('username'); ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-4">
							<input type="email" name="email" value="<?php echo set_value('email'); ?>" class="form-control"  />
                            <span style="color:#F00;"><?php echo form_error('email'); ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Type</label>
                        <div class="col-sm-4">
							<select name="type" class="populate placeholder" style="width:332px" required>
				            	<option value="">Select</option>
                           		<option value="booster">Booster</option>
                           		<option value="coach">Coach</option>            
    				        </select>
                            
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label">hourly rate</label>
                        <div class="col-sm-4">
							<input type="text" name="hour_rate" value="<?php echo set_value('hour_rate'); ?>" class="form-control"  />
                            <span style="color:#F00;"><?php echo form_error('hour_rate'); ?></span>
							
                            
                        </div>
                    </div>
                    
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Image</label>
                        <div class="col-sm-4">
							<input type='file' name="photo" />
                            
                        </div>
                    </div>                    
                    
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

