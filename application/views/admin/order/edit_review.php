<link rel="stylesheet" href="assets/global/css/star.css">

<div class="row">
    <div class="col-md-12">
        <!-- begin panel -->
        <div data-sortable-id="form-stuff-1" class="panel panel-inverse">
            <div class="panel-heading">                
                <h4 class="panel-title"><?=$name?></h4>
            </div>
            <div class="panel-body">
            <!-- BEGIN FORM-->
<?php
if($order_review){
$order_review_comment	= $this->comman_model->get_by('stores_rating',array('parent_id'=>$order_review->id),false,false,false);
?>
<?=form_open(NULL, array('class' => 'form-horizontal', 'role'=>'form','enctype'=>"multipart/form-data"))?>
		<input type="hidden" name="operation" value="set"  /> 
 <div class="form-body">

<div class="col-md-12">

<div class="form-group" >
<label class="col-lg-2 control-label" style="padding:0px;"><?=show_static_text($adminLangSession['lang_id'],800);?>Username</label>
<div class="col-lg-10"><?=$order_review->username?></div>
</div>
	
<div class="form-group" >
    <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],1600);?>Food quality</label>
    <div class="col-lg-10">
	    <input id="rating-input" name="quality_rate" type="number" value="<?=(isset($order_review)&&!empty($order_review))?$order_review->quality_rate:'3'?>" class="rating rating-input" min=0 max=6 step=1 data-size="xs" data-show-clear="false" data-show-caption="false" data-stars="6" />
    </div>
</div>

<div class="form-group" >
    <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],1600);?>Delivery time</label>
    <div class="col-lg-10">
        <input id="rating-input" name="delivery_rate" type="number" value="<?=(isset($order_review)&&!empty($order_review))?$order_review->delivery_rate:'3'?>" class="rating rating-input" min=0 max=6 step=1 data-size="xs" data-show-clear="false" data-show-caption="false" data-stars="6" />			  
    </div>
</div>

<div class="form-group" >
    <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],1600);?>Takeaway service</label>
    <div class="col-lg-10">
	    <input id="rating-input" name="service_rate" type="number" value="<?=(isset($order_review)&&!empty($order_review))?$order_review->service_rate:'3'?>" class="rating rating-input" min=0 max=6 step=1 data-size="xs" data-show-clear="false" data-show-caption="false" data-stars="6" />
    </div>
</div>

<div class="form-group" >
    <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],1600);?>Comment</label>
    <div class="col-lg-10">
		<textarea name="comment" id="reviews" class="form-control " required><?=(isset($order_review)&&!empty($order_review))?$order_review->comment:''?></textarea>
    </div>
</div>

	

	</div>
	<div style="clear:both"></div>
 <div class="form-actions">
		<div class="row">
			<div class="col-md-offset-2 col-md-9">
				<?=form_submit('submit',show_static_text($adminLangSession['lang_id'],235), 'class="btn btn-primary"')?>
				<!--<button type="button" class="btn default">Cancl</button>-->
			</div>
		</div>
	</div>
</div>                        
<?=form_close()?>
<?php	
}
else{
	echo 'There is no reivews.';
}
?>
                 
            </div>
        </div>
        <!-- end panel -->
    </div>
</div>
<link href="assets/plugins/star_rating/css/star-rating.css" media="all" rel="stylesheet" type="text/css"/>
<script src="assets/plugins/star_rating/js/star-rating.js" type="text/javascript"></script>
