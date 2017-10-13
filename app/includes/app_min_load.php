<?
$base_dir = dirname(dirname(dirname(__FILE__)));
$_app = new stdClass();


require_once $base_dir."/app/core/tools.php";

require_once $base_dir."/app/modele/Config.php";

Config::set_config_base();

require_once $base_dir."/app/core/sql_core/create_sql.php";
require_once $base_dir."/app/core/sql_core/check_sql.php";
require_once $base_dir.'/app/core/load_class.php'; 


require_once $base_dir."/app/includes/navigation.php";

$_app->navigation = new navigation();


start_exec_page_timer();

//mise en route de l'autoload

Autoloader::register(); 

$_app->sql = new all_query();