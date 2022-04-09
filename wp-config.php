<?php

//Begin Really Simple SSL session cookie settings
@ini_set('session.cookie_httponly', true);
@ini_set('session.cookie_secure', true);
@ini_set('session.use_only_cookies', true);
//END Really Simple SSL
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
define( 'DB_NAME', 'nomisite_wp_vhh' );

/** MySQL database username */
define( 'DB_USER', 'nomisite_wp_vhh' );

/** MySQL database password */
define( 'DB_PASSWORD', '8xk5^2ltPRq4aL9~' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost:3306' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY', '1T3w~12j1~4;%w!:qpU!y2%3O01L!)*!n2s(iL0uPc*K@/sO26Oh8125u:3_69OL');
define('SECURE_AUTH_KEY', '%9A*DwF9DX0[X+3&uG2Wm/n63!s0SHBc4:gUDvS0j[OWOL/A:|y9-V44xfi94HY&');
define('LOGGED_IN_KEY', 'o&5m7G*hJZN8)4JR[10NHVrZ::puRZTkhVb5l6_y2#9(Qh%h&#(1#45%oU[e(s6o');
define('NONCE_KEY', '7~7!)288[6HFF[6GkqbK~uWpJd9RJ07(99#70y0x/]001o43b27I%5RP7RER7+_8');
define('AUTH_SALT', '161031BS35n|%&6bC42lHK/-rNPr698N7t9)D!x/V;ez9QdCB1L#)]6(E%%;Lqn@');
define('SECURE_AUTH_SALT', 'om*W5V!XAus1qq6s0KJ93QSr|I4|-%2X6[jS2~[#NIB3K]35DAUcR])581pI504X');
define('LOGGED_IN_SALT', 'o]Q2_ZJVp7N4(t:N1x0zJJ-O!(oL1m6~l/8/ggZtv&do3%-)975RGs32Pi521%%C');
define('NONCE_SALT', 'Z6P9ICe4Q)]LB3qen_R!cxnQ|E3bf%kGR;1+1n)4Z81uX])*12!#+#9f#Mrg#x8v');

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_vhh';


define('WP_ALLOW_MULTISITE', true);
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
