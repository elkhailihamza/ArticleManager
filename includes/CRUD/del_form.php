<?php

require_once(__DIR__ . '/./crud.php');

$id = $_POST['id'];
$session = new sessionManager();

$del = new crud($session);
if($del->delArticles($id)) {
    header("Location: ../../resources/view.php");
}