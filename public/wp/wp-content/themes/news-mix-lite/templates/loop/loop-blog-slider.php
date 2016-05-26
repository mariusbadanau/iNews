<?php 
$news_mix_lite_blog_slider_category_id = (int) get_theme_mod( 'news_mix_lite_options_blog_slider_category_id' );
$news_mix_lite_blog_slider_posts = new WP_Query( array(
    'cat' => $news_mix_lite_blog_slider_category_id
) );

if ( $news_mix_lite_blog_slider_posts->have_posts() ) : while ( $news_mix_lite_blog_slider_posts->have_posts() ) : $news_mix_lite_blog_slider_posts->the_post(); 
    
    if ( has_post_thumbnail() ) :
?>
        <li>
            <article class="entry-item">
                <a href="<?php the_permalink(); ?>"><img src="<?php echo news_mix_lite_get_image_src(get_the_ID(),'kopa-image-size-6'); ?>" alt="<?php echo get_the_title(); ?>"></a>
                <h3 class="flex-caption"><a href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a></h3>
            </article>
        </li>
<?php 
    endif; 
endwhile; endif;

wp_reset_postdata();