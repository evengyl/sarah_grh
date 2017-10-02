<?php 


Class base_module
{

	public $get_html_tpl;
	public $var_to_extract;
	public $template_name;
	public $template_path;
	public $user;
	public $module_name;
	public $sql;
	public $_app;

	public function __construct(&$_app)
	{
		$this->_app = &$_app;

		if($_app->sql != "")
			$this->sql = &$_app->sql;
		else
			$this->sql = new all_query();

		if(Config::$is_connect)
		{
			if(!isset($_app->user) || !empty($_app->user))
				$this->user = singleton::get_singleton()->user;
			else
				$this->user = $this->_app->user;
		}

		$this->module_name = $this->_app->module_name;
	}

	public function assign_var($var_name , $value)
	{
		if(empty($var_name) && !empty($value))
			$this->var_to_extract[$value] = $value;

		else if(empty($value) && !empty($var_name))
			$this->var_to_extract[$var_name] = "";
		else		
        	$this->var_to_extract[$var_name] = $value;
        
        return $this;
	}

//partie setter du get_html_tpl


	public function render_tpl()
	{
		ob_start();
			if(!empty($this->var_to_extract))
				extract($this->var_to_extract);

			$this->set_template_path();	

			require($this->template_path);

			$get_html_tpl = ob_get_contents();
		ob_end_clean();
		return $get_html_tpl;
	}

	public function use_template($template_name = "")
	{
		$this->template_name = $template_name;
		$this->set_template_path();
			
		return $this;
	}

	public function set_template_path()
	{
		if(empty($this->template_name))
			$this->template_name = $this->module_name;

		if(strpos($this->template_name, "admin_") !== false)
			$this->template_path = "../vues/admin_tool/".$this->template_name.".php";
		else
			$this->template_path = "../vues/".$this->template_name.".php";

	}
}