<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <?php get_template_part( 'templates/content/content-single', get_post_format() ); ?>

    <div class="tag-box">
        <?php the_tags('', ' '); ?>
    </div><!--tag-box-->
    
    <?php if ( get_theme_mod( 'news_mix_lite_options_post_about_author', 'show' ) == 'show' ) : ?>
        <div class="about-author clearfix">
            <h3><?php esc_html_e( 'Author', 'news-mix-lite' ); ?></h3>
            <div class="about-author-detail clearfix">
                <a class="avatar-thumb" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php echo get_avatar( get_the_author_meta( 'ID' ), 82 ); ?></a>                                
                <div class="author-content">
                    <header>                                
                        <a class="author-name" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author_meta( 'display_name' ); ?></a>                                        
                    </header>
                    <p><?php the_author_meta( 'description' ); ?></p>
                    <ul class="social-link clearfix">
                        <?php 
                        $author_facebook = esc_url( get_the_author_meta( 'facebook' ) );
                        $author_twitter  = esc_url( get_the_author_meta( 'twitter' ) );
                        $author_gplus    = esc_url( get_the_author_meta( 'google-plus' ) );
                        $author_flickr   = esc_url( get_the_author_meta( 'flickr' ) );
                        ?>
                        <?php if ( $author_facebook ) : ?>
                            <li><a href="<?php echo esc_url( $author_facebook ); ?>" rel="nofollow"><?php echo News_Mix_Lite_Icon::getIcon('facebook'); ?></a></li>
                        <?php endif; ?>
                        
                        <?php if ( $author_twitter ) : ?>
                            <li><a href="<?php echo esc_url( $author_twitter ); ?>" rel="nofollow"><?php echo News_Mix_Lite_Icon::getIcon('twitter'); ?></a></li>
                        <?php endif; ?>
                        
                        <?php if ( $author_gplus ) : ?>
                            <li><a href="<?php echo esc_url( $author_gplus ); ?>" rel="nofollow"><?php echo News_Mix_Lite_Icon::getIcon('google-plus'); ?></a></li>
                        <?php endif; ?>
                        
                        <?php if ( $author_flickr ) : ?>
                            <li><a href="<?php echo esc_url( $author_flickr ); ?>" rel="nofollow"><?php echo News_Mix_Lite_Icon::getIcon('flickr'); ?></a></li>
                        <?php endif; ?>
                    </ul>                                
                </div><!--author-content-->
            </div><!--about-author-detail-->
        </div><!--about-author-->
    <?php endif; ?>

    <?php news_mix_lite_get_related_articles(); ?>

    <?php if(comments_open()){ 
            comments_template();  
        } 
    ?>

<?php endwhile; else : ?>

<?php endif; ?>