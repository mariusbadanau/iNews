<?php
if ( class_exists('Kopa_Framework') ){
    add_filter('kopa_current_tab_default', 'news_mix_lite_set_default_tab');
    add_filter( 'kopa_settings_theme_options_enable', '__return_false' );
}

function news_mix_lite_set_default_tab($key) {
    return 'sidebar-manager'; // layout-manager, backup-manager
}

add_action('after_setup_theme', 'news_mix_lite_front_after_setup_theme');

function news_mix_lite_front_after_setup_theme(){    
    add_theme_support('title-tag');
    add_theme_support('post-formats', array('gallery', 'audio', 'video'));
    add_theme_support('post-thumbnails');
    add_theme_support('loop-pagination');
    add_theme_support('automatic-feed-links');
    add_theme_support('editor_style');
    add_editor_style('editor-style.css');
    add_theme_support( 'custom-background' );
    add_theme_support( 'custom-header', array( "header-text" => false) );

    global $content_width;
    if (!isset($content_width))
        $content_width = 665;
    register_nav_menus(array(
        'main-nav'   => esc_html__('Main Menu', 'news-mix-lite'),
        'footer-nav' => esc_html__('Footer Menu', 'news-mix-lite')
    ));

    if (!is_admin()) {
        add_action('wp_enqueue_scripts', 'news_mix_lite_front_enqueue_scripts');
        add_action('wp_footer', 'news_mix_lite_footer');
        add_action('wp_head', 'news_mix_lite_head');
        add_filter('the_category', 'news_mix_lite_the_category');
        add_filter('get_the_excerpt', 'news_mix_lite_get_the_excerpt');
        add_filter('post_class', 'news_mix_lite_post_class');
        add_filter('body_class', 'news_mix_lite_body_class');
        add_filter('excerpt_length', 'news_mix_lite_custom_excerpt_length');
        add_filter('news_mix_lite_get_sidebar', 'news_mix_lite_set_sidebar', 10, 2);
    } 
    add_filter( 'kopa_backup_settings', 'news_mix_lite_hide_theme_options_backup_restore' );
    add_action( 'admin_enqueue_scripts', 'news_mix_lite_tmg_notice' );

    $sizes = array(
        'kopa-image-size-0' => array(446, 411, TRUE, esc_html__('Flexslider Post Image (Kopatheme)', 'news-mix-lite')),
        'kopa-image-size-1' => array(168, 148, TRUE, esc_html__('Featured Post Thumbnail (Kopatheme)', 'news-mix-lite')),
        'kopa-image-size-2' => array(234, 169, TRUE, esc_html__('Carousel Post Thumbnail (Kopatheme)', 'news-mix-lite')),
        'kopa-image-size-3' => array(53, 53, TRUE, esc_html__('Tabs List Widget Post Thumbnail (Kopatheme)', 'news-mix-lite')),
        'kopa-image-size-4' => array(207, 191, TRUE, esc_html__('Entry List Widget Post Thumbnail 1 (Kopatheme)', 'news-mix-lite')),
        'kopa-image-size-5' => array(307, 219, TRUE, esc_html__('Entry List Widget Post Thumbnail 2 (Kopatheme)', 'news-mix-lite')),
        'kopa-image-size-6' => array(690, 377, TRUE, esc_html__('Flexslider Post Image 2 (Kopatheme)', 'news-mix-lite')),
        'kopa-image-size-7' => array(589, 392, TRUE, esc_html__('Video, Gallery Post Slider Image (Kopatheme)', 'news-mix-lite'))
    );
    apply_filters('news_mix_lite_get_image_sizes', $sizes);

    foreach ($sizes as $slug => $details) {
        add_image_size($slug, $details[0], $details[1], $details[2]);
    }

    load_theme_textdomain('news-mix-lite', get_template_directory() . '/languages');

}

function news_mix_lite_post_class($classes) {
    if (is_single()) {
        $classes[] = 'entry-box';
        $classes[] = 'clearfix';
    }
    return $classes;
}

function news_mix_lite_body_class($classes) {

    $template_setting = news_mix_lite_get_template_setting();
    if (is_front_page()) {
        $classes[] = 'home-page';
    } else {
        $classes[] = 'sub-page';
    }
    if (get_theme_mod('news_mix_lite_options_layout', 'box') == 'wide') {
        $classes[] = 'kopa-style-full';
    } else {
        $classes[] = 'kopa-style-box';
    }
    if (is_404()) {
        return $classes;
    }
    switch ($template_setting['layout_id']) {
        case 'home-page-1':
            $classes[] = 'kopa-home-1';
            break;
        case 'single-right-sidebar':
            $post_thumbnail_style = get_theme_mod('news_mix_lite_options_post_thumbnail_style', 'small');
            if ($post_thumbnail_style == 'large') {
                $classes[] = 'kopa-single-2';
            }
            $queried_object = get_queried_object();
            if ('video' == get_post_format($queried_object->ID)) {
                $classes[] = 'background-red';
            }
            break;
    }
    return $classes;
}

function news_mix_lite_head(){
    $logo_margin_top                  = get_theme_mod('news_mix_lite_options_logo_margin_top');
    $logo_margin_left                 = get_theme_mod('news_mix_lite_options_logo_margin_left');
    $logo_margin_right                = get_theme_mod('news_mix_lite_options_logo_margin_right');
    $logo_margin_bottom               = get_theme_mod('news_mix_lite_options_logo_margin_bottom');
    $news_mix_lite_options_color_code = get_theme_mod('news_mix_lite_options_color_code', '#e03d3d');
    echo "<style>
        #logo-image{
        margin-top:{$logo_margin_top}px;
        margin-left:{$logo_margin_left}px;
        margin-right:{$logo_margin_right}px;
        margin-bottom:{$logo_margin_bottom}px;
        }
        </style>";
    /* =========================================================
    Main Colorscheme
    ============================================================ */

    /* ==================================================================================================
    * Custom heading color
    * ================================================================================================= */

    /* =========================================================
    Font family
    ============================================================ */

    /* =========================================================
    Font size
    ============================================================ */


    /* ================================================================================
    * Font weight
    ================================================================================ */

    /* ==================================================================================================
    * Custom heading color
    * ================================================================================================= */

    /* ================================================================================
    * Custom Background
    ================================================================================ */

    /* ================================================================================
    * Custom Header Background
    ================================================================================ */

    /* ==================================================================================================
    * Custom CSS
    * ================================================================================================= */
    
    /* ==================================================================================================
    * IE8 Fix CSS3
    * ================================================================================================= */
    echo "<style>
        .kp-dropcap.color,
        .kopa-carousel-widget .pager a,
        .kopa-video-widget ul li .entry-item .entry-content .entry-thumb .play-icon,
        .widget-area-12 .kopa-entry-list-widget .kopa-entry-list .play-icon,
        .kp-gallery-slider .play-icon,
        .kp-gallery-carousel .play-icon {
        behavior: url(" . get_template_directory_uri() . "/js/PIE.htc);
        }
        </style>";

    /*
    post metadata
    */
    $metadata = '';
    if(get_theme_mod('news_mix_lite_options_post_categories','show') == 'hide'){
        $metadata .= '.entry-box .entry-categories{
                        display:none;
                    }';
    }
    if(get_theme_mod('news_mix_lite_options_post_date','show') == 'hide'){
        $metadata .= '.entry-box .entry-date{
                        display:none;
                    }';
    }
    if(get_theme_mod('news_mix_lite_options_post_author','show') == 'hide'){
        $metadata .= '.entry-box .entry-author{
                        display:none;
                    }';
    }
    if(get_theme_mod('news_mix_lite_options_post_comment','show') == 'hide'){
        $metadata .= '.entry-box .entry-comments{
                        display:none;
                    }';
    }
    if(get_theme_mod('news_mix_lite_options_post_visit','show') == 'hide'){
        $metadata .= '.entry-box .entry-view{
                        display:none;
                    }';
    }
    if($metadata != ''){
        echo '<style>
        '.$metadata.'
        </style>';
    }
}

function news_mix_lite_footer() {
    wp_nonce_field('news_mix_lite_set_view_count', 'news_mix_lite_set_view_count_wpnonce', false);
}

function news_mix_lite_front_enqueue_scripts(){
    if (!is_admin()) {
        global $wp_styles, $is_IE;
        $dir = get_template_directory_uri();

        /* STYLESHEETs */
        wp_enqueue_style('news-mix-lite-bootstrap', $dir . '/css/bootstrap.css');
        wp_enqueue_style('news-mix-lite-fontAwesome', $dir . '/css/font-awesome.css');
        wp_enqueue_style('news-mix-lite-superfish', $dir . '/css/superfish.css');
        wp_enqueue_style('news-mix-lite-prettyPhoto', $dir . '/css/prettyPhoto.css');
        wp_enqueue_style('news-mix-lite-flexlisder', $dir . '/css/flexslider.css');
        wp_enqueue_style('news-mix-lite-style', get_stylesheet_uri());
        wp_enqueue_style('news-mix-lite-bootstrap-responsive', $dir . '/css/bootstrap-responsive.css');
        wp_enqueue_style('news-mix-lite-font-rokkitt', 'http://fonts.googleapis.com/css?family=Rokkitt');
        wp_enqueue_style('news-mix-lite-font-open-sans', 'http://fonts.googleapis.com/css?family=Open+Sans');
        // extra style

        wp_enqueue_style('news-mix-lite-responsive', $dir . '/css/responsive.css');
        if ($is_IE) {
            wp_register_style('news-mix-lite-ie', $dir . '/css/ie.css');
            $wp_styles->add_data('news-mix-lite-ie', 'conditional', 'lt IE 9');
            wp_enqueue_style('news-mix-lite-ie');
        }
        /* JAVASCRIPTs */
        wp_enqueue_script('news-mix-lite-modernizr', $dir . '/js/modernizr.custom.js');

        wp_localize_script('jquery', 'kopa_front_variable', news_mix_lite_front_localize_script());

        /**
         * Fix: Superfish conflicts with WP admin bar for WordPress < 3.6
         * @author joeldbirch
         * @link https://github.com/joeldbirch/superfish/issues/14
         * @filesource https://github.com/briancherne/jquery-hoverIntent
         */
        wp_deregister_script('hoverIntent');
        wp_register_script('hoverIntent', ('/js/jquery.hoverIntent.js'), array('jquery'), 'r7');
        wp_enqueue_script('news-mix-lite-superfish-js', $dir . '/js/superfish.js', array('jquery'), NULL, TRUE);
        wp_enqueue_script('news-mix-lite-retina', $dir . '/js/retina.js', array('jquery'), NULL, TRUE);
        wp_enqueue_script('news-mix-lite-bootstrap-js', $dir . '/js/bootstrap.js', array('jquery'), NULL, TRUE);
        wp_enqueue_script('news-mix-lite-carouFredSel', $dir . '/js/jquery.caroufredsel-6.0.4-packed.js', array('jquery'), NULL, TRUE);
        wp_enqueue_script('news-mix-lite-classie', $dir . '/js/classie.js', array('jquery'), NULL, TRUE);
        wp_enqueue_script('news-mix-lite-uisearch', $dir . '/js/uisearch.js', array('jquery'), NULL, TRUE);
        wp_enqueue_script('news-mix-lite-flexlisder-js', $dir . '/js/jquery.flexslider-min.js', array('jquery'), NULL, TRUE);
        wp_enqueue_script('news-mix-lite-prettyPhoto-js', $dir . '/js/jquery.prettyPhoto.js', array('jquery'), NULL, TRUE);
        wp_enqueue_script('news-mix-lite-tweetable-js', $dir . '/js/tweetable.jquery.js', array('jquery'), NULL, TRUE);
        wp_enqueue_script('news-mix-lite-timeago-js', $dir . '/js/jquery.timeago.js', array('jquery'), NULL, TRUE);
        
        wp_enqueue_script('news-mix-lite-jquery-validate', $dir . '/js/jquery.validate.min.js', array('jquery'), NULL, TRUE);
        wp_enqueue_script('jquery-form', null, array('jquery'), NULL, TRUE);
        wp_enqueue_script('news-mix-lite-custom', $dir . '/js/custom.js', array('jquery'), NULL, TRUE);
        // send localization to frontend
        wp_localize_script('news-mix-lite-custom', 'kopa_custom_front_localization', news_mix_lite_custom_front_localization());
        if (is_single() || is_page()) {
            wp_enqueue_script('comment-reply');
        }
    }
}

function news_mix_lite_tmg_notice(){
    wp_register_style( 'custom_wp_admin_css', get_template_directory_uri() . '/css/tgm-notice.css', false, '1.0.0' );
    wp_enqueue_style( 'custom_wp_admin_css' );
}
function news_mix_lite_front_localize_script(){
    $news_mix_lite_variable = array(
        'ajax' => array(
            'url' => admin_url('admin-ajax.php')
        ),
        'template' => array(
            'post_id' => (is_singular()) ? get_queried_object_id() : 0
        )
    );
    return $news_mix_lite_variable;
}

function news_mix_lite_custom_front_localization(){
    $front_localization = array(
        'validate' => array(
            'form' => array(
                'submit' => __('Submit', 'news-mix-lite'),
                'sending' => __('Sending...', 'news-mix-lite')
            ),
            'name' => array(
                'required' => __('Please enter your name.', 'news-mix-lite'),
                'minlength' => __('At least {0} characters required.', 'news-mix-lite')
            ),
            'email' => array(
                'required' => __('Please enter your email.', 'news-mix-lite'),
                'email' => __('Please enter a valid email.', 'news-mix-lite')
            ),
            'url' => array(
                'required' => __('Please enter your url.', 'news-mix-lite'),
                'url' => __('Please enter a valid url.', 'news-mix-lite')
            ),
            'message' => array(
                'required' => __('Please enter a message.', 'news-mix-lite'),
                'minlength' => __('At least {0} characters required.', 'news-mix-lite')
            )
        )
    );
    return $front_localization;
}

function news_mix_lite_the_category($thelist) {
    return $thelist;
}

function news_mix_lite_breadcrumb(){
    if (is_main_query()) {
        global $post, $wp_query;
        $prefix = '&nbsp;/&nbsp;';
        $current_class = 'current-page';
        $description = '';
        $breadcrumb_before = '<div class="row-fluid"><div class="span12"><div class="breadcrumb">';
        $breadcrumb_after = '</div></div></div>';
        $breadcrumb_home = '<a href="' . esc_url(home_url('/')) . '">' . __('Home', 'news-mix-lite') . '</a>';
        $breadcrumb = '';
        ?>
        <?php
        if (is_home()) {
            $breadcrumb .= $breadcrumb_home;
            $breadcrumb .= $prefix . sprintf('<span class="%1$s">%2$s</span>', $current_class, __('Blog', 'news-mix-lite'));
        } else if (is_post_type_archive('product') && jigoshop_get_page_id('shop')) {
            $breadcrumb .= $breadcrumb_home;
            $breadcrumb .= $prefix . sprintf('<span class="%1$s">%2$s</span>', $current_class, wp_kses_post( get_the_title(jigoshop_get_page_id('shop'))));
        } else if (is_tag()) {
            $breadcrumb .= $breadcrumb_home;
            $term = get_term(get_queried_object_id(), 'post_tag');
            $breadcrumb .= $prefix . sprintf('<span class="%1$s">%2$s</span>', $current_class, wp_kses_post( $term->name ));
        } else if (is_category()) {
            $breadcrumb .= $breadcrumb_home;
            $category_id = get_queried_object_id();
            $terms_link = explode(',', substr(get_category_parents(get_queried_object_id(), TRUE, ','), 0, (strlen(',') * -1)));
            $n = count($terms_link);
            if ($n > 1) {
                for ($i = 0; $i < ($n - 1); $i++) {
                    $breadcrumb .= $prefix . $terms_link[$i];
                }
            }
            $breadcrumb .= $prefix . sprintf('<span class="%1$s">%2$s</span>', $current_class, wp_kses_post( get_the_category_by_ID(get_queried_object_id())));
        } else if (is_tax('product_cat')) {
            $breadcrumb .= $breadcrumb_home;
            $breadcrumb .= '<a href="' . esc_url( get_page_link(jigoshop_get_page_id('shop')) ) . '">' . wp_kses_post( get_the_title(jigoshop_get_page_id('shop')) ) . '</a>';
            $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
            $parents = array();
            $parent = $term->parent;
            while ($parent):
                $parents[] = $parent;
                $new_parent = get_term_by('id', $parent, get_query_var('taxonomy'));
                $parent = $new_parent->parent;
            endwhile;
            if (!empty($parents)):
                $parents = array_reverse($parents);
                foreach ($parents as $parent):
                    $item = get_term_by('id', $parent, get_query_var('taxonomy'));
                    $breadcrumb .= '<a href="' . esc_url( get_term_link($item->slug, 'product_cat') ) . '">' . $item->name . '</a>';
                endforeach;
            endif;
            $queried_object = get_queried_object();
            $breadcrumb .= $prefix . sprintf('<span class="%1$s">%2$s</span>', $current_class, wp_kses_post( $queried_object->name ));
        } else if (is_tax('product_tag')) {
            $breadcrumb .= $breadcrumb_home;
            $breadcrumb .= '<a href="' . esc_url( get_page_link(jigoshop_get_page_id('shop'))) . '">' . wp_kses_post( get_the_title(jigoshop_get_page_id('shop')) ) . '</a>';
            $queried_object = get_queried_object();
            $breadcrumb .= $prefix . sprintf('<span class="%1$s">%2$s</span>', $current_class, wp_kses_post( $queried_object->name ));
        } else if (is_single()) {
            $breadcrumb .= $breadcrumb_home;
            if (get_post_type() === 'product') :
                $breadcrumb .= '<a href="' . esc_url ( get_page_link(jigoshop_get_page_id('shop')) ) . '">' . wp_kses_post( get_the_title(jigoshop_get_page_id('shop')) ) . '</a>';
                if ($terms = get_the_terms($post->ID, 'product_cat')) :
                    $term = apply_filters('jigoshop_product_cat_breadcrumb_terms', current($terms), $terms);
                    $parents = array();
                    $parent = $term->parent;
                    while ($parent):
                        $parents[] = $parent;
                        $new_parent = get_term_by('id', $parent, 'product_cat');
                        $parent = $new_parent->parent;
                    endwhile;
                    if (!empty($parents)):
                        $parents = array_reverse($parents);
                        foreach ($parents as $parent):
                            $item = get_term_by('id', $parent, 'product_cat');
                            $breadcrumb .= '<a href="' . esc_url( get_term_link($item->slug, 'product_cat') ) . '">' . $item->name . '</a>';
                        endforeach;
                    endif;
                    $breadcrumb .= '<a href="' . esc_url( get_term_link($term->slug, 'product_cat') ) . '">' . $term->name . '</a>';
                endif;
                $breadcrumb .= $prefix . sprintf('<span class="%1$s">%2$s</span>', $current_class, wp_kses_post( get_the_title()) );
            else :
                $categories = get_the_category(get_queried_object_id());
                if ($categories) {
                    foreach ($categories as $category) {
                        $breadcrumb .= $prefix . sprintf('<a href="%1$s">%2$s</a>', esc_url( get_category_link($category->term_id) ), wp_kses_post( $category->name ) );
                    }
                }
                $post_id = get_queried_object_id();
                if( get_the_title($post_id) ) {
                    $breadcrumb .= $prefix . sprintf('<span class="%1$s">%2$s</span>', $current_class, wp_kses_post( get_the_title($post_id)) );
                }
            endif;
        } else if (is_page()) {
            if (!is_front_page()) {
                $post_id = get_queried_object_id();
                $breadcrumb .= $breadcrumb_home;
                $post_ancestors = get_post_ancestors($post);
                if ($post_ancestors) {
                    $post_ancestors = array_reverse($post_ancestors);
                    foreach ($post_ancestors as $crumb)
                        $breadcrumb .= $prefix . sprintf('<a href="%1$s">%2$s</a>', esc_url ( get_permalink($crumb) ), wp_kses_post( get_the_title($crumb)));
                }
                $breadcrumb .= $prefix . sprintf('<span class="%1$s">%2$s</span>', $current_class, wp_kses_post( get_the_title(get_queried_object_id())));
            }
        } else if (is_year() || is_month() || is_day()) {
            $breadcrumb .= $breadcrumb_home;
            $date = array('y' => NULL, 'm' => NULL, 'd' => NULL);
            $date['y'] = get_the_time('Y');
            $date['m'] = get_the_time('m');
            $date['d'] = get_the_time('j');
            if (is_year()) {
                $breadcrumb .= $prefix . sprintf('<span class="%1$s">%2$s</span>', $current_class, date_i18n('F', mktime(0, 0, 0, $date['y'])));
            }
            if (is_month()) {
                $breadcrumb .= $prefix . sprintf('<a href="%1$s">%2$s</a>', esc_url( get_year_link($date['y'])), $date['y']);
                $breadcrumb .= $prefix . sprintf('<span class="%1$s">%2$s</span>', $current_class, date_i18n('F', mktime(0, 0, 0, $date['m'])));
            }
            if (is_day()) {
                $breadcrumb .= $prefix . sprintf('<a href="%1$s">%2$s</a>', esc_url( get_year_link($date['y'])), $date['y'] );
                $breadcrumb .= $prefix . sprintf('<a href="%1$s">%2$s</a>', esc_url( get_month_link($date['y'])), $date['m'] );
                $breadcrumb .= $prefix . sprintf('<span class="%1$s">%2$s</span>', $current_class, $date['d']);
            }
        } else if (is_search()) {
            $breadcrumb .= $breadcrumb_home;
            $s = get_search_query();
            $c = $wp_query->found_posts;
            $description = sprintf(__('<span class="%1$s">Your search for "%2$s"', 'news-mix-lite'), $current_class, $s);
            $breadcrumb .= $prefix . $description;
        } else if (is_author()) {
            $breadcrumb .= $breadcrumb_home;
            $author_id = get_queried_object_id();
            $breadcrumb .= $prefix . sprintf('<span class="%1$s">%2$s</a>', $current_class, sprintf(__('Posts created by %1$s', 'news-mix-lite'), wp_kses_post( get_the_author_meta('display_name', $author_id))) );
        } else if (is_404()) {
            $breadcrumb .= $breadcrumb_home;
            $breadcrumb .= $prefix . sprintf('<span class="%1$s">%2$s</span>', $current_class, __('Page not found', 'news-mix-lite'));
        }
        if ($breadcrumb)
            echo apply_filters('kopa_breadcrumb', $breadcrumb_before . $breadcrumb . $breadcrumb_after);
    }
}

function news_mix_lite_get_related_articles() {
    if (is_single()) {
        $get_by = get_theme_mod('news_mix_lite_options_post_related_get_by', 'hide');
        if ('hide' != $get_by) {
            $limit = (int)get_theme_mod('news_mix_lite_options_post_related_limit', 4);
            if ($limit > 0) {
                global $post;
                $taxs = array();
                if ('category' == $get_by) {
                    $cats = get_the_category(($post->ID));
                    if ($cats) {
                        $ids = array();
                        foreach ($cats as $cat) {
                            $ids[] = $cat->term_id;
                        }
                        $taxs [] = array(
                            'taxonomy' => 'category',
                            'field' => 'id',
                            'terms' => $ids
                        );
                    }
                } else {
                    $tags = get_the_tags($post->ID);
                    if ($tags) {
                        $ids = array();
                        foreach ($tags as $tag) {
                            $ids[] = $tag->term_id;
                        }
                        $taxs [] = array(
                            'taxonomy' => 'post_tag',
                            'field' => 'id',
                            'terms' => $ids
                        );
                    }
                }
                if ($taxs) {
                    $related_args = array(
                        'tax_query' => $taxs,
                        'post__not_in' => array($post->ID),
                        'posts_per_page' => $limit
                    );
                    $related_posts = new WP_Query($related_args);
                    $carousel_id = ($related_posts->post_count > 3) ? 'related-widget' : 'related-widget-no-carousel';
                    if ($related_posts->have_posts()):
                        ?>
                        <div class="kopa-related-post">
                            <h3><span class="title-line"></span><span
                                    class="title-text"><?php esc_html_e('Related Articles', 'news-mix-lite'); ?></span></h3>
                            <ul class="clearfix">
                                <?php $post_index = 1;
                                while ($related_posts->have_posts()) : $related_posts->the_post(); ?>
                                    <li>
                                        <article class="entry-item clearfix">
                                            <?php if (has_post_thumbnail()) : ?>
                                                <div class="entry-thumb">
                                                    <a href="<?php the_permalink(); ?>"><img
                                                            src="<?php echo esc_url( news_mix_lite_get_image_src(get_the_ID(), 'kopa-image-size-3') ); // 53x53 ?>"
                                                            alt="<?php echo esc_attr( get_the_title() ); ?>"></a>
                                                </div>
                                            <?php else: ?>
                                                <div class="entry-thumb">
                                                    <a href="<?php the_permalink(); ?>"><img
                                                            src="http://placehold.it/53x53"
                                                            alt="<?php echo esc_attr( get_the_title() ); ?>"></a>
                                                </div>
                                            <?php endif; ?>
                                            <div class="entry-content">
                                                <h4 class="entry-title"><a
                                                        href="<?php the_permalink(); ?>"><?php echo esc_html( get_the_title() ); ?></a></h4>
                                                <span class="entry-date"><span
                                                        class="kopa-minus"></span><?php the_time(get_option('date_format')); ?></span>
                                            </div>
                                        </article>
                                    </li>
                                    <?php
                                    if ($post_index % 2 == 0)
                                        echo '</ul><ul class="clearfix">';
                                    $post_index++;
                                endwhile; ?>
                            </ul>
                        </div>
                    <?php
                    endif;
                    wp_reset_postdata();
                }
            }
        }
    }
}

function news_mix_lite_get_the_excerpt($excerpt) {
    if (is_main_query()) {
        if (is_category() || is_tag()) {
            $limit = (int) get_theme_mod('gs_excerpt_max_length', 100);
            if (strlen($excerpt) > $limit) {
                $break_pos = strpos($excerpt, ' ', $limit);
                $visible = substr($excerpt, 0, $break_pos);
                return balanceTags($visible);
            } else {
                return $excerpt;
            }
        } else if (is_search()) {
            return $excerpt;
        } else {
            return $excerpt;
        }
    }
}

function news_mix_lite_content_get_gallery($content, $enable_multi = false) {
    return news_mix_lite_content_get_media($content, $enable_multi, array('gallery'));
}

function news_mix_lite_content_get_video($content, $enable_multi = false) {
    return news_mix_lite_content_get_media($content, $enable_multi, array('vimeo', 'youtube'));
}

function news_mix_lite_content_get_audio($content, $enable_multi = false) {
    return news_mix_lite_content_get_media($content, $enable_multi, array('audio', 'soundcloud'));
}

function news_mix_lite_content_get_media($content, $enable_multi = false, $media_types = array()) {
    $media = array();
    $regex_matches = '';
    $regex_pattern = get_shortcode_regex();
    preg_match_all('/' . $regex_pattern . '/s', $content, $regex_matches);
    foreach ($regex_matches[0] as $shortcode) {
        $regex_matches_new = '';
        preg_match('/' . $regex_pattern . '/s', $shortcode, $regex_matches_new);

        if (in_array($regex_matches_new[2], $media_types)) :
            $media[] = array(
                'shortcode' => $regex_matches_new[0],
                'type' => $regex_matches_new[2],
                'url' => $regex_matches_new[5]
            );
            if (false == $enable_multi) {
                break;
            }
        endif;
    }

    return $media;
}

function news_mix_lite_custom_excerpt_length($length){
    $length=17; 
    return $length;
}

/**
 * Convert Hex Color to RGB using PHP
 * @link http://bavotasan.com/2011/convert-hex-color-to-rgb-using-php/
 */
function kopa_hex2rgba($hex, $alpha = false) {
    $hex = str_replace("#", "", $hex);

    if (strlen($hex) == 3) {
        $r = hexdec(substr($hex, 0, 1) . substr($hex, 0, 1));
        $g = hexdec(substr($hex, 1, 1) . substr($hex, 1, 1));
        $b = hexdec(substr($hex, 2, 1) . substr($hex, 2, 1));
    } else {
        $r = hexdec(substr($hex, 0, 2));
        $g = hexdec(substr($hex, 2, 2));
        $b = hexdec(substr($hex, 4, 2));
    }
    if ($alpha) {
        return array($r, $g, $b, $alpha);
    }

    return array($r, $g, $b);
}

function news_mix_lite_content_get_gallery_attachment_ids($content) {
    $gallery = news_mix_lite_content_get_gallery($content);

    if (isset($gallery[0])) {
        $gallery = $gallery[0];
    } else {
        return '';
    }

    if (isset($gallery['shortcode'])) {
        $shortcode = $gallery['shortcode'];
    } else {
        return '';
    }

    // get gallery string ids
    preg_match_all('/ids=\"(?:\d+,*)+\"/', $shortcode, $gallery_string_ids);
    if (isset($gallery_string_ids[0][0])) {
        $gallery_string_ids = $gallery_string_ids[0][0];
    } else {
        return '';
    }

    // get array of image id
    preg_match_all('/\d+/', $gallery_string_ids, $gallery_ids);
    if (isset($gallery_ids[0])) {
        $gallery_ids = $gallery_ids[0];
    } else {
        return '';
    }

    return $gallery_ids;
}

add_filter('news_mix_lite_icon_get_icon', 'news_mix_lite_icon_get_icon', 10, 3);
function news_mix_lite_icon_get_icon($html, $icon_class, $icon_tag){
    $classes = '';
    switch ($icon_class) {
        case 'facebook':
            $classes = 'fa fa-facebook';
            break;
        case 'facebook2':
            $classes = 'fa fa-facebook-square';
            break;
        case 'twitter':
            $classes = 'fa fa-twitter';
            break;
        case 'twitter2':
            $classes = 'fa fa-twitter-square';
            break;
        case 'google-plus':
            $classes = 'fa fa-google-plus';
            break;
        case 'google-plus2':
            $classes = 'fa fa-google-plus-square';
            break;
        case 'youtube':
            $classes = 'fa fa-youtube';
            break;
        case 'dribbble':
            $classes = 'fa fa-dribbble';
            break;
        case 'flickr':
            $classes = 'fa fa-flickr';
            break;
        case 'rss':
            $classes = 'fa fa-rss';
            break;
        case 'linkedin':
            $classes = 'fa fa-linkedin';
            break;
        case 'pinterest':
            $classes = 'fa fa-pinterest';
            break;
        case 'email':
            $classes = 'fa fa-envelope';
            break;
        case 'pencil':
            $classes = 'fa fa-pencil';
            break;
        case 'date':
            $classes = 'fa fa-clock-o';
            break;
        case 'comment':
            $classes = 'fa fa-comment';
            break;
        case 'view':
            $classes = 'fa fa-eye';
            break;
        case 'link':
            $classes = 'fa fa-link';
            break;
        case 'film':
            $classes = 'fa fa-film';
            break;
        case 'images':
            $classes = 'fa fa-picture-o';
            break;
        case 'music':
            $classes = 'fa fa-music';
            break;
        case 'long-arrow-right':
            $classes = 'fa fa-long-arrow-right';
            break;
        case 'apple':
            $classes = 'fa fa-apple';
            break;
        case 'star':
            $classes = 'fa fa-star';
            break;
        case 'star2':
            $classes = 'fa fa-star-o';
            break;
        case 'exit':
            $classes = 'fa fa-sign-out';
            break;
        case 'folder':
            $classes = 'fa fa-folder';
            break;
        case 'video':
            $classes = 'fa fa-video-camera';
            break;
        case 'play':
            $classes = 'fa fa-play';
            break;
        case 'spinner':
            $classes = 'fa fa-spinner';
            break;
        case 'bug':
            $classes = 'fa fa-bug';
            break;
        case 'tint':
            $classes = 'fa fa-tint';
            break;
        case 'pause':
            $classes = 'fa fa-pause';
            break;
        case 'crosshairs':
            $classes = 'fa fa-crosshairs';
            break;
        case 'cog':
            $classes = 'fa fa-cog';
            break;
        case 'check-circle':
            $classes = 'fa fa-check-circle-o';
            break;
        case 'hand-right':
            $classes = 'fa fa-hand-o-right';
            break;
        case 'plus-square':
            $classes = 'fa fa-plus-square';
            break;
        case 'trash':
            $classes = 'fa fa-trash-o';
            break;
        case 'arrow-circle-up':
            $classes = 'fa fa-arrow-circle-up';
            break;
        case 'volume':
            $classes = 'fa fa-volume-up';
            break;
    }
    return News_Mix_Lite_Icon::createHtml($classes, $icon_tag);
}

class News_Mix_Lite_Mobile_Menu extends Walker_Nav_Menu {
    function start_el(&$output, $item, $depth = 0, $args = array(), $current_object_id = 0){
        global $wp_query;
        $indent = ($depth) ? str_repeat("\t", $depth) : '';
        $class_names = $value = '';
        $classes = empty($item->classes) ? array() : (array)$item->classes;
        $classes[] = 'menu-item-' . $item->ID;
        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));

        if ($depth == 0)
            $class_names = $class_names ? ' class="' . esc_attr($class_names) . ' clearfix"' : 'class="clearfix"';
        else
            $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : 'class=""';
        $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args);
        $id = $id ? ' id="' . esc_attr($id) . '"' : '';
        $output .= $indent . '<li' . $id . $value . $class_names . '>';
        $attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
        $attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
        $attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
        $attributes .= !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';
        if ($depth == 0) {
            $item_output = $args->before;
            $item_output .= '<h3><a' . $attributes . '>';
            $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
            $item_output .= '</a></h3>';
            $item_output .= $args->after;
        } else {
            $item_output = $args->before;
            $item_output .= '<a' . $attributes . '>';
            $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
            $item_output .= '</a>';
            $item_output .= $args->after;
        }
        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }

    function start_lvl(&$output, $depth = 0, $args = array()){
        $indent = str_repeat("\t", $depth);
        if ($depth == 0) {
            $output .= "\n$indent<span>+</span><div class='clear'></div><div class='menu-panel clearfix'><ul>";
        } else {
            $output .= '<ul>'; // indent for level 2, 3 ...
        }
    }

    function end_lvl(&$output, $depth = 0, $args = array()){
        $indent = str_repeat("\t", $depth);
        if ($depth == 0) {
            $output .= "$indent</ul></div>\n";
        } else {
            $output .= '</ul>';
        }
    }
}

function news_mix_lite_get_template_setting($default = null) {
    if( function_exists('kopa_get_template_setting') ){
        return kopa_get_template_setting();
    }

    return $default;
}

function news_mix_lite_get_image_src($pid = 0, $size = 'thumbnail'){
    $thumb = get_the_post_thumbnail($pid, $size);
    if (!empty($thumb)) {
        $_thumb = array();
        $regex = '#<\s*img [^\>]*src\s*=\s*(["\'])(.*?)\1#im';
        preg_match($regex, $thumb, $_thumb);
        $thumb = $_thumb[2];
    }
    return $thumb;
}

function news_mix_lite_get_post_meta($pid, $key = '', $single = false, $type = 'String', $default = ''){
    $data = get_post_meta($pid, $key, $single);
    switch ($type) {
        case 'Int':
            $data = (int)$data;
            return ($data >= 0) ? $data : $default;
            break;
        default:
            return ($data) ? $data : $default;
            break;
    }
}

function news_mix_lite_set_view_count($post_id){
    $new_view_count = 0;
    $meta_key = 'news_mix_lite_total_view';
    $current_views = (int)get_post_meta($post_id, $meta_key, true);
    if ($current_views) {
        $new_view_count = $current_views + 1;
        update_post_meta($post_id, $meta_key, $new_view_count);
    } else {
        $new_view_count = 1;
        add_post_meta($post_id, $meta_key, $new_view_count);
    }
    return $new_view_count;
}

function news_mix_lite_get_view_count($post_id){
    $key = 'news_mix_lite_total_view';
    return news_mix_lite_get_post_meta($post_id, $key, true, 'Int');
}

function news_mix_lite_highlight_search_title(){
    $title = get_the_title();
    $keys = implode('|', explode(' ', get_search_query()));
    $title = preg_replace('/(' . $keys . ')/iu', '<span class="kopa-search-keyword">\0</span>', $title);
    return $title;
}

function news_mix_lite_highlight_search_excerpt(){
    $excerpt = get_the_excerpt();
    $keys = implode('|', explode(' ', get_search_query()));
    $excerpt = preg_replace('/(' . $keys . ')/iu', '<span class="kopa-search-keyword">\0</span>', $excerpt);
    return '<p>' . $excerpt . '</p>';
}

function news_mix_lite_hide_theme_options_backup_restore($array){
    unset( $array[1]['options']['theme-options'] );
    unset( $array[4]['options']['theme-options'] );
    return $array;
}

if(!function_exists('news_mix_lite_get_url_embed_string')){
    function news_mix_lite_get_url_embed_string($content,$format) {

        // find all urls
        preg_match_all('/(http|https)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/', $content, $links);

        foreach ($links[0] as $link) {
            if($format == 'video') {
                if( preg_match('~youtube\.com|vimeo\.com~', $link)){
                    return $link;
                    break;
                }  
            }

            if($format == 'audio') {
                if( preg_match('~soundcloud\.com~', $link)){
                    return $link;
                    break;
                }  
            }
        }
    }
}