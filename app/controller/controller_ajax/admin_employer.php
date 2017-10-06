<?php
require(dirname(dirname(dirname(dirname(__FILE__)))).'/app/includes/min_require_for_ajax.php');


if($_POST['action'] == "delete")
{
	$req_sql = new stdClass();
	$req_sql->table = 'employer';
	$req_sql->ctx = new stdClass();
	$req_sql->ctx->visible = 0;
	$req_sql->where = "id = ".$_POST['id'];

	$sql->update($req_sql);	
}
else if($_POST['action'] == 'edit')
{
	//pour ajouter une ligne on va viérfier pour le reste qu'elle n'existe pas
	//donc comme ça on appel que edit même pour ajouter une ligne dans la base
	$req_sql = new stdClass();
	$req_sql->table = "employer";
	$req_sql->var = "id";
	$req_sql->where = "id = ".$_POST['id'];
	$last_employer = $sql->select($req_sql);

	if(empty($last_employer))
	{

		$req_sql = new stdClass();
		$req_sql->table = 'employer';
		$req_sql->ctx = new stdClass();
		$req_sql->ctx->{$_POST["column"]} = $_POST['editval'];
		$req_sql->ctx->visible = 1;
		$sql->insert_into($req_sql);
	}

	$req_sql = new stdClass();
	$req_sql->table = 'employer';
	$req_sql->ctx = new stdClass();
	$req_sql->ctx->{$_POST["column"]} = $_POST['editval'];
	$req_sql->where = "id = ".$_POST['id'];
	$sql->update($req_sql);
}
else if($_POST['action'] == 'edit_shop')
{
	$req_sql = new stdClass();
	$req_sql->table = 'employer';
	$req_sql->ctx = new stdClass();
	$req_sql->ctx->{$_POST["column"]} = $_POST['id_shop'];
	$req_sql->where = "id = ".$_POST['id_employer'];
	$sql->update($req_sql);
}
else if($_POST['action'] == 'list')
{
	$req_sql = new stdClass;
	$req_sql->table = "employer";
	$req_sql->var = "id, nom, gsm, age, habite, id_shop_proche_1, id_shop_proche_2, id_shop_proche_3, id_shop_proche_4";
	$req_sql->order = "id";
	$req_sql->where = "visible = 1";
	$list_employer = $sql->select($req_sql);

	
	foreach($list_employer as $row_employer)
	{
		$i = 1;
		//boucle sur les 4 lieu les plus proche de l'employer
		while($i <= 4)
		{
			$id_shop_proche = "id_shop_proche_".$i;
			$tmp_shop_{$i} = "SELECT shop.couleur_horraire, shop.id as id_shop, shop.nom FROM shop WHERE shop.id = ".$row_employer->{$id_shop_proche}."";
			$tmp_shop_{$i} = $sql->other_query($tmp_shop_{$i});
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

	ob_start();
		include dirname(dirname(dirname(dirname(__FILE__)))).'/vues/appel_ajax/list_table_employer.php';
	$return = ob_get_clean();

	echo ($return);
}

else if($_POST['action'] == "get_last_id")
{
	$req_sql = new stdClass();
	$req_sql->table = "employer";
	$req_sql->var = "id";
	$req_sql->order = "id DESC";
	$id = $sql->select($req_sql);
	echo $id[0]->id+1;
}

?>