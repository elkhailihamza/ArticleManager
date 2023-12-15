<?php

require_once(__DIR__ . '/../../config/db.php');

$id = $_POST['id'];

$del = new crud();
if($del->delArticles($id)) {
    header("Location: __DIR__ . /../../index.php");
}