<?php
require_once(__DIR__ . "/../includes/CRUD/crud.php");
include(__DIR__ . "/../includes/reg_header.php");
$identifier = "register";
$session = new sessionManager();
$register = new auth($session);
$register->checker($identifier);
?>

<main class="container-fluid d-flex flex-column justify-content-center align-items-center">
    <div class="container col-6 d-grid gap-3 mt-3">
        <div class="text-center">
            <h2>
                Sign-up
            </h2>
        </div>
        <form action="" method="post" class="form-group">
            <div class="container d-grid gap-3 mt-3" style="width: 450px;">
                <div class="d-flex justify-content-between">
                    <div class="form-floating">
                        <input class="form-control" type="text" placeholder="Enter user email.." maxlength="125"
                            name="fname" required></input>
                        <label>firstname</label>
                    </div>
                    <div class="form-floating">
                        <input class="form-control" type="text" placeholder="Enter user email.." maxlength="125"
                            name="lname" required></input>
                        <label>lastname</label>
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <div class="form-floating">
                        <input class="form-control" type="text" placeholder="Enter user email.." maxlength="125"
                            name="uname" required></input>
                        <label>username</label>
                    </div>
                    <div class="form-floating">
                        <input class="form-control" type="password" placeholder="Enter user password.." maxlength="125"
                            name="pass" required>
                        <label>Password</label>
                    </div>
                </div>
                <div class="form-floating">
                    <input class="form-control" type="text" placeholder="Enter user email.." maxlength="200"
                        name="email" required></input>
                    <label>email</label>
                </div>
                <div class="container d-grid">
                    <span>Already have an account? <a href="./login.php"> sign-in</a> now!</span>
                    <span><a href="#" class="text-decoration-none">forgot password?</a></span>
                </div>
                <div class="container d-flex justify-content-center align-items-center mt-3">
                    <button class="btn btn-primary" style="width: 125px;" type="submit" name="submit"
                        value="Submit">Register</button>
                </div>
            </div>
        </form>
    </div>
</main>

<?php
include(__DIR__ . "/../includes/footer.php");
