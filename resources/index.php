<?php

require_once (__DIR__ . '/../config/db.php');
require_once (__DIR__ . '/../includes/CRUD/crud.php');
include (__DIR__ . "/../includes/header.php");

$crud = new crud();
$crud->getArticles();

include (__DIR__ . "/../includes/footer.php");
?>


