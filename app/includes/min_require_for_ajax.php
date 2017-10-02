<?
include '../../core/tools.php';
include '../../modele/Config.php';
include '../../modele/_db_connect.class.php';
include '../../core/sql_core/all_query.php';
include '../../core/sql_core/select.php';

Config::set_config_base();
$_db_connect = new _db_connect();
$sql = new all_query();