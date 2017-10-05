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
		$req_sql->var = "id, nom, prenom, gsm, age, habite, id_shop_proche_1, id_shop_proche_2, id_shop_proche_3, id_shop_proche_4";
		$req_sql->order = "id";
		$req_sql->where = "visible = 1";
		$list_employer = $this->sql->select($req_sql);

		
		foreach($list_employer as $row_employer)
		{
			$i = 1;
			//boucle sur les 4 lieu les plus proche de l'employer
			while($i <= 4)
			{
				$id_shop_proche = "id_shop_proche_".$i;
				$tmp_shop_{$i} = "SELECT shop.couleur_horraire, shop.id as id_shop, shop.nom FROM shop WHERE shop.id = ".$row_employer->{$id_shop_proche}."";
				$tmp_shop_{$i} = $this->sql->other_query($tmp_shop_{$i});
				$tmp_id_shop = $row_employer->{$id_shop_proche};
				unset($row_employer->{$id_shop_proche});
				$shop_proche = 'shop_proche_'.$i;
				$row_employer->{$shop_proche} = array();
				$row_employer->{$shop_proche}['id'] = $tmp_id_shop;
				$row_employer->{$shop_proche}['color_id_shop_'.$i] = isset($tmp_shop_{$i}[0]->couleur_horraire)?$tmp_shop_{$i}[0]->couleur_horraire:"white";
				$row_employer->{$shop_proche}['nom_shop_'.$i] = isset($tmp_shop_{$i}[0]->nom)?$tmp_shop_{$i}[0]->nom:"Non Connu";

				$i++;
			}
		}

		$req_sql = new stdClass;
		$req_sql->table = "shop";
		$req_sql->var = "*";
		$req_sql->order = "id";
		$list_shop = $this->sql->select($req_sql);

		



		$this->get_html_tpl = $this->assign_var("list_employer", $list_employer)->assign_var("list_shop", $list_shop)->render_tpl();
	}
}