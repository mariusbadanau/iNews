<?php
function news_mix_lite_admin_custom_header_fonts() {
	wp_enqueue_style( 'news-mix-lite-rokkitt', 'http://fonts.googleapis.com/css?family=Rokkitt', array(), null );
}
add_action( 'admin_print_scripts-appearance_page_custom-header', 'news_mix_lite_admin_custom_header_fonts' );


