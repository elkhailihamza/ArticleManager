<?php
include(__DIR__ . "/../includes/header.php");

$identifier = "insert";

$crudObj->checker($identifier);
?>

<main class="container-fluid d-flex flex-column justify-content-center align-items-center" style="height: 80vh;">
    <div class="container col-6 d-grid gap-5">
        <div class="text-center">
            <h2>
                Create an article
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
            <div class="container d-flex justify-content-center align-items-center">
                <button class="btn btn-primary px-4" style="width: 200px;" type="submit" name="submit">Submit</button>
            </div>
        </form>
    </div>
</main>
<?php
include(__DIR__ . "/../includes/footer.php");
