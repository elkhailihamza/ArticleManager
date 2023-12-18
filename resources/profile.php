<?php

include(__DIR__ . "/../includes/header.php");
?>
<main class="d-flex flex-column align-items-center justify-content-center gap-3" style="height: 65vh;">
    <div>
        <h2>Profile</h2>
        <hr>
    </div>
    <div class="container-fluid">
        <div class="container col-6">
            <ul class="list-group">
                <li class="list-group-item active">Profile Info</li>    
                <li class="list-group-item">Firstname: -
                    <?= $sessionObj->getSession("fname") ?>
                </li>
                <li class="list-group-item">Lastname: -
                    <?= $sessionObj->getSession("lname") ?>
                </li>
                <li class="list-group-item">Username: -
                    <?= $sessionObj->getSession("uname") ?>
                </li>
                <li class="list-group-item">Email: -
                    <?= $sessionObj->getSession("email") ?>
                </li>
                <li class="list-group-item">Current role & permissions: -
                    <?php 
                    if($sessionObj->getSession("role_id") == 1) {
                        if($sessionObj->getSession("isAdmin")) {
                            echo "Admin, read, edit & delete only.";
                        } else {
                            echo "User, read only.";
                        }
                    } else if($sessionObj->getSession("role_id") == 2) {
                        if($sessionObj->getSession("isAdmin")) {
                            echo "Admin, full permissions.";
                        } else {
                            echo "User, read & create. delete and edit only own articles";
                        }
                    }
                    ?>
                </li>
            </ul>
        </div>
    </div>
</main>
<?php


include(__DIR__ . "/../includes/footer.php");
?>