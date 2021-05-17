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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'site_wp' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'greta' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'R%5Ee0xv%m[}2JXvmZ?k;u=A:*-<0Z?>fSd^{^.[ioGC2tM_?t8Xr^QT=tW0pRG<' );
define( 'SECURE_AUTH_KEY',  'Coi%LOG]Bm9`[=?P4L.W-(&$C7b>it{`D5v~qBOh(q6]}=EpE.:YQS.bZL1!*xvw' );
define( 'LOGGED_IN_KEY',    'SJL4 )`6?}W*`|+xcxY`/!ih1! sk2&5s!m$VHnP;:$$d+m9>6idtB&@9Y3_rWf3' );
define( 'NONCE_KEY',        '?e(<;{,!Ql $mM%bRf?2:Zn_MR*^)A>u<CyCo27; jaw.^Y-JSyH~f3=9fu(zfId' );
define( 'AUTH_SALT',        '53}?Ld%.dz%TdXj#] ktI<LB|&sc2_KQ&6`td{O~a}4mJFz[83lG5w3-Ddy5BGcC' );
define( 'SECURE_AUTH_SALT', 'X=9Hb?u9~:sb&Bgv1MvPtg!o2k698M_MJvDG2(cLyf^Zr`9fD%38VQ:O`3~{TI)G' );
define( 'LOGGED_IN_SALT',   '}+GN#NslBA~]%i{Y3!l*@D:jo]6F(~9XY4>z!d(Rz4VQ$I1a#r4 XC2Jo7ro:ktb' );
define( 'NONCE_SALT',       'rWS!^n5C.gtU[psuwKIWI{X)c?{6a|8|9@Sr@12Y,eO|frspD^1kmI@$1INO o9I' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
