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
define('DB_NAME', 'newcare');

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
define('AUTH_KEY',         '>/XZ=f;kH^iUk1^EXRn:!._.S[%H|PpXuFw^NwHH7K1J%FxhG6ZvGd60oO#hittw');
define('SECURE_AUTH_KEY',  '0p$LAnj%NJI,9Q}fbW!_sH.ksi|,X:1n=;OduJ*hj&w+X_QDVDXjF8ToX5Q9}J+t');
define('LOGGED_IN_KEY',    'v7d^[)xdCNcNSpph+<9r(:q,M.D5Qx$u4 g&!3wU)8oz[%1#>b>^N<yV#~I|C|x.');
define('NONCE_KEY',        'F9^26YN~Oh!A?vX|VC@E3yivR4?L_ZM.H-T&<A<8.(AxoBzw/tSMav!bvuijI.9}');
define('AUTH_SALT',        '>15_*8D.T}dK!6P4yG8C5) eDU;IiA%RUr9,Y}:;ij8NS#R}@7QT9_rT20Vzfqec');
define('SECURE_AUTH_SALT', 'f 8^$a:@BP_3Nx(N15wf=#E]RV7Wq4?F/!smflW E)K23scJ3U(mn#|K9ubapi$j');
define('LOGGED_IN_SALT',   ' 4Fwn9$$p=./$ZB!#xj8.):(_C*UJ4`ObH#W97w}yd$uHJ%on-:61F8V*e4F@N#@');
define('NONCE_SALT',       'hW}yR]NC%jD6@m3Hp9U-p|sv~)RM`9UTL#U:u!d1db0m{WeHpfTJ6b<>uTKm3q<v');

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
