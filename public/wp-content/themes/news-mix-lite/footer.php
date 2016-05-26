                    </div>
                    <!--main-content-->

                    <div class="bottom-sidebar clearfix">

                        <div class="widget-area-13">
                            <div class="widget widget_text">
                                <div id="footer-logo">
                                    <?php $logo = get_theme_mod( 'news_mix_lite_options_logo_url', ''); if ($logo) : ?>
                                    <a href="<?php echo esc_url(home_url('/')); ?>"><img src="<?php echo esc_url( $logo ); ?>" alt="<?php bloginfo('name'); ?>"></a>
                                    <?php else : ?>
                                    <h1 id="footer-logo-title"><a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a></h1>
                                    <?php endif; ?>
                                </div>
                                <!--footer-logo-->
                                <div class="textwidget">
                                    <?php echo htmlspecialchars_decode(stripslashes(get_theme_mod( 'news_mix_lite_options_copyright'))); ?>
                                </div>
                            </div>
                            <!--widget-->
                        </div>
                        <!--widget-area-13-->

                        <div class="widget-area-14">
                            <?php if( get_theme_mod( 'news_mix_lite_options_footer_search_form', 'show')  == 'show') : ?>
                                <div class="widget kopa-search-widget">
                                    <h3 class="widget-title"><?php esc_html_e('Search', 'news-mix-lite'); ?></h3>
                                    <?php get_search_form(); ?>
                                </div>
                                <!--widget-->
                            <?php endif; ?>
                            <?php 
                                $news_mix_lite_custom_right_footer= get_theme_mod( 'news_mix_lite_options_right_footer'); 
                                if ($news_mix_lite_custom_right_footer) : 
                                    echo htmlspecialchars_decode(stripslashes(get_theme_mod( 'news_mix_lite_options_right_footer'))); 
                                endif; 
                            ?>
                        </div>
                        <!--widget-area-14-->

                        <div class="clear"></div>

                    </div>
                    <!--bottom-sidebar-->

                    <footer id="page-footer">
                        <?php if (has_nav_menu( 'footer-nav')) { wp_nav_menu(array( 'theme_location'=> 'footer-nav', 'container' => 'nav', 'container_id' => 'footer-nav', 'items_wrap' => '
                        <ul id="footer-menu" class="clearfix">%3$s</ul>', 'depth' => -1 )); } ?>
                    </footer>
                    <!--page-footer-->

                    <p id="back-top">
                        <a href="#top">
                            <?php esc_html_e( 'Back to Top', 'news-mix-lite'); ?>
                        </a>
                    </p>

                </div>
                <!--span12-->

            </div>
            <!--row-fluid-->

        </div>
        <!--wrapper-->
        <?php wp_footer(); ?>
    </body>

</html>