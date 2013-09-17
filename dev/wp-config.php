<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'egsd_co_1');

/** MySQL database username */
define('DB_USER', 'egsdco1');

/** MySQL database password */
define('DB_PASSWORD', 'e?!GZANn');

/** MySQL hostname */
define('DB_HOST', 'mysql.egsd.co');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         '^v0uM71%0"aFkcnaB&JHz$I1l2fDBtZsZ4&4*$Y+ak6ad9ce"""^5_lQ#*S!PAP*');
define('SECURE_AUTH_KEY',  'q1lS?$np!gkTLn%RO82T&pourPJ:$|/B/Vb:o%4?Uz8TanabgEk#)Ojf|RVJKTFZ');
define('LOGGED_IN_KEY',    'zuiPI`f:^GA;Hv$LupEu#^TmNZ0lTen*RjTxCv|m:CgBoK47a*t&HCg^4L^L;tLi');
define('NONCE_KEY',        'iEuhhuTW+#6XeTc5YtXS9xy~MKQG+MAHcLN`ZjUGiK&u?YOD$0rQ:7;1Q/$#&;yE');
define('AUTH_SALT',        '|UonF&5#^Pg:$Cr"DJr1XU*C_J$|ZY$gsE:/u0w+3O6oqr)1cbz~BfL+I(u#`Tqx');
define('SECURE_AUTH_SALT', 'XOQ9zfq%IE%YW^)s3XoN~3_9O_pHj6Pasb%52XEq7yYy;a7zO/&BTl*8!#mrF)Hg');
define('LOGGED_IN_SALT',   '*7S_FKcDGC*cSJsWe9)b+/tJB29P0$1Bjj+6Zu~8/$s#I4hOksb%$N;u?vurRlR9');
define('NONCE_SALT',       'ECH8|oN^_V9~KvANTZ6ZmTx|2`V_f(/8k3W&pSwjTAjycKbwhut`x71eH0_1k2Ww');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_wp885d_';

/**
 * Limits total Post Revisions saved per Post/Page.
 * Change or comment this line out if you would like to increase or remove the limit.
 */
define('WP_POST_REVISIONS',  10);

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

