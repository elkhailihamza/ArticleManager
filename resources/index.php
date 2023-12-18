<?php

include (__DIR__ . "/../includes/header.php");

if($sessionObj->getSession("userid") === null) {
    header("Location: ./login.php");
}
?>
<div class="container text-center">
    <h2>Welcome, <?= $sessionObj->getSession("uname") ?></h2>
    <hr>
</div>
<?php


include (__DIR__ . "/../includes/footer.php");
?>


