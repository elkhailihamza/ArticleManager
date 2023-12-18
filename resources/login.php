<?php
include(__DIR__ . "/../includes/reg_header.php");
$identifier = "login";
$auth->checker($identifier);
?>

<main class="container-fluid d-flex flex-column justify-content-center align-items-center">
    <div class="container col-6 d-grid gap-3 mt-3">
        <div class="text-center">
            <h2>
                Sign-in
            </h2>
        </div>
        <form action="" method="post" class="form-group">
            <div class="container d-grid gap-3 mt-3" style="width: 425px;">
                <div class="form-floating">
                    <input class="form-control" type="email" placeholder="Enter user email.." maxlength="125"
                        name="email" required></input>
                    <label>Email</label>
                </div>
                <div class="form-floating">
                    <input class="form-control" type="password" placeholder="Enter user password.." name="pass"
                        maxlength="125" required>
                    <label>Password</label>
                </div>
                <div class="container d-grid">
                    <span>Haven't got an account? <a href="./register.php">sign-up</a> now!</span>
                    <span><a href="#" class="text-decoration-none">forgot password?</a></span>
                </div>
                <div class="container d-flex justify-content-center align-items-center mt-5">
                    <button class="btn btn-primary" style="width: 125px;" type="submit" name="submit">Login</button>
                </div>
            </div>
        </form>
    </div>
</main>

<?php
include(__DIR__ . "/../includes/footer.php");
