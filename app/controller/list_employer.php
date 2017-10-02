<?
Class list_employer extends base_module
{
		public function __construct(&$_app)
	{		
		$_app->module_name = __CLASS__;
		parent::__construct($_app);

		$req_sql = new stdClass;
		$req_sql->table = "employer";
		$req_sql->var = "*";
		$req_sql->order = "id";
		$res_fx = $this->sql->select($req_sql);


		$this->get_html_tpl = $this->assign_var("list_employer", $res_fx)->render_tpl();
	}
}