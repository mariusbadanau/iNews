<?php

/*
Plugin Name: News Mix Toolkit
Plugin URI: http://kopatheme.com
Description: A specific plugin use in News Mix Lite Theme to add specific widgets.
Version: 1.0.1
Author: Kopatheme
Author URI: http://kopatheme.com
License: GPLv3

News Mix Toolkit plugin, Copyright 2015 Kopatheme.com
News Mix Toolkit is distributed under the terms of the GNU GPL
*/

add_action('plugin_loaded','news_mix_toolkit_init');
add_action('after_setup_theme', 'news_mix_toolkit_after_setup_theme');

function news_mix_toolkit_init(){
    load_plugin_textdomain( 'news-mix-toolkit', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' ); 
}

function news_mix_toolkit_after_setup_theme() {
	if (!class_exists('Kopa_Framework'))
		return;
	require plugin_dir_path( __FILE__ ) . 'util.php';
	require plugin_dir_path( __FILE__ ) . 'widgets/widget-articles-list.php';
	require plugin_dir_path( __FILE__ ) . 'widgets/widget-flexslider.php';
	require plugin_dir_path( __FILE__ ) . 'widgets/widget-articles-tabs-list.php';
	require plugin_dir_path( __FILE__ ) . 'widgets/widget-articles-carousel.php';
	require plugin_dir_path( __FILE__ ) . 'widgets/widget-entry-list.php';

	if (is_admin()) {
		add_filter('user_contactmethods', 'modify_contact_methods');
	}else{
		add_filter('widget_text', 'do_shortcode');
	}
	add_action('wp_enqueue_scripts', 'news_mix_toolkit_enqueue_scripts');

}

function news_mix_toolkit_enqueue_scripts() {
    if (is_single()) {
        wp_enqueue_script('news-mix-toolkit-set-view-coun-script', plugins_url('/js/set-view-count.js', __FILE__), array('jquery'), null, true);
    }
}

function modify_contact_methods($profile_fields) {

    // Add new fields
    $profile_fields['facebook']    = esc_attr__( 'Facebook URL', 'news-mix-toolkit');
	$profile_fields['twitter']     = esc_attr__( 'Twitter URL', 'news-mix-toolkit');
	$profile_fields['google-plus'] = esc_attr__( 'Google+ URL', 'news-mix-toolkit');
	$profile_fields['flickr']      = esc_attr__( 'Flickr URL', 'news-mix-toolkit');

    return $profile_fields;
}

require plugin_dir_path( __FILE__ ) . 'view-count.php';