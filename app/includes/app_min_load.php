<?
$_app = new stdClass();

require_once "../app/core/tools.php";

require_once "../app/modele/Config.php";

Config::set_config_base();

require_once "../app/core/sql_core/create_sql.php";
require_once "../app/core/sql_core/check_sql.php";
require_once '../app/core/load_class.php'; 


require_once "../app/includes/navigation.php";

$_app->navigation = new navigation();


start_exec_page_timer();

//mise en route de l'autoload

Autoloader::register(); 

$_app->sql = new all_query();