<?php
/*
Plugin Name: Content By Location
Plugin URI: http://wordpress.org/extend/plugins/content-by-location
Description: content is protected by shortcode and visible by country code of the user viewing the content.
Version: 1.0.3
Author: Yehuda Hassine
Author URI: http://wpcoder.co.il
License: GPL2,
This product
includes GeoLite data created by MaxMind, available from
http://www.maxmind.com/.
*/
include('admin-menu.php');
$match = 0;
$dismatch = 0;

function cbl_main_fnc($attr,$content) {
global $match;
global $dismatch;
$options = get_option('CBL_options');
switch ($options['CBL_api_service']) {
case 1:
  $country = get_country_smartip();
  break;
case 2:
  $country = get_country_hostip();
  break;
case 3:
  $country = get_country_maxmind();
  break;
}//var_dump($country);if (strtolower($country) == "xx" || $country == false || empty($country) || is_null($country)) {
$dismatch++;return ;}
		if (strtolower($attr['country']) == strtolower($country)) {
             $match++;			 return $content;			 
        } else {
             $dismatch++;
        }
}
function get_country_maxmind() {
include_once(dirname(__FILE__)  . "/geoip/geoip.inc");
$gi = geoip_open(dirname(__FILE__)  . "/geoip/GeoIP.dat",GEOIP_STANDARD);
$country = geoip_country_code_by_addr($gi, getip());
geoip_close($gi);
return $country;
}
function get_country_smartip() {
$api_response = wp_remote_get('http://smart-ip.net/geoip-json/' . getip());
if (!is_wp_error($api_response)) {
$json = wp_remote_retrieve_body( $api_response );
$json = json_decode($json);
return $json->countryCode;
} else {
return false;
}
}
function get_country_hostip() {
if (!empty($IP)) {
$content = @file_get_contents('http://api.hostip.info/?ip='. getip());
	if ($content != false) {
		$xml = new SimpleXmlElement($content);
        $country = $xml->children('gml', TRUE)->featureMember->children('', TRUE)->Hostip->countryAbbrev;
		return $country;
	} else {
	return false;
	}
}
}
function getip() {
    $ip = $_SERVER['REMOTE_ADDR'];
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }	return $ip; 
    //return "223.165.20.5" ; //japan
	 // return "62.16.64.5" ; //russia
}
function check_shortcode($content) {
global $match;
global $dismatch;
if ($match == 0 && $dismatch > 0) {
$options = get_option('CBL_options');
$content = $options['CBL_unknown_lang'];
return $content; 
} else {
return $content; 
}}
/*
function validate_country_code($country) {
if (preg_match('/^(A(D|E|F|G|I|L|M|N|O|R|S|T|Q|U|W|X|Z)|B(A|B|D|E|F|G|H|I|J|L|M|N|O|R|S|T|V|W|Y|Z)|C(A|C|D|F|G|H|I|K|L|M|N|O|R|U|V|X|Y|Z)|D(E|J|K|M|O|Z)|E(C|E|G|H|R|S|T)|F(I|J|K|M|O|R)|G(A|B|D|E|F|G|H|I|L|M|N|P|Q|R|S|T|U|W|Y)|H(K|M|N|R|T|U)|I(D|E|Q|L|M|N|O|R|S|T)|J(E|M|O|P)|K(E|G|H|I|M|N|P|R|W|Y|Z)|L(A|B|C|I|K|R|S|T|U|V|Y)|M(A|C|D|E|F|G|H|K|L|M|N|O|Q|P|R|S|T|U|V|W|X|Y|Z)|N(A|C|E|F|G|I|L|O|P|R|U|Z)|OM|P(A|E|F|G|H|K|L|M|N|R|S|T|W|Y)|QA|R(E|O|S|U|W)|S(A|B|C|D|E|G|H|I|J|K|L|M|N|O|R|T|V|Y|Z)|T(C|D|F|G|H|J|K|L|M|N|O|R|T|V|W|Z)|U(A|G|M|S|Y|Z)|V(A|C|E|G|I|N|U)|W(F|S)|Y(E|T)|Z(A|M|W))$/',$country)) { 
return $country;
} else {
return false;
}
}
function validate_ip($ip) {
if (preg_match('/^(([1-9]?[0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5]).){3}([1-9]?[0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])$/',$ip)) {
   return true;
} else {
    return false;
}
}

*/

function myplugin_deactivate() {
delete_option( 'CBL_options' );
}
register_deactivation_hook( __FILE__, 'myplugin_deactivate' );
add_shortcode('cbl','cbl_main_fnc');add_filter('the_content','check_shortcode',15);
?>