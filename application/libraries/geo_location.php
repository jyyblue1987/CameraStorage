<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Geo_location{
	function get_geolocation($ip) {
		$d = file_get_contents("http://www.ipinfodb.com/ip_query.php?ip=$ip&output=xml");
		
		//Use backup server if cannot make a connection
		if (!$d) {
			$backup = file_get_contents("http://backup.ipinfodb.com/ip_query.php?ip=$ip&output=xml");
			$result = new SimpleXMLElement($backup);
			if (!$backup)
			return false; // Failed to open connection
		} else {
			$result = new SimpleXMLElement($d);
		}
		//Return the data as an array
		return array('ip'=>$ip, 'country_code'=>$result->CountryCode, 'country_name'=>$result->CountryName, 'region_name'=>$result->RegionName, 'city'=>$result->City, 'zip_postal_code'=>$result->ZipPostalCode, 'latitude'=>$result->Latitude, 'longitude'=>$result->Longitude, 'timezone'=>$result->Timezone, 'gmtoffset'=>$result->Gmtoffset, 'dstoffset'=>$result->Dstoffset);
	}
}
/* End of file geo_location_pi.php */
/* Location: ./system/plugins/geo_location_pi.php */ 