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
define('DB_NAME', 'wordpress');

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
define('AUTH_KEY',         'I@D$*%W`gh6 nQ|-36]H7!;UQHV%=gOYpsV0e{r#t@%_){ekT[5c=-&,WFr=nogw');
define('SECURE_AUTH_KEY',  'FB{tVu/vLu?FZ3#YBsN4Wh`MRZ}xAb@9j+fF-kXhACug%Nm&_DSJ|~:H=eTBt@oc');
define('LOGGED_IN_KEY',    'l9Co()+%xze=*fRYT~t._WPshk-;:0|Zr@50R+L}IuK3]n(#emu7G^=2X#*Vs7YZ');
define('NONCE_KEY',        'FZ99Pd;Xp-hk|1?B6$5O,2G~>v6s]d!bJ+:NEd`in.%a%/]9cD:o=JRnGs,xu7<^');
define('AUTH_SALT',        'Lj4k]vt!Q(R.<2n_r<BoK,U3_1x>CU12,1lX.tf,v3!6^e;g5A=TE&@@p%aKRoP8');
define('SECURE_AUTH_SALT', '.:1(Em5Sk5|<FwUjy=;V2.r%??yqu&9s`f1Kn_Uuyi6Jz*6A;lGQ.TOJ6!f`cC$g');
define('LOGGED_IN_SALT',   't77^u.)VAjRQ|dJbH)Ou>-kci?sf;8t]~9H:bJ~zXB_,nsV|YG*zn8BOeuzu&i+t');
define('NONCE_SALT',       'Ky_=6}DBdG&z6l+Dd>z*4IO@2xG9t!b4]SQ2_@Z[vMw7_cCbvOqN^plm#gltqD1R');

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
