<?php

require("../../includes/min_require_for_ajax.php");

$req_sql = new stdClass();
$req_sql->table = 'employer';
$req_sql->ctx = new stdClass();
$req_sql->ctx->{$_POST["column"]} = $_POST['editval'];
$req_sql->where = "id = ".$_POST['id'];

$sql->update($req_sql);
?>