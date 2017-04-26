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
define('DB_NAME', 'wp_swo');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

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
define('AUTH_KEY',         'ca|/]QzMb6M?O35Jm Vf ^)j7VPLw!qut0!j:gfUMN*0ZA ?YP$&Z1Cj,-{fS%8<');
define('SECURE_AUTH_KEY',  '[):N-G(h!gFTdEOPYL-!ZRiS7~QVZ$T5H/eGD}HZX*{vAVRee {/6e??qY[:n]w(');
define('LOGGED_IN_KEY',    'Un-1 (u)E2qVN.24N@|p4G> Vb6U3Im[.N=DGEyV#llYD5CA| WBL[2MyEz<Fo!j');
define('NONCE_KEY',        '|zK.b|`p3^:(U/Ah$[`8z/#,DG7Bp<Bg$xcm?8xjV87C{9}$Mq-/3]u~iBE}p)b4');
define('AUTH_SALT',        ':EBl&p7RuFFms}q>|6X3J}9H6ufH(~{#w}!$&_T,ssqs?![`>=A8M;p%mzZ1gF?U');
define('SECURE_AUTH_SALT', 'fOvdr@C>K7YD8 ]7D[j }  NET@mx{{4Qf5)Au}a%zbtx;ah,Lo3 $Bj#mp@:-n5');
define('LOGGED_IN_SALT',   '4m8:Id*=*m}47TS<NNp<Zh@Lcr;Up<up!-[x;(N[;@#PC^<DA<c,_wuDbq6 |Myu');
define('NONCE_SALT',       'S-WOYlBi8c|JdoGI}OnjZko;Mr#}U)T6(|??sW<y:Gdo3eZzG-=q=U>s~,7@EAYf');

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
