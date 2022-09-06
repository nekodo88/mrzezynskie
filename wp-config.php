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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'mrzezynskie' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

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
define( 'AUTH_KEY',         '&>,Oi%,H,FI`}pv-)V|,}>>~TGQ<G}+2Vr`+sJ8l0n8]-HR|{-9a5j(2*Lp[{xt<' );
define( 'SECURE_AUTH_KEY',  'LGd7V;D{K ~+Vd2bG6nWzN~c*T&J<Op3cLmXLP*Oo,kYXBaY<ctUl%O `i(`N+YL' );
define( 'LOGGED_IN_KEY',    'KjpUS#iM`f0T^M.(Eqj@2Fj}d:7+F@k0;R2+eG3]HZK.H3A(iWX0t:4npX%2`6? ' );
define( 'NONCE_KEY',        'd,;qjSN`tB_k_J_SQIPc<K-tqSjL[]tgsAXWsm7u>-7UjhPYbCP%a6!*2ff$rN&V' );
define( 'AUTH_SALT',        'OxQ%CWTu[.U0Q+8&s8?&li9r>=-uL{)Z.vb7^NztBVau8h}8lWOMaN{IlYhjex|M' );
define( 'SECURE_AUTH_SALT', 'W_7e,1L7{Y|Gn0g=aO{.oR>`Fr%&r2eP1fmdsB?!xlTU:y+}4z^i:>1*C)(lZU N' );
define( 'LOGGED_IN_SALT',   '1amlLU>FZzu>mKz7S>Tc.Iz`?C|HvtfMf-W7t|Q0f@}jH.W9zxP z,C)6D](.X;c' );
define( 'NONCE_SALT',       '^xn~WG(`D<xJ32dA]P8UFgoJ5z^ELG7IA(~?qc/RI&I~e!SO)DpG|1:;c/M*F:Rc' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_beer';

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



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
