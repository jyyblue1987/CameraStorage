<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Watermark extends CI_Controller {
public function __construct()
{
parent::__construct();
$this->load->library('image_lib');
 
}
public function index()
{
   // $this->load->view('watermark_form');
}
public function text()
{
$config['source_image'] = './assets/uploads/products/welcome1.jpg';//The image path,which you would like to watermarking
$config['wm_text'] = 'tutsmore';
$config['wm_type'] = 'text';
$config['wm_opacity']=60;
//$config['wm_font_path'] = './fonts/ostrich-black-webfont.ttf';
//$config['wm_padding'] = '20';
// $image_cfg['new_image'] = 'upload/mark_'.$filename;
$this->image_lib->initialize($config);
 
if(!$this->image_lib->watermark())
{
   echo $this->image_lib->display_errors();
}
 
}
public function overlay()
{	
$config['image_library'] = 'gd2';  
$config['source_image'] = './assets/uploads/products/w1.jpg';//The image path,which you would like to watermarking
$config['wm_type'] = 'overlay';
$config['wm_vrt_alignment'] = 'top';
$config['wm_hor_alignment'] = 'left';
$config['wm_overlay_path'] = './assets/uploads/products/watermark.png';//the overlay image
$config['wm_opacity']=40;
//$config['new_image'] = './assets/uploads/products/mark_'.time().'.jpg';
 
$this->image_lib->initialize($config);
 
if(!$this->image_lib->watermark())
{
   echo $this->image_lib->display_errors();
}
 
}
}