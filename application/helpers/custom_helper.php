<?php
if (!function_exists('h_get_playback_date')){	
	function h_get_playback_date($date,$day=1,$format){
		$newDateArr = array();

		$dateTime = strtotime($date);
		$newDateArr[date($format,$dateTime)] = date($format,$dateTime);
		for($i=$day-1;$i>=1;$i--){
			$string =strtotime('-'.$i.' day', $dateTime);
			$newDateArr[date($format,$string)] = date($format,$string);
		}
		return $newDateArr;
	}
}
