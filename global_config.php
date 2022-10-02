<?php
/**
 * Global settings that are relevant everywhere despite where the website is run
 * 
 * Version: v1.0.0
 * 
 * --------------------------------------------------------
 *              How to: Set Optional values
 * --------------------------------------------------------
 * - @link https://github.com/Sander-Brilman/php-website-template/relees/tag/v1.0.0#setup-guide--optional-values
 * 
 * 
 * 
 * --------------------------------------------------------
 *                          Docs:
 * --------------------------------------------------------
 * - @link https://github.com/Sander-Brilman/php-website-template/releases/tag/v1.0.0#setup-guide
 */

$debug_ips = [
	'::1',
];

$theme_color                    = '#00b3cd'; // CSS color notation
$locate                         = 'nl_NL'; // Language_TERRITORY format ('nl_NL' or 'en_US' for example)

$display_name                   = 'Sander\'s geavanceerde rekenmachine'; // Company / organization name
$default_seo_title              = 'Sander\'s geavanceerde rekenmachine'; // About 50 characters
$default_seo_description        = 'Rekenen met eenheden is super makkelijk met Sander\'s rekenmachine. Bereken sommen met eenheden zoals m2, km/u en krijg antwoorden zonder moeite!'; // About 160 characters

$logo_path                      = 'favicon.ico'; // Path from root


// 
// Custom variables
// 

$operators_priority = [
    '^' => 4,   
    '*' => 3,
    '/' => 3,    
    '+' => 2,
    '-' => 2,
    '%' => 1,
];
// cm2
$meter_units = [
    'mm',
    'cm',
    'dm',
    'm',
    'dcm',
    'hm',
    'km',
];


// 
// Declaration of the url_array variable
// Recommended to not change this.
// 

$site_domain = $_SERVER['SERVER_NAME'];

$site_url  = isset($_SERVER['HTTPS']) ? 'https://' : 'http://';
$site_url .= $site_domain . $site_folder;

$url_array = $_SERVER['REQUEST_URI'];
$url_array = str_replace($site_folder, '', $url_array);
$url_array = explode('/', explode('?', $url_array)[0]);

foreach ($url_array as &$value) {
	$value = explode('?', $value)[0];
	$value = explode('#', $value)[0];
}
?>