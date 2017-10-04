<?php
session_start();
require($_SERVER['DOCUMENT_ROOT'].'/sarah_grh/app/includes/min_require_for_ajax.php');


if($_POST['action'] == "delete")
{
	affiche_pre($_POST);
	$req_sql = new stdClass();
	$req_sql->table = 'todo';
	$req_sql->ctx = new stdClass();
	$req_sql->ctx->visible = 0;
	$req_sql->where = "id = ".$_POST['id'];
	$sql->update($req_sql);	
}
else if($_POST['action'] == 'edit')
{
	affiche_pre($_POST);
	//pour ajouter une ligne on va viérfier pour le reste qu'elle n'existe pas
	//donc comme ça on appel que edit même pour ajouter une ligne dans la base
	$req_sql = new stdClass();
	$req_sql->table = "todo";
	$req_sql->var = "id";
	$req_sql->where = "id = ".$_POST['id'];
	$last_todo = $sql->select($req_sql);

	if(empty($last_todo))
	{

		$req_sql = new stdClass();
		$req_sql->table = 'todo';
		$req_sql->ctx = new stdClass();
		$req_sql->ctx->{$_POST["column"]} = $_POST['editval'];
		$req_sql->ctx->visible = 1;
		$req_sql->ctx->date = $_POST['current_date'];
		$req_sql->where = "id = ".$_POST['id'];

		$sql->insert_into($req_sql);
	}

	$req_sql = new stdClass();
	$req_sql->table = 'todo';
	$req_sql->ctx = new stdClass();
	$req_sql->ctx->{$_POST["column"]} = $_POST['editval'];
	$req_sql->where = "id = ".$_POST['id'];

	$sql->update($req_sql);
}

else if($_POST['action'] == 'list_with_date')
{
	$req_sql = new stdClass();
	$req_sql->table = "todo";
	$req_sql->var = "id, todo_title, todo_content, date, visible";
	$req_sql->where = "date = '".$_POST['current_select_date']."'";
	$req_sql->order = "visible DESC, date DESC";
	$list_todo = $sql->select($req_sql);

	ob_start();
		include $_SERVER['DOCUMENT_ROOT'].'/sarah_grh/vues/appel_ajax/todo_list.php';
	$return = ob_get_clean();
	echo ($return);
}
else if($_POST['action'] == "get_last_id")
{
	$req_sql = new stdClass();
	$req_sql->table = "todo";
	$req_sql->var = "id";
	$req_sql->order = "id DESC";
	$id = $sql->select($req_sql);
	echo $id[0]->id+1;
}
?>