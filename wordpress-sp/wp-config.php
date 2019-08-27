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
define( 'DB_NAME', 'wordpress-sp' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

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
define( 'AUTH_KEY',         ':6zjTRa/>is%lsougLcFuh~Y[lsUGQchFNP%Rn_mVtqZ;A}RCTwouD>EA=[1P-Mm' );
define( 'SECURE_AUTH_KEY',  'G|BI1EdBvikGh4$Io`%)}V8K*m ,}iPZ44^ qN1VOyYw5C!-J?G!VN_W{Iu[+ayN' );
define( 'LOGGED_IN_KEY',    'zK%Yw,_9`o;rf&Tj!Z^ *z7fH#F`6Z3>4nNV]$F~VFtaroKTmQp/mz[R|=R*X_+l' );
define( 'NONCE_KEY',        '{+Do4-[#rw0`uxQ{M4Om9dxx=O/A_IRPMwoTJM#}K=>X[fJGzx{j=QxkTVrGdve ' );
define( 'AUTH_SALT',        'N`Jy8aXj-j ^RUt6k4E/+,|[OyWwI.^(4A>eP1~/C=j|!ljc-dS]K#5LKkn#0xR|' );
define( 'SECURE_AUTH_SALT', 'e#/k!XHr##d.,3N?xht5K3,N?$7~&uQ-`&tvv^emGfQ*B03iTj8MaOgL2HmWDH$g' );
define( 'LOGGED_IN_SALT',   '&k>%b[UFOu&sojpK_6ZR]M52vz|%{%-nU445{}st4ru6JIoePf8/Nq38WpDS (C{' );
define( 'NONCE_SALT',       '+I*|e56hH)^ *<*Qhtxl<qBgxu>TCFTQ^g4,<&W|/{*,1Z f7>`E%QdhKjJ)gi12' );

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
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
