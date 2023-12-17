<?php

require_once(__DIR__ . "/./crud.php");

$session = new sessionManager();
$auth = new auth($session);

if($auth->logout()) {
    header("Location: ./../../resources/index.php");
} else {
    echo "Error";
}
