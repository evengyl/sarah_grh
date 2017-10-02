<?php

Class breadcrumb extends base_module
{

	public function __construct(&$_app)
	{	
		$this->_app = &$_app;
		$breadcrumb = [];

		if(isset($this->_app->navigation->_stack_nav))
		{
			foreach($this->_app->navigation->_stack_nav as $key_navigation => $row_navigation)
			{
				$breadcrumb[$row_navigation] = "?page=".$_GET['page'];
			}
		}
		else
		{
			if(isset($_GET['page']))
				$breadcrumb = array($_GET['page'] => "?page=".$_GET['page']);
		}
		
		$breadcrumb = array_merge(array("Accueil" => "?page=home"), $breadcrumb);
		
		
		$i = count($breadcrumb);

		$title_page ="<div class='col-xs-12 breadcrumb_top'><h1><div class='home_button_bread'><a class='hidden-xs' href='?page=home'><span class='glyphicon glyphicon-home'></span></a></div>";
		foreach($breadcrumb as $title => $link)
		{
			$i--;
			$title_page .= "<div class='level_bread'><a href='".$link."'>";

			if($i==0) $title_page .= $title.'</a>';
			else $title_page .= $title.'</a><span>&nbsp;&nbsp;>&nbsp;&nbsp;</span>';

			$title_page .= "</div>";
		}
		$title_page .= "</h1></div>";


		$this->get_html_tpl = $this->use_template("breadcrumb")->assign_var("breadcrumb", $title_page)->render_tpl();
	}

}


