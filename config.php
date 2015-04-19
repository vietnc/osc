<?php

/**
 * The base MySQL settings of Osclass
 */
define('MULTISITE', 0);

/** MySQL database name for Osclass */
define('DB_NAME', 'osc');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Table prefix */
define('DB_TABLE_PREFIX', 'oc_');

define('REL_WEB_URL', '/osc/');

define('WEB_PATH', 'http://localhost:8080/osc/');

#cache
define('OSC_CACHE', 'memcache');
$_cache_config[] = array(
   'default_host'      => '127.0.0.1',
   'default_port'      => 11211,
   'default_weight'    => 1
);
?>