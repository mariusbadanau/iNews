<?php $news_mix_lite_post_thumbnail_style = get_theme_mod('news_mix_lite_options_post_thumbnail_style', 'large'); ?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        
    <?php if ( has_post_thumbnail() ) : ?>
        <div class="entry-thumb">
            <?php // switch between two post thumbnail styles 
            if ( $news_mix_lite_post_thumbnail_style == 'small' ) {
                $news_mix_lite_post_thumbnail_size = 'kopa-image-size-4'; // 207x191;
            } else {
                $news_mix_lite_post_thumbnail_size = 'kopa-image-size-6'; // 665x363
            }
            ?>
            <img src="<?php echo news_mix_lite_get_image_src(get_the_ID(), $news_mix_lite_post_thumbnail_size ); ?>" alt="<?php echo get_the_title(); ?>">
            <?php if ( $news_mix_lite_post_thumbnail_style == 'small' ) : ?>
                <div class="meta-box">
                    <span class="entry-comments"><?php echo News_Mix_Lite_Icon::getIcon('comment','span'); ?><?php comments_popup_link( '0 Comment', '1 Comment', '% Comments', 'comments-link', esc_html__( 'Comments Off', 'news-mix-lite')); ?></span>
                    <?php if ( is_plugin_active( 'news-mix-toolkit/news-mix-toolkit.php' ) ) : ?>
                        <span class="entry-view"><?php echo News_Mix_Lite_Icon::getIcon('view','span'); ?><?php echo news_mix_lite_get_view_count( get_the_ID() ); ?></span>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <header>
        <h4 class="entry-title"><?php echo get_the_title(); ?></h4>
        <span class="entry-categories"><?php the_category(', '); ?></span>
        <span class="entry-date"><span class="kopa-minus"></span><?php the_time( get_option( 'date_format' ) ) ?>, </span>
        <span class="entry-author"><?php esc_html_e('by', 'news-mix-lite'); ?> <?php the_author_posts_link(); ?></span>

        <?php if ( $news_mix_lite_post_thumbnail_style == 'large' ) : ?>

            <span class="entry-comments"><?php echo News_Mix_Lite_Icon::getIcon('comment','span'); ?><?php comments_popup_link( '0 Comment', '1 Comment', '% Comments', 'comments-link', esc_html__( 'Comments Off', 'news-mix-lite')); ?></span>
            <?php if ( is_plugin_active( 'news-mix-toolkit/news-mix-toolkit.php' ) ) : ?>
                <span class="entry-view"><?php echo News_Mix_Lite_Icon::getIcon('view','span'); ?><?php echo news_mix_lite_get_view_count( get_the_ID() ); ?></span>
            <?php endif; ?>

        <?php endif; ?>
    </header>

    <div class="elements-box mt-20">
        <?php the_content(); ?>
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