<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'wp40');

/** MySQL database username */
define('DB_USER', 'admin');

/** MySQL database password */
define('DB_PASSWORD', 'admin');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         '~M`A.gk@.n;ih5-3Ai%FjiTsH~=]e^+2m+6X*// Jg0j2|bNpoj0SpfK&g:3q-z>');
define('SECURE_AUTH_KEY',  'Et_jY1&2>JxyJ8{ O{/1H#:|LE_$YRQ5 YkyAIPn-$Q6X|I/^SVoO=O0VK7Sw*&C');
define('LOGGED_IN_KEY',    '3PrOP*4yZRf-/}LI|l*B_>83#,S8-Q|g+x{kRzu$-7XTyG@.jhM?y9GLv~LNgq3~');
define('NONCE_KEY',        'xY3xU!3 n|>O0$2?ftTJ]N3[a@-r|$Vo>/}=|?ee--_FXj<M/@C8acNr9CPQ3Ut.');
define('AUTH_SALT',        '<sEoaZ{:~D=-[|OEZBYBj!BhPytBgt* ((jY_c ~wg#Te[2UR6oAf_z*8*WMXzLZ');
define('SECURE_AUTH_SALT', '<4sJ!t+P]B3xe{:T_KVBUabS<h%{&).Qx]?W6_3$uh3*U>qLHb4}.$D`Q[~nt_JE');
define('LOGGED_IN_SALT',   '`:E>c?%+S$!*vA~|25Q+8#vA->GU%Le2pbv7R6:<wY[^n@d:T1gV+7eD*Is!Hwb*');
define('NONCE_SALT',       'ss)o+2>|w:h&SxL1 S/Db48;bk0mpw6XOI-N6A9V#+Cbx1I{t4k6!W@F1z~:[^Wh');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
