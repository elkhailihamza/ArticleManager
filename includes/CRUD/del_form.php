<?php

require_once(__DIR__ . '/./crud.php');

$id = $_POST['id'];

$del = new crud();
if($del->delArticles($id)) {
    header("Location: ../../resources/index.php");
}