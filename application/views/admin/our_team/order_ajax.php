<?php

echo get_product($pages);

function get_product ($array, $child = FALSE)
{
	$str = '';
	 $CI = get_instance();
    // You may need to load the model if it hasn't been pre-loaded
    $CI->load->model('comman_model');	
	if (count($array)) {
		$str .= $child == FALSE ? '<ol class="sortable" style="margin-top:10px">' : '<ol>';
		
		foreach ($array as $item) {
			$str .= '<li id="list_' . $item['id'] .'">';			

			if(isset($item['image'])){
				$image = base_url('assets/uploads/partner_sliders/small').'/'.$item['image']; 
			}
			else{
		   		$image = "assets/uploads/no-image.gif";
			}
			$str .= '<div class="" alt="'.$item['id'].'" ><img src="'.$image.'" class="img-rounded" style="width:30px;height:30px"> '.$item['name'].'&nbsp;&nbsp;&nbsp;&nbsp;<span class="pull-right">
					<div class="btn-group btn-group-xs options">
					  <a class="btn btn-xs btn-primary" href="'.site_url('admin/our_team/edit/'.$item['id']).'"><i class="icon-edit"></i></a>
					  <a  class="btn btn-xs btn-danger delete" data-loading-text="'.lang('Loading...').'" href="admin/our_team/delete/'.$item['id'].'"  onclick="return confirm_box();"><i class="icon-remove"></i></a>
					</div></span></div>';
			
			// Do we have any children?
			if (isset($item['children']) && count($item['children'])) {
				$str .= get_product($item['children'], TRUE);
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