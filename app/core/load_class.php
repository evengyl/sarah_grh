<?
class Autoloader
{
    static function register()
    {
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }

    static function autoload($class)
    {
       
        if($class == "_db_connect") require __DIR__."../../modele/".$class.".class.php";

        else if($class == "router") require __DIR__."../../".$class.".php";

        else if($class == "core_router") require $class.".php";

        else if($class == "all_query") require "sql_core/".$class.".php";

        else if($class == "select") require "sql_core/".$class.".php";

        else if($class == "parser") require __DIR__."../../includes/".$class.".php";

        else if(strpos($class, "admin_") !== false) require __DIR__."../../controller/admin_tool/".$class.".php";
        
        else require __DIR__."../../controller/".$class.'.php';
    }
}?>