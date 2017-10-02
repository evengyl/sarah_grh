<?php
class parser
{
	private $module_tpl_name;
	private $rendu_module = "";
	private $stack_mod_tpl = "";
	public $_app;
	public $_view_tpl_in_source_code;

	public function __construct(&$_app)
	{
		$this->_view_tpl_in_source_code = (Config::$view_tpl_in_source_code == 1)? 1 : 0;
		$this->_app = &$_app;
	}
	public function parser_main($page)
	{
		if(!empty($page))
		{
			if(preg_match('/__TPL_[a-z_]+__/', $page, $match))
				$page = $this->parse_template($match[0], $page);

			else if(preg_match('/__MOD_[a-z_]+[(\"]*[a-zA-Z0-9_éèçàê= \']*[\")]*__/', $page, $match))
				$page = $this->parse_module($match[0], $page);
			else
			{

				if(preg_match('/__TPL2_[a-z_]+__/', $page, $match))
					$page = $this->parse_template($match[0], $page);

				else if(preg_match('/__MOD2_[a-z_]+[(\"]*[a-zA-Z0-9_éèçàê= \']*[\")]*__/', $page, $match))
					$page = $this->parse_module($match[0], $page);
			}
		}
		else
			$_SESSION['error'] = "Il y a un problème dans le parser Parser_main() la page n'est pas arrivée au parseur";


			return $page;

	}


	private function parse_template($match_template, $page)
	{
		$tpl_name = preg_replace(array("/__TPL[0-9]*_/", "/__/"), "", $match_template);

		if(strpos($tpl_name, "admin_") !== false)
			$path_template= '../vues/admin_tool/'.$tpl_name.'.php';
		else
			$path_template = '../vues/'.$tpl_name.'.php';
		
		return $this->exec_tpl($match_template, $page, $path_template, $tpl_name);
	}

	private function parse_module($match_module, $page)
	{
		$var_in_module_name = '';
		$this->_app->stack_module[] = $match_module;

		$module_name = preg_replace(array('/__[MOD]*[0-9]*_/', '/[(\"]+[a-zA-Z0-9_éèçàê \']*[\")]+/',  '/__/'), '', $match_module);
		if(preg_match('/[(\"]+([a-zA-Z0-9_éèçàê \']*)[\")]+/', $match_module, $match_var))
			$var_in_module_name = $match_var[1];

		return $this->exec_mod($match_module, $page, $module_name,$var_in_module_name);
	}


	private function exec_tpl($match_template, $page, $path_template, $tpl_name)
	{
		$tpl_content ="";
		if(file_exists($path_template))
		{
			ob_start();
				$this->_app->template[] = $path_template;
				require_once($path_template);
			$tpl_content = ob_get_clean();

			if($this->_view_tpl_in_source_code == 1)
				$tpl_content = "<!-- Début Template : ".$tpl_name."-->".$tpl_content."<!-- Fin Template : ".$tpl_name."-->";
		}
		else
		{
			$_SESSION['error'] = "Le Template : '".$tpl_name. "' à été demander mais n'existe pas, le fichier n'est pas créé";
			return '';
		}

		$page = str_replace($match_template, $tpl_content, $page);

		return $this->parser_main($page);
	}



	private function exec_mod($match_module, $page, $module_name,$var_in_module_name)
	{
		if($module_name != "")
		{
			$this->_app->var_module = $var_in_module_name;
			$module = new $module_name($this->_app);
			//$this->_app->module[] = $module;
			$rendu_module =  $module->get_html_tpl;

			if($this->_view_tpl_in_source_code == 1)
				$rendu_module = "<!-- Début module : ".$module_name."-->".$rendu_module."<!-- Fin module : ".$module_name."-->";
		}
		else
		{
			$_SESSION['error'] = "Le module : '".$module_name. "' à été demander mais n'existe pas, le fichier n'est pas créé";
			return '';
		}

		$page = str_replace($match_module, $rendu_module, $page);

		return $this->parser_main($page);
	}
}
?>