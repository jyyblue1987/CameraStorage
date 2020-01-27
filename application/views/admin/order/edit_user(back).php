<div class="row">
    <div class="col-md-12">
        <!-- begin panel -->
        <div data-sortable-id="form-stuff-1" class="panel panel-inverse">
            <div class="panel-heading">                
                <h4 class="panel-title"><?=$name?></h4>
            </div>
            <div class="panel-body">
            <!-- BEGIN FORM-->
            <?php echo validation_errors();?>
                 <?=form_open(NULL, array('class' => 'form-horizontal', 'role'=>'form','enctype'=>"multipart/form-data"))?>
    	             <div class="form-body">

                 	<div class="col-md-12">
                        
				<div class="form-group" >
                  <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],16);?></label>
                  <div class="col-lg-10">
                    <?=form_input('first_name', set_value('first_name', $products->{'first_name'}), 'class="form-control " id="" placeholder=""')?>
                  </div>
                </div>

				<div class="form-group" >
                  <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],17);?></label>
                  <div class="col-lg-10">
                    <?=form_input('last_name', set_value('last_name', $products->{'last_name'}), 'class="form-control " id="" placeholder=""')?>
                  </div>
                </div>

				<div class="form-group" >
                  <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],18);?></label>
                  <div class="col-lg-10">
                    <?=form_input('email', set_value('email', $products->{'email'}), 'class="form-control " id="" placeholder=""')?>
                  </div>
                </div>

				<div class="form-group" >
                  <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],144);?></label>
                  <div class="col-lg-10">
					<?=form_input('address', set_value('address', $products->{'address'}), 'placeholder="" class="form-control"')?>
                  </div>
                </div>
				<div class="form-group" >
                  <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],308);?></label>
                  <div class="col-lg-10">
					<?=form_input('house_number', set_value('house_number', $products->{'house_number'}), 'placeholder="" class="form-control"')?>
                  </div>
                </div>

				<div class="form-group" >
                  <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],84);?></label>
                  <div class="col-lg-10">
                    <?=form_input('city', set_value('city', $products->{'city'}), 'class="form-control " id="" placeholder=""')?>
                  </div>
                </div>

				<div class="form-group" >
                  <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],85);?></label>
                  <div class="col-lg-10">
                    <?=form_input('country', set_value('country', $products->{'country'}), 'class="form-control " id="" placeholder=""')?>
                  </div>
                </div>
				<div class="form-group" >
                  <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],210);?></label>
                  <div class="col-lg-10">
                    <?=form_input('zip', set_value('zip', $products->{'zip'}), 'class="form-control " id="" placeholder=""')?>
                  </div>
                </div>

				<div class="form-group" >
                  <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],82);?></label>
                  <div class="col-lg-10">
                    <?=form_input('phone', set_value('phone', $products->{'phone'}), 'class="form-control " id="" placeholder=""')?>
                  </div>
                </div>

					<h4><?=show_static_text($adminLangSession['lang_id'],145);?></h4>
                        
<!--				<div class="form-group" >
    	          	<label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],16);?> </label>
                  <div class="col-lg-10">
	                <?=form_input('i_name', set_value('i_name', $products->{'i_name'}), 'class="form-control " id="" placeholder=""')?>
                  </div>
				</div>-->
				
                <div class="form-group" >
                  <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],306);?> </label>
                  <div class="col-lg-10">
	                <?=form_input('company_name', set_value('company_name', $products->{'company_name'}), 'class="form-control " id="" placeholder=""')?>
                  </div>
				</div>
				
                <div class="form-group" >
                  <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],209);?></label>
                  <div class="col-lg-10">
	                <?=form_input('vat_num', set_value('vat_num', $products->{'vat_num'}), 'class="form-control " id="" placeholder=""')?>
                  </div>
				</div>

                <div class="form-group" >
                  <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],307);?> </label>
                  <div class="col-lg-10">
	                <?=form_input('i_street', set_value('i_street', $products->{'i_street'}), 'class="form-control " id="" placeholder=""')?>
                  </div>
				</div>
				
                <div class="form-group" >
                  <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],308);?> </label>
                  <div class="col-lg-10">
	                <?=form_input('i_house_number', set_value('i_house_number', $products->{'i_house_number'}), 'class="form-control " id="" placeholder=""')?>
                  </div>
				</div>
				
                <div class="form-group" >
                  <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],210);?></label>
                  <div class="col-lg-10">
	                <?=form_input('i_zip', set_value('i_zip', $products->{'i_zip'}), 'class="form-control " id="" placeholder=""')?>
                  </div>
				</div>
				
                <div class="form-group" >
                  <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],84);?> </label>
                  <div class="col-lg-10">
	                <?=form_input('i_city', set_value('i_city', $products->{'i_city'}), 'class="form-control " id="" placeholder=""')?>
                  </div>
				</div>
				
                <div class="form-group" >
                  <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],85);?></label>
                  <div class="col-lg-10">
	                <?=form_input('i_country', set_value('i_country', $products->{'i_country'}), 'class="form-control " id="" placeholder=""')?>
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
                 
            </div>
        </div>
        <!-- end panel -->
    </div>
</div>
