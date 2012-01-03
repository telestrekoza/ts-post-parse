<?php
/**
 * @package TS_Post_Parse
 * @author Nazar Kulyk
 * @version 1.4
 */
/*
Plugin Name: Telestrekoza Post Parse
Plugin URI: https://telestrekoza.com/
Description: Do some needed context replacement by the site.
Author: Nazar Kulyk
Version: 1.4
Author URI: http://myeburg.net/
*/

namespace ts\plugins;

function ts_post_parse_do($content) {
	//$content = preg_replace("/(http[s]?:\/\/(www.)?youtube.com\/embed\/([^\?]*)?\??([^\"]*))/", "/combo/youtube/?url=$3", $content);
	$content = preg_replace('/(http:\/\/(www.)?youtube.com\/embed\/)/', 'https://www.youtube.com/embed/', $content);
	$content = preg_replace('/(http:\/\/photos.telestrekoza.com\/var\/([^"]*))/', '/link-gallery/$2', $content);
	//$content = preg_replace('/(<a\s*(?!.*\brel=)[^>]*)(href="[^"]+")((?!.*\brel=)[^>]*)(?:[^>]*)>/', '$1$2$3 rel="nofollow">', $content);
	//var_dump($content);
	//exit;
	return $content;
}

function ts_post_parse_replaces($content) {
    if(is_feed())
	return $content;
    $content = preg_replace('/="(https?:\/\/(beta\.)?telestrekoza.com\/)/', '="/', $content);
    //$content = preg_replace('/(<a\s*(?!.*\brel=)[^>]*)(href="[^"]+")((?!.*\brel=)[^>]*)(?:[^>]*)>/', '$1$2$3 rel="nofollow">', $content);
    //var_dump($content);
    return $content;
}

// Now we set that function up to execute when the admin_footer action is called
add_action('content_save_pre', 'ts\plugins\ts_post_parse_do');
add_filter('the_content', 'ts\plugins\ts_post_parse_replaces');

?>
