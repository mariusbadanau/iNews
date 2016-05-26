<?php 
$prev_post = get_previous_post(); 
if ( ! empty( $prev_post ) ) :
?>
    <p class="prev-post">
        <a href="<?php echo esc_url( get_permalink( $prev_post->ID ) ); ?>">&laquo;&nbsp;<?php esc_html_e('Previous Article', 'news-mix-lite'); ?></a>
        <a class="article-title" href="<?php echo esc_url( get_permalink( $prev_post->ID ) ); ?>"><?php if( empty( $prev_post->post_title ) ) esc_html_e( 'No title' , 'news-mix-lite' ); else echo wp_kses_post( $prev_post->post_title ); ?></a>
    </p>
<?php endif; ?>

<?php
$next_post = get_next_post();
if ( ! empty( $next_post ) ) : 
?>
    <p class="next-post">
        <a href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>"><?php esc_html_e('Next Article', 'news-mix-lite'); ?>&nbsp;&raquo;</a>
        <a class="article-title" href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>"><?php if( empty( $next_post->post_title ) ) esc_html_e( 'No title' , 'news-mix-lite' ); else echo wp_kses_post( $next_post->post_title ); ?></a>
    </p>
<?php endif; ?>