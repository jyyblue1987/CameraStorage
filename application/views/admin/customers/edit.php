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
	<div class="col-md-12">						                        
        <div class="form-group" >
            <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],8007);?>Company name</label>
            <div class="col-lg-10">
    	        <?=form_input('company_name', set_value('company_name', $stores->{'company_name'}), 'class="form-control " id="" placeholder=""')?>
            </div>
		</div>

		<div class="form-group" >
            <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],8007);?>Website Link</label>
            <div class="col-lg-10">
    	        <?=form_input('website', set_value('website', $stores->{'website'}), 'class="form-control " id="" placeholder=""')?>
            </div>
		</div>
        
  


    <div class="form-group" >
        <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],16);?></label>
        <div class="col-lg-10">
            <?=form_input('first_name', set_value('first_name', $stores->{'first_name'}), 'class="form-control " id="" placeholder=""')?>
        </div>
    </div>
	<div class="form-group" >
        <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],17);?></label>
        <div class="col-lg-10">
            <?=form_input('last_name', set_value('last_name', $stores->{'last_name'}), 'class="form-control " id="" placeholder=""')?>
        </div>
    </div>

	<!--<div class="form-group" >
        <label class="col-lg-2 control-label" style="padding-top:0px"><?=show_static_text($adminLangSession['lang_id'],18);?></label>
        <div class="col-lg-10"><?=$stores->email;?></div>
    </div>-->

    <div class="form-group" >
        <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],4010);?>Phone</label>
        <div class="col-lg-10">
            <?=form_input('phone', set_value('phone', $stores->{'phone'}), 'class="form-control " id="" placeholder=""')?>
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

<link href="assets/plugins/jasny-bootstrap/css/jasny-bootstrap.min.css" rel="stylesheet" type="text/css"/>
<script src="assets/plugins/jasny-bootstrap/js/jasny-bootstrap.min.js" type="text/javascript" language="javascript"></script> 

