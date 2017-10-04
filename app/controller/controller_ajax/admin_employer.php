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
	$last_todo = $sql->select($req_sql);

	if(empty($last_todo))
	{

		$req_sql = new stdClass();
		$req_sql->table = 'employer';
		$req_sql->ctx = new stdClass();
		$req_sql->ctx->{$_POST["column"]} = $_POST['editval'];
		$req_sql->ctx->visible = 1;
		$sql->insert_into($req_sql);
	}
affiche_pre($_POST);
	$req_sql = new stdClass();
	$req_sql->table = 'employer';
	$req_sql->ctx = new stdClass();
	$req_sql->ctx->{$_POST["column"]} = $_POST['editval'];
	$req_sql->where = "id = ".$_POST['id'];
	$sql->update($req_sql);
}
else if($_POST['action'] == 'list')
{
	$req_sql = new stdClass;
	$req_sql->table = "employer";
	$req_sql->var = "id, nom, prenom, gsm, age, habite, travail, id_shop_proche_1, id_shop_proche_2, id_shop_proche_3, id_shop_proche_4";
	$req_sql->order = "id";
	$req_sql->where = "visible = 1";
	$list_employer = $sql->select($req_sql);



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