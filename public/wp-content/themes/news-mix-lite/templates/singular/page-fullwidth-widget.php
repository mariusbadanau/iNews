<?php 
$sb_17 = apply_filters('news_mix_lite_get_sidebar', 'sidebar_17', 'pos_sidebar_17');
?>

<?php news_mix_lite_breadcrumb(); ?>

<div class="row-fluid">
    <div class="span12">
        <div class="widget-area-12">
            <?php 
		    	if ( is_active_sidebar( $sb_17 ) ) {
			        dynamic_sidebar( $sb_17 );
			    } 
		    ?>
        </div>
    </div>
</div>    

<div class="clear"></div>

<?php get_footer(); ?>