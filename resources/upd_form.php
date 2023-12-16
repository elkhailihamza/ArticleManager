<?php
require_once(__DIR__ . '/../config/db.php');
require_once(__DIR__ . '/../includes/CRUD/crud.php');
include(__DIR__ . "/../includes/header.php");

$identifier = "update";
$crud = new crud();
$crud->checker($identifier);
$id = $_POST['id'];
?>

<main class="container-fluid d-flex flex-column justify-content-center align-items-center" style="height: 100vh;">
    <div class="container col-6 d-grid gap-5">
        <div class="text-center">
            <h2>
                Update article N°:
                <?= $id ?>
            </h2>
        </div>
        <form action="" method="post" class="form-group d-flex flex-column justify-content-center gap-4">
            <div class="form-floating">
                <input class="form-control" placeholder="Enter a title here.." maxlength="125" name="title"></input>
                <label>Title</label>
            </div>
            <div class="form-floating">
                <textarea class="form-control" style="resize: none; height: 250px;"
                    placeholder="Enter article content here.." maxlength="4200" name="content"></textarea>
                <label>Content</label>
            </div>
            <input type="hidden" value="<?= $id ?>" name="id">
            <div class="container d-flex justify-content-center align-items-center">
                <button class="btn btn-success px-4" style="width: 200px;" type="submit" name="submit"
                    value="Submit">Edit</button>
            </div>
        </form>
    </div>
</main>
<?php
include(__DIR__ . "/../includes/footer.php");