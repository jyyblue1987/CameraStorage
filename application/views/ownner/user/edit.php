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
            <?php echo validation_errors();?>
            <form class="form-horizontal"  method="post" enctype="multipart/form-data">
                	<input type="hidden" name="operation" value="set" />
                    <div class="form-body">
                        <div class="form-group" >
                            <label class="col-lg-2 control-label">First Name</label>
                            <div class="col-lg-10">
                                <?=form_input('first_name', set_value('first_name', $partners->{'first_name'}), 'class="form-control " id="" placeholder="First Name"')?>
                            </div>
                        </div>
                        <div class="form-group" >
                            <label class="col-lg-2 control-label">Last Name</label>
                            <div class="col-lg-10">
                                <?=form_input('last_name', set_value('last_name', $partners->{'last_name'}), 'class="form-control " id="" placeholder="Last Name"')?>
                            </div>
                        </div>
                        <div class="form-group" >
                            <label class="col-lg-2 control-label">Email-ID</label>
                            <div class="col-lg-10">
                                <?=form_input('email', set_value('email', $partners->{'email'}), 'class="form-control " id="" placeholder="Email-ID"')?>
                            </div>
                        </div>
                        <div class="form-group" >
                            <label class="col-lg-2 control-label">Phone</label>
                            <div class="col-lg-10">
                                <?=form_input('phone', set_value('phone', $partners->{'phone'}), 'class="form-control " id="" placeholder="Phone"')?>
                            </div>
                        </div>
                        <div class="form-group" >
                            <label class="col-lg-2 control-label">Date Of Birth</label>
                            <div class="col-lg-10">
                                <?=form_input('dob', set_value('dob', $partners->{'dob'}), 'class="form-control date-picker " data-date-format="dd-mm-yyyy" readonly=""  id="" placeholder="Date Of Birth"')?>
                            </div>
                        </div>
                        <div class="form-group" >
                            <label class="col-lg-2 control-label">Password</label>
                            <div class="col-lg-10">
                                <?=form_input('password', set_value('password', $partners->{'password'}), 'class="form-control " id="" placeholder="Password"')?>
                            </div>
                        </div>
                        <div class="form-group" >
                            <label class="col-lg-2 control-label">Address</label>
                            <div class="col-lg-10">
                                <?=form_input('address', set_value('address', $partners->{'address'}), 'class="form-control " id="" placeholder="Address"')?>
                            </div>
                        </div>

                        <div class="form-group" >
                            <label class="col-lg-2 control-label">City</label>
                            <div class="col-lg-10">
                                <?=form_input('city', set_value('city', $partners->{'city'}), 'class="form-control " id="" placeholder="City"')?>
                            </div>
                        </div>

                        <div class="form-group" >
                            <label class="col-lg-2 control-label">Country</label>
                            <div class="col-lg-10">
                                <?=form_input('country', set_value('country', $partners->{'country'}), 'class="form-control " id="" placeholder="Country"')?>
                            </div>
                        </div>
                                        
                    
                    
                    <div class="form-group">
                      <label class="col-lg-2 control-label"><?=lang('image')?></label>
                      <div class="col-lg-10">
				      	<div class="fileinput fileinput-new" data-provides="fileinput">
							<div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
                                <?php echo !isset($partners->image) ? '<img src="assets/uploads/no-image.gif">' :'<img src="'.base_url('assets/uploads/users/thumbnails').'/'.$partners->image.'" >'; ?>
                            </div>
							<div>
						    <span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span>
    	    	            <input type="file" name="logo" id="logo"></span>
						    <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                     	</div>
                   		</div>
                            <!--<input type="file" name="logo" id="logo" />-->
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

<link href="assets/plugins/jasny-bootstrap/css/jasny-bootstrap.min.css" rel="stylesheet" type="text/css"/>
<script src="assets/plugins/jasny-bootstrap/js/jasny-bootstrap.min.js" type="text/javascript" language="javascript"></script> 
<script type="text/javascript" src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script>
jQuery(document).ready(function() {       
	$('.date-picker').datepicker({
		orientation: "left",
		autoclose: true
	});
});   
</script>
