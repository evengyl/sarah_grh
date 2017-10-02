<?php 

Class mail_box extends base_module
{

	public function __construct(&$_app)
	{		
		$_app->module_name = __CLASS__;
		parent::__construct($_app);

		$req_sql = new stdClass();
		$req_sql->table = "login";
		$req_sql->var = "login, point, last_connect, point_vente";
		$req_sql->order = "point DESC";
		$list_user = $this->user->select($req_sql);

		$i = 1;
		foreach($list_user as $row_user)
		{
			$row_user->last_connect = $this->user->convert_sec_unix_in_time_real($row_user->last_connect);
			$row_user->point = floor($row_user->point);
			$row_user->point_vente = floor($row_user->point_vente);
			$row_user->position = $i;
			$i++;
			
		}


		$this->position_this_user = $this->get_position_user($list_user);

		$this->get_html_tpl =  $this->assign_var("list_user", $list_user)->assign_var("user", $this->user)->assign_var("position_user",$this->position_this_user)->render_tpl();
	}

	public function get_position_user($list_user)
	{
		foreach($list_user as $row_user)
		{
			if($row_user->login == $this->user->user_infos->login)
			{
				$pos = $row_user->position;
			}
		}
		return $pos;
	}

}
