<?php

require_once (__DIR__ . '/../config/db.php');
require_once (__DIR__ . '/../includes/CRUD/crud.php');
require(__DIR__ . "/../includes/header.php");
require(__DIR__ . "/../includes/footer.php");

$crud = new crud();
$crud->getArticles();

?>


