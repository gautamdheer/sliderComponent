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
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'sliderComponent' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

if ( !defined('WP_CLI') ) {
    define( 'WP_SITEURL', $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] );
    define( 'WP_HOME',    $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] );
}



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
define( 'AUTH_KEY',         '4e9bfe44w5Atg3dTShW3iyvHL8pEKH2utgUtt1qG928fXjuli9egH5HBP2GB5dr4' );
define( 'SECURE_AUTH_KEY',  'TEwMVZPFS0MpQLCTxYgtV1FGufzo6oSMICQukQFSJlk49wxjHum2DIRba8z0FX38' );
define( 'LOGGED_IN_KEY',    'n7NwPZuKBmgcaQcpMMWtNYLpcJmcZDImZakjrpCCkoi2jy5PRDI6D2KvA22d321E' );
define( 'NONCE_KEY',        'XTsxkzwGxcjnzOJpPdPXfrdzAMhkHHeQVECc9JkPURlg0D7PLcE4hMngYFWr0YwH' );
define( 'AUTH_SALT',        'ZhTxodlyddRULQw0blsCK9VHiJ8yKB7uEVLjlcJKxkGvPrpvNDGFHBFXNmxJS4rx' );
define( 'SECURE_AUTH_SALT', 'lYJfskCwqNlnF5E94xDYIzvoG3LAlxDnu4XAw56ScmesGStncAb3e4Pd5nlVtmdF' );
define( 'LOGGED_IN_SALT',   'UtYsjYMY1Zz2XOqt5AFUH8c5fjSE8SPleAzttvMQRUrprGF6ateI93OW5ptESIIb' );
define( 'NONCE_SALT',       'RVjvXn5Xf3wOucZjvvlis0Y2NemFjE41VWCyadMfyKSdcEnfoy48Zo5U1D3QvLPf' );

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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
