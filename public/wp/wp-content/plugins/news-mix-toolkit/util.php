<?php

function news_mix_toolkit_widget_posttype_build_query( $instance ) {
    $default_query_args = array(
        'post_type'      => 'post',
        'posts_per_page' => -1,
        'post__not_in'   => array(),
        'ignore_sticky_posts' => 1,
        'categories'     => array(),
        'tags'           => array(),
        'relation'       => 'OR',
        'orderby'        => 'lastest',
        'cat_name'       => 'category',
        'tag_name'       => 'post_tag'
    );

    $instance = wp_parse_args( $instance, $default_query_args );

    $args = array(
        'post_type'           => $instance['post_type'],
        'posts_per_page'      => $instance['posts_per_page'],
        'post__not_in'        => $instance['post__not_in'],
        'ignore_sticky_posts' => $instance['ignore_sticky_posts']
    );

    $tax_query = array();

    if ( $instance['categories'] ) {
    	if($instance['categories'][0] == '')
			unset($instance['categories'][0]);

		if ( $instance['categories'] ) {
	        $tax_query[] = array(
	            'taxonomy' => $instance['cat_name'],
	            'field'    => 'slug',
	            'terms'    => $instance['categories']
	        );
	    }
    }

    if ( $instance['tags'] ) {
    	if($instance['tags'][0] == '')
			unset($instance['tags'][0]);

		if ( $instance['tags'] ) {
	        $tax_query[] = array(
	            'taxonomy' => $instance['tag_name'],
	            'field'    => 'slug',
	            'terms'    => $instance['tags']
	        );
	    }
    }

    if ( $instance['relation'] && count( $tax_query ) == 2 )
        $tax_query['relation'] = $instance['relation'];

    if ( $tax_query ) {
        $args['tax_query'] = $tax_query;
    }

    switch ( $instance['orderby'] ) {
	case 'popular':
        $args['meta_key'] = 'news_mix_lite_total_view';
        $args['orderby'] = 'meta_value_num';
        break;
    case 'most_comment':
        $args['orderby'] = 'comment_count';
        break;
    case 'random':
        $args['orderby'] = 'rand';
        break;
    default:
        $args['orderby'] = 'date';
        break;
    }
    
    return new WP_Query( $args );
}