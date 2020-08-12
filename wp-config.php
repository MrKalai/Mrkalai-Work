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
define( 'DB_NAME', 'work_db' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

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
define( 'AUTH_KEY',         'B7S=k%I67Gf;*bzv5{IF.>;RQrsdD~?!Sq6&?x.BkW]:ibA0xC_]~W|9 ,W(<Y1/' );
define( 'SECURE_AUTH_KEY',  '<tqZePI~`L#IY*3Cxb_=q13!pkoD5pQ_6[0gT%)Q<WV+QWVm_]DHhRDMBCA]*d_6' );
define( 'LOGGED_IN_KEY',    'm{,Pc~|P;Be$,3@#;]?D*I?T9(B!}b+&`&@K h,X*dgg8,%7DAS|/#7z;:i7?m7~' );
define( 'NONCE_KEY',        'R|v-!DQ:5HQKl;}j/qH>$nm5X4CM5|4A$c_=Ig68eJ2 cbL5ed:I2zeG5J5N1!PP' );
define( 'AUTH_SALT',        '~9_nu&>`G=|a+7Xb+JI#(*L9zx~WiZl#zLPoNngW_YaJ5U*Vz7UzO3nvbJ?`G*+h' );
define( 'SECURE_AUTH_SALT', ' F`(_L2 S9u`T7$q~F7a.8$?E=_M*&/|I*3c:~QZ)<>->s}y`a*8UBH~AA@wTK,L' );
define( 'LOGGED_IN_SALT',   'n#2;V?={pl#!LiyRCkf]nHvkWplPW:^qLKlrFrZ?Ge:BfQ2swE4X@040J1.XH!G5' );
define( 'NONCE_SALT',       '),bEFDE.(WNXuqOoh&fW5;F|^uP?uVTn9hZB:*|`6!x[j+7QJFOWv#=2V(6ASH!(' );

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
