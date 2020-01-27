<link href="assets/global/css/bootstrap-nav-wizard.css" rel="stylesheet" />
<style>
.nav-wizard .complete{
	
}
.nav-wizard > li > a {
  padding: 11.2px 10px 14px 31px !important;
}
.nav-wizard > li:first-child > a{
  padding-left: 10px !important;
}

</style>

<div class="row">
    <div class="col-md-12">
        <!-- begin panel -->
        <div class="panel panel-inverse">
            <div class="panel-heading">                
                <h4 class="panel-title"><?=$name?></h4>
            </div>
            <div class="panel-body">

<ul class="nav nav-wizard">
    <li class="complete"><a href="javascript:void(0)">Competition Details</a></li>
    <li class="active"><a href="javascript:void(0)">Category</a></li>
    <li><a href="javascript:void(0)">Events</a></li>
  </ul>
  <br>
<?php echo validation_errors();?>
<?=form_open(NULL, array('class' => 'form-horizontal', 'role'=>'form','enctype'=>"multipart/form-data"))?>
<input type="hidden" name="product_id" id="input-type"  value="Product" />
<input type="hidden" name="order" value="set"  />
<div class="form-body">                    
    <div class="col-md-12">						                                                                        
        <div class="form-group">
    <label class="col-lg-1 control-label">Category</label>
    <div class="col-lg-4">
    <select class="form-control" name="category" id="select_category" >
        <option value="" >Select</option>
<?php
if(isset($categories_data)&&!empty($categories_data)){
foreach($categories_data as $setCategory){
?>
<option value="<?=$setCategory->id;?>"  ><?=$setCategory->title;?></option>
<?php
}
}
?>

    </select>
    </div>    
    </div>
	    <div class="form-group other-name">
	    </div>
        <div class="form-group">
		    <label class="col-lg-1 control-label">&nbsp;</label>
            <div class="col-lg-4 ">
	            <button class="add_field_button2 btn btn-primary" type="button" style="margin-bottom:10px" >Add</button>
            </div>
	    </div>
	    <div class="order-item">
<?php
$i =0;
if(isset($products->category_text)&&!empty($products->category_text)){
	$temp = unserialize($products->category_text);
/*	echo '<pre>';
	print_r($temp);*/
	if($temp){
		foreach($temp as $setTemp){
			$i++;
?>
<div class="col-md-4 item-<?=$i?>">
							<div class="well">
							<input type="hidden" name="sell[<?=$i?>][id]" value="<?=$setTemp['id']?>"  />
							<label class="col-lg-12 control-label" style="text-align:left"><?=print_lang_value('c_categories',$adminLangSession['lang_id'],array('id'=>$setTemp['id']),'category_id','title')?></label>
							<label class="col-lg-3 control-label">Price</label>
							<div class="col-lg-7">
								<input type="number" name="sell[<?=$i?>][price]" min="1"   pattern="\d*" class="form-control input-qty-<?=$i?>" value="<?=$setTemp['price']?>" onchange="get_qty(this.value,<?=$i?>);" onkeypress="get_qty(this.value,<?=$i?>);" />
							</div>                
							<a href="javascript:void(0)"  onclick="delete_item(<?=$i?>);" class="remove_field btn default"><i class="fa fa-times"></i></a>
							</div>
						</div>
<?php
		}
	}
}

?>
	

	    </div>
        
        		        
    </div>

	<div style="clear:both"></div>

</div>
<div class="form-actions">
	<div class="row">
		<div class="col-md-offset-1 col-md-9">
						<?=form_submit('submit', 'Next', 'class="btn btn-primary"')?>
		</div>
	</div>
</div>
<?=form_close()?>

            </div>
        </div>        
        <!-- end panel -->


    </div>
</div>

<script>
$total = 0;
function get_total(){
	console.log('as');
	tempTotal =0;
	$('.input-price').each(function() {
		get_value = $(this).val();
		if(get_value!=''){
			tempTotal = parseFloat(get_value)+tempTotal;
//			console.log(tempTotal);
		}
	});
	$('.total-price').html('$'+tempTotal);
}
function get_price(id,type,counter){
	qty = 1;
	if(id!=''){
		if(type=='product'){
			qty = $('.input-qty-'+counter).val();
		}
		var arr1 = id.split('-');
		//console.log('id: '+arr1[0]+', price: '+arr1[1]+', qty: '+qty);
		price = parseFloat(arr1[1]);
		$('.item-price-'+counter).html('$'+price*qty);
		$('.input-price-'+counter).val(price*qty);
		get_total();
	}	
}
function get_qty(id,counter){
}

var x = parseInt('<?=$i;?>')+1; //initlal text box count
$(document).ready(function() {
    var max_fields      = 40; //maximum input boxes allowed
    var wrapper         = $(".order-item"); //Fields wrapper
    var add_button      = $(".add_field_button2"); //Add button ID
   
	console.log(x);
    $(add_button).click(function(e){ //on add input button click
	    e.preventDefault();
		type = $('#select_category').val();
		if(type==''||type==null){
			alert('Pleas select category!!');
			return false;
		}
		//alert('asd');
        if(x < max_fields){ //max input box allowed
			$.ajax({
			type: "POST",
			url: "<?=$_cancel?>/get_content", /* The country id will be sent to this file */
			data: {id:type,count:x,<?=$this->security->get_csrf_token_name();?>:'<?=$this->security->get_csrf_hash();?>'},
			dataType:'json',
			beforeSend: function () {
			},
			success: function(msg){
			   if(msg.status=='ok'){
					x++; //text box increment
					$(".order-item").append(msg.html);
					if(type=='Service'){
					$('.input-date').datepicker({ dateFormat: 'mm-dd-yy', altField: '#input-date_alt', altFormat: 'yy-mm-dd' }).on('changeDate', function(e){$(this).datepicker('hide');});

					}
			   }
			}
		   });
		//$(wrapper).append('<div style="margin-bottom:10px;"><input type="email" name="email['+j+']" class="form-control" style="width:58.6%;float:left;margin-right:10px" placeholder="Email" required/><a href="javascript:void(0)" class="remove_field btn default"><i class="fa fa-times"></i></a></div>'); 
        }
    });
   
/*    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove();
		get_total();
    })*/
});

function delete_item(id){
	$('.item-'+id).remove();
}
</script>

