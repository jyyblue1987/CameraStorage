<?php
echo get_ol1($pages,$_cancel);

function get_ol1 ($array,$_cancel, $child = FALSE)
{
	$str = '';
	
	if (count($array)) {
		$str .= $child == FALSE ? '<ol class="sortable" style="margin-top:10px">' : '<ol>';
		
		foreach ($array as $item) {
			$str .= '<li id="list_' . $item['id'] .'">';
			if(isset($item['image'])){
				$image = base_url('assets/uploads/products/thumbnails').'/'.$item['image']; 
			}
			else{
		   		$image = "assets/uploads/no-image.gif";
			}
			if(!empty($item['share_image_1'])){
				$titleColor ='#0C0';
			}
			else{
				$titleColor ='#000';
			}

			$str .= '<div class="" alt="'.$item['id'].'" ><img src="'.$image.'" class="img-rounded" style="width:30px;height:27px"> <span style="color:'.$titleColor.'">'.$item['title'].'</span>&nbsp;&nbsp;&nbsp;&nbsp;<span class="pull-right">
					<div class="btn-group btn-group-xs options">
					  <a class="btn btn-xs btn-primary" href="'.site_url($_cancel.'/edit/'.$item['id']).'"><i class="fa fa-edit"></i></a>
					  <a  class="btn btn-xs btn-danger delete" data-loading-text="'.lang('Loading...').'" href="'.$_cancel.'/delete/'.$item['id'].'"  onclick="return confirm_box();"><i class="fa fa-remove"></i></a>
					</div></span></div>';
			
			// Do we have any children?
			if (isset($item['children']) && count($item['children'])) {
				$str .= get_ol1($item['children'],$_cancel, TRUE);
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