<?php

add_filter( 'kopa_sidebar_default', 'news_mix_lite_set_sidebar_default' );

function news_mix_lite_set_sidebar_default( $options ) {
    $options['sidebar_top']      = array(
        'name' => esc_html__( 'Top Sidebar', 'news-mix-lite'),
        'before_title'  => '<h3 class="widget-title clearfix"><span class="title-line"></span><span class="title-text">',
        'after_title'   => '</span></h3>',
    );
    $options['sidebar_13']      = array(
        'name' => esc_html__( 'Blog Right Sidebar', 'news-mix-lite'),
        'before_title'  => '<h3 class="widget-title clearfix"><span class="title-line"></span><span class="title-text">',
        'after_title'   => '</span></h3>',
    );
    $options['sidebar_17']      = array(
        'name' => esc_html__( 'Kopa Page Fullwidth Sidebar', 'news-mix-lite'),
    );

	return  apply_filters( 'news_mix_lite_set_sidebar_default', $options );
}

add_filter( 'kopa_sidebar_default_attributes', 'news_mix_lite_set_sidebar_default_attributes' );

function news_mix_lite_set_sidebar_default_attributes($wrap) {
	$wrap['before_widget'] = '<div id="%1$s" class="widget %2$s">';
	$wrap['after_widget']  = '</div>';
	$wrap['before_title']  = '<h2 class="widget-title"><span class="title-line"></span>';
	$wrap['after_title']   = '</h2>';

	return $wrap;
}

function news_mix_lite_set_sidebar($sidebar, $position){
    global $news_mix_lite_current_layout;

    if(!isset($news_mix_lite_current_layout) || empty($news_mix_lite_current_layout)){
        $news_mix_lite_current_layout = news_mix_lite_get_template_setting();
    }

    if(isset($news_mix_lite_current_layout['sidebars'][$position])){
        $sidebar = $news_mix_lite_current_layout['sidebars'][$position];
    }

    return $sidebar;
}

add_action( 'widgets_init', 'news_mix_lite_widgets_init' );
function news_mix_lite_widgets_init(){
   /**
    * Creates a sidebar
    * @param string|array  Builds Sidebar based off of 'name' and 'id' values.
    */
    $args[] = array(
        'name'          => esc_html__( 'Blog Right Sidebar', 'news-mix-lite' ),
        'id'            => 'sidebar_13',
        'description'   => '',
        'class'         => '',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title clearfix"><span class="title-line"></span><span class="title-text">',
        'after_title'   => '</span></h3>'
    );

    foreach( $args as $arg ){
        register_sidebar( $arg );
    }
}