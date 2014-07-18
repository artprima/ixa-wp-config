<?php
/**
 * The base configurations of the WordPress.
 *
 *      - Table Prefix,
 *      - Secret Keys,
 *      - WordPress Language
 *      - ABSPATH
 *
 * You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. {@link http://generatewp.com/wp-config/} and GenerateWp
 *
 * Besides the regular instalation of WordPress, and in order to be portable, the following configurations are highly recommended:
 *      - WP_SITE_URL
 *      - WP_CONTENT_DIR
 *      - WP_CONTENT_URL
 *      - Convenient Varaibles
 */
use Ixa\WordPress\Configuration\Config;

require_once '../vendor/autoload.php';


// Loading Environment Variables
$config = new Config(dirname(__FILE__) . '/../config');
$config->load();
$configLoader = $config->getLoader('environment');
$params = $configLoader->getParams();

// var_dump(ENVIRONMENT);
// exit();
/**
 * Default theme is ixa-starter
 */
if (!empty($params['parent_theme'])) {
    define('TEMPLATEPATH', dirname(__FILE__) . '/wp-content/themes/'.$params['parent_theme']);
}

if (!empty($params['default_theme'])) {
    define('WP_DEFAULT_THEME', $params['default_theme']);
}

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', $configLoader->getParam('db_name', 'wordpress'));

/** MySQL database username */
define('DB_USER', $configLoader->getParam('db_user'), 'root');

/** MySQL database password */
define('DB_PASSWORD', $configLoader->getParam('db_password', ''));

/** MySQL hostname */
define('DB_HOST', $configLoader->getParam('db_host', 'localhost'));

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', $configLoader->getParam('db_charset', 'utf8'));

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', $configLoader->getParam('db_collate', ''));


/**#@
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',           $configLoader->getParam('auth_key', 'put your unique phrase here'));
define('SECURE_AUTH_KEY',    $configLoader->getParam('secure_auth_key', 'put your unique phrase here'));
define('LOGGED_IN_KEY',      $configLoader->getParam('logged_in_key', 'put your unique phrase here'));
define('NONCE_KEY',          $configLoader->getParam('nonce_key', 'put your unique phrase here'));
define('AUTH_SALT',          $configLoader->getParam('auth_salt', 'put your unique phrase here'));
define('SECURE_AUTH_SALT',   $configLoader->getParam('secure_auth_salt', 'put your unique phrase here'));
define('LOGGED_IN_SALT',     $configLoader->getParam('logged_in_salt', 'put your unique phrase here'));
define('NONCE_SALT',         $configLoader->getParam('nonce_salt', 'put your unique phrase here'));

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = $configLoader->getParam('table_prefix', 'wp_');

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', $configLoader->getParam('wplang', ''));

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', $configLoader->getParam('wp_debug', false));


/**
 * Site URL
 * URL of WordPress instalation
 */
define('WP_HOME',  $configLoader->getParam('wp_home'));
define('WP_SITEURL',  $configLoader->getParam('wp_home'));


/**
 * Content Dir
 * Must be set in order to overwrite {wordpress-core}/wp-content
 * and must match:
 *
 *     "installer-paths": {
 *         "app/plugins/{$name}/": ["type:wordpress-plugin"]
 *      }
 *
 * in composer.json. Defaults to: app
 *
 * see: http://codex.wordpress.org/Determining_Plugin_and_Content_Directories
 * WP_CONTENT_DIR  // no trailing slash, full paths only
 * WP_CONTENT_URL  // full url
 */
define('WP_CONTENT_DIR', dirname(__FILE__) . '/wp-content');
define('WP_CONTENT_URL', WP_HOME . 'wp-content');


/** CONVENIENT CONSTANTS */


/**
 * Automatic Updates
 * more info: http://make.wordpress.org/core/2013/10/25/the-definitive-guide-to-disabling-auto-updates-in-wordpress-3-7/
 */

// Let's delegate dependency mangaement to Composer
define( 'AUTOMATIC_UPDATER_DISABLED', 'true' );

/**
 * PHP Memory
 */
// define( 'WP_MEMORY_LIMIT', '64M' );

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
    define('ABSPATH', dirname(__FILE__) . '/');

/* That's all, stop editing! Happy blogging. */
/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
