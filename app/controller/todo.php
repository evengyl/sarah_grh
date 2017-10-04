<?php 

Class todo extends base_module
{

	public function __construct(&$_app)
	{		
		$_app->module_name = __CLASS__;
		parent::__construct($_app);

		$_app->navigation->_stack_nav[] = 'Ma ToDo List';

		$current_date = date('d-m-Y');
		$req_sql = new stdClass();
		$req_sql->table = "todo";
		$req_sql->var = "id, todo_title, todo_content, date, visible";
		$req_sql->where = "date = '".$current_date."'";
		$req_sql->order = "visible DESC, date DESC";
		$list_todo = $this->sql->select($req_sql);

		$this->get_html_tpl =  $this->assign_var('list_todo', $list_todo)->render_tpl();
	}
}
