<?php

include(__DIR__ . "/../includes/header.php");
?>
<div class="container d-flex flex-column justify-content-center align-items-center" style="height: 60vh;">
    <h2>Welcome,
        <?= $sessionObj->getSession("uname") ?>
    </h2>
    <hr class="col-4">
</div>
<?php


include(__DIR__ . "/../includes/footer.php");
?>