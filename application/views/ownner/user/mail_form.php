<div class="row">
    <div class="col-md-12">
        <!-- begin panel -->
        <div data-sortable-id="form-stuff-1" class="panel panel-inverse">
            <div class="panel-heading">                
                <h4 class="panel-title"><?=$name?></h4>
            </div>
            <div class="panel-body">
    	        <?php echo validation_errors();?>
	            <form action="" class="form-horizontal" method="post"enctype="multipart/form-data" > 
                	<input type="hidden" name="operation" value="set" />
                <div class="form-body">

					<div class="form-group">
                        <label class="col-sm-2 control-label">user Email-ID</label>
                        <div class="col-sm-8">
							<select id="user_email" multiple="multiple" class="user_email populate placeholder form-control" name="email[]">
<?php
$user_data  = $this->comman_model->get('users',false);
if(count($user_data)){
	foreach($user_data as $set_user){
		if(!empty($set_user)){
?>
		<option value="<?php echo $set_user->email; ?>"  ><?php echo $set_user->email; ?></option>
<?php
		}
	}
}
?>
							</select>                            
                        </div>
                    </div>                    
                    <div class="form-group">
                        <label class="col-md-2 control-label">Subject</label>
                        <div class="col-md-8">
                             <input type="text" name="subject" size="50px" value="<?php echo set_value('subject'); ?>" class="form-control"   required/>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-md-2 control-label">Message</label>
                        <div class="col-md-8">
                             <textarea class="form-control" name="message" rows="5" ><?php echo set_value('message'); ?></textarea>
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
            </div>
        </div>
        <!-- end panel -->
    </div>
</div>





<!--<script type="text/javascript" src="assets/admin/js/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
tinymce.init({
    selector: "textarea",
    menubar : false
 });
</script>
-->