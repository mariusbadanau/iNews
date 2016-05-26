<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'project_wordpress');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'php');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '+ZNdb^/7ml^-fK4LVai0J~KCn#(P?oOl=jQXqT2~#[hlH(G[}i3}/|(ccx{ZnIvl');
define('SECURE_AUTH_KEY',  'Iy2!Q.xJ}|Frm!9#*95<{GAz+zGAqre/2@d[m0Er*;*<.0P_%{dP$Nyf%b*oO yN');
define('LOGGED_IN_KEY',    'Mh!+-I<A<2[sBcb6Dz`Ye].1a~v|O|Ti.U{N.in|a-z6;<j6oa@W`FbuEi=8DP/a');
define('NONCE_KEY',        '>)PC+qF{|!;F72/lciC-D=r8Q.[ob+>:R!+P|iqfU/J|hsLZ98W~R>Ha1)im{-1F');
define('AUTH_SALT',        '9Sennj2++xg#a^NkCEk0fk_z~yL-QvF+2DdkG=1rG0>K68v GZwYw57`IS~xAYT.');
define('SECURE_AUTH_SALT', '/;pfTlLBe.loB{lbD!s+OlTYA~LA04dRy-}.l|;g4%OOF m/amI-qc pVh9+pR!;');
define('LOGGED_IN_SALT',   'IV(??m82e}8]cxAL_|n:5cQ{yQ]f15V+qWg~bjge+-nxmlKy.V]m4^|a9`t3!p&L');
define('NONCE_SALT',       'U]2e9jB,!CLjBRw86@8SEWFAUG.`BXFM^Guv#1xWa-|hzKBtBhOO{RS=iUS6qGA:');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
