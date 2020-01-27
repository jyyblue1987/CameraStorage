<div class="row">
	<div class="col-md-12">
	    <div class="portlet box blue-hoki">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-gift"></i><?php echo $name;?>
            </div>
            <!--<div class="tools">
                <a href="javascript:;" class="collapse">
                </a>
                <a href="#portlet-config" data-toggle="modal" class="config">
                </a>
                <a href="javascript:;" class="reload">
                </a>
                <a href="javascript:;" class="remove">
                </a>
            </div>-->
        </div>
        <div class="portlet-body form">
            <!-- BEGIN FORM-->
            <?php //echo validation_errors();?>
            <form class="form-horizontal"  method="post" enctype="multipart/form-data">
                	<input type="hidden" name="operation" value="set" />
                    <div class="form-body">

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
                        <label class="col-sm-2 control-label">Password</label>
                        <div class="col-sm-4">
							<input type="password" name="password" value="<?php echo set_value('password'); ?>" class="form-control"  />
                            <span style="color:#F00;"><?php echo form_error('password'); ?></span>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Image</label>
                        <div class="col-sm-4">
							<input type='file' name="photo" />
                            
                        </div>
                    </div>                    
	                </div>
                    <div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-2 col-md-9">
                            <button type="submit" class="btn green">Create</button>
                            <!--<button type="button" class="btn default">Cancl</button>-->
                        </div>
                    </div>
                </div>
                </form>
            
            <!-- END FORM-->
        </div>
    </div>
    </div>
</div>

