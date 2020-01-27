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
                
                <form class="form-horizontal" role="form" method="post">
                	<input type="hidden" name="operation" value="set" />
                                        
                    <div class="form-group">                                          
                        <label class="col-sm-2 control-label">Subject</label>
                        <div class="col-sm-4">
							<input type="text" name="subject" size="50px" value="<?php echo set_value('subject'); ?>" class="form-control"   required autofocus/>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="form-styles">Message</label>
                        <div class="col-sm-10">
                                <textarea class="form-control" name="message" rows="5" ><?php echo set_value('message'); ?></textarea>
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
