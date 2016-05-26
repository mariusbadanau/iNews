<?php

add_filter( 'kopa_layout_manager_settings', 'news_mix_lite_register_layouts');

function news_mix_lite_get_positions(){
	return apply_filters('news_mix_lite_get_positions', array(
		'pos_sidebar_top' => esc_html__( 'WIDGET AREA TOP', 'news-mix-lite' ),
		'pos_sidebar_13'  => esc_html__( 'WIDGET AREA 13', 'news-mix-lite' ),
		'pos_sidebar_17'  => esc_html__( 'WIDGET AREA 17', 'news-mix-lite' )
	));
}

function news_mix_lite_get_sidebars(){
	return apply_filters('news_mix_lite_get_sidebars', array(
		'pos_sidebar_top' => 'sidebar_top',
		'pos_sidebar_13'  => 'sidebar_13',
		'pos_sidebar_17'  => 'sidebar_17'
	));
}

function news_mix_lite_register_layouts( $options ) {
	$positions = news_mix_lite_get_positions();
	$sidebars  = news_mix_lite_get_sidebars();

	$blog_sidebar = array(
		'title'     => esc_html__( 'Blog', 'news-mix-lite' ),
		'preview'   => get_template_directory_uri() . '/inc/assets/images/layouts/blog.jpg',
		'positions' => array(
			'pos_sidebar_top',
			'pos_sidebar_13'
		)
	);

	$page_right_sidebar = array(
		'title'     => esc_html__( 'Page Right Sidebar', 'news-mix-lite' ),
		'preview'   => get_template_directory_uri() . '/inc/assets/images/layouts/page.jpg',
		'positions' => array(
			'pos_sidebar_13'
		)
	);

	$page_fullwidth = array(
		'title'     => esc_html__( 'Page Full Width', 'news-mix-lite' ),
		'preview'   => get_template_directory_uri() . '/inc/assets/images/layouts/page-full-width.jpg',
		'positions' => array()
	);

	$page_fullwidth_widget = array(
		'title'     => esc_html__( 'Page Full Width Widgets', 'news-mix-lite' ),
		'preview'   => get_template_directory_uri() . '/inc/assets/images/layouts/page-full-width-widgets.jpg',
		'positions' => array(
			'pos_sidebar_17'
		)
	);

	$single_right_sidebar = array(
		'title'     => esc_html__( 'Single Right Sidebar', 'news-mix-lite' ),
		'preview'   => get_template_directory_uri() . '/inc/assets/images/layouts/single.jpg',
		'positions' => array(
			'pos_sidebar_13'
		)
	);

	$error_404 = array(
		'title'     => esc_html__('404 Page', 'news-mix-lite'),
		'preview'   => get_template_directory_uri() . '/inc/assets/images/layouts/error-404.jpg',
		'positions' => array()
	);

	#1: Blog
	$options['blog-layout']['positions'] = $positions;
	$options['blog-layout']['layouts'] = array(
		'blog'   => $blog_sidebar
	);
	$options['blog-layout']['default'] = array(
		'layout_id' => 'blog',
		'sidebars'  => array(
			'blog'   => $sidebars
		)
	);

	#2: Single
	$options['post-layout']['positions'] = $positions;
	$options['post-layout']['layouts'] = array(
		'single-right-sidebar'   => $single_right_sidebar
	);
	$options['post-layout']['default'] = array(
		'layout_id' => 'single-right-sidebar',
		'sidebars'  => array(
			'single-right-sidebar'   => $sidebars
		)
	);

	#3: Page
	$options['page-layout']['positions'] = $positions;
    $options['page-layout']['layouts'] = array(
		'page-right-sidebar'    => $page_right_sidebar,
		'page-fullwidth'        => $page_fullwidth,
		'page-fullwidth-widget' => $page_fullwidth_widget
    );
    $options['page-layout']['default'] = array(
		'layout_id' => 'page-right-sidebar',
		'sidebars'  => array(
			'page-right-sidebar'    => $sidebars,
			'page-fullwidth'        => $sidebars,
			'page-fullwidth-widget' => $sidebars
        )
    );

    #4: Front Page
    $options['frontpage-layout']['positions'] = $positions;
    $options['frontpage-layout']['layouts'] = array(
        'page-right-sidebar'    => $page_right_sidebar,
		'page-fullwidth'        => $page_fullwidth,
		'page-fullwidth-widget' => $page_fullwidth_widget
    );
    $options['frontpage-layout']['default'] = array(
		'layout_id' => 'page-right-sidebar',
		'sidebars'  => array(
			'page-right-sidebar'    => $sidebars,
			'page-fullwidth'        => $sidebars,
			'page-fullwidth-widget' => $sidebars
        )
    );

	#5: Search Page
    $options['search-layout']['positions'] = $positions;
    $options['search-layout']['layouts'] = array(
        'blog'   => $blog_sidebar
    );

    $options['search-layout']['default'] = array(
		'layout_id' => 'blog',
		'sidebars'  => array(
            'blog'   => $sidebars
        )
	);

	#6: Error 404
    $options['error404-layout']['positions'] = $positions;
    $options['error404-layout']['layouts'] = array(
        'error-404' => $error_404
    );

    $options['error404-layout']['default'] = array(
		'layout_id' => 'error-404',
		'sidebars'  => array(
            'error-404' => $sidebars
        )
    );

	return $options;
}
