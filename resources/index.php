<?php

require_once (__DIR__ . '/../config/db.php');
require_once (__DIR__ . '/./crud/crud.php');

$crud = new crud();
$crud->getArticles();
