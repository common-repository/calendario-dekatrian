<?php
/**
* Plugin Name: Calendário Dekatrian
* Plugin URI: http://dekatrian.com
* Version: 0.1.2
* Author: Dekatrian
* Author uri: http://dekatrian.com
* Description: Altere as datas do seu Wordpress para o Calendário Dekatrian
**/

if (!defined('ABSPATH')) exit;

define('DEKATRIAN_VERSION', '0.1.2');

define('DEKATRIAN_FILE', __FILE__ );
define('DEKATRIAN_BASENAME', plugin_basename( DEKATRIAN_FILE ));
define('DEKATRIAN_DIR', dirname( DEKATRIAN_FILE ));
define('DEKATRIAN_PATH', plugin_dir_path(__FILE__));
define('DEKATRIAN_URL', plugin_dir_url(__FILE__));

define('DKT_ADMIN_INC',    DEKATRIAN_DIR . '/admin');
define('DKT_FRONT_INC',    DEKATRIAN_DIR . '/frontend');
define('DKT_INC',          DEKATRIAN_DIR . '/include');
define('DKT_INSTALL_INC',  DEKATRIAN_DIR . '/install');
define('DKT_MODULES_INC',  DEKATRIAN_DIR . '/modules');
define('DKT_SETTINGS_INC', DEKATRIAN_DIR . '/settings');

require_once DKT_INC . '/DekatrianDate.php';
require_once DKT_INC . '/Dekatrian.php';