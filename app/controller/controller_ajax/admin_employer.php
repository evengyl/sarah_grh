<?php

require($_SERVER['DOCUMENT_ROOT'].'sarah_grh/app/includes/min_require_for_ajax.php');


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
	$req_sql->var = "id, nom, prenom, age, habite, travail";
	$req_sql->order = "id";
	$req_sql->where = "visible = 1";
	$list_employer = $sql->select($req_sql);



	ob_start();
		include $_SERVER['DOCUMENT_ROOT'].'sarah_grh/vues/appel_ajax/list_table_employer.php';
	$return = ob_get_clean();

	echo ($return);
}

?>