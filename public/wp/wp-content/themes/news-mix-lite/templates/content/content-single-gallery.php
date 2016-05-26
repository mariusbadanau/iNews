<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        
    <div class="entry-thumb">
        <?php
            $content = get_post_meta( get_the_id(), 'post_custom_featured', true );
            $gallery = news_mix_lite_content_get_gallery( $content );
            if (isset($gallery[0])) {
                $gallery = $gallery[0];

                if (isset($gallery['shortcode'])) {
                    echo do_shortcode($gallery['shortcode']);
                }
            }
        ?>
    </div>

    <header>
        <h4 class="entry-title"><?php echo get_the_title(); ?></h4>
        <span class="entry-categories"><?php the_category(', '); ?></span>
        <span class="entry-date"><span class="kopa-minus"></span><?php the_time( get_option( 'date_format' ) ) ?>, </span>
        <span class="entry-author"><?php esc_html_e('by', 'news-mix-lite'); ?> <?php the_author_posts_link(); ?></span>
        <span class="entry-comments"><?php echo News_Mix_Lite_Icon::getIcon('comment','span'); ?><?php comments_popup_link( '0 Comment', '1 Comment', '% Comments', 'comments-link', esc_html__( 'Comments Off', 'news-mix-lite')); ?></span>
        <?php if ( is_plugin_active( 'news-mix-toolkit/news-mix-toolkit.php' ) ) : ?>
            <span class="entry-view"><?php echo News_Mix_Lite_Icon::getIcon('view','span'); ?><?php echo news_mix_lite_get_view_count( get_the_ID() ); ?></span>
        <?php endif; ?>
    </header>

    <div class="clear"></div>

    <div class="elements-box mt-20">
        <?php
            the_content();
        ?>
    </div>

    <div class="wp-link-pages clearfix mt-20">
        <?php wp_link_pages(array(
            'before' => '<p>',
            'after'  => '</p>',
            'pagelink' => esc_html__( 'Page %', 'news-mix-lite' )
        )); ?>
    </div>

    <footer class="clearfix">
        <?php get_template_part( 'templates/post-navigation' ); ?>
    </footer>
    
</div><!--entry-box-->