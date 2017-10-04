<?
Class list_employer extends base_module
{
	public function __construct(&$_app)
	{		
		$_app->module_name = __CLASS__;
		parent::__construct($_app);

		$_app->navigation->_stack_nav[] = 'Liste des employers';

		$req_sql = new stdClass;
		$req_sql->table = "employer";
		$req_sql->var = "id, nom, prenom, gsm, age, habite, travail, id_shop_proche_1, id_shop_proche_2, id_shop_proche_3, id_shop_proche_4";
		$req_sql->order = "id";
		$req_sql->where = "visible = 1";
		$list_employer = $this->sql->select($req_sql);


		$req_sql = new stdClass;
		$req_sql->table = "shop";
		$req_sql->var = "*";
		$req_sql->order = "id";
		$list_shop = $this->sql->select($req_sql);



		$this->get_html_tpl = $this->assign_var("list_employer", $list_employer)->assign_var("list_shop", $list_shop)->render_tpl();
	}
}