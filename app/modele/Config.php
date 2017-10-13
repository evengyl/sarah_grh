<?php

class Config
{
    public static $hote = "localhost";
    public static $user = "root";
    public static $Mpass = "darkevengyl";
    
    public static $base_path = "/sarah_grh";


    public static $prefix_sql = "";
    public static $base = "";
    public static $path_public = "";
    public static $mail = "";
    public static $footer_text = "";
    public static $name_website = "";
    public static $name_head_nav = "";


    public static $view_time_executed_in_footer_page = false;
    public static $view_sql_list = false;
    public static $time_start_exec = 0;

    public static $is_connect = 0;
    public static $list_req_sql = array();

    public static $view_tpl_in_source_code = 1;


    public static function set_name_base($base)
    {
        self::$base = $base;
    }

    public static function set_config_base()
    {
        $_config = file_get_contents('Config.conf', 'r');

        $_config = json_decode($_config);
        foreach($_config as $row_config_key => $row_config_values)
        {
            self::${$row_config_key} = $row_config_values;
        }
        self::$base = dirname(dirname(dirname(__FILE__)));
    }

    public static function get_config_base()
    {
        $_config = file_get_contents('../app/modele/Config.conf');

        return json_decode($_config);
    }

    public static function push_config_base($_get_config_to_push)
    {
        $_get_config_to_push = json_encode($_get_config_to_push);
        file_put_contents('../app/modele/Config.conf', $_get_config_to_push);
    }

    public static function set_list_req_sql($req_sql)
    {
            self::$list_req_sql[] = $req_sql;    
    }
    public static function get_sql_list()
    {
        if(self::$view_sql_list)
            affiche_pre(self::$list_req_sql);
    }

}
