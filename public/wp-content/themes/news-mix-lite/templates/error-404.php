<?php news_mix_lite_breadcrumb(); ?>

<div class="row-fluid">
    <div class="span12">
        <section class="error-404 clearfix">
            <div class="left-col">
                <p><?php esc_html_e( '404', 'news-mix-lite' ); ?></p>
            </div><!--left-col-->
            <div class="right-col">
                <h1><?php esc_html_e( 'Page not found...', 'news-mix-lite' ); ?></h1>
                <p><?php esc_html_e( "We're sorry, but we can't find the page you were looking for. It's probably some thing we've done wrong but now we know about it we'll try to fix it. In the meantime, try one of this options:", 'news-mix-lite' ); ?></p>
                <ul class="arrow-list">
                    <?php if ( isset( $_SERVER['HTTP_REFERER'] ) ) : ?>
                        <li><a href="<?php echo esc_url( $_SERVER['HTTP_REFERER'] ); ?>"><?php esc_html_e( 'Go back to previous page', 'news-mix-lite' ); ?></a></li>
                    <?php endif; ?>
                    <li><a href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e( 'Go to homepage', 'news-mix-lite' ); ?></a></li>
                </ul>
            </div><!--right-col-->
        </section><!--error-404-->
    </div><!--span12-->
</div><!--row-fluid-->