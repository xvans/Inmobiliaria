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
define('DB_NAME', 'wp');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

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
define('AUTH_KEY',         'kr7;iC,Obc{3iz)VMnP}J9:bV tjg79DCi4V*jQ_KwRZO~lswM^q9%B(,?tohLs?');
define('SECURE_AUTH_KEY',  'c,;PYK2M~G8y:`hvg5y:xt3UZ{xt5#|O3aGg~#MBCM4%!&K<BS-))(8&r%dU08;;');
define('LOGGED_IN_KEY',    '4U,<:R)BNM51S|i)|WxBqYZesZ8?KR=r:_MwT[`^o];O!)jC/.>FwR8wkr TTn&S');
define('NONCE_KEY',        '7$u;o[5hP+I-1~Q[C[4ruq=6jc,TmTbSUg*sddv.vQ vB6>VfG 8(O:B~LugRfoQ');
define('AUTH_SALT',        'Xt#+u}NKotrT__mS2C*Z5/NFIl<6(qFF]Kve6^A-lTy9(]pa@-+d*]<7Iq<$Dhjg');
define('SECURE_AUTH_SALT', 'L}?EE4W.V51<|tC u[%}S%?c*e![BNS|B~#brqj~Z4ZUa5,h2lh)@Q<Nw@|aep#>');
define('LOGGED_IN_SALT',   '5kNqg_ZD;Yab-S{NP@K`1>I:,51l|~[$ye6~vjpM,Rwwe(N}J:NjS`<w4H#>=m.,');
define('NONCE_SALT',       '`Y^S`]$Vso^X5L3*G%w8+#=LH}b+<4=sYekX7w^yk-:;CLq}d5 4R[y}];cxqUPr');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
