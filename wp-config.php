<?php
define( 'WP_CACHE', true );
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'u783402573_Fgra6' );

/** Database username */
define( 'DB_USER', 'u783402573_58a0W' );

/** Database password */
define( 'DB_PASSWORD', 'Wh3FmmFbfc' );

/** Database hostname */
define( 'DB_HOST', '127.0.0.1' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',          '*y_BjCCZV4I+O$os 3kRlAG^l`{?nNDx(&[#Zfy@j$.8|%W:)r>@N::D:oh4-F!V' );
define( 'SECURE_AUTH_KEY',   'wTFlh}C+no<,A3|dIo00WhNbALiXZI:9aduY-XV1sm>bLo;=#24l<6CwOVxcQN_M' );
define( 'LOGGED_IN_KEY',     '1&I-RJDWp4(n?,:&1MC0Sg{!$jeQeE%>~Dkq`,9mfrJy_CEJ+[b<>.Hs2[Zb~@LI' );
define( 'NONCE_KEY',         'e>:lKo?hm4k@VN6Qn!0$xMIH(c(boXCu$(t`|<l6`UU>j1yhpj-~rBjW>wX=s-NY' );
define( 'AUTH_SALT',         'Uw<pPI%6:YGAhOxdtJZMSR$,tf.J#,qRwfk*Ps}cBi-3-dA][qs4;`gl q%nSivy' );
define( 'SECURE_AUTH_SALT',  'hI|s?BRCJVH/9Nd3;xZ;<gI~HY~w`_r9][kmIV{}R9,KBQ1Lkjub[+@f7~vFc8RO' );
define( 'LOGGED_IN_SALT',    '$pJEqO;HDLFu1q}<wlF;1NjQJvSrp}5TmalHEUj(}OVL}0,MN~~ChJy$ftxMW!d]' );
define( 'NONCE_SALT',        'n>264`>< ~`_j-o[-*)!{-K<^=1X0cy]Amd7,PA?a5W.DQD Vx%6$7UKp8TK2`*:' );
define( 'WP_CACHE_KEY_SALT', 'QroZqx6Y$`O> Vy&h6CMucA7;ul !sG=>Wh5?U2*F]dQyR/A4]7oDEl]rEqQc=^D' );


/**#@-*/

/**
 * WordPress database table prefix.
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


/* Add any custom values between this line and the "stop editing" line. */



define( 'FS_METHOD', 'direct' );
define( 'WP_AUTO_UPDATE_CORE', 'minor' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
