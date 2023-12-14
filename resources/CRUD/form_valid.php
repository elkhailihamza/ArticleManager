<?php

require_once(__DIR__ . '/../../config/db.php');
require_once (__DIR__ . '/./crud.php');
$crud = new crud();

if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $user_id = 1;

    if (!empty($title) && !empty($content)) {
        $crud->addArticles($title, $content, $user_id);
        header("Location: __DIR__ . /../../index.php");
    } else {
        die("Enter text in the fields specified!");
    }
}