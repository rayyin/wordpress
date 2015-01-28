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
define('DB_NAME', 'wordpress_git');

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
define('AUTH_KEY',         '%>|;5:SOg>7J;apq4Quwz;wtOLXPgA|)EPW~`9WJfH`e??r;S%JHa|;8yV)fIoD}');
define('SECURE_AUTH_KEY',  ')N6^q0^@(uM`6c.mFX{g&-5ZU/ZD,e0>@ak-JgWicw];daeJ]w(?(%)?$OY>dJs:');
define('LOGGED_IN_KEY',    '[ql<te=`o{q/+#1d6LiI}+S=^Cy`7twlX=<q$]mOkU;urR&~D^Aw0nPvfcQmP;+U');
define('NONCE_KEY',        '-Q.+`[rb)HL,r{}&;-31[im#f%Q5^^@sFBG[C.WN9:C:1p5O).+G2aA^*+}c%,xW');
define('AUTH_SALT',        'dL` hj5:^z(q8|_*>6&skDQVy|rGKm~AX;GCQ+,Z`$!Az@Akem`}8GL5QZ~|C8; ');
define('SECURE_AUTH_SALT', 'xpz!]YZK<%4~3erHm(wk*?|i|b+Lp~v+|S#89wtlv}RZI=p>|3{m9x?!^Y|rnadT');
define('LOGGED_IN_SALT',   'H+EAHtBqG$UmI8Tq!b{e! ;GvG|Tw{K*~P oyBPV^- m+fZHZ{:4-XaU}T<1ez2;');
define('NONCE_SALT',       'j{FJ_v;j2tz?q}39]t[UF+pkjkD|g2usJ<yC,TA8eU|GH{r6pWr:J_z8[Vcl[J]p');

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
define('WP_DEBUG', true);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
