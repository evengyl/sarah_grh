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
		$req_sql->var = "id, nom, gsm, age, habite, id_shop_proche_1, id_shop_proche_2, id_shop_proche_3, id_shop_proche_4";
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




$horraire_sql = "SELECT name_shop_lundi.id as id_lundi,
						name_shop_mardi.id as id_mardi,
						name_shop_mercredi.id as id_mercredi,
						name_shop_jeudi.id as id_jeudi,
						name_shop_vendredi.id as id_vendredi,
						name_shop_samedi.id as id_samedi,
						name_shop_lundi.couleur_horraire as couleur_horraire_lundi,
						name_shop_mardi.couleur_horraire as couleur_horraire_mardi,
						name_shop_mercredi.couleur_horraire as couleur_horraire_mercredi,
						name_shop_jeudi.couleur_horraire as couleur_horraire_jeudi,
						name_shop_vendredi.couleur_horraire as couleur_horraire_vendredi,
						name_shop_samedi.couleur_horraire as couleur_horraire_samedi,
						name_shop_lundi.nom as nom_lundi,
						name_shop_mardi.nom as nom_mardi, 
						name_shop_mercredi.nom as nom_mercredi,
						name_shop_jeudi.nom as nom_jeudi,
						name_shop_vendredi.nom as nom_vendredi,
						name_shop_samedi.nom as nom_samedi,
						employer.gsm, employer.habite, employer.nom 
				FROM horraire_id_shop 
				INNER JOIN employer ON employer.id = horraire_id_shop.id_user
				INNER JOIN shop as name_shop_lundi ON name_shop_lundi.id = horraire_id_shop.lundi
				INNER JOIN shop as name_shop_mardi ON name_shop_mardi.id = horraire_id_shop.mardi
				INNER JOIN shop as name_shop_mercredi ON name_shop_mercredi.id = horraire_id_shop.mercredi
				INNER JOIN shop as name_shop_jeudi ON name_shop_jeudi.id = horraire_id_shop.jeudi
				INNER JOIN shop as name_shop_vendredi ON name_shop_vendredi.id = horraire_id_shop.vendredi
				INNER JOIN shop as name_shop_samedi ON name_shop_samedi.id = horraire_id_shop.samedi";



			$horraires = $this->sql->other_query($horraire_sql);/*

			foreach($horraire as $row_horraire)
			{
				$id_lundi = $row_horraire->lundi;
				$row_horraire->lundi = new StdClass();
				$row_horraire->lundi->id_shop = $id_lundi;
				$row_horraire->lundi->heure = $id_lundi;
			}*/

		affiche_pre($horraires);




		$req_sql = new stdClass;
		$req_sql->table = "shop";
		$req_sql->var = "*";
		$req_sql->order = "id";
		$list_shop = $this->sql->select($req_sql);


		$this->get_html_tpl = $this->assign_var("horraires", $horraires)->assign_var("list_employer", $list_employer)->assign_var("list_shop", $list_shop)->render_tpl();
	}
}