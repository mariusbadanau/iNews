<?php
#API
require get_template_directory() . '/api/TGMPluginActivation.class.php';

#FUNCTION
require get_template_directory() . '/inc/front.php';

#FEATURED
require get_template_directory() . '/inc/layout.php';
require get_template_directory() . '/inc/sidebar.php';


/*
 * Implement Custom Header features.
 */
require get_template_directory() . '/inc/options/custom-header.php';

#PLUGINS
require get_template_directory() . '/inc/plugin.php';

#ICONS
require get_template_directory() . '/inc/icon.class.php';

#CUSTOMIZE
require get_template_directory() . '/inc/lib/kopa-customization.php';
require get_template_directory() . '/inc/customize.php';

# CHECK ACTIVE PLUGIN
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );