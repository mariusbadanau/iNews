<?php if ( have_posts() ) : while( have_posts() ) : the_post(); ?>

    <li id="li-post-<?php the_ID(); ?>">
            <article id="post-<?php the_ID(); ?>" <?php post_class('entry-item clearfix'); ?>>
            <div class="entry-thumb">
                <?php if ( has_post_thumbnail() ) : ?>
                    <a href="<?php the_permalink(); ?>">
                        <img src="<?php echo news_mix_lite_get_image_src(get_the_ID(),'kopa-image-size-4'); // 53x53 ?>" alt="<?php echo get_the_title(); ?>">
                    </a>
                    <div class="meta-box">
                        <span class="entry-comments"><?php echo News_Mix_Lite_Icon::getIcon('comment','span'); ?><?php comments_popup_link( '0 Comment', '1 Comment', '% Comments', 'comments-link', esc_html__( 'Comments Off', 'news-mix-lite')); ?></span>

                       <?php 
                       include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
                       if ( is_plugin_active( 'news-mix-toolkit/news-mix-toolkit.php' ) ) : ?>
                            <span class="entry-view"><?php echo News_Mix_Lite_Icon::getIcon('view','span'); ?><?php echo news_mix_lite_get_view_count( get_the_ID() ); ?></span>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="entry-content">
                <header>
                    <h4 class="entry-title"><a href="<?php the_permalink(); ?>">
                        <?php echo (is_search())? news_mix_lite_highlight_search_title(): get_the_title(); ?>
                        <?php if(is_sticky()) : ?>
                            <i class="fa fa-bolt"></i>
                        <?php endif; ?>
                    </a></h4>
                    <span class="entry-categories"><?php the_category(', '); ?></span>
                    <span class="entry-date"><span class="kopa-minus"></span><?php the_time( get_option( 'date_format' ) ); ?></span>
                    <span class="entry-author">, <?php esc_html_e( 'by', 'news-mix-lite' ); ?> <?php the_author_posts_link(); ?></span>
                </header>
                <?php echo (is_search())? news_mix_lite_highlight_search_excerpt(): get_the_excerpt(); ?>
            </div>
        </article>
    </li>

<?php endwhile; else : ?>
    <p><?php esc_html_e( 'Sorry, no posts matched your criteria.' , 'news-mix-lite'); ?></p>
    <?php get_search_form(); ?>

<?php endif; ?>