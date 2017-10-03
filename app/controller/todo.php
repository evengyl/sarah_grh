<?php 

Class todo extends base_module
{

	public function __construct(&$_app)
	{		
		$_app->module_name = __CLASS__;
		parent::__construct($_app);

		$_app->navigation->_stack_nav[] = 'Ma ToDo List';

		$this->get_html_tpl =  $this->render_tpl();
	}
}
