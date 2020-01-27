<?php 
$GLOBALS['option_value_count']	= 0;
$extraBtn	= '0';
$optionBtn	= '0';
$FreeBtn 	= '0';

?>
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
                      <div id="more_pic" style="display:none"></div>
                    <div class="col-md-12">						                                                
                        <div class="form-group">
                          <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],567);?>Store Name</label>
                          <div class="col-lg-10">

							<select class="form-control" name="store_id" id="select_category" required>
                            	<option value="" >Select</option>
<?php
if(isset($stores_data)&&!empty($stores_data)){
	foreach($stores_data as $set_store){
?>
		<option value="<?=$set_store->id;?>"  <?=($set_store->id==$products->store_id)?'selected="selected"':'';?> ><?=$set_store->name;?></option>
<?php
	}
}
?>
            
							</select>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],167);?></label>
                          <div class="col-lg-10">

							<select class="form-control" name="category_id" id="select_category" onChange="get_process(this.value);"  required>
                            	<option value="" >Select</option>
<?php
if(isset($categories_data)&&!empty($categories_data)){
	foreach($categories_data as $setCategory){
?>
		<option value="<?=$setCategory->id;?>"  <?=($setCategory->id==$products->category_id)?'selected="selected"':'';?> ><?=$setCategory->title;?></option>
<?php
	}
}
?>
            
							</select>
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],269);?></label>
                          <div class="col-lg-10">

							<select class="form-control" name="sub_category_id" id="sub-category" style=""  >
                            	<option value="">Select</option>
<?php
if(!empty($products->sub_category_id)&&$products->sub_category_id!=0){
	$subCat = $this->comman_model->get_lang('categories',$content_language_id,$products->sub_category_id,false,'category_id',true);
	if($subCat){
?>
<option value="<?=$subCat->id;?>" selected="selected"><?=$subCat->title;?></option>
<?php
	}
}
?>
            
							</select>
                          </div>
                        </div>
						                        
                      <div class="form-group">
                      <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],263);?></label>
                      <div class="col-lg-10">
				      	<div id="cropContainerProduct">
<?php echo !isset($products->image) ? '<img src="assets/uploads/no-image.gif">' :'<img src="'.base_url('assets/uploads/products').'/'.$products->image.'" style="width:360px; height:250px;" >'; ?>
                        </div>
                        <br>Width:360px, height: 250px
				      	
				      	
                            <!--<input type="file" name="logo" id="logo" />-->
                      </div>
                    </div>
                    
				
                
				<div class="form-group" >
                  <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],41);?></label>
                  <div class="col-lg-10">
                    <?=form_input('price', set_value('price', $products->{'price'}), 'class="form-control " id="" placeholder=""')?>
                  </div>
                </div>
                
				<div class="form-group" >
                  <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],271);?></label>
                  <div class="col-lg-10">
                    <?=form_input('discount_price', set_value('discount_price', $products->{'discount_price'}), 'class="form-control " id="" placeholder=""')?>
                  </div>
                </div>
                                                                                    
			</div>
            
               <div style="clear:both"></div>

                   <h5><?=show_static_text($adminLangSession['lang_id'],268);?></h5>
                   <div style="margin-bottom: 0px;" class="tabbable">
                      <ul class="nav nav-tabs">
                        <?php $i=0;
                      //   debugger($this->page_m->languages_icon);
                      //  foreach($this->page_m->languages as $key_lang=>$val_lang):
                        foreach($this->product_model->languages_icon as $key_lang=>$val_lang):

                          $i++;?>
                        <li class="<?=$i==1?'active':''?>">
                          <a data-toggle="tab" href="#<?=$key_lang?>"><img src="<?php echo base_url('assets/uploads/language').'/'.$val_lang; ?>" height="15" width="20" ></a></li>
                        <?php endforeach;?>
                      </ul>
                      <div style="padding-top: 9px; border-bottom: 1px solid #ddd;" class="tab-content">
                        <?php $i=0;foreach($this->product_model->languages as $key_lang=>$val_lang):$i++;?>
                        <div id="<?=$key_lang?>" class="tab-pane <?=$i==1?'active':''?>">
                            <div class="form-group">
                              <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],16);?></label>
                              <div class="col-lg-10">
                                <?=form_input('title_'.$key_lang, set_value('title_'.$key_lang, $products->{'title_'.$key_lang}), 'class="form-control copy_to_next" id="inputTitle'.$key_lang.'" placeholder="Name"')?>
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],276);?></label>
                              <div class="col-lg-10">
                                <?=form_textarea('body_'.$key_lang, html_entity_decode(set_value('body_'.$key_lang, $products->{'body_'.$key_lang})), 'placeholder="Body" rows="3" class="cleditor2 form-control"')?>
                              </div>
                            </div>                            

                        </div>
                        <?php endforeach;?>
                      </div>
                    </div>


<div class="form-group" >
        <label class="col-lg-2 control-label">Options</label>
        <div class="col-lg-10">
            <div class="input_fields_wrap" id="product-options">
                <button class="add_field_button2 btn btn-primary" type="button" style="margin-bottom:10px">Add</button>
<?php
$removeJquery ='';
$j=0;
if(!empty($products_option)){
$extraBtn = '1';
foreach($products_option as $set_option){		
?>
<div style="margin-bottom:10px;">
<input type="hidden" name="options_id[<?=$j?>]" value="<?=$set_option->id;?>">
<input type="text" name="options_name[<?=$j?>]" value="<?=$set_option->name;?>" class="form-control" style="width:45%;float:left;margin-right:5px">
<input type="text" name="options_price[<?=$j?>]" value="<?=$set_option->price;?>" class="form-control" style="width:48%;float:left">
<a href="#" class="remove_field btn default"><i class="fa fa-times"></i></a></div>
<?php		
$j++;
}
}
else{
?>
<!--<div style="margin-bottom:10px;"><input type="text" name="options[]" class="form-control" style="width:90%"></div>-->
<?php
}
?>      
            </div>
        </div>
    </div>

<div class="form-group" >
    <label class="col-lg-2 control-label">Extra</label>
    <div class="col-lg-10">
        <div class="input_fields_wrap1" id="product-extra">
            <button class="add_field_button1 btn btn-primary" type="button" style="margin-bottom:10px">Add</button>
<?php
$k=0;
if(!empty($products_extra)){
$FreeBtn ='1';
$optionBtn = '1';
foreach($products_extra as $set_option){		
?>
<div style="margin-bottom:10px;">
<input type="hidden" name="extra_id[<?=$k?>]" value="<?=$set_option->id;?>">
<input type="text" name="extra_name[<?=$k?>]" value="<?=$set_option->name;?>" class="form-control" style="width:45%;float:left;margin-right:5px;">
<input type="text" name="extra_price[<?=$k?>]" value="<?=$set_option->price;?>" class="form-control" style="width:48%;float:left">
<a href="#" class="remove_field btn default"><i class="fa fa-times"></i></a></div>
<?php		
$k++;
}
}
else{
?>
<!--<div style="margin-bottom:10px;"><input type="text" name="options[]" class="form-control" style="width:90%"></div>-->
<?php
}
?>      
        </div>
    </div>
</div>   	                                  

<div class="form-group" >
<label class="col-lg-2 control-label">Or Free Option</label>
<div class="col-lg-10 free-container">
<input id="add_option" class="btn btn-primary" type="button" value="Add" style="margin:0px;float:left"/>
<div style="clear:both"></div>

<div class="row">
<div class="col-md-12">
<table class="table table-striped"  id="options_container">
<?php
$counter	= 0;
if(!empty($product_options))
$extraBtn =1;
{
    foreach($product_options as $po)
    {
        $po	= (object)$po;
        if(empty($po->required)){$po->required = false;}

        add_option($po, $counter,false);
        $counter++;
    }
}?>
    
</table>
</div>
</div>


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

<!--<link href="assets/plugins/jasny-bootstrap/css/jasny-bootstrap.min.css" rel="stylesheet" type="text/css"/>
<script src="assets/plugins/jasny-bootstrap/js/jasny-bootstrap.min.js" type="text/javascript" language="javascript"></script> -->

<!--<script src="assets/plugins/ckeditor/ckeditor.js" type="text/javascript" language="javascript"></script> 
<script src="assets/plugins/ckeditor/adapters/jquery.js" type="text/javascript" language="javascript"></script>
<script>
/* CL Editor */
$(document).ready(function(){
    $('.cleditor2').ckeditor();
});
</script>-->

<link href="assets/plugins/croppic/assets/css/croppic.css" rel="stylesheet">
<style>
#cropContainerProduct{ 
width:362px; height:252px; position: relative; border:1px solid #ccc;
}
#cropContainerBanner{ width:362px; height:252px; position: relative; border:1px solid #ccc;}

</style>  
<script src="assets/plugins/croppic/croppic.min.js"></script>
<script>
    

    var cropContainerProductOptions = {
            uploadUrl:'croppic/save_to_image',
            uploadData:{
                "upload_path":'assets/uploads/products/',
                "session":'image',
				"<?=$this->security->get_csrf_token_name();?>":'<?=$this->security->get_csrf_hash();?>',
            },
            cropUrl:'croppic/crop_to_image',
            cropData:{
                "upload_path":'assets/uploads/products/',
                "session":'image',
				"<?=$this->security->get_csrf_token_name();?>":'<?=$this->security->get_csrf_hash();?>',
            },
            imgEyecandy:false,				
            doubleZoomControls:false,
            rotateControls: false,
            loaderHtml:'<div class="loader bubblingG"><span id="bubblingG_1"></span><span id="bubblingG_2"></span><span id="bubblingG_3"></span></div> ',
    }
    var cropContainerProduct = new Croppic('cropContainerProduct', cropContainerProductOptions);
    
    
</script>


<script>


function get_process(id){	
	$.ajax({
		type:"POST",
		url:"ajax/ajaxGetSubcategory",
		data:{id:id,lang_code:'<?=$content_language_id?>',<?=$this->security->get_csrf_token_name();?>:'<?=$this->security->get_csrf_hash();?>'},
		dataType: 'json',
		success: function(json) {	
			if(json.status=='ok'){
				$('#sub-category').html(json.msge);
			}
			if(json.status=='error'){
				$('#sub-category').html('<option value="">Select</option>');
			}
		}
		
	});
}

</script>

<script>
var removeOptionBtn = '<?=$optionBtn?>';
var removeExtraBtn = '<?=$extraBtn?>';
var removeFreeBtn = '<?=$FreeBtn?>';
if(removeOptionBtn=='1'){
	$('.add_field_button2').remove();
}
if(removeExtraBtn=='1'){
	$('.add_field_button1').remove();
}
if(removeFreeBtn=='1'){
	$('#add_option').remove();
	$('#options_container').remove();
}


var j =parseInt('<?=$j+1;?>');
$(document).ready(function() {
    var max_fields      = 10; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $(".add_field_button2"); //Add button ID
   
    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
		checkOtion = $('#product-extra').find('add_field_button1');
		if(checkOtion){
			$('.add_field_button1').remove();
		}
		
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
$(wrapper).append('<div style="margin-bottom:10px;"><input type="text" name="options_name['+j+']" class="form-control" style="width:45%;float:left;margin-right:10px" placeholder="Name" required/><input type="text" name="options_price['+j+']" class="form-control" style="width:48%;float:left" placeholder="Price" required/><a href="javascript:void(0)" class="remove_field btn default"><i class="fa fa-times"></i></a></div>'); 
			j++;
        }
    });
   
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
});


var k =parseInt('<?=$k+1;?>');
$(document).ready(function() {
    var max_fields      = 10; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap1"); //Fields wrapper
    var add_button      = $(".add_field_button1"); //Add button ID
   
    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
		checkOtion = $('#product-options').find('add_field_button2');
		if(checkOtion){
			$('.add_field_button2').remove();
		}

		checkOtion1 = $('.free-container').find('add_option');
		if(checkOtion1){
			$('#add_option').remove();
		}
	
	
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
$(wrapper).append('<div style="margin-bottom:10px;"><input type="text" name="extra_name['+k+']" class="form-control" style="width:45%;float:left;margin-right:10px" placeholder="Name" required/><input type="text" name="extra_price['+k+']" class="form-control" style="width:48%;float:left" placeholder="Price" required/><a href="javascript:void(0)" class="remove_field btn default"><i class="fa fa-times"></i></a></div>'); 
			k++;
        }
    });
   
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
});

</script>


<script type="text/javascript">
        
        $( "#add_option" ).click(function(){
			checkOtion = $('#product-extra').find('add_field_button1');
			if(checkOtion){
				$('.add_field_button1').remove();
			}

			add_option('droplist');
        });
        
        function add_option(type)
        {
            //increase option_count by 1
            option_count++;
            
            <?php
            //$value			= array(array('name'=>'', 'value'=>'', 'weight'=>'', 'price'=>'', 'limit'=>''));
            $js_textfield	= (object)array('name'=>'', 'type'=>'textfield', 'required'=>false, 'values'=>'','id'=>NULL);
            $js_textarea	= (object)array('name'=>'', 'type'=>'textarea', 'required'=>false, 'values'=>'','id'=>NULL);
            $js_radiolist	= (object)array('name'=>'', 'type'=>'radiolist', 'required'=>false, 'values'=>'','id'=>NULL);
            $js_checklist	= (object)array('name'=>'', 'type'=>'checklist', 'required'=>false, 'values'=>'','id'=>NULL);
            $js_droplist	= (object)array('name'=>'', 'type'=>'droplist', 'required'=>false, 'values'=>'','id'=>NULL);
            $js_mdroplist	= (object)array('name'=>'', 'type'=>'mdroplist', 'required'=>false, 'values'=>'','id'=>NULL);
            $js_date	= (object)array('name'=>'', 'type'=>'date', 'required'=>false, 'values'=>'','id'=>'');

            $js_yes_no	= (object)array('name'=>'', 'type'=>'yes_no', 'required'=>false, 'values'=>'','id'=>NULL);
            $js_date_time	= (object)array('name'=>'', 'type'=>'date_time', 'required'=>false, 'values'=>'','id'=>'');
            $js_attachment	= (object)array('name'=>'', 'type'=>'attachment', 'required'=>false, 'values'=>'','id'=>'');
            ?>
            if(type == 'textfield')
            {
                $('#options_container').append('<?php add_option($js_textfield, "'+option_count+'",true);?>');
            }
            else if(type == 'textarea')
            {
                $('#options_container').append('<?php add_option($js_textarea, "'+option_count+'",true);?>');
            }
            else if(type == 'radiolist')
            {
                $('#options_container').append('<?php add_option($js_radiolist, "'+option_count+'",true);?>');
            }
            else if(type == 'checklist')
            {
                $('#options_container').append('<?php add_option($js_checklist, "'+option_count+'",true);?>');
            }
            else if(type == 'droplist')
            {
                $('#options_container').append('<?php add_option($js_droplist, "'+option_count+'",true);?>');
            }
            else if(type == 'mdroplist')
            {
                $('#options_container').append('<?php add_option($js_mdroplist, "'+option_count+'",true);?>');
            }
            else if(type == 'date')
            {
                $('#options_container').append('<?php add_option($js_date, "'+option_count+'",true);?>');
            }
            else if(type == 'date_time')
            {
                $('#options_container').append('<?php add_option($js_date_time, "'+option_count+'",true);?>');
            }
            else if(type == 'yes_no')
            {
                $('#options_container').append('<?php add_option($js_yes_no, "'+option_count+'",true);?>');
            }
            else if(type == 'attachment')
            {
                $('#options_container').append('<?php add_option($js_attachment, "'+option_count+'",true);?>');
            }
        }

        
        function add_option_value(option)
        {
            //alert('asd');
            option_value_count++;
            <?php
            $js_po	= (object)array('type'=>'droplist');
            //$value	= (object)array('name'=>'', 'value'=>'', 'weight'=>'', 'price'=>'');
            $value	= '';
            ?>
            $('#option-items-'+option).append('<?php add_option_value($js_po, "'+option+'", "'+option_value_count+'", $value,0);?>');
        }
        
        $(document).ready(function(){
            $('body').on('click', '.option_title', function(){
                $($(this).attr('href')).slideToggle();
                return false;
            });
            
            $('body').on('click', '.delete-option-value', function(){
                if(confirm('Are you sure you want to remove this value?'))
                {
                    $(this).closest('.option-values-form').remove();
                }
            });
            
            
            
            $('#options_container').sortable({
                axis: "y",
                items:'tr',
                handle:'.handle',
                forceHelperSize: true,
                forcePlaceholderSize: true
            });
            
            $('.option-items').sortable({
                axis: "y",
                handle:'.handle',
                forceHelperSize: true,
                forcePlaceholderSize: true
            });
        });
        </script>
<style type="text/css">
	.option-form {
		display:none;
		margin-top:10px;
	}
	.option-values-form
	{
		background-color:#fff;
		padding:6px 3px 6px 6px;
		-webkit-border-radius: 3px;
		-moz-border-radius: 3px;
		border-radius: 3px;
		margin-bottom:5px;
		border:1px solid #ddd;
	}
	
	.option-values-form input {
		margin:0px;
	}
	.option-values-form a {
		margin-top:3px;
	}
</style>

<?php
function add_option($po, $count,$show=false)
{
	ob_start();
	?>
	<tr id="option-<?php echo $count;?>">
		<td>
			<!--<a class="handle btn btn-mini"><i class="fa fa-align-justify"></i></a>-->
			<strong><a class="option_title" href="#option-form-<?php echo $count;?>">Options <?php echo (!empty($po->name))?' : '.$po->name:'';?></a></strong>
			<button type="button" class="btn btn-mini btn-danger pull-right" onclick="remove_option(<?php echo $count ?>);"><i class="fa fa-trash"></i></button>
			<input type="hidden" name="option[<?php echo $count;?>][id]" value="<?php echo $po->id;?>" />
			<input type="hidden" name="option[<?php echo $count;?>][type]" value="<?php echo $po->type;?>" />
			<div class="option-form" id="option-form-<?php echo $count;?>" style="display: <?=$show?'block':'none'?>  ">
				<div class="row">
				
					<div class="col-md-10">
						<input type="text" class="span10 form-control" placeholder="<?php echo 'Field Name';?>" name="option[<?php echo $count;?>][name]" value="<?php echo $po->name;?>" required/>
					</div>
					
					<!--<div class="span2" style="text-align:right;">
						<input class="checkbox" type="checkbox" name="option[<?php echo $count;?>][required]" value="1" <?php echo ($po->required)?'checked="checked"':'';?>/> <?php echo 'required';?>
					</div>-->
				</div>
			<?php if($po->type=='droplist'||$po->type=='mdroplist'){?>
				<div class="row">
					<div class="col-md-12" style="margin-top:10px;">
						<a class="btn btn-primary" onclick="add_option_value(<?php echo $count;?>);">Add Option</a>
					</div>
				</div>
			<div style="margin-top:10px;">

					<div class="row">
						<div class="col-md-5"><strong>Name</strong></div>
						<div class="col-md-5"><strong>Description</strong></div>
					</div>
					<div class="option-items" id="option-items-<?php echo $count;?>">
					<?php if($po->values){
							$po->values=explode(',',$po->values);
						?>
						<?php
						$descCount=0;
						foreach($po->values as $value)
						{
							//$value = (object)$value;
							add_option_value($po, $count, $GLOBALS['option_value_count'], $value,$descCount);
							$descCount++;
							$GLOBALS['option_value_count']++;
						}?>
					<?php }?>
					</div>
				</div>				
                
				<?php }?>
			</div>
		</td>
	</tr>
	
	<?php
	$stuff = ob_get_contents();

	ob_end_clean();
	
	echo replace_newline($stuff);
}

function add_option_value($po, $count, $valcount, $value,$desCount)
{
ob_start();
if(isset($po->description)){
	$new = explode(',$,',$po->description);
	$description = $new[$desCount];
}
else{
	$description ='';
}
?>
	<div class="option-values-form">
		<div class="row">
			<div class="col-md-5"><input type="text" class=" form-control" name="option[<?php echo $count;?>][values][]" value="<?php echo $value; ?>" /></div>
			<div class="col-md-5"><input type="text" class=" form-control" name="option[<?php echo $count;?>][description][]" value="<?php echo $description; ?>" /></div>
			<div class="col-md-2">
			<?php if($po->type=='droplist'||$po->type=='mdroplist'){?>
				<a class="delete-option-value btn btn-danger btn-mini pull-right"><i class="fa fa-trash"></i></a>
			<?php }?>
			</div>
		</div>
	</div>
	<?php
	$stuff = ob_get_contents();

	ob_end_clean();

	echo replace_newline($stuff);
}
//this makes it easy to use the same code for initial generation of the form as well as javascript additions
function replace_newline($string) {
  return trim((string)str_replace(array("\r", "\r\n", "\n", "\t"), ' ', $string));
}
?>
<script type="text/javascript">
//<![CDATA[
var option_count		= <?php echo $counter?>;
var option_value_count	= <?php echo $GLOBALS['option_value_count'];?>
//]]>
</script>
<script>
function remove_option(id){
	if(confirm('Are you sure you want to remove this option?')){
		$('#option-'+id).remove();
	}
}

</script>

