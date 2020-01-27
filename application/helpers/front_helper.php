<?php
function formatSizeUnits($bytes){
	if ($bytes >= 1073741824)
	{
		$bytes = number_format($bytes / 1073741824, 2) . ' GB';
	}
	elseif ($bytes >= 1048576)
	{
		$bytes = number_format($bytes / 1048576, 2) . ' MB';
	}
	elseif ($bytes >= 1024)
	{
		$bytes = number_format($bytes / 1024, 2) . ' KB';
	}
	elseif ($bytes > 1)
	{
		$bytes = $bytes . ' bytes';
	}
	elseif ($bytes == 1)
	{
		$bytes = $bytes . ' byte';
	}
	else
	{
		$bytes = '0 bytes';
	}

	return $bytes;
}

if (!function_exists('h_get_day_two_date')){	
	function h_get_day_two_date($date,$end_date){
		$now =  strtotime($end_date);
		$your_date = strtotime($date);
		$datediff = $now - $your_date;
		
		return round($datediff / (60 * 60 * 24));
	}
}
if (!function_exists('h_get_date_day')){	
	function h_get_date_day($date,$day=1,$format){
		$newDateArr = array();

		$dateTime = strtotime($date);
		$newDateArr[date($format,$dateTime)] = date($format,$dateTime);
		for($i=1;$i<=$day-1;$i++){
			$string =strtotime('+'.$i.' day', $dateTime);
			$newDateArr[date($format,$string)] = date($format,$string);
		}
		return $newDateArr;
	}
}

if (!function_exists('h_dateRangeArray')){	
	function h_dateRangeArray($strDateFrom,$strDateTo,$format=false){
	
		$aryRange=array();
	
		$iDateFrom=mktime(1,0,0,substr($strDateFrom,5,2),     substr($strDateFrom,8,2),substr($strDateFrom,0,4));
		$iDateTo=mktime(1,0,0,substr($strDateTo,5,2),     substr($strDateTo,8,2),substr($strDateTo,0,4));
	
		if ($iDateTo>=$iDateFrom)
		{
			if($format){
				array_push($aryRange,date($format,$iDateFrom)); // first entry
			}
			else{
				array_push($aryRange,date('Y-m-d',$iDateFrom)); // first entry
			}
			while ($iDateFrom<$iDateTo)
			{
				$iDateFrom+=86400; // add 24 hours
			if($format){
				array_push($aryRange,date($format,$iDateFrom)); // first entry
			}
			else{
				array_push($aryRange,date('Y-m-d',$iDateFrom)); // first entry
			}
			}
		}
		return $aryRange;
	}
}

if (!function_exists('h_deleteDirectory')){
    function h_deleteDirectory($dir) {
    if (!file_exists($dir)) return true;
    if (!is_dir($dir) || is_link($dir)) return unlink($dir);
        foreach (scandir($dir) as $item) {
            if ($item == '.' || $item == '..') continue;
            if (!h_deleteDirectory($dir . "/" . $item)) {
                chmod($dir . "/" . $item, 0777);
                if (!h_deleteDirectory($dir . "/" . $item)) return false;
            };
        }
        return rmdir($dir);
    }
}
function h_get_dir($dir,$asc=false) {
	$ignored = array('.', '..', '.svn', '.htaccess');
	$files = array();    
	$i=0;
	foreach (scandir($dir) as $file) {
		if (in_array($file, $ignored)) continue;
		if(preg_match("/\.(ts|m3u8)$/", $file)){
			continue;
		}
		
//		echo '<br>'.$file.':'.$checkFile = filemtime($dir . '/' . $file);
		$i++;
		$files[$file] = filemtime($dir . '/' . $file);
	}

	asort($files);
//    arsort($files);
	$files = array_keys($files);

	return ($files) ? $files : false;
}
/*function print_count($table,$array){
	$CI =& get_instance();
	$check = $CI->comman_model->get_by($table,$array,false,false,false);
	if($check){
		return count($check);
	}
	else{
		return '0';
	}
}*/

function print_count($table,$array=false){
	$CI =& get_instance();
	if($array)
		$CI->db->where($array);
	$CI->db->from($table);
	return $CI->db->count_all_results();
}


function print_count_query($string){
	$CI =& get_instance();
	$result = $CI->db->query($string);
	//echo $CI->db->last_query();
	return $result->num_rows();
}


function checkBlockExc($table,$array){
	$CI =& get_instance();
	$checkAny = $CI->comman_model->get_by($table,$array,false,false,true);
	if($checkAny){
		$array['is_confirm']=1;
		$check = $CI->comman_model->get_by($table,$array,false,false,true);
		if($check){
			return 1;
		}
		else{
			return 0;
		}
	}
	else{
		return 0;
	}
}

function checkPermission($table,$array){
	$CI =& get_instance();
	$check = $CI->comman_model->get_by($table,$array,false,false,true);
	if($check){
		return 1;
	}
	else{
		return 0;
	}
}



if ( ! function_exists('h_gDatesByweek')){
	function h_gDatesByweek($sDate,$eDate,$week,$format){
		$arr =array();
		$endDate = strtotime($eDate);
		for($i = strtotime($week, strtotime($sDate)); $i <= $endDate; $i = strtotime('+1 week', $i)){
			$arr[] = date($format, $i);
		}
		return $arr;
	}
}

if ( ! function_exists('h_addDate')){
	function h_addDate($date,$type,$count,$format){
		$string = strtotime($date);
		if($type=='month'){
			$string =strtotime('+'.$count.' month', $string);
		}
		else if($type=='year'){
			$string =strtotime('+'.$count.' year', $string);
		}
		else{
			$string =strtotime('+'.$count.' day', $string);
		}
		$new_date = date($format,$string);
		return $new_date;
	}
};
if ( ! function_exists('h_minusDate')){
	function h_minusDate($date,$type,$count,$format){
		$string = strtotime($date);
		if($type=='month'){
			$string =strtotime('-'.$count.' month', $string);
		}
		else if($type=='year'){
			$string =strtotime('-'.$count.' year', $string);
		}
		else{
			$string =strtotime('-'.$count.' day', $string);
		}
		$new_date = date($format,$string);
		return $new_date;
	}
};

if ( ! function_exists('h_dateFormat')){
	function h_dateFormat($date,$format){
		$new_date = date($format,strtotime($date));
		return $new_date;
	}
};
function h_orderNumber($table,$orderName,$digit){
	$CI =& get_instance();
	$CI->db->order_by('id','desc'); 
	$CI->db->limit('1'); 
	$order_num_data = $CI->comman_model->get($table,true);
/*	echo '<pre>';
	print_r($order_num_data);*/
	if($order_num_data){
		$order_number =	$orderName.str_pad($order_num_data->id+1, $digit, '0', STR_PAD_LEFT);
	}else{
		$order_number = $orderName.str_pad(1, $digit, '0', STR_PAD_LEFT);
	}
	return $order_number;


}

function getHourDailWork($startDate,$endDate,$sysTime,$workDay){
	date_default_timezone_set("GMT"); 
	$workStartHour = $sysTime[0];
	$workStartMin = 0;
	$workEndHour =  $sysTime[1];
	$workEndMin = 0;
	$workdayHours = $sysTime[1]-$sysTime[0];
	$weekends = $workDay;
	$hours = 0;
/*	echo '<br>'.date('Y-m-d H:i:s',$startDate);
	echo '<br>'.date('Y-m-d H:i:s',$startDate);*/
	// Original start and end times, and their clones that we'll modify.
	$originalStart = new DateTime(date('Y-m-d H:i:s',$startDate));
	$start = clone $originalStart;
	
	// Starting on a weekend? Skip to a weekday.
	while (in_array($start->format('l'), $weekends))
	{
		$start->modify('midnight tomorrow');
	}
	
	$originalEnd =new DateTime(date('Y-m-d H:i:s',$endDate));
	$end = clone $originalEnd;
	
	// Ending on a weekend? Go back to a weekday.
	while (in_array($end->format('l'), $weekends))
	{
		$end->modify('-1 day')->setTime(23, 59);
	}
	
	// Is the start date after the end date? Might happen if start and end
	// are on the same weekend (whoops).
	if ($start > $end) return 0;
	
	// Are the times outside of normal work hours? If so, adjust.
	$startAdj = clone $start;
	
	if ($start < $startAdj->setTime($workStartHour, $workStartMin))
	{
		// Start is earlier; adjust to real start time.
		$start = $startAdj;
	}
	else if ($start > $startAdj->setTime($workEndHour, $workEndMin))
	{
		// Start is after close of that day, move to tomorrow.
		$start = $startAdj->setTime($workStartHour, $workStartMin)->modify('+1 day');
	}
	
	$endAdj = clone $end;
	
	if ($end > $endAdj->setTime($workEndHour, $workEndMin))
	{
		// End is after; adjust to real end time.
		$end = $endAdj;
	}
	else if ($end < $endAdj->setTime($workStartHour, $workStartMin))
	{
		// End is before start of that day, move to day before.
		$end = $endAdj->setTime($workEndHour, $workEndMin)->modify('-1 day');
	}
	
	// Calculate the difference between our modified days.
	$diff = $start->diff($end);
	
	// Go through each day using the original values, so we can check for weekends.
	$period = new DatePeriod($start, new DateInterval('P1D'), $end);
	
	foreach ($period as $day)
	{
		// If it's a weekend day, take it out of our total days in the diff.
	
		if (in_array($day->format('l'), $weekends)) $diff->d;
	}
	
	// Calculate! Days * Hours in a day + hours + minutes converted to hours.
	return $hours = (($diff->d * $workdayHours) + $diff->h + round($diff->i / 60, 2))*3600;
}

function get_working_hours($from,$to,$systemTime,$day)
{
	date_default_timezone_set("GMT"); 
    // timestamps
/*    $from_timestamp = strtotime($from);
    $to_timestamp = strtotime($to);*/
    $from_timestamp = $from;
    $to_timestamp = $to;

    // work day seconds
    $workday_start_hour = $systemTime[0];
    $workday_end_hour = $systemTime[1];
    $workday_seconds = ($workday_end_hour - $workday_start_hour)*3600;

    // work days beetwen dates, minus 1 day
    $from_date = date('Y-m-d',$from_timestamp);
    $to_date = date('Y-m-d',$to_timestamp);
    $workdays_number = count(get_workdays($from_date,$to_date,$day))-1;
    $workdays_number = $workdays_number<0 ? 0 : $workdays_number;

    // start and end time
    $start_time_in_seconds = date("H",$from_timestamp)*3600+date("i",$from_timestamp)*60;
    $end_time_in_seconds = date("H",$to_timestamp)*3600+date("i",$to_timestamp)*60;

    // final calculations
    //$working_hours = ($workdays_number * $workday_seconds + $end_time_in_seconds - $start_time_in_seconds) / 86400 * 24;
    $working_hours = ($workdays_number * $workday_seconds + $end_time_in_seconds - $start_time_in_seconds) ;

    return $working_hours;
}

function get_workdays($from,$to,$day) 
{
    // arrays
	date_default_timezone_set("GMT"); 
    $days_array = array();
    $skipdays = $day;
    $skipdates = get_holidays();

    // other variables
    $i = 0;
    $current = $from;

    if($current == $to) // same dates
    {
        $timestamp = strtotime($from);
        if (!in_array(date("l", $timestamp), $skipdays)&&!in_array(date("Y-m-d", $timestamp), $skipdates)) {
            $days_array[] = date("Y-m-d",$timestamp);
        }
    }
    elseif($current < $to) // different dates
    {
        while ($current < $to) {
            $timestamp = strtotime($from." +".$i." day");
            if (!in_array(date("l", $timestamp), $skipdays)&&!in_array(date("Y-m-d", $timestamp), $skipdates)) {
                $days_array[] = date("Y-m-d",$timestamp);
            }
            $current = date("Y-m-d",$timestamp);
            $i++;
        }
    }

    return $days_array;
}

function get_holidays() 
{
    // arrays
    $days_array = array();

    // You have to put there your source of holidays and make them as array...
    // For example, database in Codeigniter:
    // $days_array = $this->my_model->get_holidays_array();

    return $days_array;
}


function getHourCalculateback($date1,$date2,$sysTimes) {
    if ($date1>$date2) { $tmp=$date1; $date1=$date2; $date2=$tmp; unset($tmp); $sign=-1; } else $sign = 1;
    if ($date1==$date2) return 0;

    $days = 0;
    $working_days = array(1,2,3,4,5); // Monday-->Friday
    $working_hours = $sysTimes; // from 8:30(am) to 17:30
    $current_date = $date1;
    $beg_h = floor($working_hours[0]); $beg_m = ($working_hours[0]*60)%60;
    $end_h = floor($working_hours[1]); $end_m = ($working_hours[1]*60)%60;

    // setup the very next first working timestamp

    if (!in_array(date('w',$current_date) , $working_days)) {
        // the current day is not a working day

        // the current timestamp is set at the begining of the working day
        $current_date = mktime( $beg_h, $beg_m, 0, date('n',$current_date), date('j',$current_date), date('Y',$current_date) );
        // search for the next working day
        while ( !in_array(date('w',$current_date) , $working_days) ) {
            $current_date += 24*3600; // next day
        }
    } else {
        // check if the current timestamp is inside working hours

        $date0 = mktime( $beg_h, $beg_m, 0, date('n',$current_date), date('j',$current_date), date('Y',$current_date) );
        // it's before working hours, let's update it
        if ($current_date<$date0) $current_date = $date0;

        $date3 = mktime( $end_h, $end_m, 59, date('n',$current_date), date('j',$current_date), date('Y',$current_date) );
        if ($date3<$current_date) {
            // outch ! it's after working hours, let's find the next working day
            $current_date += 24*3600; // the day after
            // and set timestamp as the begining of the working day
            $current_date = mktime( $beg_h, $beg_m, 0, date('n',$current_date), date('j',$current_date), date('Y',$current_date) );
            while ( !in_array(date('w',$current_date) , $working_days) ) {
                $current_date += 24*3600; // next day
            }
        }
    }

    // so, $current_date is now the first working timestamp available...

    // calculate the number of seconds from current timestamp to the end of the working day
    $date0 = mktime( $end_h, $end_m, 59, date('n',$current_date), date('j',$current_date), date('Y',$current_date) );
    $seconds = $date0-$current_date+1;

    //printf("<br> \nFrom %s To %s : %d hours\n",date('d/m/y H:i',$date1),date('d/m/y H:i',$date0),$seconds/3600);

    // calculate the number of days from the current day to the end day

    $date3 = mktime( $beg_h, $beg_m, 0, date('n',$date2), date('j',$date2), date('Y',$date2) );
    while ( $current_date < $date3 ) {
        $current_date += 24*3600; // next day
        if (in_array(date('w',$current_date) , $working_days) ) $days++; // it's a working day
    }
    if ($days>0) $days--; //because we've allready count the first day (in $seconds)

    //printf("<br>  \nFrom %s To %s : %d working days\n",date('d/m/y H:i',$date1),date('d/m/y H:i',$date3),$days);

    // check if end's timestamp is inside working hours
    $date0 = mktime( $beg_h, 0, 0, date('n',$date2), date('j',$date2), date('Y',$date2) );
    if ($date2<$date0) {
        // it's before, so nothing more !
    } else {
        // is it after ?
        $date3 = mktime( $end_h, $end_m, 59, date('n',$date2), date('j',$date2), date('Y',$date2) );
        if ($date2>$date3) $date2=$date3;
        // calculate the number of seconds from current timestamp to the final timestamp
        $tmp = $date2-$date0+1;
        $seconds += $tmp;
       // printf("<br>  \nFrom %s To %s : %d hours\n",date('d/m/y H:i',$date2),date('d/m/y H:i',$date3),$tmp/3600);
    }

    // calculate the working days in seconds

    $seconds += 3600*($working_hours[1]-$working_hours[0])*$days;

   // printf(" <br> \nFrom %s To %s : %d hours\n",date('d/m/y H:i',$date1),date('d/m/y H:i',$date2),$seconds/3600);

   // return $sign * $seconds/3600; // to get hours
    return $seconds; // to get hours
}


function printR($data){
	echo '<pre>';
	print_r($data);
	echo '</pre>';
}
	function getallDate($year){
		$list  = array();
		for($ds=1; $ds<=12; $ds++){
			for($d=1; $d<=31; $d++){
				$time=mktime(12, 0, 0, $ds, $d, $year);          
				if (date('m', $time)==$ds)       
					$list[]=date('Y-m-d', $time);
			}
		}
		return $list;
	}

function getDates($year)
{
    $dates = array();

    for($i = 1; $i <= 366; $i++){
        $month = date('m', mktime(0,0,0,1,$i,$year));
        $wk = date('W', mktime(0,0,0,1,$i,$year));
        $wkDay = date('D', mktime(0,0,0,1,$i,$year));
        $day = date('d', mktime(0,0,0,1,$i,$year));

        $dates[$month][$wk][$day] = $wkDay;
    } 

    return $dates;   
}

function numberFormat($number){

	return number_format((float)$number, 2, '.', '');
}
function get_distance($post_code1,$post_code2){
	$post_code1 = str_replace(' ','%20',$post_code1);
	$post_code2 = str_replace(' ','%20',$post_code2);
	$url = "http://maps.googleapis.com/maps/api/distancematrix/json?origins=".$post_code1."&destinations=".$post_code2."&mode=driving&language=en-EN&sensor=false";
	$data   = @file_get_contents($url);
	$result = json_decode($data, true);
	if($result&&$result["rows"][0]["elements"][0]['status']=='OK'){							
		return $distance = $result["rows"][0]["elements"][0]["distance"]["value"] * 0.000621371;
	}
	return '';
}

function sumOfArray(){	
	$sumArray = 0;	
	foreach ($myArray as $k=>$subArray) {
	  foreach ($subArray as $id=>$value) {
		$sumArray = $value+$sumArray;
	  }
	}
	return $sumArray;
}

function day_time($start_time,$end_time){
	$time = strtotime(date('H:i',time()));
	if($start_time!=''&&$end_time!=''){
		if(strtotime($start_time)<=$time&&$time<=strtotime($end_time)){
			return 1;					
		}
		else{					
		return 0;
		}
	}
	else{
		return 1;
	}
}


	function currency($from_Currency,$to_Currency,$amount) {
		$amount = urlencode($amount);
		$from_Currency = urlencode($from_Currency);
		$to_Currency = urlencode($to_Currency);
		$url = "http://www.google.com/ig/calculator?hl=en&q=$amount$from_Currency=?$to_Currency";
		$ch = curl_init();
		$timeout = 0;
		curl_setopt ($ch, CURLOPT_URL, $url);
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch,  CURLOPT_USERAGENT , "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1)");
		curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
		$rawdata = curl_exec($ch);
		curl_close($ch);
		$data = explode('"', $rawdata);
		$data = explode(' ', $data['3']);
		$var = $data['0'];
		return round($var,2);
	}

	function convertCurrency($amount, $from, $to){
		$url  = "https://www.google.com/finance/converter?a=$amount&from=$from&to=$to";
		$data = file_get_contents($url);
		preg_match("/<span class=bld>(.*)<\/span>/",$data, $converted);
		$converted = preg_replace("/[^0-9.]/", "", $converted[1]);
		return round($converted,2);
	}

function show_background_image(){
	date_default_timezone_set("GMT"); 
	$nowTime = time();
	$date = date('H',$nowTime);
	if($date>=6&&$date<=18){
		return 'morning';
	}
	else{
		return 'evening';
	}
}

function show_static_text($lang,$array){
	$CI =& get_instance();
	$check = $CI->comman_model->get_lang('static_text',$lang,NULL,array('id'=>$array),'static_text_id',true);
	if($check){
		return $check->title;
	}
	else{
		return '';
	}
}


function show_field_value($lang,$array){
	$CI =& get_instance();
	$check = $CI->comman_model->get_lang('field_values',$lang,NULL,$array,'field_value_id',true);
	if($check){
		return $check->title;
	}
	else{
		return '-';
	}
}

function print_lang_value($table,$lang,$array,$field_id,$show){
	$CI =& get_instance();
	$check = $CI->comman_model->get_lang($table,$lang,NULL,$array,$field_id,true);
	if($check){
		return $check->$show;
	}
	else{
		return '-';
	}
}

function print_value($table,$array,$show,$default=false){
	$CI =& get_instance();
	$check = $CI->comman_model->get_by($table,$array,false,false,true);
	if($check){
		return $check->$show;
	}
	else{
		if($default)
			return $default;
		else
			return '-';
	}
}
function print_value2($table,$array,$show,$default=false){
	$CI =& get_instance();
	$check = $CI->comman_model->get_by($table,$array,false,false,true);
	if($check){
		return $check->$show;
	}
	else{
		if($default)
			return $default;
		else
			return '0';
	}
}

function social_media($array,$option=false){
	$CI =& get_instance();
	$social = $CI->settings_model->get_fields();	
	if($option=='circle'){
		$string   = '<ul class="social-network social-circle">';
		if(in_array('facebook',$array)){
			$string .='<li><a class="icoFacebook" href="'.$social['facebook_url'].'" title="Facebook"><i class="fa fa-facebook"></i></a></li>';
		}
		if(in_array('twitter',$array)){
			$string .='<li><a class="icoTwitter" href="'.$social['twitter_url'].'" title="Facebook"><i class="fa fa-twitter"></i></a></li>';
		}
		if(in_array('linkedin',$array)){
			$string .= '<li><a href="'.$social['linkedin_url'].'" class="icoLinkedin" title="Linkedin"><i class="fa fa-linkedin"></i></a></li>';
		}
		if(in_array('google',$array)){
			$string .='<li><a class="facebook" href="'.$social['google_plus'].'" title="Facebook"><i class="fa fa-google-plus"></i></a></li>';
		}
		if(in_array('youtube',$array)){
			$string .='<li><a class="facebook" href="'.$social['youtube_url'].'" title="Facebook"><i class="fa fa-youtube"></i></a></li>';
		}
	
	$string .='</ul>';
	$string .='<style>
ul.social-network {
	list-style: none;
	display: inline;
	margin-left:0 !important;
	padding: 0;
}
ul.social-network li {
	display: inline;
	margin: 0 5px;
}

.social-network a.icoRss:hover {
	background-color: #F56505;
}
.social-network a.icoFacebook:hover {
	background-color:#3B5998;
}
.social-network a.icoTwitter:hover {
	background-color:#33ccff;
}
.social-network a.icoGoogle:hover {
	background-color:#BD3518;
}
.social-network a.icoVimeo:hover {
	background-color:#0590B8;
}
.social-network a.icoLinkedin:hover {
	background-color:#007bb7;
}
.social-network a.icoRss:hover i, .social-network a.icoFacebook:hover i, .social-network a.icoTwitter:hover i,
.social-network a.icoGoogle:hover i, .social-network a.icoVimeo:hover i, .social-network a.icoLinkedin:hover i {
	color:#fff;
}
a.socialIcon:hover, .socialHoverClass {
	color:#44BCDD;
}

	.social-circle li a {
	display:inline-block;
	position:relative;
	margin:0 auto 0 auto;
	-moz-border-radius:50%;
	-webkit-border-radius:50%;
	border-radius:50%;
	text-align:center;
	width: 50px;
	height: 50px;
	font-size:20px;
}
.social-circle li i {
	margin:0;
	line-height:50px;
	text-align: center;
}

.social-circle li a:hover i, .triggeredHover {
	-moz-transform: rotate(360deg);
	-webkit-transform: rotate(360deg);
	-ms--transform: rotate(360deg);
	transform: rotate(360deg);
	-webkit-transition: all 0.2s;
	-moz-transition: all 0.2s;
	-o-transition: all 0.2s;
	-ms-transition: all 0.2s;
	transition: all 0.2s;
}
.social-circle i {
	color: #fff;
	-webkit-transition: all 0.8s;
	-moz-transition: all 0.8s;
	-o-transition: all 0.8s;
	-ms-transition: all 0.8s;
	transition: all 0.8s;
}</style>';
	}
	elseif($option=='circle_simple'){}
	elseif($option=='custom'){
		$string   = '<ul class="top-social-list">';
		if(in_array('facebook',$array)){
			$string .='<li style="display: inline-block;"><a target="_blank" href="'.$social['facebook_url'].'"><i class="fa fa-facebook CircleSm"></i></a></li> ';
		}
		if(in_array('twitter',$array)){
			$string .='<li style="display: inline-block;"><a target="_blank"  href="'.$social['twitter_url'].'"><i class="fa fa-twitter CircleSm"></i></a></li> ';
		}
		if(in_array('linkedin',$array)){
			$string .= '<li style="display: inline-block;"><a target="_blank" href="'.$social['linkedin_url'].'" ><i class="fa fa-linkedin CircleSm"></i></a></li> ';
		}
		if(in_array('instagram',$array)){
			$string .= '<li style="display: inline-block;"><a target="_blank" href="'.$social['instagram_url'].'" ><i class="fa fa-instagram CircleSm"></i></a></li> ';
		}
		if(in_array('pinterest',$array)){
			$string .= '<li style="display: inline-block;"><a target="_blank" href="'.$social['pinterest_url'].'" ><i class="fa fa-pinterest CircleSm"></i></a></li> ';
		}		
		if(in_array('google',$array)){
			$string .='<li style="display: inline-block;"><a target="_blank" href="'.$social['google_plus'].'"><i class="fa fa-google-plus CircleSm"></i></a></li> ';
		}
		if(in_array('youtube',$array)){
			$string .='<li style="display: inline-block;"><a target="_blank" href="'.$social['youtube_url'].'"><i class="fa fa-youtube CircleSm"></i></a></li> ';
		}	
		$string .='</ul>';
?>			
<?php
	}
	else{}
	return $string;	
}