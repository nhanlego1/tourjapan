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
define('WP_MEMORY_LIMIT', '256MB');
define('DB_NAME', 'tourjapan');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

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
define('AUTH_KEY',         'L0z%DwAl!o>E&^g2:;?(h%_kA{ZEv+qL0AQP1U]Q|67?zCg0IsZ=]t%*&ab[X8PB');
define('SECURE_AUTH_KEY',  'dJuk_@b?j+HlebD(!(/q}yUf@!vBZBXtUQr.SUaV-^rxK)b?|V~niMhE,J2y.aM$');
define('LOGGED_IN_KEY',    'CyUZqn]Moe~J-cNwyO8Izv[^7(bpg~L&oY>Y`?c+5x*AgL,;I^U&;kOXLX|bEN.q');
define('NONCE_KEY',        'Tf--n79omKN1*Z>Ur-U?~FgBkB|vd]y4[}8d.t%YI!%%y#(E84( sYTlFQoB6jvr');
define('AUTH_SALT',        '?;@)f$bPb78twjX;!otRhlW^fhmGN.B9r,zXrSwS1~{3x6Q/Ye#vSf`~#Eh_orF0');
define('SECURE_AUTH_SALT', 'GHs,lq^>y5GXM|mXzr|0R_S9yxRFnJs!uBv{<x[0+4gVA[9M,7lFl<lXA|cO,%0y');
define('LOGGED_IN_SALT',   'KA-[SEMu`:VQCUgo`+/-xS0N*xzXUme!uT@7q7JU)>/Qm6__sF{-rUN?VnpRr4gY');
define('NONCE_SALT',       'u4 p%r((pgB6@X}A>5mOy+A9*q/A1q[1?.fXL~p?e>:&yccd!x|uT({,cb>:;M]C');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'tour_';

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
