<?php
echo get_oltag($pages,$_cancel,$adminLangSession['lang_id']);

function get_oltag($array,$_cancel,$ln, $child = FALSE)
{
	$str = '';
	$CI =& get_instance();
	
	if (count($array)) {
		$str .= $child == FALSE ? '<ol class="sortable" style="margin-top:10px">' : '<ol>';		
		foreach ($array as $item) {
			$styName ='';
/*			$style= $CI->comman_model->get_lang('styles',$ln,NULL,array('id'=>$item['style_id']),'style_id',true);
			if($style){
				$styName = '<span class="label label-sm label-success">'.$style->title.'</span>';
			}
			else{
				$styName = '<span class="label label-sm label-success">-</span>';
			}
*/			$str .= '<li id="list_' . $item['id'] .'">';
			$str .= '<div class="" alt="'.$item['id'].'" >'.$item['title'].'&nbsp;&nbsp;&nbsp;&nbsp;<span class="label label-sm label-success">'.$item['type'].'</span>&nbsp;&nbsp;'.$styName.' <span class="pull-right">
					<div class="btn-group btn-group-xs options">
					  <a class="btn btn-xs btn-primary" href="'.site_url($_cancel.'/edit/'.$item['id']).'"><i class="fa fa-edit"></i></a>
					  <a  class="btn btn-xs btn-danger delete" data-loading-text="'.lang('Loading...').'" href="'.$_cancel.'/delete/'.$item['id'].'"  onclick="return confirm_box();"><i class="fa fa-remove"></i></a>
					</div></span></div>';
			
			// Do we have any children?
			if (isset($item['children']) && count($item['children'])) {
				$str .= get_oltag($item['children'],$_cancel,$ln, TRUE);
			}
			
			$str .= '</li>' . PHP_EOL;
		}
		
		$str .= '</ol>' . PHP_EOL;
	}
	
	return $str;
}
?>

<script>
$(document).ready(function(){

    $('.sortable').nestedSortable({
        handle: 'div',
        items: 'li',
        toleranceElement: '> div',
        maxLevels: 1
    });

});
</script>