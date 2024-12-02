<?php
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
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

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
define( 'AUTH_KEY',          'mL=olQKHf]8gM0@A({utO*,WwpKxf)We8#I@Tr,Q]>>MFLO_fC,T^F5>QZ^yJUF&' );
define( 'SECURE_AUTH_KEY',   'S7obQ<<3UO%%*]Fnk<y]$HEPr.[L6ChdkGaZqwMM4!.R~[YQEZxb$yegmUL6wRw$' );
define( 'LOGGED_IN_KEY',     'tZk7JPgR6n;_rrNBNV-?!o-4)}S{TZ*A?)w*fz0a#>(rMD2{2!]_[)2k`qQe KTs' );
define( 'NONCE_KEY',         '[`.N(hDJ}`T].a/oyqxUC)T19df1!UVZ8((RWj9SmzEf1Dat/B-G&}btYOWpL+E$' );
define( 'AUTH_SALT',         'tHP0k!= 86)*@K~7`V5!?WpV4sF&U~/OJG!<i<?Byc4(m~PuZ2P8`i`,]|YvGQ(L' );
define( 'SECURE_AUTH_SALT',  '2?|m=w8#sXxn#]]wccJ970.~u!dm/]t#K|;{jgVl-j&+p{>ijk!aC>G^5f+}gX#}' );
define( 'LOGGED_IN_SALT',    '9-Dn2NRk5HAnlRj DEH_9} ~HiM]x,}]o0VY5hb8x8@K -zDn$c}{$!E{x=Tpc-S' );
define( 'NONCE_SALT',        '35w1&4]|o3-Q2*1u7kf4mSWz@GI=sY3(0JqJe6Nl&to~9U~]+-gp`j]x6bx4M(1A' );
define( 'WP_CACHE_KEY_SALT', 'I +f-96z-l(o3ti4!!Ge:>gjToDVUFv(X`X>LFx{bf]{~.QQSq$O{p~jn4c,R_zE' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



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
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
