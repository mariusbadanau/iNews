<?php
$sb_13 = apply_filters('news_mix_lite_get_sidebar', 'sidebar_13', 'pos_sidebar_13');
?>
<?php news_mix_lite_breadcrumb(); ?>

<?php
    if (!is_active_sidebar( $sb_13 )) {
        $classes = ' full-width';
    }else{
        $classes = '';
    }
?>
<div id="main-col<?php echo $classes; ?>">
    
    <?php get_template_part( 'templates/loop/loop', 'single' ); ?>
    
</div><!--main-col-->

<div class="widget-area-3 sidebar">
   
    <?php 
        if ( is_active_sidebar( $sb_13) ) {
            dynamic_sidebar( $sb_13 );
        } 
    ?>
    
</div><!--widget-area-3-->

<div class="clear"></div>