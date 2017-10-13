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
	/*
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
*/
	$req_sql = new stdClass();
	$req_sql->table = 'horraire_id_shop';
	$req_sql->ctx = new stdClass();
	$req_sql->ctx->{$_POST["jour"]} = (int)$_POST['id_shop'];
	$req_sql->where = "id_user = ".$_POST['id_user'];
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
	$data = "SELECT 
						name_shop.couleur_horraire as couleur_shop,
						name_shop.nom as name_shop,
						name_shop.id as id_shop
					FROM horraire_id_shop 
					INNER JOIN shop as name_shop 
					ON name_shop.id = horraire_id_shop.".$_POST['jour']."
					WHERE horraire_id_shop.id_user = ".$_POST['id_user']."";

	$data_return = $sql->other_query($data);
	echo json_encode($data_return);
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