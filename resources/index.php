<?php

require_once (__DIR__ . '/../config/db.php');
require_once (__DIR__ . '/../includes/CRUD/crud.php');
include (__DIR__ . "/../includes/header.php");

$session = new sessionManager();
$session->startSession();

if($session->getSession("userid") === null) {
    header("Location: ./login.php");
}

$crud = new crud();
$crud->getArticles();

include (__DIR__ . "/../includes/footer.php");
?>


