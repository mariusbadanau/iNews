<!DOCTYPE html>
<html <?php language_attributes(); ?>>              
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">                   
        <meta name="viewport" content="width=device-width, initial-scale=1.0">   
        <link rel="profile" href="http://gmpg.org/xfn/11">           
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">       
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
            <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
            <script src="<?php echo get_template_directory_uri(); ?>/js/PIE_IE678.js"></script>
        <![endif]-->        
        <?php wp_head(); ?>
    </head>    
    <body <?php body_class(); ?>>
        <div class="wrapper kopa-shadow">
            <div class="row-fluid">
                <div class="span12 clearfix">
                    <header id="page-header">

                        <div id="header-top" class="clearfix">
                            <div class="kp-headline-wrapper clearfix">
                                <?php if ('show' == get_theme_mod('news_mix_lite_options_display_headline_status', 'show')) { ?>
                                    <h6 class="kp-headline-title"><?php echo wp_kses_post( get_theme_mod('news_mix_lite_options_headline_title', esc_html__('Breaking News', 'news-mix-lite')) ); ?><span></span></h6>
                                <?php } // endif ?>
                                <div class="kp-headline clearfix">                        
                                    <dl class="ticker-1 clearfix">
                                        <?php
                                        if ('show' == get_theme_mod('news_mix_lite_options_display_headline_status', 'show')) {
                                            $news_mix_lite_headline_category_id = (int) get_theme_mod('news_mix_lite_options_headline_category_id');

                                                $news_mix_lite_headline_posts = new WP_Query(array(
                                                    'cat' => $news_mix_lite_headline_category_id
                                                ));

                                                if ($news_mix_lite_headline_posts->have_posts()) {
                                                    while ($news_mix_lite_headline_posts->have_posts()) {
                                                        $news_mix_lite_headline_posts->the_post();
                                                        echo '<dd><a href="' . esc_url( get_permalink() ) . '">' . get_the_title() . '</a></dd>';
                                                    }
                                                }
                                                wp_reset_postdata();
                                                
                                        } // endif
                                        ?>
                                    </dl><!--ticker-1-->
                                </div><!--kp-headline-->
                            </div><!--kp-headline-wrapper-->

                            <div class="social-search-box">
                                <?php
                                $news_mix_lite_facebook_url = esc_url(get_theme_mod('news_mix_lite_options_social_links_facebook_url'));
                                $news_mix_lite_twitter_url  = esc_url(get_theme_mod('news_mix_lite_options_social_links_twitter_url'));
                                $news_mix_lite_youtube_url  = esc_url(get_theme_mod('news_mix_lite_options_social_links_youtube_url'));
                                $news_mix_lite_dribbble_url = esc_url(get_theme_mod('news_mix_lite_options_social_links_dribbble_url'));
                                $news_mix_lite_flickr_url   = esc_url(get_theme_mod('news_mix_lite_options_social_links_flickr_url'));
                                $news_mix_lite_rss_url      = esc_url(get_theme_mod('news_mix_lite_options_social_links_rss_url'));
                                ?>

                                <ul class="social-links clearfix">
                                    <!-- facebook -->
                                    <?php
                                    if ($news_mix_lite_facebook_url) :
                                        echo sprintf('<li><a title="Facebook" href="%2$s" target="_blank" rel="nofollow" >%1$s</a></li>', News_Mix_Lite_Icon::getIcon('facebook'), $news_mix_lite_facebook_url);
                                    endif;
                                    ?>

                                    <!-- twitter -->
                                    <?php
                                    if ($news_mix_lite_twitter_url) :
                                        echo sprintf('<li><a title="Twitter" href="%2$s" target="_blank" rel="nofollow" >%1$s</a></li>', News_Mix_Lite_Icon::getIcon('twitter'), $news_mix_lite_twitter_url);
                                    endif;
                                    ?>

                                    <!-- youtube -->
                                    <?php
                                    if ($news_mix_lite_youtube_url) :
                                        echo sprintf('<li><a title="Youtube" href="%2$s" target="_blank" rel="nofollow" >%1$s</a></li>', News_Mix_Lite_Icon::getIcon('youtube'), $news_mix_lite_youtube_url);
                                    endif;
                                    ?>

                                    <!-- dribbble -->
                                    <?php
                                    if ($news_mix_lite_dribbble_url) :
                                        echo sprintf('<li><a title="Dribbble" href="%2$s" target="_blank" rel="nofollow" >%1$s</a></li>', News_Mix_Lite_Icon::getIcon('dribbble'), $news_mix_lite_dribbble_url);
                                    endif;
                                    ?>

                                    <!-- flickr -->
                                    <?php
                                    if ($news_mix_lite_flickr_url) :
                                        echo sprintf('<li><a title="Flickr" href="%2$s" target="_blank" rel="nofollow" >%1$s</a></li>', News_Mix_Lite_Icon::getIcon('flickr'), $news_mix_lite_flickr_url);
                                    endif;
                                    ?>

                                    <!-- rss -->
                                    <?php
                                    if (empty($news_mix_lite_rss_url)) :
                                        echo sprintf('<li><a title="RSS" href="%2$s" target="_blank" rel="nofollow" >%1$s</a></li>', News_Mix_Lite_Icon::getIcon('rss'), get_bloginfo('rss2_url'));
                                    elseif ($news_mix_lite_rss_url != 'HIDE') :
                                        echo sprintf('<li><a href="%2$s" target="_blank" rel="nofollow" >%1$s</a></li>', News_Mix_Lite_Icon::getIcon('rss'), esc_url($news_mix_lite_rss_url));
                                    endif;
                                    ?>
                                </ul><!--social-links-->

                                <div class="sb-search-wrapper">
                                    <div id="sb-search" class="sb-search">
                                        <form method="get" action="<?php echo esc_url(home_url('/')); ?>">
                                            <input class="sb-search-input" placeholder="<?php esc_html_e('Enter your search term...', 'news-mix-lite'); ?>" type="text" value="" name="s" id="search">
                                            <input class="sb-search-submit" type="submit" value="">
                                            <span class="sb-icon-search"></span>
                                        </form>
                                    </div><!--sb-search-->
                                </div><!--sb-search-wrapper-->
                            </div><!--social-search-box-->                    
                        </div><!--header-top-->

                        <div id="header-middle" class="clearfix">
                            <div id="logo-image">
                                <?php if (get_header_image()) { ?>
                                    <a href="<?php echo esc_url(home_url('/')); ?>">
                                        <img src="<?php header_image(); ?>" width="217" height="70" alt="<?php bloginfo('name'); ?> <?php esc_html_e('Logo', 'news-mix-lite'); ?>">
                                    </a>
                                <?php }else{ ?>
                                    <h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a></h1>
                                    <?php if( get_bloginfo('description') ) : ?>
                                        <div class="tagline"><?php bloginfo('description'); ?></div>
                                    <?php endif; ?>
                                <?php }; ?>
                            </div>
                            <div class="top-banner">
                                <?php echo htmlspecialchars_decode(stripslashes(get_theme_mod('news_mix_lite_options_top_banner_code'))); ?>
                            </div><!--top-banner-->
                        </div><!--header-middle-->

                        <div id="header-bottom">
                            <nav id="main-nav">
                                <?php
                                if (has_nav_menu('main-nav')) {
                                    wp_nav_menu(array(
                                        'theme_location' => 'main-nav',
                                        'container' => '',
                                        'menu_id' => 'main-menu',
                                        'items_wrap' => '<ul id="%1$s" class="%2$s clearfix">%3$s</ul>',
                                        'after' => '<span></span>'
                                    ));

                                    $mobile_menu_walker = new News_Mix_Lite_Mobile_Menu();
                                    wp_nav_menu(array(
                                        'theme_location' => 'main-nav',
                                        'container' => 'div',
                                        'container_id' => 'mobile-menu',
                                        'menu_id' => 'toggle-view-menu',
                                        'items_wrap' => '<span>' . esc_html__('Menu', 'news-mix-lite') . '</span><ul id="%1$s">%3$s</ul>',
                                        'walker' => $mobile_menu_walker
                                    ));
                                }
                                ?>
                            </nav><!--main-nav-->
                        </div><!--header-bottom-->

                    </header><!--page-header-->
                    <div id="main-content">