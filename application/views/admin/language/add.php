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
            <form action="" class="form-horizontal" method="post"enctype="multipart/form-data" > 
                	<input type="hidden" name="operation" value="set" />
                <div class="form-body">

                    <div class="form-group">
                        <label class="col-md-2 control-label">merchant</label>
                        <div class="col-md-4">
							<select name="merchant_id" class="form-control" required>
			            	<option value="">Select</option>
<?php
if(isset($merchants)&&!empty($merchants)){
	foreach($merchants as $set_merchant){
		echo '<option value="'.$set_merchant->id.'" '.set_select('merchant_id', $set_merchant->id).' >'.$set_merchant->email.'</option>';
	}
}
?>
            
            				</select>                            
                        </div>
                    </div>
                    <?php /*?><div class="form-group">
                        <label class="col-md-2 control-label">Slug</label>
                        <div class="col-md-4">
                             <input type="text"  name="slug" class="form-control" value="<?php echo set_value('slug'); ?>" required>
                            <span style="color:#F00;"><?php echo form_error('slug'); ?></span>
                        </div>
                    </div><?php */?>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Website URL</label>
                        <div class="col-md-4">
                             <input type="text"  name="title" class="form-control" value="<?php echo set_value('title'); ?>">
                            <span style="color:#F00;"><?php echo form_error('title'); ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Name</label>
                        <div class="col-md-4">
                             <input type="text"  name="name" class="form-control" value="<?php echo set_value('name'); ?>">
                            <span style="color:#F00;"><?php echo form_error('name'); ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Tracking URL</label>
                        <div class="col-md-4">
                             <input type="text"  name="affilate_url" class="form-control" value="<?php echo set_value('affilate_url'); ?>">
                            <span style="color:#F00;"><?php echo form_error('affilate_url'); ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">SEO Title</label>
                        <div class="col-md-4">
                             <input type="text"  name="seo_title" class="form-control" value="<?php echo set_value('seo_title'); ?>">
                            <span style="color:#F00;"><?php echo form_error('seo_title'); ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">SEO Keyword</label>
                        <div class="col-md-4">
                             <input type="text"  name="seo_keyword" class="form-control" value="<?php echo set_value('seo_keyword'); ?>">
                            <span style="color:#F00;"><?php echo form_error('seo_keyword'); ?></span>
                        </div>
                    </div>
					
                    <div class="form-group">
                        <label class="col-md-2 control-label">SEO Description</label>
                        <div class="col-md-4">
                             <textarea  name="seo_description" class="form-control"></textarea>
                            
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Category</label>
                        <div class="col-sm-4">
							<select name="category_id[]" multiple="multiple" class="populate placeholder" style="width:332px" id="select_category">
			            	<option value="">Select</option>
<?php
if(isset($categories)&&!empty($categories)){
	foreach($categories as $set_category){
		echo '<option value="'.$set_category->id.'" '.set_select('category_id', $set_category->id).' >'.$set_category->name.'</option>';
	}
}
?>
            
            				</select>                            
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Image</label>
                        <div class="col-sm-2" style="width:200px">
							<input type='file' name="photo" />                            
                        </div>(Our Client Logo)
                    </div>
                    
                    <div class="form-group">
                        <label class="col-md-2 control-label">Featured</label>
                        <div class="col-sm-4" style="padding-top:7px">
                    	<input type="checkbox" name="is_featured" value="1" id="days" class="from-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Shopping Online Gold</label>
                        <div class="col-sm-4" style="padding-top:7px">
                    	<input type="checkbox" name="is_shopping_gold" value="1" id="days" class="from-control" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Description</label>
                        <div class="col-md-8">
                             <textarea  name="description" class="form-control"><?php echo set_value('description'); ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Additional Description</label>
                        <div class="col-md-8">
                             <textarea  name="additional_desc" class="form-control"><?php echo set_value('additional_desc'); ?></textarea>
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

