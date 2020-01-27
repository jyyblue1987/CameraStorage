
<footer id="aa-footer">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
        <div class="aa-footer-area">
          <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="aa-footer-left">
                <p><?=show_static_text($lang_id,62);?></p>
              </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
              <!--<div class="aa-footer-middle">
                <a href="<?=$settings['facebook_url']?>"><i class="fa fa-facebook"></i></a>
                <a href="<?=$settings['twitter_url']?>"><i class="fa fa-twitter"></i></a>
                <a href="<?=$settings['google_plus']?>"><i class="fa fa-google-plus"></i></a>
                <a href="<?=$settings['youtube_url']?>"><i class="fa fa-youtube"></i></a>
              </div>-->
            </div>
            <!--<div class="col-md-6 col-sm-12 col-xs-12">
              <div class="aa-footer-right">
<?php
if(isset($bottom_menu)){
	foreach($bottom_menu as $set_bottom_menu){
?>
<a href="<?=$lang_code?>/pages/<?=$set_bottom_menu->slug?>"><?=$set_bottom_menu->title;?></a>
<?php
	}
}
?>        
              </div>
            </div>-->            
          </div>
        </div>
      </div>
      </div>
    </div>
  </footer>


<div class="message-alert " id="message-alert1" style="display:none"></div>
<style>
div.message-alert {
  background: #666 none repeat scroll 0 0;
  border-radius: 0 0 3px 3px;
  color: #dfdfdf;
  font-size: 12px;
  font-weight: bold;
  left: 50%;
  margin-left: -245px;
  padding: 20px 33px;
  position: fixed;
  text-align: center;
  top: 0;
  width: 550px;
  z-index: 9999;
}
</style>
<?php $this->load->view('templates/includes/chat_content'); ?>  

